<?php

// get this "topic" from given $topic_id
$sql = "SELECT t.*,u2t.u2t_time,u2t.u2t_marked,u2t.u2t_rsv,p.number_entity,p.special_entity FROM ".$xoopsDB->prefix($mydirname."_topics")." t LEFT JOIN ".$xoopsDB->prefix($mydirname."_users2topics")." u2t ON t.topic_id=u2t.topic_id AND u2t.uid=$uid LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." p ON t.topic_first_post_id=p.post_id WHERE t.topic_id=$topic_id" ;
if( ! $trs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
if( $xoopsDB->getRowsNum( $trs ) <= 0 ) die( _MD_D3FORUM_ERR_READTOPIC ) ;
$topic_row = $xoopsDB->fetchArray( $trs ) ;
$forum_id = intval( $topic_row['forum_id'] ) ;
$isadminormod = (boolean)$forum_permissions[ $forum_id ]['is_moderator'] || $isadmin ;
$topic4assign = array(
	'id' => $topic_row['topic_id'] ,
	'title' => $myts->makeTboxData4Show( $topic_row['topic_title'] , $topic_row['number_entity'] , $topic_row['special_entity'] ) ,
	'replies' => intval( $topic_row['topic_posts_count'] ) - 1 ,
	'views' => intval( $topic_row['topic_views'] ) ,
	'last_post_time' => intval( $topic_row['topic_last_post_time'] ) ,
	'last_post_time_formatted' => formatTimestamp( $topic_row['topic_last_post_time'] , 'm' ) ,
	'last_post_id' => intval( $topic_row['topic_last_post_id'] ) ,
	'last_post_uid' => intval( $topic_row['topic_last_uid'] ) ,
	'first_post_time' => intval( $topic_row['topic_first_post_time'] ) ,
	'first_post_time_formatted' => formatTimestamp( $topic_row['topic_first_post_time'] , 'm' ) ,
	'first_post_id' => intval( $topic_row['topic_first_post_id'] ) ,
	'first_post_uid' => intval( $topic_row['topic_first_uid'] ) ,
	'locked' => intval( $topic_row['topic_locked'] ) ,
	'sticky' => intval( $topic_row['topic_sticky'] ) ,
	'solved' => intval( $topic_row['topic_solved'] ) ,
	'invisible' => intval( $topic_row['topic_invisible'] ) ,
	'u2t_time' => intval( @$topic_row['u2t_time'] ) ,
	'u2t_marked' => intval( @$topic_row['u2t_marked'] ) ,
	'isadminormod' => $isadminormod ,
	'votes_count' => intval( $topic_row['topic_votes_count'] ) ,
	'votes_sum' => intval( $topic_row['topic_votes_sum'] ) ,
	'votes_avg' => round( $topic_row['topic_votes_sum'] / ( $topic_row['topic_votes_count'] - 0.0000001 ) , 2 ) ,
) ;


// TOPIC_INVISIBLE (check & make where)
if( $isadminormod ) {
	$whr_topic_invisible = '1' ;
} else {
	if( $topic_row['topic_invisible'] ) die( _MD_D3FORUM_ERR_READTOPIC ) ;
	$whr_topic_invisible = '! topic_invisible' ;
}


// get next "topic" of the forum
list( $next_topic_id ) = $xoopsDB->fetchRow( $xoopsDB->query( "SELECT MAX(topic_id) FROM ".$xoopsDB->prefix($mydirname."_topics")." WHERE topic_id<$topic_id AND forum_id=$forum_id AND ($whr_topic_invisible)" ) ) ;
if( empty( $next_topic_id ) ) {
	$next_topic4assign = array() ;
} else {
	$next_topic_row = $xoopsDB->fetchArray( $xoopsDB->query( "SELECT t.topic_title,p.number_entity,p.special_entity FROM ".$xoopsDB->prefix($mydirname."_topics")." t LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." p ON t.topic_first_post_id=p.post_id WHERE t.topic_id=$next_topic_id AND ($whr_topic_invisible)" ) ) ;
	$next_topic4assign = array(
		'id' => $next_topic_id ,
		'title' => $myts->makeTboxData4Show( $next_topic_row['topic_title'] , $next_topic_row['number_entity'] , $next_topic_row['special_entity'] ) ,
	) ;
}

// get prev "topic" of the forum
list( $prev_topic_id ) = $xoopsDB->fetchRow( $xoopsDB->query( "SELECT MIN(topic_id) FROM ".$xoopsDB->prefix($mydirname."_topics")." WHERE topic_id>$topic_id AND forum_id=$forum_id AND ($whr_topic_invisible)" ) ) ;
if( empty( $prev_topic_id ) ) {
	$prev_topic4assign = array() ;
} else {
	$prev_topic_row = $xoopsDB->fetchArray( $xoopsDB->query( "SELECT t.topic_title,p.number_entity,p.special_entity FROM ".$xoopsDB->prefix($mydirname."_topics")." t LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." p ON t.topic_first_post_id=p.post_id WHERE t.topic_id=$prev_topic_id AND ($whr_topic_invisible)" ) ) ;
	$prev_topic4assign = array(
		'id' => $prev_topic_id ,
		'title' => $myts->makeTboxData4Show( $prev_topic_row['topic_title'] , $prev_topic_row['number_entity'] , $prev_topic_row['special_entity'] ) ,
	) ;
}

// count up this topic
if( @$_SESSION[$mydirname.'_last_topic_id'] != $topic_id ) {
	$_SESSION[$mydirname.'_last_topic_id'] = $topic_id ;
	$xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix($mydirname."_topics")." SET topic_views=topic_views+1 WHERE topic_id=$topic_id" ) ;
}

// u2t_time update
if( $uid && @$topic_row['u2t_time'] <= $topic_row['topic_last_post_time'] ) {
	// update/insert u2t table
	$xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix($mydirname."_users2topics")." SET u2t_time=UNIX_TIMESTAMP() WHERE uid=$uid AND topic_id=$topic_id" ) ;
	if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->queryF( "INSERT INTO ".$xoopsDB->prefix($mydirname."_users2topics")." SET uid=$uid,topic_id=$topic_id,u2t_time=UNIX_TIMESTAMP(),u2t_marked=0" ) ;
}

?>