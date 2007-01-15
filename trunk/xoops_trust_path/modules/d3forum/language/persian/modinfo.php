<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3forum' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","انجمن ها");

// A brief description of this module
define($constpref."_DESC","ماژول انجمن برای زوپس");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME_LIST_TOPICS","تاپیک ها");
define($constpref."_BDESC_LIST_TOPICS","This block can be used for multi-purpose. Of course, you can put it multiplly.");
define($constpref."_BNAME_LIST_POSTS","پست ها");
define($constpref."_BNAME_LIST_FORUMS","انجمن ها");

define($constpref.'_ADMENU_CATEGORYACCESS','دسترسی شاخه ها');
define($constpref.'_ADMENU_FORUMACCESS','دسترسی انجمن ها');
define($constpref.'_ADMENU_ADVANCEDADMIN','تنظیمات');

// configurations
define($constpref.'_TOP_MESSAGE','پیام در صفحه ی اول انجمن');
define($constpref.'_TOP_MESSAGEDEFAULT','<h1 class="d3f_title">صفحه ی اصلی انجمن ها</h1><p class="d3f_welcome">پیام شروع: انجمن و شاخه ی مورد نظر خود را انتخواب کرده و از آن بازدید کنید </p>');
define($constpref.'_ALLOW_HTML','اجازه ی استفاده از HTML ');
define($constpref.'_ALLOW_HTMLDSC','Don\'t turn this on casually. It cause Script Insertion vulnerability if malicious user can post.');
define($constpref.'_ALLOW_TEXTIMG','اجازه ی نمایش عکس خارجی در یک پست');
define($constpref.'_ALLOW_TEXTIMGDSC','اگر کسی با استفاده از پست حاوی عکی خارجی [img] به سایت حمله کرد . میتواند آی پی ها و اطلاعات کاربران بازدید کننده از پست را مشاهده نمایید.');
define($constpref.'_ALLOW_SIG','اجازه ی استفاده از امضا');
define($constpref.'_ALLOW_SIGDSC','');
define($constpref.'_ALLOW_SIGIMG','اجازه ی نمایش عکس خارجی در امضای کاربران');
define($constpref.'_ALLOW_SIGIMGDSC','اگر کسی با استفاده از پست حاوی عکی خارجی [img] به سایت حمله کرد . میتواند آی پی ها و اطلاعات کاربران بازدید کننده از پست را مشاهده نمایید.');
define($constpref.'_USE_VOTE','استفاده از امکان رای دادن');
define($constpref.'_USE_SOLVED','استفاده از امکان SOLVED');
define($constpref.'_ALLOW_MARK','استفاده از امکان نشانه دار کردن ');
define($constpref.'_ALLOW_HIDEUID','اجازه دهید کاربر ثبت نام شده با نام واقعی خود پست بزند');
define($constpref.'_POSTS_PER_TOPIC','بیشترین تعداد پست ها در یک تاپیک');
define($constpref.'_POSTS_PER_TOPICDSC','تاپیک به تعداد پست های انتخواب شده محدود میشود');
define($constpref.'_HOT_THRESHOLD','Hot Topic Threshold');
define($constpref.'_HOT_THRESHOLDDSC','');
define($constpref.'_TOPICS_PER_PAGE','تعداد تاپیک های که در هر صفحه از انجمن نمایش داده میشود');
define($constpref.'_TOPICS_PER_PAGEDSC','');
define($constpref.'_VIEWALLBREAK','Topics per a page in the view crossing forums');
define($constpref.'_VIEWALLBREAKDSC','');
define($constpref.'_SELFEDITLIMIT','محدوده ی زمانی برای ویرایش پست توسط اعضا ( ثانیه)');
define($constpref.'_SELFEDITLIMITDSC','زمانی  را که کاربر به طور معمولی میتواند پستش را ویرایش کند انتخواب کنید. با انتخواب عدد 0 کاربر توان ویرایش پست خود را نخواهد داشت.');
define($constpref.'_SELFDELLIMIT','محدوده ی زمانی برای حذف پست توسط اعضا (ثانیه)');
define($constpref.'_SELFDELLIMITDSC','زمانی را که کاربر میتواند به طور معمولی پست خود را پاک کند انتخواب کنید. با انتخواب 0امکان پاک کردن پست توسط کاربر را بگیرید. در هر صورت پست های اصلی پاک نخواهد شد.');
define($constpref.'_CSS_URI','URI of CSS file for this module');
define($constpref.'_CSS_URIDSC','relative or absolute path can be set. default: index.css');
define($constpref.'_IMAGES_DIR','Directory for image files');
define($constpref.'_IMAGES_DIRDSC','relative path should be set in the module directory. default: images');
define($constpref.'_ANONYMOUS_NAME','نام کاربر مهمان');
define($constpref.'_ANONYMOUS_NAMEDSC','');
define($constpref.'_ICON_MEANINGS','آیکن های پیام ها');
define($constpref.'_ICON_MEANINGSDSC','همه ی آیکن ها را تعیین کنید. هر کدوم از نام ها را با (|) از بقیه جدا کنید. نام اولین عکس مرتبط "posticon0.gif" است.');
define($constpref.'_ICON_MEANINGSDEF','none|normal|unhappy|happy|raise it|lower it|report|question');
define($constpref.'_GUESTVOTE_IVL','رای دادن مهمان ها');
define($constpref.'_GUESTVOTE_IVLDSC','با انتخواب صفر امکان رای دادن مهمان ها غیر فعال میشود. The other this number means time(sec.) to allow second post from the same IP.');



