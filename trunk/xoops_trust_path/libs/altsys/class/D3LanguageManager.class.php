<?php

class D3LanguageManager {

var $default_language = 'english' ;
var $language = 'english' ;
var $salt ;
var $cache_path ;
var $cache_prefix = 'lang' ;


function D3LanguageManager()
{
	$this->language = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , $GLOBALS['xoopsConfig']['language'] ) ;
	$this->salt = substr( md5( XOOPS_ROOT_PATH . XOOPS_DB_USER . XOOPS_DB_PREFIX ) , 0 , 6 ) ;
	$this->cache_path = XOOPS_TRUST_PATH.'/cache' ;
}


function &getInstance( $conn = null )
{
	static $instance ;
	if( ! isset( $instance ) ) {
		$instance = new D3LanguageManager() ;
	}
	return $instance ;
}


function read( $resource , $mydirname , $mytrustdirname = null , $read_once = true )
{
	$d3file = XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/mytrustdirname.php' ;

	if( empty( $mytrustdirname ) && file_exists( $d3file ) ) {
		require $d3file ;
	}

	$cache_file = $this->getCacheFileName( $resource , $mydirname ) ;
	$root_file = XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/language/'.$this->language.'/'.$resource ;

	if( empty( $mytrustdirname ) ) {
		// conventional module
		$default_file = XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/language/'.$this->default_language.'/'.$resource ;
	
		if( file_exists( $cache_file ) ) {
			require_once $cache_file ;
		} else if( file_exists( $root_file ) ) {
			require_once $root_file ;
		} else if( file_exists( $default_file ) ) {
			// fall back english
			require_once $default_file ;
		}

	} else {
		// D3 modules
		$trust_file = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname.'/language/'.$this->language.'/'.$resource ;
		$default_file = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname.'/language/'.$this->default_language.'/'.$resource ;
	
		if( file_exists( $cache_file ) ) {
			require_once $cache_file ;
		} else if( file_exists( $root_file ) ) {
			require_once $root_file ;
		} else if( file_exists( $trust_file ) ) {
			if( $read_once ) require_once $trust_file ;
			else require $trust_file ;
		} else if( file_exists( $default_file ) ) {
			// fall back english
			if( $read_once ) require_once $default_file ;
			else require $default_file ;
		}
	}
}


function getCacheFileName( $resource , $mydirname , $language = null )
{
	if( empty( $language ) ) $language = $this->language ;
	return $this->cache_path . '/' . $this->cache_prefix . '_' . $this->salt . '_' . $mydirname . '_' . $language . '_' . $resource ;
}


}

?>