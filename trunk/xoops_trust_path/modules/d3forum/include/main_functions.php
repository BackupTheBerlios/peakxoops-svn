<?php

// this file can be included only from main or admin (not from blocks)


// check done
function d3forum_get_forum_permissions_of_current_user( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( is_object( $xoopsUser ) ) {
		$uid = intval( $xoopsUser->getVar('uid') ) ;
		$groups = $xoopsUser->getGroups() ;
		if( ! empty( $groups ) ) $whr = "`uid`=$uid || `groupid` IN (".implode(",",$groups).")" ;
		else $whr = "`uid`=$uid" ;
	} else {
		$whr = "`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
	}

	$sql = "SELECT forum_id,SUM(can_post) AS can_post,SUM(can_edit) AS can_edit,SUM(can_delete) AS can_delete,SUM(post_auto_approved) AS post_auto_approved,SUM(is_moderator) AS is_moderator FROM ".$db->prefix($mydirname."_forum_access")." WHERE ($whr) GROUP BY forum_id" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( $row = $db->fetchArray( $result ) ) {
		$ret[ $row['forum_id'] ] = $row ;
	}

	if( empty( $ret ) ) return array( 0 => array() ) ;
	else return $ret ;
}


// check done
function d3forum_get_category_permissions_of_current_user( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( is_object( $xoopsUser ) ) {
		$uid = intval( $xoopsUser->getVar('uid') ) ;
		$groups = $xoopsUser->getGroups() ;
		if( ! empty( $groups ) ) $whr = "`uid`=$uid || `groupid` IN (".implode(",",$groups).")" ;
		else $whr = "`uid`=$uid" ;
	} else {
		$whr = "`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
	}

	$sql = "SELECT cat_id,SUM(can_makeforum) AS can_makeforum,SUM(is_moderator) AS is_moderator FROM ".$db->prefix($mydirname."_category_access")." WHERE ($whr) GROUP BY cat_id" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( $row = $db->fetchArray( $result ) ) {
		$ret[ $row['cat_id'] ] = $row ;
	}

	if( empty( $ret ) ) return array( 0 => array() ) ;
	else return $ret ;
}


// check done
function get_users_can_read_forum( $mydirname , $forum_id , $cat_id )
{
	$db =& Database::getInstance() ;
	$forum_id = intval( $forum_id ) ;
	$forum_uids = array() ;
	$cat_uids = array() ;

	$sql = "SELECT `uid` FROM ".$db->prefix($mydirname."_category_access")." WHERE `cat_id`=$cat_id AND `uid` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$cat_uids[] = $uid ;
	}
	$sql = "SELECT distinct g.uid FROM ".$db->prefix($mydirname."_category_access")." x , ".$db->prefix("groups_users_link")." g WHERE x.groupid=g.groupid AND x.`cat_id`=$cat_id AND x.`groupid` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$cat_uids[] = $uid ;
	}
	$cat_uids = array_unique( $cat_uids ) ;

	$sql = "SELECT `uid` FROM ".$db->prefix($mydirname."_forum_access")." WHERE `forum_id`=$forum_id AND `uid` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$forum_uids[] = $uid ;
	}
	$sql = "SELECT distinct g.uid FROM ".$db->prefix($mydirname."_forum_access")." x , ".$db->prefix("groups_users_link")." g WHERE x.groupid=g.groupid AND x.`forum_id`=$forum_id AND x.`groupid` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$forum_uids[] = $uid ;
	}
	$forum_uids = array_unique( $forum_uids ) ;

	return array_intersect( $forum_uids , $cat_uids ) ;
}


// check done
function d3forum_get_forum_moderate_groups4show( $mydirname , $forum_id )
{
	$db =& Database::getInstance() ;

	$forum_id = intval( $forum_id ) ;

	$ret = array() ;
	$sql = 'SELECT g.groupid, g.name FROM '.$db->prefix($mydirname.'_forum_access').' fa LEFT JOIN '.$db->prefix('groups').' g ON fa.groupid=g.groupid WHERE fa.groupid IS NOT NULL AND fa.is_moderator AND forum_id='.$forum_id ;
	$mrs = $db->query( $sql ) ;
	while( list( $mod_gid , $mod_gname ) = $db->fetchRow( $mrs ) ) {
		$ret[] = array(
			'gid' => $mod_gid ,
			'gname' => htmlspecialchars( $mod_gname , ENT_QUOTES ) ,
		) ;
	}

	return $ret ;
}


