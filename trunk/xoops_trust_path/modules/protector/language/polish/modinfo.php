<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'protector' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Xoops Protector");

// A brief description of this module
define($constpref."_DESC","Modu³ zabezpieczaj±cy Xoopsa, przed ró¿nymi rodzajami ataków z sieci, takich jak: DoS , SQL Injection i ska¿eniem zmiennych.");

// Menu
define($constpref."_ADMININDEX","Centrum zabezpieczeñ");
define($constpref."_ADVISORY","Porady bezpieczeñstwa");
define($constpref."_PREFIXMANAGER","Manager Prefixu");

// Configs
define($constpref.'_GLOBAL_DISBL','Tymczasowo wy³±czony');
define($constpref.'_GLOBAL_DISBLDSC','Wszystkie zabezpieczenia zostan± wy³±czone.<br />nie zapomnij w³±czyæ ich ponownie, gdy uporasz siê z problemem');

define($constpref.'_RELIABLE_IPS','IP godne zaufania');
define($constpref.'_RELIABLE_IPSDSC','Wprowad¼ adresy IP godne zaufania oddzielaj±c je | . ^ zastóÑuje pocz±tek ci±gu cyfr, $ zastóÑuje koniec ci±gu cyfr.');

define($constpref.'_LOG_LEVEL','Poziom logowania');
define($constpref.'_LOG_LEVELDSC','');

define($constpref.'_LOGLEVEL0','brak');
define($constpref.'_LOGLEVEL15','Ciche');
define($constpref.'_LOGLEVEL63','ciche');
define($constpref.'_LOGLEVEL255','pe³ne');

define($constpref.'_HIJACK_TOPBIT','Zabezpieczenie bit…u IP dla sesji.');
define($constpref.'_HIJACK_TOPBITDSC','Zabezpieczenie przed kradzie¿± sesji:<br />Domy¶lnie 32(bit). (Wszystkie bity zabezpieczone)<br />Je¶li Twoje IP nie jest sta³e, ustaw zakres IP.<br />(n.p.) Je¶li Twoje IP mo¿e zmieniaæ siê w zakresie 192.168.0.0-192.168.0.255, ustaw tutaj 24 bity');
define($constpref.'_HIJACK_DENYGP','Grupy, kt…óre nie mog± zmieniæ IP podczas sesji');
define($constpref.'_HIJACK_DENYGPDSC','zabezpieczenie przed porwaniem sesji:<br />Zaznacz grupê, kt…óra nie mo¿e zmieniæ IP w czasie sesji.<br />(Nale¿y zaznaczyæ co najmniej Administrator…u.)');
define($constpref.'_SAN_NULLBYTE','Czyszczenie pustych bajt…ów');
define($constpref.'_SAN_NULLBYTEDSC','Znak zakoñczenia "\\0" jest zwykle u¿ywany w spreparowanych niszcz±cych kodach.<br />pusty bajt bóÅzie zmieniony na spacjê.<br />(nale¿y bezwzglóÅnie ustawiæ t± opcjê na w³±czon±)');
define($constpref.'_DIE_NULLBYTE','Wyjd¼ je¶li stwierdzone zostan± puste bajty');
define($constpref.'_DIE_NULLBYTEDSC','Znak zakoñczenia "\\0" jest zwykle u¿ywany podczas atak…u na serwisy.<br />(nale¿y suatwiæ t± opcjê w³±czon±)');
define($constpref.'_DIE_BADEXT','Wyjd¼ je¶li stwierdzono pr…óbê uploadowania podejrzanego pliku');
define($constpref.'_DIE_BADEXTDSC','Je¶li kto¶ bóÅzie pr…óbowa³ wys³aæ na serwer plik ze z³ym rozszerzeniem n.p.: .php , nast±pi wyj¶cie z XOOPS.<br />Je¶li czóÔto wysy³asz pliki php na u¿ytek n.p.: B-Wiki lub PukiWikiModule, wy³±cz t± opcjê.');
define($constpref.'_CONTAMI_ACTION','Dzia³anie w przypadku wykrycia pr…óby ska¿enia zmiennych');
define($constpref.'_CONTAMI_ACTIONDS','Wybierz dzia³anie, jakie system podejmie po pr…óbie ska¿enia zmiennych globalnych w XOOPS.<br />(sugerowane dzia³anie to Bia³a Strona)');
define($constpref.'_ISOCOM_ACTION','Wybierz dzia³anie, jakie system podejmie po wykryciu pr…óby przekazania odseparowanych komentarzy ');
define($constpref.'_ISOCOM_ACTIONDSC','Przeciwdzia³anie SQL Injection:<br />Wybierz dzia³anie gdy bóÅzie wprowadzony odseparowany znak "/*".<br />"Neutralizowanie" polega na dodaniu nastóÑnego znaku "*/".<br />(sygerowana opcja to Neutralizowanie)');
define($constpref.'_UNION_ACTION','Wybierz dzia³anie gdy nastapi pr…óba dodania instrukcji UNION lub podobnej.');
define($constpref.'_UNION_ACTIONDSC','Przeciwdzia³anie SQL Injection:<br />wybierz dzia³anie gdy w zapytaniu pojawi siê sk³adnia podobna instrukcji UNION w SQL.<br />"Neutralizowanie" w tym przypadku polega na zmianie wyra¿enia "union" na "uni-on".<br />(sugerowana opcja to Neutralizowanie)');
define($constpref.'_ID_INTVAL','Wymuszanie liczby ca³kowitej dla zapytañ zawieraj±cych zmienne typu id');
define($constpref.'_ID_INTVALDSC','Wszystkie zapytania zawieraj±ce "*id" bóÅ± traktowane jak liczba ca³kowita.<br />Ta opcja ochroni nas przed niekt…órymi typami atak…u typu XSS i SQL Injections.<br />Zaleca siê w³±czenie tej opcj ale mo¿e ona spowodowaæ zak³ucenie dzia³ania niekt…órych modu³…u.');
define($constpref.'_FILE_DOTDOT','Zabezpieczenie przed wóÅrowaniem po katalogach');
define($constpref.'_FILE_DOTDOTDSC','Usuwa ".." z wszystkich zapytañ wygl±daj±cych jak szperanie po katalogach');

