<?php

$mytrustdirname = basename( dirname( __FILE__ ) ) ;
$mytrustdirpath = dirname( __FILE__ ) ;

// check permission of 'module_admin' of this module
$moduleperm_handler =& xoops_gethandler( 'groupperm' ) ;
if( ! is_object( @$xoopsUser ) || ! $moduleperm_handler->checkRight( 'module_admin' , $xoopsModule->getVar( 'mid' ) , $xoopsUser->getGroups() ) ) die( 'only admin can access this area' ) ;
require XOOPS_ROOT_PATH.'/include/cp_functions.php' ;

// language files
$language = empty( $xoopsConfig['language'] ) ? 'english' : $xoopsConfig['language'] ;
if( file_exists( "$mydirpath/language/$language/admin.php" ) ) {
	// user customized language file
	include_once "$mydirpath/language/$language/admin.php" ;
} else if( file_exists( "$mytrustdirpath/language/$language/admin.php" ) ) {
	// default language file
	include_once "$mytrustdirpath/language/$language/admin.php" ;
} else {
	// fallback english
	include_once "$mytrustdirpath/language/english/admin.php" ;
}

// fork each pages
$page = preg_replace( '[^a-zA-Z0-9_-]' , '' , @$_GET['page'] ) ;

if( file_exists( "$mytrustdirpath/admin/$page.php" ) ) {
	include "$mytrustdirpath/admin/$page.php" ;
} else {
	include "$mytrustdirpath/admin/index.php" ;
}

?>