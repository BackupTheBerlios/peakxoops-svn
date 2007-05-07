<?php
// ------------------------------------------------------------------------- //
//                         mylangadmin.php (altsys)                          //
//                    - XOOPS language constants admin -                     //
//                       GIJOE <http://www.peak.ne.jp/>                      //
// ------------------------------------------------------------------------- //

include_once dirname(__FILE__)."/include/gtickets.php" ;
include_once dirname(__FILE__).'/include/altsys_functions.php' ;
include_once dirname(__FILE__).'/class/D3LanguageManager.class.php' ;


// only groups have 'module_admin' of 'altsys' can do that.
$module_handler =& xoops_gethandler( 'module' ) ;
$module =& $module_handler->getByDirname( 'altsys' ) ;
if( ! is_object( $module ) ) die( 'install altsys' ) ;
$moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
if( ! is_object( @$xoopsUser ) || ! $moduleperm_handler->checkRight( 'module_admin' , $module->getVar( 'mid' ) , $xoopsUser->getGroups() ) ) die( 'only admin of altsys can access this area' ) ;


// initials
$db =& Database::getInstance();
$myts =& MyTextSanitizer::getInstance() ;
$langman =& D3LanguageManager::getInstance() ;

// language file of this controller
altsys_include_language_file( 'mylangadmin' ) ;

// check $xoopsModule
if( ! is_object( $xoopsModule ) ) redirect_header( XOOPS_URL.'/user.php' , 1 , _NOPERM ) ;

// set target_module if specified by $_GET['dirname']
$module_handler =& xoops_gethandler('module');
if( ! empty( $_GET['dirname'] ) ) {
	$dirname = strtr( $_GET['dirname'] , "\'\"\0<>" , '     ' ) ;
	$target_module =& $module_handler->getByDirname( $dirname ) ;
}

if( ! empty( $target_module ) && is_object( $target_module ) ) {
	// specified by dirname (for langadmin as an independent module)
	$target_mid = $target_module->getVar( 'mid' ) ;
	$target_dirname = $target_module->getVar( 'dirname' ) ;
	$target_dirname4sql = addslashes( $target_dirname ) ;
	$target_mname = $target_module->getVar( 'name' ) . "&nbsp;" . sprintf( "(%2.2f)" , $target_module->getVar('version') / 100.0 ) ;
	//$query4redirect = '?dirname='.urlencode(strip_tags($_GET['dirname'])) ;
} else {
	// not specified by dirname (for 3rd party modules as mylangadmin)
	$target_mid = $xoopsModule->getVar( 'mid' ) ;
	$target_dirname = $xoopsModule->getVar( 'dirname' ) ;
	$target_dirname4sql = addslashes( $target_dirname ) ;
	$target_mname = $xoopsModule->getVar( 'name' ) ;
	//$query4redirect = '' ;
}

// basic GET variables
$target_lang = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , @$_GET['target_lang'] ) ;
if( empty( $target_lang ) ) $target_lang = $GLOBALS['xoopsConfig']['language'] ;
$target_lang4sql = addslashes( $target_lang ) ;
$target_file = preg_replace( '/[^0-9a-zA-Z_.-]/' , '' , @$_GET['target_file'] ) ;
if( empty( $target_file ) ) $target_file = 'main.php' ;

// make list of language and check $target_lang
$languages = array() ;
$base_dir = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname.'/language' ;
$dh = opendir( $base_dir ) ;
if( $dh ) while( $file = readdir( $dh ) ) {
	if( substr( $file , 0 , 1 ) == '.' ) continue ;
	if( is_dir( "$base_dir/$file" ) ) $languages[] = $file ;
}
closedir( $dh ) ;
if( ! in_array( $target_lang , $languages ) ) $target_lang = $languages[0] ;

// get base directory
if( ! empty( $mytrustdirname ) ) {
	// D3 modules
	$lang_base_dir = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname.'/language/'.$target_lang ;
} else {
	// conventional modules
	$lang_base_dir = XOOPS_ROOT_PATH.'/modules/'.$target_dirname.'/language/'.$target_lang ;
}

