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
if( ! include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ) die( _MD_D3FORUM_ERR_READFORUM ) ;

// get&check this category ($category4assign, $category_row), override options
if( ! include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ) die( _MD_D3FORUM_ERR_READCATEGORY ) ;

// check if "use_vote" is on
if( empty( $xoopsModuleConfig['use_vote'] ) ) {
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 0 , _MD_D3FORUM_MSG_VOTEDISABLED ) ;
	exit ;
}

// special check for vote_to_post
if( ! $uid && empty( $xoopsModuleConfig['guest_vote_interval'] ) ) {
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 0 , _MD_D3FORUM_ERR_VOTEPERM ) ;
	exit ;
}

// get remote_ip
$vote_ip = @$_SERVER['REMOTE_ADDR'] ;
if( ! $vote_ip ) die( _MD_D3FORUM_ERR_VOTEINVALID.__LINE__ ) ;

// branch users and guests
if( $uid ) {
	$useridentity4select = "uid=$uid" ;
	$useridentity4insert = "vote_ip='".addslashes($vote_ip)."', uid=$uid" ;
} else {
	$useridentity4select = "vote_ip='".addslashes($vote_ip)."' AND uid=0 AND vote_time>".( time() - @$xoopsModuleConfig['guest_vote_interval'] ) ;
	$useridentity4insert = "vote_ip='".addslashes($vote_ip)."', uid=0" ;
}

// get POINT and validation
$point4vote = intval( @$_GET['point'] ) ;
if( $point4vote < 0 || $point4vote > 10 ) die( _MD_D3FORUM_ERR_VOTEINVALID.__LINE__ ) ;

// check double voting
$sql = "SELECT COUNT(*) FROM ".$xoopsDB->prefix($mydirname."_post_votes")." WHERE post_id=$post_id AND ($useridentity4select)" ;
if( ! $result = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
list( $count ) = $xoopsDB->fetchRow( $result ) ;
if( $count > 0 ) {
	if( $uid > 0 ) {
		// delete previous post
		$sql = "DELETE FROM ".$xoopsDB->prefix($mydirname."_post_votes")." WHERE post_id=$post_id AND uid=$uid" ;
		if( ! $xoopsDB->queryF( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
	} else {
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 0 , _MD_D3FORUM_MSG_VOTEDOUBLE ) ;
		exit ;
	}
}

// transaction stage
$sql = "INSERT INTO ".$xoopsDB->prefix($mydirname."_post_votes")." SET post_id=$post_id, vote_point=$point4vote, vote_time=UNIX_TIMESTAMP(), $useridentity4insert" ;if( ! $xoopsDB->queryF( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;

require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
d3forum_sync_post_votes( $mydirname , $post_id ) ;

redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 0 , _MD_D3FORUM_MSG_VOTEACCEPTED ) ;
exit ;

?>