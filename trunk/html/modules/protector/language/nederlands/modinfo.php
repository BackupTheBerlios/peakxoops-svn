<?php
// Module Info

// The name of this module




// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:37
define('_MI_PROTECTOR_HIJACK_TOPBIT','Protected IP bits for the session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (All bits are protected)<br />When your IP is not stable, set the IP range by number of the bits.<br />(eg) If your IP can move in the range of 192.168.0.0-192.168.0.255, set 24(bit) here');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:20
define('_MI_PROTECTOR_DISABLES','Disable dangerous features in XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:34
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','set IPs you can rely separated with | . ^ matches the head of string, $ matches the tail of string.');
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','set the dirnames of the modules separated with |. This option will be useful with chatting module etc.');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-25 06:02:46
define('_MI_PROTECTOR_PREFIXMANAGER','Prefix Manager');
define('_MI_PROTECTOR_GLOBAL_DISBL','Temporary disabled');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','All protections are disabled in temporary.<br />Don\'t forget turn this off after shooting the trouble');
define('_MI_PROTECTOR_LOG_LEVEL','Logging level');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','none');
define('_MI_PROTECTOR_LOGLEVEL15','Quiet');
define('_MI_PROTECTOR_LOGLEVEL63','quiet');
define('_MI_PROTECTOR_LOGLEVEL255','full');
define('_MI_PROTECTOR_DOSOPT_HTA','DENY by .htaccess(Experimental)');

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Deze module beschermt je XOOPS site tegen verschillende aanvallen zoals DoS (Denial of Service) , SQL Injectie en vervuiling van variabelen.<br />\nPlaats het Protector blok links bovenaan en zorg dat alle groepen toegang hebben.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Plaats dit blok links bovenaan en zorg dat alle groepen toegang hebben.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Beveiligingscentrum");
define("_MI_PROTECTOR_ADVISORY","Beveiligingsadvies");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Blok & Groepen Beheer");

// Configs
define('_MI_PROTECTOR_HIJACK_DENYGP','Groepen die niet van IP mogen veranderen tijdens een sessie');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Sessie Kaping:<br />Selecteer groepen die tijdens een sessie niet van IP mogen veranderen.<br />(Ik raad aan dit voor de Administrators te doen.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Opschoning null-bytes');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Het afsluitend karakter "\\0" wordt vaak gebruikt bij kwaadaardige aanvallen.<br />een null-byte zal veranderd worden in een spatie.<br />(sterk aanbevolen dit Aan te zetten)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Sluit als null-bytes gevonden worden');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Het afsluitend karakter "\\0" wordt vaak gebruikt bij kwaadaardige aanvallen.<br />(sterk aanbevolen dit Aan te zetten)');
define('_MI_PROTECTOR_DIE_BADEXT','Sluit als ongewenste bestanden worden ge—Ñload');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Als iemand bestanden met een ongewenste extensie probeert te uploaden zoals .php , zal deze module XOOPS sluiten.<br />Als je vaak php bestanden bijsluit in B-Wiki of PukiWikiMod, is het beter dit Uit te zetten.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Handeling als een vervuiling gevonden is');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Selecteer de te verrichten handeling als iemand probeert system global variabelen te vervuilen op je XOOPS site.<br />(aanbevolen keuze is een blanco pagina weergeven)');
define('_MI_PROTECTOR_ISOCOM_ACTION','Handeling als een enkel startend commentaar teken wordt gevonden');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injectie:<br />Selecteer de handeling als een enkel "/*" wordt gevonden.<br />"Opschonen" betekent het toevoegen van een opvolgend "*/".<br />(aanbevolen keuze is Opschonen)');
define('_MI_PROTECTOR_UNION_ACTION','Handeling als UNION wordt gevonden');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injectie:<br />Selecteer de handling die verricht moet worden als syntax zoals UNION in SQL gevonden wordt.<br />"Opschonen" betekent "union" veranderen in "uni-on".<br />(aanbevolen keuze is Opschonen)');
define('_MI_PROTECTOR_ID_INTVAL','Forceer een integer waarde bij variabelen zoals id');
define('_MI_PROTECTOR_ID_INTVALDSC','Alle aanvragen die "*id" bevatten zullen als integer behandeld worden.<br />Deze optie beschermt tegen bepaalde vormen van XSS and SQL Injecties.<br />Alhoewel aan te raden is deze optie Aan te zetten, kan het problemen veroorzaken met sommige modules.');
define('_MI_PROTECTOR_FILE_DOTDOT','Verander twijfelachtige bestandsspecificaties');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Verwijdert ".." uit alle aanvragen die op een bestandsspecificatie lijken');

define('_MI_PROTECTOR_DOS_EXPIRE','Tijd om snel-laders in de gaten te houden (sec)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Deze specificeert de tijd in seconden dat frequente verversers (F5 Aanval) en snel aanvragende web-crawlers in de gaten gehouden worden.');

define('_MI_PROTECTOR_DOS_F5COUNT','Kritiek aantal verversingen F5 Aanval');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Het voorkomen van DoS aanvallen.<br />Deze waarde specificeert het aantal verversingen dat wordt gezien als een kwaadaardige aanval.');
define('_MI_PROTECTOR_DOS_F5ACTION','Handeling tegen F5 Aanval');

define('_MI_PROTECTOR_DOS_CRCOUNT','Kritiek aantal voor web-crawlers');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Blokkeren van snel aanvragende web-crawlers.<br />Deze waarde specificeert het aantal aanvragen dat wordt gezien als kenmerkend voor een ongewenste web-crawler.');
define('_MI_PROTECTOR_DOS_CRACTION','Handeling tegen snel aanvragende web-crawlers');

define('_MI_PROTECTOR_DOS_CRSAFE','Gewenste user-agents');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Een perl regex patroon om de user-agent te herkennen.<br />Als het overeenkomt, zal de web-crawler nooit als ongewenst worden beschouwd.<br />eg) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Geen (alleen vastleggen in logbestand)');
define('_MI_PROTECTOR_OPT_SAN','Opschonen');
define('_MI_PROTECTOR_OPT_EXIT','Blanco Scherm');
define('_MI_PROTECTOR_OPT_BIP','Verban het IP adres');

define('_MI_PROTECTOR_DOSOPT_NONE','Geen (alleen vastleggen in logbestand)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Slapen');
define('_MI_PROTECTOR_DOSOPT_EXIT','Blanco Scherm');
define('_MI_PROTECTOR_DOSOPT_BIP','Verban het IP adres');

define('_MI_PROTECTOR_BIP_EXCEPT','Groepen wiens IP adres nooit verbannen wordt');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Een gebruiker die behoort tot de hier gespecificeerde groepen zal nooit verbannen worden.<br />(Ik beveel aan om Administrator aan te zetten.)');
define('_MI_PROTECTOR_PATCH2092','Specifieke aanpassingen voor Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_PASSWD_BIP','Reddingswachtwoord (uitschakelen IP verbanning)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Als u buitengesloten wordt uit uw eigen site, open dan XOOPS_URL/modules/protector/admin/rescue.php en voer dit wachtwoord in.<br />Vergeet niet het wachtwoord in te stellen voor het geval u per ongeluk buitengesloten wordt uit uw eigen site.<br />Als het wachtwoord leeg is, kunt u geen buitensluiting ongedaan maken.');

?>