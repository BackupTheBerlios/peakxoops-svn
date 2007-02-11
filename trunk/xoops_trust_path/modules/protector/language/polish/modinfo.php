<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'protector' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Xoops Protector");

// A brief description of this module
define($constpref."_DESC","Modu� zabezpieczaj�cy Xoopsa, przed r�nymi rodzajami atak�w z sieci, takich jak: DoS , SQL Injection i ska�eniem zmiennych.");

// Menu
define($constpref."_ADMININDEX","Centrum zabezpiecze�");
define($constpref."_ADVISORY","Porady bezpiecze�stwa");
define($constpref."_PREFIXMANAGER","Manager Prefixu");

// Configs
define($constpref.'_GLOBAL_DISBL','Tymczasowo wy��czony');
define($constpref.'_GLOBAL_DISBLDSC','Wszystkie zabezpieczenia zostan� wy��czone.<br />nie zapomnij w��czy� ich ponownie, gdy uporasz si� z problemem');

define($constpref.'_RELIABLE_IPS','IP godne zaufania');
define($constpref.'_RELIABLE_IPSDSC','Wprowad� adresy IP godne zaufania oddzielaj�c je | . ^ zast��uje pocz�tek ci�gu cyfr, $ zast��uje koniec ci�gu cyfr.');

define($constpref.'_LOG_LEVEL','Poziom logowania');
define($constpref.'_LOG_LEVELDSC','');

define($constpref.'_LOGLEVEL0','brak');
define($constpref.'_LOGLEVEL15','Ciche');
define($constpref.'_LOGLEVEL63','ciche');
define($constpref.'_LOGLEVEL255','pe�ne');

define($constpref.'_HIJACK_TOPBIT','Zabezpieczenie bit�u IP dla sesji.');
define($constpref.'_HIJACK_TOPBITDSC','Zabezpieczenie przed kradzie�� sesji:<br />Domy�lnie 32(bit). (Wszystkie bity zabezpieczone)<br />Je�li Twoje IP nie jest sta�e, ustaw zakres IP.<br />(n.p.) Je�li Twoje IP mo�e zmienia� si� w zakresie 192.168.0.0-192.168.0.255, ustaw tutaj 24 bity');
define($constpref.'_HIJACK_DENYGP','Grupy, kt��re nie mog� zmieni� IP podczas sesji');
define($constpref.'_HIJACK_DENYGPDSC','zabezpieczenie przed porwaniem sesji:<br />Zaznacz grup�, kt��ra nie mo�e zmieni� IP w czasie sesji.<br />(Nale�y zaznaczy� co najmniej Administrator�u.)');
define($constpref.'_SAN_NULLBYTE','Czyszczenie pustych bajt��w');
define($constpref.'_SAN_NULLBYTEDSC','Znak zako�czenia "\\0" jest zwykle u�ywany w spreparowanych niszcz�cych kodach.<br />pusty bajt b��zie zmieniony na spacj�.<br />(nale�y bezwzgl��nie ustawi� t� opcj� na w��czon�)');
define($constpref.'_DIE_NULLBYTE','Wyjd� je�li stwierdzone zostan� puste bajty');
define($constpref.'_DIE_NULLBYTEDSC','Znak zako�czenia "\\0" jest zwykle u�ywany podczas atak�u na serwisy.<br />(nale�y suatwi� t� opcj� w��czon�)');
define($constpref.'_DIE_BADEXT','Wyjd� je�li stwierdzono pr��b� uploadowania podejrzanego pliku');
define($constpref.'_DIE_BADEXTDSC','Je�li kto� b��zie pr��bowa� wys�a� na serwer plik ze z�ym rozszerzeniem n.p.: .php , nast�pi wyj�cie z XOOPS.<br />Je�li cz��to wysy�asz pliki php na u�ytek n.p.: B-Wiki lub PukiWikiModule, wy��cz t� opcj�.');
define($constpref.'_CONTAMI_ACTION','Dzia�anie w przypadku wykrycia pr��by ska�enia zmiennych');
define($constpref.'_CONTAMI_ACTIONDS','Wybierz dzia�anie, jakie system podejmie po pr��bie ska�enia zmiennych globalnych w XOOPS.<br />(sugerowane dzia�anie to Bia�a Strona)');
define($constpref.'_ISOCOM_ACTION','Wybierz dzia�anie, jakie system podejmie po wykryciu pr��by przekazania odseparowanych komentarzy ');
define($constpref.'_ISOCOM_ACTIONDSC','Przeciwdzia�anie SQL Injection:<br />Wybierz dzia�anie gdy b��zie wprowadzony odseparowany znak "/*".<br />"Neutralizowanie" polega na dodaniu nast��nego znaku "*/".<br />(sygerowana opcja to Neutralizowanie)');
define($constpref.'_UNION_ACTION','Wybierz dzia�anie gdy nastapi pr��ba dodania instrukcji UNION lub podobnej.');
define($constpref.'_UNION_ACTIONDSC','Przeciwdzia�anie SQL Injection:<br />wybierz dzia�anie gdy w zapytaniu pojawi si� sk�adnia podobna instrukcji UNION w SQL.<br />"Neutralizowanie" w tym przypadku polega na zmianie wyra�enia "union" na "uni-on".<br />(sugerowana opcja to Neutralizowanie)');
define($constpref.'_ID_INTVAL','Wymuszanie liczby ca�kowitej dla zapyta� zawieraj�cych zmienne typu id');
define($constpref.'_ID_INTVALDSC','Wszystkie zapytania zawieraj�ce "*id" b�ű traktowane jak liczba ca�kowita.<br />Ta opcja ochroni nas przed niekt��rymi typami atak�u typu XSS i SQL Injections.<br />Zaleca si� w��czenie tej opcj ale mo�e ona spowodowa� zak�ucenie dzia�ania niekt��rych modu��u.');
define($constpref.'_FILE_DOTDOT','Zabezpieczenie przed w��rowaniem po katalogach');
define($constpref.'_FILE_DOTDOTDSC','Usuwa ".." z wszystkich zapyta� wygl�daj�cych jak szperanie po katalogach');

