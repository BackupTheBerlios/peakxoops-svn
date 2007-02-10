<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","pico");

// A brief description of this module
define($constpref."_DESC","ماژولی برای ساخت اسناد استاتیک");

// admin menus
define( $constpref.'_ADMENU_CONTENTSADMIN' , 'لیست اسناد' ) ;
define( $constpref.'_ADMENU_CATEGORYACCESS' , 'دسترسی شاخه ها' ) ;
define( $constpref.'_ADMENU_IMPORT' , 'وارد کردن / هم زمان کردن' ) ;

// configurations
define($constpref.'_USE_WRAPSMODE','قرار گرفتن در ماژول منتظر ها برای تایید');
define($constpref.'_WRAPSAUTOREGIST','فعال سازی ثبت خودکار صفحات HTML در پایگاه داده ها');
define($constpref.'_TOP_MESSAGE','توضیحات شاخه ی اصلی');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_MENUINMODULETOP','نمایش منو در صفحه ی اصلی ماژول');
define($constpref.'_LISTASINDEX',"نمایش فهرست اسناد در شاخه ی اصلی");
define($constpref.'_LISTASINDEXDSC','با انتخواب بله لیست  اسناد به صورت خودکار در شاخه ی اصلی قرار میگیرد.   اگر نه را انتخواب کنید اسناد  بر اساس اولیت خود نمایش داده میشوند');
define($constpref.'_SHOW_BREADCRUMBS','Display breadcrumbs');
define($constpref.'_SHOW_PAGENAVI','نمایش صفحه ی راهبری');
define($constpref.'_SHOW_PRINTICON','نمایش آیکن  چاپگر');
define($constpref.'_SHOW_TELLAFRIEND','نمایش آیکن تماس با دوستان');
define($constpref.'_USE_TAFMODULE','استفاده از ماژول تماس با دوستان ');
define($constpref.'_FILTERS','تنظیمات پیش فرض فیلتر');
define($constpref.'_FILTERSDSC','کلمات انتخوابی را با | از هم جدا کنید(pipe)');
define($constpref.'_FILTERSDEFAULT','htmlspecialchars|smiley|xcode|nl2br');
define($constpref.'_USE_VOTE','فعال سازی قابلیت رای دادن');
define($constpref.'_GUESTVOTE_IVL','رای دادن مهمان ها');
define($constpref.'_GUESTVOTE_IVLDSC',' با انتخواب 0 امکان رای دادن مهمان ها را بگیرید. بقیه ی اعداد زمان(ثانیه) رای دادن هر ip میباشد');
define($constpref.'_HTMLHEADER','سرفصل HTML مشترک');
define($constpref.'_CSS_URI','آدرس فایل های CSS در ماژول');
define($constpref.'_CSS_URIDSC','مسیر داخلی( داخل ماژول) یا خارجی( از جای دیگر) قابل تنضیم است. مسیر پیش فرض: {mod_url}/index.css');
define($constpref.'_IMAGES_DIR','محل قرار گیری تصاویر');
define($constpref.'_IMAGES_DIRDSC','مسیر مورد نظر را در شاخه های ماژول تنظیم کنید. پیش فرض: images');
define($constpref.'_BODY_EDITOR','ادیتور متن اصلی( بدنه ی اصلی)');
define($constpref.'_COM_DIRNAME','یکسان سازی پیام ها: نام انجمن در d3forum');
define($constpref.'_COM_FORUM_ID','یکسان سازی پیام ها:ID انجمن ');

// blocks
define($constpref.'_BNAME_MENU','منو');
define($constpref.'_BNAME_CONTENT','سند');
define($constpref.'_BNAME_LIST','لیست');

// Notify Categories
define($constpref.'_NOTCAT_GLOBAL', 'سراسری');
define($constpref.'_NOTCAT_GLOBALDSC', 'اطلاع رساني درباره اين ماژول');

// Each Notifications
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENT', 'منتظر ها برای تایید');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTCAP', 'چنانچه تغيير و يا پستي منتظر تاييد است به من خبر بده(فقط براي اطلاع رساني مديران و وبمستران)');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTSBJ', '[{X_SITENAME}] {X_MODULE}: waiting');

}


?>