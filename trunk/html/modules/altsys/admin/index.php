<?php

$xoopsOption['pagetype'] = 'admin' ;
require '../../../mainfile.php' ;
if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'set XOOPS_TRUST_PATH in mainfile.php' ) ;

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
$mydirpath = dirname( dirname( __FILE__ ) ) ;


if( empty( $xoopsModule ) ) {
	$moduleperm_handler =& xoops_gethandler( 'module' ) ;
	$xoopsModule =& $moduleperm_handler->getByDirname( 'altsys' ) ;
}

// check permission of 'module_admin' of this module
/* $moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
if( ! is_object( @$xoopsUser ) || ! $moduleperm_handler->checkRight( 'module_admin' , $xoopsModule->getVar( 'mid' ) , $xoopsUser->getGroups() ) ) die( 'only admin can access this area' ) ; */
require XOOPS_ROOT_PATH.'/include/cp_functions.php' ;

$page = preg_replace( '[^a-zA-Z0-9_-]' , '' , @$_GET['page'] ) ;


// half measure ... (TODO)
if( empty( $_GET['dirname'] ) ) {
	$module_handler =& xoops_gethandler( 'module' ) ;
	list( $top_module ) = $module_handler->getObjects( new Criteria('isactive', 1) ) ;
	$_GET['dirname'] = $top_module->getVar('dirname') ;
}

// language file
if( file_exists( dirname(__FILE__).'/language/'.$xoopsConfig['language'].'/'.$page.'.php' ) ) {
	include_once dirname(__FILE__).'/language/'.$xoopsConfig['language'].'/'.$page.'.php' ;
} else if( file_exists( dirname(__FILE__).'/language/english/'.$page.'.php' ) ) {
	include_once dirname(__FILE__).'/language/english/'.$page.'.php' ;
}


if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/'.$page.'.php' ) ) {
	include XOOPS_TRUST_PATH.'/libs/altsys/'.$page.'.php' ;
} else if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/index.php' ) ) {
	include XOOPS_TRUST_PATH.'/libs/altsys/index.php' ;
} else {
	die( 'wrong request' ) ;
}

?>