define($constpref.'_BF_COUNT','Zabezpieczenie przed atakiem Brute Force');
define($constpref.'_BF_COUNTDSC','Ustal ilo�� dozwolonych pr��b logowania u�ytkownika w ci�gu 10 minut. Je�li kto� b��zie pr��bowa� logowa� si� wi��ej razy w tym czasie, jego IP zostanie zbanowane.');

define($constpref.'_DOS_SKIPMODS','Modu�y nie podlegaj�ce zabezpieczeniu anty DoS');
define($constpref.'_DOS_SKIPMODSDSC','wpisz nazwy katalog�u wy��czonych modu��u oddzielone |. Opcja u�yteczna dla modu�u czata itp.');

define($constpref.'_DOS_EXPIRE','Licznik czasu dla wielokrotnego prze�adowania strony (sec)');
define($constpref.'_DOS_EXPIREDSC','Warto�� czasu w sekundach, podczas kt��rego system monitoruje, czy prze�adowania strony nie s� atakiem F5 lub dzia�aniem nieprzyjaznego robota (Crawlera).');

define($constpref.'_DOS_F5COUNT','Licznik ods�on dla ataku F5');
define($constpref.'_DOS_F5COUNTDSC','Ochrona przed atakiem DoS.<br />Powyzej tej warto�ci prze�adowa� system uzna, �e ma do czynienia z atakiem F5 (DoS).');
define($constpref.'_DOS_F5ACTION','Dzia�anie po wykryciu pr��by ataku F5');

define($constpref.'_DOS_CRCOUNT','Licznik ods�on dla Crawler�u (robot�u przeci��aj�cych system)');
define($constpref.'_DOS_CRCOUNTDSC','Zabezpieczenie przed robotami przeci��aj�cymi system.<br />Ta warto�� okre�la kiedy liczba ods�on dla robota zostanie uznana za przegi��ie.');
define($constpref.'_DOS_CRACTION','Akcja przeciwko "m��z�cym" robotom');

define($constpref.'_DOS_CRSAFE','Roboty indeksuj�ce wy��czone spod kontroli');
define($constpref.'_DOS_CRSAFEDSC','Etykieta w pearlu dla maszyn indeksuj�cych.<br />Je�li b��zie si� pokrywa�, crawler nigdy nie zostanie uznany za "m��z�cy".<br />eg) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define($constpref.'_OPT_NONE','Nic (tylko logowanie)');
define($constpref.'_OPT_SAN','Neutralizowanie');
define($constpref.'_OPT_EXIT','Bia�a Strona');
define($constpref.'_OPT_BIP','Banuj IP');

define($constpref.'_DOSOPT_NONE','Nic (tylko logowanie)');
define($constpref.'_DOSOPT_SLEEP','U�pienie');
define($constpref.'_DOSOPT_EXIT','Bia�y Ekran');
define($constpref.'_DOSOPT_BIP','Banuj IP');
define($constpref.'_DOSOPT_HTA','ZABRO� (DENY) w pliku .htaccess(Experymentalnie)');

define($constpref.'_BIP_EXCEPT','Grupy, kt��re nigdy nie zostan� dodane jako Z�e IP');
define($constpref.'_BIP_EXCEPTDSC','Uzytkownicy nale��cy do zaznaczonej grupy(grup) nigdy nie b�ű mieli banowanego IP.<br />(ustaw co najmniej Administrator�u.)');

define($constpref.'_DISABLES','Wy��cz niebezpieczne rzeczy w XOOPS');

define($constpref.'_BIGUMBRELLA','W��cz anty-XSS (BigUmbrella)');
define($constpref.'_BIGUMBRELLADSC','Ochrania przed atakami XSS. Oczywi�cie 100% skuteczno�ci nie masz nigdy.');

define($constpref.'_SPAMURI4U','anti-SPAM: URL dla u�ytkownik�w');
define($constpref.'_SPAMURI4UDSC','Liczba dozwolonych adres�w URL przesy�anych metod� POST (formularze,forum...) przez u�ytkownik�w innych ni� admin. Je�eli u�ytkownik prze�le wi�ksz� liczb� adres�w URL post zostanie zakwalifikowany jako spam. Je�eli wpiszesz 0 -zero- funkcja jest wy��czona.');
define($constpref.'_SPAMURI4G','anti-SPAM: URL dla anonimowych/go�ci');
define($constpref.'_SPAMURI4GDSC','Liczba dozwolonych adres�w URL przesy�anych metod� POST (formularze,forum...) przez osoby niezarejestrowane. Je�eli go�� prze�le wi�ksz� liczb� adres�w URL post zostanie zakwalifikowany jako spam. Je�eli wpiszesz 0 -zero- funkcja jest wy��czona Zaleca si� ustawienie warto�ci na 5.');

}

?>