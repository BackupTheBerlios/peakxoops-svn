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


function read( $resource , $mydirname , $mytrustdirname = null )
{
	if( empty( $mytrustdirname ) ) {
		require XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/mytrustdirname.php' ;
	}

	$cache_file = $this->getCacheFileName( $resource , $mydirname ) ;
	$root_file = XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/language/'.$this->language.'/'.$resource ;
	$trust_file = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname.'/language/'.$this->language.'/'.$resource ;
	$default_file = XOOPS_TRUST_PATH.'/modules/'.$mytrustdirname.'/language/'.$this->default_language.'/'.$resource ;

	if( file_exists( $cache_file ) ) {
		require_once $cache_file ;
	} else if( file_exists( $root_file ) ) {
		require_once $root_file ;
	} else if( file_exists( $trust_file ) ) {
		require $trust_file ;
	} else {
		// fall back english
		require $default_file ;
	}
}


function getCacheFileName( $resource , $mydirname , $language = null )
{
	if( empty( $language ) ) $language = $this->language ;
	return $this->cache_path . '/' . $this->cache_prefix . '_' . $this->salt . '_' . $mydirname . '_' . $language . '_' . $resource ;
}


}

?>