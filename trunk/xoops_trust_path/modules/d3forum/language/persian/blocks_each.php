<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3forum' ;
$constpref = '_MB_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// definitions for displaying blocks 
define($constpref."_FORUM","انجمن");
define($constpref."_TOPIC","تاپیک");
define($constpref."_REPLIES","پاسخ ها");
define($constpref."_VIEWS","بازدید");
define($constpref."_VOTESCOUNT","رای ها");
define($constpref."_VOTESSUM","امتیازات");
define($constpref."_LASTPOST","آخرین پست");
define($constpref."_LASTUPDATED","آخرین به روز رسانی");
define($constpref."_LINKTOSEARCH","جستجو در این  انجمن");
define($constpref."_LINKTOLISTCATEGORIES","صفحه ی اصلی انجمن ها");
define($constpref."_LINKTOLISTFORUMS","Forum Index");
define($constpref."_LINKTOLISTTOPICS","لیست تمام تاپیک ها");

}

?>