<?php

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:39
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Aika");
define("_AM_TH_USER","Käyttäjä");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","SELAIN");
define("_AM_TH_TYPE","Tyyppi");
define("_AM_TH_DESCRIPTION","Kuvaus");
define("_AM_TH_BADIPS", "Pahat IP't") ;
define("_AM_TH_ENABLEIPBANS", "Käytä IP estoa?") ;
define("_AM_LABEL_REMOVE", "Poista valitut tiedot: ") ;
define("_AM_BUTTON_REMOVE", "Poista!") ;
define("_AM_JS_REMOVECONFIRM", "Oletko Varma?") ;
define("_AM_MSG_PRUPDATED", "Asetukset on päivitetty!") ;
define("_AM_MSG_REMOVED", "Tiedot on poistettu!") ;

// prefix_manager.php
define("_AM_H3_PREFIXMAN", "Taulukon Hallinta") ;
define("_AM_MSG_DBUPDATED", "Tietokanta päivitetty onnistuneesti!") ;
define("_AM_CONFIRM_DELETE", "Kaikki tiedot poistetaan. OK?") ;
define("_AM_TXT_HOWTOCHANGEDB", "Jos haluat vaihtaa taulukon nimeä,<br /> muokkaa %s/mainfile.php käsin.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');") ;
define("_AM_H4_PREFIXMAN", "Nimike") ;
define("_AM_H5_PREFIXMAN", "Taulukkoja") ;
define("_AM_H6_PREFIXMAN", "Päivitetty") ;
define("_AM_H7_PREFIXMAN", "Kopioi") ;
define("_AM_H8_PREFIXMAN", "Poista") ;

// advisory.php
define("_AM_ADV_NOTSECURE","Ei turvallinen");
define("_AM_ON", "päällä") ;
define("_AM_OFF", "ei päällä") ;
define("_AM_PATCHED", "päivitetty") ;
define("_AM_UNPATCHED", "ei pävitetty");
define("_AM_MISSPOST", "kaipaa postcheck");
define("_AM_INSUFF", "ei riittävä");
define("_AM_ADV_REGISTERGLOBALS","Tämä asetus kutsuu monta erilaista hyökkäystä.<br />Jos voit laittaa .htaccess, muokkaa tai poista...");
define("_AM_ADV_ALLOWURLFOPEN","Tämä asetus sallii hyökkääjien suoritta vahingollisia skriptejä ulkoisilta palvalimilta.<br />Ainoastaan ylläpitäjä voi muuttaa tämän asetuksen.<br />Jos olet ylläpitäjä, muokkaa php.ini tai httpd.conf.<br /><b>Esimerkki httpd.conf tiedostosta:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Muussa tapauksessa, ota yhteyttä ylläpitäjääsi.");
define("_AM_ADV_DBPREFIX","Tämä asetus kutsuu 'SQL Injections'.<br />Älä unohda laittaa päälle 'Pakota puhdistus *' tämän moduulin asetuksissa.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Mene taulukon hallintaan");
define("_AM_ADV_MAINUNPATCHED","Xoops Suoja voi suojata sivustosi hallituissa olosuhteissa niin kauan kun sitä kutsutaan tiedostosta mainfile.php.<br />Sinun pitää muokata mainfile.php tiedosto niin kun README tiedosto suosittelee.");
define("_AM_ADV_RESCUEPASSWORD","Pelastuksen salasana");
define("_AM_ADV_RESCUEPASSWORDUNSET","Ei asetettu");
define("_AM_ADV_RESCUEPASSWORDSHORT","Liian lyhyt (vähintään 6 merkkiä)");
define("_AM_ADV_SUBTITLECHECK","Tarkista että Suoja toimii hyvin");
define("_AM_ADV_AT1STSETPASSWORD","Ensimmäiseksi, sinun pitää laittaa salasana pelastukseen");
define("_AM_ADV_CHECKCONTAMI","Saastutuksia");
define("_AM_ADV_CHECKISOCOM","Yksittäiset Kommentit");

?>