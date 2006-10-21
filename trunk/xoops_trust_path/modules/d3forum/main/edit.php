<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;

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

// get $post4assign
include dirname(dirname(__FILE__)).'/include/process_this_post.inc.php' ;

// check edit permission
if( empty( $can_edit ) ) die( _MD_D3FORUM_ERR_EDITPOST ) ;

// check edit permission
if( ! $uid ) {
	// guest edit (TODO)
	die( _MD_D3FORUM_ERR_EDITPOST ) ;
} else {
	// user edit
	if( ! $isadminormod && ( $post_row['uid'] != $xoopsUser->getVar('uid') || time() >= $post_row['post_time'] + $xoopsModuleConfig['selfeditlimit'] ) ) die( _MD_D3FORUM_ERR_EDITPOST ) ;
}

// specific variables for edit
$id = intval( $post_row['pid'] ) ;
$post_id = intval( $post_row['post_id'] ) ;
$subject4html = $myts->makeTboxData4Edit( $post_row['subject'] , $post_row['number_entity'] ) ;
$message4html = $myts->makeTareaData4Edit( $post_row['post_text'] , $post_row['number_entity'] ) ;
$topic_id = intval( $topic_row['topic_id'] ) ;
$u2t_marked = intval( $topic_row['u2t_marked'] ) ;
$solved = intval( $topic_row['topic_solved'] ) ;
$html = intval( $post_row['html'] ) ;
$smiley = intval( $post_row['smiley'] ) ;
$xcode = intval( $post_row['xcode'] ) ;
$br = intval( $post_row['br'] ) ;
$number_entity = intval( $post_row['number_entity'] ) ;
$special_entity = intval( $post_row['special_entity'] ) ;
$icon = intval( $post_row['icon'] ) ;
$hide_uid = intval( $post_row['hide_uid'] ) ;
$invisible = intval( $post_row['invisible'] ) ;
$approval = intval( $post_row['approval'] ) ;
$attachsig = intval( $post_row['attachsig'] ) ;
$guest_name4html = $myts->makeTboxData4Edit( $post_row['guest_name'] ) ;
$guest_email4html = $myts->makeTboxData4Edit( $post_row['guest_email'] ) ;
$guest_url4html = $myts->makeTboxData4Edit( $post_row['guest_url'] ) ;
$guest_pass4html = '' ;

$formTitle = _MD_D3FORUM_EDITMODEC ;
$mode = 'edit' ;

include dirname(dirname(__FILE__)).'/include/display_post_form.inc.php' ;

?>