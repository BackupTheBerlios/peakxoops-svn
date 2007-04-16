<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesUtf8fromAbstract extends D3pipesJointAbstract {

	var $src_encoding ;

	// constructor
	function D3pipesUtf8fromAbstract( $mydirname , $pipe_id , $option )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->src_encoding = $option ;
	}
	
	function execute( $string , $max_entries = '' ) {}
}


?>