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
define('_MI_PICAL_DEFAULTLOCALE','france');
define('_MI_PICAL_LOCALE','Locale (check files in locales/*.php)');

define( 'PICAL_MI_LOADED' , 1 ) ;

// Module Info
// French version www.generationrealtv.net

// The name of this module

// Appended by Xoops Language Checker -GIJOE- in 2004-06-22 18:39:02
define('_MI_PICAL_ADMENU_MYBLOCKSADMIN','Blocks&Groups Admin');

define("_MI_PICAL_NAME", "piCal");

// A brief description of this module
define("_MI_PICAL_DESC", "Module Calendrier avec agenda");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PICAL_BNAME_MINICAL", "Mini Calendrier");
define("_MI_PICAL_BNAME_MINICAL_DESC", "Affiche le bloc mini calendrier");
define("_MI_PICAL_BNAME_MONTHCAL", "Calendrier Mensuel");
define("_MI_PICAL_BNAME_MONTHCAL_DESC", "Affichage complet du calendrier mensuel");
define("_MI_PICAL_BNAME_TODAYS", "Ev��ements aujourd'hui");
define("_MI_PICAL_BNAME_TODAYS_DESC", "Affiche les ����ements du jour");
define("_MI_PICAL_BNAME_THEDAYS", "Ev��ements du %s");
define("_MI_PICAL_BNAME_THEDAYS_DESC", "Affiche les ����ements du jour indiqu�");
define("_MI_PICAL_BNAME_COMING", "Ev��ements � venir");
define("_MI_PICAL_BNAME_COMING_DESC", "Affiche les ����nements � venir");
define("_MI_PICAL_BNAME_AFTER", "Ev��ements apr�� ce %s");
define("_MI_PICAL_BNAME_AFTER_DESC", "Affiche les ����ements apr�� la date indiqu��");
define("_MI_PICAL_BNAME_NEW", "Evenements nouvellement post��");
define("_MI_PICAL_BNAME_NEW_DESC", "Display events ordered like that newer is upper");

// Names of submenu
define("_MI_PICAL_SM_SUBMIT","Soumettre");

//define("_MI_PICAL_ADMENU1","");

// Title of config items
define("_MI_USERS_AUTHORITY", "Autorit�� des utilisateurs");
define("_MI_GUESTS_AUTHORITY", "Autorit�� des invit��");
define("_MI_DEFAULT_VIEW", "Vue par d��aut au centre");
define("_MI_MINICAL_TARGET", "La page s'affiche au centre quand la date du mini calendrier est cliqu��");
define("_MI_COMING_NUMROWS", "Le nombre d'����ements dans le bloc des ����ements � venir");
define("_MI_SKINFOLDER", "Nom des chemins de skin");
define("_MI_SUNDAYCOLOR", "Couleur du Dimanche");
define("_MI_WEEKDAYCOLOR", "Couleur des jours de la semaine");
define("_MI_SATURDAYCOLOR", "Couleur du Samedi");
define("_MI_HOLIDAYCOLOR", "Couleur des vacances");
define("_MI_TARGETDAYCOLOR", "Couleur du jour s��ectionn�");
define("_MI_SUNDAYBGCOLOR", "Couleur de fond du Dimanche");
define("_MI_WEEKDAYBGCOLOR", "Couleur de fond des jours de la semaine");
define("_MI_SATURDAYBGCOLOR", "Couleur de fond du Samedi");
define("_MI_HOLIDAYBGCOLOR", "Couleur de fond des vacances");
define("_MI_TARGETDAYBGCOLOR", "Couleur de fond du jour s��ectionn�");
define("_MI_CALHEADCOLOR", "Couleur de l'ent��e du calendrier");
define("_MI_CALHEADBGCOLOR", "Couleur de fond de l'ent��e du calendrier");
define("_MI_CALFRAMECSS", "Style du cadre du calendrier");
define("_MI_CANOUTPUTICS", "Permission d'extraire des fichiers ics");
define("_MI_MAXRRULEEXTRACT", "Limite sup��ieure d'extraction des ����ements par p��iodicit�.(compteur)");
define("_MI_WEEKSTARTFROM", "Jour de d��ut de la semaine");
define("_MI_WEEKNUMBERING", "Numbering rule for weeks");
define("_MI_DAYSTARTFROM", "Borderline to separate days");
define("_MI_NAMEORUNAME" , "Poster name displayed" ) ;
define("_MI_DESCNAMEORUNAME" , "Select which 'name' is displayed" ) ;

