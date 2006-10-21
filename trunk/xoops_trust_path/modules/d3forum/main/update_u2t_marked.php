<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;

$topic_id = intval( @$_GET['topic_id'] ) ;

// get&check this topic ($topic4assign, $topic_row, $forum_id), count topic_view up, get $prev_topic, $next_topic
include dirname(dirname(__FILE__)).'/include/process_this_topic.inc.php' ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ;

// get&check this category ($category4assign, $category_row), override options
include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

if( $uid && @$xoopsModuleConfig['allow_mark'] ) {
	// flip u2t_marked
	$xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix($mydirname."_users2topics")." SET u2t_marked = ! u2t_marked WHERE uid=$uid AND topic_id=$topic_id" ) ;
	if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->queryF( 'INSERT INTO '.$xoopsDB->prefix($mydirname.'_users2topics')." SET uid=$uid,topic_id=$topic_id,u2t_marked=1" ) ;
}

$allowed_identifiers = array( 'post_id' , 'topic_id' , 'forum_id' ) ;

if( in_array( $_GET['ret_id'] , $allowed_identifiers ) ) {
	$ret_request = $_GET['ret_id'] . '=' . intval( $_GET['ret_val'] ) ;
} else {
	$ret_request = "topic_id=$topic_id" ;
}

redirect_header( XOOPS_URL."/modules/$mydirname/index.php?$ret_request" , 0 , _MD_D3FORUM_MSG_UPDATED ) ;
exit ;

?>