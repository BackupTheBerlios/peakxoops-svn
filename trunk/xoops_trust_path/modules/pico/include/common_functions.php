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
		if( @filemtime( $wrap_full_path ) > @$content_row['modified_time'] ) {
			$can_use_cache = false ;
			$db =& Database::getInstance() ;
			$db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET modified_time=UNIX_TIMESTAMP() WHERE content_id=".intval($content_row['content_id']) ) ;
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
		$db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET body_cached='".addslashes($text)."' WHERE content_id=".intval($content_row['content_id']) ) ;
	}

	return $text ;
}


function pico_make_content_link4html( $mod_config , $content_row , $mydirname = null )
{
	if( ! empty( $mod_config['use_wraps_mode'] ) ) {
		// wraps mode 
		if( ! is_array( $content_row ) && ! empty( $mydirname ) ) {
			// specify content by content_id instead of content_row
			$db =& Database::getInstance() ;
			$content_row = $db->fetchArray( $db->query( "SELECT content_id,vpath FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=".intval($content_row) ) ) ;
		}

		if( ! empty( $content_row['vpath'] ) ) {
			$ret = 'index.php'.htmlspecialchars($content_row['vpath'],ENT_QUOTES) ;
		} else {
			$ret = 'index.php' . sprintf( _MD_PICO_AUTONAME4SPRINTF , intval( $content_row['content_id'] ) ) ;
		}
		return empty( $mod_config['use_rewrite'] ) ? $ret : substr( $ret , 10 ) ;
	} else {
		// normal mode
		$content_id = is_array( $content_row ) ? intval( $content_row['content_id'] ) : intval( $content_row ) ;
		return empty( $mod_config['use_rewrite'] ) ? 'index.php?content_id='.$content_id : substr( sprintf( _MD_PICO_AUTONAME4SPRINTF , $content_id ) , 1 ) ;
	}
}


function pico_make_category_link4html( $mod_config , $cat_row , $mydirname = null )
{
	if( ! empty( $mod_config['use_wraps_mode'] ) ) {
		if( empty( $cat_row ) || is_array( $cat_row ) && $cat_row['cat_id'] == 0 ) return '' ;
		if( ! is_array( $cat_row ) && ! empty( $mydirname ) ) {
			// specify category by cat_id instead of cat_row
			$db =& Database::getInstance() ;
			$cat_row = $db->fetchArray( $db->query( "SELECT cat_id,cat_vpath FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=".intval($cat_row) ) ) ;
		}
		if( ! empty( $cat_row['cat_vpath'] ) ) {
			$ret = 'index.php'.htmlspecialchars($cat_row['cat_vpath'],ENT_QUOTES) ;
			if( substr( $ret , -1 ) != '/' ) $ret .= '/' ;
		} else {
			$ret = 'index.php' . sprintf( _MD_PICO_AUTOCATNAME4SPRINTF , intval( $cat_row['cat_id'] ) ) ;
		}
		return empty( $mod_config['use_rewrite'] ) ? $ret : substr( $ret , 10 ) ;
	} else {
		// normal mode
		$cat_id = is_array( $cat_row ) ? intval( $cat_row['cat_id'] ) : intval( $cat_row ) ;
		if( $cat_id ) return empty( $mod_config['use_rewrite'] ) ? 'index.php?cat_id='.$cat_id : substr( sprintf( _MD_PICO_AUTOCATNAME4SPRINTF , $cat_id ) , 1 ) ;
		else return '' ;
	}
}


function pico_get_submenu( $mydirname , $caller = 'xoops_version' )
{
	static $submenus_cache ;

	if( ! empty( $submenus_cache[$mydirname] ) ) return $submenus_cache[$mydirname] ;

	$module_handler =& xoops_gethandler('module') ;
	$module =& $module_handler->getByDirname( $mydirname ) ;
	if( ! is_object( $module ) ) return array() ;
	$config_handler =& xoops_gethandler('config') ;
	$mod_config =& $config_handler->getConfigsByCat( 0 , $module->getVar('mid') ) ;

	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance();

	$whr_read = '`cat_id` IN (' . implode( "," , pico_get_categories_can_read( $mydirname ) ) . ')' ;
	$categories = array( 0 => array( 'pid' => -1 , 'name' => '' , 'url' => '' , 'sub' => array() ) ) ;

	// categories query
	$sql = "SELECT cat_id,pid,cat_title FROM ".$db->prefix($mydirname."_categories")." WHERE ($whr_read) ORDER BY cat_order_in_tree" ;
	$crs = $db->query( $sql ) ;
	if( $crs ) while( $cat_row = $db->fetchArray( $crs ) ) {
		$cat_id = intval( $cat_row['cat_id'] ) ;
		$categories[ $cat_id ] = array(
			'name' => $myts->makeTboxData4Show( $cat_row['cat_title'] ) ,
			'url' => pico_make_category_link4html( $mod_config , $cat_row ) ,
			'is_category' => true ,
			'pid' => $cat_row['pid'] ,
		) ;
	}

	if( ! ( $caller == 'sitemap_plugin' && ! @$mod_config['sitemap_showcontents'] ) && ! ( $caller == 'xoops_version' && ! @$mod_config['submenu_showcontents'] ) ) {
		// contents query
		$ors = $db->query( "SELECT cat_id,content_id,vpath,subject FROM ".$db->prefix($mydirname."_contents" )." WHERE show_in_menu AND visible AND $whr_read ORDER BY weight" ) ;
		if( $ors ) while( $content_row = $db->fetchArray( $ors ) ) {
			$cat_id = intval( $content_row['cat_id'] ) ;
			$categories[ $cat_id ]['sub'][] = array(
				'name' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
				'url' => pico_make_content_link4html( $mod_config , $content_row ) ,
				'is_category' => false ,
			) ;
		}
	}

	// restruct categories
	$submenus_cache[$mydirname] = array_merge( $categories[0]['sub'] , pico_restruct_categories( $categories , 0 ) ) ;
	return $submenus_cache[$mydirname] ;
}


function pico_restruct_categories( $categories , $parent )
{
	$ret = array() ;
	foreach( $categories as $cat_id => $category ) {
		if( $category['pid'] == $parent ) {
			if( empty( $category['sub'] ) ) $category['sub'] = array() ;
			$ret[] = array(
				'name' => $category['name'] ,
				'url' => $category['url'] ,
				'is_category' => $category['is_category'] ,
				'sub' => array_merge( $category['sub'] , pico_restruct_categories( $categories , $cat_id ) ) ,
			) ;
		}
	}

	return $ret ;
}

function pico_utf8_encode_recursive( &$data )
{
	if( is_array( $data ) ) {
		foreach( array_keys( $data ) as $key ) {
			pico_utf8_encode_recursive( $data[ $key ] ) ;
		}
	} else if( ! is_numeric( $data ) ) {
		if( XOOPS_USE_MULTIBYTES == 1 ) {
			if( function_exists( 'mb_convert_encoding' ) ) {
				$data = mb_convert_encoding( $data , 'UTF-8' , mb_internal_encoding() ) ;
			}
		} else {
			$data = utf8_encode( $data ) ;
		}
	}
}


if( ! function_exists( 'htmlspecialchars_ent' ) ) {
function htmlspecialchars_ent( $string )
{
	return htmlspecialchars( $string , ENT_QUOTES ) ;
}
}

?>