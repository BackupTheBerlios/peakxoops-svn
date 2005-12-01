<?php
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Modué≥ zabezpieczajé±cy Xoopsa, przed rÜ¡nymi rodzajami atakÖÿ z sieci, takich jak: DoS , SQL Injection i skaéøeniem zmiennych.<br />\nWszystkie grupy powinny mieÊ ustawiony dostÛ— do tego modué≥u, a zwé≥aszcza grupa Goé∂ci.");

// Names of blocks for this module (Not all module has blocks) 
// added by webfm for polish translation : From version 2.4 Protector hasn`t blocks
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Ten blok powinien é≥adowaÊ siÍ jako pierwszy od gÖ”y po prawej stronie na wszystkich stronach serwisu.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Centrum zabezpieczeÒ");
define("_MI_PROTECTOR_ADVISORY","Porady bezpieczeÅ‘twa");
define("_MI_PROTECTOR_PREFIXMANAGER","Manager Prefixu");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','Tymczasowo wyé≥é±czony');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Wszystkie zabezpieczenia zostané± wyé≥é±czone.<br />nie zapomnij wé≥é±czyÊ ich ponownie, gdy uporasz siÍ z problemem');
define('_MI_PROTECTOR_RELIABLE_IPS','IP godne zaufania');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','Wprowadéº adresy IP godne zaufania oddzielajé±c je | . ^ zastÛ—uje poczé±tek cié±gu cyfr, $ zastÛ—uje koniec cié±gu cyfr.');
define('_MI_PROTECTOR_LOG_LEVEL','Poziom logowania');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','brak');
define('_MI_PROTECTOR_LOGLEVEL15','Ciche');
define('_MI_PROTECTOR_LOGLEVEL63','ciche');
define('_MI_PROTECTOR_LOGLEVEL255','peé≥ne');
define('_MI_PROTECTOR_HIJACK_TOPBIT','Zabezpieczenie bitÖÿ IP dla sesji.');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Zabezpieczenie przed kradzieéøé± sesji:<br />Domyé∂lnie 32(bit). (Wszystkie bity zabezpieczone)<br />Jeé∂li Twoje IP nie jest staé≥e, ustaw zakres IP.<br />(n.p.) Jeé∂li Twoje IP moéøe zmieniaÊ siÍ w zakresie 192.168.0.0-192.168.0.255, ustaw tutaj 24 bity');
define('_MI_PROTECTOR_HIJACK_DENYGP','Grupy, ktÖ”e nie mogé± zmieniÊ IP podczas sesji');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','zabezpieczenie przed porwaniem sesji:<br />Zaznacz grupÍ, ktÖ”a nie moéøe zmieniÊ IP w czasie sesji.<br />(Naleéøy zaznaczyÊ co najmniej AdministratorÖÿ.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Czyszczenie pustych bajtÖÿ');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Znak zakoÅƒzenia "\\0" jest zwykle uéøywany w spreparowanych niszczé±cych kodach.<br />pusty bajt bÛ≈zie zmieniony na spacjÍ.<br />(naleéøy bezwzglÛ≈nie ustawiÊ té± opcjÍ na wé≥é±czoné±)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Wyjdé° jeé∂li stwierdzone zostané± puste bajty');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Znak zakoÅƒzenia "\\0" jest zwykle uéøywany podczas atakÖÿ na serwisy.<br />(naleéøy suatwiÊ té± opcjÍ wé≥é±czoné±)');
define('_MI_PROTECTOR_DIE_BADEXT','Wyjdé° jeé∂li stwierdzono prÖ√Í uploadowania podejrzanego pliku');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Jeé∂li ktoé∂ bÛ≈zie prÖ√owaé≥ wysé≥aÊ na serwer plik ze zé≥ym rozszerzeniem n.p.: .php , nasté±pi wyjé∂cie z XOOPS.<br />Jeé∂li czÛ‘to wysyé≥asz pliki php na uéøytek n.p.: B-Wiki lub PukiWikiModule, wyé≥é±cz té± opcjÍ.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Dziaé≥anie w przypadku wykrycia prÖ√y skaéøenia zmiennych');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Wybierz dziaé≥anie, jakie system podejmie po prÖ√ie skaéøenia zmiennych globalnych w XOOPS.<br />(sugerowane dziaé≥anie to Biaé≥a Strona)');
define('_MI_PROTECTOR_ISOCOM_ACTION','Wybierz dziaé≥anie, jakie system podejmie po wykryciu prÖ√y przekazania odseparowanych komentarzy ');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Przeciwdziaé≥anie SQL Injection:<br />Wybierz dziaé≥anie gdy bÛ≈zie wprowadzony odseparowany znak "/*".<br />"Neutralizowanie" polega na dodaniu nastÛ—nego znaku "*/".<br />(sygerowana opcja to Neutralizowanie)');
define('_MI_PROTECTOR_UNION_ACTION','Wybierz dziaé≥anie gdy nastapi prÖ√a dodania instrukcji UNION lub podobnej.');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Przeciwdziaé≥anie SQL Injection:<br />wybierz dziaé≥anie gdy w zapytaniu pojawi siÍ ské≥adnia podobna instrukcji UNION w SQL.<br />"Neutralizowanie" w tym przypadku polega na zmianie wyraéøenia "union" na "uni-on".<br />(sugerowana opcja to Neutralizowanie)');
define('_MI_PROTECTOR_ID_INTVAL','Wymuszanie liczby caé≥kowitej dla zapytaÒ zawierajé±cych zmienne typu id');
define('_MI_PROTECTOR_ID_INTVALDSC','Wszystkie zapytania zawierajé±ce "*id" bÛ≈é± traktowane jak liczba caé≥kowita.<br />Ta opcja ochroni nas przed niektÖ”ymi typami atakÖÿ typu XSS i SQL Injections.<br />Zaleca siÍ wé≥é±czenie tej opcj ale moéøe ona spowodowaÊ zaké≥ucenie dziaé≥ania niektÖ”ych modué≥Öÿ.');
define('_MI_PROTECTOR_FILE_DOTDOT','Zabezpieczenie przed wÛ≈rowaniem po katalogach');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Usuwa ".." z wszystkich zapytaÒ wyglé±dajé±cych jak szperanie po katalogach');
define('_MI_PROTECTOR_BF_COUNT','Zabezpieczenie przed atakiem Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Ustal iloé∂Ê dozwolonych prÖ√ logowania uéøytkownika w cié±gu 10 minut. Jeé∂li ktoé∂ bÛ≈zie prÖ√owaé≥ logowaÊ siÍ wiÛƒej razy w tym czasie, jego IP zostanie zbanowane.');

