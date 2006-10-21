<?php

$forum_id = intval( @$_GET['forum_id'] ) ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
include dirname(__FILE__).'/process_this_forum.inc.php' ;

// get&check this category ($category4assign, $category_row), override options
include dirname(__FILE__).'/process_this_category.inc.php' ;

// get $odr_options, $solved_options, $query4assign
include dirname(__FILE__).'/process_query4topics.inc.php' ;

// INVISIBLE
$whr_invisible = $isadminormod ? '1' : '! t.topic_invisible' ;

// number query
$sql = "SELECT COUNT(t.topic_id) FROM ".$xoopsDB->prefix($mydirname."_topics")." t LEFT JOIN ".$xoopsDB->prefix($mydirname."_users2topics")." u2t ON t.topic_id=u2t.topic_id AND u2t.uid=$uid LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." lp ON lp.post_id=t.topic_last_post_id LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." fp ON fp.post_id=t.topic_first_post_id WHERE t.forum_id=$forum_id AND ($whr_invisible) AND ($whr_solved) AND ($whr_txt)" ;
if( ! $trs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
list( $topic_hits ) = $xoopsDB->fetchRow( $trs ) ;

// pagenav
if( $topic_hits > $num ) {
	require_once XOOPS_ROOT_PATH.'/class/pagenav.php' ;
	$pagenav_obj = new XoopsPageNav( $topic_hits , $num , $pos , 'pos', $query4nav ) ;
	$forum4assign['pagenav'] = $pagenav_obj->renderNav() ;
}

// main query
$sql = "SELECT t.*, lp.subject AS lp_subject, lp.icon AS lp_icon, fp.subject AS fp_subject, fp.icon AS fp_icon, u2t.u2t_time, u2t.u2t_marked, u2t.u2t_rsv FROM ".$xoopsDB->prefix($mydirname."_topics")." t LEFT JOIN ".$xoopsDB->prefix($mydirname."_users2topics")." u2t ON t.topic_id=u2t.topic_id AND u2t.uid=$uid LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." lp ON lp.post_id=t.topic_last_post_id LEFT JOIN ".$xoopsDB->prefix($mydirname."_posts")." fp ON fp.post_id=t.topic_first_post_id WHERE t.forum_id=$forum_id AND ($whr_invisible) AND ($whr_solved) AND ($whr_txt) ORDER BY $odr_query LIMIT $pos,$num" ;
if( ! $trs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;

// topics loop
$topics = array() ;
while( $topic_row = $xoopsDB->fetchArray( $trs ) ) {

	$topic_id = intval( $topic_row['topic_id'] ) ;

	// get last poster's object
	$user_handler =& xoops_gethandler( 'user' ) ;
	$last_poster_obj =& $user_handler->get( intval( $topic_row['topic_last_uid'] ) ) ;
	$last_post_uname4html = is_object( $last_poster_obj ) ? $last_poster_obj->getVar( 'uname' ) : $xoopsConfig['anonymous'] ;
	$first_poster_obj =& $user_handler->get( intval( $topic_row['topic_first_uid'] ) ) ;
	$first_post_uname4html = is_object( $first_poster_obj ) ? $first_poster_obj->getVar( 'uname' ) : $xoopsConfig['anonymous'] ;

	// topics array
	$topics[] = array(
		'id' => $topic_row['topic_id'] ,
		'title' => $myts->makeTboxData4Show( $topic_row['topic_title'] ) ,
		'replies' => intval( $topic_row['topic_posts_count'] ) - 1 ,
		'views' => intval( $topic_row['topic_views'] ) ,
		'last_post_time' => intval( $topic_row['topic_last_post_time'] ) ,
		'last_post_time_formatted' => formatTimestamp( $topic_row['topic_last_post_time'] , 'm' ) ,
		'last_post_id' => intval( $topic_row['topic_last_post_id'] ) ,
		'last_post_icon' => intval( $topic_row['lp_icon'] ) ,
		'last_post_subject' => $myts->makeTboxData4Show( $topic_row['lp_subject'] ) ,
		'last_post_uid' => intval( $topic_row['topic_last_uid'] ) ,
		'last_post_uname' => $last_post_uname4html ,
		'first_post_time' => intval( $topic_row['topic_first_post_time'] ) ,
		'first_post_time_formatted' => formatTimestamp( $topic_row['topic_first_post_time'] , 'm' ) ,
		'first_post_id' => intval( $topic_row['topic_first_post_id'] ) ,
		'first_post_icon' => intval( $topic_row['fp_icon'] ) ,
		'first_post_subject' => $myts->makeTboxData4Show( $topic_row['fp_subject'] ) ,
		'first_post_uid' => intval( $topic_row['topic_first_uid'] ) ,
		'first_post_uname' => $first_post_uname4html ,
		'bit_new' => $topic_row['topic_last_post_time'] > @$topic_row['u2t_time'] ? 1 : 0 ,
		'bit_hot' => $topic_row['topic_posts_count'] > $xoopsModuleConfig['hot_threshold'] ? 1 : 0 ,
		'locked' => intval( $topic_row['topic_locked'] ) ,
		'sticky' => intval( $topic_row['topic_sticky'] ) ,
		'solved' => intval( $topic_row['topic_solved'] ) ,
		'invisible' => intval( $topic_row['topic_invisible'] ) ,
		'u2t_time' => intval( @$topic_row['u2t_time'] ) ,
		'u2t_marked' => intval( @$topic_row['u2t_marked'] ) ,
		'votes_count' => intval( $topic_row['topic_votes_count'] ) ,
		'votes_sum' => intval( $topic_row['topic_votes_sum'] ) ,
		'votes_avg' => round( $topic_row['topic_votes_sum'] / ( $topic_row['topic_votes_count'] - 0.0000001 ) , 2 ) ,
	) ;
}

$xoopsOption['template_main'] = $mydirname.'_main_listtopics.html' ;
include XOOPS_ROOT_PATH.'/header.php' ;

$xoopsTpl->assign(
	array(
		'category' => $category4assign ,
		'forum' => $forum4assign ,
		'topics' => $topics ,
		'topic_hits' => intval( $topic_hits ) ,
		'odr_options' => $odr_options ,
		'solved_options' => $solved_options ,
		'query' => $query4assign ,
		'page' => 'listtopics' ,
		'xoops_pagetitle' => $forum4assign['title'] ,
	)
) ;


// TODO
// �ڡ���ʬ�����
// u2t_marked �򥽡��Ƚ�˴ޤ��

?>