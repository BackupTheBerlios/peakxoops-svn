<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

// get $content_id
$content_id = isset( $_POST['content_id'] ) ? intval( $_POST['content_id'] ) : intval( @$_GET['content_id'] ) ;

// get and process $cat_id
$cat_id = pico_get_cat_id_from_content_id( $mydirname , $content_id ) ;

// get&check this category ($category4assign, $category_row), override options
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// special check for contentmanager
if( ! $category4assign['can_edit'] && ! $category4assign['can_delete'] ) die( _MD_PICO_ERR_EDITCONTENT ) ;

// TRANSACTION PART
require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
if( isset( $_POST['contentman_post'] ) && $category4assign['can_edit'] ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	// update the content
	pico_updatecontent( $mydirname , $content_id ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?content_id=$content_id" , 2 , _MD_PICO_MSG_CONTENTUPDATED ) ;
	exit ;
}
if( isset( $_POST['contentman_delete'] ) && $category4assign['can_delete'] ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	pico_delete_content( $mydirname , $content_id ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?cat_id=".intval($cat_row['cat_id']) , 2 , _MD_PICO_MSG_CONTENTDELETED ) ;
	exit ;
}

// FORM PART
if( isset( $_POST['contentman_preview'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	$content = pico_get_requests4content( $mydirname ) ;
	$content4assign = array_map( 'htmlspecialchars' , $content ) ;
	$content4assign['id'] = $content_id ;
	$content4assign['filter_infos'] = pico_get_filter_infos( $content['filters'] ) ;
	$content4assign['body_raw'] = $content['body'] ;

	$preview4assign = array(
		'htmlheader' => $content['htmlheader'] ,
		'subject' => $myts->makeTboxData4Show( $content['subject'] ) ,
		'body' => pico_filter_body( $mydirname , $content['body'] , $content['filters'] , 0 ) ,
	) ;
} else {
	$sql = "SELECT * FROM ".$db->prefix($mydirname."_contents")." o WHERE content_id='$content_id'" ;
	if( ! $ors = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
	if( $db->getRowsNum( $ors ) <= 0 ) {
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php" , 2 , _MD_PICO_ERR_READCONTENT ) ;
		exit ;
	}
	$content_row = $db->fetchArray( $ors ) ;
	$content4assign = array(
		'cat_id' => intval( $content_row['cat_id'] ) ,
		'id' => intval( $content_row['content_id'] ) ,
		'subject' => htmlspecialchars( $content_row['subject'] , ENT_QUOTES ) ,
		'htmlheader' => htmlspecialchars( $content_row['htmlheader'] , ENT_QUOTES ) ,
		'body' => htmlspecialchars( $content_row['body'] , ENT_QUOTES ) ,
		'body_raw' => $content_row['body'] ,
		'filters' => htmlspecialchars( $content_row['filters'] , ENT_QUOTES ) ,
		'filter_infos' => pico_get_filter_infos( $content_row['filters'] ) ,
		'weight' => intval( $content_row['weight'] ) ,
		'use_cache' => intval( $content_row['use_cache'] ) ,
		'visible' => intval( $content_row['visible'] ) ,
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
	'page' => 'contentmanager' ,
	'formtitle' => _MD_PICO_LINK_EDITCONTENT ,
	'cat_jumpbox_options' => pico_make_cat_jumpbox_options( $mydirname , $whr_read4cat , $cat_id ) ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'pico') ,
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />\n" . @$xoopsModuleConfig['htmlheader'] . "\n" . @$preview4assign['htmlheader'] . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) . "\n" . @$pico_wysiwyg_header ,
	'xoops_pagetitle' => _MD_PICO_CONTENTMANAGER ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>