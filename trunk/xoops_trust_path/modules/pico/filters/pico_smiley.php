<?php

function pico_smiley( $mydirname , $text )
{
	$myts =& MyTextSanitizer::getInstance() ;

	// html=on, smiley=0, xcode=1, $image=1, $br=0
	$text =& $myts->smiley( $text ) ;
	return $text ;
}

?>