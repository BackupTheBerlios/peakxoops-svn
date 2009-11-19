<?php

// abstract validator
class PicoFormValidatorAbstract
{

	var $processor ;
	var $errors = array() ;
	
	function PicoFormValidatorAbstract( &$processor )
	{
		$this->__construct( $processor ) ;
	}
	
	function __construct( &$processor )
	{
		$this->processor = $processor ;
	}
	
	// virtual
	function validate( $value , $field_name )
	{
		return $value ;
	}

}

?>