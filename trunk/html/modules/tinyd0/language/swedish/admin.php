<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_AM_LOADED' ) ) {




// Appended by Xoops Language Checker -GIJOE- in 2005-04-13 05:53:24
define('_TC_HTML_HEADER','HTML header');
define('_TC_CHECKED_ITEMS_ARE','Checked records are:');
define('_TC_BUTTON_MOVETO','Export(Move)');
define('_TC_CREATED','Created');
define('_TC_SAVEAS','Save as');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-11 18:59:09
define('_TC_TYPE_HTMLNOBB','HTML Content (bb code disabled)');
define('_TC_TYPE_TEXTNOBB','Text Content (bb code disabled)');

// Appended by Xoops Language Checker -GIJOE- in 2004-06-18 15:39:56
define('_TC_FMT_WRAPCHANGESRCHREF','rewrite attributes of html (experimental)<br /> this option rewrites relative links to absolute links.<br />This probably mis-recognizes sentences looks like HTML source<br />');

define( 'TINYCONTENT_AM_LOADED' , 1 ) ;

//Admin Page Titles
define("_TC_ADMINTITLE","Tiny Content");

// SPAW
define('_TC_SPAWLANG','en') ;

//Table Titles
define("_TC_ADDCONTENT","Lägg till nytt Innehåll");
define("_TC_EDITCONTENT","Editera Innehåll");
define("_TC_ADDLINK","Länka HTML sida");
define("_TC_EDITLINK","Modifiera HTML sida");
define("_TC_ULFILE","Ladda upp HTML fil");
define("_TC_SFILE","Sök");
define("_TC_DELFILE","Radera Fil");

//Table Data
define("_TC_HOMEPAGE","Index");
define("_TC_LINKNAME","Länktitel");
define("_TC_STORYID","Fil ID");
define("_TC_VISIBLE","Synlig");
define("_TC_TH_VISIBLE","Syn");
define("_TC_ENABLECOM","Kommentarer tillåtna");
define("_TC_TH_ENABLECOM","Kom");
define("_TC_CONTENT","Innehåll");
define("_TC_YES","Ja");
define("_TC_NO","Nej");
define("_TC_URL","Välj Fil");
define("_TC_UPLOAD","Ladda upp");
define("_TC_DISABLEBREAKS","Inaktivera radbytes konvertering (Aktiveras när HTML används)");
define("_TC_SUBMENU","Visa i Undermeny");
define("_TC_TH_SUBMENU","Und");
define("_TC_DISP_YES","Visa");
define("_TC_DISP_NO","Visa inte");

define("_TC_CONTENT_TYPE","Typ av sida");
define("_TC_TYPE_HTML","HTML Innehåll (bb kod aktiverad)"); // nohtml=0
define("_TC_TYPE_TEXTWITHBB","Text Innehåll (bb kod aktiverad)"); // nohtml=1
define("_TC_TYPE_PHPHTML","PHP koder (bb kod inaktiverad)"); // nohtml=8
define("_TC_TYPE_PHPWITHBB","PHP koder (bb kod inaktiverad)"); // nohtml=10
define("_TC_TYPE_PEARWIKI","PEAR Wiki (bb kod inaktiverad)"); // nohtml=16
define("_TC_TYPE_PEARWIKIWITHBB","PEAR Wiki (bb kod aktiverad)"); // nohtml=18
define("_TC_TYPE_PUKIWIKI","PukiWiki (bb kod inaktiverad)"); // nohtml=32 (resv)
define("_TC_TYPE_PUKIWIKIWITHBB","PukiWiki (bb kod aktiverad)"); // nohtml=34 (resv)

define("_TC_LASTMODIFIED","Ändrad senast");
define("_TC_DONTUPDATELASTMODIFIED","Uppdateras inte automatiskt");

define("_TC_LINKID","Prioritet");
define("_TC_CONTENTTYPE","Typ");
define("_TC_ACTION","Åtgärd");
define("_TC_EDIT","Editera");
define("_TC_DELETE","Radera");
define("_TC_ELINK","Modifiera");
define("_TC_DELLINK","Radera");

define("_TC_WRAPROOT","HTML-sida sökväg");
define("_TC_FMT_WRAPROOTTC","Samma som TinyContent modulen<br /> (%s) <br />");
define("_TC_FMT_WRAPROOTPAGE","Samma som wrapped page. (you can't use comment features)<br /> (%s) <br />use mod_rewrite if you can.<br />");
define("_TC_FMT_WRAPBYREWRITE","Använd mod_rewrite (experimentell)<br /> ladda upp HTMLs och annat till %s<br />Glöm inte att aktivera mod_rewrite<br />");

define("_TC_DISABLECOM","Inaktivera kommentarer");
define("_TC_DBUPDATED","Uppdatering av Databasen lyckades!");
define("_TC_ERRORINSERT","Ooops, ett fel uppstod vid uppdatering av databasen!");
define("_TC_RUSUREDEL","Är Ni säker på att Ni vill radera innehållet? <br />Alla kommentarer som är länkade till denna artikel kommer att tas bort.");
define("_TC_RUSUREDELF","Är Ni säker på att Ni vill radera denna fil?");
define("_TC_UPLOADED","Uppladdningen av Filen lyckades!");
define("_TC_FDELETED","Raderingen av Filen lyckades!");
define("_TC_ERROREXIST","Fel. Detta filnamn finns redan.");
define("_TC_ERRORUPL","Fel under uppladdning av Fil!");
define("_TC_FMT_WRAPPATHPERMOFF","<span style='font-size:xx-small;'>Katalogan för HTML sidor (%s) är inte tillåten att skrivas till av httpd. <br />Om Ni vill ladda upp eller radera filer via http, ändra katalogrättigheterna.<br />Vi rekommenderar användande av separat FTP program av säkerhetsskäl och i ock med detta så kan katalog rättigheterna lämnas orörda.</span>");
define("_TC_FMT_WRAPPATHPERMON","<span style='font-size:xx-small;'>Vi rekommenderar inte att Ni laddar upp filer via HTTP. Försök istället att ladda upp filer via FTP istället om möjligt.</span>" ) ;

define("_TC_ALTER_TABLE","Uppdatera Tabell");

define("_TC_JS_CONFIRMDISCARD","Ändringarna kommer inte att sparas. OK?");

}

?>