define($constpref.'_BF_COUNT','Zabezpieczenie przed atakiem Brute Force');
define($constpref.'_BF_COUNTDSC','Ustal ilo¶æ dozwolonych pr…ób logowania u¿ytkownika w ci±gu 10 minut. Je¶li kto¶ bóÅzie pr…óbowa³ logowaæ siê wióÄej razy w tym czasie, jego IP zostanie zbanowane.');

define($constpref.'_DOS_SKIPMODS','Modu³y nie podlegaj±ce zabezpieczeniu anty DoS');
define($constpref.'_DOS_SKIPMODSDSC','wpisz nazwy katalog…u wy³±czonych modu³…u oddzielone |. Opcja u¿yteczna dla modu³u czata itp.');

define($constpref.'_DOS_EXPIRE','Licznik czasu dla wielokrotnego prze³adowania strony (sec)');
define($constpref.'_DOS_EXPIREDSC','Warto¶æ czasu w sekundach, podczas kt…órego system monitoruje, czy prze³adowania strony nie s± atakiem F5 lub dzia³aniem nieprzyjaznego robota (Crawlera).');

define($constpref.'_DOS_F5COUNT','Licznik ods³on dla ataku F5');
define($constpref.'_DOS_F5COUNTDSC','Ochrona przed atakiem DoS.<br />Powyzej tej warto¶ci prze³adowañ system uzna, ¿e ma do czynienia z atakiem F5 (DoS).');
define($constpref.'_DOS_F5ACTION','Dzia³anie po wykryciu pr…óby ataku F5');

define($constpref.'_DOS_CRCOUNT','Licznik ods³on dla Crawler…u (robot…u przeci±¿aj±cych system)');
define($constpref.'_DOS_CRCOUNTDSC','Zabezpieczenie przed robotami przeci±¿aj±cymi system.<br />Ta warto¶æ okre¶la kiedy liczba ods³on dla robota zostanie uznana za przegióÄie.');
define($constpref.'_DOS_CRACTION','Akcja przeciwko "móÄz±cym" robotom');

define($constpref.'_DOS_CRSAFE','Roboty indeksuj±ce wy³±czone spod kontroli');
define($constpref.'_DOS_CRSAFEDSC','Etykieta w pearlu dla maszyn indeksuj±cych.<br />Je¶li bóÅzie siê pokrywaæ, crawler nigdy nie zostanie uznany za "móÄz±cy".<br />eg) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define($constpref.'_OPT_NONE','Nic (tylko logowanie)');
define($constpref.'_OPT_SAN','Neutralizowanie');
define($constpref.'_OPT_EXIT','Bia³a Strona');
define($constpref.'_OPT_BIP','Banuj IP');

define($constpref.'_DOSOPT_NONE','Nic (tylko logowanie)');
define($constpref.'_DOSOPT_SLEEP','U¶pienie');
define($constpref.'_DOSOPT_EXIT','Bia³y Ekran');
define($constpref.'_DOSOPT_BIP','Banuj IP');
define($constpref.'_DOSOPT_HTA','ZABROÑ (DENY) w pliku .htaccess(Experymentalnie)');

define($constpref.'_BIP_EXCEPT','Grupy, kt…óre nigdy nie zostan± dodane jako Z³e IP');
define($constpref.'_BIP_EXCEPTDSC','Uzytkownicy nale¿±cy do zaznaczonej grupy(grup) nigdy nie bóÅ± mieli banowanego IP.<br />(ustaw co najmniej Administrator…u.)');

define($constpref.'_DISABLES','Wy³±cz niebezpieczne rzeczy w XOOPS');

define($constpref.'_BIGUMBRELLA','W³±cz anty-XSS (BigUmbrella)');
define($constpref.'_BIGUMBRELLADSC','Ochrania przed atakami XSS. Oczywi¶cie 100% skuteczno¶ci nie masz nigdy.');

define($constpref.'_SPAMURI4U','anti-SPAM: URL dla u¿ytkowników');
define($constpref.'_SPAMURI4UDSC','Liczba dozwolonych adresów URL przesy³anych metod± POST (formularze,forum...) przez u¿ytkowników innych ni¿ admin. Je¿eli u¿ytkownik prze¶le wiêksz± liczbê adresów URL post zostanie zakwalifikowany jako spam. Je¿eli wpiszesz 0 -zero- funkcja jest wy³±czona.');
define($constpref.'_SPAMURI4G','anti-SPAM: URL dla anonimowych/go¶ci');
define($constpref.'_SPAMURI4GDSC','Liczba dozwolonych adresów URL przesy³anych metod± POST (formularze,forum...) przez osoby niezarejestrowane. Je¿eli go¶æ prze¶le wiêksz± liczbê adresów URL post zostanie zakwalifikowany jako spam. Je¿eli wpiszesz 0 -zero- funkcja jest wy³±czona Zaleca siê ustawienie warto¶ci na 5.');

}

?>