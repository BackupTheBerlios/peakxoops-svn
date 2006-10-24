<?php

$topic_id = intval( @$_GET['topic_id'] ) ;

// get&check this topic ($topic4assign, $topic_row, $forum_id), count topic_view up, get $prev_topic, $next_topic
include dirname(__FILE__).'/process_this_topic.inc.php' ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
include dirname(__FILE__).'/process_this_forum.inc.php' ;

// get&check this category ($category4assign, $category_row), override options
include dirname(__FILE__).'/process_this_category.inc.php' ;

// post order
switch( $postorder ) {
	case 3 :
		$postorder4sql = 'post_id DESC' ;
		break ;
	case 2 :
		$postorder4sql = 'post_id' ;
		break ;
	case 1 :
		$postorder4sql = 'order_in_tree DESC,post_id DESC' ;
		break ;
	case 0 :
	default :
		$postorder4sql = 'order_in_tree,post_id' ;
		break ;
}

// posts loop
$max_post_time = 0 ;
$last_post_offset = 0 ;
$posts = array() ;
$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_posts")." WHERE topic_id=$topic_id ORDER BY $postorder4sql" ;
if( ! $prs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
while( $post_row = $xoopsDB->fetchArray( $prs ) ) {

	// get poster's information ($poster_*), $can_reply, $can_edit, $can_delete
	include dirname(__FILE__).'/process_eachpost.inc.php' ;

	// get row of last_post
	if( $post_row['post_time'] > $max_post_time ) $last_post_offset = sizeof( $posts ) ;

	// posts array
	$posts[] = array(
		'id' => intval( $post_row['post_id'] ) ,
		'subject' => $myts->makeTboxData4Show( $post_row['subject'] , $post_row['number_entity'] , $post_row['special_entity'] ) ,
		'pid' => intval( $post_row['pid'] ),
		'post_time' => intval( $post_row['post_time'] ) ,
		'post_time_formatted' => formatTimestamp( $post_row['post_time'] , 'm' ) ,
		'modified_time' => intval( $post_row['modified_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $post_row['modified_time'] , 'm' ) ,
		'poster_uid' => intval( $post_row['uid'] ) ,
		'poster_uname' => $poster_uname4disp ,
		'poster_ip' => htmlspecialchars( $post_row['poster_ip'] , ENT_QUOTES ) ,
		'poster_rank_title' => $poster_rank_title4disp ,
		'poster_rank_image' => $poster_rank_image4disp ,
		'poster_is_online' => $poster_is_online ,
		'poster_avatar' => $poster_avatar ,
		'poster_posts_count' => $poster_posts_count ,
		'poster_regdate' => $poster_regdate ,
		'poster_regdate_formatted' => formatTimestamp( $poster_regdate , 's' ) ,
		'poster_from' => $poster_from4disp ,
		'modifier_ip' => htmlspecialchars( $post_row['poster_ip'] , ENT_QUOTES ) ,
		'html' => intval( $post_row['html'] ) ,
		'smiley' => intval( $post_row['smiley'] ) ,
		'br' => intval( $post_row['br'] ) ,
		'xcode' => intval( $post_row['xcode'] ) ,
		'icon' => intval( $post_row['icon'] ) ,
		'attachsig' => intval( $post_row['attachsig'] ) ,
		'signature' => $signature4disp ,
		'invisible' => intval( $post_row['invisible'] ) ,
		'hide_uid' => intval( $post_row['hide_uid'] ) ,
		'depth_in_tree' => intval( $post_row['depth_in_tree'] ) ,
		'order_in_tree' => intval( $post_row['order_in_tree'] ) ,
		'unique_path' => htmlspecialchars( substr( $post_row['unique_path'] , 1 ) , ENT_QUOTES ) ,
		'votes_count' => intval( $post_row['votes_count'] ) ,
		'votes_sum' => intval( $post_row['votes_sum'] ) ,
		'votes_avg' => round( $post_row['votes_sum'] / ( $post_row['votes_count'] - 0.0000001 ) , 2 ) ,
		'past_vote' => -1 , // TODO
		'guest_name' => $myts->makeTboxData4Show( $post_row['guest_name'] ) ,
		'guest_email' => $myts->makeTboxData4Show( $post_row['guest_email'] ) ,
		'guest_url' => $myts->makeTboxData4Show( $post_row['guest_url'] ) ,
		'guest_trip' => $myts->makeTboxData4Show( $post_row['guest_trip'] ) ,
		'post_text' => $myts->displayTarea( $post_row['post_text'] , $post_row['html'] , $post_row['smiley'] , $post_row['xcode'] , $xoopsModuleConfig['allow_textimg'] , $post_row['br'] , 0 , $post_row['number_entity'] , $post_row['special_entity'] ) ,
		'post_text_raw' => $post_row['post_text'] , // caution
		'can_edit' => $can_edit ,
		'can_delete' => $can_delete ,
		'can_reply' => $can_reply ,
		'can_vote' => $can_vote ,
	) ;
}

// rebuild tree informations
$posts = d3forum_make_treeinformations( $posts ) ;

// reassign last_post informations
$topic4assign['last_post_subject'] = @$posts[ $last_post_offset ]['subject'] ;
$topic4assign['last_post_uname'] = @$posts[ $last_post_offset ]['poster_uname'] ;

$xoopsOption['template_main'] = $mydirname.'_main_listposts.html' ;
include XOOPS_ROOT_PATH.'/header.php' ;
$xoopsTpl->assign(
	array(
		'category' => $category4assign ,
		'forum' => $forum4assign ,
		'topic' => $topic4assign ,
		'next_topic' => $next_topic4assign ,
		'prev_topic' => $prev_topic4assign ,
		'posts' => $posts ,
		'page' => 'listposts' ,
		'ret_id' => 'topic_id' ,
		'ret_val' => $topic_id ,
		'xoops_pagetitle' => $topic4assign['title'] ,
	)
) ;


/* 

// 順番とビューモードの実装

if( is_object( $xoopsUser ) ) {
	$uid = $xoopsUser->getVar('uid') ;
	$viewmode = $viewmode ? $viewmode : $xoopsUser->getVar('umode') ;
	$uorder = $xoopsUser->getVar('uorder') == 1 ? 'DESC' : 'ASC' ;
	$order = $order ? $order : $uorder ;
} else {
	$uid = 0 ;
}

// topic mark on/off 処理

// ページ分割処理は不要・むしろ各フォーラム毎に投稿数上限を設定可とする

*/
?>