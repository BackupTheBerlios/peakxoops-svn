<?php

class protector_precommon_bwlimit_message extends ProtectorFilterAbstract {

	function execute()
	{
		echo _MD_PROTECTOR_BANDWIDTHLIMITED ;
		exit ;
	}

}

?>