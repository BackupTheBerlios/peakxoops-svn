<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$adminmenu = array(
	array(
		'title' => _MI_ALTSYS_MENU_CUSTOMBLOCKS ,
		'link' => 'index.php?mode=admin&lib=altsys&page=myblocksadmin&dirname=__CustomBlocks__' ,
	) ,
	array(
		'title' => _MI_ALTSYS_MENU_NEWCUSTOMBLOCK ,
		'link' => 'index.php?mode=admin&lib=altsys&page=myblocksadmin&dirname=__CustomBlocks__&op=edit' ,
	) ,
	array(
		'title' => _MI_ALTSYS_MENU_MYBLOCKSADMIN ,
		'link' => 'index.php?mode=admin&lib=altsys&page=myblocksadmin' ,
	) ,
	array(
		'title' => _MI_ALTSYS_MENU_MYTPLSADMIN ,
		'link' => 'index.php?mode=admin&lib=altsys&page=mytplsadmin' ,
	) ,
	array(
		'title' => _MI_ALTSYS_MENU_COMPILEHOOKADMIN ,
		'link' => 'index.php?mode=admin&lib=altsys&page=compilehookadmin' ,
	) ,
/*	array(
		'title' => _MI_ALTSYS_MENU_MYAVATAR ,
		'link' => 'index.php?mode=admin&lib=altsys&page=myavatar' ,
	) ,*/
	array(
		'title' => _MI_ALTSYS_MENU_MYSMILEY ,
		'link' => 'index.php?mode=admin&lib=altsys&page=mysmiley' ,
	) ,
) ;

?>
