<?php

require_once dirname(dirname(__FILE__)).'/include/main_functions.php' ;
require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
require_once dirname(dirname(__FILE__)).'/include/import_functions.php' ;
require_once dirname(dirname(__FILE__)).'/class/d3forum.textsanitizer.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;
$myts =& D3forumTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;


$module_handler =& xoops_gethandler( 'module' ) ;
$modules =& $module_handler->getObjects() ;
$importable_modules = array() ;
foreach( $modules as $module ) {
	$mid = $module->getVar('mid') ;
	$dirname = $module->getVar('dirname') ;
	$dirpath = XOOPS_ROOT_PATH.'/modules/'.$dirname ;
	$mytrustdirname = '' ;
	if( file_exists( $dirpath.'/mytrustdirname.php' ) ) {
		include $dirpath.'/mytrustdirname.php' ;
	}
	if( $mytrustdirname == 'd3forum' && $dirname != $mydirname ) {
		// d3forum
		$importable_modules[$mid] = 'd3forum:'.$module->getVar('name')."($dirname)" ;
	} else if( $dirname == 'xhnewbb' ) {
		// xhnewbb
		$importable_modules[$mid] = 'xhnewbb:'.$module->getVar('name')."($dirname)" ;
	} else if( $dirname == 'newbb' ) {
		// newbb
		$importable_modules[$mid] = 'newbb1:'.$module->getVar('name')."($dirname)" ;
	}
}


//
// transaction stage
//

if( ! empty( $_POST['do_sycalltables'] ) ) {
	set_time_limit( 0 ) ;

	// sync all topics
	$result = $db->query( "SELECT topic_id FROM ".$db->prefix($mydirname."_topics") ) ;
	while( list( $topic_id ) = $db->fetchRow( $result ) ) {
		d3forum_sync_topic( $mydirname , $topic_id , false ) ;
	}
	// sync all forums
	$result = $db->query( "SELECT forum_id FROM ".$db->prefix($mydirname."_forums") ) ;
	while( list( $forum_id ) = $db->fetchRow( $result ) ) {
		d3forum_sync_forum( $mydirname , $forum_id , false ) ;
	}
	// sync all categories
	$result = $db->query( "SELECT cat_id FROM ".$db->prefix($mydirname."_categories") ) ;
	while( list( $cat_id ) = $db->fetchRow( $result ) ) {
		d3forum_sync_category( $mydirname , $cat_id ) ;
	}
	// rebuild category's tree
	d3forum_sync_cattree( $mydirname ) ;

	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?mode=admin&page=advanced_admin" , 3 , _MD_A_D3FORUM_MSG_SYNCALLTABLESDONE ) ;
	exit ;
}


if( ! empty( $_POST['do_import'] ) && ! empty( $_POST['import_mid'] ) ) {
	set_time_limit( 0 ) ;

	if ( ! $xoopsGTicket->check( true , 'd3forum_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$import_mid = intval( @$_POST['import_mid'] ) ;
	if( empty( $importable_modules[ $import_mid ] ) ) die( _MD_A_D3FORUM_ERR_INVALIDMID ) ;
	list( $fromtype , ) = explode( ':' , $importable_modules[ $import_mid ] ) ;
	switch( $fromtype ) {
		case 'newbb1' :
			d3forum_import_from_newbb1( $mydirname , $import_mid ) ;
			break ;
		case 'xhnewbb' :
			d3forum_import_from_xhnewbb( $mydirname , $import_mid ) ;
			break ;
		case 'd3forum' :
			d3forum_import_from_d3forum( $mydirname , $import_mid ) ;
			break ;
	}

	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?mode=admin&page=advanced_admin" , 3 , _MD_A_D3FORUM_MSG_IMPORTDONE ) ;
	exit ;
}


//
// form stage
//

//
// display stage
//

xoops_cp_header();
include dirname(__FILE__).'/mymenu.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'import_from_options' => $importable_modules ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'd3forum_admin') ,
) ) ;
$tpl->display( 'db:'.$mydirname.'_admin_advanced_admin.html' ) ;
xoops_cp_footer();

?>