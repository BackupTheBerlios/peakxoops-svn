<?php
// ------------------------------------------------------------------------- //
//                          mytplsform.php (altsys)                          //
//               - XOOPS templates admin for each modules -                  //
//                       GIJOE <http://www.peak.ne.jp/>                      //
// ------------------------------------------------------------------------- //

include_once dirname(__FILE__)."/include/gtickets.php" ;
include_once dirname(__FILE__).'/include/altsys_functions.php' ;
include_once dirname(__FILE__)."/include/tpls_functions.php" ;
include_once dirname(__FILE__).'/include/Text_Diff.php' ;
include_once dirname(__FILE__).'/include/Text_Diff_Renderer.php' ;
include_once dirname(__FILE__).'/include/Text_Diff_Renderer_unified.php' ;


// only groups have 'module_admin' of 'altsys' can do that.
$module_handler =& xoops_gethandler( 'module' ) ;
$module =& $module_handler->getByDirname( 'altsys' ) ;
$moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
if( ! is_object( @$xoopsUser ) || ! $moduleperm_handler->checkRight( 'module_admin' , $module->getVar( 'mid' ) , $xoopsUser->getGroups() ) ) die( 'only admin of altsys can access this area' ) ;

//$xoops_system_path = XOOPS_ROOT_PATH . '/modules/system' ;

// initials
$db =& Database::getInstance();
$myts =& MyTextSanitizer::getInstance() ;

// language file
altsys_include_language_file( 'mytplsform' ) ;

// check $xoopsModule
if( ! is_object( $xoopsModule ) ) redirect_header( XOOPS_URL.'/user.php' , 1 , _NOPERM ) ;

// check access right (needs system_admin of tplset)
//$sysperm_handler =& xoops_gethandler('groupperm');
//if (!$sysperm_handler->checkRight('system_admin', XOOPS_SYSTEM_TPLSET, $xoopsUser->getGroups())) redirect_header( XOOPS_URL.'/user.php' , 1 , _NOPERM ) ;

// tpl_file from $_GET
$tpl_file = $myts->stripSlashesGPC( @$_GET['tpl_file'] ) ;
$tpl_file = str_replace( 'db:' , '' , $tpl_file ) ;
$tpl_file4sql = addslashes( $tpl_file ) ;

// tpl_file from $_GET
$tpl_tplset = $myts->stripSlashesGPC( @$_GET['tpl_tplset'] ) ;
if( ! $tpl_tplset ) $tpl_tplset = $xoopsConfig['template_set'] ;
$tpl_tplset4sql = addslashes( $tpl_tplset ) ;

// get information from tplfile table
$sql = "SELECT * FROM ".$db->prefix("tplfile")." f NATURAL LEFT JOIN ".$db->prefix("tplsource")." s WHERE f.tpl_file='$tpl_file4sql' ORDER BY f.tpl_tplset='$tpl_tplset4sql' DESC,f.tpl_tplset='default' DESC" ;
$tpl = $db->fetchArray( $db->query( $sql ) ) ;

// error in specifying tpl_file
if( empty( $tpl ) ) {
	if( strncmp( $tpl_file , 'file:' , 5 ) === 0 ) {
		die( 'Not DB template' ) ;
	} else {
		die( 'Invalid tpl_file.' ) ;
	}
}

