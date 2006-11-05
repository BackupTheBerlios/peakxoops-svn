<?php

include_once( XOOPS_ROOT_PATH . '/class/module.textsanitizer.php' ) ;

class D3forumTextSanitizer extends MyTextSanitizer
{
	var $nbsp = 0 ;

	function MyAlbumTextSanitizer()
	{
		parent::MyTextSanitizer() ;
	}

	function &getInstance()
	{
		static $instance;
		if (!isset($instance)) {
			$instance = new D3forumTextSanitizer();
		}
		return $instance;
	}

	// override
	// a fix for original bad implementation
	function &htmlSpecialChars($text)
	{
		$ret = htmlspecialchars( $text , ENT_QUOTES ) ;
		return $ret ;
	}

	function reviveNumberEntity( $text )
	{
		return preg_replace( '/\&amp\;\#([0-9]{2,10}\;)/' , '&#\\1' , $text ) ;
	}

	function reviveSpecialEntity( $text )
	{
		return preg_replace( '/\&amp\;([0-9a-zA-Z]{2,10}\;)/' , '&\\1' , $text ) ;
	}

	// override
	function &displayTarea( $text , $html = 0 , $smiley = 1 , $xcode = 1 , $image = 1 , $br = 1 , $nbsp = 0 , $number_entity = 0 , $special_entity = 0 )
	{
		if( empty( $xcode ) ) {
			if( empty( $html ) ) $text = htmlspecialchars( $text , ENT_QUOTES ) ;
			if( ! empty( $br ) ) $text = nl2br( $text ) ;
			return $text ;
		} else {
			$this->nbsp = $nbsp ;
			$text = $this->postCodeDecode( parent::displayTarea( $text , $html , $smiley , 1 , $image , $br ) , $image ) ;
			if( $number_entity ) $text = $this->reviveNumberEntity( $text ) ;
			if( $special_entity ) $text = $this->reviveSpecialEntity( $text ) ;
			return  $text ;
		}
	}

	// override
	function makeTboxData4Show( $text, $number_entity = 0 , $special_entity = 0 )
	{
		$text = $this->htmlSpecialChars( $text ) ;
		if( $number_entity ) $text = $this->reviveNumberEntity( $text ) ;
		if( $special_entity ) $text = $this->reviveSpecialEntity( $text ) ;
		return $text;
	}

	// override
	function makeTboxData4Edit( $text, $number_entity = 0 )
	{
		$text = $this->htmlSpecialChars( $text ) ;
		if( $number_entity ) $text = $this->reviveNumberEntity( $text ) ;
		return $text;
	}

	// override
	function makeTareaData4Edit( $text, $number_entity = 0 )
	{
		$text = $this->htmlSpecialChars( $text ) ;
		if( $number_entity ) $text = $this->reviveNumberEntity( $text ) ;
		return $text;
	}

	// additional filters
	function postCodeDecode( $text , $image )
	{
		$removal_tags = array( '[summary]' , '[/summary]' , '[pagebreak]' ) ;
		$text = str_replace( $removal_tags , '' , $text ) ;

		$patterns = array();
		$replacements = array();

		// [siteimg]
		$patterns[] = "/\[siteimg align=(['\"]?)(left|center|right)\\1]([^\"\(\)\?\&'<>]*)\[\/siteimg\]/sU";
		$patterns[] = "/\[siteimg]([^\"\(\)\?\&'<>]*)\[\/siteimg\]/sU";
		if( $image ) {
			$replacements[] = '<img src="'.XOOPS_URL.'/\\3" align="\\2" alt="" />';
	
			$replacements[] = '<img src="'.XOOPS_URL.'/\\1" alt="" />';
		} else {
			$replacements[] = '<a href"'.XOOPS_URL.'/\\3" target="_blank">'.XOOPS_URL.'/\\3</a>';
			$replacements[] = '<a href"'.XOOPS_URL.'/\\1" target="_blank">'.XOOPS_URL.'/\\1</a>';
		}

		// [1.1.3.1] etc.
		$patterns[] = '/\[(1(\.\d)*)]/' ;
		$replacements[] = '<a href="#post_path\\1">\\0</a>' ;

		// [quote sitecite=]
		$patterns[] = "/\[quote sitecite=([^\"'<>]*)\]/sU";
		$replacements[] = _QUOTEC.'<div class="xoopsQuote"><blockquote cite="'.XOOPS_URL.'/\\1">';

		// [quote cite=] (TODO)

		return preg_replace($patterns, $replacements, $text);
	}

	function &nl2Br( $text )
	{
		$text = preg_replace("/(\015\012)|(\015)|(\012)/","<br />",$text);
		if( $this->nbsp ) {
			$patterns = array( '  ' , '\"' ) ;
			$replaces = array( ' &nbsp;' , '"' ) ;
			$text = substr(preg_replace('/\>.*\</esU',"str_replace(\$patterns,\$replaces,'\\0')",">$text<"),1,-1);
		}
		return $text ;
	}

	function extractSummary( $text )
	{
		$patterns[] = "/^(.*)\[summary\](.*)\[\/summary\](.*)$/sU";
		$replacements[] = '$2';

		return preg_replace($patterns, $replacements, $text);
	}

}

?>