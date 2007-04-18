<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesBlockAbstract extends D3pipesJointAbstract {

	var $option ;
	var $func_file = '' ;
	var $func_name = '' ;
	var $block_options = array() ;

	// constructor
	function D3pipesBlockAbstract( $mydirname , $pipe_id , $option )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		$this->option = $option ;
	}
	
	function execute( $dummy = '' , $max_entries = '' )
	{
		if( ! $this->init() ) {
			return array() ;
		}

		// file check
		if( ! file_exists( $this->func_file ) ) {
			$this->errors[] = _MD_D3PIPES_ERR_INVALIDFILEINBLOCK."\n".$this->func_file.' ('.get_class( $this ).')' ;
			return array() ;
		}
		require_once $this->func_file ;

		// function check
		if( ! function_exists( $this->func_name ) ) {
			$this->errors[] = _MD_D3PIPES_ERR_INVALIDFUNCINBLOCK."\n".$this->func_name.' ('.get_class( $this ).')' ;
			return array() ;
		}

		$block = call_user_func( $this->func_name , $this->block_options ) ;

		return $this->reassign( $block ) ;
	}

	// virtual
	function init() {}

	// virtual
	function reassign() {}

	function unhtmlspecialchars( $data )
	{
		if( is_array( $data ) ) {
			return array_map( array( $this , 'unhtmlspecialchars' ) , $data ) ;
		} else {
			return str_replace(
				array( '&lt;' , '&gt;' , '&amp;' , '&quot;' , '&#039;' ) ,
				array( '<' , '>' , '&' , '"' , "'" ) ,
				$data ) ;
		}
	}



}


?>