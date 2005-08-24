<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:34:09
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Donn�es");
define("_AM_TH_USER","utilisateur");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Type");
define("_AM_TH_DESCRIPTION","Description");

define( "_AM_TH_BADIPS","Liste des IPs bannies" ) ;
define( "_AM_TH_ENABLEIPBANS","Activer le bannissement d�pendant de l'IP" ) ;

define("_AM_LABEL_REMOVE","");
define("_AM_BUTTON_REMOVE","Effacer");
define("_AM_JS_REMOVECONFIRM","Etes vous certains de vouloir supprimer les objets s�l�ctionn�s?");
define( "_AM_MSG_PRUPDATED","Les modifications ont �t� sauvegard�s avec succ�s." ) ;
define("_AM_MSG_REMOVED","Les objets choisis ont �t� effac�s correctement.");


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Gestionnaire de pr�fix" ) ;
define( "_AM_MSG_DBUPDATED" , "Base de donn�e mise � jour avec succ�!" ) ;
define( "_AM_CONFIRM_DELETE" , "Effacer toutes les donn�es?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Editer %s/mainfile.php � la main.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","PEU S�R");

define("_AM_ADV_REGISTERGLOBALS","Cette configuration permet une vari�t� d'attaques par injection.");
define("_AM_ADV_ALLOWURLFOPEN","Cette configuration permet l'execution de scripts malveillants � distance.");
define("_AM_ADV_DBPREFIX","Le pr�fixe de sa banque de donn�es est \"xoops\", ce qui le rend vuln�rable � SQL injection.<br />Ne pas oublier d'activer \"Sanitisation forc�e dans le cas de commentaire isol� \" et les protections dans les pr�f�rences de ce module.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Aller au gestionnaire de pr�fix");
define("_AM_ADV_MAINUNPATCHED","Quand appel�e dans mainfile.php, la protection fournie par Xoops Protector est augment�e.<br />Lire le fichier readme pour installer la protection dans mainphile.php");
define("_AM_ADV_RESCUEPASSWORD","Mot de passe de restauration");
define("_AM_ADV_RESCUEPASSWORDUNSET","Ind�fini.");
define("_AM_ADV_RESCUEPASSWORDSHORT","Si possible, utilisez des mots de passe plus grands que 6 caract�res.");

define("_AM_ADV_SUBTITLECHECK","Contr�le des actions de Protector");
define("_AM_ADV_AT1STSETPASSWORD","Au d�but, vous devez placer un mot de passe pour d�livrance");
define("_AM_ADV_CHECKCONTAMI","Attaques par contamination");
define("_AM_ADV_CHECKISOCOM","Commentaires isol�s");
?>