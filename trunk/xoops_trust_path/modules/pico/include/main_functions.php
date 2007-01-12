<?php

// this file can be included only from main or admin (not from blocks)


// add fields for tree structure into $categories
function pico_make_treeinformations( $data )
{
	$previous_depth = -1 ;
	$path_to_i = array() ;

	for( $i = 0 ; $i < sizeof( $data ) ; $i ++ ) {
		$unique_path = $data[$i]['unique_path'] ;
		$path_to_i[ $unique_path ] = $i ;
		$parent_path = substr( $unique_path , 0 , strrpos( $unique_path , '.' ) ) ;
		if( $parent_path && isset( $path_to_i[ $parent_path ] ) ) {
			$data[ $path_to_i[ $parent_path ] ]['f1s'][ $data[$i]['id'] ] = strrchr( $data[$i]['unique_path'] , '.' ) ;
		}

		$depth_diff = $data[$i]['depth_in_tree'] - @$previous_depth ;
		$previous_depth = $data[$i]['depth_in_tree'] ;
		$data[$i]['ul_in'] = '' ;
		$data[$i]['ul_out'] = '' ;
		if( $depth_diff > 0 ) {
			if( $i > 0 ) {
				$data[$i-1]['first_child_id'] = $data[$i]['id'] ;
			}
			for( $j = 0 ; $j < $depth_diff ; $j ++ ) {
				$data[$i]['ul_in'] .= '<ul><li>' ;
			}
		} else if( $depth_diff < 0 ) {
			for( $j = 0 ; $j < - $depth_diff ; $j ++ ) {
				$data[$i-1]['ul_out'] .= '</li></ul>' ;
			}
			$data[$i-1]['ul_out'] .= '</li>' ;
			$data[$i]['ul_in'] = '<li>' ;
		} else {
			$data[$i-1]['ul_out'] .= '</li>' ;
			$data[$i]['ul_in'] = '<li>' ;
		}
		if( $i > 0 ) {
			$data[$i-1]['next_id'] = $data[$i]['id'] ;
			$data[$i]['prev_id'] = $data[$i-1]['id'] ;
		}
	}
	$data[ sizeof( $data ) - 1 ]['ul_out'] = str_repeat( '</li></ul>' , $previous_depth + 1 ) ;

	return $data ;
}


// get permissions of current user
function pico_get_category_permissions_of_current_user( $mydirname )
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

	$sql = "SELECT cat_id,permissions FROM ".$db->prefix($mydirname."_category_permissions")." WHERE ($whr)" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $cat_id , $serialized_permissions ) = $db->fetchRow( $result ) ) {
		$permissions = unserialize( $serialized_permissions ) ;
		if( is_array( @$ret[ $cat_id ] ) ) {
			foreach( $permissions as $perm_name => $value ) {
				@$ret[ $cat_id ][ $perm_name ] |= $value ;
			}
		} else {
			$ret[ $cat_id ] = $permissions ;
		}
	}

	if( empty( $ret ) ) return array( 0 => array() ) ;
	else return $ret ;
}


// moderator groups
function pico_get_category_moderate_groups4show( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	$cat_id = intval( $cat_id ) ;

	$ret = array() ;
	$sql = "SELECT g.groupid, g.name FROM ".$db->prefix($mydirname."_category_permissions")." cp LEFT JOIN ".$db->prefix("groups")." g ON cp.groupid=g.groupid WHERE cp.groupid IS NOT NULL AND cat_id=".$cat_id." AND cp.permissions LIKE '%s:12:\"is\\_moderator\";i:1;%'" ;
	$mrs = $db->query( $sql ) ;
	while( list( $mod_gid , $mod_gname ) = $db->fetchRow( $mrs ) ) {
		$ret[] = array(
			'gid' => $mod_gid ,
			'gname' => htmlspecialchars( $mod_gname , ENT_QUOTES ) ,
		) ;
	}

	return $ret ;
}


// moderator users
function pico_get_category_moderate_users4show( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	$cat_id = intval( $cat_id ) ;

	$ret = array() ;
	$sql = "SELECT u.uid, u.uname FROM ".$db->prefix($mydirname."_category_permissions")." cp LEFT JOIN ".$db->prefix("users")." u ON cp.uid=u.uid WHERE cp.uid IS NOT NULL AND cat_id=".$cat_id." AND cp.permissions LIKE '%s:12:\"is\\_moderator\";i:1;%'" ;
	$mrs = $db->query( $sql ) ;
	while( list( $mod_uid , $mod_uname ) = $db->fetchRow( $mrs ) ) {
		$ret[] = array(
			'uid' => $mod_uid ,
			'uname' => htmlspecialchars( $mod_uname , ENT_QUOTES ) ,
		) ;
	}

	return $ret ;
}


