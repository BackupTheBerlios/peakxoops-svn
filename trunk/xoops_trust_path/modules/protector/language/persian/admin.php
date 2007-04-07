<?php

// mymenu
define('_MD_A_MYMENU_MYTPLSADMIN','');
define('_MD_A_MYMENU_MYBLOCKSADMIN','دسترسی ها');
define('_MD_A_MYMENU_MYPREFERENCES','ویژگی ها');

// index.php
define("_AM_TH_DATETIME","زمان");
define("_AM_TH_USER","کاربر");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","محاجم");
define("_AM_TH_TYPE","نوح حمله");
define("_AM_TH_DESCRIPTION","توضیحات");

define( "_AM_TH_BADIPS" , 'IP های بد<br /><br /><span style="font-weight:normal;">هر IP ی که در این کادر بنویسید جز IP های بد محاصبه میشود و دسترسیش مسدود میگردد<br />صفحه ی خالی یعنی اینکه تمام IP ها اجازه ی کار دارند</span>' ) ;

define( "_AM_TH_GROUP1IPS" , 'IP های مجاز برای کاربران گروه 1 <br /><br /><span style="font-weight:normal;">اگر این کادر را پر کنید فقط  IP های برای گروه 1 ( وب مستر ها) مورد تایید خواهد بود که در این کادر وارد شده باشد وب مستر ها با IP های دیگر قادر به انجام هیچ کاری نخواهند بود<br />192.168. means 192.168.*<br />صفحه ی خالی یعنی اینکه تمام IP ها اجازه ی کار دارند</span>' ) ;

define( "_AM_LABEL_REMOVE" , "حذف کردن گزارش های چک شده:" ) ;
define( "_AM_BUTTON_REMOVE" , "حذف کن!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "آیا حذف شود؟" ) ;
define( "_AM_MSG_IPFILESUPDATED" , "Files for IPs have been updated" ) ;
define( "_AM_MSG_BADIPSCANTOPEN" , "این فایل متعلق به یک ip بد است و قابل بازکردن نمیباشد" ) ;
define( "_AM_MSG_GROUP1IPSCANTOPEN" , "The file for allowing group=1 cannot be opened" ) ;
define( "_AM_MSG_REMOVED" , "گزارش های ثبت شده حذف شد" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "مدیریت پیشوند نام جدول های پایگاه داده ها" ) ;
define( "_AM_MSG_DBUPDATED" , "پایگاه داده ها با موفقیت به روز شد" ) ;
define( "_AM_CONFIRM_DELETE" , "تمام اطلاعات دروپ( حذف) میشود . موافقید؟" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "اگر شما میخواهید پیشوند نام جدول های پایگاه داده ها را تغییر دهید,<br /> فایل %s/mainfile.php را دستی ویراش کنید.<br />در حال حاضر ('XOOPS_DB_PREFIX', '<b>%s</b>')  به عنوان پیشوند نام جدول های پایگاه داده ها تعریف شده است;<br />پیشوند نام جدول های پایگاه داده ها  اسمی است که به ابتدای نام جدول های  پایگاه داده ها اضافه میشود" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","امن نیست");

define("_AM_ADV_REGISTERGLOBALS","This setting invites a variety of injecting attacks.<br />اگر شما میتوانید .htaccess به کار ببرید . ویرایشش کنید یا یکی بسازید...");
define("_AM_ADV_ALLOWURLFOPEN","این گزینه به حمله کنندگان اجازه میدهد از یک سرور دور اسکیریپ های را اجرا کنند<br />فقط وب مستر  میتواند این گزینه را تغییر دهد<br />اگر شما وب مستر هستید php.ini یا httpd.conf  را ویرایش کنید<br /><b>نمونه ای از httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />اگر شما وب مستر نیستید این مورد را به وب مستر  های خودتان  گزارش دهید");
define("_AM_ADV_USETRANSSID","Your Session ID will be diplayed in anchor tags etc.<br />برای جلوگیری از دزدی  جلسه ی شما این خط ها را به .htaccess در XOOPS_ROOT_PATH.  اضافه کنید<br /><b>php_flag session.use_trans_sid off</b>");
define("_AM_ADV_DBPREFIX","This setting invites 'SQL Injections'.<br />فراموش نکنید که   'Force sanitizing *' را در ویژگی های ماژول روشن کنید.");
define("_AM_ADV_LINK_TO_PREFIXMAN","برو به مدیریت پیشوند پایگاه داده ها");
define("_AM_ADV_MAINUNPATCHED","شما باید mainfile.php را ویرایش کنید لینک های مورد نظر در راهنمای ماژول قرار دارد");

define("_AM_ADV_SUBTITLECHECK","اگر پروتکتور به خوبی کار میکند این موارد را چک کنید");
define("_AM_ADV_CHECKCONTAMI","آلودگی ها");
define("_AM_ADV_CHECKISOCOM","قرنطینه کردن توضیحات");



?>