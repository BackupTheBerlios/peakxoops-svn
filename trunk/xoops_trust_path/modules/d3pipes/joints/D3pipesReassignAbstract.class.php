<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesReassignAbstract extends D3pipesJointAbstract {

	var $option ;

	// constructor
	function D3pipesReassignAbstract( $mydirname , $pipe_id , $option )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->option = $option ;
	}
	
	function execute( $entries , $max_entries = 10 ) {}

}

?>