<?php
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Modu�� zabezpieczaj��cy Xoopsa, przed r��nymi rodzajami atak�� z sieci, takich jak: DoS , SQL Injection i ska��eniem zmiennych.<br />\nWszystkie grupy powinny mie� ustawiony dost�� do tego modu��u, a zw��aszcza grupa Go��ci.");

// Names of blocks for this module (Not all module has blocks) 
// added by webfm for polish translation : From version 2.4 Protector hasn`t blocks
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Ten blok powinien ��adowa� si� jako pierwszy od g��y po prawej stronie na wszystkich stronach serwisu.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Centrum zabezpiecze�");
define("_MI_PROTECTOR_ADVISORY","Porady bezpiecze��twa");
define("_MI_PROTECTOR_PREFIXMANAGER","Manager Prefixu");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','Tymczasowo wy����czony');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Wszystkie zabezpieczenia zostan�� wy����czone.<br />nie zapomnij w����czy� ich ponownie, gdy uporasz si� z problemem');
define('_MI_PROTECTOR_RELIABLE_IPS','IP godne zaufania');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','Wprowad�� adresy IP godne zaufania oddzielaj��c je | . ^ zast��uje pocz��tek ci��gu cyfr, $ zast��uje koniec ci��gu cyfr.');
define('_MI_PROTECTOR_LOG_LEVEL','Poziom logowania');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','brak');
define('_MI_PROTECTOR_LOGLEVEL15','Ciche');
define('_MI_PROTECTOR_LOGLEVEL63','ciche');
define('_MI_PROTECTOR_LOGLEVEL255','pe��ne');
define('_MI_PROTECTOR_HIJACK_TOPBIT','Zabezpieczenie bit�� IP dla sesji.');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Zabezpieczenie przed kradzie���� sesji:<br />Domy��lnie 32(bit). (Wszystkie bity zabezpieczone)<br />Je��li Twoje IP nie jest sta��e, ustaw zakres IP.<br />(n.p.) Je��li Twoje IP mo��e zmienia� si� w zakresie 192.168.0.0-192.168.0.255, ustaw tutaj 24 bity');
define('_MI_PROTECTOR_HIJACK_DENYGP','Grupy, kt��e nie mog�� zmieni� IP podczas sesji');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','zabezpieczenie przed porwaniem sesji:<br />Zaznacz grup�, kt��a nie mo��e zmieni� IP w czasie sesji.<br />(Nale��y zaznaczy� co najmniej Administrator��.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Czyszczenie pustych bajt��');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Znak zako��zenia "\\0" jest zwykle u��ywany w spreparowanych niszcz��cych kodach.<br />pusty bajt b��zie zmieniony na spacj�.<br />(nale��y bezwzgl��nie ustawi� t�� opcj� na w����czon��)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Wyjd�� je��li stwierdzone zostan�� puste bajty');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Znak zako��zenia "\\0" jest zwykle u��ywany podczas atak�� na serwisy.<br />(nale��y suatwi� t�� opcj� w����czon��)');
define('_MI_PROTECTOR_DIE_BADEXT','Wyjd�� je��li stwierdzono pr��� uploadowania podejrzanego pliku');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Je��li kto�� b��zie pr��owa�� wys��a� na serwer plik ze z��ym rozszerzeniem n.p.: .php , nast��pi wyj��cie z XOOPS.<br />Je��li cz��to wysy��asz pliki php na u��ytek n.p.: B-Wiki lub PukiWikiModule, wy����cz t�� opcj�.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Dzia��anie w przypadku wykrycia pr��y ska��enia zmiennych');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Wybierz dzia��anie, jakie system podejmie po pr��ie ska��enia zmiennych globalnych w XOOPS.<br />(sugerowane dzia��anie to Bia��a Strona)');
define('_MI_PROTECTOR_ISOCOM_ACTION','Wybierz dzia��anie, jakie system podejmie po wykryciu pr��y przekazania odseparowanych komentarzy ');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Przeciwdzia��anie SQL Injection:<br />Wybierz dzia��anie gdy b��zie wprowadzony odseparowany znak "/*".<br />"Neutralizowanie" polega na dodaniu nast��nego znaku "*/".<br />(sygerowana opcja to Neutralizowanie)');
define('_MI_PROTECTOR_UNION_ACTION','Wybierz dzia��anie gdy nastapi pr��a dodania instrukcji UNION lub podobnej.');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Przeciwdzia��anie SQL Injection:<br />wybierz dzia��anie gdy w zapytaniu pojawi si� sk��adnia podobna instrukcji UNION w SQL.<br />"Neutralizowanie" w tym przypadku polega na zmianie wyra��enia "union" na "uni-on".<br />(sugerowana opcja to Neutralizowanie)');
define('_MI_PROTECTOR_ID_INTVAL','Wymuszanie liczby ca��kowitej dla zapyta� zawieraj��cych zmienne typu id');
define('_MI_PROTECTOR_ID_INTVALDSC','Wszystkie zapytania zawieraj��ce "*id" b�Ŏ� traktowane jak liczba ca��kowita.<br />Ta opcja ochroni nas przed niekt��ymi typami atak�� typu XSS i SQL Injections.<br />Zaleca si� w����czenie tej opcj ale mo��e ona spowodowa� zak��ucenie dzia��ania niekt��ych modu����.');
define('_MI_PROTECTOR_FILE_DOTDOT','Zabezpieczenie przed w��rowaniem po katalogach');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Usuwa ".." z wszystkich zapyta� wygl��daj��cych jak szperanie po katalogach');
define('_MI_PROTECTOR_BF_COUNT','Zabezpieczenie przed atakiem Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Ustal ilo��� dozwolonych pr�� logowania u��ytkownika w ci��gu 10 minut. Je��li kto�� b��zie pr��owa�� logowa� si� wi��ej razy w tym czasie, jego IP zostanie zbanowane.');

