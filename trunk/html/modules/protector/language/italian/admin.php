<?php

// index.php


// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_AM_ADV_USETRANSSID','Il tuo ID sesssione verrà mostrato nei tag di ancoraggio, ecc.<br />Al fine di prevenire l\'hi-jacking della sessione, aggiungere una linea nel file .htaccess contenuto nella XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

// Appended by Xoops Language Checker -GIJOE- in 2005-01-21 11:35:16
define('_AM_H3_PREFIXMAN','Gestione Prefissi');
define('_AM_MSG_DBUPDATED','Database aggiornato correttamente!');
define('_AM_CONFIRM_DELETE','Tutti i data verranno scartati. OK?');
define('_AM_TXT_HOWTOCHANGEDB','Se vuoi cambiare prefisso,<br /> modificare %s/mainfile.php manualmente.<br /><br />define(\'XOOPS_DB_PREFIX\', \'<b>%s</b>\');');
define('_AM_ADV_LINK_TO_PREFIXMAN','Vai a Gestione Prefissi');

define("_AM_TH_DATETIME","Ora");
define("_AM_TH_USER","Utente");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENTE");
define("_AM_TH_TYPE","Tipo");
define("_AM_TH_DESCRIPTION","Descrizione");

define( "_AM_TH_BADIPS" , "Lista Bad IP" ) ;
define( "_AM_TH_ENABLEIPBANS" , "Abilitare il ban degli IP?" ) ;

define( "_AM_LABEL_REMOVE" , "Rimuovi i record selezionati:" ) ;
define( "_AM_BUTTON_REMOVE" , "Rimuovi!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Rimuovere, OK?" ) ;
define( "_AM_MSG_PRUPDATED" , "Preferenze aggiornate correttamente!" ) ;
define( "_AM_MSG_REMOVED" , "I record sono stati rimossi" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Non sicuro");

define("_AM_ADV_REGISTERGLOBALS","Questa impostazione permette una gran varietà di attacchi ad iniezione.");
define("_AM_ADV_ALLOWURLFOPEN","Questa impostazione permette agli attacanti di eseguire script arbitrari su macchine remote.");
define("_AM_ADV_DBPREFIX","Questa impostazione permette 'SQL Injections'.<br />Non dimenticare di attivare 'Forzare sterilizzazione *' tra le Preferenze del modulo.");
define("_AM_ADV_MAINUNPATCHED","Xoops Protector può proteggere il tuo sito entro certi limiti finchè viene chiamato dal mainfile.php.<br />E' opportuno modificare il mainfile.php come scritto nel file README.");
define("_AM_ADV_RESCUEPASSWORD","Password per il recupero");
define("_AM_ADV_RESCUEPASSWORDUNSET","Non impostata");
define("_AM_ADV_RESCUEPASSWORDSHORT","Troppo corta (min 6 caratteri)");

define("_AM_ADV_SUBTITLECHECK","Controllare se Protector funziona correttamente");
define("_AM_ADV_AT1STSETPASSWORD","Innanzitutto, è opportuno impostare una password di recupero");
define("_AM_ADV_CHECKCONTAMI","Contaminazioni");
define("_AM_ADV_CHECKISOCOM","Commenti isolati");



?>
