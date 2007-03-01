<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

$forum_id = intval( @$_GET['forum_id'] ) ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
if( ! include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ) die( _MD_D3FORUM_ERR_READFORUM ) ;

// get&check this category ($category4assign, $category_row), override options
if( ! include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ) die( _MD_D3FORUM_ERR_READCATEGORY ) ;

// special check for forummanager
if( ! $isadminormod ) die( _MD_D3FORUM_ERR_MODERATEFORUM ) ;

// TRANSACTION PART
require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
if( isset( $_POST['forumman_post'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'd3forum' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	// options, weight and external_link_format can be modified only by admin
	if( ! $isadmin ) {
		$_POST['options'] = '' ;
		$_POST['weight'] = 0 ;
		$_POST['external_link_format'] = '' ;
	}

	d3forum_updateforum( $mydirname , $forum_id , $isadmin ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?forum_id=$forum_id" , 2 , _MD_D3FORUM_MSG_FORUMUPDATED ) ;
	exit ;
}
if( isset( $_POST['forumman_delete'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'd3forum' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	d3forum_delete_forum( $mydirname , $forum_id ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?cat_id=$cat_id" , 2 , _MD_D3FORUM_MSG_FORUMDELETED ) ;
	exit ;
}

// FORM PART

include dirname(dirname(__FILE__)).'/include/constant_can_override.inc.php' ;
$options4html = '' ;
$forum_configs = @unserialize( $forum_row['forum_options'] ) ;
if( is_array( $forum_configs ) ) foreach( $forum_configs as $key => $val ) {
	if( isset( $d3forum_configs_can_be_override[ $key ] ) ) {
		$options4html .= htmlspecialchars( $key , ENT_QUOTES ) . ':' . htmlspecialchars( $val , ENT_QUOTES ) . "\n" ;
	}
}

$forum4assign = array(
	'id' => $forum_id ,
	'title' => htmlspecialchars( $forum_row['forum_title'] , ENT_QUOTES ) ,
	'weight' => intval( $forum_row['forum_weight'] ) ,
	'external_link_format' => htmlspecialchars( $forum_row['forum_external_link_format'] , ENT_QUOTES ) ,
	'desc' => htmlspecialchars( $forum_row['forum_desc'] , ENT_QUOTES ) ,
	'options' => $options4html ,
	'option_desc' => nl2br( htmlspecialchars( implode( "\n" , array_keys( $d3forum_configs_can_be_override ) ) , ENT_QUOTES ) ) ,
) ;


// dare to set 'template_main' after header.php (for disabling cache)
include XOOPS_ROOT_PATH."/header.php";
$xoopsOption['template_main'] = $mydirname.'_main_forum_form.html' ;

$xoopsTpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'category' => $category4assign ,
	'forum' => $forum4assign ,
	'page' => 'forummanager' ,
	'formtitle' => _MD_D3FORUM_LINK_FORUMMANAGER ,
	'cat_jumpbox_options' => d3forum_make_cat_jumpbox_options( $mydirname , $whr_read4cat , $cat_id ) ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'd3forum') ,
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	'xoops_pagetitle' => _MD_D3FORUM_FORUMMANAGER ,
	'xoops_breadcrumbs' => array_merge( $xoops_breadcrumbs , array( array( 'name' => _MD_D3FORUM_FORUMMANAGER ) ) ) ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>