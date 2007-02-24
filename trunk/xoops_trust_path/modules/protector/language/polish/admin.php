<?php

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2007-02-24 17:45:41
define('_MD_A_MYMENU_MYTPLSADMIN','');
define('_MD_A_MYMENU_MYBLOCKSADMIN','Permissions');
define('_MD_A_MYMENU_MYPREFERENCES','Preferences');

define("_AM_TH_DATETIME","Czas");
define("_AM_TH_USER","U¿ytkownik");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Typ");
define("_AM_TH_DESCRIPTION","Opis");

define( "_AM_TH_BADIPS" , 'Zbanowane IP<br /><br /><span style="font-weight:normal;">Wpisz ka¿de IP w osobnej linii.<br />Pozostaw puste aby wy³±czyæ blokowanie IP.</span>' ) ;
define( "_AM_TH_GROUP1IPS" , 'Dozwolone IP dla grupy=1<br /><br /><span style="font-weight:normal;">Wpisz ka¿de IP w osobnej linii.<br />192.168. oznacza 192.168.*<br />Pozostaw puste aby wy³±czyæ blokowanie IP.</span>' ) ;


define( "_AM_LABEL_REMOVE" , "Usuñ zaznaczone wpisy:" ) ;
define( "_AM_BUTTON_REMOVE" , "Usuñ!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Na pewno?" ) ;
define( "_AM_MSG_PRUPDATED" , "Ustawienia zaktualizowane!" ) ;
define( "_AM_MSG_IPFILESUPDATED" , "Dane dotycz±ce IP zosta³y uaktualnione" ) ;
define( "_AM_MSG_BADIPSCANTOPEN" , "Dane dotycz±ce IP nie mog± zostaæ odczytane" ) ;
define( "_AM_MSG_GROUP1IPSCANTOPEN" , "Dane dotycz±ce IP dla grupy=1 nie mog± zostaæ odczytane" ) ;
define( "_AM_MSG_REMOVED" , "Zaznaczone wpisy zosta³y usuniête" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Manager prefixu" ) ;
define( "_AM_MSG_DBUPDATED" , "Baza danych zosta³a uaktualniona!" ) ;
define( "_AM_CONFIRM_DELETE" , "Wszystkie dane zostan± zrzucone. OK?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Je¶li chcesz zmieniæ prefix w bazie,<br /> wyedytuj %s/mainfile.php za pomoc± dowolnego edytora.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Niebezpieczne");

define("_AM_ADV_REGISTERGLOBALS","Takie ustawienie pozwala na wiele ataków typu injections.<br />Je¶li to mo¿liwe umie¶æ plik .htaccess, wyedytuj lub utwórz...");
define("_AM_ADV_ALLOWURLFOPEN","To ustawienie pozwala na wykonanie niechcianych skryptów na zdalnych serwerach.<br />tylko administrator serwera mo¿e zmieniæ t± opcje.<br />Je¿eli nim jeste¶, wyedytuj php.ini lub httpd.conf.<br /><b>Przyk³ad edycji httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Je¶li nie jeste¶ adminem serwera, popro¶ go o to!.");
define("_AM_ADV_USETRANSSID","Twoje ID sesji bêdzie widoczne w tagach odno¶ników.<br />Aby zabezpieczyæ siê przed kradzie¿± sesji, dodaj nastêpuj±c± liniê w pliku .htaccess w katalogu XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>");
define("_AM_ADV_DBPREFIX","Takie ustawienie pozwala na atak typu 'SQL Injections'.<br />Nie zapomnij uaktywniæ w ustawieniach opcji 'Wymuszone czyszczanie *'.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Przejd¥ do managera prefixu");
define("_AM_ADV_MAINUNPATCHED","Powiniene¶ wyedytowaæ plik mainfile.php tak jak napisano w pliku README.");

define("_AM_ADV_SUBTITLECHECK","Sprawd¥, czy Protector dzia³a poprawnie.");
define("_AM_ADV_CHECKCONTAMI","Zanieczyszczenie danych");
define("_AM_ADV_CHECKISOCOM","Odseparowanie komentarzy");



?>
