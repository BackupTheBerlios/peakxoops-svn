<?php

define('_MD_PICO_FILTERS_HTMLSPECIALCHARSINITWEIGHT',5);

function pico_htmlspecialchars( $mydirname , $text , $content_row )
{
	return htmlspecialchars( $text , ENT_QUOTES ) ;
}

?>