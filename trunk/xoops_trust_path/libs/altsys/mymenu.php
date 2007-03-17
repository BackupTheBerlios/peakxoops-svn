<?php

// mymenu only for ALTSYS

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// Skip for ORETEKI XOOPS
if( defined( 'XOOPS_ORETEKI' ) ) return ;

if( ! isset( $module ) || ! is_object( $module ) ) $module = $xoopsModule ;
else if( ! is_object( $xoopsModule ) ) die( '$xoopsModule is not set' )  ;

// language files (modinfo.php)
altsys_include_language_file( 'modinfo' ) ;

include dirname(__FILE__).'/admin_menu.php' ;

$mymenu_uri = empty( $mymenu_fake_uri ) ? $_SERVER['REQUEST_URI'] : $mymenu_fake_uri ;
$mymenu_link = substr( strstr( $mymenu_uri , '/admin/' ) , 1 ) ;

// preferences for altsys self
array_push( $adminmenu , array( 'title' => _PREFERENCES , 'link' => 'admin/index.php?mode=admin&lib=altsys&page=mypreferences' ) ) ;

// highlight (you can customize the colors)
foreach( array_keys( $adminmenu ) as $i ) {
	if( $mymenu_link == $adminmenu[$i]['link'] ) {
		$adminmenu[$i]['color'] = '#FFCCCC' ;
		$adminmenu_hilighted = true ;
	} else {
		$adminmenu[$i]['color'] = '#DDDDDD' ;
	}
}
if( empty( $adminmenu_hilighted ) ) {
	foreach( array_keys( $adminmenu ) as $i ) {
		if( stristr( $mymenu_uri , $adminmenu[$i]['link'] ) ) {
			$adminmenu[$i]['color'] = '#FFCCCC' ;
			break ;
		}
	}
}

// display (you can customize htmls)
echo "<div style='text-align:left;width:98%;'>" ;
foreach( $adminmenu as $menuitem ) {
	echo "<div style='float:left;height:1.5em;'><nobr><a href='".XOOPS_URL."/modules/altsys/".htmlspecialchars($menuitem['link'],ENT_QUOTES)."' style='background-color:{$menuitem['color']};font:normal normal bold 9pt/12pt;'>".htmlspecialchars($menuitem['title'],ENT_QUOTES)."</a> | </nobr></div>\n" ;
}
echo "</div>\n<hr style='clear:left;display:block;' />\n" ;


// submenu
$page = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , @$_GET['page'] ) ;
if( file_exists( dirname(__FILE__).'/mymenusub_'.$page.'.php' ) ) {
	include dirname(__FILE__).'/mymenusub_'.$page.'.php' ;
}

?>