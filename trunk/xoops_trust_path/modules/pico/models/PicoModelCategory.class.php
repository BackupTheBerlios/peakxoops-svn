<?php

require_once dirname(__FILE__).'/PicoModelContent.class.php' ;
require_once dirname(dirname(__FILE__)).'/class/PicoPermission.class.php' ;

class PicoCategoryHandler {

var $mydirname ;
var $permissions ;

function PicoCategoryHandler( $mydirname , $permissions = null )
{
	$this->mydirname = $mydirname ;
	if( $permissions ) {
		$this->permissions = $permissions ;
	} else {
		$picoPermission =& PicoPermission::getInstance() ;
		$this->permissions = $picoPermission->getPermissions( $mydirname ) ;
	}
}

function getAllCategories( $return_prohibited_also = false )
{
	$db =& Database::getInstance() ;

	$sql = "SELECT cat_id FROM ".$db->prefix($this->mydirname."_categories")." WHERE 1 ORDER BY cat_order_in_tree" ;
	if( ! $crs = $db->query( $sql ) ) {
		if( $GLOBALS['xoopsUser']->isAdmin() ) echo $db->logger->dumpQueries() ;
		exit ;
	}

	$ret = array() ;
	while( list( $cat_id ) = $db->fetchRow( $crs ) ) {
		$objTemp =& new PicoCategory( $this->mydirname , $cat_id , $this->permissions ) ;
		if( $return_prohibited_also || $objTemp->data['can_read'] ) $ret[ $cat_id ] =& $objTemp ;
	}

	return $ret ;
}

function getSubCategories( $cat_id , $return_prohibited_also = false , $return_as_object = true )
{
	$db =& Database::getInstance() ;

	$cat_id = intval( $cat_id ) ;
	$sql = "SELECT cat_id FROM ".$db->prefix($this->mydirname."_categories")." WHERE pid=$cat_id ORDER BY cat_order_in_tree" ;
	if( ! $crs = $db->query( $sql ) ) {
		if( $GLOBALS['xoopsUser']->isAdmin() ) echo $db->logger->dumpQueries() ;
		exit ;
	}

	$ret = array() ;
	while( list( $cat_id ) = $db->fetchRow( $crs ) ) {
		$objTemp =& new PicoCategory( $this->mydirname , $cat_id , $this->permissions ) ;
		if( $return_prohibited_also || $objTemp->data['can_read'] ) {
			if( $return_as_object ) {
				$ret[ $cat_id ] =& $objTemp ;
			} else {
				$ret[] = $content_id ;
			}
		}
	}

	return $ret ;
}


function &get( $cat_id )
{
	$retObj =& new PicoCategory( $this->mydirname , $cat_id , $this->permissions ) ;
	return $retObj ;
}


function touchVpathMtime( $cat_id , $mtime = null )
{
	$db =& Database::getInstance() ;

	$mtime = empty( $mtime ) ? time() : intval( $mtime ) ;
	$db->queryF( "UPDATE ".$db->prefix($this->mydirname."_categories")." SET `cat_vpath_mtime`=$mtime WHERE cat_id=$cat_id" ) ;
}


}


