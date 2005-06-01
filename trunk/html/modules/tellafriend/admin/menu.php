<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$adminmenu[0]['title'] = _MI_TELLAFRIEND_LOG ;
$adminmenu[0]['link'] = "admin/index.php" ;

$adminmenu[] = array(
	'title' => _MI_TELLAFRIEND_GROUPADMIN ,
	'link' => "admin/myblocksadmin.php"
) ;

?>