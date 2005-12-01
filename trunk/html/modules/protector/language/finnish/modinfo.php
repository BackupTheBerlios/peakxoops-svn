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
define("_MI_PROTECTOR_DESC","TçÎä moduuli suojaa sivustosi erilaisilta hy‹ÌkçÚksiltä niinkuin DoS , SQL Injection , ja Variables saastutuksilta.<br />\nSinun pitèæ asetaa tçÎä blokki, ylimpèæn vasemmalle laidalle ja asettaa kaikille ryhmille lukuoikeuden sille.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Suoja");
define("_MI_PROTECTOR_BDESC1","TçÎä blokki pitèæ asettaa ylimpèæn vasemmalle laidalle ja nçÚtettç×issä kaikilla sivuilla.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Suojakeskus");
define("_MI_PROTECTOR_ADVISORY","Suositeltu Turva");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Blokki & Ryhmä YllçÑito");
define("_MI_PROTECTOR_PREFIXMANAGER","Taulukon hallinta");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','VçÍiaikaisesti poistettu kçÚt‹Ôtä');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Kaikki suojat on vçÍiaikaisesti poistettu kçÚt‹Ôtä.<br />ŽÄlä unohda sulkea sitä ongelma ratkaisun jçÍkeen');
define('_MI_PROTECTOR_LOG_LEVEL','Loggauksen taso');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','ei mitèæn');
define('_MI_PROTECTOR_LOGLEVEL15','Hiljainen');
define('_MI_PROTECTOR_LOGLEVEL63','hiljainen');
define('_MI_PROTECTOR_LOGLEVEL255','tçÚsi');
define('_MI_PROTECTOR_HIJACK_DENYGP','RyhmçÕ jotka ei saa vaihtaa IP osoitetta sessiossa');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Sessio Kaappaus:<br />Valitse ryhmçÕ jotka ei saa vaihtaa IP osoitteetaan sessiossa.<br />(Suosittelen että laitat YllçÑitçËçÕ pèælle.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Puhdista nolla-tavua');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Loppuvaa merkkiä "\\0" kçÚtetèæn usein pahoissa hy‹ÌkçÚksissä.<br />nolla-tavua vaihdetaan vçÍily‹Ïniksi.<br />(suosilteltu asetus on Kyllä)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Poistu jos havainnoidaan nolla tavuja');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Loppuvaa merkkiä "\\0" kçÚtetèæn usein pahoissa hy‹ÌkçÚksissä.<br />(suosilteltu asetus on Kyllä)');
define('_MI_PROTECTOR_DIE_BADEXT','Poistu jos vahingollisia tiedostoja ladataan tçÏne');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Jos joku lataa palvelimelle tiedostoja joilla on tiedostopèætteitä kuten .php,<br />tçÎä moduuli poistuu Xoops sivustoltasi.<br />Jos liitçÕ usein tiedostoja B-Wikiin tai PukiWikiModiin, laita tçÎä asetukseen ei.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Toiminta jos saastutus havannoidaan');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Valitse toiminta kun joku yrittèæ saastuttaa jçÓjestelmçÏ global variables sinun Xoops sivustollesi.<br />(suositeltu asetus on tyhjä sivu)');
define('_MI_PROTECTOR_OPT_NONE','Ei mitèæn (ainoastaan loggaus)');
define('_MI_PROTECTOR_OPT_SAN','Puhdistus');
define('_MI_PROTECTOR_OPT_EXIT','Tyhjä Sivu');
define('_MI_PROTECTOR_OPT_BIP','Estä IP Osoite');
define('_MI_PROTECTOR_DOSOPT_NONE','Ei mitèæn (ainoastaan loggaus');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Nuku');
define('_MI_PROTECTOR_DOSOPT_EXIT','Tyhjä Sivu');
define('_MI_PROTECTOR_DOSOPT_BIP','Estä IP Osoite');
define('_MI_PROTECTOR_DOSOPT_HTA','ESTŽÄ kçÚttçÎçÍlä .htaccess(Testissä)');
define('_MI_PROTECTOR_PASSWD_BIP','Pelastuksen salasana (poistaa IP eston)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Jos sinua estetèæn sivustollesi pèæsyn, mene XOOPS_URL/modules/protector/admin/rescue.php<br />ja kirjoita tçÎä salasana.<br />ŽÄlä unohda asettaa salasanaa ennen kun sinua estetèæn sivustollesi pèæsyä vahingossa.<br />Jos tçÎä asetus on tyhjä, niin silloin skripti joka poistaa IP eston ei kosaan toimi.<br />Koska tçÎä salasana tallennetaan teksti muodossa,<br />çÍä kçÚtä samaa salasanaa kun kirjaudut sivustollesi.');
define('_MI_PROTECTOR_PATCH2092','Erityisä korjauksia ennen Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_ISOCOM_ACTION','Toiminta jos yksittçÊsiä comment-in havannoidaan');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun yksittçÊsiä "/*" havannoidaan.<br />"Puhdistus" tarkoittaa lisèæ ylimèærçÊnen "*/" hçÏtèæn.<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_UNION_ACTION','Toiminta jos UNION havannoidaan');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Valitse toiminta kun syntkasi kuten UNION of SQL.<br />"Puhdistus" tarkoittaa vaihda "union" -> "uni-on".<br />(suositeltu asetus on Puhdistus)');
define('_MI_PROTECTOR_DOS_F5ACTION','Toiminta F5 hy‹ÌkçÚksiä vastaan');
define('_MI_PROTECTOR_DOS_F5COUNT','Kuinka monta F5 hy‹ÌkçÚstä');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Suojaa DoS hy‹ÌkçÚksiltä.<br />TçÎä arvo asettaa sivun virkistys laskurin ennen kun se lasketaan hy‹ÌkçÚksenä.');
define('_MI_PROTECTOR_DOS_CRSAFE','Tervetulleet Hakukoneet');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Perl regex hahmonsovitus hakukoneille.<br />Jos sopivia l‹Útyy, silloin hakukone ei lasketa raskaaksi hakukoneeksi.<br />esim.) /(msnbot|Googlebot|Yahoo! Slurp)/i');
define('_MI_PROTECTOR_DOS_CRCOUNT','Koinka monta automatisoituja hakukonekyselyitä');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Suojaa automatisoidulta hakukonekyselyiltä.<br />TçÎä arvo astettaa koinka monta kyselyä ennen kun se lasketaan huonoksi kyselyksi.');
define('_MI_PROTECTOR_DOS_CRACTION','Toiminta automatisoituja hakukonekyselyitä vastaan');
define('_MI_PROTECTOR_ID_INTVAL','Pakota intval -> muuttajaksi kuten id');
define('_MI_PROTECTOR_ID_INTVALDSC','Kaikki kyselyt nimellä "*id" kohdellaan integer kyselynä.<br />TçÎä asetus suojaa sinua jostain XSS ja SQL Injections.<br />Vaikka tçÎä asetus os suositeltu pitèæ pèællä, se voi aiheuttaa ongelmia muutamassa moduulissa.');
define('_MI_PROTECTOR_FILE_DOTDOT','Korjaa epçÊlyttç×iä tiedosto mèærityksiä');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','TçÎä poistaa ".." kaikista kyselyistä jotka kyselee mèæriteltyjä tiedostoja');
define('_MI_PROTECTOR_DOS_EXPIRE','Tarkistus aika raskaille latauksille (sek)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','TçÎä arvo asettaa tarkistus ajan toistuville pçÊvityksille (F5 hy‹ÌkçÚs) ja automatisoiduille hakukonekyselyille.');
define('_MI_PROTECTOR_BIP_EXCEPT','RyhmçÕ joille ei koskaan estetä IP Osoitetta');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','KçÚttçËä joka kuuluu ryhmèæn joka on astettu tçÔsä ei koskaan saa IP osoitetta estetty.<br />(Suosittelen että laitat YllçÑitçËçÕ pèælle.)');
?>