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
define('_PICAL_FMT_YEAR','%s<font size=""> �~</font>') ;

define('_PICAL_ICON_DAILY','���') ;
define('_PICAL_ICON_WEEKLY','�g��') ;
define('_PICAL_ICON_MONTHLY','���') ;
define('_PICAL_ICON_YEARLY','�~��') ;

define('_PICAL_MB_LINKTODAY','����') ;
define('_PICAL_MB_NOSUBJECT','(�S���D�D)') ;

define('_PICAL_MB_PREV_DATE','�e�@��') ;
define('_PICAL_MB_NEXT_DATE','���@��') ;
define('_PICAL_MB_PREV_WEEK','�W�g') ;
define('_PICAL_MB_NEXT_WEEK','�U�g') ;
define('_PICAL_MB_PREV_MONTH','�W�Ӥ�') ;
define('_PICAL_MB_NEXT_MONTH','�U�Ӥ�') ;
define('_PICAL_MB_PREV_YEAR','�e�@�~') ;
define('_PICAL_MB_NEXT_YEAR','���@�~') ;

define('_PICAL_MB_NOEVENT','�S���ƥ�') ;
define('_PICAL_MB_ADDEVENT','�s�W�ƥ�') ;
define('_PICAL_MB_CONTINUING','(�~��)') ;
define('_PICAL_MB_RESTEVENT_PRE','��h') ;
define('_PICAL_MB_RESTEVENT_SUF','�ƥ�') ;
define('_PICAL_MB_TIMESEPARATOR','--') ;

define('_PICAL_MB_ALLDAY_EVENT','���Ѩƥ�') ;
define('_PICAL_MB_LONG_EVENT','���C�����') ;
define('_PICAL_MB_LONG_SPECIALDAY','�g�~�����鵥��') ;

define('_PICAL_MB_PUBLIC','���}�ƥ�') ;
define('_PICAL_MB_PRIVATE','�p�H�ƥ�') ;
define('_PICAL_MB_PRIVATETARGET',' -> �ݩ�G %s') ;

define('_PICAL_MB_LINK_TO_RRULE1ST','���ܲĤ@�Өƥ�') ;
define('_PICAL_MB_RRULE1ST','�o�O�Ĥ@�Өƥ�') ;

define('_PICAL_MB_EVENT_NOTREGISTER','�|���f�ֳq�L') ;
define('_PICAL_MB_EVENT_ADMITTED','�f��') ;
define('_PICAL_MB_EVENT_NEEDADMIT','���ݼf�ֳq�L') ;

define('_PICAL_MB_TITLE_EVENTINFO','��ƾ�') ;
define('_PICAL_MB_SUBTITLE_EVENTDETAIL','�[�ݸԱ�') ;
define('_PICAL_MB_SUBTITLE_EVENTEDIT','�s��ƥ�') ;

define('_PICAL_MB_HOUR_SUF',':') ;
define('_PICAL_MB_MINUTE_SUF','') ;

define('_PICAL_TH_SUMMARY','��{�K�n') ;
define('_PICAL_TH_STARTDATETIME','�}�l������ɶ�') ;
define('_PICAL_TH_ENDDATETIME','����������ɶ�') ;
define('_PICAL_TH_ALLDAYOPTIONS','����ﶵ') ;
define('_PICAL_TH_LOCATION','�a�I') ;
define('_PICAL_TH_CONTACT','�p���H') ;
define('_PICAL_TH_CLASS','���O') ;
define('_PICAL_TH_DESCRIPTION','��{���e�y�z') ;
define('_PICAL_TH_RRULE','���ƳW�h') ;
define('_PICAL_TH_ADMISSIONSTATUS','���A') ;

define('_PICAL_NTC_MONTHLYBYMONTHDAY',' (�п�J����Ʀr)') ;
define('_PICAL_NTC_EXTRACTLIMIT','** �p�G���Ʀ��Ʀ��]����,�ƥ�i�}�W���Ƭ� %s ���ƥ�.') ;
define('_PICAL_NTC_NUMBEROFNEEDADMIT','(��%s���ƥ󵥫ݼf��)') ;

