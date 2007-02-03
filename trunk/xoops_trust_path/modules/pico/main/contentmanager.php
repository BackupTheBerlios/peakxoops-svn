<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

$xoopsOption['template_main'] = $mydirname.'_main_content_form.html' ;
include XOOPS_ROOT_PATH."/header.php";

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
	pico_updatecontent( $mydirname , $content_id , $category4assign['post_auto_approved'] , $category4assign['isadminormod'] ) ;
	if( $category4assign['post_auto_approved'] ) {
		redirect_header( XOOPS_URL."/modules/$mydirname/".pico_make_content_link4html( $xoopsModuleConfig , $content_id , $mydirname ) , 2 , _MD_PICO_MSG_CONTENTUPDATED ) ;
	} else {
		// Notify for new waiting content (only for admin or mod)
		$users2notify = pico_get_moderators( $mydirname , $cat_id ) ;
		if( empty( $users2notify ) ) $users2notify = array( 0 ) ;
		pico_trigger_event( 'global' , 0 , 'waitingcontent' , array( 'CONTENT_URL' => XOOPS_URL."/modules/$mydirname/index.php?page=contentmanager&content_id=$content_id" ) , $users2notify ) ;
		redirect_header( XOOPS_URL."/modules/$mydirname/".pico_make_content_link4html( $xoopsModuleConfig , $content_id , $mydirname ) , 2 , _MD_PICO_MSG_CONTENTWAITINGUPDATE ) ;
	}
	exit ;
}
if( isset( $_POST['contentman_copyfromwaiting'] ) && $category4assign['isadminormod'] ) {
	if ( ! $xoopsGTicket->check( true , 'pico' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	// copy from waiting eg) body_waiting -> body
	pico_copyfromwaitingcontent( $mydirname , $content_id ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/".pico_make_content_link4html( $xoopsModuleConfig , $content_id , $mydirname ) , 2 , _MD_PICO_MSG_CONTENTUPDATED ) ;
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
	$content = pico_get_requests4content( $mydirname , $category4assign['post_auto_approved'] , $category4assign['isadminormod'] ) ;
	$content4assign = array_map( 'htmlspecialchars' , $content ) ;
	$content4assign['id'] = $content_id ;
	$content4assign['filter_infos'] = pico_get_filter_infos( $content['filters'] , $category4assign['isadminormod'] ) ;
	$content4assign['body_raw'] = $content['body'] ;

	$preview4assign = array(
		'htmlheader' => $content['htmlheader'] ,
		'subject' => $myts->makeTboxData4Show( $content['subject'] ) ,
		'body' => pico_filter_body( $mydirname , $content + array('content_id'=>0) ) ,
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
		'vpath' => htmlspecialchars( $content_row['vpath'] , ENT_QUOTES ) ,
		'subject' => htmlspecialchars( $content_row['subject'] , ENT_QUOTES ) ,
		'subject_waiting' => htmlspecialchars( $content_row['subject_waiting'] , ENT_QUOTES ) ,
		'htmlheader' => htmlspecialchars( $content_row['htmlheader'] , ENT_QUOTES ) ,
		'htmlheader_waiting' => htmlspecialchars( $content_row['htmlheader_waiting'] , ENT_QUOTES ) ,
		'body' => htmlspecialchars( $content_row['body'] , ENT_QUOTES ) ,
		'body_waiting' => htmlspecialchars( $content_row['body_waiting'] , ENT_QUOTES ) ,
		'body_raw' => $content_row['body'] ,
		'filters' => htmlspecialchars( $content_row['filters'] , ENT_QUOTES ) ,
		'filter_infos' => pico_get_filter_infos( $content_row['filters'] , $category4assign['isadminormod'] ) ,
		'weight' => intval( $content_row['weight'] ) ,
		'use_cache' => intval( $content_row['use_cache'] ) ,
		'visible' => intval( $content_row['visible'] ) ,
		'show_in_navi' => intval( $content_row['show_in_navi'] ) ,
		'show_in_menu' => intval( $content_row['show_in_menu'] ) ,
		'allow_comment' => intval( $content_row['allow_comment'] ) ,
	) ;
	$content4assign += $content_row ;
}

// WYSIWYG (some editor needs global scope ... orz)
$pico_wysiwygs = array( 'name' => 'body' , 'value' => $content4assign['body_raw'] ) ;
include dirname(dirname(__FILE__)).'/include/wysiwyg_editors.inc.php' ;

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
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".str_replace('{mod_url}',XOOPS_URL.'/modules/'.$mydirname,$xoopsModuleConfig['css_uri'])."\" />\n" . @$xoopsModuleConfig['htmlheader'] . "\n" . @$preview4assign['htmlheader'] . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) . "\n" . @$pico_wysiwyg_header ,
	'xoops_pagetitle' => _MD_PICO_CONTENTMANAGER ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>