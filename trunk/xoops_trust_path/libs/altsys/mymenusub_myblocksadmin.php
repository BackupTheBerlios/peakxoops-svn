<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$current_dirname = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , @$_GET['dirname'] ) ;
if( $current_dirname == '__CustomBlocks__' ) return ;

$module_handler4menu =& xoops_gethandler('module');
$criteria4menu = new CriteriaCompo(new Criteria('isactive', 1));
//$criteria4menu->add(new Criteria('hasmain', 1));
$criteria4menu->add(new Criteria('mid', '1', '>'));
$modules4menu =& $module_handler4menu->getObjects($criteria4menu, true);
$system_module =& $module_handler4menu->get(1) ;
if( is_object( $system_module ) ) array_unshift( $modules4menu , $system_module ) ;

$adminmenu = array() ;
foreach( $modules4menu as $m4menu ) {
	if( $m4menu->getVar('dirname') == $current_dirname ) {
		$adminmenu[] = array(
			'color' => '#FFDD99' ,
			'title' => $m4menu->getVar('name') ,
			'link' => '?mode=admin&lib=altsys&page=myblocksadmin&dirname='.$m4menu->getVar('dirname') ,
		) ;
		$GLOBALS['altsysXoopsBreadcrumbs'][] = array( 'name' => $m4menu->getVar('name') ) ;
	} else {
		$adminmenu[] = array(
			'color' => '#DDDDDD' ,
			'title' => $m4menu->getVar('name') ,
			'link' => '?mode=admin&lib=altsys&page=myblocksadmin&dirname='.$m4menu->getVar('dirname') ,
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