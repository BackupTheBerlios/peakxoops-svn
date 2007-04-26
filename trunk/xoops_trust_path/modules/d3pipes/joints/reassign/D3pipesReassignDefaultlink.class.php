<?php

require_once dirname(dirname(__FILE__)).'/D3pipesReassignAbstract.class.php' ;

class D3pipesReassignDefaultlink extends D3pipesReassignAbstract {

	function execute( $entries , $max_entries = 10 )
	{
		foreach( array_keys( $entries ) as $i ) {
			$entry =& $entries[ $i ] ;
			if( empty( $entry['link'] ) ) {
				$entry['link'] = $this->option ;
			}
		}

		return $entries ;
	}

}

?>