// Notify Categories
define($constpref.'_NOTCAT_TOPIC', 'این تاپیک'); 
define($constpref.'_NOTCAT_TOPICDSC', 'اطلاع در مورد هدف این تاپیک');
define($constpref.'_NOTCAT_FORUM', 'این انجمن'); 
define($constpref.'_NOTCAT_FORUMDSC', 'اطلاع در مورد هدف این انجمن');
define($constpref.'_NOTCAT_CAT', 'این شاخه');
define($constpref.'_NOTCAT_CATDSC', 'اطلاع در مورد هدف این شاخه');
define($constpref.'_NOTCAT_GLOBAL', 'این ماژول');
define($constpref.'_NOTCAT_GLOBALDSC', 'اطلاع در مورد هدف این ماژول');

// Each Notifications
define($constpref.'_NOTIFY_TOPIC_NEWPOST', 'پست جدید در تاپیک');
define($constpref.'_NOTIFY_TOPIC_NEWPOSTCAP', 'وقتی پست جدیدی  در این تاپیک خورد مرا با خبر کن.');
define($constpref.'_NOTIFY_TOPIC_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}:{TOPIC_TITLE} پست جدید در تاپیک');

define($constpref.'_NOTIFY_FORUM_NEWPOST', 'پست جدید در انجمن');
define($constpref.'_NOTIFY_FORUM_NEWPOSTCAP', 'وقتی پست جدیدی در این انجمن زده شد مرا با خبر کن');
define($constpref.'_NOTIFY_FORUM_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}:{FORUM_TITLE} پست جدید در انجمن');

define($constpref.'_NOTIFY_FORUM_NEWTOPIC', 'تاپیک جدید در این انجمن');
define($constpref.'_NOTIFY_FORUM_NEWTOPICCAP', 'وقتی تاپیک جدیدی در این انجمن باز شد مرا با خبر کن.');
define($constpref.'_NOTIFY_FORUM_NEWTOPICSBJ', '[{X_SITENAME}] {X_MODULE}:{FORUM_TITLE} تاپیک جدید در انجمن');

define($constpref.'_NOTIFY_CAT_NEWPOST', 'پست جدید در این شاخه');
define($constpref.'_NOTIFY_CAT_NEWPOSTCAP', 'وقتی پست جدیدی در این شاخه زده شد مرا با خبر کن .');
define($constpref.'_NOTIFY_CAT_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}:{CAT_TITLE} پست جدید در شاخه');

define($constpref.'_NOTIFY_CAT_NEWTOPIC', 'تاپیک جدید در این شاخه');
define($constpref.'_NOTIFY_CAT_NEWTOPICCAP', 'وقتی تاپیک جدیدی در این شاخه زده شد مرا با خبر کن.');
define($constpref.'_NOTIFY_CAT_NEWTOPICSBJ', '[{X_SITENAME}] {X_MODULE}:{CAT_TITLE} تاپیک جدید در شاخه');

define($constpref.'_NOTIFY_CAT_NEWFORUM', 'انجمن جدید در این شاخه');
define($constpref.'_NOTIFY_CAT_NEWFORUMCAP', 'وقتی انجمن جدیدی در این شاخه زده شد مرا با خبر کن');
define($constpref.'_NOTIFY_CAT_NEWFORUMSBJ', '[{X_SITENAME}] {X_MODULE}:{CAT_TITLE} انجمن جدید در شاخه');

define($constpref.'_NOTIFY_GLOBAL_NEWPOST', 'پست جدید در این ماژول');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTCAP', 'وقتی پست جدیدی در این ماژول خورد مرا با خبر کن');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}: پست جدید');

define($constpref.'_NOTIFY_GLOBAL_NEWTOPIC', 'تاپیک جدید در این ماژول');
define($constpref.'_NOTIFY_GLOBAL_NEWTOPICCAP', 'وقتی تاپیک جدیدی در این ماژول خورد مرا با خبر کن');
define($constpref.'_NOTIFY_GLOBAL_NEWTOPICSBJ', '[{X_SITENAME}] {X_MODULE}: تاپیک جدید');

define($constpref.'_NOTIFY_GLOBAL_NEWFORUM', 'انجمن جدید در این ماژول');
define($constpref.'_NOTIFY_GLOBAL_NEWFORUMCAP', 'وقتی انجمن جدیدی در این ماژول زده شد مرا با خبر کن');
define($constpref.'_NOTIFY_GLOBAL_NEWFORUMSBJ', '[{X_SITENAME}] {X_MODULE}:انجمن جدید');

define($constpref.'_NOTIFY_GLOBAL_NEWPOSTFULL', 'پست جدید (متن کامل)');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTFULLCAP', 'Notify me of any new posts (include full text in message).');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTFULLSBJ', '[{X_SITENAME}] {POST_TITLE}');
define($constpref.'_NOTIFY_GLOBAL_WAITING', 'New waiting');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCAP', 'Notify me of new posts waiting approval. For admins only');
define($constpref.'_NOTIFY_GLOBAL_WAITINGSBJ', '[{X_SITENAME}] {X_MODULE}: New waiting');

}

?>