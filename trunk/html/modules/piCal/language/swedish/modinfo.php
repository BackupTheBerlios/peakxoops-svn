<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'PICAL_MI_LOADED' ) ) {





// Appended by Xoops Language Checker -GIJOE- in 2005-05-06 18:04:00
define('_MI_TIMEZONE_USING','Timezone of the server');
define('_MI_OPT_TZ_USEXOOPS','value of XOOPS config');
define('_MI_OPT_TZ_USEWINTER','value told from the server as winter time (recommended)');
define('_MI_OPT_TZ_USESUMMER','value told from the server as summer time');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-03 05:31:13
define('_MI_USE24HOUR','24hours system (No means 12hours system)');
define('_MI_PICAL_ADMENU_PLUGINS','Plugins Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-04-22 12:02:02
define('_MI_PICAL_BNAME_MINICALEX','MiniCalendarEx');
define('_MI_PICAL_BNAME_MINICALEX_DESC','Utbyggbar Minikalender med plugin system');

// Appended by Xoops Language Checker -GIJOE- in 2005-01-08 04:36:50
define('_MI_PICAL_DEFAULTLOCALE','');
define('_MI_PICAL_LOCALE','Locale (kontrollera filer i locales/*.php)');

define( 'PICAL_MI_LOADED' , 1 ) ;

// Module Info

// The name of this module

// Appended by Xoops Language Checker -GIJOE- in 2004-06-22 18:39:03
define('_MI_PICAL_ADMENU_MYBLOCKSADMIN','Block&Grupp Admin');

define("_MI_PICAL_NAME","piCal");

// A brief description of this module
define("_MI_PICAL_DESC","Kalender modul med schema");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PICAL_BNAME_MINICAL","Minikalender");
define("_MI_PICAL_BNAME_MINICAL_DESC","Visa Minikalender block");
define("_MI_PICAL_BNAME_MONTHCAL","M�nadskalender");
define("_MI_PICAL_BNAME_MONTHCAL_DESC","Visa M�nadskalender i full storlek");
define("_MI_PICAL_BNAME_TODAYS","Dagens h�ndelser");
define("_MI_PICAL_BNAME_TODAYS_DESC","Visa Dagens h�ndelser");
define("_MI_PICAL_BNAME_THEDAYS","Denna dagens %s");
define("_MI_PICAL_BNAME_THEDAYS_DESC","Visa h�ndelser f�r markerad dag");
define("_MI_PICAL_BNAME_COMING","Kommande h�ndelser");
define("_MI_PICAL_BNAME_COMING_DESC","Visa kommande h�ndelser");
define("_MI_PICAL_BNAME_AFTER","H�ndelser efter %s");
define("_MI_PICAL_BNAME_AFTER_DESC","Visa h�ndelser efter markerad dag");

// Names of submenu
// define("_MI_PICAL_SMNAME1","");

//define("_MI_PICAL_ADMENU1","");

// Title of config items
define("_MI_USERS_AUTHORITY", "Beh�righeter f�r anv�ndare");
define("_MI_GUESTS_AUTHORITY", "Beh�righeter f�r g�ster");
define("_MI_MINICAL_TARGET", "Sida som visas i center blocket om man klickar p� Minikalendern");
define("_MI_COMING_NUMROWS", "Antalet visade h�ndelser i blocket f�r kommande h�ndelser");
define("_MI_SKINFOLDER", "Namnet p� den katalog som inneh�ller 'skin' filerna");
define("_MI_SUNDAYCOLOR", "F�rg p� texten f�r S�ndag");
define("_MI_WEEKDAYCOLOR", "F�rg p� texten f�r Veckodagar");
define("_MI_SATURDAYCOLOR", "F�rg p� texten f�r L�rdag");
define("_MI_HOLIDAYCOLOR", "F�rg p� texten f�r Helgdag");
define("_MI_TARGETDAYCOLOR", "F�rg p� texten f�r Markerad dag");
define("_MI_SUNDAYBGCOLOR", "Bakgrundsf�rg f�r S�ndagar");
define("_MI_WEEKDAYBGCOLOR", "Bakgrundsf�rg f�r Veckodagar");
define("_MI_SATURDAYBGCOLOR", "Bakgrundsf�rg f�r L�rdagar");
define("_MI_HOLIDAYBGCOLOR", "Bakgrundsf�rg f�r Helgdagar");
define("_MI_TARGETDAYBGCOLOR", "Bakgrundsf�rg p� markerad dag");
define("_MI_CALHEADCOLOR", "F�rg p� texten i 'headern' p� kalendern");
define("_MI_CALHEADBGCOLOR", "Bakgrundsf�rg i 'headern' p� kalendern");
define("_MI_CALFRAMECSS", "Stil p� ramen runt kalendern");
define("_MI_CANOUTPUTICS", "Till�telse att mata ut ics filer?");
define("_MI_MAXRRULEEXTRACT", "�vre gr�ns p� antalet h�ndelser som f�r extraheras med regel.(ANTAL)");
define("_MI_WEEKSTARTFROM", "F�rsta dagen i veckan");
define("_MI_DAYSTARTFROM", "Gr�ns f�r att separera dagar");
define("_MI_NAMEORUNAME" , "Vilket namn p� anv�ndaren skall visas" ) ;
define("_MI_DESCNAMEORUNAME" , "V�lj vilket 'namn' som visas" ) ;

// Description of each config items
define("_MI_EDITBYGUESTDSC", "Till�telse f�r g�ster att l�gga till h�ndelser");

// Options of each config items
define("_MI_OPT_AUTH_NONE", "kan inte l�gga till");
define("_MI_OPT_AUTH_WAIT", "kan l�gga till men kr�ver godk�nnande");
define("_MI_OPT_AUTH_POST", "kan l�gga till utan godk�nnande");
define("_MI_OPT_AUTH_BYGROUP", "Specificerad i Gruppr�ttigheterna");
define("_MI_OPT_MINI_PHPSELF", "nuvarande sida");
define("_MI_OPT_MINI_MONTHLY", "m�nadskalender");
define("_MI_OPT_MINI_WEEKLY", "veckokalender");
define("_MI_OPT_MINI_DAILY", "dagskalender");
define("_MI_OPT_CANOUTPUTICS", "kan mata ut");
define("_MI_OPT_CANNOTOUTPUTICS", "kan inte mata ut");
define("_MI_OPT_STARTFROMSUN", "S�ndag");
define("_MI_OPT_STARTFROMMON", "M�ndag");
define("_MI_OPT_USENAME" , "Anv�ndarnamn" ) ;
define("_MI_OPT_USEUNAME" , "Login Namn" ) ;

// Admin Menus
define("_MI_PICAL_ADMENU0","Godk�nna h�ndelser");
define("_MI_PICAL_ADMENU1","iCalendar I/O");
define("_MI_PICAL_ADMENU2","Grupp r�ttigheter");


// Text for notifications
define('_MI_PICAL_GLOBAL_NOTIFY', 'Globala');
define('_MI_PICAL_GLOBAL_NOTIFYDSC', 'Globala piCal underr�ttelse inst�llningar.');
define('_MI_PICAL_CATEGORY_NOTIFY', 'Kategori');
define('_MI_PICAL_CATEGORY_NOTIFYDSC', 'Underr�ttelse inst�llningar som g�ller f�r aktuell kategori.');
define('_MI_PICAL_EVENT_NOTIFY', 'H�ndelse');
define('_MI_PICAL_EVENT_NOTIFYDSC', 'Underr�ttelse inst�llningar som g�ller f�r aktuell h�ndelse.');

define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFY', 'Ny h�ndelse');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYCAP', 'Underr�tta mig n�r en ny h�ndelse har skapats.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYDSC', 'Mottag underr�ttelse n�r en ny h�ndelse har skapats.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} automatiska underr�ttelser : Ny h�ndelse');



// Appended by Xoops Language Checker -GIJOE- in 2004-01-14 18:31:01
define('_MI_PICAL_BNAME_NEW','Nyligen publicerade h�ndelser');
define('_MI_PICAL_BNAME_NEW_DESC','Visa h�ndelser sorterade med nyaste �verst');
define('_MI_PICAL_SM_SUBMIT','L�gg till');
define('_MI_DEFAULT_VIEW','Default Vy i center');
define('_MI_WEEKNUMBERING','Numrerings regel f�r veckor');
define('_MI_OPT_MINI_LIST','H�ndelse lista');
define('_MI_OPT_WEEKNOEACHMONTH','f�r varje m�nad');
define('_MI_OPT_WEEKNOWHOLEYEAR','f�r hela �ret');
define('_MI_PICAL_ADMENU_CAT','Kategori Administration');
define('_MI_PICAL_ADMENU_CAT2GROUP','R�ttigheter f�r Kategorier');
define('_MI_PICAL_ADMENU_TM','Tabell Underh�ll');
define('_MI_PICAL_ADMENU_ICAL','Importera iCalendar');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFY','Ny h�ndelse i denna kategori');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYCAP','Meddela mig n�r en ny h�ndelse �r skapad i denna kategori.');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYDSC','Mottag underr�ttelse n�r en ny h�ndelse �r skapad i denna kategori.');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE} auto-notify : Ny h�ndelse');

}

?>
