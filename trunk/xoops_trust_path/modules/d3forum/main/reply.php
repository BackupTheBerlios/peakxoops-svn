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

// check post permission
if( empty( $can_post ) ) die( _MD_D3FORUM_ERR_POSTFORUM ) ;

// check reply permission
if( ! $isadminormod && ( $post_row['invisible'] || ! $post_row['approval'] ) ) {
	die( _MD_D3FORUM_ERR_REPLYPOST ) ;
}

// references to post reply
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

// specific variables for reply
$pid = $post_row['post_id'] ;
$post_id = 0 ;
$subject4html = substr( $reference_subject4html , 0 , 3 ) == 'Re:' ? $reference_subject4html : 'Re: ' . $reference_subject4html ;
$message4html = '' ;
$topic_id = $topic_row['topic_id'] ;
$u2t_marked = intval( $topic_row['u2t_marked'] ) ;
$solved = intval( $topic_row['topic_solved'] ) ;
$hide_uid = 0 ;
$invisible = 0 ;
$approval = 1 ;

$quote4html = "[quote sitecite=modules/".$mydirname."/index.php?post_id=".$pid."]\n".sprintf(_MD_D3FORUM_USERWROTE,$reference_name4html)."\n".$myts->makeTareaData4Edit( $post_row['post_text'] , $post_row['number_entity'] )."[/quote]";
$formTitle = _MD_D3FORUM_POSTREPLY ;
$mode = 'reply' ;

include dirname(dirname(__FILE__)).'/include/display_post_form.inc.php' ;

?>