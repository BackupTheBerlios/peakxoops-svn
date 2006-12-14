<?php

require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;
$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

// get $cat_id
$cat_id = intval( @$_GET['cat_id'] ) ;
list( $cat_id , $cat_title ) = $db->fetchRow( $db->query( "SELECT cat_id,cat_title FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=$cat_id" ) ) ;
if( empty( $cat_id ) ) {
	$cat_id = 0 ;
	$cat_title = _MD_PICO_TOP ;
}

include dirname(dirname(__FILE__)).'/include/category_permissions.inc.php' ;

//
// transaction stage
//

// group update
if( ! empty( $_POST['group_update'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	$db->query( "DELETE FROM ".$db->prefix($mydirname."_category_permissions")." WHERE cat_id=$cat_id AND groupid>0" ) ;
	$result = $db->query( "SELECT groupid FROM ".$db->prefix("groups") ) ;
	while( list( $gid ) = $db->fetchRow( $result ) ) {
		if( ! empty( $_POST['can_read'][$gid] ) ) {
			$perms = array() ;
			foreach( $pico_category_permissions as $perm_name ) {
				$perms[$perm_name] = empty( $_POST[$perm_name][$gid] ) ? 0 : 1 ;
			}
			$db->query( "INSERT INTO ".$db->prefix($mydirname."_category_permissions")." SET cat_id=$cat_id, groupid=$gid, permissions='".addslashes(serialize($perms))."'" ) ;
		}
	}
	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=category_access&amp;cat_id=$cat_id" , 3 , _MD_PICO_MSG_UPDATED ) ;
	exit ;
}

// user update
if( ! empty( $_POST['user_update'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'pico_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	$db->query( "DELETE FROM ".$db->prefix($mydirname."_category_permissions")." WHERE cat_id=$cat_id AND uid>0" ) ;

	if( is_array( @$_POST['can_read'] ) ) foreach( $_POST['can_read'] as $uid => $can_read ) {
		$uid = intval( $uid ) ;
		if( $can_read ) {
			$perms = array() ;
			foreach( $pico_category_permissions as $perm_name ) {
				$perms[$perm_name] = empty( $_POST[$perm_name][$uid] ) ? 0 : 1 ;
			}
			$db->query( "INSERT INTO ".$db->prefix($mydirname."_category_permissions")." SET cat_id=$cat_id, uid=$uid, permissions='".addslashes(serialize($perms))."'" ) ;
		}
	}
	
	$member_hander =& xoops_gethandler( 'member' ) ;
	if( is_array( @$_POST['new_uids'] ) ) foreach( array_keys( $_POST['new_uids'] ) as $i ) {
		if( empty( $_POST['new_can_read'][$i] ) ) continue ;
		if( empty( $_POST['new_uids'][$i] ) ) {
			// add new user by uname
			$criteria =& new Criteria( 'uname' , addslashes( @$_POST['new_unames'][$i] ) ) ;
			@list( $user ) = $member_handler->getUsers( $criteria ) ;
		} else {
			// add new user by uid
			$user =& $member_handler->getUser( intval( $_POST['new_uids'][$i] ) ) ;
		}
		// check the user is valid
		if( ! is_object( $user ) ) continue ;
		$uid = $user->getVar( 'uid' ) ;

		$perms = array( 'can_read' => 1 ) ;
		foreach( $pico_category_permissions as $perm_name ) {
			$perms[$perm_name] = empty( $_POST['new_'.$perm_name][$i] ) ? 0 : 1 ;
		}
		$db->query( "INSERT INTO ".$db->prefix($mydirname."_category_permissions")." SET cat_id=$cat_id, uid=$uid, permissions='".addslashes(serialize($perms))."'" ) ;
	}

	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=category_access&amp;cat_id=$cat_id" , 3 , _MD_PICO_MSG_UPDATED ) ;
	exit ;
}



//
// form stage
//

// create jump box options as array
$crs = $db->query( "SELECT cat_id,cat_title,cat_depth_in_tree FROM ".$db->prefix($mydirname."_categories")." ORDER BY cat_order_in_tree" ) ;
$cat_options = array( 0 => _MD_PICO_TOP ) ;
while( list( $id , $title , $depth ) = $db->fetchRow( $crs ) ) {
	$cat_options[ $id ] = str_repeat( '--' , $depth ) . htmlspecialchars( $title , ENT_QUOTES ) ;
}

// create permissions4assign
$permissions4assign = array() ;
foreach( $pico_category_permissions as $perm_name ) {
	$permissions4assign[$perm_name] = constant( '_MD_PICO_PERMS_'.strtoupper( $perm_name ) ) ;
}

// create group form
$group_handler =& xoops_gethandler( 'group' ) ;
$groups =& $group_handler->getObjects() ;
$groups4assign = array() ;
foreach( $groups as $group ) {
	$gid = $group->getVar('groupid') ;

	$cprs = $db->query( "SELECT permissions FROM ".$db->prefix($mydirname."_category_permissions")." WHERE groupid=".$group->getVar('groupid')." AND cat_id=$cat_id" ) ;
	if( $db->getRowsNum( $cprs ) > 0 ) {
		list( $serialized_gpermissions ) = $db->fetchRow( $cprs ) ;
		$gpermissions = unserialize( $serialized_gpermissions ) ;
	} else {
		$gpermissions = array() ;
	}

	$groups4assign[] = array(
		'gid' => $gid ,
		'name' => $group->getVar('name') ,
		'perms' => $gpermissions ,
	) ;
}


// create user form
$users4assign = array() ;
$cprs = $db->query( "SELECT u.uid,u.uname,cp.permissions FROM ".$db->prefix($mydirname."_category_permissions")." cp LEFT JOIN ".$db->prefix("users")." u ON cp.uid=u.uid WHERE cp.cat_id=$cat_id AND cp.groupid IS NULL ORDER BY u.uid ASC" ) ;
$user_trs = '' ;
while( list( $uid , $uname , $serialized_upermissions ) = $db->fetchRow( $cprs ) ) {

	$uid = intval( $uid ) ;
	$upermissions = unserialize( $serialized_upermissions ) ;

	$users4assign[] = array(
		'uid' => $uid ,
		'name' => htmlspecialchars( $uname , ENT_QUOTES ) ,
		'perms' => $upermissions ,
	) ;
}


// create new user form
$new_users4assign = array() ;
for( $i = 0 ; $i < 5 ; $i ++ ) {
	$new_users4assign[] = array(
		'nid' => $i ,
		'perms' => array( 'can_read' => 1 ) ,
	) ;
}


//
// display stage
//

xoops_cp_header();
include dirname(__FILE__).'/mymenu.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_name' => $xoopsModule->getVar('name') ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'cat_id' => $cat_id ,
	'cat_title' => htmlspecialchars( $cat_title , ENT_QUOTES ) ,
	'cat_options' => $cat_options ,
	'permissions' => $permissions4assign ,
	'groups' => $groups4assign ,
	'users' => $users4assign ,
	'new_users' => $new_users4assign ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'pico_admin') ,
) ) ;
$tpl->display( 'db:'.$mydirname.'_admin_category_access.html' ) ;
xoops_cp_footer();

?>