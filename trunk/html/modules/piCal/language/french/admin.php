<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'PICAL_AM_LOADED' ) ) {





// Appended by Xoops Language Checker -GIJOE- in 2005-06-29 17:19:31
define('_AM_PI_TH_OPTIONS','Options (usually blank)');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-24 19:05:04
define('_AM_TZOPT_SERVER','As server timezone');
define('_AM_TZOPT_GMT','As GMT');
define('_AM_TZOPT_USER','As user\'s timezone');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-06 18:03:59
define('_AM_FMT_SERVER_TZ_ALL','Timezone of the server (winter): %+2.1f<br />Timezone of the server (summer): %+2.1f<br />Zonename of the server: %s<br />The value of XOOPS config: %+2.1f<br />The value of piCal using: %+2.1f<br />');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-03 05:31:12
define('_AM_FMT_SERVER_TZ_SYSTEM','Timezone in winter: %+2.1f');
define('_AM_TH_SERVER_TZ_COUNT','Events');
define('_AM_TH_SERVER_TZ_VALUE','Timezone');
define('_AM_TH_SERVER_TZ_VALUE_TO','Changes (-14.0¡Á14.0)');
define('_AM_JSALRT_SERVER_TZ','Don\'t forget backing-up events table before this operation');
define('_AM_NOTICE_SERVER_TZ','If your server set the timezone area with summer time (=Day Light Saving) and some events were registerd in piCal 0.6x or 0.7x, dont\'t push this button.<br />eg) It is natural to display both -5.0 and -4.0 in EDT');
define('_AM_MB_SUCCESSTZUPDATE','Events are modified with the timezone(s).');
define('_AM_PI_UPDATED','Plugins are updated');
define('_AM_PI_TH_TYPE','Type');
define('_AM_PI_TH_TITLE','Title');
define('_AM_PI_TH_DIRNAME','Module\'s dirname');
define('_AM_PI_TH_FILE','Plugin file');
define('_AM_PI_TH_DOTGIF','Dot GIF');
define('_AM_PI_TH_OPERATION','Operation');
define('_AM_PI_ENABLED','Enabled');
define('_AM_PI_DELETE','Delete');
define('_AM_PI_NEW','New');
define('_AM_PI_VIEWYEARLY','Yearly View');
define('_AM_PI_VIEWMONTHLY','Monthly View');
define('_AM_PI_VIEWWEEKLY','Weekly View');
define('_AM_PI_VIEWDAILY','Daily View');

define( 'PICAL_AM_LOADED' , 1 ) ;


// titles

// Appended by Xoops Language Checker -GIJOE- in 2004-06-22 18:39:02
define('_AM_OPT_PAST','Past');
define('_AM_OPT_FUTURE','Future');
define('_AM_OPT_PASTANDFUTURE','Past&Future');

define("_AM_CONFIG","Menu de configuration de Pical");
define("_AM_GENERALCONF","Réglages généraux de piCal");
define("_AM_ADMISSION","Evènements approuvés");
define("_AM_MENU_EVENTS","Gestionnaire d'évènements");
define("_AM_MENU_CATEGORIES","Gestionnaire de catégories");
define("_AM_MENU_CAT2GROUP","Permissions des catégories");
define("_AM_ICALENDAR_IMPORT","Importer iCalendar");
define("_AM_GROUPPERM","Permissions Globlales");
define("_AM_TABLEMAINTAIN","Maintenance des tables (Mise à jour)");
define("_AM_MYBLOCKSADMIN","Admin des block et groupes de piCal");

// forms
define("_AM_BUTTON_EXTRACT","Extraire");
define("_AM_BUTTON_ADMIT","Accepter");
define("_AM_BUTTON_MOVE","Deplacer");
define("_AM_BUTTON_COPY","Copier");
define("_AM_CONFIRM_DELETE","Supprimer le(s) évenement(s) OK?");
define("_AM_CONFIRM_MOVE","Retirer le lien de l'ancienne catégorie et ajouter un lien dans la catégorie spécifiée OK?");
define("_AM_CONFIRM_COPY","Ajouter un lien dans la catégorie spécifiée OK?");

// format
define("_AM_DTFMT_LIST_ALLDAY",'y-m-d');
define("_AM_DTFMT_LIST_NORMAL",'y-m-d<\b\r />H:i');

// admission
define("_AM_LABEL_ADMIT","Les évènements vérifiés sont : à approuver ");
define("_AM_MES_ADMITTED","Evènement(s) a été approuvé");
define("_AM_ADMIT_TH0","Utilisateur");
define("_AM_ADMIT_TH1","Heure de début");
define("_AM_ADMIT_TH2","Heure de fin");
define("_AM_ADMIT_TH3","Titre");
define("_AM_ADMIT_TH4","Périodicité");

// events manager & importing iCalendar

define("_AM_LABEL_IMPORTFROMWEB","Importer les données d'iCalendar du web (Rentrer l'URL commeçant par 'http://' ou 'webcal://')");
define("_AM_LABEL_UPLOADFROMFILE","Télécharger les données d'iCalendar (Selectionner un fichier en local sur votre machine)");
define("_AM_LABEL_IO_CHECKEDITEMS","Les évènements vérifiés sont : ");
define("_AM_LABEL_IO_OUTPUT"," à exporter dans iCalendar");
define("_AM_LABEL_IO_DELETE"," à supprimer");
define("_AM_MES_EVENTLINKTOCAT","evenement(s) ont été lié(s) à cette catégorie");
define("_AM_MES_EVENTUNLINKED","evenement(s) ont eu leur(s) lien(s) supprimé de l'ancienne catégorie");
define("_AM_FMT_IMPORTED","evenement(s) ont été importé(s) depuis '%s'");
define("_AM_MES_DELETED","evenement(s) ont été supprimé(s)");
define("_AM_IO_TH0","Utilisateur");
define("_AM_IO_TH1","Date et heure de début");
define("_AM_IO_TH2","Date et heure de fin");
define("_AM_IO_TH3","Titre");
define("_AM_IO_TH4","Règles");
define("_AM_IO_TH5","Admission");

// Group's Permissions
define( '_AM_GPERM_G_INSERTABLE' , "peut ajouter" ) ;
define( '_AM_GPERM_G_SUPERINSERT' , "super ajout" ) ;
define( '_AM_GPERM_G_EDITABLE' , "peut editer" ) ;
define( '_AM_GPERM_G_SUPEREDIT' , "super edition" ) ;
define( '_AM_GPERM_G_DELETABLE' , "peut supprimer" ) ;
define( '_AM_GPERM_G_SUPERDELETE' , "super suppression" ) ;
define( '_AM_GPERM_G_TOUCHOTHERS' , "peut toucher les autres" ) ;
define( '_AM_CAT2GROUPDESC' , "Cochez les catégories auxquelles vous pouvez accéder" ) ;
define( '_AM_GROUPPERMDESC' , "Sélectionner les actions que tous les groupes sont autorisés à faire<br/>Si vous avez besoin de ce dispositif, rentrez les 'Autorités des utilisateurs' à Spécifier dans les permissions des groupes en premier.<br />Les réglages des groupes administrateurs et invités seront ignorés." ) ;

// Table Maintenance
define( '_AM_MB_SUCCESSUPDATETABLE' , "La mise à jour de la(des) table(s) a reussie" ) ;
define( '_AM_MB_FAILUPDATETABLE' , "La mise à jour de la(des) table(s) a échoué" ) ;
define( '_AM_NOTICE_NOERRORS' , "Il n'y a pas d'erreur avec les tables et les enregistrements." ) ;
define( '_AM_ALRT_CATTABLENOTEXIST' , "La table catégories n'existe pas.<br />\nVoulez-vous créer cette table ?" ) ;
define( '_AM_ALRT_OLDTABLE' , "La structure de la table èvenements est ancienne.<br />\nVoulez-vous mettre à jour la table ?" ) ;
define( '_AM_ALRT_TOOOLDTABLE' , "La table retourne une erreur.<br />\nPeut-être utilisiez vous piCal 0.3x ou précédent.<br />\nPremièrement, Mettez à jour vers 0.4x or 0.5x." ) ;
define( '_AM_FMT_WRONGSTZ' , "Il y a %s evenement(s) qui sont enregistré(s) avec une mauvaise zone horaire.<br />Voulez-vous les réparer ?" ) ;

// Categories
define( '_AM_CAT_TH_TITLE' , 'Titre' ) ;
define( '_AM_CAT_TH_DESC' , 'Description' ) ;
define( '_AM_CAT_TH_PARENT' , 'Catégorie parente' ) ;
define( '_AM_CAT_TH_OPTIONS' , 'Options' ) ;
define( '_AM_CAT_TH_LASTMODIFY' , 'Derniere modification' ) ;
define( '_AM_CAT_TH_OPERATION' , 'Operation' ) ;
define( '_AM_CAT_TH_ENABLED' , 'permettre' ) ;
define( '_AM_CAT_TH_WEIGHT' , 'Poids' ) ;
define( '_AM_CAT_TH_SUBMENU' , 'Enregistrer dans un sous-menu' ) ;
define( '_AM_BTN_UPDATE' , 'Mise à jour' ) ;
define( '_AM_MENU_CAT_EDIT' , 'Editer une Categorie' ) ;
define( '_AM_MENU_CAT_NEW' , 'Creer une nouvelle Categorie' ) ;
define( '_AM_MB_MAKESUBCAT' , 'Sous-categorie' ) ;
define( '_AM_MB_MAKETOPCAT' , 'Créer une catégorie dans un niveau supérieur' ) ;
define( '_AM_MB_CAT_INSERTED' , 'Nouvelle catégorie créée' ) ;
define( '_AM_MB_CAT_UPDATED' , 'Catégorie mise à jour' ) ;
define( '_AM_FMT_CAT_DELETED' , '%s Categories supprimés' ) ;
define( '_AM_FMT_CAT_BATCHUPDATED' , '%s Categories mises à jour' ) ;
define( '_AM_FMT_CATDELCONFIRM' , 'Voulez vous suprimer ces catégories ?' ) ;



}

?>
