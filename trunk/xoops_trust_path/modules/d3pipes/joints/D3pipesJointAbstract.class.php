<?php

class D3pipesJointAbstract {

	var $mydirname ;
	var $pipe_id ;
	var $mod_configs = array() ;
	var $errors = array() ;

	function getErrors()
	{
		return $this->errors ;
	}

	function setModConfigs( $configs )
	{
		$this->mod_configs = $configs ;
	}
}


?>