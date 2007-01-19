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

	// delete category_permissions
	if( ! $db->query( "DELETE FROM ".$db->prefix($mydirname."_category_permissions")." WHERE cat_id=$cat_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

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
function pico_sync_content_votes( $mydirname , $content_id )
{
	$db =& Database::getInstance() ;

	$content_id = intval( $content_id ) ;

	$sql = "SELECT cat_id FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=$content_id" ;
	if( ! $result = $db->query( $sql ) ) die( "ERROR SELECT content in sync content_votes" ) ;
	list( $cat_id ) = $db->fetchRow( $result ) ;

	$sql = "SELECT COUNT(*),SUM(vote_point) FROM ".$db->prefix($mydirname."_content_votes")." WHERE content_id=$content_id" ;
	if( ! $result = $db->query( $sql ) ) die( "ERROR SELECT content_votes in sync content_votes" ) ;
	list( $votes_count , $votes_sum ) = $db->fetchRow( $result ) ;

	if( ! $db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET votes_count=".intval($votes_count).",votes_sum=".intval($votes_sum)." WHERE content_id=$content_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	return true ;
}


// get requests for category's sql (parse options)
function pico_get_requests4category( $mydirname )
{
	$myts =& MyTextSanitizer::getInstance() ;
	$db =& Database::getInstance() ;

	include dirname(dirname(__FILE__)).'/include/constant_can_override.inc.php' ;
	$cat_options = array() ;
	foreach( $GLOBALS['xoopsModuleConfig'] as $key => $val ) {
		if( empty( $pico_configs_can_be_override[ $key ] ) ) continue ;
		foreach( explode( "\n" , @$_POST['cat_options'] ) as $line ) {
			if( preg_match( '/^'.$key.'\:(.{1,100})$/' , $line , $regs ) ) {
				switch( $pico_configs_can_be_override[ $key ] ) {
					case 'text' :
						$cat_options[ $key ] = trim( $regs[1] ) ;
						break ;
					case 'int' :
						$cat_options[ $key ] = intval( $regs[1] ) ;
						break ;
					case 'bool' :
						$cat_options[ $key ] = intval( $regs[1] ) > 0 ? 1 : 0 ;
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
		'cat_title' => $myts->stripSlashesGPC( @$_POST['cat_title'] ) ,
		'cat_desc' => $myts->stripSlashesGPC( @$_POST['cat_desc'] ) ,
		'cat_weight' => intval( @$_POST['cat_weight'] ) ,
		'cat_vpath' => trim( $myts->stripSlashesGPC( @$_POST['cat_vpath'] ) ) ,
		'pid' => $pid ,
		'cat_options' => serialize( $cat_options ) ,
	) ;
}


// create a category
function pico_makecategory( $mydirname )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	$requests = pico_get_requests4category( $mydirname ) ;
	foreach( $requests as $key => $val ) {
		if( $key == 'cat_vpath' && empty( $val ) ) {
			$set .= "`$key`=null," ;
		} else {
			$set .= "`$key`='".addslashes( $val )."'," ;
		}
	}

	if( ! $db->query( "INSERT INTO ".$db->prefix($mydirname."_categories")." SET $set `cat_path_in_tree`='',`cat_unique_path`=''" ) ) die( _MD_PICO_ERR_DUPLICATEDVPATH ) ;
	$new_cat_id = $db->getInsertId() ;

	// permissions are set same as the parent category. (also moderator)
	$sql = "SELECT uid,groupid,permissions FROM ".$db->prefix($mydirname."_category_permissions")." WHERE cat_id={$requests['pid']}" ;
	if( ! $result = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
	while( $row = $db->fetchArray( $result ) ) {
		$uid4sql = empty( $row['uid'] ) ? 'null' : intval( $row['uid'] ) ;
		$groupid4sql = empty( $row['groupid'] ) ? 'null' : intval( $row['groupid'] ) ;
		$sql = "INSERT INTO ".$db->prefix($mydirname."_category_permissions")." (cat_id,uid,groupid,permissions) VALUES ($new_cat_id,$uid4sql,$groupid4sql,'".addslashes($row['permissions'])."')" ;
		if( ! $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
	}

	// rebuild category tree
	pico_sync_cattree( $mydirname ) ;

	return $new_cat_id ;
}


// update category
function pico_updatecategory( $mydirname , $cat_id )
{
	$db =& Database::getInstance() ;

	$requests = pico_get_requests4category( $mydirname ) ;
	foreach( $requests as $key => $val ) {
		if( $key == 'cat_vpath' && empty( $val ) ) {
			$set .= "`$key`=null," ;
		} else {
			$set .= "`$key`='".addslashes( $val )."'," ;
		}
	}

	// get children
	include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
	$mytree = new XoopsTree( $db->prefix($mydirname."_categories") , "cat_id" , "pid" ) ;
	$children = $mytree->getAllChildId( $cat_id ) ;
	$children[] = $cat_id ;

	// loop check
	if( in_array( $requests['pid'] , $children ) ) die( _MD_PICO_ERR_PIDLOOP ) ;

	if( ! $db->query( "UPDATE ".$db->prefix($mydirname."_categories")." SET ".substr($set,0,-1)." WHERE cat_id=$cat_id" ) ) die( _MD_PICO_ERR_DUPLICATEDVPATH ) ;

	// rebuild category tree
	pico_sync_cattree( $mydirname ) ;

	return $cat_id ;
}


// get requests for content's sql (parse options)
function pico_get_requests4content( $mydirname , $auto_approval = true , $isadminormod = false )
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
			$name = str_replace( '..' , '' , substr( $key , 15 ) ) ;
			$constpref = '_MD_PICO_FILTERS_' . strtoupper( $name ) ;
			$filter_file = dirname(dirname(__FILE__)).'/filters/pico_'.$name.'.php' ;
			if( ! file_exists( $filter_file ) ) continue ;
			require_once $filter_file ;
			if( ! $isadminormod && defined( $constpref.'ISINSECURE' ) ) continue ;			$filters[ $name ] = intval( @$_POST['filter_weight_'.$name] ) ;
		}
	}
	asort( $filters ) ;

	$ret = array( 
		'cat_id' => $cat_id ,
		'vpath' => trim( $myts->stripSlashesGPC( @$_POST['vpath'] ) ) ,
		'subject' => $myts->stripSlashesGPC( @$_POST['subject'] ) ,
		'htmlheader' => $myts->stripSlashesGPC( @$_POST['htmlheader'] ) ,
		'body' => $myts->stripSlashesGPC( @$_POST['body'] ) ,
		'filters' => implode( '|' , array_keys( $filters ) ) ,
		'weight' => intval( @$_POST['weight'] ) ,
		'use_cache' => empty( $_POST['use_cache'] ) ? 0 : 1 ,
		'show_in_navi' => empty( $_POST['show_in_navi'] ) ? 0 : 1 ,
		'show_in_menu' => empty( $_POST['show_in_menu'] ) ? 0 : 1 ,
		'allow_comment' => empty( $_POST['allow_comment'] ) ? 0 : 1 ,
	) ;

	// approval
	if( $auto_approval ) {
		$ret += array(
			'subject_waiting' => '' ,
			'htmlheader_waiting' => '' ,
			'body_waiting' => '' ,
			'visible' => empty( $_POST['visible'] ) ? 0 : 1 ,
			'approval' => 1 ,
		) ;
	} else {
		$ret += array(
			'subject_waiting' => $myts->stripSlashesGPC( @$_POST['subject'] ) ,
			'htmlheader_waiting' => $myts->stripSlashesGPC( @$_POST['htmlheader'] ) ,
			'body_waiting' => $myts->stripSlashesGPC( @$_POST['body'] ) ,
			'visible' => 0 ,
			'approval' => 0 ,
		) ;
	}
	return $ret ;
}


// create content
function pico_makecontent( $mydirname , $auto_approval = true , $isadminormod = false )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	$requests = pico_get_requests4content( $mydirname , $auto_approval , $isadminormod ) ;
	$ignore_requests = $auto_approval ? array() : array( 'subject' , 'htmlheader' , 'body' , 'visible' ) ;
	$set = $auto_approval ? '' : "visible=0,subject='"._MD_PICO_WAITINGREGISTER."',htmlheader='',body=''," ;
	foreach( $requests as $key => $val ) {
		if( in_array( $key , $ignore_requests ) ) continue ;
		if( $key == 'vpath' && empty( $val ) ) {
			$set .= "`$key`=null," ;
		} else {
			$set .= "`$key`='".addslashes( $val )."'," ;
		}
	}

	if( ! $db->query( "INSERT INTO ".$db->prefix($mydirname."_contents")." SET $set `created_time`=UNIX_TIMESTAMP(),`modified_time`=UNIX_TIMESTAMP(),poster_uid='".$xoopsUser->getVar('uid')."',poster_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',body_cached=''" ) ) die( _MD_PICO_ERR_DUPLICATEDVPATH ) ;
	$new_content_id = $db->getInsertId() ;

	return $new_content_id ;
}


// update content
function pico_updatecontent( $mydirname , $content_id , $auto_approval = true , $isadminormod )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	$requests = pico_get_requests4content( $mydirname , $auto_approval , $isadminormod ) ;
	$ignore_requests = $auto_approval ? array() : array( 'subject' , 'htmlheader' , 'body' , 'visible' , 'filters' , 'show_in_navi' , 'show_in_menu' , 'allow_comment' , 'use_cache' , 'weight' , 'cat_id' ) ;
	$set = '' ;
	foreach( $requests as $key => $val ) {
		if( in_array( $key , $ignore_requests ) ) continue ;
		if( $key == 'vpath' && empty( $val ) ) {
			$set .= "`$key`=null," ;
		} else {
			$set .= "`$key`='".addslashes( $val )."'," ;
		}
	}

	if( ! $db->query( "UPDATE ".$db->prefix($mydirname."_contents")." SET $set `modified_time`=UNIX_TIMESTAMP(),modifier_uid='".$xoopsUser->getVar('uid')."',modifier_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',body_cached='' WHERE content_id=$content_id" ) ) die( _MD_PICO_ERR_DUPLICATEDVPATH ) ;

	return $content_id ;
}


// copy from waiting fields
function pico_copyfromwaitingcontent( $mydirname , $content_id )
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( ! $db->query( "UPDATE ".$db->prefix($mydirname."_contents")." SET body=body_waiting, subject=subject_waiting, htmlheader=htmlheader_waiting, visible=1, approval=1 WHERE content_id=$content_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
	if( ! $db->query( "UPDATE ".$db->prefix($mydirname."_contents")." SET body_waiting='',subject_waiting='',htmlheader_waiting='',`modified_time`=UNIX_TIMESTAMP(),modifier_uid='".$xoopsUser->getVar('uid')."',modifier_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',body_cached='' WHERE content_id=$content_id" ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;

	return $content_id ;
}


?>