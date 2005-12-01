<?php

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:39
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Aika");
define("_AM_TH_USER","KçÚttçËä");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","SELAIN");
define("_AM_TH_TYPE","Tyyppi");
define("_AM_TH_DESCRIPTION","Kuvaus");
define("_AM_TH_BADIPS", "Pahat IP't") ;
define("_AM_TH_ENABLEIPBANS", "KçÚtä IP estoa?") ;
define("_AM_LABEL_REMOVE", "Poista valitut tiedot: ") ;
define("_AM_BUTTON_REMOVE", "Poista!") ;
define("_AM_JS_REMOVECONFIRM", "Oletko Varma?") ;
define("_AM_MSG_PRUPDATED", "Asetukset on pçÊvitetty!") ;
define("_AM_MSG_REMOVED", "Tiedot on poistettu!") ;

// prefix_manager.php
define("_AM_H3_PREFIXMAN", "Taulukon Hallinta") ;
define("_AM_MSG_DBUPDATED", "Tietokanta pçÊvitetty onnistuneesti!") ;
define("_AM_CONFIRM_DELETE", "Kaikki tiedot poistetaan. OK?") ;
define("_AM_TXT_HOWTOCHANGEDB", "Jos haluat vaihtaa taulukon nimeä,<br /> muokkaa %s/mainfile.php kçÔin.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');") ;
define("_AM_H4_PREFIXMAN", "Nimike") ;
define("_AM_H5_PREFIXMAN", "Taulukkoja") ;
define("_AM_H6_PREFIXMAN", "PçÊvitetty") ;
define("_AM_H7_PREFIXMAN", "Kopioi") ;
define("_AM_H8_PREFIXMAN", "Poista") ;

// advisory.php
define("_AM_ADV_NOTSECURE","Ei turvallinen");
define("_AM_ON", "pèællä") ;
define("_AM_OFF", "ei pèællä") ;
define("_AM_PATCHED", "pçÊvitetty") ;
define("_AM_UNPATCHED", "ei pç×itetty");
define("_AM_MISSPOST", "kaipaa postcheck");
define("_AM_INSUFF", "ei riittç×ä");
define("_AM_ADV_REGISTERGLOBALS","TçÎä asetus kutsuu monta erilaista hy‹ÌkçÚstä.<br />Jos voit laittaa .htaccess, muokkaa tai poista...");
define("_AM_ADV_ALLOWURLFOPEN","TçÎä asetus sallii hy‹Ìkèæjien suoritta vahingollisia skriptejä ulkoisilta palvalimilta.<br />Ainoastaan yllçÑitçËä voi muuttaa tçÎçÏ asetuksen.<br />Jos olet yllçÑitçËä, muokkaa php.ini tai httpd.conf.<br /><b>Esimerkki httpd.conf tiedostosta:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Muussa tapauksessa, ota yhteyttä yllçÑitçËèæsi.");
define("_AM_ADV_DBPREFIX","TçÎä asetus kutsuu 'SQL Injections'.<br />ŽÄlä unohda laittaa pèælle 'Pakota puhdistus *' tçÎçÏ moduulin asetuksissa.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Mene taulukon hallintaan");
define("_AM_ADV_MAINUNPATCHED","Xoops Suoja voi suojata sivustosi hallituissa olosuhteissa niin kauan kun sitä kutsutaan tiedostosta mainfile.php.<br />Sinun pitèæ muokata mainfile.php tiedosto niin kun README tiedosto suosittelee.");
define("_AM_ADV_RESCUEPASSWORD","Pelastuksen salasana");
define("_AM_ADV_RESCUEPASSWORDUNSET","Ei asetettu");
define("_AM_ADV_RESCUEPASSWORDSHORT","Liian lyhyt (vçÉintèæn 6 merkkiä)");
define("_AM_ADV_SUBTITLECHECK","Tarkista että Suoja toimii hyvin");
define("_AM_ADV_AT1STSETPASSWORD","EnsimmçÊseksi, sinun pitèæ laittaa salasana pelastukseen");
define("_AM_ADV_CHECKCONTAMI","Saastutuksia");
define("_AM_ADV_CHECKISOCOM","YksittçÊset Kommentit");

?>