// check done
function d3forum_get_forum_moderate_users4show( $mydirname , $forum_id )
{
	$db =& Database::getInstance() ;

	$forum_id = intval( $forum_id ) ;

	$ret = array() ;
	$sql = 'SELECT u.uid, u.uname FROM '.$db->prefix($mydirname.'_forum_access').' fa LEFT JOIN '.$db->prefix('users').' u ON fa.uid=u.uid WHERE fa.uid IS NOT NULL AND fa.is_moderator AND forum_id='.$forum_id ;
	$mrs = $db->query( $sql ) ;
	while( list( $mod_uid , $mod_uname ) = $db->fetchRow( $mrs ) ) {
		$ret[] = array(
			'uid' => $mod_uid ,
			'uname' => htmlspecialchars( $mod_uname , ENT_QUOTES ) ,
		) ;
	}

	return $ret ;
}


// check done
function d3forum_get_category_moderate_groups4show( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	$cat_id = intval( $cat_id ) ;

	$ret = array() ;
	$sql = 'SELECT g.groupid, g.name FROM '.$db->prefix($mydirname.'_category_access').' ca LEFT JOIN '.$db->prefix('groups').' g ON ca.groupid=g.groupid WHERE ca.groupid IS NOT NULL AND ca.is_moderator AND cat_id='.$cat_id ;
	$mrs = $db->query( $sql ) ;
	while( list( $mod_gid , $mod_gname ) = $db->fetchRow( $mrs ) ) {
		$ret[] = array(
			'gid' => $mod_gid ,
			'gname' => htmlspecialchars( $mod_gname , ENT_QUOTES ) ,
		) ;
	}

	return $ret ;
}


// check done
function d3forum_get_category_moderate_users4show( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	$cat_id = intval( $cat_id ) ;

	$ret = array() ;
	$sql = 'SELECT u.uid, u.uname FROM '.$db->prefix($mydirname.'_category_access').' ca LEFT JOIN '.$db->prefix('users').' u ON ca.uid=u.uid WHERE ca.uid IS NOT NULL AND ca.is_moderator AND cat_id='.$cat_id ;
	$mrs = $db->query( $sql ) ;
	while( list( $mod_uid , $mod_uname ) = $db->fetchRow( $mrs ) ) {
		$ret[] = array(
			'uid' => $mod_uid ,
			'uname' => htmlspecialchars( $mod_uname , ENT_QUOTES ) ,
		) ;
	}

	return $ret ;
}


// select box for jumping into a specified forum
function d3forum_make_jumpbox_options( $mydirname , $whr4cat , $whr4forum , $forum_selected = 0 )
{
	global $myts ;

	$db =& Database::getInstance() ;

	$ret = "" ;
	$sql = "SELECT c.cat_id, c.cat_title, c.cat_depth_in_tree, f.forum_id, f.forum_title FROM ".$db->prefix($mydirname."_categories")." c LEFT JOIN ".$db->prefix($mydirname."_forums")." f ON f.cat_id=c.cat_id WHERE ($whr4cat) AND ($whr4forum) ORDER BY c.cat_order_in_tree, f.forum_weight" ;
	if( $result = $db->query( $sql ) ) {
		while( list( $cat_id , $cat_title , $cat_depth , $forum_id , $forum_title ) = $db->fetchRow( $result ) ) {
			$selected = $forum_id == $forum_selected ? 'selected="selected"' : '' ;
			$ret .= "<option value='$forum_id' $selected>".str_repeat('--',$cat_depth).$myts->makeTboxData4Show($cat_title)." - ".$myts->makeTboxData4Show($forum_title)."</option>\n" ;
		}
	} else {
		$ret = "<option value=\"-1\">ERROR</option>\n";
	}

	return $ret ;
}


// select box for jumping into a specified category
function d3forum_make_cat_jumpbox_options( $mydirname , $whr4cat , $cat_selected = 0 )
{
	global $myts ;

	$db =& Database::getInstance() ;

	$ret = "" ;
	$sql = "SELECT c.cat_id, c.cat_title, c.cat_depth_in_tree FROM ".$db->prefix($mydirname."_categories")." c WHERE ($whr4cat) ORDER BY c.cat_order_in_tree" ;
	if( $result = $db->query( $sql ) ) {
		while( list( $cat_id , $cat_title , $cat_depth ) = $db->fetchRow( $result ) ) {
			$selected = $cat_id == $cat_selected ? 'selected="selected"' : '' ;
			$ret .= "<option value='$cat_id' $selected>".str_repeat('--',$cat_depth).$myts->makeTboxData4Show($cat_title)."</option>\n" ;
		}
	} else {
		$ret = "<option value=\"-1\">ERROR</option>\n";
	}

	return $ret ;
}


