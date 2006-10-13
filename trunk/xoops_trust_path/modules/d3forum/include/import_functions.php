<?php

$GLOBALS['d3forum_tables'] = array(
	'category_access' => array(
		'cat_id' ,
		'uid' ,
		'groupid' ,
		'can_post' ,
		'can_edit' ,
		'can_delete' ,
		'post_auto_approved' ,
		'can_makeforum' ,
		'is_moderator' ,
	) ,
	'forum_access' => array(
		'forum_id' ,
		'uid' ,
		'groupid' ,
		'can_post' ,
		'can_edit' ,
		'can_delete' ,
		'post_auto_approved' ,
		'is_moderator' ,
	) ,
	'categories' => array(
		'cat_id' ,
		'pid' ,
		'cat_title' ,
		'cat_desc' ,
		'cat_topics_count' ,
		'cat_posts_count' ,
		'cat_last_post_id' ,
		'cat_last_post_time' ,
		'cat_topics_count_in_tree' ,
		'cat_posts_count_in_tree' ,
		'cat_last_post_id_in_tree' ,
		'cat_last_post_time_in_tree' ,
		'cat_depth_in_tree' ,
		'cat_order_in_tree' ,
		'cat_path_in_tree' ,
		'cat_weight' ,
		'cat_options' ,
	) ,
	'forums' => array(
		'forum_id' ,
		'cat_id' ,
		'forum_title' ,
		'forum_desc' ,
		'forum_topics_count' ,
		'forum_posts_count' ,
		'forum_last_post_id' ,
		'forum_last_post_time' ,
		'forum_weight' ,
		'forum_options' ,
	) ,
	'topics' => array(
		'topic_id' ,
		'forum_id' ,
		'topic_title' ,
		'topic_first_uid' ,
		'topic_first_post_id' ,
		'topic_first_post_time' ,
		'topic_last_uid' ,
		'topic_last_post_id' ,
		'topic_last_post_time' ,
		'topic_views' ,
		'topic_posts_count' ,
		'topic_locked' ,
		'topic_sticky' ,
		'topic_solved' ,
		'topic_invisible' ,
		'topic_votes_sum' ,
		'topic_votes_count' ,
	) ,
	'posts' => array(
		'post_id' ,
		'pid' ,
		'topic_id' ,
		'post_time' ,
		'modified_time' ,
		'uid' ,
		'poster_ip' ,
		'modifier_ip' ,
		'subject' ,
		'html' ,
		'smiley' ,
		'xcode' ,
		'br' ,
		'number_entity' ,
		'special_entity' ,
		'icon' ,
		'attachsig' ,
		'invisible' ,
		'approval' ,
		'hide_uid' ,
		'votes_sum' ,
		'votes_count' ,
		'depth_in_tree' ,
		'order_in_tree' ,
		'guest_name' ,
		'guest_email' ,
		'guest_url' ,
		'guest_pass_md5' ,
		'guest_trip' ,
		'post_text' ,
	) ,
	'users2topics' => array(
		'uid' ,
		'topic_id' ,
		'u2t_time' ,
		'u2t_marked' ,
		'u2t_rsv' ,
	) ,
	'post_votes' => array(
		'vote_id' ,
		'post_id' ,
		'uid' ,
		'vote_point' ,
		'vote_time' ,
		'vote_ip' ,
	) ,
) ;


function d3forum_import_errordie()
{
	$db =& Database::getInstance() ;

	echo _MD_A_D3FORUM_ERR_SQLONIMPORT ;
	echo $db->logger->dumpQueries() ;
	exit ;
}



