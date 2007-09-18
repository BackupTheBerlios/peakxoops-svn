<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {












// Appended by Xoops Language Checker -GIJOE- in 2007-09-18 10:36:04
define($constpref.'_HTMLPR_EXCEPT','Groups can avoid purification by HTMLPurifier');
define($constpref.'_HTMLPR_EXCEPTDSC','Post from users who are not belonged these groups will be forced to purified as sanitized HTML by HTMLPurifier in Protector>=3.14. This purification cannot work with PHP4');

// Appended by Xoops Language Checker -GIJOE- in 2007-09-12 17:00:58
define($constpref.'_BNAME_MYWAITINGS','My waiting posts');

// Appended by Xoops Language Checker -GIJOE- in 2007-06-15 05:03:01
define($constpref.'_BNAME_SUBCATEGORIES','زیر شاخه ها');
define($constpref.'_NOTIFY_GLOBAL_NEWCONTENT','سندی جدید');
define($constpref.'_NOTIFY_GLOBAL_NEWCONTENTCAP','اگر یک سند جدید ثبت شد اطلاع بده. (فقط برای سند ها مجاز باشد)');
define($constpref.'_NOTIFY_GLOBAL_NEWCONTENTSBJ','[{X_SITENAME}] {X_MODULE} : سندی جدید');

// Appended by Xoops Language Checker -GIJOE- in 2007-05-29 16:39:06
define($constpref.'_COM_VIEW','دیدن نظر های یکپارچه');

// Appended by Xoops Language Checker -GIJOE- in 2007-05-07 17:48:20
define($constpref.'_ADMENU_MYLANGADMIN','تنظیمات زبان');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-26 11:38:35
define($constpref.'_ADMENU_MYTPLSADMIN','تمپلیت ها');
define($constpref.'_ADMENU_MYBLOCKSADMIN','بلاک ها / دسترسی ها');
define($constpref.'_ADMENU_MYPREFERENCES','ویژگی ها');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-23 05:52:08
define($constpref.'_SEARCHBYUID','فعال کردن صفحات ساخته شده برای سازنده');
define($constpref.'_SEARCHBYUIDDSC','قرار دادن لیست اسناد  در پروفایل سازنده ی سند. اگر از این  ماژول برای ساخت صفحات استاتیک استفاده میکنید این گزینه را خاموش کنید.');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-13 04:23:22
define($constpref.'_HISTORY_P_C','چه تعداد اصلاح (سند) در پایگاه داده ها ذخیره شود');
define($constpref.'_MLT_HISTORY','کمترین عمر هر اصلاح ( ثانیه)');
define($constpref.'_BRCACHE','زمان نگاه داری فایل کش برای  فایل های تصویری (فقط در حالت wraps)');
define($constpref.'_BRCACHEDSC','Files other than HTML will be cached by web browser in this second (0 means disabled)');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-10 07:13:28
define($constpref.'_SUBMENU_SC','نمایش اسناد در یک زیر منو ');
define($constpref.'_SUBMENU_SCDSC','به طور پیش فرض فقط شاخه ها نمایش داده میشوند. اگر این گزینه را فعال کنید سند های که گزینه ی"نمایش در منو" آن ها فعال است هم در  منو ی اصلی سایت نمایش داده میشوند');
define($constpref.'_SITEMAP_SC','نمایش اسناد در ماژول نقشه ی سایت');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-07 04:39:59
define($constpref.'_USE_REWRITE','enable mod_rewrite mode');
define($constpref.'_USE_REWRITEDSC','Depends your environment. If you turn this on, rename .htaccess.rewrite_wraps(with wraps) or htaccess.rewrite_normal(without wraps) to .htaccess under XOOPS_ROOT_PATH/modules/(dirname)/');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-06 04:56:32
define($constpref.'_FILTERSF','فیلتر های اجباری');
define($constpref.'_FILTERSFDSC','فیلتر های ورودی را به وسیله ی , ( کاما) از هم جدا کنید. filter:LAST means the filter is passed in the last phase. The other filters are passed in the first phase.');
define($constpref.'_FILTERSP','فیلتر های ممنوع');
define($constpref.'_FILTERSPDSC','فیلتر های ورودی را به وسیله ی , ( کاما) از هم جدا کنید');

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","پیکو");

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
define($constpref.'_SHOW_BREADCRUMBS','نمایش مسیر صفحه (breadcrumbs)');
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
define($constpref.'_CSS_URIDSC','مسیر داخلی( داخل ماژول) یا خارجی( از جای دیگر) قابل تنضیم است. مسیر پیش فرض: {mod_url}/index.php?page=main_css');
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
