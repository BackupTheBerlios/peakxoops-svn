<?php

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:37
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Tijd");
define("_AM_TH_USER","Gebruiker");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Type");
define("_AM_TH_DESCRIPTION","Omschrijving");

define( "_AM_TH_BADIPS" , "Slechte IPs" ) ;
define( "_AM_TH_ENABLEIPBANS" , "IP verbanning inschakelen?" ) ;

define( "_AM_LABEL_REMOVE" , "Verwijder de geselecteerde items:" ) ;
define( "_AM_BUTTON_REMOVE" , "Verwijder!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Weet u zeker dat u deze item(s) wilt verwijderen?" ) ;
define( "_AM_MSG_PRUPDATED" , "Voorkeuren met succes geüpdate!" ) ;
define( "_AM_MSG_REMOVED" , "Items zijn verwijderd" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Prefix Manager" ) ;
define( "_AM_MSG_DBUPDATED" , "Database met succes bijgewerkt!" ) ;
define( "_AM_CONFIRM_DELETE" , "Weet u zeker dat u alle gegevens wilt wissen?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Als u de prefix wilt wijzigen,<br /> pas dan %s/mainfile.php met de hand aan.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Niet veilig");

define("_AM_ADV_REGISTERGLOBALS","Deze instelling lokt een scale aan injectie aanvallen uit.<br />Als je een .htacces bestand aan kan maken of wijzigen is dat aan te bevelen...");
define("_AM_ADV_ALLOWURLFOPEN","Deze instelling stelt hackers in staat willekeurige scripts uit te voeren op andere servers.<br />Alleen de webserver beheerder kan deze optie wijzigen.<br />Als u de beheerder bent, pas dan php.ini of httpd.conf aan.<br /><b>Voorbeeld van een httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Anders kunt u het het beste bij uw beheerder melden.");
define("_AM_ADV_DBPREFIX","Deze instelling werkt SQL Injecties in de hand.<br />Vergeet niet 'Forceer opschonen *' aan te zetten in de voorkeuren van deze module.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Ga naar prefix manager");
define("_AM_ADV_MAINUNPATCHED","Xoops Protector kan uw site alleen beperkt beschermen tenzij het aangeroepen wordt vanuit mainfile.php.<br />Aan te raden is mainfile.php aan te passen zoals in README beschreven.");
define("_AM_ADV_RESCUEPASSWORD","Reddingswachtwoord");
define("_AM_ADV_RESCUEPASSWORDUNSET","Niet ingesteld");
define("_AM_ADV_RESCUEPASSWORDSHORT","Te kort (min 6 karakters)");

define("_AM_ADV_SUBTITLECHECK","Controleer of Protector goed werkt");
define("_AM_ADV_AT1STSETPASSWORD","Eerst dient u een reddingswachtwoord in te stellen");
define("_AM_ADV_CHECKCONTAMI","Vervuilingen");
define("_AM_ADV_CHECKISOCOM","Enkel commentaarteken");



?>