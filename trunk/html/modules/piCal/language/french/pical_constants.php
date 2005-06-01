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

define('_PICAL_ICON_DAILY','Vue journali�re') ;
define('_PICAL_ICON_WEEKLY','Vue hebdomadaire') ;
define('_PICAL_ICON_MONTHLY','Vue mensuelle') ;
define('_PICAL_ICON_YEARLY','Vue annuelle') ;

define("_PICAL_MB_LINKTODAY","Aujourd'hui") ;
define('_PICAL_MB_NOSUBJECT','(Pas de Sujet)') ;

define('_PICAL_MB_PREV_DATE','Demain') ;
define('_PICAL_MB_NEXT_DATE','Hier') ;
define('_PICAL_MB_PREV_WEEK','Semaine pr�c�dente') ;
define('_PICAL_MB_NEXT_WEEK','Semaine suivante') ;
define('_PICAL_MB_PREV_MONTH','Mois pr�c�dent') ;
define('_PICAL_MB_NEXT_MONTH','Mois suivant') ;
define('_PICAL_MB_PREV_YEAR','Ann�e pr�c�dente') ;
define('_PICAL_MB_NEXT_YEAR','Ann�e suivante') ;

define("_PICAL_MB_NOEVENT","Pas d'�v�nements") ;
define('_PICAL_MB_ADDEVENT','Ajouter un �v�nement') ;
define('_PICAL_MB_CONTINUING','(continuer)') ;
define('_PICAL_MB_RESTEVENT_PRE','plus') ;
define('_PICAL_MB_RESTEVENT_SUF','�l�ment(s)') ;
define('_PICAL_MB_TIMESEPARATOR','--') ;

define('_PICAL_MB_ALLDAY_EVENT','Ev�nement journalier') ;
define('_PICAL_MB_LONG_EVENT','Montrer comme barre') ;
define('_PICAL_MB_LONG_SPECIALDAY','Anniversaire etc.') ;

define('_PICAL_MB_PUBLIC','Public') ;
define('_PICAL_MB_PRIVATE','Priv�') ;
define('_PICAL_MB_PRIVATETARGET',' parmi %s') ;

define("_PICAL_MB_LINK_TO_RRULE1ST","Sauter jusqu'au premier �v�nement ") ;
define("_PICAL_MB_RRULE1ST","C'est le premier �v�nement") ;

define('_PICAL_MB_EVENT_NOTREGISTER','Non enregistr�') ;
define('_PICAL_MB_EVENT_ADMITTED','Approuv�') ;
define("_PICAL_MB_EVENT_NEEDADMIT","Attente d'approbation") ;

define('_PICAL_MB_TITLE_EVENTINFO','Programmateur') ;
define('_PICAL_MB_SUBTITLE_EVENTDETAIL','Vue des d�tails') ;
define('_PICAL_MB_SUBTITLE_EVENTEDIT','Editer la vue') ;

define('_PICAL_MB_HOUR_SUF',':') ;
define('_PICAL_MB_MINUTE_SUF','') ;

define('_PICAL_TH_SUMMARY','R�sum�') ;
define('_PICAL_TH_STARTDATETIME','Heure de d�but') ;
define('_PICAL_TH_ENDDATETIME','Heure de fin') ;
define('_PICAL_TH_ALLDAYOPTIONS','Options journali�res') ;
define('_PICAL_TH_LOCATION','Endroit') ;
define('_PICAL_TH_CONTACT','Contact') ;
define('_PICAL_TH_CLASS','Classe') ;
define('_PICAL_TH_DESCRIPTION','Description') ;
define('_PICAL_TH_RRULE','P�riodicit�') ;
define('_PICAL_TH_ADMISSIONSTATUS','Statut') ;

define("_PICAL_NTC_MONTHLYBYMONTHDAY","(Num�ro d'entr�e)") ;
define('_PICAL_NTC_EXTRACTLIMIT','** Seulement %s �v�nements sont extraits en cas de maximum.') ;
define("_PICAL_NTC_NUMBEROFNEEDADMIT","(%s �l�ments n�cessitent l'approbation)") ;

define('_PICAL_OPT_PRIVATEMYSELF','seulement moi') ;
define('_PICAL_OPT_PRIVATEGROUP','groupe %s') ;
define('_PICAL_OPT_PRIVATEINVALID','(groupe invalide)') ;

