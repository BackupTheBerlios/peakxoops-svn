<?php

define('_MD_PICO_FILTERS_WRAPSINITWEIGHT',0);

function pico_wraps( $mydirname , $text , $content_row )
{
	if( empty( $content_row['vpath'] ) ) return $text ;

	$wrap_full_path = XOOPS_TRUST_PATH._MD_PICO_WRAPBASE.'/'.$mydirname.'/'.str_replace('..','',$content_row['vpath']) ;

	if( file_exists( $wrap_full_path ) ) {
		ob_start() ;
		include $wrap_full_path ;
		$text = ob_get_contents() ;
		ob_end_clean() ;
	}

	if( function_exists( 'pico_convert_encoding_to_ie' ) ) {
		return pico_convert_encoding_to_ie( $text ) ;
	} else {
		return $text ;
	}
}

?>