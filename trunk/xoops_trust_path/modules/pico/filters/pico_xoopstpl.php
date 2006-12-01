<?php

function pico_xoopstpl( $mydirname , $text , $id )
{
	$tpl =& new XoopsTpl() ;

	$temp_file = XOOPS_COMPILE_PATH.'/'.substr(md5(XOOPS_DB_PREFIX.$id),16).$mydirname.'_temp_resource' ;
	if( ! $text || $text != @file_get_contents( $temp_file ) ) {
		$fw = fopen( $temp_file , 'wb' ) ;
		fwrite( $fw , $text ) ;
		fclose( $fw ) ;
	}
	$text = $tpl->fetch( 'file:'.$temp_file ) ;
//	unlink( $temp_file ) ;

	return $text ;
}

?>