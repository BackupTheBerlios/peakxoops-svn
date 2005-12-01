<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MB_LOADED' ) ) {




// Appended by Xoops Language Checker -GIJOE- in 2005-08-31 15:23:36
define('_ALBM_STORETIMESTAMP','Don\'t touch timestamp');
define('_ALBM_TELLAFRIEND','Tell a friend');
define('_ALBM_SUBJECT4TAF','A photo for you!');

// Appended by Xoops Language Checker -GIJOE- in 2004-10-04 16:06:33
define('_ALBM_LIDASC','Record Number (Bigger is latter)');
define('_ALBM_LIDDESC','Record Number (Smaller is latter)');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:55
define('_ALBM_BTN_SELECTALL','Markera Alla');
define('_ALBM_BTN_SELECTNONE','Markera Ingen');
define('_ALBM_BTN_SELECTRVS','Markera Omv��da');
define('_ALBM_FMT_PHOTONUM','%s p� varje sida');
define('_ALBM_AM_BUTTON_UPDATE','Editera');
define('_ALBM_NOIMAGESPECIFIED','Fel: Inga foto har laddats upp.');
define('_ALBM_FILEREADERROR','Fel: Fotona �� inte l��bara.');
define('_ALBM_DIRECTCATSEL','V��j en kategori');

define( 'MYALBUM_MB_LOADED' , 1 ) ;

//%%%%%%		Module Name 'MyAlbum-P'		%%%%%

// New in MyAlbum-p

// only "Y/m/d" , "d M Y" , "M d Y" can be interpreted
define( "_ALBM_DTFMT_YMDHI" , "d M Y H:i" ) ;

define( "_ALBM_NEXT_BUTTON" , "N��ta" ) ;
define( "_ALBM_REDOLOOPDONE" , "Klart." ) ;

define( "_ALBM_AM_ADMISSION" , "Godk��n foto" ) ;
define( "_ALBM_AM_ADMITTING" , "Godk��nda foto" ) ;
define( "_ALBM_AM_LABEL_ADMIT" , "Godk��n det markerade fotot " ) ;
define( "_ALBM_AM_BUTTON_ADMIT" , "Godk��n" ) ;
define( "_ALBM_AM_BUTTON_EXTRACT" , "Packa upp" ) ;

define( "_ALBM_AM_PHOTOMANAGER" , "Foto Manager" ) ;
define( "_ALBM_AM_PHOTONAVINFO" , "Foto nr. %s-%s (av totalt %s foto tr��far)" ) ;
define( "_ALBM_AM_LABEL_REMOVE" , "Ta bort markerade foto " ) ;
define( "_ALBM_AM_BUTTON_REMOVE" , "Ta bort!" ) ;
define( "_ALBM_AM_JS_REMOVECONFIRM" , "OK att ta bort?" ) ;
define( "_ALBM_AM_LABEL_MOVE" , "Byta kategori p� markerade foto " ) ;
define( "_ALBM_AM_BUTTON_MOVE" , "Flytta" ) ;
define( "_ALBM_AM_DEADLINKMAINPHOTO" , "Orginal bilden finns inte " ) ;

define( "_ALBM_RADIO_ROTATETITLE" , "Bild Rotering" ) ;
define( "_ALBM_RADIO_ROTATE0" , "ingen vridning" ) ;
define( "_ALBM_RADIO_ROTATE90" , "vrid h��er" ) ;
define( "_ALBM_RADIO_ROTATE180" , "vrid 180 grader" ) ;
define( "_ALBM_RADIO_ROTATE270" , "vrid v��ster" ) ;


// New MyAlbum 1.0.1 (and 1.2.0)
define("_ALBM_MOREPHOTOS","Mer foto fr�� %s");
define("_ALBM_REDOTHUMBS","G�� om Miniatyrer (<a href='redothumbs.php'>re-start</a>)");
define("_ALBM_REDOTHUMBSINFO","F��stort antal kan leda till server time out.");
define("_ALBM_REDOTHUMBSNUMBER","Antal miniatyrer �� g��gen");
define("_ALBM_REDOING","G��s om: ");
define("_ALBM_BACK","Tillbaka");
define("_ALBM_ADDPHOTO","L��g till Foto");


// New MyAlbum 1.0.0
define("_ALBM_PHOTOBATCHUPLOAD","Registrera foto redan uppladdade till servern");
define("_ALBM_PHOTOUPLOAD","Ladda upp Foto");
define("_ALBM_PHOTOEDITUPLOAD","Editera Foto och ladda upp igen");
define("_ALBM_MAXPIXEL","Max pixel storlek");
define("_ALBM_MAXSIZE","Max fil storlek");
define("_ALBM_PHOTOTITLE","Titel");
define("_ALBM_PHOTOPATH","S��v��");
define("_ALBM_TEXT_DIRECTORY","Katalog");
define("_ALBM_DESC_PHOTOPATH","Skriv komplett s��v�� till katalogen som inneh��ler foto som skall registreras");
define("_ALBM_MES_INVALIDDIRECTORY","Ogiltig s��v�� angiven.");
define("_ALBM_MES_BATCHDONE","%s foto(n) har registrerats.");
define("_ALBM_MES_BATCHNONE","Inga foto hittades i katalogen.");
define("_ALBM_PHOTODESC","Beskrivning");
define("_ALBM_PHOTOCAT","Kategori");
define("_ALBM_SELECTFILE","V��j foto");
define("_ALBM_FILEERROR","Inget foto uppladdat eller s� �� fotot f�� stort");

