<?php

function d3forum_display_comment_topicscount( $mydirname , $forum_id , $params )
{
	global $xoopsUser , $xoopsConfig ;

	$mydirpath = XOOPS_ROOT_PATH.'/modules/'.$mydirname ;
	$mytrustdirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	$mytrustdirpath = dirname( dirname( __FILE__ ) ) ;

	$db =& Database::getInstance() ;

	// external_link_id
	if( ! empty( $params['link_id'] ) ) {
		$external_link_id = intval( $params['link_id'] ) ;
	} else if( ! empty( $params['itemname'] ) ) {
		$external_link_id = intval( @$_GET[ $params['itemname'] ] ) ;
	} else {
		echo "set valid link_id or itemname in the template" ;
		return ;
	}
	if( $external_link_id <= 0 ) return ;

	// check the d3forum exists and is active
	$module_hanlder =& xoops_gethandler( 'module' ) ;
	$module =& $module_hanlder->getByDirname( $mydirname ) ;
	if( ! is_object( $module ) || ! $module->getVar('isactive') ) {
		return ;
	}

	// check permission of "module_read"
	$moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
	$groups = is_object( $xoopsUser ) ? $xoopsUser->getGroups() : array( XOOPS_GROUP_ANONYMOUS ) ;
	if( ! $moduleperm_handler->checkRight( 'module_read' , $module->getVar( 'mid' ) , $groups ) ) {
		return ;
	}

	$sql = "SELECT COUNT(t.topic_id) FROM ".$db->prefix($mydirname."_topics")." t WHERE t.forum_id=$forum_id AND ! t.topic_invisible AND topic_external_link_id=$external_link_id" ;
	if( ! $trs = $db->query( $sql ) ) die( 'd3forum_comment_error in '.__LINE__ ) ;
	list( $count ) = $db->fetchRow( $trs ) ;
	echo $count ;
}