function d3forum_import_from_newbb1( $mydirname , $import_mid )
{
	$db =& Database::getInstance() ;
	$from_prefix = 'bb' ;

	// get group_ids
	$group_handler =& xoops_gethandler( 'group' ) ;
	$group_objects =& $group_handler->getObjects() ;
	$group_ids = array() ;
	foreach( $group_objects as $group_object ) {
		$group_ids[] = $group_object->getVar('groupid') ;
	}

	// categories
	$table_name = 'categories' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (cat_id,cat_title,cat_weight) SELECT cat_id,cat_title,cat_order FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// category_access
	$crs = $db->query( "SELECT cat_id FROM `$from_table`" ) ;
	$table_name = 'category_access' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	while( list( $cat_id ) = $db->fetchRow( $crs ) ) {
		foreach( $group_ids as $groupid ) {
			$irs = $db->query( "INSERT INTO `$to_table` VALUES ($cat_id,null,$groupid,1,1,1,1,0,0)" ) ;
			if( ! $irs ) d3forum_import_errordie() ;
		}
	}

	// forums
	$table_name = 'forums' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (forum_id,forum_title,forum_desc,forum_weight,cat_id) SELECT forum_id,forum_name,forum_desc,0,cat_id FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// forum_access
	$frs = $db->query( "SELECT forum_id,forum_access,forum_type FROM `$from_table`" ) ;
	$table_name = 'forum_access' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$from_mods_table = $db->prefix( $from_prefix.'_'.'forum_mods' ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	while( list( $forum_id , $forum_access , $forum_type ) = $db->fetchRow( $frs ) ) {
		// moderator by uid
		$mrs = $db->query( "SELECT user_id FROM `$from_mods_table` WHERE forum_id=$forum_id" ) ;
		while( list( $uid ) = $db->fetchRow( $mrs ) ) {
			$irs = $db->query( "INSERT INTO `$to_table` VALUES ($forum_id,$uid,null,1,1,1,1,1)" ) ;
			if( ! $irs ) d3forum_import_errordie() ;
		}
		// users on forum_access (ignore duplicate id error)
		$irs = $db->query( "INSERT INTO `$to_table` (forum_id,uid,can_post) SELECT forum_id,user_id,can_post FROM `$from_table` WHERE forum_id=$forum_id" ) ;
		// groups on forum_access
		foreach( $group_ids as $groupid ) {
			if( $forum_type ) {
				/* @list( $can_read , $can_post ) = $db->fetchRow( $db->query( "SELECT groupid,can_post FROM `$from_table` WHERE user_id IS NULL AND forum_id=$forum_id AND groupid=$groupid" ) ) ;
				if( ! empty( $can_read ) ) {
					$irs = $db->query( "INSERT INTO `$to_table` VALUES ($forum_id,null,$groupid,$can_post,1,1,1,0)" ) ;
					if( ! $irs ) d3forum_import_errordie() ;
				} */
			} else {
				$can_post = 1 ;
				if( ( $groupid == 3 && $forum_access == 1 ) || $forum_access == 3 ) {
					$can_post = 0 ;
				}
				$irs = $db->query( "INSERT INTO `$to_table` VALUES ($forum_id,null,$groupid,$can_post,$can_post,$can_post,1,0)" ) ;
				if( ! $irs ) d3forum_import_errordie() ;
			}
		}
	}

	// topics
	$table_name = 'topics' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (topic_id,topic_title,topic_views,forum_id,topic_locked,topic_sticky,topic_solved) SELECT topic_id,topic_title,topic_views,forum_id,topic_status,topic_sticky,1 FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// posts
	$table_name = 'posts' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$from_text_table = $db->prefix( $from_prefix.'_'.'posts_text') ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (post_id,pid,topic_id,post_time,modified_time,uid,poster_ip,modifier_ip,subject,html,smiley,xcode,br,number_entity,special_entity,icon,attachsig,invisible,approval,post_text) SELECT p.post_id,pid,topic_id,post_time,post_time,uid,poster_ip,poster_ip,subject,!nohtml,!nosmiley,1,1,1,1,IF(SUBSTRING(icon,5,1),SUBSTRING(icon,5,1),1),attachsig,0,1,pt.post_text FROM `$from_table` p LEFT JOIN `$from_text_table` pt ON p.post_id=pt.post_id" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// users2topics
	$table_name = 'users2topics' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	/*$irs = $db->query( "INSERT INTO `$to_table` (uid,topic_id,u2t_time,u2t_marked,u2t_rsv) SELECT uid,topic_id,u2t_time,u2t_marked,u2t_rsv FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;*/
}

function d3forum_import_from_xhnewbb( $mydirname , $import_mid )
{
	$db =& Database::getInstance() ;
	$from_prefix = 'xhnewbb' ;

	// get group_ids
	$group_handler =& xoops_gethandler( 'group' ) ;
	$group_objects =& $group_handler->getObjects() ;
	$group_ids = array() ;
	foreach( $group_objects as $group_object ) {
		$group_ids[] = $group_object->getVar('groupid') ;
	}

	// categories
	$table_name = 'categories' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (cat_id,cat_title,cat_weight) SELECT cat_id,cat_title,cat_order FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// category_access
	$crs = $db->query( "SELECT cat_id FROM `$from_table`" ) ;
	$table_name = 'category_access' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	while( list( $cat_id ) = $db->fetchRow( $crs ) ) {
		foreach( $group_ids as $groupid ) {
			$irs = $db->query( "INSERT INTO `$to_table` VALUES ($cat_id,null,$groupid,1,1,1,1,0,0)" ) ;
			if( ! $irs ) d3forum_import_errordie() ;
		}
	}

	// forums
	$table_name = 'forums' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (forum_id,forum_title,forum_desc,forum_weight,cat_id) SELECT forum_id,forum_name,forum_desc,forum_weight,cat_id FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// forum_access
	$frs = $db->query( "SELECT forum_id,forum_access,forum_type FROM `$from_table`" ) ;
	$table_name = 'forum_access' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$from_mods_table = $db->prefix( $from_prefix.'_'.'forum_mods' ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	while( list( $forum_id , $forum_access , $forum_type ) = $db->fetchRow( $frs ) ) {
		// moderator by uid
		$mrs = $db->query( "SELECT user_id FROM `$from_mods_table` WHERE forum_id=$forum_id" ) ;
		while( list( $uid ) = $db->fetchRow( $mrs ) ) {
			$irs = $db->query( "INSERT INTO `$to_table` VALUES ($forum_id,$uid,null,1,1,1,1,1)" ) ;
			if( ! $irs ) d3forum_import_errordie() ;
		}
		// users on forum_access (ignore duplicate id error)
		$irs = $db->query( "INSERT INTO `$to_table` (forum_id,uid,can_post) SELECT forum_id,user_id,can_post FROM `$from_table` WHERE groupid IS NULL AND forum_id=$forum_id" ) ;
		// groups on forum_access
		foreach( $group_ids as $groupid ) {
			if( $forum_type ) {
				@list( $can_read , $can_post ) = $db->fetchRow( $db->query( "SELECT groupid,can_post FROM `$from_table` WHERE user_id IS NULL AND forum_id=$forum_id AND groupid=$groupid" ) ) ;
				if( ! empty( $can_read ) ) {
					$irs = $db->query( "INSERT INTO `$to_table` VALUES ($forum_id,null,$groupid,$can_post,1,1,1,0)" ) ;
					if( ! $irs ) d3forum_import_errordie() ;
				}
			} else {
				$can_post = 1 ;
				if( ( $groupid == 3 && $forum_access == 1 ) || $forum_access == 3 ) {
					$can_post = 0 ;
				}
				$irs = $db->query( "INSERT INTO `$to_table` VALUES ($forum_id,null,$groupid,$can_post,$can_post,$can_post,1,0)" ) ;
				if( ! $irs ) d3forum_import_errordie() ;
			}
		}
	}

	// topics
	$table_name = 'topics' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (topic_id,topic_title,topic_views,forum_id,topic_locked,topic_sticky,topic_solved) SELECT topic_id,topic_title,topic_views,forum_id,topic_status,topic_sticky,topic_solved FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// posts
	$table_name = 'posts' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$from_text_table = $db->prefix( $from_prefix.'_'.'posts_text') ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (post_id,pid,topic_id,post_time,modified_time,uid,poster_ip,modifier_ip,subject,html,smiley,xcode,br,number_entity,special_entity,icon,attachsig,invisible,approval,post_text) SELECT p.post_id,pid,topic_id,post_time,post_time,uid,poster_ip,poster_ip,subject,!nohtml,!nosmiley,1,1,1,1,IF(SUBSTRING(icon,5,1),SUBSTRING(icon,5,1),1),attachsig,0,1,pt.post_text FROM `$from_table` p LEFT JOIN `$from_text_table` pt ON p.post_id=pt.post_id" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

	// users2topics
	$table_name = 'users2topics' ;
	$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
	$from_table = $db->prefix( $from_prefix.'_'.$table_name ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (uid,topic_id,u2t_time,u2t_marked,u2t_rsv) SELECT uid,topic_id,u2t_time,u2t_marked,u2t_rsv FROM `$from_table`" ) ;
	if( ! $irs ) d3forum_import_errordie() ;

}

function d3forum_import_from_d3forum( $mydirname , $import_mid )
{
	$db =& Database::getInstance() ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$from_module =& $module_handler->get( $import_mid ) ;

	foreach( $GLOBALS['d3forum_tables'] as $table_name => $columns ) {
		$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
		$from_table = $db->prefix( $from_module->getVar('dirname').'_'.$table_name ) ;
		$columns4sql = implode( ',' , $columns ) ;
		$db->query( "DELETE FROM `$to_table`" ) ;
		$irs = $db->query( "INSERT INTO `$to_table` ($columns4sql) SELECT $columns4sql FROM `$from_table`" ) ;
		if( ! $irs ) d3forum_import_errordie() ;
	}
}

?>