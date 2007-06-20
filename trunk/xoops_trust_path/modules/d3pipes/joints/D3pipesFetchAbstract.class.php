<?php

require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesFetchAbstract extends D3pipesJointAbstract {

	var $cache_life_time ;
	var $url ;
	
	// constructor
	function D3pipesFetchAbstract( $mydirname , $pipe_id , $option )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->cache_life_time = 300 ; // minimum
		$this->url = $option ;
	}

	function execute( $dummy = '' , $max_entries = '' ) {}

	function fetch_cache()
	{
		$cache_file = $this->get_xml_cache_path() ;
		if( ! file_exists( $cache_file ) ) return false ;
		else return array( filemtime( $cache_file ) , file_get_contents( $cache_file ) ) ;
	}

	function store_cache( $xml_source )
	{
		$cache_file = $this->get_xml_cache_path() ;
		$fp = @fopen( $cache_file , 'wb' ) ;
		if( ! $fp ) return false ;
		fwrite( $fp , $xml_source ) ;
		fclose( $fp ) ;
		return true ;
	}

	function touch_cache()
	{
		$cache_file = $this->get_xml_cache_path() ;
		@touch( $cache_file ) ;
		return true ;
	}

	function get_xml_cache_path()
	{
		return d3pipes_common_get_xml_cache_path( $this->mydirname , $this->url ) ;
	}

}


?>