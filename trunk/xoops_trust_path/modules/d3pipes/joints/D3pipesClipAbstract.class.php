<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesClipAbstract extends D3pipesJointAbstract {

	var $minimum_cache_time = 600 ; // 600sec = 10min
	var $cache_time ; // public

	// constructor
	function D3pipesClipAbstract( $mydirname , $pipe_id , $option ) {
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->cache_time = intval( $option ) ;
		if( $this->cache_time < $this->minimum_cache_time ) $this->cache_time = $this->minimum_cache_time ;
	}

	function execute( $entries , $max_entries = 10 ) {}

	function getCaches( $max_entries ) {}

	function getClipping( $clipping_id ) {}

}


?>