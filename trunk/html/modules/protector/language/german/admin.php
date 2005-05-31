<?php

// index.php
define("_AM_TH_DATETIME","Zeit");
define("_AM_TH_USER","Benutzer");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","Client");
define("_AM_TH_TYPE","Typ");
define("_AM_TH_DESCRIPTION","Beschreibung");

define( "_AM_TH_BADIPS" , "\"Schlechte\" IPs" ) ;
define( "_AM_TH_ENABLEIPBANS" , "IP-Sperre aktivieren?" ) ;

define( "_AM_LABEL_REMOVE" , "Markierte Eintr�ge l�schen:" ) ;
define( "_AM_BUTTON_REMOVE" , "Entfernen!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Entfernen OK?" ) ;
define( "_AM_MSG_PRUPDATED" , "Einstellungen erfolgreich aktualisiert!" ) ;
define( "_AM_MSG_REMOVED" , "Eintr�ge wurden entfernnt." ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Prefix Manager" ) ;
define( "_AM_MSG_DBUPDATED" , "Datenbank wurde erfolgreich aktualisiert!" ) ;
define( "_AM_CONFIRM_DELETE" , "Alle Daten werden gel�scht. OK?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Wenn Sie den Pr�fix �ndern wollen,<br /> bearbeiten Sie %s/mainfile.php manuell.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Nicht sicher");

define("_AM_ADV_REGISTERGLOBALS","Diese Einstellung l�dt zu verschiedenen Formen der Code Injection ein.<br />Wenn es geht, setzen Sie eine .htaccess-Datei.");
define("_AM_ADV_ALLOWURLFOPEN","Diese Einstellung erlaubt Angreifern, willk�rlich Scripts auf entfernten Sytemen auszuf�hren.<br />Nur der Administrator des Servers kann diese Option �ndern.<br />Wenn Sie Admin sind, bearbeiten Sie php.ini or httpd.conf entsprechend.<br /><b>Beispiel f�r httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Wenn nicht, wenden Sie sich an Ihren Administrator.");
define("_AM_ADV_DBPREFIX","Diese Einstellung l�dt zu 'SQL Injections' ein.<br />Vergessen Sie nicht 'Force sanitizing *' in den Voreinstellungen dieses Moduls zu aktivieren.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Zum Pr�fix-Manager");
define("_AM_ADV_MAINUNPATCHED","Xoops Protector kann ihre Seite unter bestimmten Umst�nden sch�tzen, wenn es aus der mainfile.php aufgerufen wird.<br />Sie sollten diese Datei wie im README beschrieben �ndern.");
define("_AM_ADV_RESCUEPASSWORD","Notfall-Passwort");
define("_AM_ADV_RESCUEPASSWORDUNSET","L�schen");
define("_AM_ADV_RESCUEPASSWORDSHORT","Passwort zu kurz (min 6 Zeichen)");

define("_AM_ADV_SUBTITLECHECK","�berpr�fen, ob Protector funktioniert");
define("_AM_ADV_AT1STSETPASSWORD","Zuerst m�ssen Sie ein Notfall-Passwort angeben.");
define("_AM_ADV_CHECKCONTAMI","Verseuchung");
define("_AM_ADV_CHECKISOCOM","Isolierte Kommentare");



?>
