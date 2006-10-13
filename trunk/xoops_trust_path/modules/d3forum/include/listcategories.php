<?php

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

// categories loop
$categories = array() ;
$previous_depth = -1 ;
$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_categories")." c WHERE ($whr_read4cat) ORDER BY cat_order_in_tree" ;
if( ! $crs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
while( $cat_row = $xoopsDB->fetchArray( $crs ) ) {

	$cat_id = intval( $cat_row['cat_id'] ) ;

	// forums loop
	$forums = array() ;
	$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_forums")." f WHERE f.cat_id=".$cat_id." AND ($whr_read4forum) ORDER BY f.forum_weight, f.forum_id" ;
	if( ! $frs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
	while( $forum_row = $xoopsDB->fetchArray( $frs ) ) {

		$forum_id = intval( $forum_row['forum_id'] ) ;

		// get last visit each forums
		if( $uid > 0 ) {
			$sql = 'SELECT u2t.u2t_time FROM '.$xoopsDB->prefix($mydirname.'_posts').' p LEFT JOIN '.$xoopsDB->prefix($mydirname.'_users2topics').' u2t ON u2t.topic_id=p.topic_id WHERE p.post_id='.intval($forum_row['forum_last_post_id']).' AND u2t.uid='.$uid ;
			list( $u2t_time ) = $xoopsDB->fetchRow( $xoopsDB->query( $sql ) ) ;
		}
		if( empty( $u2t_time ) ) $u2t_time = 0 ;

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
		) ;
	}

	// tree structure of this category (ul & tree_address)
	$depth_diff = $cat_row['cat_depth_in_tree'] - @$previous_depth ;
	$previous_depth = $cat_row['cat_depth_in_tree'] ;
	$ul_in = $ul_out = '' ;
	if( $depth_diff > 0 ) {
		for( $i = 0 ; $i < $depth_diff ; $i ++ ) {
			$ul_in .= '<ul type="none" class="eachbranch">' ;
		}
	} else {
		if( $depth_diff < 0 ) {
			for( $i = 0 ; $i < - $depth_diff ; $i ++ ) {
				$ul_out .= '</ul>' ;
			}
		}
	}

	// categories array
	$categories[] = array(
		'id' => $cat_id ,
		'pid' => $cat_row['pid'] ,
		'title' => $myts->makeTboxData4Show( $cat_row['cat_title'] ) ,
		'desc' => $myts->displayTarea( $cat_row['cat_desc'] ) ,
		'topics_count' => intval( $cat_row['cat_topics_count'] ) ,
		'posts_count' => intval( $cat_row['cat_posts_count'] ) ,
		'last_post_time' => intval( $cat_row['cat_last_post_time'] ) ,
		'last_post_time_formatted' => formatTimestamp( $cat_row['cat_last_post_time'] , 'm' ) ,
		'bit_new' => 0 , // TODO
		'last_post_id' => intval( $cat_row['cat_last_post_id'] ) ,
		'depth_in_tree' => intval( $cat_row['cat_depth_in_tree'] ) ,
		'order_in_tree' => intval( $cat_row['cat_order_in_tree'] ) ,
		'ul_in' => $ul_in ,
		'ul_out' => $ul_out ,
		'depth_diff' => $depth_diff ,
		'forums' => $forums ,
		'moderate_groups' => d3forum_get_category_moderate_groups4show( $mydirname , $cat_row['cat_id'] ) ,
		'moderate_users' => d3forum_get_category_moderate_users4show( $mydirname , $cat_row['cat_id'] ) ,
		'can_makeforum' => ( $isadmin || @$category_permissions[ $cat_id ]['can_makeforum'] || @$category_permissions[ $cat_id ]['is_moderator'] ) ,
	) ;
}

$xoopsOption['template_main'] = $mydirname.'_main_listcategories.html' ;
include XOOPS_ROOT_PATH.'/header.php' ;

$xoopsTpl->assign(
	array(
		'total_topics_count' => $total_topics_count ,
		'total_posts_count' => $total_posts_count ,
		'lastvisit' => $last_visit ,
		'lastvisit_formatted' => formatTimestamp( $last_visit , 'm' ) ,
		'currenttime' => time() ,
		'currenttime_formatted' => formatTimestamp( time() , 'm' ) ,
		'categories' => $categories ,
		'categories_ul_out_last' => str_repeat( '</ul>' , $previous_depth + 1 ) ,
		'page' => 'listcategories' ,
	)
) ;

?>