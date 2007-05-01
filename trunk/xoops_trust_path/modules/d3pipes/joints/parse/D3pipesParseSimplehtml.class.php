<?php

require_once dirname(dirname(__FILE__)).'/D3pipesParseAbstract.class.php' ;

class D3pipesParseSimplehtml extends D3pipesParseAbstract {

	function execute( $html_source , $max_entries = '' )
	{
		$items = array() ;

		$result = preg_match_all( $this->option , $html_source , $matches , PREG_SET_ORDER ) ;
		if( ! $result ) {
			$this->errors[] = 'Invalid pattern for this Parser' ;
		}

		foreach( $matches as $match ) {
			$items[] = array(
				'headline' => $match[1] ,
				'pubtime' => time() ,
				// 'link' => '' ,
				'fingerprint' => md5( $match[1] ) ,
			) ;
		}

		return $items ;
	}

}

?>