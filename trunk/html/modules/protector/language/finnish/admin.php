<?php

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:39
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Aika");
define("_AM_TH_USER","K��tt���");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","SELAIN");
define("_AM_TH_TYPE","Tyyppi");
define("_AM_TH_DESCRIPTION","Kuvaus");
define("_AM_TH_BADIPS", "Pahat IP't") ;
define("_AM_TH_ENABLEIPBANS", "K��t� IP estoa?") ;
define("_AM_LABEL_REMOVE", "Poista valitut tiedot: ") ;
define("_AM_BUTTON_REMOVE", "Poista!") ;
define("_AM_JS_REMOVECONFIRM", "Oletko Varma?") ;
define("_AM_MSG_PRUPDATED", "Asetukset on p��vitetty!") ;
define("_AM_MSG_REMOVED", "Tiedot on poistettu!") ;

// prefix_manager.php
define("_AM_H3_PREFIXMAN", "Taulukon Hallinta") ;
define("_AM_MSG_DBUPDATED", "Tietokanta p��vitetty onnistuneesti!") ;
define("_AM_CONFIRM_DELETE", "Kaikki tiedot poistetaan. OK?") ;
define("_AM_TXT_HOWTOCHANGEDB", "Jos haluat vaihtaa taulukon nime�,<br /> muokkaa %s/mainfile.php k��in.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');") ;
define("_AM_H4_PREFIXMAN", "Nimike") ;
define("_AM_H5_PREFIXMAN", "Taulukkoja") ;
define("_AM_H6_PREFIXMAN", "P��vitetty") ;
define("_AM_H7_PREFIXMAN", "Kopioi") ;
define("_AM_H8_PREFIXMAN", "Poista") ;

// advisory.php
define("_AM_ADV_NOTSECURE","Ei turvallinen");
define("_AM_ON", "p��ll�") ;
define("_AM_OFF", "ei p��ll�") ;
define("_AM_PATCHED", "p��vitetty") ;
define("_AM_UNPATCHED", "ei p��itetty");
define("_AM_MISSPOST", "kaipaa postcheck");
define("_AM_INSUFF", "ei riitt���");
define("_AM_ADV_REGISTERGLOBALS","T��� asetus kutsuu monta erilaista hy��k��st�.<br />Jos voit laittaa .htaccess, muokkaa tai poista...");
define("_AM_ADV_ALLOWURLFOPEN","T��� asetus sallii hy��k��jien suoritta vahingollisia skriptej� ulkoisilta palvalimilta.<br />Ainoastaan yll��it��� voi muuttaa t���� asetuksen.<br />Jos olet yll��it���, muokkaa php.ini tai httpd.conf.<br /><b>Esimerkki httpd.conf tiedostosta:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Muussa tapauksessa, ota yhteytt� yll��it����si.");
define("_AM_ADV_DBPREFIX","T��� asetus kutsuu 'SQL Injections'.<br />��l� unohda laittaa p��lle 'Pakota puhdistus *' t���� moduulin asetuksissa.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Mene taulukon hallintaan");
define("_AM_ADV_MAINUNPATCHED","Xoops Suoja voi suojata sivustosi hallituissa olosuhteissa niin kauan kun sit� kutsutaan tiedostosta mainfile.php.<br />Sinun pit�� muokata mainfile.php tiedosto niin kun README tiedosto suosittelee.");
define("_AM_ADV_RESCUEPASSWORD","Pelastuksen salasana");
define("_AM_ADV_RESCUEPASSWORDUNSET","Ei asetettu");
define("_AM_ADV_RESCUEPASSWORDSHORT","Liian lyhyt (v��int��n 6 merkki�)");
define("_AM_ADV_SUBTITLECHECK","Tarkista ett� Suoja toimii hyvin");
define("_AM_ADV_AT1STSETPASSWORD","Ensimm��seksi, sinun pit�� laittaa salasana pelastukseen");
define("_AM_ADV_CHECKCONTAMI","Saastutuksia");
define("_AM_ADV_CHECKISOCOM","Yksitt��set Kommentit");

?>