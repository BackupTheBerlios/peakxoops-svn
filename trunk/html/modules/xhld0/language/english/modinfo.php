<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format
define("_MI_DEFAULT_DTFMT_SHORT","j M ah:i");

// The name of this module
define("_MI_HEADLINES_NAME","Headlines");

// A brief description of this module
define("_MI_HEADLINES_DESC","Display RSS/XML Newsfeed from other sites");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Headlines");
define("_MI_HEADLINES_BNAME_MIXED","Recent Headlines");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","List Headlines");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocks/Groups");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Default view");
define("_MI_HEADLINES_INDEX_VIEWMODED","Select a view type as a top page of the module");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Mixed & Newer is upper");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classic");
define("_MI_HEADLINES_MIXED_MAXITEM","Max items");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Specify the max records of RSS/ATOMs in recent view (items)");
define("_MI_HEADLINES_MIXED_MAXLEN","Max length");
define("_MI_HEADLINES_MIXED_MAXLEND", "Specify the max characters of titles in recent view (byte)");
define("_MI_HEADLINES_PROXY_HOST","Proxy host");
define("_MI_HEADLINES_PROXY_HOSTD","If you get RSS/ATOM via a proxy server, set the host's name or IP here<br />Else, leave blank.");
define("_MI_HEADLINES_PROXY_PORT","Proxy port");
define("_MI_HEADLINES_PROXY_PORTD","If you get RSS/ATOM via a proxy server, set the port's number") ;
define("_MI_HEADLINES_PROXY_USER","Proxy user");
define("_MI_HEADLINES_PROXY_USERD","If your proxy server needs BASIC authentication, set the user's name<br />Else, leave blank") ;
define("_MI_HEADLINES_PROXY_PASS","Proxy password");
define("_MI_HEADLINES_PROXY_PASSD","If your proxy server needs BASIC authentication, set the password<br />Else, leave blank") ;
define("_MI_HEADLINES_SHORTDTFMT","Short format of date & time");
define("_MI_HEADLINES_SHORTDTFMTD","Describe it as the first parameter of PHP function date().<br /><a href='http://jp.php.net/date'>Refer to PHP manual</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Don't pick up an item as recent if its feed is over-numbered than max items");
define("_MI_HEADLINES_MIXPICKUPD","If you set this to No, the setting of 'Max items' of each feed is ignored.");


}

?>