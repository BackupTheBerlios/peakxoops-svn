<?php

@include_once dirname(__FILE__).'/constants.php' ;
if( ! defined( '_MD_PICO_WRAPBASE' ) ) require_once dirname(__FILE__).'/constants.dist.php' ;

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


function pico_filter_body( $mydirname , $content_row , $use_cache = false )
{
	$can_use_cache = $use_cache && $content_row['body_cached'] ;

	// wraps special check (compare filemtime with modified_time )
	if( strstr( $content_row['filters'] , 'wraps' ) && $content_row['vpath'] ) {
		$wrap_full_path = XOOPS_TRUST_PATH._MD_PICO_WRAPBASE.'/'.$mydirname.str_replace('..','',$content_row['vpath']) ;
		if( filemtime( $wrap_full_path ) > $content_row['modified_time'] ) {
			$can_use_cache = false ;
		}
	}

	if( $can_use_cache ) {
		return $content_row['body_cached'] ;
	}

	// process each filters
	$text = $content_row['body'] ;
	foreach( explode( '|' , $content_row['filters'] ) as $filter ) {
		$filter = trim( $filter ) ;
		$func_name = 'pico_'.$filter ;
		$file_path = dirname(dirname(__FILE__)).'/filters/pico_'.$filter.'.php' ;
		if( function_exists( $func_name ) ) {
			$text = $func_name( $mydirname , $text , $content_row ) ;
		} else if( file_exists( $file_path ) ) {
			include_once $file_path ;
			$text = $func_name( $mydirname , $text , $content_row ) ;
		}
	}

	// store the result into body_cached field
	if( $use_cache ) {
		$db =& Database::getInstance() ;
		$db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET body_cached='".addslashes($text)."',modified_time=UNIX_TIMESTAMP() WHERE content_id=".intval($content_row['content_id']) ) ;
	}

	return $text ;
}


function pico_make_content_link4html( $mod_config , $content_row , $mydirname = null )
{
	if( ! is_array( $content_row ) && ! empty( $mydirname ) ) {
		// specify content by content_id instead of content_row
		$db =& Database::getInstance() ;
		$content_row = $db->fetchArray( $db->query( "SELECT content_id,vpath FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=".intval($content_row) ) ) ;
	}

	if( ! empty( $mod_config['use_wraps_mode'] ) ) {
		// wraps mode 
		if( ! empty( $content_row['vpath'] ) ) {
			return 'index.php'.htmlspecialchars($content_row['vpath'],ENT_QUOTES) ;
		} else {
			return 'index.php' . sprintf( _MD_PICO_AUTONAME4SPRINTF , intval( $content_row['content_id'] ) ) ;
		}
	} else {
		// normal link
		return 'index.php?content_id='.intval($content_row['content_id']) ;
	}
}

?>