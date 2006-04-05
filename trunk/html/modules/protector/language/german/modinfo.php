<?php
// Module Info

// The name ofürthis module







// Appended by Xoops Language Checker -GIJOE- in 2006-04-06 05:04:58
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_MI_PROTECTOR_HIJACK_TOPBIT','Geschützte IP bits für dieses Session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (Alle Bits sind geschützt)<br />Wenn Sie keine statische IP Adresse haben, setzen Sie den IP Bereich mit Nummer der einzelnen Bits.<br />(eg) Wenn sich Ihre IP im Bereich von 192.168.0.0 bis 192.168.0.255 befindet, setzen Sie 24(bit) hier');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:21
define('_MI_PROTECTOR_DISABLES','Deaktiviert die Sicherheitsfeatures von Protector in XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:35
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','Sie können IP Adressen mit einem | trennen. ^ setzt den Kopfürdes String, $ setzt das Ende des Strings.');
define('_MI_PROTECTOR_Bfür_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_Bfür_COUNTDSC','Setzt die Anzahl, wie oft sich Gäste innerhalb 10 min anmelden dürfen. Wenn sich jemand öfter als hier angegeben anmeldet, wird dessen IP gesperrt.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modul out ofürDoS/Crawler Checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','setzt die Verzeichnisnamen der Module, getrennt durch ein |. Diese Option ist bei Chatmodulen etc. hilfreich');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-31 12:07:31
define('_MI_PROTECTOR_PREFIXMANAGER','Präfix Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-05 07:09:09
define('_MI_PROTECTOR_GLOBAL_DISBL','Vorübergehend deaktiviert');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Alle Sicherheitsfunktionen sind vorübergehend deaktiviert!<br />Vergessen Sie nicht diese wieder einzuschalten, wenn Sie eine Störung beseitigt haben!');
define('_MI_PROTECTOR_LOG_LEVEL','Logging level');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','nichts');
define('_MI_PROTECTOR_LOGLEVEL15','still');
define('_MI_PROTECTOR_LOGLEVEL63','still');
define('_MI_PROTECTOR_LOGLEVEL255','voll');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-18 18:41:12
define('_MI_PROTECTOR_DOSOPT_HTA','DENY by .htaccess(experimental)');

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A briefürdescription ofürthis module
define("_MI_PROTECTOR_DESC","Dieses Modul schützt vor Angriffen aufürIhre Xoops-Seite (DoS , SQL Injektion und Variablen Infektionen)<br />Sie müssen diesen Block oben links anzeigen lassen und den anonymen Usern den Zugriffüraufürdiesen Block gestatten.");

// Names ofürblocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Dieser Block sollte oben links stehen und aufürALLEN SEITEN angezeigt werden.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Protect Center");
define("_MI_PROTECTOR_ADVISORY","Sicherheitsberatung");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Block & Gruppen Admin");

// Configs
define('_MI_PROTECTOR_HIJACK_DENYGP','Gruppen denen das Ändern der IP innerhalb einer Session untersagt wird.');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Session Hi-Jacking:<br />Wählen sie Gruppen aus, denen es untersagt ist, ihre IP während einer Session zu ändern..<br />(Mindestens Administrator-Gruppe wird empfohlen.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Sanitizing (Säuberung) null-bytes');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Das Abschluss-Zeichen "\\0" wird oft in Attacken verwendet.<br />Dieses Null-Byte wird in ein Leerzeichen konvertiert.<br />(Einschalten wird dringendst empfohlen!)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Beenden, wenn Null-Bytes gefunden werden');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Das Abschluss-Zeichen "\\0" wird oft in Attacken verwendet.<br />(Dringendst empfohlen)');
define('_MI_PROTECTOR_DIE_BADEXT','Beenden, wenn unzulässgige Dateien hochgeladen werden');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Wenn jemand versucht, Dateien mit unzulässigen Endungen wie .php hochzuladen, beendet diese Modul den ZugriffüraufürXOOPS.<br />Wenn Sie oft Dateien in B-Wiki oder PukiWikiMod einstellen, schalten Sie diese Option aus.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Maßnahmen, wenn eine Verunreinigung gefunden wurde:');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Wählen Sie eine Aktion aus, wenn jemand versucht, globale XOOPS-Variablen zu verunreinigen.<br />(Empfohlen wird "Weißer Bildschirm")');
define('_MI_PROTECTOR_ISOCOM_ACTION','Maßnahmen, wenn eine isolierte Einkommentierung gefunden wurde:');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Wählen Sie eine Massnahme aus, die ergriffen wird, wenn ein  isoliertes "/*" gefunden wird.<br />"Sanitizing (Säuberung)" bedeutet, ein zusätzliches  "*/" anzuhängen.<br />(Empfohlen wird "Sanitizing (Säuberung)" )');
define('_MI_PROTECTOR_UNION_ACTION','Massnahme wenn ein UNION gefunden wurde.');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Wählen sie eine Massnahme, wenn ein SQL-Befehl wie UNION gefunden wurde.<br />"Sanitizing (Säuberung)" bedeutet die Änderung von "union" nach "uni-on".<br />(Empfohlen wird Sanitizing (Säuberung))');
define('_MI_PROTECTOR_ID_INTVAL','Erzwinge intval für Variablen wie ID´s');
define('_MI_PROTECTOR_ID_INTVALDSC','Alle Anfragen mit Namen "*id" Werden als Integer behandelt.<br />Diese Option beschützt sie vor einigen Arten der XSS-(Cross Site Scripting-) und SQL-Injection-Attacken.<br />Obwohl empfohlen wird, diese Option einzuschalten, kann es in einigen Modulen Probleme damit geben.');
define('_MI_PROTECTOR_FILE_DOTDOT','Behebe zweifelhafte Dateiangaben');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Eliminiertalle ".." aus Anfragen, die nach Dateien suchen');

define('_MI_PROTECTOR_DOS_EXPIRE','Zeitlimit für hohe Serverlast (Sekunden)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Dieser Wert gibt das Zeitlimit für rasch wiederholte Reloads der Seite (F5 Attacke) und fürSuchmaschinen mit hoher Last an.');

define('_MI_PROTECTOR_DOS_F5COUNT','Anzahl als schädlich eingestufter Reloads');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','verhindert DoS Attacken.<br />Der Wert gibt an, wieviele Reloads (F5) als Attacke eingestuft werden.');
define('_MI_PROTECTOR_DOS_F5ACTION','Maßnahmen gegen F5 Attacke');

define('_MI_PROTECTOR_DOS_CRCOUNT','Anzahl als schädlich eingestufter Suchmaschinen-Abfragen');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Schützt vor Server-intensiven Abfragen durch Suchmaschinen.<br />Dieser Wert gibt an, wieviele Zugriffe als Server-intensiv eingestuft werden.');
define('_MI_PROTECTOR_DOS_CRACTION','Maßnahmen gegen Server-intensive Suchmaschinen');

define('_MI_PROTECTOR_DOS_CRSAFE','Zugelassene User-Agents');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Ein regulçÓer Perl-Ausdruck fürUser-Agents.<br />Wenn der Ausdruck zutrifft, wird die Suchmaschine niemals als Server-intensiv eingestuft.<br />Bsp: (msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Keine (nur logging)');
define('_MI_PROTECTOR_OPT_SAN','Sanitizing (Säuberung)');
define('_MI_PROTECTOR_OPT_EXIT','Weißer Bildschirm');
define('_MI_PROTECTOR_OPT_BIP','IP sperren');

define('_MI_PROTECTOR_DOSOPT_NONE','Keine (nur logging)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep');
define('_MI_PROTECTOR_DOSOPT_EXIT','Weißer Bildschirm');
define('_MI_PROTECTOR_DOSOPT_BIP','IP sperren');

define('_MI_PROTECTOR_BIP_EXCEPT','Gruppen, die niemals als "schlechte IP" eingestuft werden.');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Ein User, der in dieser Gruppe ist, wird niemals eine IP-Sperre erfahren.<br />(Empfohlen wird, die Administartor-Gruppe anzugeben.)');
define('_MI_PROTECTOR_PATCH2092','Spezielle Maßnahmen fürXOOPS <= 2.0.9.2');
define('_MI_PROTECTOR_PASSWD_BIP','Notfall-Passwort (hebt IP-Sperre auf)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Wenn Sie Ihre IP gesperrt wird, rufen Sie XOOPS_URL/modules/protector/admin/rescue.php und geben dort das Notfall-Passwort ein.<br />Vergessen Sie nicht, das Passwort zu setzen, bevor sie aufgrund eines Fehlers gesperrt werden.<br />Ist diese Option leer, wird die IP-Sperre nicht funktionieren.');

?>