// Description of each config items
define("_MI_EDITBYGUESTDSC", "Autoriser les invit�� � ajouter des ����ements");

// Options of each config items
define("_MI_OPT_AUTH_NONE", "ne peut pas ajouter");
define("_MI_OPT_AUTH_WAIT", "peut ajouter mais mod��ation");
define("_MI_OPT_AUTH_POST", "peut ajouter sans mod��ation");
define("_MI_OPT_AUTH_BYGROUP", "sp��ifi� dans les permissions de groupes");
define("_MI_OPT_MINI_PHPSELF", "page courante");
define("_MI_OPT_MINI_MONTHLY", "calendrier mensuel");
define("_MI_OPT_MINI_WEEKLY", "calendrier hebdomadaire");
define("_MI_OPT_MINI_DAILY", "calendrier journalier");
define("_MI_OPT_MINI_LIST", "Liste d'����ements");
define("_MI_OPT_CANOUTPUTICS", "peut extraire");
define("_MI_OPT_CANNOTOUTPUTICS", "ne peut pas extraire");
define("_MI_OPT_STARTFROMSUN", "Dimanche");
define("_MI_OPT_STARTFROMMON", "Lundi");
define("_MI_OPT_WEEKNOEACHMONTH", "Pour chaque mois");
define("_MI_OPT_WEEKNOWHOLEYEAR", "Par ann�� enti��e");
define("_MI_OPT_USENAME" , "Nom" ) ;
define("_MI_OPT_USEUNAME" , "Nom de Login" ) ;

// Admin Menus
define("_MI_PICAL_ADMENU0", "Admitting Events");
define("_MI_PICAL_ADMENU1", "Events Manager");
define("_MI_PICAL_ADMENU_CAT", "Categories Manager");
define("_MI_PICAL_ADMENU_CAT2GROUP", "Category's Permissions");
define("_MI_PICAL_ADMENU2", "Global Permissions");
define("_MI_PICAL_ADMENU_TM", "Table Maintenance");
define("_MI_PICAL_ADMENU_ICAL", "Importing iCalendar");

// Text for notifications
define('_MI_PICAL_GLOBAL_NOTIFY', 'Globale');
define('_MI_PICAL_GLOBAL_NOTIFYDSC', 'Options de notifications globales de piCal.');
define('_MI_PICAL_CATEGORY_NOTIFY', 'Categorie');
define('_MI_PICAL_CATEGORY_NOTIFYDSC', 'Options de notifications s\'appliquant � cette categorie.');
define('_MI_PICAL_EVENT_NOTIFY', 'Ev��ement');
define('_MI_PICAL_EVENT_NOTIFYDSC', 'Options de notifications s\'appliquant � cet ����ement.');

define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFY', 'Nouvel Ev��ement');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYCAP', 'Notifiez moi quand un nouvel ����ement est cr��.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYDSC', 'Recevoir une notification quand un nouvel ����ement est cr��.');
define('_MI_PICAL_GLOBAL_NEWEVENT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification automatique : Nouvel ����ement');

define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFY', 'Nouvel ����ement dans la cat��orie');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYCAP', 'Notifiez moi quand un nouvel ����ement est cr�� dans la Categorie.');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYDSC', 'Recevoir une notification quand un nouvel ����ement est cr�� dans la Categorie.');
define('_MI_PICAL_CATEGORY_NEWEVENT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification automatique : Nouvel ����ement dans {CATEGORY_TITLE}');



}

?>