// make list of files and check $target_file
$lang_files = array() ;
$dh = opendir( $lang_base_dir ) ;
if( $dh ) while( $file = readdir( $dh ) ) {
	if( substr( $file , 0 , 1 ) == '.' ) continue ;
	if( $file == 'modinfo.php' ) continue ; // TODO(?)
	if( is_file( "$lang_base_dir/$file" ) ) $lang_files[] = $file ;
}
closedir( $dh ) ;
if( ! in_array( $target_file , $lang_files ) ) $target_file = $lang_files[0] ;

// get constants defined by the target_file
$system_constants = array_keys( get_defined_constants() ) ;
unset( $constpref ) ;
require "$lang_base_dir/$target_file" ;
$langfile_names = array_diff( array_keys( get_defined_constants() ) , $system_constants ) ;
$langfile_constants = array() ;
foreach( $langfile_names as $name ) {
	list( $value ) = $db->fetchRow( $db->query( "SELECT value FROM ".$db->prefix("altsys_language_constants")." WHERE mid=$target_mid AND language='$target_lang4sql' AND name='".addslashes($name)."'" ) ) ;
	$langfile_constants[ $name ] = $value ;
}

//
// transaction stage
//

// Update language table and cache file
if( ! empty( $_POST['do_update'] ) ) {
	// Ticket Check
	if ( ! $xoopsGTicket->check( true , 'altsys' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	// read original file
	$file_contents = file_get_contents( "$lang_base_dir/$target_file" ) ;

	// constants loop
	foreach( array_reverse( $langfile_names ) as $name ) {
		$user_value = $myts->stripSlashesGPC( @$_POST[$name] ) ;
		$db->query( "DELETE FROM ".$db->prefix("altsys_language_constants")." WHERE mid=$target_mid AND language='$target_lang4sql' AND name='".addslashes($name)."'" ) ;
		if( $user_value !== '' ) {
			// Update table
			$db->query( "INSERT INTO ".$db->prefix("altsys_language_constants")." (mid,language,name,value) VALUES ($target_mid,'$target_lang4sql','".addslashes($name)."','".addslashes($user_value)."')" ) ;
			// rewrite script for cache
			// comment-out the line of define()
			if( empty( $constpref ) ) {
				$from = '/.*define\(.*(["\'])'.preg_quote($name).'(\\1).*\;.*/' ;
			} else {
				$from = '/.*define\(\s*\$constpref\s*\.\s*(["\'])'.preg_quote(substr($name,strlen($constpref))).'(\\1).*\;.*/' ;
			}
			$file_contents = preg_replace( $from , '//$0' , $file_contents ) ;
			// add a line of define()
			$file_contents = str_replace( '<?php' , "<?php\ndefine('".addslashes($name)."','".addslashes($user_value)."');" , $file_contents ) ;
		}
	}

	// Create language cache file
	$cache_file = $langman->getCacheFileName( $target_file , $target_dirname , $target_lang ) ;
	$fp = fopen( $cache_file , 'wb' ) ;
	if( ! $fp ) die( 'Invalid Cache Directory. (Set XOOPS_TRUST_PATH/cache writable)' ) ;
	fwrite( $fp , $file_contents ) ;
	fclose( $fp ) ;

	redirect_header( '?mode=admin&lib=altsys&page=mylangadmin&dirname='.$target_dirname.'&target_lang='.rawurlencode($target_lang).'&target_file='.rawurlencode($target_file) , 1 , _MYLANGADMIN_CACHEUPDATED ) ;
	exit ;
}


//
// form stage
//

//
// display stage
//


xoops_cp_header() ;

// mymenu
altsys_include_mymenu() ;

require_once XOOPS_ROOT_PATH.'/class/template.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'target_dirname' => $target_dirname ,
	'target_mname' => $target_mname ,
	'target_lang' => $target_lang ,
	'languages' => $languages ,
	'target_file' => $target_file ,
	'lang_files' => $lang_files ,
	'langfile_constants' => $langfile_constants ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'altsys') ,
) ) ;
$tpl->display( 'db:altsys_main_mylangadmin.html' ) ;

xoops_cp_footer() ;

?>