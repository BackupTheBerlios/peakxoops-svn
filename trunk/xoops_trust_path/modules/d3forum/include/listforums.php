<?php

$cat_id = intval( @$_GET['cat_id'] ) ;

// count total topics
$sql = 'SELECT COUNT(*) FROM '.$xoopsDB->prefix($mydirname.'_topics') ;
list( $total_topics_count ) = $xoopsDB->fetchRow( $xoopsDB->query( $sql ) ) ;

// count total posts
$sql = 'SELECT COUNT(*) FROM '.$xoopsDB->prefix($mydirname.'_posts') ;
list( $total_posts_count ) = $xoopsDB->fetchRow( $xoopsDB->query( $sql ) ) ;

// get last visit
if( $uid > 0 ) {
	$db =& Database::getInstance() ;
	$lv_result = $db->query( "SELECT MAX(u2t_time) FROM ".$db->prefix($mydirname.'_users2topics')." WHERE uid='$uid'" ) ;
	list( $last_visit ) = $db->fetchRow( $lv_result ) ;
}
if( empty( $last_visit ) ) $last_visit = time() ;

// get&check this category ($category4assign, $category_row), override options
include dirname(__FILE__).'/process_this_category.inc.php' ;

// subcategories loop
$subcategories = array() ;
$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_categories")." c WHERE ($whr_read4cat) AND pid=$cat_id ORDER BY cat_order_in_tree" ;
if( ! $crs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
while( $cat_row = $xoopsDB->fetchArray( $crs ) ) {
	// categories array
	$subcategories[] = array(
		'id' => $cat_row['cat_id'] ,
		'pid' => $cat_row['pid'] ,
		'title' => $myts->makeTboxData4Show( $cat_row['cat_title'] ) ,
		'desc' => $myts->displayTarea( $cat_row['cat_desc'] ) ,
		'topics_count' => intval( $cat_row['cat_topics_count'] ) ,
		'posts_count' => intval( $cat_row['cat_posts_count'] ) ,
		'last_post_time' => intval( $cat_row['cat_last_post_time'] ) ,
		'last_post_time_formatted' => formatTimestamp( $cat_row['cat_last_post_time'] , 'm' ) ,
		'bit_new' => 0 , // TODO
		'last_post_id' => intval( $cat_row['cat_last_post_id'] ) ,
	) ;
}


// forums loop
$forums = array() ;
$sql = "SELECT f.*, p.topic_id, p.post_time, p.subject, p.icon, p.uid FROM ".$xoopsDB->prefix($mydirname."_forums")." f LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." p ON p.post_id=f.forum_last_post_id WHERE ($whr_read4forum) AND cat_id=$cat_id ORDER BY f.forum_weight, f.forum_id" ;
if( ! $frs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
while( $forum_row = $xoopsDB->fetchArray( $frs ) ) {

	$forum_id = intval( $forum_row['forum_id'] ) ;

	// get last visit each forums
	if( $uid > 0 ) {
		$sql = 'SELECT u2t.u2t_time FROM '.$xoopsDB->prefix($mydirname.'_posts').' p LEFT JOIN '.$xoopsDB->prefix($mydirname.'_users2topics').' u2t ON u2t.topic_id=p.topic_id WHERE p.post_id='.intval($forum_row['forum_last_post_id']).' AND u2t.uid='.$uid ;
		list( $u2t_time ) = $xoopsDB->fetchRow( $xoopsDB->query( $sql ) ) ;
	}
	if( empty( $u2t_time ) ) $u2t_time = 0 ;

	// get last poster's object
	$user_handler =& xoops_gethandler( 'user' ) ;
	$last_poster_obj =& $user_handler->get( intval( $forum_row['uid'] ) ) ;
	if( is_object( $last_poster_obj ) ) {
		$last_post_uname = $last_poster_obj->getVar( 'uname' ) ;
	} else {
		$last_post_uname = $xoopsConfig['anonymous'] ;
	}

	// forums array
	$forums[] = array(
		'id' => $forum_row['forum_id'] ,
		'title' => $myts->makeTboxData4Show( $forum_row['forum_title'] ) ,
		'desc' => $myts->displayTarea( $forum_row['forum_desc'] ) ,
		'topics_count' => intval( $forum_row['forum_topics_count'] ) ,
		'posts_count' => intval( $forum_row['forum_posts_count'] ) ,
		'last_post_time' => intval( $forum_row['forum_last_post_time'] ) ,
		'last_post_time_formatted' => formatTimestamp( $forum_row['forum_last_post_time'] , 'm' ) ,
		'last_post_id' => intval( $forum_row['forum_last_post_id'] ) ,
		'bit_new' => $forum_row['forum_last_post_time'] > $u2t_time && ! empty( $forum_row['forum_topics_count'] ) ? 1 : 0 ,
		'last_post_icon' => intval( $forum_row['icon'] ) ,
		'last_post_subject' => $myts->makeTboxData4Show( $forum_row['subject'] ) ,
		'last_post_uid' => intval( $forum_row['uid'] ) ,
		'last_post_uname' => $last_post_uname ,
		'moderate_groups' => d3forum_get_forum_moderate_groups4show( $mydirname , $forum_row['forum_id'] ) ,
		'moderate_users' => d3forum_get_forum_moderate_users4show( $mydirname , $forum_row['forum_id'] ) ,
		'isadminormod' => (boolean)$forum_permissions[ $forum_id ]['is_moderator'] || $isadmin ,
	) ;
}

$xoopsOption['template_main'] = $mydirname.'_main_listforums.html' ;
include XOOPS_ROOT_PATH.'/header.php' ;

$xoopsTpl->assign(
	array(
		'total_topics_count' => $total_topics_count ,
		'total_posts_count' => $total_posts_count ,
		'lastvisit' => $last_visit ,
		'lastvisit_formatted' => formatTimestamp( $last_visit , 'm' ) ,
		'currenttime' => time() ,
		'currenttime_formatted' => formatTimestamp( time() , 'm' ) ,
		'forums' => $forums ,
		'cat_jumpbox_options' => d3forum_make_cat_jumpbox_options( $mydirname , $whr_read4cat , $cat_id ) ,
		'subcategories' => $subcategories ,
		'category' => $category4assign ,
		'page' => 'listforums' ,
		'xoops_pagetitle' => $category4assign['title'] ,
	)
) ;

?>