<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$current_dirname = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , @$_GET['dirname'] ) ;

$db =& Database::getInstance() ;
$mrs = $db->query( "SELECT m.name,m.dirname FROM ".$db->prefix("modules")." m LEFT JOIN ".$db->prefix("tplfile")." t ON m.dirname=t.tpl_module WHERE m.isactive GROUP BY t.tpl_module ORDER BY m.weight,m.mid" ) ;

$adminmenu = array() ;
while( list( $name , $dirname ) = $db->fetchRow( $mrs ) ) {
	if( $dirname == $current_dirname ) {
		$adminmenu[] = array(
			'color' => '#99FF99' ,
			'title' => $name ,
			'link' => '?mode=admin&lib=altsys&page=mytplsadmin&dirname='.$dirname ,
		) ;
	} else {
		$adminmenu[] = array(
			'color' => '#DDDDDD' ,
			'title' => $name ,
			'link' => '?mode=admin&lib=altsys&page=mytplsadmin&dirname='.$dirname ,
		) ;
	}
}

// display (you can customize htmls)
echo "<div style='text-align:left;width:98%;'>" ;
foreach( $adminmenu as $menuitem ) {
	echo "<div style='float:left;height:1.5em;'><nobr><a href='".htmlspecialchars($menuitem['link'],ENT_QUOTES)."' style='background-color:{$menuitem['color']};font:normal normal bold 9pt/12pt;'>".htmlspecialchars($menuitem['title'],ENT_QUOTES)."</a> | </nobr></div>\n" ;
}
echo "</div>\n<hr style='clear:left;display:block;' />\n" ;


?>