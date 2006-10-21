<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php';
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

$post_id = intval( @$_GET['post_id'] ) ;

// get this "post" from given $post_id
$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_posts")." WHERE post_id=$post_id" ;
if( ! $prs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
if( $xoopsDB->getRowsNum( $prs ) <= 0 ) die( _MD_D3FORUM_ERR_READPOST ) ;
$post_row = $xoopsDB->fetchArray( $prs ) ;
$topic_id = intval( $post_row['topic_id'] ) ;

// get&check this topic ($topic4assign, $topic_row, $forum_id), count topic_view up, get $prev_topic, $next_topic
include dirname(dirname(__FILE__)).'/include/process_this_topic.inc.php' ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ;

// get&check this category ($category4assign, $category_row), override options
include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// check delete permission
if( empty( $can_delete ) ) die( _MD_D3FORUM_ERR_DELETEPOST ) ;

// count children
include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
$mytree = new XoopsTree( $xoopsDB->prefix($mydirname."_posts") , "post_id" , "pid" ) ;
$children = $mytree->getAllChildId( $post_id ) ;

// special permission check for delete
if( ! $uid ) {
	// guest delete (TODO)
	die( _MD_D3FORUM_DELNOTALLOWED ) ;
} else if( $isadminormod ) {
	// admin delete
	// ok
} else if( $uid == $post_id && $xoopsModuleConfig['selfdellimit'] > 0 ) {
	// self delete
	if( time() < $post_row['post_time'] + intval( $xoopsModuleConfig['selfdellimit'] ) ) {
		// before time limit
		if( count( $children ) > 0 ) {
			// child(ren) exist(s)
			redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 2 , _MD_D3FORUM_DELCHILDEXISTS ) ;
			exit ;
		} else {
			// all green for self delete
		}
	} else {
		// after time limit
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 2 , _MD_D3FORUM_DELTIMELIMITED ) ;
		exit ;
	}
} else {
	// no perm
	die( _MD_D3FORUM_DELNOTALLOWED ) ;
}


if( ! empty( $_POST['deletepostsok'] ) ) {
	// TRANSACTION PART
	if ( ! $xoopsGTicket->check( true , 'd3forum' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
	d3forum_delete_post_recursive( $mydirname , $post_id ) ;
	d3forum_sync_topic( $mydirname , $topic_id ) ;

	if( $topic_row['topic_first_post_id'] == $post_id ) {
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php?forum_id=$forum_id" , 2 , _MD_D3FORUM_MSG_POSTSDELETED ) ;
		exit ;
	} else {
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php?topic_id=$topic_id" , 2 , _MD_D3FORUM_MSG_POSTSDELETED ) ;
		exit ;
	}

} else {
	// FORM PART

	// references to confirm the post will be deleted
	$reference_message4html = $myts->displayTarea( $post_row['post_text'] , $post_row['html'] , $post_row['smiley'] , $post_row['xcode'] , $xoopsModuleConfig['allow_textimg'] , $post_row['br'] , 0 , $post_row['number_entity'] , $post_row['special_entity'] ) ;
	$reference_time = intval( $post_row['post_time'] ) ;
	if( ! empty( $post_row['guest_name'] ) ) {
		$reference_name4html = htmlspecialchars( $post_row['guest_name'] , ENT_QUOTES ) ;
	} else if( $post_row['uid'] && empty( $post_row['hide_uid'] ) ) {
		$reference_name4html = XoopsUser::getUnameFromId( $post_row['uid'] ) ;
	} else {
		$reference_name4html = $xoopsModuleConfig['anonymous_name'] ;
	}
	$reference_subject4html = $myts->makeTboxData4Show( $post_row['subject'] , $post_row['number_entity'] , $post_row['special_entity'] ) ;

	// dare to set 'template_main' after header.php (for disabling cache)
	include XOOPS_ROOT_PATH."/header.php";
	$xoopsOption['template_main'] = $mydirname.'_main_delete.html' ;

	$xoopsTpl->assign( array(
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
		'mod_config' => $xoopsModuleConfig ,
		'mode' => 'delete' ,
		'post_id' => $post_id ,
		'reference_subject' => @$reference_subject4html ,
		'reference_message' => @$reference_message4html ,
		'reference_name' => @$reference_name4html ,
		'reference_time' => @$reference_time ,
		'reference_time_formatted' => formatTimestamp( @$reference_time , 'm' ) ,
		'children_count' => count( $children ) ,
		'category' => $category4assign ,
		'forum' => $forum4assign ,
		'topic' => $topic4assign ,
		'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'd3forum') ,
		'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
		'xoops_pagetitle' => _DELETE ,
	) ) ;

	include XOOPS_ROOT_PATH.'/footer.php';
}

?>