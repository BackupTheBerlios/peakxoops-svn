<?php

// language file (modinfo.php)
$langmanpath = XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ;
if( ! file_exists( $langmanpath ) ) die( 'install the latest altsys' ) ;
require_once( $langmanpath ) ;
$langman =& D3LanguageManager::getInstance() ;
$langman->read( 'modinfo.php' , $mydirname , $mytrustdirname , false ) ;

$constpref = '_MI_' . strtoupper( $mydirname ) ;

$modversion['name'] = $mydirname ;
$modversion['description'] = constant($constpref.'_DESC') ;
$modversion['version'] = 0.33 ;
$modversion['credits'] = "PEAK Corp.";
$modversion['author'] = "GIJ=CHECKMATE<br />PEAK Corp.(http://www.peak.ne.jp/)" ;
$modversion['help'] = "" ;
$modversion['license'] = "GPL" ;
$modversion['official'] = 0 ;
$modversion['image'] = file_exists( $mydirpath.'/module_icon.png' ) ? 'module_icon.png' : 'module_icon.php' ;
$modversion['dirname'] = $mydirname ;

// Any tables can't be touched by modulesadmin.
$modversion['sqlfile'] = false ;
$modversion['tables'] = array() ;

// Admin things
$modversion['hasAdmin'] = 1 ;
$modversion['adminindex'] = 'admin/index.php' ;
$modversion['adminmenu'] = 'admin/admin_menu.php' ;

// Search
$modversion['hasSearch'] = 0 ;

// Menu
$modversion['hasMain'] = 1 ;

// Submenu
$modversion['sub'] = array() ;

// All Templates can't be touched by modulesadmin.
$modversion['templates'] = array() ;

// Blocks
$modversion['blocks'][1] = array(
	'file'			=> 'blocks.php' ,
	'name'			=> constant($constpref.'_BNAME_THEMEHOOK') ,
	'description'	=> '' ,
	'show_func'		=> 'b_dbtheme_theme_hook_show' ,
	'edit_func'		=> 'b_dbtheme_theme_hook_edit' ,
	'options'		=> "$mydirname|{$mydirname}_theme.html" ,
	'template'		=> '' , // use "module" template instead
	'can_clone'		=> true ,
) ;

// Comments
$modversion['hasComments'] = 0 ;

// Configs
$modversion['config'][1] = array(
	'name'			=> 'base_theme' ,
	'title'			=> $constpref.'_BASETHEME' ,
	'description'	=> $constpref.'_BASETHEMEDSC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> @$GLOBALS['xoopsConfig']['theme_set'] ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'css_cache_time' ,
	'title'			=> $constpref.'_CSSCACHETIME' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> 3600 ,
	'options'		=> array()
) ;

// Notification
$modversion['hasNotification'] = 0 ;

// onInstall, onUpdate, onUninstall
$modversion['onInstall'] = 'oninstall.php' ;
$modversion['onUpdate'] = 'onupdate.php' ;
$modversion['onUninstall'] = 'onuninstall.php' ;

// keep block's options
if( ! defined( 'XOOPS_CUBE_LEGACY' ) && substr( XOOPS_VERSION , 6 , 3 ) < 2.1 && ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname(__FILE__).'/include/x20_keepblockoptions.inc.php' ;
}

?>