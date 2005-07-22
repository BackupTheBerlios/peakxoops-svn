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
define("_MI_PROTECTOR_DESC","T�m� moduuli suojaa sivustosi erilaisilta hy�kk�yksilt� niinkuin DoS , SQL Injection , ja Variables saastutuksilta.<br />\nSinun pit�� asetaa t�m� blokki, ylimp��n vasemmalle laidalle ja asettaa kaikille ryhmille lukuoikeuden sille.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Suoja");
define("_MI_PROTECTOR_BDESC1","T�m� blokki pit�� asettaa ylimp��n vasemmalle laidalle ja n�ytett�viss� kaikilla sivuilla.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Suojakeskus");
define("_MI_PROTECTOR_ADVISORY","Suositeltu Turva");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Blokki & Ryhm� Yll�pito");
define("_MI_PROTECTOR_PREFIXMANAGER","Taulukon hallinta");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','V�liaikaisesti poistettu k�yt�st�');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Kaikki suojat on v�liaikaisesti poistettu k�yt�st�.<br />�l� unohda sulkea sit� ongelma ratkaisun j�lkeen');
define('_MI_PROTECTOR_LOG_LEVEL','Loggauksen taso');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','ei mit��n');
define('_MI_PROTECTOR_LOGLEVEL15','Hiljainen');
define('_MI_PROTECTOR_LOGLEVEL63','hiljainen');
define('_MI_PROTECTOR_LOGLEVEL255','t�ysi');
define('_MI_PROTECTOR_HIJACK_DENYGP','Ryhm�t jotka ei saa vaihtaa IP osoitetta sessiossa');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Sessio Kaappaus:<br />Valitse ryhm�t jotka ei saa vaihtaa IP osoitteetaan sessiossa.<br />(Suosittelen ett� laitat Yll�pit�j�t p��lle.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Puhdista nolla-tavua');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Loppuvaa merkki� "\\0" k�ytet��n usein pahoissa hy�kk�yksiss�.<br />nolla-tavua vaihdetaan v�lily�nniksi.<br />(suosilteltu asetus on Kyll�)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Poistu jos havainnoidaan nolla tavuja');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Loppuvaa merkki� "\\0" k�ytet��n usein pahoissa hy�kk�yksiss�.<br />(suosilteltu asetus on Kyll�)');
define('_MI_PROTECTOR_DIE_BADEXT','Poistu jos vahingollisia tiedostoja ladataan t�nne');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Jos joku lataa palvelimelle tiedostoja joilla on tiedostop��tteit� kuten .php,<br />t�m� moduuli poistuu Xoops sivustoltasi.<br />Jos liit�t usein tiedostoja B-Wikiin tai PukiWikiModiin, laita t�m� asetukseen ei.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Toiminta jos saastutus havannoidaan');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Valitse toiminta kun joku yritt�� saastuttaa j�rjestelm�n global variables sinun Xoops sivustollesi.<br />(suositeltu asetus on tyhj� sivu)');
define('_MI_PROTECTOR_OPT_NONE','Ei mit��n (ainoastaan loggaus)');
define('_MI_PROTECTOR_OPT_SAN','Puhdistus');
define('_MI_PROTECTOR_OPT_EXIT','Tyhj� Sivu');
define('_MI_PROTECTOR_OPT_BIP','Est� IP Osoite');
define('_MI_PROTECTOR_DOSOPT_NONE','Ei mit��n (ainoastaan loggaus');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Nuku');
define('_MI_PROTECTOR_DOSOPT_EXIT','Tyhj� Sivu');
define('_MI_PROTECTOR_DOSOPT_BIP','Est� IP Osoite');
define('_MI_PROTECTOR_DOSOPT_HTA','EST� k�ytt�m�ll� .htaccess(Testiss�)');
define('_MI_PROTECTOR_PASSWD_BIP','Pelastuksen salasana (poistaa IP eston)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Jos sinua estet��n sivustollesi p��syn, mene XOOPS_URL/modules/protector/admin/rescue.php<br />ja kirjoita t�m� salasana.<br />�l� unohda asettaa salasanaa ennen kun sinua estet��n sivustollesi p��sy� vahingossa.<br />Jos t�m� asetus on tyhj�, niin silloin skripti joka poistaa IP eston ei kosaan toimi.<br />Koska t�m� salasana tallennetaan teksti muodossa,<br />�l� k�yt� samaa salasanaa kun kirjaudut sivustollesi.');
define('_MI_PROTECTOR_PATCH2092','Erityis� korjauksia ennen Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_ISOCOM_ACTION','Toiminta jos yksitt�isi� comment-in havannoidaan');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun yksitt�isi� "/*" havannoidaan.<br />"Puhdistus" tarkoittaa lis�� ylim��r�inen "*/" h�nt��n.<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_UNION_ACTION','Toiminta jos UNION havannoidaan');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun syntkasi kuten UNION of SQL.<br />"Puhdistus" tarkoittaa vaihda "union" -> "uni-on".<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_DOS_F5ACTION','Toiminta F5 hy�kk�yksi� vastaan');
define('_MI_PROTECTOR_DOS_F5COUNT','Kuinka monta F5 hy�kk�yst�');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Suojaa DoS hy�kk�yksilt�.<br />T�m� arvo asettaa sivun virkistys laskurin ennen kun se lasketaan hy�kk�yksen�.');
define('_MI_PROTECTOR_DOS_CRSAFE','Tervetulleet Hakukoneet');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Perl regex hahmonsovitus hakukoneille.<br />Jos sopivia l�ytyy, silloin hakukone ei lasketa raskaaksi hakukoneeksi.<br />esim.) /(msnbot|Googlebot|Yahoo! Slurp)/i');
define('_MI_PROTECTOR_DOS_CRCOUNT','Koinka monta automatisoituja hakukonekyselyit�');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Suojaa automatisoidulta hakukonekyselyilt�.<br />T�m� arvo astettaa koinka monta kysely� ennen kun se lasketaan huonoksi kyselyksi.');
define('_MI_PROTECTOR_DOS_CRACTION','Toiminta automatisoituja hakukonekyselyit� vastaan');
define('_MI_PROTECTOR_ID_INTVAL','Pakota intval -> muuttajaksi kuten id');
define('_MI_PROTECTOR_ID_INTVALDSC','Kaikki kyselyt nimell� "*id" kohdellaan integer kyselyn�.<br />T�m� asetus suojaa sinua jostain XSS ja SQL Injections.<br />Vaikka t�m� asetus os suositeltu pit�� p��ll�, se voi aiheuttaa ongelmia muutamassa moduulissa.');
define('_MI_PROTECTOR_FILE_DOTDOT','Korjaa ep�ilytt�vi� tiedosto m��rityksi�');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','T�m� poistaa ".." kaikista kyselyist� jotka kyselee m��riteltyj� tiedostoja');
define('_MI_PROTECTOR_DOS_EXPIRE','Tarkistus aika raskaille latauksille (sek)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','T�m� arvo asettaa tarkistus ajan toistuville p�ivityksille (F5 hy�kk�ys) ja automatisoiduille hakukonekyselyille.');
define('_MI_PROTECTOR_BIP_EXCEPT','Ryhm�t joille ei koskaan estet� IP Osoitetta');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','K�ytt�j� joka kuuluu ryhm��n joka on astettu t�ss� ei koskaan saa IP osoitetta estetty.<br />(Suosittelen ett� laitat Yll�pit�j�t p��lle.)');
?>