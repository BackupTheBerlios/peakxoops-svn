<?php

$constpref = '_MI_' . strtoupper( $mydirname ) ;

$adminmenu[1]['title'] = constant( $constpref.'_ADMININDEX' ) ;
$adminmenu[1]['link'] = "admin/index.php" ;

$adminmenu[2]['title'] = constant( $constpref.'_ADVISORY' ) ;
$adminmenu[2]['link'] = "admin/index.php?page=advisory" ;

$adminmenu[3]['title'] = constant( $constpref.'_PREFIXMANAGER' ) ;
$adminmenu[3]['link'] = "admin/index.php?page=prefix_manager" ;

?>