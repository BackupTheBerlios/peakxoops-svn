<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_MB_LOADED' ) ) {

define( 'TINYCONTENT_MB_LOADED' , 1 ) ;

define( "_TC_FMT_DEFAULT_COMMENT_TITLE" , "Re: %s" ) ;

define('_TC_FILENOTFOUND','�ե����뤬���Ĥ���ޤ���URL���ǧ���Ʋ�����');
define("_TC_PRINTERFRIENDLY","�ץ�󥿽����Ѳ���");
define("_TC_SENDSTORY","ͧã��������");

define("_TC_NEXTPAGE","���Υڡ���");
define("_TC_PREVPAGE","���Υڡ���");
define("_TC_TOPOFCONTENTS","����ƥ�ĤΥȥå�");

// whether parameter for "mailto:" is already rawurlencoded
define("_TC_DONE_MAILTOENCODE" , true ) ;

// %s is your site name. for single byte languages (ignored when _TC_DONE_MAILTOENCODE is true)
define("_TC_INTARTICLE","%s�Ǹ��Ĥ�����̣��������");
define("_TC_INTARTFOUND","���Υ����Ȥ򸫤Ʋ����� %s");

// for multibyte languages (ignored when _TC_DONE_MAILTOENCODE is false)
define("_TC_MB_INTARTICLE","%97%C7%82%A2%83T%83C%83g%82%F0%8C%A9%82%C2%82%AF%82%BD%82%CC%82%C5%8F%D0%89%EE%82%B5%82%DC%82%B7");	// ���ɤ������Ȥ򸫤Ĥ����ΤǾҲ𤷤ޤ��פ�SJISʸ����� rawurlencode() �������
define("_TC_MB_INTARTFOUND","%83%54%83%43%83%67%82%CCURL");	// �֥����Ȥ�URL�פ�SJISʸ����� rawurlencode() �������

// %s represents your site name
define("_TC_THISCOMESFROM","������̾: %s");
define("_TC_URLFORSTORY","���ε�����URL:");
}

if( ! defined( 'FOR_XOOPS_LANG_CHECKER' ) && ! function_exists( 'tc_convert_wrap_to_ie' ) ) {
	function tc_convert_wrap_to_ie( $str ) {
		return mb_convert_encoding( $str , mb_internal_encoding() , "auto" ) ;
	}
}


?>