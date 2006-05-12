<?php

if( empty( $_SERVER['PATH_INFO'] ) ) {
	// TODO fixme for infinite loop
	header( 'Location: '.XOOPS_URL.'/modules/'.$mydirname.'/index.php/index.html' ) ;
	exit ;
}

$path_info = str_replace( '..' , '' , preg_replace( '?[^a-zA-Z0-9_./-]?' , '' , @$_SERVER['PATH_INFO'] ) ) ;

$wrap_full_path = XOOPS_TRUST_PATH.'/wraps/'.$mydirname.'/'.$path_info ;

if( ! file_exists( $wrap_full_path ) ) {
	header( 'HTTP/1.0 404 Not Found' ) ;
	exit ;
}

switch( strtolower( strrchr( $path_info , '.' ) ) ) {
	case '.gif' :
		header( 'Content-Type: image/gif' ) ;
		readfile( $wrap_full_path ) ;
		break ;
	case '.jpg' :
	case '.jpeg' :
		header( 'Content-Type: image/jpeg' ) ;
		readfile( $wrap_full_path ) ;
		break ;
	case '.png' :
		header( 'Content-Type: image/png' ) ;
		readfile( $wrap_full_path ) ;
		break ;
	case '.html' :
		$xoopsOption['template_main'] = $mydirname.'_index.html' ;
		include XOOPS_ROOT_PATH.'/header.php' ;
		$xoopsTpl->assign( 'main_contents' , file_get_contents( $wrap_full_path ) ) ;
		include XOOPS_ROOT_PATH.'/footer.php' ;
	default :
		header( 'HTTP/1.0 404 Not Found' ) ;
		exit ;
}


?>