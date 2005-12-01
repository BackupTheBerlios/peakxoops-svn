<?php
// Module Info

// The name of this module



// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:39
define('_MI_PROTECTOR_HIJACK_TOPBIT','Protected IP bits for the session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (All bits are protected)<br />When your IP is not stable, set the IP range by number of the bits.<br />(eg) If your IP can move in the range of 192.168.0.0-192.168.0.255, set 24(bit) here');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:21
define('_MI_PROTECTOR_DISABLES','Disable dangerous features in XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:35
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','set IPs you can rely separated with | . ^ matches the head of string, $ matches the tail of string.');
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','set the dirnames of the modules separated with |. This option will be useful with chatting module etc.');

define("_MI_PROTECTOR_NAME","Xoops Suoja");

// A brief description of this module
define("_MI_PROTECTOR_DESC","T��� moduuli suojaa sivustosi erilaisilta hy��k��ksilt� niinkuin DoS , SQL Injection , ja Variables saastutuksilta.<br />\nSinun pit�� asetaa t��� blokki, ylimp��n vasemmalle laidalle ja asettaa kaikille ryhmille lukuoikeuden sille.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Suoja");
define("_MI_PROTECTOR_BDESC1","T��� blokki pit�� asettaa ylimp��n vasemmalle laidalle ja n��tett��iss� kaikilla sivuilla.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Suojakeskus");
define("_MI_PROTECTOR_ADVISORY","Suositeltu Turva");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Blokki & Ryhm� Yll��ito");
define("_MI_PROTECTOR_PREFIXMANAGER","Taulukon hallinta");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','V��iaikaisesti poistettu k��t��t�');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Kaikki suojat on v��iaikaisesti poistettu k��t��t�.<br />��l� unohda sulkea sit� ongelma ratkaisun j��keen');
define('_MI_PROTECTOR_LOG_LEVEL','Loggauksen taso');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','ei mit��n');
define('_MI_PROTECTOR_LOGLEVEL15','Hiljainen');
define('_MI_PROTECTOR_LOGLEVEL63','hiljainen');
define('_MI_PROTECTOR_LOGLEVEL255','t��si');
define('_MI_PROTECTOR_HIJACK_DENYGP','Ryhm�� jotka ei saa vaihtaa IP osoitetta sessiossa');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Sessio Kaappaus:<br />Valitse ryhm�� jotka ei saa vaihtaa IP osoitteetaan sessiossa.<br />(Suosittelen ett� laitat Yll��it���� p��lle.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Puhdista nolla-tavua');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Loppuvaa merkki� "\\0" k��tet��n usein pahoissa hy��k��ksiss�.<br />nolla-tavua vaihdetaan v��ily��niksi.<br />(suosilteltu asetus on Kyll�)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Poistu jos havainnoidaan nolla tavuja');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Loppuvaa merkki� "\\0" k��tet��n usein pahoissa hy��k��ksiss�.<br />(suosilteltu asetus on Kyll�)');
define('_MI_PROTECTOR_DIE_BADEXT','Poistu jos vahingollisia tiedostoja ladataan t��ne');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Jos joku lataa palvelimelle tiedostoja joilla on tiedostop��tteit� kuten .php,<br />t��� moduuli poistuu Xoops sivustoltasi.<br />Jos liit�� usein tiedostoja B-Wikiin tai PukiWikiModiin, laita t��� asetukseen ei.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Toiminta jos saastutus havannoidaan');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Valitse toiminta kun joku yritt�� saastuttaa j��jestelm�� global variables sinun Xoops sivustollesi.<br />(suositeltu asetus on tyhj� sivu)');
define('_MI_PROTECTOR_OPT_NONE','Ei mit��n (ainoastaan loggaus)');
define('_MI_PROTECTOR_OPT_SAN','Puhdistus');
define('_MI_PROTECTOR_OPT_EXIT','Tyhj� Sivu');
define('_MI_PROTECTOR_OPT_BIP','Est� IP Osoite');
define('_MI_PROTECTOR_DOSOPT_NONE','Ei mit��n (ainoastaan loggaus');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Nuku');
define('_MI_PROTECTOR_DOSOPT_EXIT','Tyhj� Sivu');
define('_MI_PROTECTOR_DOSOPT_BIP','Est� IP Osoite');
define('_MI_PROTECTOR_DOSOPT_HTA','EST�� k��tt����l� .htaccess(Testiss�)');
define('_MI_PROTECTOR_PASSWD_BIP','Pelastuksen salasana (poistaa IP eston)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Jos sinua estet��n sivustollesi p��syn, mene XOOPS_URL/modules/protector/admin/rescue.php<br />ja kirjoita t��� salasana.<br />��l� unohda asettaa salasanaa ennen kun sinua estet��n sivustollesi p��sy� vahingossa.<br />Jos t��� asetus on tyhj�, niin silloin skripti joka poistaa IP eston ei kosaan toimi.<br />Koska t��� salasana tallennetaan teksti muodossa,<br />��� k��t� samaa salasanaa kun kirjaudut sivustollesi.');
define('_MI_PROTECTOR_PATCH2092','Erityis� korjauksia ennen Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_ISOCOM_ACTION','Toiminta jos yksitt��si� comment-in havannoidaan');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun yksitt��si� "/*" havannoidaan.<br />"Puhdistus" tarkoittaa lis�� ylim��r��nen "*/" h��t��n.<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_UNION_ACTION','Toiminta jos UNION havannoidaan');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun syntkasi kuten UNION of SQL.<br />"Puhdistus" tarkoittaa vaihda "union" -> "uni-on".<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_DOS_F5ACTION','Toiminta F5 hy��k��ksi� vastaan');
define('_MI_PROTECTOR_DOS_F5COUNT','Kuinka monta F5 hy��k��st�');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Suojaa DoS hy��k��ksilt�.<br />T��� arvo asettaa sivun virkistys laskurin ennen kun se lasketaan hy��k��ksen�.');
define('_MI_PROTECTOR_DOS_CRSAFE','Tervetulleet Hakukoneet');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Perl regex hahmonsovitus hakukoneille.<br />Jos sopivia l��tyy, silloin hakukone ei lasketa raskaaksi hakukoneeksi.<br />esim.) /(msnbot|Googlebot|Yahoo! Slurp)/i');
define('_MI_PROTECTOR_DOS_CRCOUNT','Koinka monta automatisoituja hakukonekyselyit�');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Suojaa automatisoidulta hakukonekyselyilt�.<br />T��� arvo astettaa koinka monta kysely� ennen kun se lasketaan huonoksi kyselyksi.');
define('_MI_PROTECTOR_DOS_CRACTION','Toiminta automatisoituja hakukonekyselyit� vastaan');
define('_MI_PROTECTOR_ID_INTVAL','Pakota intval -> muuttajaksi kuten id');
define('_MI_PROTECTOR_ID_INTVALDSC','Kaikki kyselyt nimell� "*id" kohdellaan integer kyselyn�.<br />T��� asetus suojaa sinua jostain XSS ja SQL Injections.<br />Vaikka t��� asetus os suositeltu pit�� p��ll�, se voi aiheuttaa ongelmia muutamassa moduulissa.');
define('_MI_PROTECTOR_FILE_DOTDOT','Korjaa ep��lytt��i� tiedosto m��rityksi�');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','T��� poistaa ".." kaikista kyselyist� jotka kyselee m��riteltyj� tiedostoja');
define('_MI_PROTECTOR_DOS_EXPIRE','Tarkistus aika raskaille latauksille (sek)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','T��� arvo asettaa tarkistus ajan toistuville p��vityksille (F5 hy��k��s) ja automatisoiduille hakukonekyselyille.');
define('_MI_PROTECTOR_BIP_EXCEPT','Ryhm�� joille ei koskaan estet� IP Osoitetta');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','K��tt��� joka kuuluu ryhm��n joka on astettu t��s� ei koskaan saa IP osoitetta estetty.<br />(Suosittelen ett� laitat Yll��it���� p��lle.)');
?>