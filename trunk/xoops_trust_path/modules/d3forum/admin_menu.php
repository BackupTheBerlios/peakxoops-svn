<?php

$constpref = '_MI_' . strtoupper( $mydirname ) ;

$adminmenu[1]['title'] = constant( $constpref.'_ADMENU_CATEGORYACCESS' ) ;
$adminmenu[1]['link'] = "admin/index.php?page=category_access" ;
$adminmenu[2]['title'] = constant( $constpref.'_ADMENU_FORUMACCESS' ) ;
$adminmenu[2]['link'] = "admin/index.php?page=forum_access" ;
$adminmenu[3]['title'] = constant( $constpref.'_ADMENU_ADVANCEDADMIN' ) ;
$adminmenu[3]['link'] = "admin/index.php?page=advanced_admin" ;

?>