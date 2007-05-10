<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$current_dirname = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , @$_GET['dirname'] ) ;

$db =& Database::getInstance() ;
$mrs = $db->query( "SELECT m.name,m.dirname,COUNT(t.tpl_module) AS tpl_count FROM ".$db->prefix("modules")." m LEFT JOIN ".$db->prefix("tplfile")." t ON m.dirname=t.tpl_module WHERE m.isactive GROUP BY m.mid HAVING tpl_count>0 ORDER BY m.weight,m.mid" ) ;

$adminmenu = array() ;
while( list( $name , $dirname , $count ) = $db->fetchRow( $mrs ) ) {
	if( $dirname == $current_dirname ) {
		$adminmenu[] = array(
			'selected' => true ,
			'title' => $name . " ($count)" ,
			'link' => '?mode=admin&lib=altsys&page=mytplsadmin&dirname='.$dirname ,
		) ;
		$GLOBALS['altsysXoopsBreadcrumbs'][] = array( 'name' => htmlspecialchars( $name , ENT_QUOTES ) ) ;
	} else {
		$adminmenu[] = array(
			'selected' => false ,
			'title' => $name . " ($count)" ,
			'link' => '?mode=admin&lib=altsys&page=mytplsadmin&dirname='.$dirname ,
		) ;
	}
}

// display
require_once XOOPS_ROOT_PATH.'/class/template.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'adminmenu' => $adminmenu ,
	'highlight_color' => '#99ff99' ,
) ) ;
$tpl->display( 'db:altsys_inc_mymenusub.html' ) ;

?>