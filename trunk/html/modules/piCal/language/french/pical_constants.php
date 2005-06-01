<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'PICAL_CNST_LOADED' ) ) {



// Appended by Xoops Language Checker -GIJOE- in 2005-05-17 17:33:59
define('_PICAL_BTN_DELETE_ONE','Remove just one');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-03 05:31:12
define('_PICAL_JS_CALENDAR','calendar-en.js');
define('_PICAL_JSFMT_YMDN','%d %B %Y (%A)');
define('_PICAL_DTFMT_MINUTE','i');
define('_PICAL_FMT_YMDN','%3$s %2$s %1$s %4$s');
define('_PICAL_FMT_DHI','%1$s %2$s:%3$s');
define('_PICAL_FMT_HI','%1$s:%2$s');
define('_PICAL_TH_TIMEZONE','Time Zone');

define( 'PICAL_CNST_LOADED' , 1 ) ;


// format for date()  see http://jp.php.net/date
define('_PICAL_DTFMT_TIME','H:i') ;

// set your locale
define('_PICAL_LOCALE','fr_FR') ;
// format for strftime()  see http://jp.php.net/strftime
define('_PICAL_STRFFMT_DATE','%x') ;

define('_PICAL_FMT_MD','%1$s %2$s') ;
define('_PICAL_FMT_YMD','%1$s %2$s %3$s') ;
define('_PICAL_FMT_YMW','%1$s %2$s %3$s') ;
define('_PICAL_FMT_YEAR_MONTH','%1$s %2$s') ;
define('_PICAL_FMT_YEAR','<font size="-1">ANNEE </font>%s') ;

define('_PICAL_ICON_DAILY','Vue journalière') ;
define('_PICAL_ICON_WEEKLY','Vue hebdomadaire') ;
define('_PICAL_ICON_MONTHLY','Vue mensuelle') ;
define('_PICAL_ICON_YEARLY','Vue annuelle') ;

define("_PICAL_MB_LINKTODAY","Aujourd'hui") ;
define('_PICAL_MB_NOSUBJECT','(Pas de Sujet)') ;

define('_PICAL_MB_PREV_DATE','Demain') ;
define('_PICAL_MB_NEXT_DATE','Hier') ;
define('_PICAL_MB_PREV_WEEK','Semaine précédente') ;
define('_PICAL_MB_NEXT_WEEK','Semaine suivante') ;
define('_PICAL_MB_PREV_MONTH','Mois précédent') ;
define('_PICAL_MB_NEXT_MONTH','Mois suivant') ;
define('_PICAL_MB_PREV_YEAR','Année précédente') ;
define('_PICAL_MB_NEXT_YEAR','Année suivante') ;

define("_PICAL_MB_NOEVENT","Pas d'évènements") ;
define('_PICAL_MB_ADDEVENT','Ajouter un évènement') ;
define('_PICAL_MB_CONTINUING','(continuer)') ;
define('_PICAL_MB_RESTEVENT_PRE','plus') ;
define('_PICAL_MB_RESTEVENT_SUF','élément(s)') ;
define('_PICAL_MB_TIMESEPARATOR','--') ;

define('_PICAL_MB_ALLDAY_EVENT','Evènement journalier') ;
define('_PICAL_MB_LONG_EVENT','Montrer comme barre') ;
define('_PICAL_MB_LONG_SPECIALDAY','Anniversaire etc.') ;

define('_PICAL_MB_PUBLIC','Public') ;
define('_PICAL_MB_PRIVATE','Privé') ;
define('_PICAL_MB_PRIVATETARGET',' parmi %s') ;

define("_PICAL_MB_LINK_TO_RRULE1ST","Sauter jusqu'au premier évènement ") ;
define("_PICAL_MB_RRULE1ST","C'est le premier évènement") ;

define('_PICAL_MB_EVENT_NOTREGISTER','Non enregistré') ;
define('_PICAL_MB_EVENT_ADMITTED','Approuvé') ;
define("_PICAL_MB_EVENT_NEEDADMIT","Attente d'approbation") ;

define('_PICAL_MB_TITLE_EVENTINFO','Programmateur') ;
define('_PICAL_MB_SUBTITLE_EVENTDETAIL','Vue des détails') ;
define('_PICAL_MB_SUBTITLE_EVENTEDIT','Editer la vue') ;

define('_PICAL_MB_HOUR_SUF',':') ;
define('_PICAL_MB_MINUTE_SUF','') ;

define('_PICAL_TH_SUMMARY','Résumé') ;
define('_PICAL_TH_STARTDATETIME','Heure de début') ;
define('_PICAL_TH_ENDDATETIME','Heure de fin') ;
define('_PICAL_TH_ALLDAYOPTIONS','Options journalières') ;
define('_PICAL_TH_LOCATION','Endroit') ;
define('_PICAL_TH_CONTACT','Contact') ;
define('_PICAL_TH_CLASS','Classe') ;
define('_PICAL_TH_DESCRIPTION','Description') ;
define('_PICAL_TH_RRULE','Périodicité') ;
define('_PICAL_TH_ADMISSIONSTATUS','Statut') ;

define("_PICAL_NTC_MONTHLYBYMONTHDAY","(Numéro d'entrée)") ;
define('_PICAL_NTC_EXTRACTLIMIT','** Seulement %s évènements sont extraits en cas de maximum.') ;
define("_PICAL_NTC_NUMBEROFNEEDADMIT","(%s éléments nécessitent l'approbation)") ;

define('_PICAL_OPT_PRIVATEMYSELF','seulement moi') ;
define('_PICAL_OPT_PRIVATEGROUP','groupe %s') ;
define('_PICAL_OPT_PRIVATEINVALID','(groupe invalide)') ;

define("_PICAL_CNFM_SAVEAS_YN","Etes vous d'accord pour sauver un autre enregistrement ?") ;
define("_PICAL_CNFM_DELETE_YN","Etes vous d'accord pour supprimer cette enregistrement ?") ;

define('_PICAL_ERR_INVALID_EVENT_ID','Erreur: EventID non trouvé') ;
define('_PICAL_ERR_NOPERM_TO_SHOW',"Erreur: Vous n'avez pas la permission de voir") ;
define('_PICAL_ERR_NOPERM_TO_OUTPUTICS',"Erreur: Vous n'avez pas la permission d'extraire iCalendar") ;
define("_PICAL_ERR_LACKINDISPITEM","L'élément %s est vide.<br />Retournez en cliquant sur le bouton du browser") ;

define('_PICAL_BTN_JUMP','Saut') ;
define('_PICAL_BTN_NEWINSERTED','Nouvelle insertion') ;
define('_PICAL_BTN_SUBMITCHANGES',' Modifier! ') ;
define('_PICAL_BTN_SAVEAS','Sauvegarder sous') ;
define('_PICAL_BTN_DELETE','Effacer') ;
define('_PICAL_BTN_EDITEVENT','Editer') ;
define('_PICAL_BTN_RESET','Reinitialiser') ;
define('_PICAL_BTN_OUTPUTICS_WIN','iCalendar(Win)') ;
define('_PICAL_BTN_OUTPUTICS_MAC','iCalendar(Mac)') ;

define('_PICAL_RR_EVERYDAY','Chaque jour') ;
define('_PICAL_RR_EVERYWEEK','Chaque semaine') ;
define('_PICAL_RR_EVERYMONTH','Chaque mois') ;
define('_PICAL_RR_EVERYYEAR','Chaque année') ;
define('_PICAL_RR_FREQDAILY','Journalier') ;
define('_PICAL_RR_FREQWEEKLY','Hebdomadaire') ;
define('_PICAL_RR_FREQMONTHLY','Mensuel') ;
define('_PICAL_RR_FREQYEARLY','Annuel') ;
define('_PICAL_RR_FREQDAILY_PRE','Chaque') ;
define('_PICAL_RR_FREQWEEKLY_PRE','Chaque') ;
define('_PICAL_RR_FREQMONTHLY_PRE','Chaque') ;
define('_PICAL_RR_FREQYEARLY_PRE','Chaque') ;
define('_PICAL_RR_FREQDAILY_SUF','jour(s)') ;
define('_PICAL_RR_FREQWEEKLY_SUF','semaine(s)') ;
define('_PICAL_RR_FREQMONTHLY_SUF','mois') ;
define('_PICAL_RR_FREQYEARLY_SUF','année(s)') ;
define('_PICAL_RR_PERDAY','tous les %s jours') ;
define('_PICAL_RR_PERWEEK','toutes les %s semaines') ;
define('_PICAL_RR_PERMONTH','tous les %s mois') ;
define('_PICAL_RR_PERYEAR','tous les %s ans') ;
define('_PICAL_RR_COUNT','<br />%s fois') ;
define("_PICAL_RR_UNTIL","<br />jusqu'à %s") ;
define('_PICAL_RR_R_NORRULE','Recurrence Non') ;
define('_PICAL_RR_R_YESRRULE','Recurrence Oui') ;
define('_PICAL_RR_OR','ou') ;
define('_PICAL_RR_S_NOTSELECTED','-non sélectionné-') ;
define('_PICAL_RR_S_SAMEASBDATE','Identique à la date de début') ;
define('_PICAL_RR_R_NOCOUNTUNTIL','Pas de conditions de fin') ;
define('_PICAL_RR_R_USECOUNT_PRE','répéter') ;
define('_PICAL_RR_R_USECOUNT_SUF','fois') ;
define("_PICAL_RR_R_USEUNTIL","jusqu'à") ;


// Appended by Xoops Language Checker -GIJOE- in 2003-12-05 14:18:43
define('_PICAL_TH_SUBMITTER','Posteur');

// Appended by Xoops Language Checker -GIJOE- in 2003-12-26 10:55:16
define('_PICAL_STRFFMT_DATE_FOR_BLOCK','%d %b');
define('_PICAL_STRFFMT_TIME','%H:%M');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-14 18:31:01
define('_PICAL_FMT_YW','SEMAINE%2$s %1$s');
define('_PICAL_FMT_WEEKNO','SEMAINE %s');
define('_PICAL_ICON_LIST','vue liste');
define('_PICAL_MB_SHOWALLCAT','Toutes les catégories');
define('_PICAL_MB_ORDER_ASC','croissant');
define('_PICAL_MB_ORDER_DESC','décroissant');
define('_PICAL_MB_SORTBY','Trié par:');
define('_PICAL_MB_CURSORTEDBY','Evenements actuellement triés par:');
define('_PICAL_TH_CATEGORIES','Categories');
define('_PICAL_TH_LASTMODIFIED','Dernière modification');
define('_PICAL_BTN_PRINT','Imprimer');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-17 18:09:08
define('_PICAL_FMT_YMDO','%4$s%3$s%2$s%1$s');
define('_PICAL_MB_LABEL_CHECKEDITEMS','Les événements cochés sont:');
define('_PICAL_MB_LABEL_OUTPUTICS','Exporter dans iCalendar');
define('_PICAL_MB_ICALSELECTPLATFORM','Selectionner la plateforme');
define('_PICAL_MB_OP_AFTER','Après');
define('_PICAL_MB_OP_BEFORE','Avant');
define('_PICAL_MB_OP_ON','Sur');
define('_PICAL_MB_OP_ALL','Tout');
define('_PICAL_BTN_IMPORT','Importer!');
define('_PICAL_BTN_UPLOAD','Uploader!');
define('_PICAL_BTN_EXPORT','Exporter!');
define('_PICAL_BTN_EXTRACT','Extraire');
define('_PICAL_BTN_ADMIT','Accepter');
define('_PICAL_BTN_MOVE','Déplacer');
define('_PICAL_BTN_COPY','Copier');

}

?>
