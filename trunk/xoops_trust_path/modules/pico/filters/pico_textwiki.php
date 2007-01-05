<?php

function pico_textwiki( $mydirname , $text , $id )
{
	include_once "Text/Wiki.php";
	// include_once "Text/sunday_Wiki.php";
	$wiki = new Text_Wiki(); // create instance

	// Configuration
	$wiki->deleteRule( 'Wikilink' ); // remove a rule for auto-linking
	$wiki->setFormatConf( 'Xhtml' , 'translate' , false ) ; // HTML_ENTITIES -> HTML_SPECIALCHARS -> false

	// $wiki = new sunday_Text_Wiki(); // create instance
	//$text = str_replace ( "\r\n", "\n", $text );
	//$text = str_replace ( "~\n", "[br]", $text );
	//$text = $wiki->transform($text);
	//$content = str_replace ( "[br]", "<br/>", $text );
	// special thx to minahito! you are great!!
	return $wiki->transform($text);
}

?>