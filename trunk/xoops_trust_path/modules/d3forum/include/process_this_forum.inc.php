<?php

// get this "forum" from given $forum_id
$sql = "SELECT * FROM ".$db->prefix($mydirname."_forums")." f WHERE ($whr_read4forum) AND f.forum_id=$forum_id" ;
if( ! $frs = $db->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
if( $db->getRowsNum( $frs ) <= 0 ) die( _MD_D3FORUM_ERR_READFORUM ) ;
$forum_row = $db->fetchArray( $frs ) ;
$cat_id = intval( $forum_row['cat_id'] ) ;
$isadminormod = (boolean)$forum_permissions[ $forum_id ]['is_moderator'] || $isadmin ;
$can_post = (boolean)$forum_permissions[ $forum_id ]['can_post'] ;
$can_edit = (boolean)$forum_permissions[ $forum_id ]['can_edit'] ;
$can_delete = (boolean)$forum_permissions[ $forum_id ]['can_delete'] ;
$need_approve = ! (boolean)$forum_permissions[ $forum_id ]['post_auto_approved'] ;
$forum4assign = array(
	'id' => $forum_row['forum_id'] ,
	'title' => $myts->makeTboxData4Show( $forum_row['forum_title'] ) ,
	'desc' => $myts->displayTarea( $forum_row['forum_desc'] ) ,
	'topics_count' => intval( $forum_row['forum_topics_count'] ) ,
	'posts_count' => intval( $forum_row['forum_posts_count'] ) ,
	'last_post_time' => intval( $forum_row['forum_last_post_time'] ) ,
	'last_post_time_formatted' => formatTimestamp( $forum_row['forum_last_post_time'] , 'm' ) ,
	'last_post_id' => intval( $forum_row['forum_last_post_id'] ) ,
	'moderate_groups' => d3forum_get_forum_moderate_groups4show( $mydirname , $forum_row['forum_id'] ) ,
	'moderate_users' => d3forum_get_forum_moderate_users4show( $mydirname , $forum_row['forum_id'] ) ,
	'need_approve' => $need_approve ,
	'can_post' => $can_post ,
	'isadminormod' => $isadminormod ,
) ;

// extract forum_option (TODO)

?>