<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'PICAL_CNST_LOADED' ) ) {



// Appended by Xoops Language Checker -GIJOE- in 2005-05-17 17:34:00
define('_PICAL_BTN_DELETE_ONE','Remove just one');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-03 05:31:13
define('_PICAL_JS_CALENDAR','calendar-en.js');
define('_PICAL_JSFMT_YMDN','%d %B %Y (%A)');
define('_PICAL_DTFMT_MINUTE','i');
define('_PICAL_FMT_YMDN','%3$s %2$s %1$s %4$s');
define('_PICAL_FMT_DHI','%1$s %2$s:%3$s');
define('_PICAL_FMT_HI','%1$s:%2$s');
define('_PICAL_TH_TIMEZONE','Time Zone');

define( 'PICAL_CNST_LOADED' , 1 ) ;


// format for date()  see http://jp.php.net/date
define('_PICAL_DTFMT_TIME','ag:i') ;

// set your locale
define('_PICAL_LOCALE','tw') ;
// format for strftime()  see http://jp.php.net/strftime
define('_PICAL_STRFFMT_DATE','%x') ;

define('_PICAL_FMT_MD','%1$s%2$s') ;
define('_PICAL_FMT_YMD','%1$s %2$s %3$s') ;
define('_PICAL_FMT_YMW','%1$s %2$s %3$s ') ;
define('_PICAL_FMT_YEAR_MONTH','%1$s %2$s') ;
define('_PICAL_FMT_YEAR','%s<font size=""> 年</font>') ;

define('_PICAL_ICON_DAILY','日曆') ;
define('_PICAL_ICON_WEEKLY','週曆') ;
define('_PICAL_ICON_MONTHLY','月曆') ;
define('_PICAL_ICON_YEARLY','年曆') ;

define('_PICAL_MB_LINKTODAY','今天') ;
define('_PICAL_MB_NOSUBJECT','(沒有主題)') ;

define('_PICAL_MB_PREV_DATE','前一天') ;
define('_PICAL_MB_NEXT_DATE','次一天') ;
define('_PICAL_MB_PREV_WEEK','上週') ;
define('_PICAL_MB_NEXT_WEEK','下週') ;
define('_PICAL_MB_PREV_MONTH','上個月') ;
define('_PICAL_MB_NEXT_MONTH','下個月') ;
define('_PICAL_MB_PREV_YEAR','前一年') ;
define('_PICAL_MB_NEXT_YEAR','次一年') ;

define('_PICAL_MB_NOEVENT','沒有事件') ;
define('_PICAL_MB_ADDEVENT','新增事件') ;
define('_PICAL_MB_CONTINUING','(繼續)') ;
define('_PICAL_MB_RESTEVENT_PRE','更多') ;
define('_PICAL_MB_RESTEVENT_SUF','事件') ;
define('_PICAL_MB_TIMESEPARATOR','--') ;

define('_PICAL_MB_ALLDAY_EVENT','全天事件') ;
define('_PICAL_MB_LONG_EVENT','條列狀顯示') ;
define('_PICAL_MB_LONG_SPECIALDAY','週年紀念日等等') ;

define('_PICAL_MB_PUBLIC','公開事件') ;
define('_PICAL_MB_PRIVATE','私人事件') ;
define('_PICAL_MB_PRIVATETARGET',' -> 屬於： %s') ;

define('_PICAL_MB_LINK_TO_RRULE1ST','跳至第一個事件') ;
define('_PICAL_MB_RRULE1ST','這是第一個事件') ;

define('_PICAL_MB_EVENT_NOTREGISTER','尚未審核通過') ;
define('_PICAL_MB_EVENT_ADMITTED','審核') ;
define('_PICAL_MB_EVENT_NEEDADMIT','等待審核通過') ;

define('_PICAL_MB_TITLE_EVENTINFO','行事曆') ;
define('_PICAL_MB_SUBTITLE_EVENTDETAIL','觀看詳情') ;
define('_PICAL_MB_SUBTITLE_EVENTEDIT','編輯事件') ;

define('_PICAL_MB_HOUR_SUF',':') ;
define('_PICAL_MB_MINUTE_SUF','') ;

define('_PICAL_TH_SUMMARY','行程摘要') ;
define('_PICAL_TH_STARTDATETIME','開始之日期時間') ;
define('_PICAL_TH_ENDDATETIME','結束之日期時間') ;
define('_PICAL_TH_ALLDAYOPTIONS','全日選項') ;
define('_PICAL_TH_LOCATION','地點') ;
define('_PICAL_TH_CONTACT','聯絡人') ;
define('_PICAL_TH_CLASS','類別') ;
define('_PICAL_TH_DESCRIPTION','行程內容描述') ;
define('_PICAL_TH_RRULE','重複規則') ;
define('_PICAL_TH_ADMISSIONSTATUS','狀態') ;

define('_PICAL_NTC_MONTHLYBYMONTHDAY',' (請輸入日期數字)') ;
define('_PICAL_NTC_EXTRACTLIMIT','** 如果重複次數有設限時,事件展開上限數為 %s 項事件.') ;
define('_PICAL_NTC_NUMBEROFNEEDADMIT','(有%s項事件等待審核)') ;

define('_PICAL_OPT_PRIVATEMYSELF','個人專屬') ;
define('_PICAL_OPT_PRIVATEGROUP','群組 - %s') ;
define('_PICAL_OPT_PRIVATEINVALID','(無效的群組)') ;

define('_PICAL_CNFM_SAVEAS_YN','您要儲存成另一筆紀錄嗎?') ;
define('_PICAL_CNFM_DELETE_YN','您要刪除這筆紀錄嗎?') ;

define('_PICAL_ERR_INVALID_EVENT_ID','錯誤: 沒有發現事件ID') ;
define('_PICAL_ERR_NOPERM_TO_SHOW',"錯誤: 您沒有觀看的權限") ;
define('_PICAL_ERR_NOPERM_TO_OUTPUTICS',"錯誤: 您沒有匯出至 iCalendar 的權限") ;
define('_PICAL_ERR_LACKINDISPITEM','Item %s is blank.<br />Return by pushing button of browser') ;

define('_PICAL_BTN_JUMP','切換') ;
define('_PICAL_BTN_NEWINSERTED','新增') ;
define('_PICAL_BTN_SUBMITCHANGES',' 變更! ') ;
define('_PICAL_BTN_SAVEAS','儲存為') ;
define('_PICAL_BTN_DELETE','刪除') ;
define('_PICAL_BTN_EDITEVENT','編輯') ;
define('_PICAL_BTN_RESET','重設') ;
define('_PICAL_BTN_OUTPUTICS_WIN','iCalendar(Win)') ;
define('_PICAL_BTN_OUTPUTICS_MAC','iCalendar(Mac)') ;

define('_PICAL_RR_EVERYDAY','每天') ;
define('_PICAL_RR_EVERYWEEK','每週') ;
define('_PICAL_RR_EVERYMONTH','每月') ;
define('_PICAL_RR_EVERYYEAR','每年') ;
define('_PICAL_RR_FREQDAILY','日重複') ;
define('_PICAL_RR_FREQWEEKLY','週重複') ;
define('_PICAL_RR_FREQMONTHLY','月重複') ;
define('_PICAL_RR_FREQYEARLY','年重複') ;
define('_PICAL_RR_FREQDAILY_PRE','每隔：') ;
define('_PICAL_RR_FREQWEEKLY_PRE','每隔：') ;
define('_PICAL_RR_FREQMONTHLY_PRE','每隔：') ;
define('_PICAL_RR_FREQYEARLY_PRE','每隔：') ;
define('_PICAL_RR_FREQDAILY_SUF','日') ;
define('_PICAL_RR_FREQWEEKLY_SUF','週') ;
define('_PICAL_RR_FREQMONTHLY_SUF','月') ;
define('_PICAL_RR_FREQYEARLY_SUF','年') ;
define('_PICAL_RR_PERDAY','每 %s 日') ;
define('_PICAL_RR_PERWEEK','每 %s 週') ;
define('_PICAL_RR_PERMONTH','每 %s 月') ;
define('_PICAL_RR_PERYEAR','每 %s 年') ;
define('_PICAL_RR_COUNT','<br />%s 次') ;
define('_PICAL_RR_UNTIL','<br />到 %s') ;
define('_PICAL_RR_R_NORRULE','非重複事件') ;
define('_PICAL_RR_R_YESRRULE','重複事件') ;
define('_PICAL_RR_OR','或') ;
define('_PICAL_RR_S_NOTSELECTED','-沒有選擇-') ;
define('_PICAL_RR_S_SAMEASBDATE','與開始日期同一天') ;
define('_PICAL_RR_R_NOCOUNTUNTIL','沒有限制') ;
define('_PICAL_RR_R_USECOUNT_PRE','重複次數') ;
define('_PICAL_RR_R_USECOUNT_SUF','次') ;
define('_PICAL_RR_R_USEUNTIL','直到') ;


// Appended by Xoops Language Checker -GIJOE- in 2003-12-05 14:18:43
define('_PICAL_TH_SUBMITTER','Submitter');

// Appended by Xoops Language Checker -GIJOE- in 2003-12-26 10:55:16
define('_PICAL_STRFFMT_DATE_FOR_BLOCK','%d %b');
define('_PICAL_STRFFMT_TIME','%H:%M');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-14 18:31:01
define('_PICAL_FMT_YW','WEEK%2$s %1$s');
define('_PICAL_FMT_WEEKNO','WEEK %s');
define('_PICAL_ICON_LIST','List View');
define('_PICAL_MB_SHOWALLCAT','All Categories');
define('_PICAL_MB_ORDER_ASC','ascending');
define('_PICAL_MB_ORDER_DESC','descending');
define('_PICAL_MB_SORTBY','Sort by:');
define('_PICAL_MB_CURSORTEDBY','Events currently sorted by:');
define('_PICAL_TH_CATEGORIES','Categories');
define('_PICAL_TH_LASTMODIFIED','Last Modified');
define('_PICAL_BTN_PRINT','Print');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-17 18:09:08
define('_PICAL_FMT_YMDO','%4$s%3$s%2$s%1$s');
define('_PICAL_MB_LABEL_CHECKEDITEMS','Checked events are:');
define('_PICAL_MB_LABEL_OUTPUTICS','to be exported in iCalendar');
define('_PICAL_MB_ICALSELECTPLATFORM','Select platform');
define('_PICAL_MB_OP_AFTER','After');
define('_PICAL_MB_OP_BEFORE','Before');
define('_PICAL_MB_OP_ON','On');
define('_PICAL_MB_OP_ALL','All');
define('_PICAL_BTN_IMPORT','Import!');
define('_PICAL_BTN_UPLOAD','Upload!');
define('_PICAL_BTN_EXPORT','Export!');
define('_PICAL_BTN_EXTRACT','Extract');
define('_PICAL_BTN_ADMIT','Admit');
define('_PICAL_BTN_MOVE','Move');
define('_PICAL_BTN_COPY','Copy');

}

?>