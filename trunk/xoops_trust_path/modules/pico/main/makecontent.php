<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

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
	$content_id = pico_makecontent( $mydirname , $cat_id ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?content_id=$content_id" , 2 , _MD_PICO_MSG_CONTENTMADE ) ;
	exit ;
}


// FORM PART
if( isset( $_POST['contentman_preview'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	$content = pico_get_requests4content( $mydirname ) ;
	$content4assign = array_map( 'htmlspecialchars' , $content ) ;
	$content4assign['filter_infos'] = pico_get_filter_infos( $content['filters'] ) ;
	$content4assign['body_raw'] = $content['body'] ;
	$preview4assign = array(
		'htmlheader' => $content['htmlheader'] ,
		'subject' => $myts->makeTboxData4Show( $content['subject'] ) ,
		'body' => pico_filter_body( $mydirname , $content['body'] , $content['filters'] , 0 ) ,
	) ;
} else {
	$content4assign = array(
		'id' => 0 ,
		'subject' => '' ,
		'htmlheader' => '' ,
		'body' => '' ,
		'body_raw' => '' ,
		'filters' => $xoopsModuleConfig['filters'] ,
		'filter_infos' => pico_get_filter_infos( $xoopsModuleConfig['filters'] ) ,
		'weight' => 0 ,
		'use_cache' => 1 ,
		'visible' => 1 ,
	) ;
}

// WYSIWYG (some editor needs global scope ... orz)
$pico_wysiwygs = array( 'name' => 'body' , 'value' => $content4assign['body_raw'] ) ;
include dirname(dirname(__FILE__)).'/include/wysiwyg_editors.inc.php' ;

$xoopsOption['template_main'] = $mydirname.'_main_content_form.html' ;
include XOOPS_ROOT_PATH."/header.php";

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
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />\n" . @$xoopsModuleConfig['htmlheader'] . "\n" . @$preview4assign['htmlheader'] . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) . "\n" . @$pico_wysiwyg_header ,
	'xoops_pagetitle' => _MD_PICO_CONTENTMANAGER ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>