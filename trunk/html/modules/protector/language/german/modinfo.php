<?php
// Module Info

// The name of�rthis module







// Appended by Xoops Language Checker -GIJOE- in 2006-04-06 05:04:58
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_MI_PROTECTOR_HIJACK_TOPBIT','Gesch�tzte IP bits f�r dieses Session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (Alle Bits sind gesch�tzt)<br />Wenn Sie keine statische IP Adresse haben, setzen Sie den IP Bereich mit Nummer der einzelnen Bits.<br />(eg) Wenn sich Ihre IP im Bereich von 192.168.0.0 bis 192.168.0.255 befindet, setzen Sie 24(bit) hier');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:21
define('_MI_PROTECTOR_DISABLES','Deaktiviert die Sicherheitsfeatures von Protector in XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:35
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','Sie k�nnen IP Adressen mit einem | trennen. ^ setzt den Kopf�rdes String, $ setzt das Ende des Strings.');
define('_MI_PROTECTOR_Bf�r_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_Bf�r_COUNTDSC','Setzt die Anzahl, wie oft sich G�ste innerhalb 10 min anmelden d�rfen. Wenn sich jemand �fter als hier angegeben anmeldet, wird dessen IP gesperrt.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modul out of�rDoS/Crawler Checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','setzt die Verzeichnisnamen der Module, getrennt durch ein |. Diese Option ist bei Chatmodulen etc. hilfreich');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-31 12:07:31
define('_MI_PROTECTOR_PREFIXMANAGER','Pr�fix Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-05 07:09:09
define('_MI_PROTECTOR_GLOBAL_DISBL','Vor�bergehend deaktiviert');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Alle Sicherheitsfunktionen sind vor�bergehend deaktiviert!<br />Vergessen Sie nicht diese wieder einzuschalten, wenn Sie eine St�rung beseitigt haben!');
define('_MI_PROTECTOR_LOG_LEVEL','Logging level');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','nichts');
define('_MI_PROTECTOR_LOGLEVEL15','still');
define('_MI_PROTECTOR_LOGLEVEL63','still');
define('_MI_PROTECTOR_LOGLEVEL255','voll');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-18 18:41:12
define('_MI_PROTECTOR_DOSOPT_HTA','DENY by .htaccess(experimental)');

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief�rdescription of�rthis module
define("_MI_PROTECTOR_DESC","Dieses Modul sch�tzt vor Angriffen auf�rIhre Xoops-Seite (DoS , SQL Injektion und Variablen Infektionen)<br />Sie m�ssen diesen Block oben links anzeigen lassen und den anonymen Usern den Zugriff�rauf�rdiesen Block gestatten.");

// Names of�rblocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Dieser Block sollte oben links stehen und auf�rALLEN SEITEN angezeigt werden.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Protect Center");
define("_MI_PROTECTOR_ADVISORY","Sicherheitsberatung");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Block & Gruppen Admin");

// Configs
define('_MI_PROTECTOR_HIJACK_DENYGP','Gruppen denen das �ndern der IP innerhalb einer Session untersagt wird.');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Session Hi-Jacking:<br />W�hlen sie Gruppen aus, denen es untersagt ist, ihre IP w�hrend einer Session zu �ndern..<br />(Mindestens Administrator-Gruppe wird empfohlen.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Sanitizing (S�uberung) null-bytes');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Das Abschluss-Zeichen "\\0" wird oft in Attacken verwendet.<br />Dieses Null-Byte wird in ein Leerzeichen konvertiert.<br />(Einschalten wird dringendst empfohlen!)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Beenden, wenn Null-Bytes gefunden werden');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Das Abschluss-Zeichen "\\0" wird oft in Attacken verwendet.<br />(Dringendst empfohlen)');
define('_MI_PROTECTOR_DIE_BADEXT','Beenden, wenn unzul�ssgige Dateien hochgeladen werden');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Wenn jemand versucht, Dateien mit unzul�ssigen Endungen wie .php hochzuladen, beendet diese Modul den Zugriff�rauf�rXOOPS.<br />Wenn Sie oft Dateien in B-Wiki oder PukiWikiMod einstellen, schalten Sie diese Option aus.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Ma�nahmen, wenn eine Verunreinigung gefunden wurde:');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','W�hlen Sie eine Aktion aus, wenn jemand versucht, globale XOOPS-Variablen zu verunreinigen.<br />(Empfohlen wird "Wei�er Bildschirm")');
define('_MI_PROTECTOR_ISOCOM_ACTION','Ma�nahmen, wenn eine isolierte Einkommentierung gefunden wurde:');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />W�hlen Sie eine Massnahme aus, die ergriffen wird, wenn ein  isoliertes "/*" gefunden wird.<br />"Sanitizing (S�uberung)" bedeutet, ein zus�tzliches  "*/" anzuh�ngen.<br />(Empfohlen wird "Sanitizing (S�uberung)" )');
define('_MI_PROTECTOR_UNION_ACTION','Massnahme wenn ein UNION gefunden wurde.');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />W�hlen sie eine Massnahme, wenn ein SQL-Befehl wie UNION gefunden wurde.<br />"Sanitizing (S�uberung)" bedeutet die �nderung von "union" nach "uni-on".<br />(Empfohlen wird Sanitizing (S�uberung))');
define('_MI_PROTECTOR_ID_INTVAL','Erzwinge intval f�r Variablen wie ID�s');
define('_MI_PROTECTOR_ID_INTVALDSC','Alle Anfragen mit Namen "*id" Werden als Integer behandelt.<br />Diese Option besch�tzt sie vor einigen Arten der XSS-(Cross Site Scripting-) und SQL-Injection-Attacken.<br />Obwohl empfohlen wird, diese Option einzuschalten, kann es in einigen Modulen Probleme damit geben.');
define('_MI_PROTECTOR_FILE_DOTDOT','Behebe zweifelhafte Dateiangaben');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Eliminiertalle ".." aus Anfragen, die nach Dateien suchen');

define('_MI_PROTECTOR_DOS_EXPIRE','Zeitlimit f�r hohe Serverlast (Sekunden)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Dieser Wert gibt das Zeitlimit f�r rasch wiederholte Reloads der Seite (F5 Attacke) und f�rSuchmaschinen mit hoher Last an.');

define('_MI_PROTECTOR_DOS_F5COUNT','Anzahl als sch�dlich eingestufter Reloads');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','verhindert DoS Attacken.<br />Der Wert gibt an, wieviele Reloads (F5) als Attacke eingestuft werden.');
define('_MI_PROTECTOR_DOS_F5ACTION','Ma�nahmen gegen F5 Attacke');

define('_MI_PROTECTOR_DOS_CRCOUNT','Anzahl als sch�dlich eingestufter Suchmaschinen-Abfragen');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Sch�tzt vor Server-intensiven Abfragen durch Suchmaschinen.<br />Dieser Wert gibt an, wieviele Zugriffe als Server-intensiv eingestuft werden.');
define('_MI_PROTECTOR_DOS_CRACTION','Ma�nahmen gegen Server-intensive Suchmaschinen');

define('_MI_PROTECTOR_DOS_CRSAFE','Zugelassene User-Agents');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Ein regul��er Perl-Ausdruck f�rUser-Agents.<br />Wenn der Ausdruck zutrifft, wird die Suchmaschine niemals als Server-intensiv eingestuft.<br />Bsp: (msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Keine (nur logging)');
define('_MI_PROTECTOR_OPT_SAN','Sanitizing (S�uberung)');
define('_MI_PROTECTOR_OPT_EXIT','Wei�er Bildschirm');
define('_MI_PROTECTOR_OPT_BIP','IP sperren');

define('_MI_PROTECTOR_DOSOPT_NONE','Keine (nur logging)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep');
define('_MI_PROTECTOR_DOSOPT_EXIT','Wei�er Bildschirm');
define('_MI_PROTECTOR_DOSOPT_BIP','IP sperren');

define('_MI_PROTECTOR_BIP_EXCEPT','Gruppen, die niemals als "schlechte IP" eingestuft werden.');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Ein User, der in dieser Gruppe ist, wird niemals eine IP-Sperre erfahren.<br />(Empfohlen wird, die Administartor-Gruppe anzugeben.)');
define('_MI_PROTECTOR_PATCH2092','Spezielle Ma�nahmen f�rXOOPS <= 2.0.9.2');
define('_MI_PROTECTOR_PASSWD_BIP','Notfall-Passwort (hebt IP-Sperre auf)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Wenn Sie Ihre IP gesperrt wird, rufen Sie XOOPS_URL/modules/protector/admin/rescue.php und geben dort das Notfall-Passwort ein.<br />Vergessen Sie nicht, das Passwort zu setzen, bevor sie aufgrund eines Fehlers gesperrt werden.<br />Ist diese Option leer, wird die IP-Sperre nicht funktionieren.');

?>
