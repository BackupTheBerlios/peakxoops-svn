<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'PICAL_MI_LOADED' ) ) {





// Appended by Xoops Language Checker -GIJOE- in 2005-05-06 18:03:59
define('_MI_TIMEZONE_USING','Timezone of the server');
define('_MI_OPT_TZ_USEXOOPS','value of XOOPS config');
define('_MI_OPT_TZ_USEWINTER','value told from the server as winter time (recommended)');
define('_MI_OPT_TZ_USESUMMER','value told from the server as summer time');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-03 05:31:12
define('_MI_USE24HOUR','24hours system (No means 12hours system)');
define('_MI_PICAL_ADMENU_PLUGINS','Plugins Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-04-22 12:02:01
define('_MI_PICAL_BNAME_MINICALEX','MiniCalendarEx');
define('_MI_PICAL_BNAME_MINICALEX_DESC','Extensible minicalendar with plugin system');

// Appended by Xoops Language Checker -GIJOE- in 2005-01-08 04:36:49
define('_MI_PICAL_DEFAULTLOCALE','');
define('_MI_PICAL_LOCALE','Locale (check files in locales/*.php)');

define( 'PICAL_MI_LOADED' , 1 ) ;

// Module Info

// The name of this module

// Appended by Xoops Language Checker -GIJOE- in 2004-06-22 18:39:03
define('_MI_PICAL_ADMENU_MYBLOCKSADMIN','Blocks&Groups Admin');

define("_MI_PICAL_NAME","piCal行事曆");

// A brief description of this module
define("_MI_PICAL_DESC","具有行事曆功能的日曆模組-Virus&Xoobs");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PICAL_BNAME_MINICAL","迷你日曆");
define("_MI_PICAL_BNAME_MINICAL_DESC","顯示迷你日曆區塊");
define("_MI_PICAL_BNAME_MONTHCAL","月曆");
define("_MI_PICAL_BNAME_MONTHCAL_DESC","顯示完整月曆");
define("_MI_PICAL_BNAME_TODAYS","今日事件");
define("_MI_PICAL_BNAME_TODAYS_DESC","顯示今天的事件");
define("_MI_PICAL_BNAME_THEDAYS","今天的事件");
define("_MI_PICAL_BNAME_THEDAYS_DESC","顯示指出日期的事件");
define("_MI_PICAL_BNAME_COMING","近期事件");
define("_MI_PICAL_BNAME_COMING_DESC","顯示近期的事件");
define("_MI_PICAL_BNAME_AFTER","今日以後事件");
define("_MI_PICAL_BNAME_AFTER_DESC","顯示今日以後的事件");

// Names of submenu
// define("_MI_PICAL_SMNAME1","");

//define("_MI_PICAL_ADMENU1","");

// Title of config items
define("_MI_USERS_AUTHORITY", "用戶權限");
define("_MI_GUESTS_AUTHORITY", "訪客權限");
define("_MI_MINICAL_TARGET", "當點選迷你行事曆時所要顯示在畫面中央的行事曆");
define("_MI_COMING_NUMROWS", "在近期事件區塊顯示事件的數目");
define("_MI_SKINFOLDER", "行事曆表皮的資料夾名稱");
define("_MI_SUNDAYCOLOR", "星期日的顏色");
define("_MI_WEEKDAYCOLOR", "平日的顏色");
define("_MI_SATURDAYCOLOR", "星期六的顏色");
define("_MI_HOLIDAYCOLOR", "假日的顏色");
define("_MI_TARGETDAYCOLOR", "預定日的顏色");
define("_MI_SUNDAYBGCOLOR", "星期日的背景顏色");
define("_MI_WEEKDAYBGCOLOR", "平日的顏色");
define("_MI_SATURDAYBGCOLOR", "星期六的背景顏色");
define("_MI_HOLIDAYBGCOLOR", "假日的背景顏色");
define("_MI_TARGETDAYBGCOLOR", "預定日的背景顏色");
define("_MI_CALHEADCOLOR", "行事曆主題部份的顏色");
define("_MI_CALHEADBGCOLOR", "行事曆主題部份的背景顏色");
define("_MI_CALFRAMECSS", "行事曆視窗的樣式");
define("_MI_CANOUTPUTICS", "匯出 ics 檔案的權限");
define("_MI_MAXRRULEEXTRACT", "重複事件展開上限數.");
define("_MI_WEEKSTARTFROM", "每週的第一天是");

// Description of each config items
define("_MI_EDITBYGUESTDSC", "訪客新增事件的權限");

// Options of each config items
define("_MI_OPT_AUTH_NONE", "無法新增事件");
define("_MI_OPT_AUTH_WAIT", "可以新增事件並且需要審核");
define("_MI_OPT_AUTH_POST", "可以新增事件但不需要審核");
define("_MI_OPT_AUTH_BYGROUP", "依照群組權限設定");
define("_MI_OPT_MINI_PHPSELF", "目前頁面");
define("_MI_OPT_MINI_MONTHLY", "月行事曆");
define("_MI_OPT_MINI_WEEKLY", "週行事曆");
define("_MI_OPT_MINI_DAILY", "日行事曆");
define("_MI_OPT_CANNOTOUTPUTICS", "可以匯出");
define("_MI_OPT_CANOUTPUTICS", "無法匯出");
define("_MI_OPT_STARTFROMSUN", "星期日");
define("_MI_OPT_STARTFROMMON", "星期一");


// Admin Menus
define("_MI_PICAL_ADMENU0","待審事件管理");
define("_MI_PICAL_ADMENU1","匯出/匯入 iCalendar");
define("_MI_PICAL_ADMENU2","群組權限管理");


// Appended by Xoops Language Checker -GIJOE- in 2003-12-05 14:18:43
define('_MI_NAMEORUNAME','Poster name displayed');
define('_MI_DESCNAMEORUNAME','Select which \'name\' is displayed');
define('_MI_OPT_USENAME','Handle Name');
define('_MI_OPT_USEUNAME','Login Name');

// Appended by Xoops Language Checker -GIJOE- in 2003-12-26 10:55:16
define('_MI_DAYSTARTFROM','Borderline to separate days');
define('_MI_PICAL_GLOBAL_NOTIFY','Global');
define('_MI_PICAL_GLOBAL_NOTIFYDSC','Global piCal notification options.');
define('_MI_PICAL_CATEGORY_NOTIFY','Category');
define('_MI_PICAL_CATEGORY_NOTIFYDSC','Notification options that apply to the current category.');
define('_MI_PICAL_EVENT_NOTIFY','Event');
define('_MI_PICAL_EVENT_NOTIFYDSC','Notification options that apply to the current event.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFY','New Event');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYCAP','Notify me when a new event is created.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYDSC','Receive notification when a new event is created.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE} auto-notify : New event');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-14 18:31:01
define('_MI_PICAL_BNAME_NEW','Events newly posted');
define('_MI_PICAL_BNAME_NEW_DESC','Display events ordered like that newer is upper');
define('_MI_PICAL_SM_SUBMIT','Submit');
define('_MI_DEFAULT_VIEW','Default View in center');
define('_MI_WEEKNUMBERING','Numbering rule for weeks');
define('_MI_OPT_MINI_LIST','event list');
define('_MI_OPT_WEEKNOEACHMONTH','by each month');
define('_MI_OPT_WEEKNOWHOLEYEAR','by whole year');
define('_MI_PICAL_ADMENU_CAT','Categories Manager');
define('_MI_PICAL_ADMENU_CAT2GROUP','Category\'s Permissions');
define('_MI_PICAL_ADMENU_TM','Table Maintenance');
define('_MI_PICAL_ADMENU_ICAL','Importing iCalendar');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFY','New Event in the Category');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYCAP','Notify me when a new event is created in the Category.');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYDSC','Receive notification when a new event is created in the Category.');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE} auto-notify : New event');

}

?>
