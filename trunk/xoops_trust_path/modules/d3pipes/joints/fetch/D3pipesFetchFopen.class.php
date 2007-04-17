<?php

require_once dirname(dirname(__FILE__)).'/D3pipesFetchAbstract.class.php' ;

class D3pipesFetchFopen extends D3pipesFetchAbstract {

	function execute( $dummy = '' , $max_entries = '' )
	{
		$xml_source = '' ;

		if( trim( $this->url ) == '' ) {
			$this->errors[] = 'Input URI for fopen\'s option' ;
			return '' ;
		}

		$cache_result = $this->fetch_cache() ;
		if( $cache_result !== false ) {
			list( $cached_time , $xml_source ) = $cache_result ;
			if( $cached_time + $this->cache_life_time > time() ) {
				return $xml_source ;
			}
		}

		$fp = @fopen( $this->url , 'rb' ) ;
		if( ! $fp ) {
			// fetch error
			$this->touch_cache() ;
			return $xml_source ;
		}

		$xml_source = '' ;
		while( ! feof( $fp ) ) {
			$xml_source .= fgets( $fp , 65536 ) ;
		}
		fclose( $fp ) ;

		if( ! $this->store_cache( $xml_source ) ) die( 'set writable XOOPS_TRUST_PATH/cache' ) ;

		return $xml_source ;
	}

}

?>