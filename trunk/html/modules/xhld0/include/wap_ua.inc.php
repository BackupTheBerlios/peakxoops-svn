<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

if( ! function_exists( 'wap_ua' ) ) {

	function wap_ua()
	{
		$up_pos = strpos( $_SERVER['HTTP_USER_AGENT'] , 'UP.Browser' ) ;
		if( $up_pos === false ) {
			switch( strtoupper( substr( $_SERVER['HTTP_USER_AGENT'] , 0 , 6 ) ) ) {
				case 'DOCOMO' :
					return 'C-HTML' ;
				case 'J-PHON' :
					return 'MML' ;
				default :
					return 'HTML' ;
			}
		} else if( $up_pos == 0 ) {
			return 'HDML' ;
		} else {
			return 'WAP2.0' ;
		}
	}

}


?>