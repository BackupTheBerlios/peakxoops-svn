<?php

require_once dirname(dirname(__FILE__)).'/D3pipesFilterAbstract.class.php' ;

class D3pipesFilterMbregex extends D3pipesFilterAbstract {

	function execute( $entries , $max_entries = 10 )
	{
		// check regex is valid or not
		$pattern = $this->pattern ;
		if( trim( $pattern ) == '' ) return $entries ;
	
		$ret = array() ;
		foreach( $entries as $entry ) {
			if( mb_ereg( $pattern , serialize( $entry ) ) ) {
				$ret[] = $entry ;
			}
		}
	
		return $ret ;
	}

}

?>