<?php

// this file can be included from d3forum's blocks.

function d3forum_get_forums_can_read( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( is_object( $xoopsUser ) ) {
		$uid = intval( $xoopsUser->getVar('uid') ) ;
		$groups = $xoopsUser->getGroups() ;
		if( ! empty( $groups ) ) {
			$whr4forum = "fa.`uid`=$uid || fa.`groupid` IN (".implode(",",$groups).")" ;
			$whr4cat = "`uid`=$uid || `groupid` IN (".implode(",",$groups).")" ;
		} else {
			$whr4forum = "fa.`uid`=$uid" ;
			$whr4cat = "`uid`=$uid" ;
		}
	} else {
		$whr4forum = "fa.`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
		$whr4cat = "`groupid`=".intval(XOOPS_GROUP_ANONYMOUS) ;
	}

	// get categories
	$sql = "SELECT distinct cat_id FROM ".$db->prefix($mydirname."_category_access")." WHERE ($whr4cat)" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $cat_id ) = $db->fetchRow( $result ) ) {
		$cat_ids[] = intval( $cat_id ) ;
	}
	if( empty( $cat_ids ) ) return array(0) ;

	// get forums
	$sql = "SELECT distinct f.forum_id FROM ".$db->prefix($mydirname."_forums")." f LEFT JOIN ".$db->prefix($mydirname."_forum_access")." fa ON fa.forum_id=f.forum_id WHERE ($whr4forum) AND f.cat_id IN (".implode(',',$cat_ids).')' ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $forum_id ) = $db->fetchRow( $result ) ) {
		$forums[] = intval( $forum_id ) ;
	}

	if( empty( $forums ) ) return array(0) ;
	else return $forums ;
}


function d3forum_get_categories_can_read( $mydirname )
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
	$sql = "SELECT distinct cat_id FROM ".$db->prefix($mydirname."_category_access")." WHERE ($whr4cat)" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $cat_id ) = $db->fetchRow( $result ) ) {
		$cat_ids[] = intval( $cat_id ) ;
	}

	if( empty( $cat_ids ) ) return array(0) ;
	else return $cat_ids ;
}


function d3forum_get_submenu( $mydirname )
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

	$whr_read4cat = '`cat_id` IN (' . implode( "," , d3forum_get_categories_can_read( $mydirname ) ) . ')' ;
	$whr_read4forum = '`forum_id` IN (' . implode( "," , d3forum_get_forums_can_read( $mydirname ) ) . ')' ;
	$categories = array( 0 => array( 'pid' => -1 , 'name' => '' , 'url' => '' ) ) ;

	// categories query
	$sql = "SELECT cat_id,pid,cat_title FROM ".$db->prefix($mydirname."_categories")." WHERE ($whr_read4cat) ORDER BY cat_order_in_tree" ;
	$crs = $db->query( $sql ) ;
	if( $crs ) while( $cat_row = $db->fetchArray( $crs ) ) {
		$cat_id = intval( $cat_row['cat_id'] ) ;
		$categories[ $cat_id ] = array(
			'name' => $myts->makeTboxData4Show( $cat_row['cat_title'] ) ,
			'url' => 'index.php?cat_id='.$cat_id ,
			'pid' => $cat_row['pid'] ,
		) ;
	}

	// forums query
	$frs = $db->query( "SELECT cat_id,forum_id,forum_title FROM ".$db->prefix($mydirname."_forums" )." WHERE ($whr_read4forum) ORDER BY forum_weight" ) ;
	if( $frs ) while( $forum_row = $db->fetchArray( $frs ) ) {
		$cat_id = intval( $forum_row['cat_id'] ) ;
		$categories[ $cat_id ]['sub'][] = array(
			'name' => $myts->makeTboxData4Show( $forum_row['forum_title'] ) ,
			'url' => '?forum_id='.intval( $forum_row['forum_id'] ) ,
		) ;
	}

	// restruct categories
	$submenus_cache[$mydirname] = array_merge( d3forum_restruct_categories( $categories , 0 ) ) ;
	return $submenus_cache[$mydirname] ;
}


function d3forum_restruct_categories( $categories , $parent )
{
	$ret = array() ;
	foreach( $categories as $cat_id => $category ) {
		if( $category['pid'] == $parent ) {
			if( empty( $category['sub'] ) ) $category['sub'] = array() ;
			$ret[] = array(
				'name' => $category['name'] ,
				'url' => $category['url'] ,
				'sub' => array_merge( $category['sub'] , d3forum_restruct_categories( $categories , $cat_id ) ) ,
			) ;
		}
	}

	return $ret ;
}


function d3forum_common_is_necessary_antispam( $user , $mod_config )
{
	$belong_groups = is_object( $user ) ? $user->getGroups() : array( XOOPS_GROUP_ANONYMOUS ) ;

	if( trim( $mod_config['antispam_class'] ) == '' ) return false ;
	if( ! is_object( $user ) ) return true ;
	if( count( array_intersect( $mod_config['antispam_groups'] , $belong_groups ) ) == count( $belong_groups ) ) return true ;
	return false ;
}


function &d3forum_common_get_antispam_object( $mod_config )
{
	require_once dirname(dirname(__FILE__)).'/class/D3forumAntispamDefault.class.php' ;
	$class_name = 'D3forumAntispam'.ucfirst(trim($mod_config['antispam_class'])) ;
	if( file_exists( dirname(dirname(__FILE__)).'/class/'.$class_name.'.class.php' ) ) {
		require_once dirname(dirname(__FILE__)).'/class/'.$class_name.'.class.php' ;
		if( class_exists( $class_name ) ) {
			$antispam_obj =& new $class_name() ;
		}
	}
	if( ! is_object( $antispam_obj ) ) {
		$antispam_obj =& new D3forumAntispamDefault() ;
	}
	
	return $antispam_obj ;
}


function d3forum_common_unhtmlspecialchars( $text )
{
	return strtr( $text , array_flip( get_html_translation_table( HTML_SPECIALCHARS , ENT_QUOTES ) ) ) ;
}

?>