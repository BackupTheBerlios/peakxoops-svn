<?php
$constpref = '_MI_' . strtoupper( $mydirname ) ;

$adminmenu = array(
	array(
		'title' => constant( $constpref.'_ADMENU5' ) ,
		'link' => 'admin/index.php?op=list' ,
	) ,
	array(
		'title' => constant( $constpref.'_ADMENU2' ) ,
		'link' => 'admin/index.php?op=topicsmanager' ,
	) ,
	array(
		'title' => constant( $constpref.'_ADMENU4' ) ,
		'link' => 'admin/index.php?op=permition' ,
	) ,
	array(
		'title' => constant( $constpref.'_ADMENU7' ) ,
		'link' => 'admin/index.php?op=convert' ,
	) ,
) ;

$adminmenu4altsys = array(
	array(
		'title' => 'tplsadmin' ,
		'link' => 'admin/index.php?mode=admin&lib=altsys&page=mytplsadmin' ,
	) ,
	array(
		'title' => 'blocksadmin' ,
		'link' => 'admin/index.php?mode=admin&lib=altsys&page=myblocksadmin' ,
	) ,
	array(
		'title' => _PREFERENCES ,
		'link' => 'admin/index.php?mode=admin&lib=altsys&page=mypreferences' ,
	) ,
) ;

?>