function d3forum_display_comment( $mydirname , $forum_id , $params )
{
	global $xoopsUser , $xoopsConfig ;

	$mydirpath = XOOPS_ROOT_PATH.'/modules/'.$mydirname ;
	$mytrustdirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	$mytrustdirpath = dirname( dirname( __FILE__ ) ) ;

	$db =& Database::getInstance() ;

	// check the d3forum exists and is active
	$module_hanlder =& xoops_gethandler( 'module' ) ;
	$module =& $module_hanlder->getByDirname( $mydirname ) ;
	if( ! is_object( $module ) || ! $module->getVar('isactive') ) {
		return ;
	}

	// check permission of "module_read"
	$moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
	$groups = is_object( $xoopsUser ) ? $xoopsUser->getGroups() : array( XOOPS_GROUP_ANONYMOUS ) ;
	if( ! $moduleperm_handler->checkRight( 'module_read' , $module->getVar( 'mid' ) , $groups ) ) {
		return ;
	}

	// language files
	$language = empty( $xoopsConfig['language'] ) ? 'english' : $xoopsConfig['language'] ;
	if( file_exists( "$mydirpath/language/$language/main.php" ) ) {
		// user customized language file (already read by common.php)
		include_once "$mydirpath/language/$language/main.php" ;
	} else if( file_exists( "$mytrustdirpath/language/$language/main.php" ) ) {
		// default language file
		include_once "$mytrustdirpath/language/$language/main.php" ;
	} else {
		// fallback english
		include_once "$mytrustdirpath/language/english/main.php" ;
	}

	// local $xoopsModuleConfig
	$config_handler =& xoops_gethandler( 'config' ) ;
	$xoopsModuleConfig =& $config_handler->getConfigsByCat( 0 , $module->getVar( 'mid' ) ) ;

	// external_link_id
	if( empty( $params['itemname'] ) ) {
		echo "set valid itemname in the template" ;
		return ;
	}
	$external_link_id = intval( @$_GET[ $params['itemname'] ] ) ;
	if( $external_link_id <= 0 ) return ;


	include dirname(__FILE__).'/common_prepend.php' ;

	$forum_id = intval( $forum_id ) ;
	if( ! include dirname(__FILE__).'/process_this_forum.inc.php' ) return ;

	if( ! include dirname(__FILE__).'/process_this_category.inc.php' ) return ;

	// get $odr_options, $solved_options, $query4assign
	//$query4nav = "forum_id=$forum_id" ;
	//include dirname(__FILE__).'/process_query4topics.inc.php' ;
	
	// INVISIBLE
	$whr_invisible = $isadminormod ? '1' : '! t.topic_invisible' ;
	
	// number query
	$sql = "SELECT COUNT(t.topic_id) FROM ".$db->prefix($mydirname."_topics")." t LEFT JOIN ".$db->prefix($mydirname."_users2topics")." u2t ON t.topic_id=u2t.topic_id AND u2t.uid=$uid LEFT JOIN ".$db->prefix($mydirname."_posts")." lp ON lp.post_id=t.topic_last_post_id LEFT JOIN ".$db->prefix($mydirname."_posts")." fp ON fp.post_id=t.topic_first_post_id WHERE t.forum_id=$forum_id AND ($whr_invisible) AND topic_external_link_id=$external_link_id" ;
	if( ! $trs = $db->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
	list( $topic_hits ) = $db->fetchRow( $trs ) ;
	
	// pagenav
	/*
	if( $topic_hits > $num ) {
		require_once XOOPS_ROOT_PATH.'/class/pagenav.php' ;
		$pagenav_obj = new XoopsPageNav( $topic_hits , $num , $pos , 'pos', $query4nav ) ;
		$pagenav = $pagenav_obj->renderNav() ;
	}
	*/
	
	// main query
	$sql = "SELECT t.*, lp.subject AS lp_subject, lp.icon AS lp_icon, lp.number_entity AS lp_number_entity, lp.special_entity AS lp_special_entity, fp.subject AS fp_subject, fp.icon AS fp_icon, fp.number_entity AS fp_number_entity, fp.special_entity AS fp_special_entity, u2t.u2t_time, u2t.u2t_marked, u2t.u2t_rsv FROM ".$db->prefix($mydirname."_topics")." t LEFT JOIN ".$db->prefix($mydirname."_users2topics")." u2t ON t.topic_id=u2t.topic_id AND u2t.uid=$uid LEFT JOIN ".$db->prefix($mydirname."_posts")." lp ON lp.post_id=t.topic_last_post_id LEFT JOIN ".$db->prefix($mydirname."_posts")." fp ON fp.post_id=t.topic_first_post_id WHERE t.forum_id=$forum_id AND ($whr_invisible) AND topic_external_link_id=$external_link_id ORDER BY t.topic_last_post_time DESC" ;
	if( ! $trs = $db->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
	
	// topics loop
	$topics = array() ;
	while( $topic_row = $db->fetchArray( $trs ) ) {
	
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
			'title' => $myts->makeTboxData4Show( $topic_row['topic_title'] , $topic_row['fp_number_entity'] , $topic_row['fp_special_entity'] ) ,
			'replies' => intval( $topic_row['topic_posts_count'] ) - 1 ,
			'views' => intval( $topic_row['topic_views'] ) ,
			'last_post_time' => intval( $topic_row['topic_last_post_time'] ) ,
			'last_post_time_formatted' => formatTimestamp( $topic_row['topic_last_post_time'] , 'm' ) ,
			'last_post_id' => intval( $topic_row['topic_last_post_id'] ) ,
			'last_post_icon' => intval( $topic_row['lp_icon'] ) ,
			'last_post_subject' => $myts->makeTboxData4Show( $topic_row['lp_subject'] , $topic_row['lp_number_entity'] , $topic_row['lp_special_entity'] ) ,
			'last_post_uid' => intval( $topic_row['topic_last_uid'] ) ,
			'last_post_uname' => $last_post_uname4html ,
			'first_post_time' => intval( $topic_row['topic_first_post_time'] ) ,
			'first_post_time_formatted' => formatTimestamp( $topic_row['topic_first_post_time'] , 'm' ) ,
			'first_post_id' => intval( $topic_row['topic_first_post_id'] ) ,
			'first_post_icon' => intval( $topic_row['fp_icon'] ) ,
			'first_post_subject' => $myts->makeTboxData4Show( $topic_row['fp_subject'] , $topic_row['fp_number_entity'] , $topic_row['fp_special_entity'] ) ,
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

	$tpl =& new XoopsTpl() ;
	$tpl->assign(
		array(
			'mydirname' => $mydirname ,
			'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
			'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
			'mod_config' => $xoopsModuleConfig ,
			'uid' => $uid ,
			'uname' => is_object( $xoopsUser ) ? $xoopsUser->getVar('uname') : '' ,
			'subject' => empty( $params['subject'] ) ? '' : sprintf( _MD_D3FORUM_FMT_COMMENTSUBJECT , $params['subject'] ) ,
			'postorder' => $postorder ,
			'icon_meanings' => $d3forum_icon_meanings ,
			'category' => $category4assign ,
			'forum' => $forum4assign ,
			'topics' => $topics ,
			'topic_hits' => intval( $topic_hits ) ,
			'odr_options' => $odr_options ,
			'solved_options' => $solved_options ,
//			'query' => $query4assign ,
//			'pagenav' => @$pagenav ,
			'external_link_id' => $external_link_id ,
			'page' => 'listtopics' ,
			'xoops_pagetitle' => $forum4assign['title'] ,
		)
	) ;
	$tpl->display( 'db:'.$mydirname.'_comment_listtopics.html' ) ;
}


?>