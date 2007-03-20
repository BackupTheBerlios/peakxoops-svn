<?php

include_once dirname(__FILE__).'/include/altsys_functions.php' ;

// language file (modinfo.php)
altsys_include_language_file( 'modinfo' ) ;

$modversion['name'] = _MI_ALTSYS_MODULENAME ;
$modversion['version'] = '0.34' ;
$modversion['description'] = _MI_ALTSYS_MODULEDESC ;
$modversion['credits'] = "PEAK Corp.";
$modversion['author'] = "GIJ=CHECKMATE<br />PEAK Corp.(http://www.peak.ne.jp/)" ;
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "altsys_slogo.png";
$modversion['dirname'] = "altsys";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php?lib=altsys&page=myblocksadmin" ;
$modversion['adminmenu'] = "admin/admin_menu.php";

// Menu
$modversion['hasMain'] = 0;

// Search
$modversion['hasSearch'] = 0;

// Comments
$modversion['hasComments'] = 0;

// Configurations
$modversion['config'][1] = array(
	'name'			=> 'adminmenu_hack_ft' ,
	'title'			=> '_MI_ALTSYS_ADMINMENU_HFT' ,
	'description'	=> '_MI_ALTSYS_ADMINMENU_HFTDSC' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> 0 ,
	'options'		=> array( '_NONE' => 0 , '_MI_ALTSYS_AMHFT_OPT_2COL' => 1 , '_MI_ALTSYS_AMHFT_OPT_NOIMG' => 2 , '_MI_ALTSYS_AMHFT_OPT_XCSTY' => 3 )
) ;

$modversion['config'][] = array(
	'name'			=> 'adminmenu_insert_mymenu' ,
	'title'			=> '_MI_ALTSYS_ADMINMENU_IM' ,
	'description'	=> '_MI_ALTSYS_ADMINMENU_IMDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 0 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'admin_in_theme' ,
	'title'			=> '_MI_ALTSYS_ADMIN_IN_THEME' ,
	'description'	=> '_MI_ALTSYS_ADMIN_IN_THEMEDSC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'default' ,
	'options'		=> array()
) ;

// Notification

$modversion['hasNotification'] = 0;


?>