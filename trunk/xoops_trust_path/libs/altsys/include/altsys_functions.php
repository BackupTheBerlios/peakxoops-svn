<?php

function altsys_include_mymenu()
{
	global $xoopsModule , $xoopsConfig , $mydirname , $mydirpath , $mytrustdirname , $mytrustdirpath , $mymenu_fake_uri ;

	if( file_exists( $mydirpath.'/admin/mymenu.php' ) ) {
		include( $mydirpath.'/admin/mymenu.php' ) ;
	} else if( file_exists( $mydirpath.'/mymenu.php' ) ) {
		include( $mydirpath.'/mymenu.php' ) ;
	} else if( file_exists( $mytrustdirpath.'/admin/mymenu.php' ) ) {
		include( $mytrustdirpath.'/admin/mymenu.php' ) ;
	} else if( file_exists( $mytrustdirpath.'/mymenu.php' ) ) {
		include( $mytrustdirpath.'/mymenu.php' ) ;
	}
}


function altsys_include_language_file( $type )
{
	$mylang = $GLOBALS['xoopsConfig']['language'] ;

	if( file_exists( XOOPS_ROOT_PATH.'/modules/altsys/language/'.$mylang.'/'.$type.'.php' ) ) {
		include_once XOOPS_ROOT_PATH.'/modules/altsys/language/'.$mylang.'/'.$type.'.php' ;
	} else if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/language/'.$mylang.'/'.$type.'.php' ) ) {
		include_once XOOPS_TRUST_PATH.'/libs/altsys/language/'.$mylang.'/'.$type.'.php' ;
	} else if( file_exists( XOOPS_ROOT_PATH.'/modules/altsys/language/english/'.$type.'.php' ) ) {
		include_once XOOPS_ROOT_PATH.'/modules/altsys/language/english/'.$type.'.php' ;
	} else if( file_exists( XOOPS_TRUST_PATH.'/libs/altsys/language/english/'.$type.'.php' ) ) {
		include_once XOOPS_TRUST_PATH.'/libs/altsys/language/english/'.$type.'.php' ;
	}



}

?>