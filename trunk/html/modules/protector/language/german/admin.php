<?php

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Zeit");
define("_AM_TH_USER","Benutzer");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","Client");
define("_AM_TH_TYPE","Typ");
define("_AM_TH_DESCRIPTION","Beschreibung");

define( "_AM_TH_BADIPS" , "\"Schlechte\" IPs" ) ;
define( "_AM_TH_ENABLEIPBANS" , "IP-Sperre aktivieren?" ) ;

define( "_AM_LABEL_REMOVE" , "Markierte EintrçÈe l‹Ôchen:" ) ;
define( "_AM_BUTTON_REMOVE" , "Entfernen!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Entfernen OK?" ) ;
define( "_AM_MSG_PRUPDATED" , "Einstellungen erfolgreich aktualisiert!" ) ;
define( "_AM_MSG_REMOVED" , "EintrçÈe wurden entfernnt." ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Prefix Manager" ) ;
define( "_AM_MSG_DBUPDATED" , "Datenbank wurde erfolgreich aktualisiert!" ) ;
define( "_AM_CONFIRM_DELETE" , "Alle Daten werden gel‹Ôcht. OK?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Wenn Sie den PrçÇix çÏdern wollen,<br /> bearbeiten Sie %s/mainfile.php manuell.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Nicht sicher");

define("_AM_ADV_REGISTERGLOBALS","Diese Einstellung lçÅt zu verschiedenen Formen der Code Injection ein.<br />Wenn es geht, setzen Sie eine .htaccess-Datei.");
define("_AM_ADV_ALLOWURLFOPEN","Diese Einstellung erlaubt Angreifern, willk—Ólich Scripts auf entfernten Sytemen auszuf—Éren.<br />Nur der Administrator des Servers kann diese Option çÏdern.<br />Wenn Sie Admin sind, bearbeiten Sie php.ini or httpd.conf entsprechend.<br /><b>Beispiel f—Ó httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Wenn nicht, wenden Sie sich an Ihren Administrator.");
define("_AM_ADV_DBPREFIX","Diese Einstellung lçÅt zu 'SQL Injections' ein.<br />Vergessen Sie nicht 'Force sanitizing *' in den Voreinstellungen dieses Moduls zu aktivieren.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Zum PrçÇix-Manager");
define("_AM_ADV_MAINUNPATCHED","Xoops Protector kann ihre Seite unter bestimmten UmstçÏden sch—Õzen, wenn es aus der mainfile.php aufgerufen wird.<br />Sie sollten diese Datei wie im README beschrieben çÏdern.");
define("_AM_ADV_RESCUEPASSWORD","Notfall-Passwort");
define("_AM_ADV_RESCUEPASSWORDUNSET","L‹Ôchen");
define("_AM_ADV_RESCUEPASSWORDSHORT","Passwort zu kurz (min 6 Zeichen)");

define("_AM_ADV_SUBTITLECHECK","ŽÜberpr—Çen, ob Protector funktioniert");
define("_AM_ADV_AT1STSETPASSWORD","Zuerst m—Ôsen Sie ein Notfall-Passwort angeben.");
define("_AM_ADV_CHECKCONTAMI","Verseuchung");
define("_AM_ADV_CHECKISOCOM","Isolierte Kommentare");



?>
