<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_MB_LOADED' ) ) {

define( 'TINYCONTENT_MB_LOADED' , 1 ) ;

define( "_TC_FMT_DEFAULT_COMMENT_TITLE" , "Re: %s" ) ;

define('_TC_FILENOTFOUND','هیچ فایلی پیدا نشد. لطفا مسیر را چک کنید');
define("_TC_PRINTERFRIENDLY","چاپ کردن صفحات دوستان");
define("_TC_SENDSTORY","فرستادن این داستان برای دوستان");

define("_TC_NEXTPAGE","بعدی");
define("_TC_PREVPAGE","قبلی");
define("_TC_TOPOFCONTENTS","پیام های عالی( برتر)");

// whether parameter for "mailto:" is already rawurlencoded
define("_TC_DONE_MAILTOENCODE" , "ساختگی" ) ;

// %s is your site name. for single byte languages (ignored when _TC_DONE_MAILTOENCODE is true)
define("_TC_INTARTICLE","مقاله ی مورد علاقه در %s");
define("_TC_INTARTFOUND","این مقاله ی مورد علاقه ی شماست من میتوانم آن را پیداکنم در %s");

// for multibyte languages (ignored when _TC_DONE_MAILTOENCODE is false)
define("_TC_MB_INTARTICLE","" ) ;
define("_TC_MB_INTARTFOUND","" ) ;

// %s represents your site name
define("_TC_THISCOMESFROM","این مقاله میاید از%s");
define("_TC_URLFORSTORY","مسیر این داستان");
}

if( ! defined( 'FOR_XOOPS_LANG_CHECKER' ) && ! function_exists( 'tc_convert_wrap_to_ie' ) ) {
	function tc_convert_wrap_to_ie( $str ) {
		return $str ;
	}
}


?>