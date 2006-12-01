<?php

// this file can be included from transaction procedures

// delete a content
function pico_delete_content( $mydirname , $content_id )
{
	$db =& Database::getInstance() ;

	// delete content
	if( ! $db->query( "DELETE FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=".intval($content_id) ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	return true ;
}


// delete a category
function pico_delete_category( $mydirname , $cat_id , $delete_also_contents = true )
{
	global $xoopsModule ;

	$db =& Database::getInstance() ;

	$cat_id = intval( $cat_id ) ;

	// delete contents
	if( $delete_also_contents ) {
		$sql = "SELECT content_id FROM ".$db->prefix($mydirname."_contents")." WHERE cat_id=$cat_id" ;
		if( ! $result = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
		while( list( $content_id ) = $db->fetchRow( $result ) ) {
			pico_delete_content( $mydirname , $content_id ) ;
		}
	}

	// delete notifications about this category
	$notification_handler =& xoops_gethandler( 'notification' ) ;
	$notification_handler->unsubscribeByItem( $xoopsModule->getVar( 'mid' ) , 'category' , $cat_id ) ;

	// delete category
	if( ! $db->query( "DELETE FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=$cat_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	// delete category_access
	if( ! $db->query( "DELETE FROM ".$db->prefix($mydirname."_category_access")." WHERE cat_id=$cat_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	return true ;
}


// store tree informations of categories
function pico_sync_cattree( $mydirname )
{
	$db =& Database::getInstance() ;

	// rebuild tree informations
	$tree_array = pico_makecattree_recursive( $db->prefix($mydirname."_categories") , 0 ) ;
	array_shift( $tree_array ) ;
	$paths = array() ;
	$previous_depth = 0 ;
	if( ! empty( $tree_array ) ) foreach( $tree_array as $key => $val ) {
		$depth_diff = $val['depth'] - $previous_depth ;
		$previous_depth = $val['depth'] ;
		if( $depth_diff > 0 ) {
			for( $i = 0 ; $i < $depth_diff ; $i ++ ) {
				$paths[ $val['cat_id'] ] = $val['cat_title'] ;
			}
		} else if( $depth_diff < 0 ) {
			for( $i = 0 ; $i < - $depth_diff ; $i ++ ) {
				array_pop( $paths ) ;
			}
		} else {
			array_pop( $paths ) ;
			$paths[ $val['cat_id'] ] = $val['cat_title'] ;
		}

		$db->queryF( "UPDATE ".$db->prefix($mydirname."_categories")." SET cat_depth_in_tree=".($val['depth']-1).", cat_order_in_tree=".($key).", cat_path_in_tree='".addslashes(serialize($paths))."' WHERE cat_id=".$val['cat_id'] ) ;
	}
}


function pico_makecattree_recursive( $tablename , $cat_id , $order = 'cat_weight' , $parray = array() , $depth = 0 , $cat_title = '' )
{
	$db =& Database::getInstance() ;

	$parray[] = array( 'cat_id' => $cat_id , 'depth' => $depth , 'cat_title' => $cat_title ) ;

	$sql = "SELECT cat_id,cat_title FROM $tablename WHERE pid=$cat_id ORDER BY $order" ;
	$result = $db->query( $sql ) ;
	if( $db->getRowsNum( $result ) == 0 ) {
		return $parray ;
	}
	while( list( $new_cat_id , $new_cat_title ) = $db->fetchRow( $result ) ) {
		$parray = pico_makecattree_recursive( $tablename , $new_cat_id , $order , $parray , $depth + 1 , $new_cat_title ) ;
	}
	return $parray ;
}


// store redundant informations to a content from its content_votes
function pico_sync_content_votes( $mydirname , $post_id )
{
	$db =& Database::getInstance() ;

	$post_id = intval( $post_id ) ;

	$sql = "SELECT topic_id FROM ".$db->prefix($mydirname."_contents")." WHERE post_id=$post_id" ;
	if( ! $result = $db->query( $sql ) ) die( "ERROR SELECT post in sync content_votes" ) ;
	list( $topic_id ) = $db->fetchRow( $result ) ;

	$sql = "SELECT COUNT(*),SUM(vote_point) FROM ".$db->prefix($mydirname."_content_votes")." WHERE post_id=$post_id" ;
	if( ! $result = $db->query( $sql ) ) die( "ERROR SELECT content_votes in sync content_votes" ) ;
	list( $votes_count , $votes_sum ) = $db->fetchRow( $result ) ;

	if( ! $db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET votes_count=".intval($votes_count).",votes_sum=".intval($votes_sum)." WHERE post_id=$post_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	return true ;
}


function pico_maketree_recursive( $tablename , $post_id , $order = 'cat_id' , $parray = array() , $depth = 0 , $unique_path = '.1' )
{
	$db =& Database::getInstance() ;

	$parray[] = array( 'post_id' => $post_id , 'depth' => $depth , 'unique_path' => $unique_path ) ;

	$sql = "SELECT post_id,unique_path FROM $tablename WHERE pid=$post_id ORDER BY $order" ;
	$result = $db->query( $sql ) ;
	if( $db->getRowsNum( $result ) == 0 ) {
		return $parray ;
	}
	$new_post_ids = array() ;
	$max_count_of_last_level = 0 ;
	while( list( $new_post_id , $new_unique_path ) = $db->fetchRow( $result ) ) {
		$new_post_ids[ intval( $new_post_id ) ] = $new_unique_path ;
		if( ! empty( $new_unique_path ) ) {
			$count_of_last_level = intval( substr( strrchr( $new_unique_path , '.' ) , 1 ) ) ;
			if( $max_count_of_last_level < $count_of_last_level ) {
				$max_count_of_last_level = $count_of_last_level ;
			}
		}
	}
	foreach( $new_post_ids as $new_post_id => $new_unique_path ) {
		if( empty( $new_unique_path ) ) {
			$new_unique_path = $unique_path . '.' . ++ $max_count_of_last_level ;
		}
		$parray = pico_maketree_recursive( $tablename , $new_post_id , $order , $parray , $depth + 1 , $new_unique_path ) ;
	}
	return $parray ;
}


// get requests for category's sql (parse options)
function pico_get_requests4sql_category( $mydirname )
{
	global $myts , $xoopsModuleConfig ;

	$db =& Database::getInstance() ;

	include dirname(dirname(__FILE__)).'/include/constant_can_override.inc.php' ;
	$options = array() ;
	foreach( $xoopsModuleConfig as $key => $val ) {
		if( empty( $pico_configs_can_be_override[ $key ] ) ) continue ;
		foreach( explode( "\n" , @$_POST['options'] ) as $line ) {
			if( preg_match( '/^'.$key.'\:(.{1,100})$/' , $line , $regs ) ) {
				switch( $pico_configs_can_be_override[ $key ] ) {
					case 'text' :
						$options[ $key ] = trim( $regs[1] ) ;
						break ;
					case 'int' :
						$options[ $key ] = intval( $regs[1] ) ;
						break ;
					case 'bool' :
						$options[ $key ] = intval( $regs[1] ) > 0 ? 1 : 0 ;
						break ;
				}
			}
		}
	}

	// check $pid
	$pid = intval( @$_POST['pid'] ) ;
	if( $pid ) {
		$sql = "SELECT * FROM ".$db->prefix($mydirname."_categories")." c WHERE c.cat_id=$pid" ;
		if( ! $crs = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
		if( $db->getRowsNum( $crs ) <= 0 ) die( _MD_PICO_ERR_READCATEGORY ) ;
	}

	return array( 
		'title' => addslashes( $myts->stripSlashesGPC( @$_POST['title'] ) ) ,
		'desc' => addslashes( $myts->stripSlashesGPC( @$_POST['desc'] ) ) ,
		'weight' => intval( @$_POST['weight'] ) ,
		'pid' => $pid ,
		'options' => addslashes( serialize( $options ) ) ,
	) ;
}


// create forum from post
function pico_makecategory( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	$requests = pico_get_requests4sql_category( $mydirname ) ;

	if( ! $db->query( "INSERT INTO ".$db->prefix($mydirname."_categories")." SET cat_title='{$requests['title']}', cat_desc='{$requests['desc']}', cat_weight='{$requests['weight']}', cat_options='{$requests['options']}', pid={$requests['pid']}" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
	$new_cat_id = $db->getInsertId() ;

	if( $requests['pid'] ) {
		// permissions are set same as the parent category. (also moderator)
		$sql = "SELECT uid,groupid,can_post,can_edit,can_delete,post_auto_approved,can_makesubcategory,is_moderator FROM ".$db->prefix($mydirname."_category_access")." WHERE cat_id={$requests['pid']}" ;
		if( ! $result = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
		while( $row = $db->fetchArray( $result ) ) {
			$uid4sql = empty( $row['uid'] ) ? 'null' : intval( $row['uid'] ) ;
			$groupid4sql = empty( $row['groupid'] ) ? 'null' : intval( $row['groupid'] ) ;
			$sql = "INSERT INTO ".$db->prefix($mydirname."_category_access")." (cat_id,uid,groupid,can_post,can_edit,can_delete,post_auto_approved,can_makesubcategory,is_moderator) VALUES ($new_cat_id,$uid4sql,$groupid4sql,{$row['can_post']},{$row['can_edit']},{$row['can_delete']},{$row['post_auto_approved']},{$row['can_makesubcategory']},{$row['is_moderator']})" ;
			if( ! $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
		}
	} else {
		// default permissioning for top category
		$groups = $xoopsUser->getGroups() ;
		foreach( $groups as $groupid ) {
			$adminflag = $groupid == 1 ? 1 : 0 ;
			$sql = "INSERT INTO ".$db->prefix($mydirname."_category_access")." (cat_id,uid,groupid,can_post,can_edit,can_delete,post_auto_approved,can_makesubcategory,is_moderator) VALUES ($new_cat_id,null,$groupid,1,1,1,1,$adminflag,$adminflag)" ;
			if( ! $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
		}
	}

	// rebuild category tree
	pico_sync_cattree( $mydirname ) ;

	return $new_cat_id ;
}


// update forum from post
function pico_updatecategory( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	$requests = pico_get_requests4sql_category( $mydirname ) ;

	// get children
	include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
	$mytree = new XoopsTree( $db->prefix($mydirname."_categories") , "cat_id" , "pid" ) ;
	$children = $mytree->getAllChildId( $cat_id ) ;
	$children[] = $cat_id ;

	// loop check
	if( in_array( $requests['pid'] , $children ) ) die( _MD_PICO_ERR_PIDLOOP ) ;

	if( ! $db->query( "UPDATE ".$db->prefix($mydirname."_categories")." SET cat_title='{$requests['title']}', cat_desc='{$requests['desc']}', cat_weight='{$requests['weight']}', cat_options='{$requests['options']}', pid='{$requests['pid']}' WHERE cat_id=$cat_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	// rebuild category tree
	pico_sync_cattree( $mydirname ) ;

	return $cat_id ;
}


// get requests for content's sql (parse options)
function pico_get_requests4content( $mydirname )
{
	$myts =& MyTextSanitizer::getInstance() ;
	$db =& Database::getInstance() ;

	// check $cat_id
	$cat_id = intval( @$_POST['cat_id'] ) ;
	if( $cat_id ) {
		$sql = "SELECT * FROM ".$db->prefix($mydirname."_categories")." c WHERE c.cat_id=$cat_id" ;
		if( ! $crs = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
		if( $db->getRowsNum( $crs ) <= 0 ) die( _MD_PICO_ERR_READCATEGORY ) ;
	}

	// build filters
	$filters = array() ;
	foreach( $_POST as $key => $val ) {
		if( substr( $key , 0 , 15 ) == 'filter_enabled_' && $val ) {
			$name = substr( $key , 15 ) ;
			$filters[ $name ] = intval( @$_POST['filter_weight_'.$name] ) ;
		}
	}
	asort( $filters ) ;

	return array( 
		'cat_id' => $cat_id ,
		'subject' => $myts->stripSlashesGPC( @$_POST['subject'] ) ,
		'htmlheader' => $myts->stripSlashesGPC( @$_POST['htmlheader'] ) ,
		'body' => $myts->stripSlashesGPC( @$_POST['body'] ) ,
		'filters' => implode( '|' , array_keys( $filters ) ) ,
		'weight' => intval( @$_POST['weight'] ) ,
		'use_cache' => empty( $_POST['use_cache'] ) ? 0 : 1 ,
		'visible' => empty( $_POST['visible'] ) ? 0 : 1 ,
	) ;
}


// create forum from post
function pico_makecontent( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	$requests = pico_get_requests4content( $mydirname ) ;
	$set = '' ;
	foreach( $requests as $key => $val ) {
		$set .= "`$key`='".addslashes( $val )."'," ;
	}

	if( ! $db->query( "INSERT INTO ".$db->prefix($mydirname."_contents")." SET $set `created_time`=UNIX_TIMESTAMP(),`modified_time`=UNIX_TIMESTAMP(),poster_uid='".$xoopsUser->getVar('uid')."',poster_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',body_cached=''" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
	$new_content_id = $db->getInsertId() ;

	return $new_content_id ;
}


// update forum from post
function pico_updatecontent( $mydirname , $content_id )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	$requests = pico_get_requests4content( $mydirname ) ;
	$set = '' ;
	foreach( $requests as $key => $val ) {
		$set .= "`$key`='".addslashes( $val )."'," ;
	}

	if( ! $db->query( "UPDATE ".$db->prefix($mydirname."_contents")." SET $set `modified_time`=UNIX_TIMESTAMP(),modifier_uid='".$xoopsUser->getVar('uid')."',modifier_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',body_cached='' WHERE content_id=$content_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	return $content_id ;
}


?>