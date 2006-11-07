<?php

define( 'WRAPS_DISALLOW_CHARS' , '?[^a-zA-Z0-9_./+-]?' ) ;

if( ! empty( $_GET['path_info'] ) ) {
	// path_info=($path_info) by mod_rewrite
	$path_info = str_replace( '..' , '' , preg_replace( WRAPS_DISALLOW_CHARS , '' , $_GET['path_info'] ) ) ;
} else if( ! empty( $_SERVER['PATH_INFO'] ) ) {
	// try PATH_INFO first
	$path_info = str_replace( '..' , '' , preg_replace( WRAPS_DISALLOW_CHARS , '' , substr( @$_SERVER['PATH_INFO'] , 1 ) ) ) ;
} else if( stristr( $_SERVER['REQUEST_URI'] , $mydirname.'/index.php/' ) ) {
	// try REQUEST_URI second
	list( , $path_info_query ) = explode( $mydirname.'/index.php' , $_SERVER['REQUEST_URI'] , 2 ) ;
	list( $path_info_tmp ) = explode( '?' , $path_info_query , 2 ) ;
	$path_info = str_replace( '..' , '' , preg_replace( WRAPS_DISALLOW_CHARS , '' , substr( $path_info_tmp , 1 ) ) ) ;
} else if( strlen( $_SERVER['PHP_SELF'] ) > strlen( $_SERVER['SCRIPT_NAME'] ) ) {
	// try PHP_SELF & SCRIPT_NAME third
	$path_info = str_replace( '..' , '' , preg_replace( WRAPS_DISALLOW_CHARS , '' , substr( $_SERVER['PHP_SELF'] , strlen( $_SERVER['SCRIPT_NAME'] ) + 1 ) ) ) ;
} else {
	// module top
	$path_info = empty( $xoopsModuleConfig['index_file'] ) ? 'index.html' : $xoopsModuleConfig['index_file'] ;
	$wrap_full_path = XOOPS_TRUST_PATH.'/wraps/'.$mydirname.'/'.$path_info ;
	if( ! file_exists( $wrap_full_path ) ) {
		die( _MD_WRAPS_NO_INDEX_FILE ) ;
	} else {
		header( 'Location: '.XOOPS_URL.'/modules/'.$mydirname.'/index.php/'.$path_info ) ;
		exit ;
	}
}


$wrap_full_path = XOOPS_TRUST_PATH.'/wraps/'.$mydirname.'/'.$path_info ;

if( ! file_exists( $wrap_full_path ) ) {
	header( 'HTTP/1.0 404 Not Found' ) ;
	exit ;
}

require dirname(__FILE__).'/mimes.php' ;
$ext = strtolower( substr( strrchr( $path_info , '.' ) , 1 ) ) ;

switch( $ext ) {
	case 'htm' :
	case 'html' :
		$xoopsOption['template_main'] = $mydirname.'_index.html' ;
		include XOOPS_ROOT_PATH.'/header.php' ;
		$xoopsTpl->assign( 'main_contents' , file_get_contents( $wrap_full_path ) ) ;
		include XOOPS_ROOT_PATH.'/footer.php' ;
		exit ;
	default :
		// remove output bufferings
		while( ob_get_level() ) {
			ob_end_clean() ;
		}

		// can headers be sent?
		if( headers_sent() ) {
			restore_error_handler() ;
			die( "Can't send headers. check language files etc." ) ;
		}

		if( ! empty( $mimes[ $ext ] ) ) {
			header( 'Content-Type: '.$mimes[ $ext ] ) ;
		} else {
			header( 'Content-Type: application/octet-stream' ) ;
		}
		set_time_limit( 0 ) ;
//		readfile( $wrap_full_path ) ;
		$fp = fopen( $wrap_full_path , "rb" ) ;
		while( ! feof( $fp ) ) {
			echo fread( $fp , 65536 ) ;
		}
		exit ;
}


?>