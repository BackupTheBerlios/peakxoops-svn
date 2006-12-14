<?php

$constpref = '_MI_' . strtoupper( $mydirname ) ;

$adminmenu[1]['title'] = constant( $constpref.'_ADMENU_CONTENTSADMIN' ) ;
$adminmenu[1]['link'] = "admin/index.php?page=contents" ;

$adminmenu[2]['title'] = constant( $constpref.'_ADMENU_CATEGORYACCESS' ) ;
$adminmenu[2]['link'] = "admin/index.php?page=category_access" ;

$adminmenu[3]['title'] = constant( $constpref.'_ADMENU_IMPORT' ) ;
$adminmenu[3]['link'] = "admin/index.php?page=import" ;

?>