<?php

require_once dirname(dirname(__FILE__)).'/D3pipesUtf8fromAbstract.class.php' ;

class D3pipesUtf8fromIso88591 extends D3pipesUtf8fromAbstract {

	function execute( $data , $max_entries = 10 )
	{
		// ignore encodign specified by option
		//if( empty( $this->src_encoding ) ) $this->src_encoding = 'auto' ;

		if( is_array( $data ) ) {
			return array_map( array( $this , 'execute' ) , $data ) ;
		} else {
			return utf8_encode( $data ) ;
		}
	}

}

?>