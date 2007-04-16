<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesUtf8toAbstract extends D3pipesJointAbstract {

	var $dest_encoding ;

	// constructor
	function D3pipesUtf8toAbstract( $mydirname , $pipe_id , $option )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->dest_encoding = $option ;
	}
	
	function execute( $string , $max_entries = '' ) {}
}


?>