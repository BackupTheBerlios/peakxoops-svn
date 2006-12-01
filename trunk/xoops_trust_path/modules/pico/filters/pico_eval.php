<?php

function pico_eval( $mydirname , $text )
{
	ob_start() ;
	eval( $text ) ;
	$ret = ob_get_contents() ;
	ob_end_clean() ;
	return $ret ;
}

?>