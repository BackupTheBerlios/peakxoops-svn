<?php

$constpref = '_MI_' . strtoupper( $mytrustdirname ) ;

$adminmenu[1]['title'] = constant( $constpref.'_UPDATE_SEARCH_INDEX' ) ;
$adminmenu[1]['link']  = "index.php?mode=admin&page=index" ;

?>