<?php
// Module Info

// The name of this module





// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:21
define('_MI_PROTECTOR_DISABLES','Disable dangerous features in XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:35
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','set IPs you can rely separated with | . ^ matches the head of string, $ matches the tail of string.');
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','set the dirnames of the modules separated with |. This option will be useful with chatting module etc.');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-31 12:07:31
define('_MI_PROTECTOR_PREFIXMANAGER','Prefix Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-05 07:09:09
define('_MI_PROTECTOR_GLOBAL_DISBL','Temporary disabled');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','All protections are disabled in temporary.<br />Don\'t forget turn this off after shooting the trouble');
define('_MI_PROTECTOR_LOG_LEVEL','Logging level');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','none');
define('_MI_PROTECTOR_LOGLEVEL15','Quiet');
define('_MI_PROTECTOR_LOGLEVEL63','quiet');
define('_MI_PROTECTOR_LOGLEVEL255','full');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-18 18:41:12
define('_MI_PROTECTOR_DOSOPT_HTA','DENY by .htaccess(Experimental)');

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Dieses Modul schützt vor Angriffen auf Ihre Xoops-Seite (DoS , SQL Injection , und Variables contaminations)<br />Sie müssen diesen Block oben links anzeigen lassen und den anonymen Usern den Zugriff auf diesen Block gestatten.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Dieser Block sollte oben links stehen und auf ALLEN SEITEN angezeigt werden.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Protect Center");
define("_MI_PROTECTOR_ADVISORY","Sicherheitsberatung");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Block&Gruppen Admin");

// Configs
define('_MI_PROTECTOR_HIJACK_DENYGP','Gruppen denen das ändern der IP innerhalb einer Session untersagt wird.');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Session Hi-Jacking:<br />Wählen sie Gruppen aus, denen es untersagt ist, ihre IP während einer Session zu ändern..<br />(Mindestens Administrator-Gruppe wird empfohlen.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Sanitizing (Säuberung) null-bytes');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Das Abschluss-Zeichen "\\0" wird oft in Attacken verwendet.<br />Dieses Null-Byte wird in ein Leerzeichen konvertiert.<br />(Einschalten wird dringendst empfohlen!)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Beenden, wenn Null-Bytes gefunden werden');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','TDas Abschluss-Zeichen "\\0" wird oft in Attacken verwendet.<br />(Dringendst empfohlen)');
define('_MI_PROTECTOR_DIE_BADEXT','Beenden, wenn unzulässige Dateien hochgeladen werden');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Wenn jemand versucht, Dateien mit unzulässigen Endungen wie .php hochzuladen, beendet diese Modul den Zugriff auf XOOPS.<br />Wenn Sie oft Dateien in B-Wiki oder PukiWikiMod einstellen, schalten Sie diese Option aus.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Massnahmen, wenn eine Verunreinigung gefunden wurde:');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Wählen Sie eine Aktion aus, wenn jemand versucht, globale XOOPS-Variablen zu verunreinigen.<br />(Empfohlen wird "Weisser Bildschirm")');
define('_MI_PROTECTOR_ISOCOM_ACTION','AMassnahmen, wenn eine isolierte Einkommentierung gefunden wurde:');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Wählen Sie eine Massnahme aus, die ergriffen wird, wenn ein  isoliertes "/*" gefunden wird.<br />"Sanitizing (Säuberung)" bedeutet, ein zusätzliches  "*/" anzuhängen.<br />(Empfohlen wird "Sanitizing (Säuberung)" )');
define('_MI_PROTECTOR_UNION_ACTION','Massnahme wenn ein UNION gefunden wurde.');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Wählen sie eine Massnahme, wenn ein SQL-Befehl wie UNION gefunden wurde.<br />"Sanitizing (Säuberung)" bedeutet die Änderung von "union" nach "uni-on".<br />(Empfohlen wird Sanitizing (Säuberung))');
define('_MI_PROTECTOR_ID_INTVAL','Erzwinge intval für Variablen wie ID´s');
define('_MI_PROTECTOR_ID_INTVALDSC','Alle Anfragen mit Namen "*id" Werden als Integer behandelt.<br />Diese Option beschützt sie vor einigen Arten der XSS-(Cross Site Scripting-) und SQL-Injection-Attacken.<br />Obwohl empfohlen wird, diese Option einzuschalten, kann es in einigen Modulen Probleme damit geben.');
define('_MI_PROTECTOR_FILE_DOTDOT','Behebe zweifelhafte Dateiangaben');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Eliminiertalle ".." aus Anfragen, die nach Dateien suchen');

define('_MI_PROTECTOR_DOS_EXPIRE','Zeitlimit für hohe Serverlast (sec)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Dieser Wert gibt das Zeitlimit für rasch wiederholte reloads der Seite (F5 Attacke) und für Suchmaschinen mit hoher Last an.');

define('_MI_PROTECTOR_DOS_F5COUNT','Anzahl als schädlich eingestufter Reloads');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','verhindert DoS Attacken.<br />Der Wert gibt an, wieviele Reloads (F5) als Attacke eingestuft werden.');
define('_MI_PROTECTOR_DOS_F5ACTION','Massnahmen gegen F5 Attacke');

define('_MI_PROTECTOR_DOS_CRCOUNT','Anzahl als schädlich eingestufter Suchmaschinen-Abfragen');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Schützt vor Server-intensiven Abfragen durch Suchmaschinen.<br />Dieser Wert gibt an, wieviele Zugriffe als Server-intensiv eingestuft werden.');
define('_MI_PROTECTOR_DOS_CRACTION','Massnahmen gegen Server-intensive Suchmaschinen');

define('_MI_PROTECTOR_DOS_CRSAFE','Zugelassene User-Agents');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Ein regulärer Perl-Ausdruck für User-Agents.<br />Wenn der Ausdruck zutrifft, wird die Suchmaschine niemals als Server-intensiv eingestuft.<br />Bsp: (msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Keine (nur logging)');
define('_MI_PROTECTOR_OPT_SAN','Sanitizing (Säuberung)');
define('_MI_PROTECTOR_OPT_EXIT','Weisser Bildschirm');
define('_MI_PROTECTOR_OPT_BIP','IP sperren');

define('_MI_PROTECTOR_DOSOPT_NONE','Keine (nur logging)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep');
define('_MI_PROTECTOR_DOSOPT_EXIT','Weisser Bildschirm');
define('_MI_PROTECTOR_DOSOPT_BIP','IP sperren');

define('_MI_PROTECTOR_BIP_EXCEPT','Gruppen, die niemals als "schlechte IP" eingestuft werden.');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Ein User, der in dieser Gruppe ist, wird niemals eine IP-Sperre erfahren.<br />(Empfohlen wird, die Administartor-Gruppe anzugeben.)');
define('_MI_PROTECTOR_PATCH2092','Spezielle Massnahmen für XOOPS <= 2.0.9.2');
define('_MI_PROTECTOR_PASSWD_BIP','Notfall-Passwort (hebt IP-Sperre auf)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Wenn Sie Ihre IP gesperrt wird, rufen Sie XOOPS_URL/modules/protector/admin/rescue.php und geben dort das Notfall-Passwort ein.<br />Vergessen Sie nicht, das Passwort zu setzen, bevor sie aufgrund eines Fehlers gesperrt werden.<br />Ist diese Option leer, wird die IP-Sperre nicht funktionieren.');

?>
