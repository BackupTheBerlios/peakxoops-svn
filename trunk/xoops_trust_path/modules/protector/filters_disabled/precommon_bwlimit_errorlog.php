<?php

class protector_precommon_bwlimit_errorlog extends ProtectorFilterAbstract {

	function execute()
	{
		echo _MD_PROTECTOR_BANDWIDTHLIMITED ;
		error_log( 'Protector: bwlimit '.@$_SERVER['REMOTE_ADDR'] , 0 ) ;
		exit ;
	}

}

?>