define("_ALBM_BATCHBLANK","L��na titeln tom f�� att anv��da filnamnet som titel");
define("_ALBM_DELETEPHOTO","Radera?");
define("_ALBM_VALIDPHOTO","Godk��d");
define("_ALBM_PHOTODEL","Radera foto?");
define("_ALBM_DELETINGPHOTO","Raderar foto");
define("_ALBM_MOVINGPHOTO","Flyttar foto");

define("_ALBM_POSTERC","Publicerare: ");
define("_ALBM_DATEC","Datum: ");
define("_ALBM_EDITNOTALLOWED","Ni har inte till��else att editera denna kommentar!");
define("_ALBM_ANONNOTALLOWED","Anonyma anv��dare f�� inte publicera h��.");
define("_ALBM_THANKSFORPOST","Tack f�� ditt bidrag!");
define("_ALBM_DELNOTALLOWED","Ni har inte till��else att redera denna kommentar!");
define("_ALBM_GOBACK","G� tillbaka");
define("_ALBM_AREYOUSURE","��r Ni s��er p� att Ni vill radera denna kommentar och alla efterf��jande kommentarer?");
define("_ALBM_COMMENTSDEL","Radering av Kommentar(er) Lyckades!");

// End New

define("_ALBM_THANKSFORINFO","Tack f�� informationen. Vi kommer att ta hand om Er f��fr��an inom kort.");
define("_ALBM_BACKTOTOP","Tillbaka till Foto");
define("_ALBM_THANKSFORHELP","Tack f�� att Ni hj��per till att uppr��th��la katalogens integritet.");
define("_ALBM_FORSECURITY","P� grund av s��erhets sk�� s� lagras Ert namn och IP adress tillf��ligt.");

define("_ALBM_MATCH","Exakt matchning");
define("_ALBM_ALL","Alla");
define("_ALBM_ANY","N��on");
define("_ALBM_NAME","Namn");
define("_ALBM_DESCRIPTION","Beskrivning");

define("_ALBM_MAIN","Index");
define("_ALBM_POPULAR","Popul��");
define("_ALBM_TOPRATED","Topprankad");

define("_ALBM_POPULARITYLTOM","Popul��ast (Minst till Flest tr��far)");
define("_ALBM_POPULARITYMTOL","Popul��ast (Flest till Minst tr��far)");
define("_ALBM_TITLEATOZ","Titel (A to ��)");
define("_ALBM_TITLEZTOA","Titel (�� to A)");
define("_ALBM_DATEOLD","Datum (Gamla foto listas f��st)");
define("_ALBM_DATENEW","Datum (Nya foto listas f��st)");
define("_ALBM_RATINGLTOH","Bed��ning (L��sta resultat till H��sta resultat)");
define("_ALBM_RATINGHTOL","Bed��ning (H��sta resultat till L��sta resultat)");

define("_ALBM_NOSHOTS","Ingen sk��mdump tillg��glig");
define("_ALBM_EDITTHISPHOTO","Editera detta Foto");

define("_ALBM_DESCRIPTIONC","Beskrivning: ");
define("_ALBM_EMAILC","E-post: ");
define("_ALBM_CATEGORYC","Kategori: ");
define("_ALBM_SUBCATEGORY","Underkategorier: ");
define("_ALBM_LASTUPDATEC","Uppdaterad senast: ");
define("_ALBM_HITSC","Tr��far: ");
define("_ALBM_RATINGC","Bed��ning: ");
define("_ALBM_ONEVOTE","1 r��t");
define("_ALBM_NUMVOTES","%s r��ter");
define("_ALBM_ONEPOST","1 publicering");
define("_ALBM_NUMPOSTS","%s publiceringar");
define("_ALBM_COMMENTSC","Kommentarer: ");
define("_ALBM_RATETHISPHOTO","Bed�� detta foto");
define("_ALBM_MODIFY","Modifiera");
define("_ALBM_VSCOMMENTS","Titta/Skicka Kommentarer");

define("_ALBM_THEREARE","D�� �� <b>%s</b> foto i v�� databas.");
define("_ALBM_LATESTLIST","Senaste publiceringar");

define("_ALBM_VOTEAPPRE","Er r��t �� uppskattad.");
define("_ALBM_THANKURATE","Tack f�� att Ni tar Er tid att bed��ma ett foto h�� p� %s.");
define("_ALBM_VOTEONCE","Var sn��l och r��ta inte p� samma foto flera g��ger.");
define("_ALBM_RATINGSCALE","Bed��ningsskalan �� 1 - 10, d�� 1 �� d��ig och 10 �� brilliant.");
define("_ALBM_BEOBJECTIVE","F��s�� att vara objektiv, om alla f�� en 1 eller en 10 s� �� inte bed��ningen s��skilt anv��dbar.");
define("_ALBM_DONOTVOTE","R��ta inte p� Era egna foto.");
define("_ALBM_RATEIT","R��ta!");

