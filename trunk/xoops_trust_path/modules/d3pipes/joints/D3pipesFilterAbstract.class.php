<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesFilterAbstract extends D3pipesJointAbstract {

	var $pattern ;

	// constructor
	function D3pipesFilterAbstract( $mydirname , $pipe_id , $option )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->pattern = $option ;
	}
	
	function execute( $entries , $max_entries = 10 ) {}

}

?>