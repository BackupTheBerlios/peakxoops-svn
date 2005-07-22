<?php
// Module Info

// The name of this module

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:35
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','set IPs you can rely separated with | . ^ matches the head of string, $ matches the tail of string.');
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','set the dirnames of the modules separated with |. This option will be useful with chatting module etc.');

define("_MI_PROTECTOR_NAME","Xoops Suoja");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Tämä moduuli suojaa sivustosi erilaisilta hyökkäyksiltä niinkuin DoS , SQL Injection , ja Variables saastutuksilta.<br />\nSinun pitää asetaa tämä blokki, ylimpään vasemmalle laidalle ja asettaa kaikille ryhmille lukuoikeuden sille.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Suoja");
define("_MI_PROTECTOR_BDESC1","Tämä blokki pitää asettaa ylimpään vasemmalle laidalle ja näytettävissä kaikilla sivuilla.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Suojakeskus");
define("_MI_PROTECTOR_ADVISORY","Suositeltu Turva");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Blokki & Ryhmä Ylläpito");
define("_MI_PROTECTOR_PREFIXMANAGER","Taulukon hallinta");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','Väliaikaisesti poistettu käytöstä');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Kaikki suojat on väliaikaisesti poistettu käytöstä.<br />Älä unohda sulkea sitä ongelma ratkaisun jälkeen');
define('_MI_PROTECTOR_LOG_LEVEL','Loggauksen taso');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','ei mitään');
define('_MI_PROTECTOR_LOGLEVEL15','Hiljainen');
define('_MI_PROTECTOR_LOGLEVEL63','hiljainen');
define('_MI_PROTECTOR_LOGLEVEL255','täysi');
define('_MI_PROTECTOR_HIJACK_DENYGP','Ryhmät jotka ei saa vaihtaa IP osoitetta sessiossa');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Sessio Kaappaus:<br />Valitse ryhmät jotka ei saa vaihtaa IP osoitteetaan sessiossa.<br />(Suosittelen että laitat Ylläpitäjät päälle.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Puhdista nolla-tavua');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Loppuvaa merkkiä "\\0" käytetään usein pahoissa hyökkäyksissä.<br />nolla-tavua vaihdetaan välilyönniksi.<br />(suosilteltu asetus on Kyllä)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Poistu jos havainnoidaan nolla tavuja');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Loppuvaa merkkiä "\\0" käytetään usein pahoissa hyökkäyksissä.<br />(suosilteltu asetus on Kyllä)');
define('_MI_PROTECTOR_DIE_BADEXT','Poistu jos vahingollisia tiedostoja ladataan tänne');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Jos joku lataa palvelimelle tiedostoja joilla on tiedostopäätteitä kuten .php,<br />tämä moduuli poistuu Xoops sivustoltasi.<br />Jos liität usein tiedostoja B-Wikiin tai PukiWikiModiin, laita tämä asetukseen ei.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Toiminta jos saastutus havannoidaan');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Valitse toiminta kun joku yrittää saastuttaa järjestelmän global variables sinun Xoops sivustollesi.<br />(suositeltu asetus on tyhjä sivu)');
define('_MI_PROTECTOR_OPT_NONE','Ei mitään (ainoastaan loggaus)');
define('_MI_PROTECTOR_OPT_SAN','Puhdistus');
define('_MI_PROTECTOR_OPT_EXIT','Tyhjä Sivu');
define('_MI_PROTECTOR_OPT_BIP','Estä IP Osoite');
define('_MI_PROTECTOR_DOSOPT_NONE','Ei mitään (ainoastaan loggaus');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Nuku');
define('_MI_PROTECTOR_DOSOPT_EXIT','Tyhjä Sivu');
define('_MI_PROTECTOR_DOSOPT_BIP','Estä IP Osoite');
define('_MI_PROTECTOR_DOSOPT_HTA','ESTÄ käyttämällä .htaccess(Testissä)');
define('_MI_PROTECTOR_PASSWD_BIP','Pelastuksen salasana (poistaa IP eston)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Jos sinua estetään sivustollesi pääsyn, mene XOOPS_URL/modules/protector/admin/rescue.php<br />ja kirjoita tämä salasana.<br />Älä unohda asettaa salasanaa ennen kun sinua estetään sivustollesi pääsyä vahingossa.<br />Jos tämä asetus on tyhjä, niin silloin skripti joka poistaa IP eston ei kosaan toimi.<br />Koska tämä salasana tallennetaan teksti muodossa,<br />älä käytä samaa salasanaa kun kirjaudut sivustollesi.');
define('_MI_PROTECTOR_PATCH2092','Erityisä korjauksia ennen Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_ISOCOM_ACTION','Toiminta jos yksittäisiä comment-in havannoidaan');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun yksittäisiä "/*" havannoidaan.<br />"Puhdistus" tarkoittaa lisää ylimääräinen "*/" häntään.<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_UNION_ACTION','Toiminta jos UNION havannoidaan');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun syntkasi kuten UNION of SQL.<br />"Puhdistus" tarkoittaa vaihda "union" -> "uni-on".<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_DOS_F5ACTION','Toiminta F5 hyökkäyksiä vastaan');
define('_MI_PROTECTOR_DOS_F5COUNT','Kuinka monta F5 hyökkäystä');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Suojaa DoS hyökkäyksiltä.<br />Tämä arvo asettaa sivun virkistys laskurin ennen kun se lasketaan hyökkäyksenä.');
define('_MI_PROTECTOR_DOS_CRSAFE','Tervetulleet Hakukoneet');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Perl regex hahmonsovitus hakukoneille.<br />Jos sopivia löytyy, silloin hakukone ei lasketa raskaaksi hakukoneeksi.<br />esim.) /(msnbot|Googlebot|Yahoo! Slurp)/i');
define('_MI_PROTECTOR_DOS_CRCOUNT','Koinka monta automatisoituja hakukonekyselyitä');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Suojaa automatisoidulta hakukonekyselyiltä.<br />Tämä arvo astettaa koinka monta kyselyä ennen kun se lasketaan huonoksi kyselyksi.');
define('_MI_PROTECTOR_DOS_CRACTION','Toiminta automatisoituja hakukonekyselyitä vastaan');
define('_MI_PROTECTOR_ID_INTVAL','Pakota intval -> muuttajaksi kuten id');
define('_MI_PROTECTOR_ID_INTVALDSC','Kaikki kyselyt nimellä "*id" kohdellaan integer kyselynä.<br />Tämä asetus suojaa sinua jostain XSS ja SQL Injections.<br />Vaikka tämä asetus os suositeltu pitää päällä, se voi aiheuttaa ongelmia muutamassa moduulissa.');
define('_MI_PROTECTOR_FILE_DOTDOT','Korjaa epäilyttäviä tiedosto määrityksiä');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Tämä poistaa ".." kaikista kyselyistä jotka kyselee määriteltyjä tiedostoja');
define('_MI_PROTECTOR_DOS_EXPIRE','Tarkistus aika raskaille latauksille (sek)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Tämä arvo asettaa tarkistus ajan toistuville päivityksille (F5 hyökkäys) ja automatisoiduille hakukonekyselyille.');
define('_MI_PROTECTOR_BIP_EXCEPT','Ryhmät joille ei koskaan estetä IP Osoitetta');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Käyttäjä joka kuuluu ryhmään joka on astettu tässä ei koskaan saa IP osoitetta estetty.<br />(Suosittelen että laitat Ylläpitäjät päälle.)');
?>