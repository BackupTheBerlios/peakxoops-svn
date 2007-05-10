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
			'selected' => true ,
			'title' => $m4menu->getVar('name') ,
			'link' => '?mode=admin&lib=altsys&page=myblocksadmin&dirname='.$m4menu->getVar('dirname') ,
		) ;
		$GLOBALS['altsysXoopsBreadcrumbs'][] = array( 'name' => $m4menu->getVar('name') ) ;
	} else {
		$adminmenu[] = array(
			'selected' => false ,
			'title' => $m4menu->getVar('name') ,
			'link' => '?mode=admin&lib=altsys&page=myblocksadmin&dirname='.$m4menu->getVar('dirname') ,
		) ;
	}
}


// display
require_once XOOPS_ROOT_PATH.'/class/template.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'adminmenu' => $adminmenu ,
	'highlight_color' => '#ffdd99' ,
) ) ;
$tpl->display( 'db:altsys_inc_mymenusub.html' ) ;

?>