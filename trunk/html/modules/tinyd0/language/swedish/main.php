<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_MB_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2005-04-19 18:26:42
define('_TC_FMT_DEFAULT_COMMENT_TITLE','Re: %s');

define( 'TINYCONTENT_MB_LOADED' , 1 ) ;

define('_TC_FILENOTFOUND','Filen hittades inte! V�nligen kontrollera URL!');
define("_TC_PRINTERFRIENDLY","Utskriftsv�nlig Sida");
define("_TC_SENDSTORY","Skicka denna artikel till en v�n");

define("_TC_NEXTPAGE","N�sta");
define("_TC_PREVPAGE","F�reg�ende");
define("_TC_TOPOFCONTENTS","Index");

// whether parameter for "mailto:" is already rawurlencoded
define("_TC_DONE_MAILTOENCODE" , false ) ;

// %s is your site name. for single byte languages (ignored when _TC_DONE_MAILTOENCODE is true)
define("_TC_INTARTICLE","Intressant artikel p� %s");
define("_TC_INTARTFOUND","H�r �r en intressant artikel som jag har hittat p� %s");

// for multibyte languages (ignored when _TC_DONE_MAILTOENCODE is false)
define("_TC_MB_INTARTICLE","" ) ;
define("_TC_MB_INTARTFOUND","" ) ;

// %s represents your site name
define("_TC_THISCOMESFROM","Denna artikel kommer fr�n %s");
define("_TC_URLFORSTORY","Addressen f�r denna artikel �r:");
}

if( ! defined( 'FOR_XOOPS_LANG_CHECKER' ) && ! function_exists( 'tc_convert_wrap_to_ie' ) ) {
	function tc_convert_wrap_to_ie( $str ) {
		return $str ;
	}
}


?>