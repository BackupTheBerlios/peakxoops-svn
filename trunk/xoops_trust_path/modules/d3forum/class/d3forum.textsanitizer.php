<?php

include_once( XOOPS_ROOT_PATH . '/class/module.textsanitizer.php' ) ;

class D3forumTextSanitizer extends MyTextSanitizer
{
	var $nbsp = 0 ;

	function D3forumTextSanitizer()
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
			$text = $this->prepareXcode( $text ) ;
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

	// additional pre filters
	function prepareXcode( $text )
	{
		$patterns = array(
			'#\n?\[code\]\r?\n?#' , 
			'#\n?\[\/code\]\r?\n?#' , 
			'#\n?\[quote\]\r?\n?#' , 
			'#\n?\[\/quote\]\r?\n?#' , 
		) ;
		$replacements = array(
			'[code]' , 
			'[/code]' , 
			'[quote]' , 
			'[/quote]' , 
		) ;
		return preg_replace( $patterns , $replacements , $text ) ;
	}

	// additional post filters
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

	function codeConv($text, $xcode = 1, $image = 1){
		if( $xcode != 0 ) {
			// bug fix
			$text = preg_replace_callback( "/\[code](.*)\[\/code\]/sU" , array( $this , 'myCodeSanitizer' ) , $text ) ;
		}
		return $text ;
	}

	function myCodeSanitizer( $matches )
	{
		return '<div class="xoopsCode"><pre><code>' . $this->xoopsCodeDecodeSafe( base64_decode( $matches[1] ) , 0 ) . '</code></pre></div>' ;
	}

	function xoopsCodeDecodeSafe( $text )
	{
		if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
			$text = htmlspecialchars( str_replace( '\"' , '"' , $text ) , ENT_QUOTES ) ;
		}

		$patterns[] = "/\[color=(['\"]?)([a-zA-Z0-9]*)\\1](.*)\[\/color\]/sU";
		$replacements[] = '<span style="color: #\\2;">\\3</span>';
//		$patterns[] = "/\[size=(['\"]?)([a-z-]*)\\1](.*)\[\/size\]/sU";
//		$replacements[] = '<span style="font-size: \\2;">\\3</span>';
//		$patterns[] = "/\[font=(['\"]?)([^;<>\*\(\)\"']*)\\1](.*)\[\/font\]/sU";
//		$replacements[] = '<span style="font-family: \\2;">\\3</span>';
		$patterns[] = "/\[b](.*)\[\/b\]/sU";
		$replacements[] = '<strong>\\1</strong>';
		$patterns[] = "/\[i](.*)\[\/i\]/sU";
		$replacements[] = '<i>\\1</i>';
		$patterns[] = "/\[u](.*)\[\/u\]/sU";
		$replacements[] = '<span style="text-decoration:underline">\\1</span>';
		$patterns[] = "/\[d](.*)\[\/d\]/sU";
		$replacements[] = '<del>\\1</del>';
		
		return preg_replace( $patterns , $replacements , $text ) ;
	}

}

?>