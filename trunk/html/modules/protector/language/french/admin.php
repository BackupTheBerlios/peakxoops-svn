<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:34:09
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Données");
define("_AM_TH_USER","utilisateur");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Type");
define("_AM_TH_DESCRIPTION","Description");

define( "_AM_TH_BADIPS","Liste des IPs bannies" ) ;
define( "_AM_TH_ENABLEIPBANS","Activer le bannissement dépendant de l'IP" ) ;

define("_AM_LABEL_REMOVE","");
define("_AM_BUTTON_REMOVE","Effacer");
define("_AM_JS_REMOVECONFIRM","Etes vous certains de vouloir supprimer les objets séléctionnés?");
define( "_AM_MSG_PRUPDATED","Les modifications ont été sauvegardés avec succès." ) ;
define("_AM_MSG_REMOVED","Les objets choisis ont été effacés correctement.");


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Gestionnaire de préfix" ) ;
define( "_AM_MSG_DBUPDATED" , "Base de donnée mise à jour avec succé!" ) ;
define( "_AM_CONFIRM_DELETE" , "Effacer toutes les données?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Editer %s/mainfile.php à la main.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","PEU SÛR");

define("_AM_ADV_REGISTERGLOBALS","Cette configuration permet une variété d'attaques par injection.");
define("_AM_ADV_ALLOWURLFOPEN","Cette configuration permet l'execution de scripts malveillants à distance.");
define("_AM_ADV_DBPREFIX","Le préfixe de sa banque de données est \"xoops\", ce qui le rend vulnérable à SQL injection.<br />Ne pas oublier d'activer \"Sanitisation forcée dans le cas de commentaire isolé \" et les protections dans les préférences de ce module.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Aller au gestionnaire de préfix");
define("_AM_ADV_MAINUNPATCHED","Quand appelée dans mainfile.php, la protection fournie par Xoops Protector est augmentée.<br />Lire le fichier readme pour installer la protection dans mainphile.php");
define("_AM_ADV_RESCUEPASSWORD","Mot de passe de restauration");
define("_AM_ADV_RESCUEPASSWORDUNSET","Indéfini.");
define("_AM_ADV_RESCUEPASSWORDSHORT","Si possible, utilisez des mots de passe plus grands que 6 caractères.");

define("_AM_ADV_SUBTITLECHECK","Contrôle des actions de Protector");
define("_AM_ADV_AT1STSETPASSWORD","Au début, vous devez placer un mot de passe pour délivrance");
define("_AM_ADV_CHECKCONTAMI","Attaques par contamination");
define("_AM_ADV_CHECKISOCOM","Commentaires isolés");
?>