// select box for jumping into a specified category
function pico_make_cat_jumpbox_options( $mydirname , $whr4cat , $cat_selected = 0 )
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


// trigger event for D3
function pico_trigger_event( $category , $item_id , $event , $extra_tags=array() , $user_list=array() , $omit_user_id=null )
{
	global $xoopsModule , $xoopsConfig , $mydirname , $mydirpath , $mytrustdirname , $mytrustdirpath ;

	$notification_handler =& xoops_gethandler('notification') ;

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


// get category's moderators as array
function pico_get_moderators( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;
	$cat_id = intval( $cat_id ) ;
	$cat_uids = array() ;

	$sql = "SELECT `uid` FROM ".$db->prefix($mydirname."_category_permissions")." WHERE `cat_id`=$cat_id AND `uid` IS NOT NULL AND permissions LIKE '%is\\_moderator\";i:1%'" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$cat_uids[] = $uid ;
	}
	$sql = "SELECT distinct g.uid FROM ".$db->prefix($mydirname."_category_permissions")." x , ".$db->prefix("groups_users_link")." g WHERE x.groupid=g.groupid AND x.`cat_id`=$cat_id AND x.`groupid` IS NOT NULL AND permissions LIKE '%is\\_moderator\";i:1%'" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$cat_uids[] = $uid ;
	}

	return array_unique( $cat_uids ) ;
}





// get $cat_id from $content_id
function pico_get_cat_id_from_content_id( $mydirname , $content_id )
{
	$db =& Database::getInstance() ;

	list( $cat_id ) = $db->fetchRow( $db->query( "SELECT cat_id FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=".intval($content_id) ) ) ;

	return intval( $cat_id ) ;
}

// get top $content_id from $cat_id
function pico_get_top_content_id_from_cat_id( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	list( $content_id ) = $db->fetchRow( $db->query( "SELECT content_id FROM ".$db->prefix($mydirname."_contents")." WHERE cat_id=".intval($cat_id)." ORDER BY weight,content_id LIMIT 1" ) ) ;

	return intval( $content_id ) ;
}


// escape string for <a href="mailto:..."> (eg. tellafriend)
function pico_escape4mailto( $text )
{
	if( function_exists( 'mb_convert_encoding' ) && defined( '_MD_PICO_MAILTOENCODING' ) ) {
		$text = mb_convert_encoding( $text , _MD_PICO_MAILTOENCODING ) ;
	}
	return rawurlencode( $text ) ;
}


// get filter's informations under XOOPS_TRUST_PATH/modules/pico/filters/
function pico_get_filter_infos( $filters_separated_pipe )
{
	$filters = array() ;
	$dh = opendir( XOOPS_TRUST_PATH.'/modules/pico/filters' ) ;
	while( ( $file = readdir( $dh ) ) !== false ) {
		if( preg_match( '/^pico\_(.*)\.php$/' , $file , $regs ) ) {
			$name = $regs[1] ;
			$constpref = '_MD_PICO_FILTERS_' . strtoupper( $name ) ;
			$filters[ $name ] = array(
				'title' => defined( $constpref.'TITLE' ) ? constant( $constpref.'TITLE' ) : $name ,
				'desc' => defined( $constpref.'DESC' ) ? constant( $constpref.'DESC' ) : '' ,
				'weight' => defined( $constpref.'INITWEIGHT' ) ? constant( $constpref.'INITWEIGHT' ) : 0 ,
				'enabled' => false ,
			) ;
		}
	}

	$current_filters = explode( '|' , $filters_separated_pipe ) ;
	$weight = 0 ;
	foreach( $current_filters as $current_filter ) {
		if( ! empty( $filters[ $current_filter ] ) ) {
			$weight += 10 ;
			$filters[ $current_filter ]['weight'] = $weight ;
			$filters[ $current_filter ]['enabled'] = true ;
		}
	}

	uasort( $filters , 'pico_filter_cmp' ) ;

	return $filters ;
}


// for usort() in pico_get_filter_infos()
function pico_filter_cmp( $a , $b )
{
	if( $a['enabled'] != $b['enabled'] ) {
		return $a['enabled'] ? -1 : 1 ;
	} else {
		return $a['weight'] > $b['weight'] ? 1 : -1 ;
	}
}


?>