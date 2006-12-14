<?php

// this file can be included from d3forum's blocks.

function pico_get_categories_can_read( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( is_object( $xoopsUser ) ) {
		$uid = intval( $xoopsUser->getVar('uid') ) ;
		$groups = $xoopsUser->getGroups() ;
		if( ! empty( $groups ) ) {
			$whr4cat = "`uid`=$uid || `groupid` IN (".implode(",",$groups).")" ;
		} else {
			$whr4cat = "`uid`=$uid" ;
		}
	} else {
		$whr4cat = "`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
	}

	// get categories
	$sql = "SELECT distinct cat_id FROM ".$db->prefix($mydirname."_category_permissions")." WHERE ($whr4cat)" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $cat_id ) = $db->fetchRow( $result ) ) {
		$cat_ids[] = intval( $cat_id ) ;
	}

	if( empty( $cat_ids ) ) return array(0) ;
	else return $cat_ids ;
}


function pico_filter_body( $mydirname , $text , $filters , $id )
{
	foreach( explode( '|' , $filters ) as $filter ) {
		$filter = trim( $filter ) ;
		$func_name = 'pico_'.$filter ;
		$file_path = dirname(dirname(__FILE__)).'/filters/pico_'.$filter.'.php' ;
		if( function_exists( $func_name ) ) {
			$text = $func_name( $mydirname , $text , $id ) ;
		} else if( file_exists( $file_path ) ) {
			include_once $file_path ;
			$text = $func_name( $mydirname , $text , $id ) ;
		}
	}

	return $text ;
}

?>