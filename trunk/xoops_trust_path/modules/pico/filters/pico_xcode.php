<?php

define('_MD_PICO_FILTERS_XCODEINITWEIGHT',30);

function pico_xcode( $mydirname , $text , $content_row )
{
	$myts =& MyTextSanitizer::getInstance() ;

	// html=on, smiley=0, xcode=1, $image=1, $br=0
	$text = $myts->displayTarea( $text , 1 , 0 , 1 , 1 , 0 ) ;
	return $text ;
}

?>