define("_PICAL_CNFM_SAVEAS_YN","Etes vous d'accord pour sauver un autre enregistrement ?") ;
define("_PICAL_CNFM_DELETE_YN","Etes vous d'accord pour supprimer cette enregistrement ?") ;

define('_PICAL_ERR_INVALID_EVENT_ID','Erreur: EventID non trouv�') ;
define('_PICAL_ERR_NOPERM_TO_SHOW',"Erreur: Vous n'avez pas la permission de voir") ;
define('_PICAL_ERR_NOPERM_TO_OUTPUTICS',"Erreur: Vous n'avez pas la permission d'extraire iCalendar") ;
define("_PICAL_ERR_LACKINDISPITEM","L'�l�ment %s est vide.<br />Retournez en cliquant sur le bouton du browser") ;

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
define('_PICAL_RR_EVERYYEAR','Chaque ann�e') ;
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
define('_PICAL_RR_FREQYEARLY_SUF','ann�e(s)') ;
define('_PICAL_RR_PERDAY','tous les %s jours') ;
define('_PICAL_RR_PERWEEK','toutes les %s semaines') ;
define('_PICAL_RR_PERMONTH','tous les %s mois') ;
define('_PICAL_RR_PERYEAR','tous les %s ans') ;
define('_PICAL_RR_COUNT','<br />%s fois') ;
define("_PICAL_RR_UNTIL","<br />jusqu'� %s") ;
define('_PICAL_RR_R_NORRULE','Recurrence Non') ;
define('_PICAL_RR_R_YESRRULE','Recurrence Oui') ;
define('_PICAL_RR_OR','ou') ;
define('_PICAL_RR_S_NOTSELECTED','-non s�lectionn�-') ;
define('_PICAL_RR_S_SAMEASBDATE','Identique � la date de d�but') ;
define('_PICAL_RR_R_NOCOUNTUNTIL','Pas de conditions de fin') ;
define('_PICAL_RR_R_USECOUNT_PRE','r�p�ter') ;
define('_PICAL_RR_R_USECOUNT_SUF','fois') ;
define("_PICAL_RR_R_USEUNTIL","jusqu'�") ;


// Appended by Xoops Language Checker -GIJOE- in 2003-12-05 14:18:43
define('_PICAL_TH_SUBMITTER','Posteur');

// Appended by Xoops Language Checker -GIJOE- in 2003-12-26 10:55:16
define('_PICAL_STRFFMT_DATE_FOR_BLOCK','%d %b');
define('_PICAL_STRFFMT_TIME','%H:%M');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-14 18:31:01
define('_PICAL_FMT_YW','SEMAINE%2$s %1$s');
define('_PICAL_FMT_WEEKNO','SEMAINE %s');
define('_PICAL_ICON_LIST','vue liste');
define('_PICAL_MB_SHOWALLCAT','Toutes les cat�gories');
define('_PICAL_MB_ORDER_ASC','croissant');
define('_PICAL_MB_ORDER_DESC','d�croissant');
define('_PICAL_MB_SORTBY','Tri� par:');
define('_PICAL_MB_CURSORTEDBY','Evenements actuellement tri�s par:');
define('_PICAL_TH_CATEGORIES','Categories');
define('_PICAL_TH_LASTMODIFIED','Derni�re modification');
define('_PICAL_BTN_PRINT','Imprimer');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-17 18:09:08
define('_PICAL_FMT_YMDO','%4$s%3$s%2$s%1$s');
define('_PICAL_MB_LABEL_CHECKEDITEMS','Les �v�nements coch�s sont:');
define('_PICAL_MB_LABEL_OUTPUTICS','Exporter dans iCalendar');
define('_PICAL_MB_ICALSELECTPLATFORM','Selectionner la plateforme');
define('_PICAL_MB_OP_AFTER','Apr�s');
define('_PICAL_MB_OP_BEFORE','Avant');
define('_PICAL_MB_OP_ON','Sur');
define('_PICAL_MB_OP_ALL','Tout');
define('_PICAL_BTN_IMPORT','Importer!');
define('_PICAL_BTN_UPLOAD','Uploader!');
define('_PICAL_BTN_EXPORT','Exporter!');
define('_PICAL_BTN_EXTRACT','Extraire');
define('_PICAL_BTN_ADMIT','Accepter');
define('_PICAL_BTN_MOVE','D�placer');
define('_PICAL_BTN_COPY','Copier');

}

?>