define('_MI_PROTECTOR_DOS_SKIPMODS','Modué≥y nie podlegajé±ce zabezpieczeniu anty DoS');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','wpisz nazwy katalogÖÿ wyé≥é±czonych modué≥Öÿ oddzielone |. Opcja uéøyteczna dla modué≥u czata itp.');

define('_MI_PROTECTOR_DOS_EXPIRE','Licznik czasu dla wielokrotnego przeé≥adowania strony (sec)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Wartoé∂Ê czasu w sekundach, podczas ktÖ”ego system monitoruje, czy przeé≥adowania strony nie sé± atakiem F5 lub dziaé≥aniem nieprzyjaznego robota (Crawlera).');

define('_MI_PROTECTOR_DOS_F5COUNT','Licznik odsé≥on dla ataku F5');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Ochrona przed atakiem DoS.<br />Powyzej tej wartoé∂ci przeé≥adowaÒ system uzna, éøe ma do czynienia z atakiem F5 (DoS).');
define('_MI_PROTECTOR_DOS_F5ACTION','Dziaé≥anie po wykryciu prÖ√y ataku F5');

define('_MI_PROTECTOR_DOS_CRCOUNT','Licznik odsé≥on dla CrawlerÖÿ (robotÖÿ przecié±éøajé±cych system)');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Zabezpieczenie przed robotami przecié±éøajé±cymi system.<br />Ta wartoé∂Ê okreé∂la kiedy liczba odsé≥on dla robota zostanie uznana za przegiÛƒie.');
define('_MI_PROTECTOR_DOS_CRACTION','Akcja przeciwko "mÛƒzé±cym" robotom');

define('_MI_PROTECTOR_DOS_CRSAFE','Roboty indeksujé±ce wyé≥é±czone spod kontroli');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Etykieta w pearlu dla maszyn indeksujé±cych.<br />Jeé∂li bÛ≈zie siÍ pokrywaÊ, crawler nigdy nie zostanie uznany za "mÛƒzé±cy".<br />eg) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Nic (tylko logowanie)');
define('_MI_PROTECTOR_OPT_SAN','Neutralizowanie');
define('_MI_PROTECTOR_OPT_EXIT','Biaé≥a Strona');
define('_MI_PROTECTOR_OPT_BIP','Banuj IP');

define('_MI_PROTECTOR_DOSOPT_NONE','Nic (tylko logowanie)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Ué∂pienie');
define('_MI_PROTECTOR_DOSOPT_EXIT','Biaé≥y Ekran');
define('_MI_PROTECTOR_DOSOPT_BIP','Banuj IP');
define('_MI_PROTECTOR_DOSOPT_HTA','ZABROé— (DENY) w pliku .htaccess(Experymentalnie)');

define('_MI_PROTECTOR_BIP_EXCEPT','Grupy, ktÖ”e nigdy nie zostané± dodane jako Zé≥e IP');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Uzytkownicy naleéøé±cy do zaznaczonej grupy(grup) nigdy nie bÛ≈é± mieli banowanego IP.<br />(ustaw co najmniej AdministratorÖÿ.)');
define('_MI_PROTECTOR_PATCH2092','Specjalna é≥ata dla Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_DISABLES','Wyé≥é±cz niebezpieczne funkcje w XOOPS');
define('_MI_PROTECTOR_PASSWD_BIP','Hasé≥o ratunkowe (wyé≥é±czajé±ce bana na IP)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Jeéøeli jakimé∂ cudem zostaniesz zbanowany ze swojego wé≥asnego serwisu, wejdé• poprzez XOOPS_URL/modules/protector/admin/rescue.php i wpisz to hasé≥o.<br />Pownieneé∂ ustawiÊ to hasé≥o zaraz po zainstalowaniu modué≥u, a zanim przez jaké±é∂ pomyé≥kÍ zbanujesz siÍ ze swojej wé≥asnej strony.<br />Jeé∂li pozostawisz puste, skrypt odbanowujé±cy nigdy nie zadziaé≥a.<br />Zalecenie: Uéøywaj innego hasé≥a, niéø podstawowe hasé≥o administratora!.');

?>