define('_PICAL_OPT_PRIVATEMYSELF','�ӤH�M��') ;
define('_PICAL_OPT_PRIVATEGROUP','�s�� - %s') ;
define('_PICAL_OPT_PRIVATEINVALID','(�L�Ī��s��)') ;

define('_PICAL_CNFM_SAVEAS_YN','�z�n�x�s���t�@��������?') ;
define('_PICAL_CNFM_DELETE_YN','�z�n�R���o��������?') ;

define('_PICAL_ERR_INVALID_EVENT_ID','���~: �S���o�{�ƥ�ID') ;
define('_PICAL_ERR_NOPERM_TO_SHOW',"���~: �z�S���[�ݪ��v��") ;
define('_PICAL_ERR_NOPERM_TO_OUTPUTICS',"���~: �z�S���ץX�� iCalendar ���v��") ;
define('_PICAL_ERR_LACKINDISPITEM','Item %s is blank.<br />Return by pushing button of browser') ;

define('_PICAL_BTN_JUMP','����') ;
define('_PICAL_BTN_NEWINSERTED','�s�W') ;
define('_PICAL_BTN_SUBMITCHANGES',' �ܧ�! ') ;
define('_PICAL_BTN_SAVEAS','�x�s��') ;
define('_PICAL_BTN_DELETE','�R��') ;
define('_PICAL_BTN_EDITEVENT','�s��') ;
define('_PICAL_BTN_RESET','���]') ;
define('_PICAL_BTN_OUTPUTICS_WIN','iCalendar(Win)') ;
define('_PICAL_BTN_OUTPUTICS_MAC','iCalendar(Mac)') ;

define('_PICAL_RR_EVERYDAY','�C��') ;
define('_PICAL_RR_EVERYWEEK','�C�g') ;
define('_PICAL_RR_EVERYMONTH','�C��') ;
define('_PICAL_RR_EVERYYEAR','�C�~') ;
define('_PICAL_RR_FREQDAILY','�魫��') ;
define('_PICAL_RR_FREQWEEKLY','�g����') ;
define('_PICAL_RR_FREQMONTHLY','�뭫��') ;
define('_PICAL_RR_FREQYEARLY','�~����') ;
define('_PICAL_RR_FREQDAILY_PRE','�C�j�G') ;
define('_PICAL_RR_FREQWEEKLY_PRE','�C�j�G') ;
define('_PICAL_RR_FREQMONTHLY_PRE','�C�j�G') ;
define('_PICAL_RR_FREQYEARLY_PRE','�C�j�G') ;
define('_PICAL_RR_FREQDAILY_SUF','��') ;
define('_PICAL_RR_FREQWEEKLY_SUF','�g') ;
define('_PICAL_RR_FREQMONTHLY_SUF','��') ;
define('_PICAL_RR_FREQYEARLY_SUF','�~') ;
define('_PICAL_RR_PERDAY','�C %s ��') ;
define('_PICAL_RR_PERWEEK','�C %s �g') ;
define('_PICAL_RR_PERMONTH','�C %s ��') ;
define('_PICAL_RR_PERYEAR','�C %s �~') ;
define('_PICAL_RR_COUNT','<br />%s ��') ;
define('_PICAL_RR_UNTIL','<br />�� %s') ;
define('_PICAL_RR_R_NORRULE','�D���ƨƥ�') ;
define('_PICAL_RR_R_YESRRULE','���ƨƥ�') ;
define('_PICAL_RR_OR','��') ;
define('_PICAL_RR_S_NOTSELECTED','-�S�����-') ;
define('_PICAL_RR_S_SAMEASBDATE','�P�}�l����P�@��') ;
define('_PICAL_RR_R_NOCOUNTUNTIL','�S������') ;
define('_PICAL_RR_R_USECOUNT_PRE','���Ʀ���') ;
define('_PICAL_RR_R_USECOUNT_SUF','��') ;
define('_PICAL_RR_R_USEUNTIL','����') ;


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