//************//
// POST stage //
//************//
if( ! empty( $_POST['do_modifycont'] ) || ! empty( $_POST['do_modify'] ) ) {
	// Ticket Check
	if ( ! $xoopsGTicket->check( true , 'altsys_tplsform' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$result = $db->query( "SELECT tpl_id FROM ".$db->prefix("tplfile")." WHERE tpl_file='$tpl_file4sql' AND tpl_tplset='".addslashes($tpl['tpl_tplset'])."'" ) ;
	while( list( $tpl_id ) = $db->fetchRow( $result ) ) {
		$sql = "UPDATE ".$db->prefix("tplsource")." SET tpl_source='".addslashes($myts->stripSlashesGPC($_POST['tpl_source']))."' WHERE tpl_id=$tpl_id" ;
		if( ! $db->query( $sql ) ) die( 'SQL Error' ) ;
		$db->query( "UPDATE ".$db->prefix("tplfile")." SET tpl_lastmodified=UNIX_TIMESTAMP() WHERE tpl_id=$tpl_id" ) ;
		altsys_template_touch( $tpl_id ) ;
	}

	// continue or end ?
	if( ! empty( $_POST['do_modifycont'] ) ) {
		redirect_header( 'index.php?mode=admin&lib=altsys&page=mytplsform&tpl_file='.$tpl_file.'&tpl_tplset='.$tpl_tplset.'&#altsys_tplsform_top' , 1 , _MD_A_MYTPLSFORM_UPDATED ) ;
	} else {
		redirect_header( 'index.php?mode=admin&lib=altsys&page=mytplsadmin&dirname='.$tpl['tpl_module'] , 1 , _MD_A_MYTPLSFORM_UPDATED ) ;
	}
	exit ;
}

xoops_cp_header() ;
$mymenu_fake_uri = 'index.php?mode=admin&lib=altsys&page=mytplsadmin&dirname='.$mydirname ;
altsys_include_mymenu() ;

echo "<h3 style='text-align:left;'>"._MD_A_MYTPLSFORM_EDIT." : ".htmlspecialchars($tpl['tpl_type'],ENT_QUOTES)." : ".htmlspecialchars($tpl['tpl_file'],ENT_QUOTES)." (".htmlspecialchars($tpl['tpl_tplset'],ENT_QUOTES).")</h3>\n" ;


// diff from file to selected DB template
$basefilepath = tplsadmin_get_basefilepath( $tpl['tpl_module'] , $tpl['tpl_type'] , $tpl['tpl_file'] ) ;
$diff_from_file4disp = '' ;
if( file_exists( $basefilepath ) ) {
	$diff =& new Text_Diff( file( $basefilepath ) , explode("\n",$tpl['tpl_source']) ) ;
	$renderer =& new Text_Diff_Renderer_unified();
	$diff_str = htmlspecialchars( $renderer->render( $diff ) , ENT_QUOTES ) ;
	foreach( explode( "\n" , $diff_str ) as $line ) {
		if( ord( $line ) == 0x2d ) {
			$diff_from_file4disp .= "<span style='color:red;'>".$line."</span>\n" ;
		} else if( ord( $line ) == 0x2b ) {
			$diff_from_file4disp .= "<span style='color:blue;'>".$line."</span>\n" ;
		} else {
			$diff_from_file4disp .= $line."\n" ;
		}
	}
}

// diff from DB-default to selected DB template
$diff_from_default4disp = '' ;
if( $tpl['tpl_tplset'] != 'default' ) {
	list( $default_source ) = $db->fetchRow( $db->query( "SELECT tpl_source FROM ".$db->prefix("tplfile")." NATURAL LEFT JOIN ".$db->prefix("tplsource")." WHERE tpl_tplset='default' AND tpl_file='".addslashes($tpl['tpl_file'])."' AND tpl_module='".addslashes($tpl['tpl_module'])."'" ) ) ;
	$diff =& new Text_Diff( explode("\n",$default_source) , explode("\n",$tpl['tpl_source']) ) ;
	$renderer =& new Text_Diff_Renderer_unified();
	$diff_str = htmlspecialchars( $renderer->render( $diff ) , ENT_QUOTES ) ;
	foreach( explode( "\n" , $diff_str ) as $line ) {
		if( ord( $line ) == 0x2d ) {
			$diff_from_default4disp .= "<span style='color:red;'>".$line."</span>\n" ;
		} else if( ord( $line ) == 0x2b ) {
			$diff_from_default4disp .= "<span style='color:blue;'>".$line."</span>\n" ;
		} else {
			$diff_from_default4disp .= $line."\n" ;
		}
	}
}


echo "
	<form name='diff_form' id='diff_form' action='' method='get'>
	<input type='checkbox' name='display_diff2file' value='1' onClick=\"if(this.checked){document.getElementById('diff2file').style.display='block'}else{document.getElementById('diff2file').style.display='none'};\" id='display_diff2file' checked='checked' />&nbsp;<label for='display_diff2file'>diff from file</label>
	<pre id='diff2file' style='display:block;border:1px solid black;'>$diff_from_file4disp</pre>
	<input type='checkbox' name='display_diff2default' value='1' onClick=\"if(this.checked){document.getElementById('diff2default').style.display='block'}else{document.getElementById('diff2default').style.display='none'};\" id='display_diff2default' />&nbsp;<label for='display_diff2default'>diff from default</label>
	<pre id='diff2default' style='display:none;border:1px solid black;'>$diff_from_default4disp</pre>
	</form>\n" ;


echo "
<a name='altsys_tplsform_top' id='altsys_tplsform_top'></a>
<form name='MainForm' id='altsys_tplsform' action='?mode=admin&amp;lib=altsys&amp;page=mytplsform&amp;tpl_file=".htmlspecialchars($tpl['tpl_file'],ENT_QUOTES)."&amp;tpl_tplset=".htmlspecialchars($tpl['tpl_tplset'],ENT_QUOTES)."' method='post'>
	".$xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'altsys_tplsform' )."
	<textarea name='tpl_source' id='altsys_tpl_source' wrap='off' style='width:600px;height:400px;'>".htmlspecialchars($tpl['tpl_source'],ENT_QUOTES)."</textarea>
	<br />
	<input type='submit' name='do_modifycont' id='do_modifycont' value='"._MD_A_MYTPLSFORM_BTN_MODIFYCONT."' />
	<input type='submit' name='do_modify' id='do_modify' value='"._MD_A_MYTPLSFORM_BTN_MODIFYEND."' />
	<input type='reset' name='reset' value='"._MD_A_MYTPLSFORM_BTN_RESET."' />
</form>\n" ;

xoops_cp_footer() ;

?>
