<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'dbtheme' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2007-05-12 05:01:31
define($constpref.'_ADMENU_MYLANGADMIN','Languages');

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","DBثیم");

// A brief description of this module
define($constpref."_DESC","ماژولی که به شما اجازه ویرایش تم ها در قسمت مدیریتی رو میده");

// admin menus
define($constpref.'_ADMENU_MYTPLSADMIN','تمپلیت های قالب') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','بلاک ها/دسترسی ها') ;
define($constpref.'_ADMENU_MYPREFERENCES','ویژگی ها') ;

// blocks
define( $constpref.'_BNAME_THEMEHOOK' , 'بلاک گرفتارکردن قالب' ) ;

// configs
define($constpref.'_BASETHEME','ست تم پایه') ;
define($constpref.'_BASETHEMEDSC','اگر می خواهید پایهء ماژول را عوض کنید, این ماژول رو بعد از تغییرات بروز برسانید. (نام قالب را بر اساس شاخه تغییر دهید)') ;
define($constpref.'_CSSCACHETIME','کش CSS برای بروزر شما(برحسب ثانیه)') ;


}


?>