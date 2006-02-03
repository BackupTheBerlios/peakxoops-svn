<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$adminmenu = array() ;

$db =& Database::getInstance() ;
$mrs = $db->query( "SELECT m.name,m.dirname FROM ".$db->prefix("modules")." m LEFT JOIN ".$db->prefix("tplfile")." t ON m.dirname=t.tpl_module WHERE m.isactive GROUP BY t.tpl_module ORDER BY m.weight" ) ;

while( list( $name , $dirname ) = $db->fetchRow( $mrs ) ) {
	$adminmenu[] = array(
		'title' => htmlspecialchars( $name , ENT_QUOTES ) ,
		'link' => "admin/mytplsadmin.php?dirname=".htmlspecialchars( $dirname , ENT_QUOTES )
	) ;
}
?>