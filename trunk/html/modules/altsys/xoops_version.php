<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$modversion['name'] = _MI_ALTSYS_MODULENAME ;
$modversion['version'] = '0.21' ;
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

// Config Settings (only for modules that need config settings generated automatically)

// Notification

$modversion['hasNotification'] = 0;

?>
