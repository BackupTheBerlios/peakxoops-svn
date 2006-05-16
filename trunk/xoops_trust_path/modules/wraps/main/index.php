<?php

if( ! empty( $_GET['path_info'] ) ) {
	// path_info=($path_info) by mod_rewrite
	$path_info = str_replace( '..' , '' , preg_replace( '?[^a-zA-Z0-9_./-]?' , '' , $_GET['path_info'] ) ) ;
} else if( ! empty( $_SERVER['PATH_INFO'] ) ) {
	// try PATH_INFO first
	$path_info = str_replace( '..' , '' , preg_replace( '?[^a-zA-Z0-9_./-]?' , '' , substr( @$_SERVER['PATH_INFO'] , 1 ) ) ) ;
} else if( stristr( $_SERVER['REQUEST_URI'] , $mydirname.'/index.php/' ) ) {
	// try REQUEST_URI second
	list( , $path_info_query ) = explode( $mydirname.'/index.php' , $_SERVER['REQUEST_URI'] , 2 ) ;
	list( $path_info_tmp ) = explode( '?' , $path_info_query , 2 ) ;
	$path_info = str_replace( '..' , '' , preg_replace( '?[^a-zA-Z0-9_./-]?' , '' , substr( $path_info_tmp , 1 ) ) ) ;
} else if( strlen( $_SERVER['PHP_SELF'] ) > strlen( $_SERVER['SCRIPT_NAME'] ) ) {
	// try PHP_SELF & SCRIPT_NAME third
	$path_info = str_replace( '..' , '' , preg_replace( '?[^a-zA-Z0-9_./-]?' , '' , substr( $_SERVER['PHP_SELF'] , strlen( $_SERVER['SCRIPT_NAME'] ) + 1 ) ) ) ;
} else {
	// TODO hmmm. how can I avoid to redirect infinitely...
	header( 'Location: '.XOOPS_URL.'/modules/'.$mydirname.'/index.php/index.html' ) ;
	exit ;
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
		if( ! empty( $mimes[ $ext ] ) ) {
			header( 'Content-Type: '.$mimes[ $ext ] ) ;
		} else {
			header( 'Content-Type: application/octet-stream' ) ;
		}
		readfile( $wrap_full_path ) ;
		exit ;
}


?>