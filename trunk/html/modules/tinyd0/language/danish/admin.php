<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_AM_LOADED' ) ) {







// Appended by Xoops Language Checker -GIJOE- in 2006-11-07 06:20:59
define('_MD_A_MYMENU_MYTPLSADMIN','Templates');
define('_MD_A_MYMENU_MYBLOCKSADMIN','Blocks/Permissions');
define('_MD_A_MYMENU_MYPREFERENCES','Preferences');

// Appended by Xoops Language Checker -GIJOE- in 2006-04-11 11:14:42
define('_TC_UPDATE_WRAP_CONTENTS','Update wrapped contents for searching');

// Appended by Xoops Language Checker -GIJOE- in 2005-04-13 05:53:23
define('_TC_HTML_HEADER','HTML header');
define('_TC_CHECKED_ITEMS_ARE','Checked records are:');
define('_TC_BUTTON_MOVETO','Export(Move)');
define('_TC_CREATED','Created');
define('_TC_SAVEAS','Save as');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-11 18:59:08
define('_TC_TYPE_HTMLNOBB','HTML Content (bb code disabled)');
define('_TC_TYPE_TEXTNOBB','Text Content (bb code disabled)');

// Appended by Xoops Language Checker -GIJOE- in 2004-06-18 15:39:55
define('_TC_FMT_WRAPCHANGESRCHREF','rewrite attributes of html (experimental)<br /> this option rewrites relative links to absolute links.<br />This probably mis-recognizes sentences looks like HTML source<br />');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-06 09:53:53
define('_TC_SPAWLANG','en');
define('_TC_TH_VISIBLE','Vis');
define('_TC_ENABLECOM','Comments enabled');
define('_TC_TH_ENABLECOM','Com');
define('_TC_TH_SUBMENU','Sub');
define('_TC_DISP_YES','Display');
define('_TC_DISP_NO','Not Display');
define('_TC_CONTENT_TYPE','Page Type');
define('_TC_TYPE_HTML','HTML Content (bb code enabled)');
define('_TC_TYPE_TEXTWITHBB','Text Content (bb code enabled)');
define('_TC_TYPE_PHPHTML','PHP codes (bb code disabled)');
define('_TC_TYPE_PHPWITHBB','PHP codes (bb code enabled)');
define('_TC_TYPE_PEARWIKI','PEAR Wiki (bb code disabled)');
define('_TC_TYPE_PEARWIKIWITHBB','PEAR Wiki (bb code enabled)');
define('_TC_TYPE_PUKIWIKI','PukiWiki (bb code disabled)');
define('_TC_TYPE_PUKIWIKIWITHBB','PukiWiki (bb code enabled)');
define('_TC_LASTMODIFIED','Last Modified');
define('_TC_DONTUPDATELASTMODIFIED','Do not update it automatically');
define('_TC_CONTENTTYPE','Type');
define('_TC_ELINK','Modify');
define('_TC_DELLINK','Cut');
define('_TC_WRAPROOT','PageWrap\'s Base');
define('_TC_FMT_WRAPROOTTC','Same as TinyContent module<br /> (%s) <br />');
define('_TC_FMT_WRAPROOTPAGE','Same as wrapped page. (you can\'t use comment features)<br /> (%s) <br />use mod_rewrite if you can.<br />');
define('_TC_FMT_WRAPBYREWRITE','use mod_rewrite (experimental)<br /> upload HTMLs and others into %s<br />Do not forget turning mod_rewrite on<br />');
define('_TC_ERROREXIST','Error. the same filename exists');
define('_TC_FMT_WRAPPATHPERMOFF','<span style=\'font-size:xx-small;\'>The directory for wrapping (%s) is not allowed to be written by httpd. <br />If you\'d like to upload or delete files via HTTP, turn the writing permission on.<br />I recommend to upload or delete files only via ftp for security reason, thus the writing permission of the directory should be still off.</span>');
define('_TC_FMT_WRAPPATHPERMON','<span style=\'font-size:xx-small;\'>I don\'t recommend you to upload via HTTP. Try to upload the files for wrapping via ftp, if you can.</span>');
define('_TC_ALTER_TABLE','Alter Table');
define('_TC_JS_CONFIRMDISCARD','Changes will be discarded. OK?');

define( 'TINYCONTENT_AM_LOADED' , 1 ) ;


//Admin Page Titles
define("_TC_ADMINTITLE","Tiny Content");

//Table Titles
define("_TC_ADDCONTENT","Tilf�� nyt indhold");
define("_TC_EDITCONTENT","Redig�� indhold");
define("_TC_ADDLINK","Tilf�� link");
define("_TC_EDITLINK","Redig�� link");
define("_TC_ULFILE","Upload fil");
define("_TC_SFILE","S��");
define("_TC_DELFILE","Slet fil");

//Table Data
define("_TC_HOMEPAGE","Hjemmeside");
define("_TC_LINKNAME","Link overskrift");
define("_TC_STORYID","ID");
define("_TC_VISIBLE","Synlig");
define("_TC_CONTENT","Indhold");
define("_TC_YES","Ja");
define("_TC_NO","Nej");
define("_TC_URL","V��g fil");
define("_TC_UPLOAD","Upload");

define("_TC_LINKID","Link-ID");
define("_TC_ACTION","Handling");
define("_TC_EDIT","Redig��");
define("_TC_DELETE","Slet");

define('_TC_DISABLECOM','Deaktiver kommentarer');
define('_TC_DBUPDATED','��ndringerne er gemt i databasen!');
define('_TC_ERRORINSERT','Der opstod en fejl under skrivningen til databasen!');
define('_TC_RUSUREDEL','Er du sikker p� at du vil slette dette indhold?');
define('_TC_RUSUREDELF','Er du sikker p� at du vil slette denne fil?');
define('_TC_UPLOADED','Filen er blevet sendt til serveren!');
define('_TC_FDELETED','Filen er blevet slettet!');
define('_TC_ERRORUPL','Overf��slen af filen til serveren fejlede!');
define('_TC_PERMERROR','FEJL: Kan ikke skrive til fil mappen. Udf�� venligst "chmod 777" p� mappen!');

// Added in v1.4
define('_TC_DISABLEBREAKS','Deaktiver konvertering af linieskift (Aktiver denne nn�� der benyttes HTML)');
define('_TC_SUBMENU','Under-menu');

}

?>
