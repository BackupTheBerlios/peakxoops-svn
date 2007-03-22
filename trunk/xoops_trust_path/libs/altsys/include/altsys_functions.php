<?php

set_altsys_module_config() ;

function set_altsys_module_config()
{
	global $altsysModuleConfig , $altsysModuleId ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( 'altsys' ) ;
	if( is_object( $module ) ) {
		$config_handler =& xoops_gethandler( 'config' ) ;
		$altsysModuleConfig = $config_handler->getConfigList( $module->getVar('mid') ) ;
		$altsysModuleId = $module->getVar('mid') ;
	} else {
		$altsysModuleConfig = array() ;
		$altsysModuleId = 0 ;
	}
}


function altsys_include_mymenu()
{
	global $xoopsModule , $xoopsConfig , $mydirname , $mydirpath , $mytrustdirname , $mytrustdirpath , $mymenu_fake_uri ;

	$mymenu_find_paths = array(
		$mydirpath.'/admin/mymenu.php' ,
		$mydirpath.'/mymenu.php' ,
		$mytrustdirpath.'/admin/mymenu.php' ,
		$mytrustdirpath.'/mymenu.php' ,
	) ;

	foreach( $mymenu_find_paths as $mymenu_find_path ) {
		if( file_exists( $mymenu_find_path ) ) {
			include $mymenu_find_path ;
			include_once dirname(__FILE__).'/adminmenu_functions.php' ;
			altsys_adminmenu_insert_mymenu( $xoopsModule ) ;
			altsys_adminmenu_hack_ft() ;
			break ;
		}
	}
}


function altsys_include_language_file( $type )
{
	$mylang = $GLOBALS['xoopsConfig']['language'] ;

	if( file_exists( XOOPS_ROOT_PATH.'/modules/altsys/language/'.$mylang.'/'.$type.'.php' ) ) {
		include_once XOOPS_ROOT_PATH.'/modules/altsys/language/'.$mylang.'/'.$type.'.php' ;
	} else if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/language/'.$mylang.'/'.$type.'.php' ) ) {
		include_once XOOPS_TRUST_PATH.'/libs/altsys/language/'.$mylang.'/'.$type.'.php' ;
	} else if( file_exists( XOOPS_ROOT_PATH.'/modules/altsys/language/english/'.$type.'.php' ) ) {
		include_once XOOPS_ROOT_PATH.'/modules/altsys/language/english/'.$type.'.php' ;
	} else if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/language/english/'.$type.'.php' ) ) {
		include_once XOOPS_TRUST_PATH.'/libs/altsys/language/english/'.$type.'.php' ;
	}
}


define( 'ALTSYS_CORE_TYPE_X20' , 1 ) ; // 2.0.0-2.0.13 and 2.0.x-JP
define( 'ALTSYS_CORE_TYPE_X20S' , 2 ) ; // 2.0.14- from xoops.org Skalpa's "S"
define( 'ALTSYS_CORE_TYPE_ORE' , 4 ) ; // ORETEKI by marijuana
define( 'ALTSYS_CORE_TYPE_X22' , 8 ) ; // 2.2 from xoops.org
define( 'ALTSYS_CORE_TYPE_XC21L' , 16 ) ; // XOOPS Cube 2.1 Legacy

function altsys_get_core_type()
{
	if( defined( 'XOOPS_ORETEKI' ) ) return ALTSYS_CORE_TYPE_ORE ;
	else if( defined( 'XOOPS_CUBE_LEGACY' ) ) return ALTSYS_CORE_TYPE_XC21L ;
	else if( strstr( XOOPS_VERSION , 'JP' ) ) return ALTSYS_CORE_TYPE_X20 ;
	else {
		$versions = array_map( 'intval' , explode( '.' , preg_replace( '/[^0-9.]/' , '' , XOOPS_VERSION ) ) ) ;
		if( $versions[0] == 2 && $versions[1] > 0 ) {
			return ALTSYS_CORE_TYPE_X22 ;
		} else if( $versions[0] == 2 && $versions[1] == 0 && $versions[2] > 13 ) {
			return ALTSYS_CORE_TYPE_X20S ;
		} else {
			return ALTSYS_CORE_TYPE_X20 ;
		}
	}
}


?>