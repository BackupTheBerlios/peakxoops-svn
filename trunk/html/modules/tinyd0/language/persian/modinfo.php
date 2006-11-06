<?php
// Module Info Tiny Content

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_MI_LOADED' ) ) {

define( 'TINYCONTENT_MI_LOADED' , 1 ) ;

// The name of this module
define("_MI_TINYCONTENT_NAME","TinyD");

// A brief description of this module
define("_MI_TINYCONTENT_DESC","ساخت پیام بسیار راحت تر از آن چه شما میتوانید");

// Name for Menu Block
define("_MI_TC_BNAME1","TinyD %s Menu");
define("_MI_TC_BNAME2","TinyD %s Content");
define("_MI_TC_BDESC1","Builds the navigation");
define("_MI_TC_BDESC2","نمایش پیام در بلاک. [summary] tag valid");

// Admin Menu
define("_TC_MD_ADMENU1","اضافه کردن پیام");
define("_TC_MD_ADMENU2","اضافه کردن صفحه ی پنهان");
define("_TC_MD_ADMENU3","ویرایش و پاک کردن پیام ها");
define("_TC_MD_ADMENU_MYBLOCKSADMIN","گروه ها بلاک ها");
define("_TC_MD_ADMENU_MYTPLSADMIN","تلمپ ها");

// WYSIWYG Defines for v1.4
//define('_MI_WYSIWYG','Use Wysiwyg Editor?');
//define('_MI_WYSIWYG_DESC','');
define('_MI_COMMON_HTMLHEADER','سرانداز اشتراکی HTML');
define('_MI_COMMON_HTMLHEADER_DESC','چک کنید . اگر xoops_module_header در مطلب شما موجود است');
define('_MI_TAREA_WIDTH','عرض منطقه ی تکست');
define('_MI_TAREA_WIDTH_DESC','');
define('_MI_HEADER_TAREA_HEIGHT','ارتفاع منطقه ی تکیت از سر انداز HTML');
define('_MI_HEADER_TAREA_HEIGHT_DESC','');
define('_MI_TAREA_HEIGHT','ارتفاع منطقه ی تکست از بدنه');
define('_MI_TAREA_HEIGHT_DESC','');
define('_MI_FORCE_MOD_REWRITE','استفاده از mod_rewrite به وسیله ی تمام این ماژول');
define('_MI_FORCE_MOD_REWRITE_DESC',"Don't forget turning mod_rewrite on. eg) rename .htaccess.rewrite to .htaccess");
define('_MI_MODULESLESS_DIR','Name of the directory with modules/less mode');
define('_MI_MODULESLESS_DIR_DESC','experimental implementation. you should add some specific sentences into XOOPS_ROOT_PATH/.htaccess<br />leave blank normally');
define('_MI_SPACE2NBSP','doubled space is changed as space+&amp;nbsp; (when linebreak on)');
define('_MI_DISPLAY_PRINT_ICON','نمایش آیکون در چاپگر دوستان');
define('_MI_DISPLAY_FRIEND_ICON','نمایش آیکون در نقل کردن از دوستان');
define('_MI_USE_TAF_MODULE','از ماژول تماس با دوستان استفاده کنید');
define('_MI_DISPLAY_PAGENAV','Page Navigation');
define('_MI_DISPLAY_PAGENAV_NONE','نمایش ندادن');
define('_MI_DISPLAY_PAGENAV_DISP','تمام پیام های قابل دیدن');
define('_MI_DISPLAY_PAGENAV_SUB','فقط در زیر منوی پیام');
define('_MI_DISPLAY_PAGENAV_PERSUB','بخشی از زیر منو');
define('_MI_NAVBLOCK_TARGET','هدف برای بلاک پیام های کوچک');
define('_MI_NAVBLOCK_TARGET_DISP','عنوان ها از تمام پیام های قابل دیدن');
define('_MI_NAVBLOCK_TARGET_SUB','عنوان ها فقط از زیر منو پیام ها');


//***********************************************************************//
// No language config below!!! Do not change this!!!                     //
//  (These constants are not used in Duplicatable)                       //
//***********************************************************************//

define("_MI_TINYCONTENT_PREFIX", "پیام کوتاه");
define("_MI_DIR_NAME", "پیام کوتاه");

}

?>
