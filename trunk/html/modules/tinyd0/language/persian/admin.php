<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_AM_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2006-11-07 06:20:59
define('_MD_A_MYMENU_MYTPLSADMIN','Templates');
define('_MD_A_MYMENU_MYBLOCKSADMIN','Blocks/Permissions');
define('_MD_A_MYMENU_MYPREFERENCES','Preferences');

define( 'TINYCONTENT_AM_LOADED' , 1 ) ;

//Admin Page Titles
define("_TC_ADMINTITLE","متن کوچک");

// SPAW
define('_TC_SPAWLANG','فارسی') ;

//Table Titles
define("_TC_ADDCONTENT","اضافه کردن پیام جدید");
define("_TC_EDITCONTENT","ویرایش پیام");
define("_TC_ADDLINK","اضافه کردن صفحه ی  مخفی");
define("_TC_EDITLINK","اصلاح صفحه ی مخفی");
define("_TC_ULFILE","بارگذاری فایل");
define("_TC_SFILE","جستجو");
define("_TC_DELFILE","پاک کردن فایل");
define("_TC_UPDATE_WRAP_CONTENTS","به روز رسانی پیام های مخفی به وسیله ی جستجو");

//Table Data
define("_TC_HOMEPAGE","خانه");
define("_TC_LINKNAME","عنوان لینک");
define("_TC_STORYID","ID");
define("_TC_VISIBLE","قابل دیدن");
define("_TC_TH_VISIBLE","نیرو");
define("_TC_ENABLECOM","فعال کردن  نظر ها ( کام نت)");
define("_TC_TH_ENABLECOM","کام");
define("_TC_HTML_HEADER","HTML header");
define("_TC_CONTENT","پیام");
define("_TC_YES","بله");
define("_TC_NO","خیر");
define("_TC_URL","انتخواب فایل");
define("_TC_UPLOAD","بارگذاری");
define("_TC_DISABLEBREAKS","نمایش تغییرات خط شکسته ( وقتی از اچ تی ام  ال  استفاده میکنید فعال باشد)");
define("_TC_SUBMENU","نمایش در زیر منو");
define("_TC_TH_SUBMENU","تابع");
define("_TC_DISP_YES","نمایش");
define("_TC_DISP_NO","نمایش ندادن");

define("_TC_CONTENT_TYPE","نوع صفحه");
define("_TC_TYPE_HTML","پیام HTML (کد های bb فعال باشد)"); // nohtml=0
define("_TC_TYPE_HTMLNOBB","پیام HTML (کد های bb فعال نباشد)"); // nohtml=2
define("_TC_TYPE_TEXTWITHBB","پیام تکست (کد های bb فعال باشد)"); // nohtml=1
define("_TC_TYPE_TEXTNOBB","پیام تکست (کد های bb فعال نباشد)"); // nohtml=3
define("_TC_TYPE_PHPHTML","کد های PHP (کد های bb فعال نباشد)"); // nohtml=8
define("_TC_TYPE_PHPWITHBB","کد های PHP (کد های bb فعال باشد)"); // nohtml=10
define("_TC_TYPE_PEARWIKI","PEAR Wiki (کد های bb فعال نباشد)"); // nohtml=16
define("_TC_TYPE_PEARWIKIWITHBB","PEAR Wiki (کد های bb فعال باشد)"); // nohtml=18
define("_TC_TYPE_PUKIWIKI","PukiWiki (کد های bb فعال نباشد)"); // nohtml=32 (resv)
define("_TC_TYPE_PUKIWIKIWITHBB","PukiWiki (کد های bb فعال باشد)"); // nohtml=34 (resv)

define("_TC_CHECKED_ITEMS_ARE","چک کردن مدارکی که هست");
define("_TC_BUTTON_MOVETO","حرکت");

define("_TC_LASTMODIFIED","آخرین اصلاح");
define("_TC_DONTUPDATELASTMODIFIED","انجام ندادن به روز رسانی خودکار");
define("_TC_CREATED","ساخته شد");
define("_TC_SAVEAS","ذخیره در");

define("_TC_LINKID","اولويت");
define("_TC_CONTENTTYPE","نوع");
define("_TC_ACTION","عملکرد");
define("_TC_EDIT","ویرایش");
define("_TC_DELETE","پاک کردن");
define("_TC_ELINK","اصلاح");
define("_TC_DELLINK","کات (بریدن)");

define("_TC_WRAPROOT","پایگاه صفحات پنهان");
define("_TC_FMT_WRAPROOTTC","یکسان مانند ماژول پیام های کوچک<br /> (%s) <br />");
define("_TC_FMT_WRAPROOTPAGE","یکسان مانند صفحات پنهان.<br /> (%s) <br />use mod_rewrite if you can.<br />");
define("_TC_FMT_WRAPBYREWRITE","use mod_rewrite (experimental)<br /> upload HTMLs and others into %s<br />Do not forget turning mod_rewrite on<br />");
define("_TC_FMT_WRAPCHANGESRCHREF","rewrite attributes of html (experimental)<br /> this option rewrites relative links to absolute links.<br />This probably mis-recognizes sentences looks like HTML source<br />");

define("_TC_DISABLECOM","نمایش پیام ها");
define("_TC_DBUPDATED","پایگاه داده ها به موفقیت به روز شد");
define("_TC_ERRORINSERT","خطا در به روز رسانی پایگاه داده ها");
define("_TC_RUSUREDEL","آیا شما مطمئن هستید که میخواهید پیام رو پاک کنید؟ <br />تمام لینک های پیام به این پیام پاک میشود");
define("_TC_RUSUREDELF","آیا شما مطمئن هستید که میخواهید این فایل را پاک کنید؟");
define("_TC_UPLOADED","فایل به موفقیت آپلود شد!");
define("_TC_FDELETED","فایل با موفقیت پاک شد!");
define("_TC_ERROREXIST","خطا. بعضی از اسامی فایل ها موجود است");
define("_TC_ERRORUPL","خطا در هین بارگذاری فایل");
define("_TC_FMT_WRAPPATHPERMOFF","<span style='font-size:xx-small;'>The directory for wrapping (%s) is not allowed to be written to by httpd. <br />If you'd like to upload or delete files via HTTP, turn the writing permission on.<br />I recommend to upload or delete files only via ftp for security reasons, thus the writing permission of the directory should still be off.</span>");
define("_TC_FMT_WRAPPATHPERMON","<span style='font-size:xx-small;'>من نمیتوانم باگذاری شما را از HTTP معرفی کنم. برای آپلود فایل ها از ftp استفاده کنید, اگر میتوانید.</span>" ) ;

define("_TC_ALTER_TABLE","تغییر دادن جدول");

define("_TC_JS_CONFIRMDISCARD","Changes will be discarded. OK?");

}

?>