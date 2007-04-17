<?php

function d3pipes_common_get_submenu( $mydirname , $caller = 'xoops_version' )
{
	$module_handler =& xoops_gethandler('module') ;
	$module =& $module_handler->getByDirname( $mydirname ) ;
	if( ! is_object( $module ) ) return array() ;
	$config_handler =& xoops_gethandler('config') ;
	$mod_config =& $config_handler->getConfigsByCat( 0 , $module->getVar('mid') ) ;

	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance();

	// pipes query
	$sql = "SELECT pipe_id,name FROM ".$db->prefix($mydirname."_pipes")." WHERE in_submenu ORDER BY weight" ;
	$prs = $db->query( $sql ) ;
	$submenus = array() ;
	if( $prs ) while( $pipe_row = $db->fetchArray( $prs ) ) {
		$pipe_id = intval( $pipe_row['pipe_id'] ) ;
		$submenus[ $pipe_id ] = array(
			'name' => $myts->makeTboxData4Show( $pipe_row['name'] ) ,
			'url' => 'index.php?page=eachpipe&amp;pipe_id='.$pipe_id ,
		) ;
	}

	return $submenus ;
}


function d3pipes_common_get_default_joint_class( $mydirname , $joint_type )
{
	$db =& Database::getInstance() ;

	list( $ret ) = $db->fetchRow( $db->query( "SELECT default_class FROM ".$db->prefix($mydirname."_joints")." WHERE joint_type='".addslashes($joint_type)."'" ) ) ;
	if( empty( $ret ) ) {
		$classes_base = XOOPS_TRUST_PATH.'/modules/d3pipes/joints/'.$joint_type ;
		if( $handler = @opendir( $classes_base ) ) {
			while( ( $file = readdir( $handler ) ) !== false ) {
				if( substr( $file , 0 , 1 ) == '.' ) continue ;
				$file = str_replace( '..' , '' , $file ) ;
				if( file_exists( $classes_base . '/' . $file ) ) {
					$ret = strtolower( substr( $file , strlen( 'D3pipes'.$joint_type ) , - strlen( '.class.php' ) ) ) ;
					break ;
				}
			}
		}
	}
	
	return $ret ;
}


function d3pipes_common_get_xml_cache_path( $mydirname , $url = '' )
{
	$salt = substr( md5( XOOPS_ROOT_PATH . XOOPS_DB_USER . XOOPS_DB_PREFIX ) , 0 , 6 ) ;
	$base = XOOPS_TRUST_PATH.'/cache/'.$mydirname.'_'.$salt.'_' ;

	return $url ? $base.md5($url) : $base ;
}


function d3pipes_common_get_clipping( $mydirname , $clipping_id )
{
	require_once dirname(dirname(__FILE__)).'/joints/clip/D3pipesClipModuledb.class.php' ;

	$clip_obj =& new D3pipesClipModuledb( $mydirname , 0 , '' ) ;
	return $clip_obj->getClipping( $clipping_id ) ;
}


function &d3pipes_common_get_joint_object_default( $mydirname , $joint_type , $option = '' )
{
	$class_name = 'D3pipes'.ucfirst($joint_type).ucfirst(d3pipes_common_get_default_joint_class( $mydirname , $joint_type )) ;
	require_once dirname(dirname(__FILE__)).'/joints/'.$joint_type.'/'.$class_name.'.class.php' ;
	$ret =& new $class_name( $mydirname , 0 , $option ) ;
	return $ret ;
}


function d3pipes_common_get_pipe4assign( $mydirname , $pipe_id )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance() ;

	// fetch pipe_row
	$pipe_row = $db->fetchArray( $db->query( "SELECT * FROM ".$db->prefix($mydirname."_pipes")." WHERE pipe_id=".intval($pipe_id) ) ) ;
	if( empty( $pipe_row ) ) return false ;

	$pipe4assign = array(
		'id' => intval( $pipe_id ) ,
		'name' => $myts->makeTboxData4Show( $pipe_row['name'] ) ,
		'name4xml' => htmlspecialchars( $pipe_row['name'] , ENT_QUOTES ) ,
		'url' => $myts->makeTboxData4Show( $pipe_row['url'] ) ,
		'url4xml' => htmlspecialchars( $pipe_row['url'] , ENT_QUOTES ) ,
		'image' => $myts->makeTboxData4Show( $pipe_row['image'] ) ,
		'image4xml' => htmlspecialchars( $pipe_row['image'] , ENT_QUOTES ) ,
		'created_time_formatted' => formatTimestamp( $pipe_row['created_time'] , 'm' ) ,
		'modified_time_formatted' => formatTimestamp( $pipe_row['modified_time'] , 'm' ) ,
		'lastfetch_time_formatted' => $pipe_row['lastfetch_time'] ? formatTimestamp( $pipe_row['lastfetch_time'] , 'm' ) : '----' ,
		'joints' => unserialize( $pipe_row['joints'] ) ,
	) + $pipe_row ;

	if( empty( $pipe4assign['joints'] ) ) return false ;
	else return $pipe4assign ;
}



function d3pipes_common_fetch_entries( $mydirname , $pipe_row , $max_entries , &$errors , $mod_configs )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance() ;

	$joints = $pipe_row['joints'] ;
	$pipe_id = $pipe_row['pipe_id'] ;

	$joints_dir = dirname(dirname(__FILE__)).'/joints' ;
	$initial_joints = array( 'fetch' , 'local' , 'block' , 'union' ) ;

	$objects = array() ;

	// make objects of each joints
	$is_started = false ;
	$cache_obj_pos = 0 ;
	$cache_obj = false ;
	foreach( $joints as $joint ) {
		if( in_array( $joint['joint'] , $initial_joints ) ) $is_started = true ;
		if( ! $is_started ) continue ;

		$class_name = 'D3pipes'.ucfirst($joint['joint']).ucfirst($joint['joint_class']) ;
		require_once $joints_dir.'/'.$joint['joint'].'/'.$class_name.'.class.php' ;
		$objects[] =& new $class_name( $mydirname , $pipe_id , $joint['option'] ) ;
		if( $joint['joint'] == 'clip' ) {
			$cache_obj_pos = sizeof( $objects ) - 1 ;
			$cache_obj =& $objects[ $cache_obj_pos ] ;
			$cache_time = $cache_obj->cache_time ;
		}
	}
	if( empty( $objects ) ) return false ;

	// chain data is initialized
	$data = null ;

	// cache is valid?
	if( is_object( $cache_obj ) && $pipe_row['lastfetch_time'] + $cache_time > time() ) {
		$objects = array_slice( $objects , $cache_obj_pos + 1) ;
		$data = $cache_obj->getCaches( $max_entries ) ;
	} else {
		// updated lastfetch_time
		$db->queryF( "UPDATE ".$db->prefix($mydirname."_pipes")." SET lastfetch_time=UNIX_TIMESTAMP() WHERE pipe_id=$pipe_id" ) ;
	}

	// joint chains
	$errors = array() ;
	foreach( $objects as $obj ) {
		$obj->setModConfigs( $mod_configs ) ;
		$data = $obj->execute( $data , $max_entries ) ;
		$errors = array_merge( $errors , $obj->errors ) ;
	}

	return array_slice( $data , 0 , $max_entries ) ;
}

?>