<?php

$constpref = '_MI_' . strtoupper( $mytrustdirname ) ;

$adminmenu[1]['title'] = constant( $constpref.'_ADMENU_CATEGORYACCESS' ) ;
$adminmenu[1]['link'] = "admin/index.php?page=category_access" ;

?>