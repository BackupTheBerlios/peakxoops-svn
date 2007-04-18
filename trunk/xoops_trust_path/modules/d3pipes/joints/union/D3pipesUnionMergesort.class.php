<?php

require_once dirname(dirname(__FILE__)).'/D3pipesUnionAbstract.class.php' ;
require_once dirname(dirname(dirname(__FILE__))).'/include/common_functions.php' ;

class D3pipesUnionMergesort extends D3pipesUnionAbstract {

	function execute( $entries , $max_entries = 10 )
	{
		foreach( $this->union_ids as $union_ids ) {
			$pipe4assign = d3pipes_common_get_pipe4assign( $this->mydirname , $union_ids['pipe_id'] ) ;
			$entries_tmp = d3pipes_common_fetch_entries( $this->mydirname , $pipe4assign , $union_ids['num'] , $errors , $this->mod_configs ) ;
			$this->errors = array_merge( $this->errors , $errors ) ;
			foreach( array_keys( $entries_tmp ) as $i ) {
				$entries_tmp[ $i ][ 'pipe' ] = $pipe4assign ;
			}
			$entries = array_merge( $entries , $entries_tmp ) ;
		}

		// sort by pubtime DESC
		usort( $entries , array( $this , 'pubtime_sort' ) ) ;

		return $entries ;
	}


	function pubtime_sort( $a , $b )
	{
		return @$a['pubtime'] > @$b['pubtime'] ? -1 : 1 ;
	}

}

?>