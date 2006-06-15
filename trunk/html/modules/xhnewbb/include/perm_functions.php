<?php

function xhnewbb_get_forums_can_read()
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( is_object( $xoopsUser ) ) {
		$uid = intval( $xoopsUser->getVar('uid') ) ;
		$member_handler =& xoops_gethandler( 'member' ) ;
		$groups = $member_handler->getGroupsByUser( intval( $uid ) ) ;
		if( ! empty( $groups ) ) $whr = "f.forum_type=0 || fa.`user_id`=$uid || fa.`groupid` IN (".implode(",",$groups).")" ;
		else $whr = "f.forum_type=0 || fa.`user_id`=$uid" ;
	} else {
		$whr = "f.forum_type=0" ;
	}

	$sql = "SELECT distinct f.forum_id FROM ".$db->prefix("xhnewbb_forums")." f LEFT JOIN ".$db->prefix("xhnewbb_forum_access")." fa ON fa.forum_id=f.forum_id WHERE ($whr)" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $forum ) = $db->fetchRow( $result ) ) {
		$ret[] = intval( $forum ) ;
	}

	if( empty( $ret ) ) return array(0) ;
	else return $ret ;
}


function get_users_can_read_forum( $forum )
{
	$db =& Database::getInstance() ;
	$forumid = intval( $forum ) ;
	$uids = array() ;

	$sql = "SELECT `user_id` FROM ".$db->prefix("xhnewbb_forum_access")." WHERE `forum_id`=$forumid AND `user_id` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$uids[] = $uid ;
	}

	$sql = "SELECT distinct g.uid FROM ".$db->prefix("xhnewbb_forum_access")." x , ".$db->prefix("groups_users_link")." g WHERE x.groupid=g.groupid AND x.`forum_id`=$forumid AND x.`groupid` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$uids[] = $uid ;
	}

	return array_unique( $uids ) ;
}


?>