define('_MI_PROTECTOR_DOS_SKIPMODS','Modu��y nie podlegaj��ce zabezpieczeniu anty DoS');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','wpisz nazwy katalog�� wy����czonych modu���� oddzielone |. Opcja u��yteczna dla modu��u czata itp.');

define('_MI_PROTECTOR_DOS_EXPIRE','Licznik czasu dla wielokrotnego prze��adowania strony (sec)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Warto��� czasu w sekundach, podczas kt��ego system monitoruje, czy prze��adowania strony nie s�� atakiem F5 lub dzia��aniem nieprzyjaznego robota (Crawlera).');

define('_MI_PROTECTOR_DOS_F5COUNT','Licznik ods��on dla ataku F5');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Ochrona przed atakiem DoS.<br />Powyzej tej warto��ci prze��adowa� system uzna, ��e ma do czynienia z atakiem F5 (DoS).');
define('_MI_PROTECTOR_DOS_F5ACTION','Dzia��anie po wykryciu pr��y ataku F5');

define('_MI_PROTECTOR_DOS_CRCOUNT','Licznik ods��on dla Crawler�� (robot�� przeci����aj��cych system)');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Zabezpieczenie przed robotami przeci����aj��cymi system.<br />Ta warto��� okre��la kiedy liczba ods��on dla robota zostanie uznana za przegi��ie.');
define('_MI_PROTECTOR_DOS_CRACTION','Akcja przeciwko "m��z��cym" robotom');

define('_MI_PROTECTOR_DOS_CRSAFE','Roboty indeksuj��ce wy����czone spod kontroli');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Etykieta w pearlu dla maszyn indeksuj��cych.<br />Je��li b��zie si� pokrywa�, crawler nigdy nie zostanie uznany za "m��z��cy".<br />eg) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Nic (tylko logowanie)');
define('_MI_PROTECTOR_OPT_SAN','Neutralizowanie');
define('_MI_PROTECTOR_OPT_EXIT','Bia��a Strona');
define('_MI_PROTECTOR_OPT_BIP','Banuj IP');

define('_MI_PROTECTOR_DOSOPT_NONE','Nic (tylko logowanie)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','U��pienie');
define('_MI_PROTECTOR_DOSOPT_EXIT','Bia��y Ekran');
define('_MI_PROTECTOR_DOSOPT_BIP','Banuj IP');
define('_MI_PROTECTOR_DOSOPT_HTA','ZABRO�� (DENY) w pliku .htaccess(Experymentalnie)');

define('_MI_PROTECTOR_BIP_EXCEPT','Grupy, kt��e nigdy nie zostan�� dodane jako Z��e IP');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Uzytkownicy nale����cy do zaznaczonej grupy(grup) nigdy nie b�Ŏ� mieli banowanego IP.<br />(ustaw co najmniej Administrator��.)');
define('_MI_PROTECTOR_PATCH2092','Specjalna ��ata dla Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_DISABLES','Wy����cz niebezpieczne funkcje w XOOPS');
define('_MI_PROTECTOR_PASSWD_BIP','Has��o ratunkowe (wy����czaj��ce bana na IP)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Je��eli jakim�� cudem zostaniesz zbanowany ze swojego w��asnego serwisu, wejd�� poprzez XOOPS_URL/modules/protector/admin/rescue.php i wpisz to has��o.<br />Powniene�� ustawi� to has��o zaraz po zainstalowaniu modu��u, a zanim przez jak���� pomy��k� zbanujesz si� ze swojej w��asnej strony.<br />Je��li pozostawisz puste, skrypt odbanowuj��cy nigdy nie zadzia��a.<br />Zalecenie: U��ywaj innego has��a, ni�� podstawowe has��o administratora!.');

?>