define("_ALBM_RECEIVED","Vi har mottagit Ert foto, tack!");
define("_ALBM_ALLPENDING","Alla foto publiceras efter verifiering/granskning.");

define("_ALBM_RANK","Placering");
define("_ALBM_CATEGORY","Kategori");
define("_ALBM_HITS","Tr��far");
define("_ALBM_RATING","Bed��mning");
define("_ALBM_VOTE","R��ta");
define("_ALBM_TOP10","%s Topp 10"); // %s is a photo category title

define("_ALBM_SORTBY","Sorterad p�:");
define("_ALBM_TITLE","Titel");
define("_ALBM_DATE","Datum");
define("_ALBM_POPULARITY","Popul��itet");
define("_ALBM_CURSORTEDBY","Foto sorterade p�: %s");
define("_ALBM_FOUNDIN","Hittade i:");
define("_ALBM_PREVIOUS","F��eg��nde");
define("_ALBM_NEXT","N��ta");
define("_ALBM_NOMATCH","Finns inga foto som Ni efterfr��ade");

define("_ALBM_CATEGORIES","Kategorier");

define("_ALBM_SUBMIT","Skicka");
define("_ALBM_CANCEL","Avbryt");

define("_ALBM_MUSTREGFIRST","Beklagar, Ni har inte till��else att utf��a denna procedur.<br>V��ligen registrera Er eller logga in f��st!");
define("_ALBM_MUSTADDCATFIRST","Beklagar, Ni har inga kategorier att l��ga till i ��nu.<br>V��ligen skapa en kategori f��st!");
define("_ALBM_NORATING","Ingen bed��mning vald.");
define("_ALBM_CANTVOTEOWN","Ni kan inte r��ta p� en bild som Ni sj��va har skickat in.<br>Alla r��ter loggas och kontrolleras.");
define("_ALBM_VOTEONCE2","R��ta bara en g��g p� det valda fotot.<br>Alla r��ter loggas och kontrolleras.");

//%%%%%%	Module Name 'MyAlbum' (Admin)	  %%%%%

define("_ALBM_PHOTOSWAITING","Foto som v��tar p� Validering");
define("_ALBM_PHOTOMANAGER","Foto underh��l");
define("_ALBM_CATEDIT","L��g till, Modifiera och Radera Kategorier");
define("_ALBM_CHECKCONFIGS","Kontrollera Konfiguration&Milj�");
define("_ALBM_BATCHUPLOAD","Batch Uppladdningar");
define("_ALBM_GENERALSET","Inst��lningar f�� myAlbum-P");
define("_ALBM_REDOTHUMBS2","G�� om Miniatyrer");

define("_ALBM_SUBMITTER","Inskickad av");
define("_ALBM_DELETE","Radera");
define("_ALBM_NOSUBMITTED","Inga nypublicerade Foto.");
define("_ALBM_ADDMAIN","L��g till en HUVUD Kategori");
define("_ALBM_IMGURL","Bild URL (FRIVILLIG, bildh��den kommer att ��dras till 50): ");
define("_ALBM_ADD","L��g till");
define("_ALBM_ADDSUB","L��g till en Underkategori");
define("_ALBM_IN","i");
define("_ALBM_MODCAT","Modifiera Kategori");
define("_ALBM_DBUPDATED","Uppdateringen av databasen lyckades!");
define("_ALBM_MODREQDELETED","F��fr��an om modifiering raderad.");
define("_ALBM_IMGURLMAIN","Bild URL (FRIVILLIG och ENDAST giltig f�� huvudkategorier. Bildh��den kommer att ��dras till 50): ");
define("_ALBM_PARENT","��vergripande kategori:");
define("_ALBM_SAVE","Spara ��dringarna");
define("_ALBM_CATDELETED","Kategori Raderad.");
define("_ALBM_CATDEL_WARNING","VARNING: ��r Ni s��er p� att Ni vill radera denna Kategori och ALLA dess Foto och Kommentarer?");
define("_ALBM_YES","Ja");
define("_ALBM_NO","Nej");
define("_ALBM_NEWCATADDED","Ny Kategori sparad!");
define("_ALBM_ERROREXIST","FEL: Fotot som Ni skickade in finns redan i databasen!");
define("_ALBM_ERRORTITLE","FEL: Ni m��te ange en TITEL!");
define("_ALBM_ERRORDESC","Fel: Ni m��te ange en BESKRIVNING!");
define("_ALBM_WEAPPROVED","Vi godk��ner Ert inskickade bidrag till foto databasen.");
define("_ALBM_THANKSSUBMIT","Tack f�� Ert bidrag!");
define("_ALBM_CONFUPDATED","Uppdateringen av Konfigurationen lyckades!");
?>
<?php
// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_ALBM_NEW','Ny');
define('_ALBM_UPDATED','Uppdaterad');
define('_ALBM_GROUPPERM_GLOBAL','Globala R��tigheter');

}

?>