class PicoCategory {

var $permission ;
var $data = array() ;
var $isadminormod ;
var $mydirname ;
var $mod_config ;
var $mod_name ;
var $errorno = 0 ;
var $isadmin = false ;
var $content_ids = null ;
var $content_ids_in_navi = null ;
var $child_ids = null ;

function PicoCategory( $mydirname , $cat_id , $permissions , $allow_makenew = false , $parentObj = null )
{
	$this->mydirname = $mydirname ;

	$db =& Database::getInstance() ;

	// get this "category" from given $cat_id
	$sql = "SELECT * FROM ".$db->prefix($mydirname."_categories")." WHERE cat_id=$cat_id" ;
	if( ! $crs = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__.__FUNCTION__ ) ;
	if( $db->getRowsNum( $crs ) <= 0 ) {
		if( $allow_makenew && is_object( $parentObj ) ) {
			$cat_row = $this->getBlankCategoryRow( $parentObj ) ;
		} else {
			$this->errorno = 1 ; // the category does not exist
			return ;
		}
	} else {
		$cat_row = $db->fetchArray( $crs ) ;
	}
	$this->permission = @$permissions[ @$cat_row['cat_permission_id'] ] ;
	$this->isadmin = $permissions['is_module_admin'] ;
	$this->isadminormod = ! empty( $this->permission['is_moderator'] ) || $this->isadmin ;
	$this->data = array(
		'id' => intval( $cat_row['cat_id'] ) ,
		'isadmin' => $this->isadmin ,
		'isadminormod' => $this->isadminormod ,
		'depth_in_tree' => $cat_row['cat_depth_in_tree'] + 1 ,
		'can_read' => ( $this->isadminormod || ! empty( $this->permission ) ) ,
		'can_readfull' => ( $this->isadminormod || @$this->permission['can_readfull'] ) ,
		'can_post' => ( $this->isadminormod || @$this->permission['can_post'] ) ,
		'can_edit' => ( $this->isadminormod || @$this->permission['can_edit'] ) ,
		'can_delete' => ( $this->isadminormod || @$this->permission['can_delete'] ) ,
		'post_auto_approved' => ( $this->isadminormod || @$this->permission['post_auto_approved'] ) ,
		'can_makesubcategory' => ( $this->isadminormod || @$this->permission['can_makesubcategory'] ) ,
		'cat_options' => pico_common_unserialize( $cat_row['cat_options'] ) ,
		'paths_raw' => pico_common_unserialize( $cat_row['cat_path_in_tree'] ) ,
		'redundants' => pico_common_unserialize( $cat_row['cat_redundants'] ) ,
		'ef' => pico_common_unserialize( $cat_row['cat_extra_fields'] ) ,
	) + $cat_row ;

	// array guarantee
	foreach( array( 'cat_options' , 'paths_raw' , 'redundants' , 'ef' ) as $key ) {
		if( ! is_array( $this->data[$key] ) ) $this->data[$key] = array() ;
	}

	// set mod_config
	$this->setOverriddenModConfig() ;
}


function getData()
{
	return $this->data ;
}


function getData4html()
{
	$myts =& PicoTextSanitizer::getInstance() ;

	return array(
		'link' => pico_common_make_category_link4html( $this->mod_config , $this->data ) ,
		'title' => $myts->makeTboxData4Show( $this->data['cat_title'] , 1 , 1 ) ,
		'desc' => $myts->displayTarea( $this->data['cat_desc'] , 1 ) ,
		'weight' => intval( $this->data['cat_weight'] ) ,
	) + $this->data ;
}


function getData4edit()
{
	$options4edit = '' ;
	foreach( $this->data['cat_options'] as $key => $val ) {
		$options4edit .= htmlspecialchars( $key.': '.$val."\n" , ENT_QUOTES ) ;
	}

	$ret4edit = array(
		'title' => htmlspecialchars( $this->data['cat_title'] , ENT_QUOTES ) ,
		'vpath' => htmlspecialchars( $this->data['cat_vpath'] , ENT_QUOTES ) ,
		'desc' => htmlspecialchars( $this->data['cat_desc'] , ENT_QUOTES ) ,
		'options' => $options4edit ,
		'children_count' => count( @$this->data['redundants']['subcattree_raw'] ) ,
	) + $this->getData4html() ;

	return $ret4edit ;
}


function getBlankCategoryRow( $parentObj )
{
	$mod_config = $parentObj->getOverriddenModConfig() ;
	$pcat_data = $parentObj->getData() ;
	$uid = is_object( @$GLOBALS['xoopsUser'] ) ? $GLOBALS['xoopsUser']->getVar('uid') : 0 ;

	return array(
		'cat_id' => -1 ,
		'cat_permission_id' => 0 ,
		'cat_vpath' => '' ,
		'pid' => $pcat_data['id'] ,
		'cat_title' => '' ,
		'cat_desc' => '' ,
		'cat_depth_in_tree' => 0 ,
		'cat_order_in_tree' => 0 ,
		'cat_path_in_tree' => '' ,
		'cat_unique_path' => '' ,
		'cat_weight' => 0 ,
		'cat_options' => '' ,
		'cat_created_time' => time() ,
		'cat_modified_time' => time() ,
		'cat_vpath_mtime' => 0 ,
		'cat_extra_fields' => pico_common_serialize( array() ) ,
		'cat_redundants' => '' ,
	) ;
}


function setOverriddenModConfig()
{
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($this->mydirname);
	$config_handler =& xoops_gethandler('config');
	$this->mod_config = $config_handler->getConfigList( $module->getVar('mid') ) ;
	$this->mod_name = $module->getVar( 'name' , 'n' ) ;

	if( empty( $this->mod_config['inherit_configs'] ) ) {
		// 1.7/1.8 compatible (overridding by the single generation)
		foreach( $this->data['cat_options'] as $key => $val ) {
			if( isset( $this->mod_config[ $key ] ) ) {
				$this->mod_config[ $key ] = $val ;
			}
		}
	} else {
		// options(mod_config) overridden by every parents hierarchically
		foreach( $this->data['redundants']['parents_options'] as $cat_id => $serialized_options ) {
			$options = @pico_common_unserialize( $serialized_options ) ;
			if( ! is_array( $options ) ) continue ;
			foreach( $options as $key => $val ) {
				if( isset( $this->mod_config[ $key ] ) ) {
					$this->mod_config[ $key ] = $val ;
				}
			}
		}
	}
}

function getOverriddenModConfig()
{
	return $this->mod_config ;
}

function getBreadcrumbs()
{
	if( ! is_array( $this->data['paths_raw'] ) ) return array() ;
	$ret = array() ;
	foreach( $this->data['paths_raw'] as $cat_id => $name_raw ) {
		$ret[] = array(
			// TODO (returns raw data as possible)
			'url' => XOOPS_URL.'/modules/'.$this->mydirname.'/'.pico_common_make_category_link4html( $this->mod_config , $cat_id , $this->mydirname ) ,
			'name' => htmlspecialchars( $name_raw , ENT_QUOTES ) ,
		) ;
	}
	return $ret ;
}

function getContents( $return_prohibited_also = false )
{
	$content_handler =& new PicoContentHandler( $this->mydirname ) ;
	return $content_handler->getCategoryContents( $this , $return_prohibited_also ) ;
}

function getLatestContents( $num = 0 , $fetch_from_subcategories = false )
{
	$content_handler =& new PicoContentHandler( $this->mydirname ) ;
	return $content_handler->getCategoryLatestContents( $this , $num , $fetch_from_subcategories ) ;
}

// all ids of belonging contents
function getContentIds()
{
	if( ! isset( $this->content_ids ) ) {
		$content_handler =& new PicoContentHandler( $this->mydirname ) ;
		$this->content_ids = $content_handler->getCategoryContents( $this , true , false ) ;
	}

	return $this->content_ids ;
}

// ids of beloging contents can be displayed in the navigation
function getContentIdsInNavi()
{
	if( ! isset( $this->content_ids_in_navi ) ) {
		$content_handler =& new PicoContentHandler( $this->mydirname ) ;
		$this->content_ids_in_navi = $content_handler->getCategoryContents( $this , false , false , 'o.show_in_navi>0' ) ;
	}

	return $this->content_ids_in_navi ;
}

function crawlChildIds( $node = null )
{
	if( empty( $node ) ) {
		$node = $this->data['redundants']['subcattree_raw'] ;
		$this->child_ids = array() ;
	}
	foreach( $node as $subnode ) {
		$this->child_ids[] = $subnode['cat_id'] ;
		if( ! empty( $subnode['subcattree_raw'] ) ) {
			$this->crawlChildIds( $subnode['subcattree_raw'] ) ;
		}
	}
}

function getChildIds()
{
	if( is_null( $this->child_ids ) ) {
		$this->crawlChildIds() ;
	}
	return $this->child_ids ;
}

function isError()
{
	return $this->errorno > 0 ;
}


}

?>