<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

// redirect with POST as SESSION when wraps mode's preview
if( $xoopsModuleConfig['use_wraps_mode'] && ! empty( $_POST['contentman_preview'] ) && empty( $_SESSION[$mydirname.'_preview'] ) ) {
	$link = empty( $_POST['vpath'] ) ? sprintf( _MD_PICO_AUTONAME4SPRINTF , 0 ) : preg_replace( '#[^0-9a-zA-Z_/.+-]#' , '' , $_POST['vpath'] ) ;
	$_SESSION[$mydirname.'_preview'] = $_POST ;
	header( 'Location: '.XOOPS_URL.'/modules/'.$mydirname.'/index.php'.$link.'?page=makecontent' ) ;
	exit ;
}
if( ! empty( $_SESSION[$mydirname.'_preview'] ) ) {
	$_POST = $_SESSION[$mydirname.'_preview'] ;
	unset( $_SESSION[$mydirname.'_preview'] ) ;
}

$xoopsOption['template_main'] = $mydirname.'_main_content_form.html' ;
include XOOPS_ROOT_PATH."/header.php";

$cat_id = isset( $_POST['cat_id'] ) ? intval( $_POST['cat_id'] ) : intval( @$_GET['cat_id'] ) ;

// get&check this category ($category4assign, $category_row), override options
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// special check for makecontent
if( ! $category4assign['can_post'] ) die( _MD_PICO_ERR_CREATECONTENT ) ;

// TRANSACTION PART
require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
if( isset( $_POST['contentman_post'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	// create a content
	$content_id = pico_makecontent( $mydirname , $category4assign['post_auto_approved'] , $category4assign['isadminormod'] ) ;
	if( $category4assign['post_auto_approved'] ) {
		redirect_header( XOOPS_URL."/modules/$mydirname/".pico_make_content_link4html( $xoopsModuleConfig , $content_id , $mydirname ) , 2 , _MD_PICO_MSG_CONTENTUPDATED ) ;
	} else {
		// Notify for new waiting content (only for admin or mod)
		$users2notify = pico_get_moderators( $mydirname , $cat_id ) ;
		if( empty( $users2notify ) ) $users2notify = array( 0 ) ;
		pico_trigger_event( 'global' , 0 , 'waitingcontent' , array( 'CONTENT_URL' => XOOPS_URL."/modules/$mydirname/index.php?page=contentmanager&content_id=$content_id" ) , $users2notify ) ;
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php" , 2 , _MD_PICO_MSG_CONTENTWAITINGREGISTER ) ;
	}
	exit ;
}


// FORM PART
if( isset( $_POST['contentman_preview'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	$content = pico_get_requests4content( $mydirname , $category4assign['post_auto_approved'] , $category4assign['isadminormod'] ) ;
	$content4assign = array_map( 'htmlspecialchars_ent' , $content ) ;
	$content4assign['filter_infos'] = pico_get_filter_infos( $content['filters'] , $category4assign['isadminormod'] ) ;
	$content4assign['body_raw'] = $content['body'] ;
	$preview4assign = array(
		'htmlheader' => $content['htmlheader'] ,
		'subject' => $myts->makeTboxData4Show( $content['subject'] ) ,
		'body' => pico_filter_body( $mydirname , $content + array('content_id'=>0) ) ,
	) ;
} else {
	$content4assign = array(
		'id' => 0 ,
		'vpath' => '' ,
		'subject' => '' ,
		'htmlheader' => '' ,
		'body' => '' ,
		'body_raw' => '' ,
		'filters' => $xoopsModuleConfig['filters'] ,
		'filter_infos' => pico_get_filter_infos( $xoopsModuleConfig['filters'] , $category4assign['isadminormod'] ) ,
		'weight' => 0 ,
		'use_cache' => 1 ,
		'visible' => 1 ,
		'show_in_navi' => 1 ,
		'show_in_menu' => 1 ,
		'allow_comment' => 1 ,
		'approval' => $category4assign['post_auto_approved'] ,
	) ;
}

// WYSIWYG (some editor needs global scope ... orz)
$pico_wysiwygs = array( 'name' => 'body' , 'value' => $content4assign['body_raw'] ) ;
include dirname(dirname(__FILE__)).'/include/wysiwyg_editors.inc.php' ;

// assign
$xoopsTpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'category' => $category4assign ,
	'content' => $content4assign ,
	'body_wysiwyg' => @$pico_wysiwyg_body ,
	'preview' => @$preview4assign ,
	'page' => 'makecontent' ,
	'formtitle' => _MD_PICO_LINK_MAKECONTENT ,
	'cat_jumpbox_options' => pico_make_cat_jumpbox_options( $mydirname , $whr_read4cat , $cat_id ) ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'pico') ,
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".str_replace('{mod_url}',XOOPS_URL.'/modules/'.$mydirname,$xoopsModuleConfig['css_uri'])."\" />\n" . @$xoopsModuleConfig['htmlheader'] . "\n" . @$preview4assign['htmlheader'] . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) . "\n" . @$pico_wysiwyg_header ,
	'xoops_pagetitle' => _MD_PICO_LINK_MAKECONTENT ,
	'xoops_breadcrumbs' => array_merge( $xoops_breadcrumbs , array( array( 'name' => _MD_PICO_LINK_MAKECONTENT ) ) ) ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>