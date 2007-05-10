<?php

require_once dirname(dirname(__FILE__)).'/D3pipesParseAbstract.class.php' ;

class D3pipesParseLinkhtml extends D3pipesParseAbstract {

	function execute( $html_source , $max_entries = '' )
	{
		$items = array() ;

		$result = preg_match_all( $this->option , $html_source , $matches , PREG_SET_ORDER ) ;
		if( ! $result ) {
			$this->errors[] = 'Invalid pattern for this Parser' ;
		}
		foreach( $matches as $match ) {
			if( preg_match( '#[0-9]{2,4}[/.-][0-9]{1,2}[/.-][0-9]{1,2}#' , $match[1] , $regs ) ) {
				$pubtime = strtotime( $regs[0] ) ;
				$link = $match[2] ;
				$headline = $match[3] ;
			} else if( preg_match( '#[0-9]{2,4}[/.-][0-9]{1,2}[/.-][0-9]{1,2}#' , $match[3] , $regs ) ) {
				$pubtime = strtotime( $regs[0] ) ;
				$link = $match[1] ;
				$headline = $match[2] ;
			} else {
				$pubtime = time() ;
				$link = $match[1] ;
				$headline = $match[2] ;
			}

			$items[] = array(
				'headline' => $headline ,
				'pubtime' => $pubtime ,
				'link' => $link ,
				'fingerprint' => $link ,
			) ;
		}

		return $items ;
	}

}

?>