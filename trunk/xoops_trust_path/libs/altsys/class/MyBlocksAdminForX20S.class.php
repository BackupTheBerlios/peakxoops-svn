<?php

require_once dirname(__FILE__).'/MyBlocksAdminForICMS.class.php' ;

class MyBlocksAdminForX20S extends MyBlocksAdmin {

var $block_positions = array() ;

function MyBlocksAadminForICMS()
{
}


function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance =& new MyBlocksAdminForX20S();
		$instance->construct() ;
	}
	return $instance;
}


}

?>