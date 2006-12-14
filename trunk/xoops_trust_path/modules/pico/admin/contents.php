<?php

require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;
$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

// get $cat_id
$cat_id = intval( @$_GET['cat_id'] ) ;
list( $cat_id , $cat_title ) = $db->fetchRow( $db->query( "SELECT cat_id,cat_title FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=$cat_id" ) ) ;
if( empty( $cat_id ) ) {
	$cat_id = 0 ;
	$cat_title = _MD_PICO_TOP ;
}


//
// transaction stage
//

// contents update
if( ! empty( $_POST['contents_update'] ) && ! empty( $_POST['weights'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	foreach( $_POST['weights'] as $content_id => $weight ) {
		$content_id = intval( $content_id ) ;
		$weight = intval( $weight ) ;
		$visible = empty( $_POST['visibles'][$content_id] ) ? 0 : 1 ;
		$show_in_navi = empty( $_POST['show_in_navis'][$content_id] ) ? 0 : 1 ;
		$show_in_menu = empty( $_POST['show_in_menus'][$content_id] ) ? 0 : 1 ;
		$allow_comment = empty( $_POST['allow_comments'][$content_id] ) ? 0 : 1 ;
		$db->query( "UPDATE ".$db->prefix($mydirname."_contents")." SET weight=$weight,visible=$visible,show_in_navi=$show_in_navi,show_in_menu=$show_in_menu,allow_comment=$allow_comment WHERE content_id=$content_id" ) ;
	}

	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=contents&amp;cat_id=$cat_id" , 3 , _MD_PICO_MSG_UPDATED ) ;
	exit ;
}

// contents move
if( ! empty( $_POST['contents_move'] ) && ! empty( $_POST['action_selects'] ) && isset( $_POST['dest_cat_id'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	// cat_id check
	$dest_cat_id = intval( $_POST['dest_cat_id'] ) ;
	if( $dest_cat_id !== 0 ) {
		list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=$dest_cat_id" ) ) ;
		if( empty( $count ) ) die( _MD_PICO_ERR_READCATEGORY ) ;
	}

	foreach( $_POST['action_selects'] as $content_id => $value ) {
		if( empty( $value ) ) continue ;
		$content_id = intval( $content_id ) ;
		$db->query( "UPDATE ".$db->prefix($mydirname."_contents")." SET cat_id=$dest_cat_id WHERE content_id=$content_id" ) ;
	}

	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=contents&amp;cat_id=$cat_id" , 3 , _MD_A_PICO_MSG_CONTENTSMOVED ) ;
	exit ;
}


//
// form stage
//

// create jump box options as array
$crs = $db->query( "SELECT cat_id,cat_title,cat_depth_in_tree FROM ".$db->prefix($mydirname."_categories")." ORDER BY cat_order_in_tree" ) ;
$cat_options = array( 0 => _MD_PICO_TOP ) ;
while( list( $id , $title , $depth ) = $db->fetchRow( $crs ) ) {
	$cat_options[ $id ] = str_repeat( '--' , $depth ) . htmlspecialchars( $title , ENT_QUOTES ) ;
}

// fetch contents
$ors = $db->query( "SELECT o.*,up.uname AS poster_uname,um.uname AS modifier_uname  FROM ".$db->prefix($mydirname."_contents")." o LEFT JOIN ".$db->prefix("users")." up ON o.poster_uid=up.uid LEFT JOIN ".$db->prefix("users")." um ON o.modifier_uid=um.uid WHERE cat_id='$cat_id' ORDER BY o.weight,o.content_id" ) ;
$contents4assign = array() ;
while( $content_row = $db->fetchArray( $ors ) ) {
	$content4assign = array(
		'id' => intval( $content_row['content_id'] ) ,
		'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
		'poster_uname' => $myts->makeTboxData4Show( $content_row['poster_uname'] ) ,
		'modifier_uname' => $myts->makeTboxData4Show( $content_row['modifier_uname'] ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
	) ;
	$contents4assign[] = $content4assign + $content_row ;
}


//
// display stage
//

xoops_cp_header();
include dirname(__FILE__).'/mymenu.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_name' => $xoopsModule->getVar('name') ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'cat_id' => $cat_id ,
	'cat_title' => htmlspecialchars( $cat_title , ENT_QUOTES ) ,
	'cat_options' => $cat_options ,
	'contents' => $contents4assign ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'pico_admin') ,
) ) ;
$tpl->display( 'db:'.$mydirname.'_admin_contents.html' ) ;
xoops_cp_footer();

?>