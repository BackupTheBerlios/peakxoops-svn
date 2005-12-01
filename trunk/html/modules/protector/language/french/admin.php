<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */

// index.php
define("_AM_TH_DATETIME","Donn&eacute;es");
define("_AM_TH_USER","Utilisateur");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Type");
define("_AM_TH_DESCRIPTION","Description");

define( "_AM_TH_BADIPS","Liste des IP bannies" ) ;
define( "_AM_TH_ENABLEIPBANS","Activer le bannissement bas&eacute; sur l'adresse IP ?" ) ;

define("_AM_LABEL_REMOVE","Supprimer les enregistrements analys&eacute;s");
define("_AM_BUTTON_REMOVE","Effacer!");
define("_AM_JS_REMOVECONFIRM","Etes vous certains de vouloir supprimer les objets s&eacute;l&eacute;ctionn&eacute;s?");
define( "_AM_MSG_PRUPDATED","Les modifications ont &eacute;t&eacute; sauvegard&eacute;es avec succ&egrave;s." ) ;
define("_AM_MSG_REMOVED","Les enregistrements ont &eacute;t&eacute; effac&eacute;s correctement.");


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Gestionnaire de pr&eacute;fix" ) ;
define( "_AM_MSG_DBUPDATED" , "Base de donn&eacute;e mise &agrave; jour avec succ&egrave;s!" ) ;
define( "_AM_CONFIRM_DELETE" , "Toutes les donn&eacute;es seront effac&eacute;es. OK?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Pour modifier le pr&eacute;fix,<br /> Editer %s/mainfile.php &agrave; la main.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","PEU SUR");

define("_AM_ADV_REGISTERGLOBALS","Cette configuration permet une vari&eacute;t&eacute; d'attaques par injection.<br />Si vous pouvez, ajoutez un fichier .htaccess avec la ligne suivante : ");
define("_AM_ADV_ALLOWURLFOPEN","Cette configuration permet l'execution de scripts malveillants depuis des serveurs distants.<br />Seuls les administrateurs peuvent modifier cette option.<br />Si vous &ecirc;tes un admin, &eacute;ditez le fichier php.ini ou httpd.conf.<br /><b>Example de httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />A d&eacute;faut, demandez &agrave; votre administrateur.");
define('_AM_ADV_USETRANSSID','Votre session ID sera affich&eacute;e avec des tags-balise, etc.<br />Pour pr&eacute;venir de toute attaque par session hi-jacking, ajoutez la ligne suivante dans un fichier .htaccess dans XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');
define("_AM_ADV_DBPREFIX","Le pr&eacute;fixe de la base de donn&eacute;es est \"xoops\", ce qui le rend vuln&eacute;rable &agrave; une attaque par SQL injection.<br />N'oubliez pas oublier d'activer \"Sanitisation forc&eacute;e*\" et \"Commentaires isol&eacute;s\" dans les pr&eacute;f&eacute;rences du module.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Aller au gestionnaire de pr&eacute;fixes");
define("_AM_ADV_MAINUNPATCHED","Vous devez &eacute;diter le fichier mainfile.php comme indiqu&eacute; dans le fichier Readme");
define("_AM_ADV_RESCUEPASSWORD","Mot de passe de restauration");
define("_AM_ADV_RESCUEPASSWORDUNSET","Non D&eacute;fini !! (bannissement d'IP non op&eacute;rationnel).");
define("_AM_ADV_RESCUEPASSWORDSHORT","Trop court.Utilisez des mots de passe d'un minimum de 6 caract&egrave;res.");

define("_AM_ADV_SUBTITLECHECK","Contr&ocirc;le du correct fonctionnement de Protector");
define("_AM_ADV_AT1STSETPASSWORD","Au d&eacute;but, vous devez d&eacute;finir un mot de passe de secours");
define("_AM_ADV_CHECKCONTAMI","Attaques par contamination");
define("_AM_ADV_CHECKISOCOM","Commentaires isol&eacute;s");
?>