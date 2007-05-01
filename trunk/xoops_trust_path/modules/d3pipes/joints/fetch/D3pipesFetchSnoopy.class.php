<?php

require_once dirname(dirname(__FILE__)).'/D3pipesFetchAbstract.class.php' ;

class D3pipesFetchSnoopy extends D3pipesFetchAbstract {

	function execute( $dummy = '' , $max_entries = '' )
	{
		$xml_source = '' ;

		if( ! strstr( $this->url , '://' ) ) {
			$this->errors[] = _MD_D3PIPES_ERR_INVALIDURIINFETCH."\n($this->pipe_id)" ;
			return '' ;
		}

		$cache_result = $this->fetch_cache() ;
		if( $cache_result !== false ) {
			list( $cached_time , $xml_source ) = $cache_result ;
			if( $cached_time + $this->cache_life_time > time() ) {
				return $xml_source ;
			}
		}

		require_once XOOPS_ROOT_PATH.'/class/snoopy.php' ;
		$snoopy = new Snoopy ;
		$snoopy->maxredirs = 0 ; // TODO
		// $snoopy->proxy_host = '' ; // TODO
		// $snoopy->proxy_port = '' ; // TODO
		// $snoopy->proxy_user = '' ; // TODO
		// $snoopy->proxy_pass = '' ; // TODO
		// $snoopy->agent = '' ; // TODO
		// $snoopy->referer = '' ; // TODO
		// $snoopy->user = '' ; // TODO
		// $snoopy->pass = '' ; // TODO
		// $snoopy->curl_path = '' ; // TODO
		if( ! $snoopy->fetch( $this->url ) || ! ( $xml_source = $snoopy->results ) ) {
			// fetch error
			$this->touch_cache() ;
			$this->errors[] = _MD_D3PIPES_ERR_CANTCONNECTINFETCH."\n($this->pipe_id)" ;
			return $xml_source ;
		}
		if( ! $this->store_cache( $xml_source ) ) {
			$this->errors[] = _MD_D3PIPES_ERR_CACHEFOLDERNOTWRITABLE."\nXOOPS_TRUST_PATH/cache ($this->pipe_id)" ;
			return '' ;
		}

		return $xml_source ;
	}

}

?>