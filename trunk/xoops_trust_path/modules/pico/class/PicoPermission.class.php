<?php

// singleton
class PicoPermission {

var $db = null ;  // Database instance
var $uid = 0 ; // intval
var $permissions = array() ; // [dirname][permission_id] or [dirname]['is_module_admin']

function PicoPermission()
{
	global $xoopsUser ;

	$this->db =& Database::getInstance() ;
	$this->uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
}

function &getInstance()
{
	static $instance ;
	if( ! isset( $instance ) ) {
		$instance = new PicoPermission() ;
	}
	return $instance ;
}

function getPermissions( $mydirname )
{
	if( empty( $this->permissions[ $mydirname ] ) ) {
		$this->permissions[ $mydirname ] = $this->queryPermissions( $mydirname ) ;
	}
	return @$this->permissions[ $mydirname ] ;
}

function queryPermissions( $mydirname )
{
	$ret = array() ;

	if( $this->uid > 0 ) {
		$user_handler =& xoops_gethandler( 'user' ) ;
		$user =& $user_handler->get( $this->uid ) ;
	}

	$is_module_admin = false ;
	if( is_object( @$user ) ) {
		// is_module_admin
		$module_handler =& xoops_gethandler( 'module' ) ;
		$moduleObj =& $module_handler->getByDirname( $mydirname ) ;
		if( is_object( $moduleObj ) && $user->isAdmin( $moduleObj->getVar('mid') ) ) {
			$is_module_admin = true ;
		}
	}

	if( is_object( @$user ) ) {
		$groups = $user->getGroups() ;
		if( ! empty( $groups ) ) $whr = "`uid`=$this->uid || `groupid` IN (".implode(",",$groups).")" ;
		else $whr = "`uid`=$this->uid" ;
	} else {
		$whr = "`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
	}

	$sql = "SELECT cat_id,permissions FROM ".$this->db->prefix($mydirname."_category_permissions")." WHERE ($whr)" ;
	$result = $this->db->query( $sql ) ;
	if( $result ) while( list( $cat_id , $serialized_permissions ) = $this->db->fetchRow( $result ) ) {
		$permissions = unserialize( $serialized_permissions ) ;
		if( is_array( @$ret[ $cat_id ] ) ) {
			foreach( $permissions as $perm_name => $value ) {
				@$ret[ $cat_id ][ $perm_name ] |= $value ;
			}
		} else {
			$ret[ $cat_id ] = $permissions ;
		}
	}

	if( empty( $ret ) ) return array( 0 => array() , 'is_module_admin' => $is_module_admin ) ;
	else return $ret + array( 'is_module_admin' => $is_module_admin ) ;
}


}



?>