function d3forum_trigger_event( $category , $item_id , $event , $extra_tags=array() , $user_list=array() , $omit_user_id=null )
{
	global $xoopsModule , $xoopsConfig , $mydirname , $mydirpath , $mytrustdirname , $mytrustdirpath ;

	$mid = $xoopsModule->getVar('mid') ;

	// language file
	$language = empty( $xoopsConfig['language'] ) ? 'english' : $xoopsConfig['language'] ;
	if( file_exists( "$mydirpath/language/$language/mail_template/" ) ) {
		// user customized language file
		$mail_template_dir = "$mydirpath/language/$language/mail_template/" ;
	} else if( file_exists( "$mytrustdirpath/language/$language/mail_template/" ) ) {
		// default language file
		$mail_template_dir = "$mytrustdirpath/language/$language/mail_template/";
	} else {
		// fallback english
		$mail_template_dir = "$mytrustdirpath/language/english/mail_template/";
	}

	// Check if event is enabled
	$config_handler =& xoops_gethandler('config');
	$mod_config =& $config_handler->getConfigsByCat(0,$mid);
	if (empty($mod_config['notification_enabled'])) {
		return false;
	}
	$category_info =& notificationCategoryInfo ($category, $mid);
	$event_info =& notificationEventInfo ($category, $event, $mid);
	if (!in_array(notificationGenerateConfig($category_info,$event_info,'option_name'),$mod_config['notification_events']) && empty($event_info['invisible'])) {
		return false;
	}

	if (!isset($omit_user_id)) {
		global $xoopsUser;
		if (!empty($xoopsUser)) {
			$omit_user_id = $xoopsUser->getVar('uid');
		} else {
			$omit_user_id = 0;
		}
	}
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('not_modid', intval($mid)));
	$criteria->add(new Criteria('not_category', $category));
	$criteria->add(new Criteria('not_itemid', intval($item_id)));
	$criteria->add(new Criteria('not_event', $event));
	$mode_criteria = new CriteriaCompo();
	$mode_criteria->add (new Criteria('not_mode', XOOPS_NOTIFICATION_MODE_SENDALWAYS), 'OR');
	$mode_criteria->add (new Criteria('not_mode', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE), 'OR');
	$mode_criteria->add (new Criteria('not_mode', XOOPS_NOTIFICATION_MODE_SENDONCETHENWAIT), 'OR');
	$criteria->add($mode_criteria);
	if (!empty($user_list)) {
		$user_criteria = new CriteriaCompo();
		foreach ($user_list as $user) {
			$user_criteria->add (new Criteria('not_uid', $user), 'OR');
		}
		$criteria->add($user_criteria);
	}
	$notification_handler =& xoops_gethandler('notification') ;
	$notifications =& $notification_handler->getObjects($criteria);
	if (empty($notifications)) {
		return;
	}

	// Add some tag substitutions here
	$tags = array();
	// {X_ITEM_NAME} {X_ITEM_URL} {X_ITEM_TYPE} from lookup_func are disabled
	$tags['X_MODULE'] = $xoopsModule->getVar('name');
	$tags['X_MODULE_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/';
	$tags['X_NOTIFY_CATEGORY'] = $category;
	$tags['X_NOTIFY_EVENT'] = $event;

	$template = $event_info['mail_template'] . '.tpl';
	$subject = $event_info['mail_subject'];

	foreach ($notifications as $notification) {
		if (empty($omit_user_id) || $notification->getVar('not_uid') != $omit_user_id) {
			// user-specific tags
			//$tags['X_UNSUBSCRIBE_URL'] = 'TODO';
			// TODO: don't show unsubscribe link if it is 'one-time' ??
			$tags['X_UNSUBSCRIBE_URL'] = XOOPS_URL . '/notifications.php';
			$tags = array_merge ($tags, $extra_tags);

			$notification->notifyUser($mail_template_dir, $template, $subject, $tags);
		}
	}
}

?>