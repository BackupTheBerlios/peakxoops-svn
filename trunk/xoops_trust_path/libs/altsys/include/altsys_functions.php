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
	}

}



?>