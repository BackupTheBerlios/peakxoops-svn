<?php

$constpref = '_MI_' . strtoupper( $mydirname ) ;

$adminmenu[1]['title'] = constant( $constpref.'_ADMENU_CATEGORYACCESS' ) ;
$adminmenu[1]['link'] = "index.php?mode=admin&page=category_access" ;
$adminmenu[2]['title'] = constant( $constpref.'_ADMENU_FORUMACCESS' ) ;
$adminmenu[2]['link'] = "index.php?mode=admin&page=forum_access" ;
$adminmenu[3]['title'] = constant( $constpref.'_ADMENU_ADVANCEDADMIN' ) ;
$adminmenu[3]['link'] = "index.php?mode=admin&page=advanced_admin" ;

?>