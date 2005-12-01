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
define('_ALBM_BTN_SELECTRVS','Markera OmvçÏda');
define('_ALBM_FMT_PHOTONUM','%s på varje sida');
define('_ALBM_AM_BUTTON_UPDATE','Editera');
define('_ALBM_NOIMAGESPECIFIED','Fel: Inga foto har laddats upp.');
define('_ALBM_FILEREADERROR','Fel: Fotona çÓ inte lçÔbara.');
define('_ALBM_DIRECTCATSEL','VçÍj en kategori');

define( 'MYALBUM_MB_LOADED' , 1 ) ;

//%%%%%%		Module Name 'MyAlbum-P'		%%%%%

// New in MyAlbum-p

// only "Y/m/d" , "d M Y" , "M d Y" can be interpreted
define( "_ALBM_DTFMT_YMDHI" , "d M Y H:i" ) ;

define( "_ALBM_NEXT_BUTTON" , "NçÔta" ) ;
define( "_ALBM_REDOLOOPDONE" , "Klart." ) ;

define( "_ALBM_AM_ADMISSION" , "GodkçÏn foto" ) ;
define( "_ALBM_AM_ADMITTING" , "GodkçÏnda foto" ) ;
define( "_ALBM_AM_LABEL_ADMIT" , "GodkçÏn det markerade fotot " ) ;
define( "_ALBM_AM_BUTTON_ADMIT" , "GodkçÏn" ) ;
define( "_ALBM_AM_BUTTON_EXTRACT" , "Packa upp" ) ;

define( "_ALBM_AM_PHOTOMANAGER" , "Foto Manager" ) ;
define( "_ALBM_AM_PHOTONAVINFO" , "Foto nr. %s-%s (av totalt %s foto trçÇfar)" ) ;
define( "_ALBM_AM_LABEL_REMOVE" , "Ta bort markerade foto " ) ;
define( "_ALBM_AM_BUTTON_REMOVE" , "Ta bort!" ) ;
define( "_ALBM_AM_JS_REMOVECONFIRM" , "OK att ta bort?" ) ;
define( "_ALBM_AM_LABEL_MOVE" , "Byta kategori på markerade foto " ) ;
define( "_ALBM_AM_BUTTON_MOVE" , "Flytta" ) ;
define( "_ALBM_AM_DEADLINKMAINPHOTO" , "Orginal bilden finns inte " ) ;

define( "_ALBM_RADIO_ROTATETITLE" , "Bild Rotering" ) ;
define( "_ALBM_RADIO_ROTATE0" , "ingen vridning" ) ;
define( "_ALBM_RADIO_ROTATE90" , "vrid h‹Èer" ) ;
define( "_ALBM_RADIO_ROTATE180" , "vrid 180 grader" ) ;
define( "_ALBM_RADIO_ROTATE270" , "vrid vçÏster" ) ;


// New MyAlbum 1.0.1 (and 1.2.0)
define("_ALBM_MOREPHOTOS","Mer foto fréÏ %s");
define("_ALBM_REDOTHUMBS","G‹Ó om Miniatyrer (<a href='redothumbs.php'>re-start</a>)");
define("_ALBM_REDOTHUMBSINFO","F‹Óstort antal kan leda till server time out.");
define("_ALBM_REDOTHUMBSNUMBER","Antal miniatyrer éÕ géÏgen");
define("_ALBM_REDOING","G‹Ós om: ");
define("_ALBM_BACK","Tillbaka");
define("_ALBM_ADDPHOTO","LçÈg till Foto");


// New MyAlbum 1.0.0
define("_ALBM_PHOTOBATCHUPLOAD","Registrera foto redan uppladdade till servern");
define("_ALBM_PHOTOUPLOAD","Ladda upp Foto");
define("_ALBM_PHOTOEDITUPLOAD","Editera Foto och ladda upp igen");
define("_ALBM_MAXPIXEL","Max pixel storlek");
define("_ALBM_MAXSIZE","Max fil storlek");
define("_ALBM_PHOTOTITLE","Titel");
define("_ALBM_PHOTOPATH","S‹ÌvçÈ");
define("_ALBM_TEXT_DIRECTORY","Katalog");
define("_ALBM_DESC_PHOTOPATH","Skriv komplett s‹ÌvçÈ till katalogen som innehéÍler foto som skall registreras");
define("_ALBM_MES_INVALIDDIRECTORY","Ogiltig s‹ÌvçÈ angiven.");
define("_ALBM_MES_BATCHDONE","%s foto(n) har registrerats.");
define("_ALBM_MES_BATCHNONE","Inga foto hittades i katalogen.");
define("_ALBM_PHOTODESC","Beskrivning");
define("_ALBM_PHOTOCAT","Kategori");
define("_ALBM_SELECTFILE","VçÍj foto");
define("_ALBM_FILEERROR","Inget foto uppladdat eller så çÓ fotot f‹Ó stort");

define("_ALBM_BATCHBLANK","LçÎna titeln tom f‹Ó att anvçÏda filnamnet som titel");
define("_ALBM_DELETEPHOTO","Radera?");
define("_ALBM_VALIDPHOTO","GodkçÏd");
define("_ALBM_PHOTODEL","Radera foto?");
define("_ALBM_DELETINGPHOTO","Raderar foto");
define("_ALBM_MOVINGPHOTO","Flyttar foto");

define("_ALBM_POSTERC","Publicerare: ");
define("_ALBM_DATEC","Datum: ");
define("_ALBM_EDITNOTALLOWED","Ni har inte tilléÕelse att editera denna kommentar!");
define("_ALBM_ANONNOTALLOWED","Anonyma anvçÏdare féÓ inte publicera hçÓ.");
define("_ALBM_THANKSFORPOST","Tack f‹Ó ditt bidrag!");
define("_ALBM_DELNOTALLOWED","Ni har inte tilléÕelse att redera denna kommentar!");
define("_ALBM_GOBACK","Gå tillbaka");
define("_ALBM_AREYOUSURE","ŽÄr Ni sçÌer på att Ni vill radera denna kommentar och alla efterf‹Íjande kommentarer?");
define("_ALBM_COMMENTSDEL","Radering av Kommentar(er) Lyckades!");

// End New

define("_ALBM_THANKSFORINFO","Tack f‹Ó informationen. Vi kommer att ta hand om Er f‹ÓfréÈan inom kort.");
define("_ALBM_BACKTOTOP","Tillbaka till Foto");
define("_ALBM_THANKSFORHELP","Tack f‹Ó att Ni hjçÍper till att upprçÕthéÍla katalogens integritet.");
define("_ALBM_FORSECURITY","På grund av sçÌerhets skçÍ så lagras Ert namn och IP adress tillfçÍligt.");

define("_ALBM_MATCH","Exakt matchning");
define("_ALBM_ALL","Alla");
define("_ALBM_ANY","NéÈon");
define("_ALBM_NAME","Namn");
define("_ALBM_DESCRIPTION","Beskrivning");

define("_ALBM_MAIN","Index");
define("_ALBM_POPULAR","PopulçÓ");
define("_ALBM_TOPRATED","Topprankad");

define("_ALBM_POPULARITYLTOM","PopulçÓast (Minst till Flest trçÇfar)");
define("_ALBM_POPULARITYMTOL","PopulçÓast (Flest till Minst trçÇfar)");
define("_ALBM_TITLEATOZ","Titel (A to ŽÖ)");
define("_ALBM_TITLEZTOA","Titel (ŽÖ to A)");
define("_ALBM_DATEOLD","Datum (Gamla foto listas f‹Óst)");
define("_ALBM_DATENEW","Datum (Nya foto listas f‹Óst)");
define("_ALBM_RATINGLTOH","Bed‹Îning (LçÈsta resultat till H‹Èsta resultat)");
define("_ALBM_RATINGHTOL","Bed‹Îning (H‹Èsta resultat till LçÈsta resultat)");

define("_ALBM_NOSHOTS","Ingen skçÓmdump tillgçÏglig");
define("_ALBM_EDITTHISPHOTO","Editera detta Foto");

define("_ALBM_DESCRIPTIONC","Beskrivning: ");
define("_ALBM_EMAILC","E-post: ");
define("_ALBM_CATEGORYC","Kategori: ");
define("_ALBM_SUBCATEGORY","Underkategorier: ");
define("_ALBM_LASTUPDATEC","Uppdaterad senast: ");
define("_ALBM_HITSC","TrçÇfar: ");
define("_ALBM_RATINGC","Bed‹Îning: ");
define("_ALBM_ONEVOTE","1 r‹Ôt");
define("_ALBM_NUMVOTES","%s r‹Ôter");
define("_ALBM_ONEPOST","1 publicering");
define("_ALBM_NUMPOSTS","%s publiceringar");
define("_ALBM_COMMENTSC","Kommentarer: ");
define("_ALBM_RATETHISPHOTO","Bed‹Î detta foto");
define("_ALBM_MODIFY","Modifiera");
define("_ALBM_VSCOMMENTS","Titta/Skicka Kommentarer");

define("_ALBM_THEREARE","DçÓ çÓ <b>%s</b> foto i véÓ databas.");
define("_ALBM_LATESTLIST","Senaste publiceringar");

define("_ALBM_VOTEAPPRE","Er r‹Ôt çÓ uppskattad.");
define("_ALBM_THANKURATE","Tack f‹Ó att Ni tar Er tid att bed‹Îma ett foto hçÓ på %s.");
define("_ALBM_VOTEONCE","Var snçÍl och r‹Ôta inte på samma foto flera géÏger.");
define("_ALBM_RATINGSCALE","Bed‹Îningsskalan çÓ 1 - 10, dçÓ 1 çÓ déÍig och 10 çÓ brilliant.");
define("_ALBM_BEOBJECTIVE","F‹Ós‹Ì att vara objektiv, om alla féÓ en 1 eller en 10 så çÓ inte bed‹Îningen sçÓskilt anvçÏdbar.");
define("_ALBM_DONOTVOTE","R‹Ôta inte på Era egna foto.");
define("_ALBM_RATEIT","R‹Ôta!");

define("_ALBM_RECEIVED","Vi har mottagit Ert foto, tack!");
define("_ALBM_ALLPENDING","Alla foto publiceras efter verifiering/granskning.");

define("_ALBM_RANK","Placering");
define("_ALBM_CATEGORY","Kategori");
define("_ALBM_HITS","TrçÇfar");
define("_ALBM_RATING","Bed‹Îmning");
define("_ALBM_VOTE","R‹Ôta");
define("_ALBM_TOP10","%s Topp 10"); // %s is a photo category title

define("_ALBM_SORTBY","Sorterad på:");
define("_ALBM_TITLE","Titel");
define("_ALBM_DATE","Datum");
define("_ALBM_POPULARITY","PopulçÓitet");
define("_ALBM_CURSORTEDBY","Foto sorterade på: %s");
define("_ALBM_FOUNDIN","Hittade i:");
define("_ALBM_PREVIOUS","F‹ÓegéÆnde");
define("_ALBM_NEXT","NçÔta");
define("_ALBM_NOMATCH","Finns inga foto som Ni efterfréÈade");

define("_ALBM_CATEGORIES","Kategorier");

define("_ALBM_SUBMIT","Skicka");
define("_ALBM_CANCEL","Avbryt");

define("_ALBM_MUSTREGFIRST","Beklagar, Ni har inte tilléÕelse att utf‹Óa denna procedur.<br>VçÏligen registrera Er eller logga in f‹Óst!");
define("_ALBM_MUSTADDCATFIRST","Beklagar, Ni har inga kategorier att lçÈga till i çÏnu.<br>VçÏligen skapa en kategori f‹Óst!");
define("_ALBM_NORATING","Ingen bed‹Îmning vald.");
define("_ALBM_CANTVOTEOWN","Ni kan inte r‹Ôta på en bild som Ni sjçÍva har skickat in.<br>Alla r‹Ôter loggas och kontrolleras.");
define("_ALBM_VOTEONCE2","R‹Ôta bara en géÏg på det valda fotot.<br>Alla r‹Ôter loggas och kontrolleras.");

//%%%%%%	Module Name 'MyAlbum' (Admin)	  %%%%%

define("_ALBM_PHOTOSWAITING","Foto som vçÏtar på Validering");
define("_ALBM_PHOTOMANAGER","Foto underhéÍl");
define("_ALBM_CATEDIT","LçÈg till, Modifiera och Radera Kategorier");
define("_ALBM_CHECKCONFIGS","Kontrollera Konfiguration&Miljö");
define("_ALBM_BATCHUPLOAD","Batch Uppladdningar");
define("_ALBM_GENERALSET","InstçÍlningar f‹Ó myAlbum-P");
define("_ALBM_REDOTHUMBS2","G‹Ó om Miniatyrer");

define("_ALBM_SUBMITTER","Inskickad av");
define("_ALBM_DELETE","Radera");
define("_ALBM_NOSUBMITTED","Inga nypublicerade Foto.");
define("_ALBM_ADDMAIN","LçÈg till en HUVUD Kategori");
define("_ALBM_IMGURL","Bild URL (FRIVILLIG, bildh‹Ëden kommer att çÏdras till 50): ");
define("_ALBM_ADD","LçÈg till");
define("_ALBM_ADDSUB","LçÈg till en Underkategori");
define("_ALBM_IN","i");
define("_ALBM_MODCAT","Modifiera Kategori");
define("_ALBM_DBUPDATED","Uppdateringen av databasen lyckades!");
define("_ALBM_MODREQDELETED","F‹ÓfréÈan om modifiering raderad.");
define("_ALBM_IMGURLMAIN","Bild URL (FRIVILLIG och ENDAST giltig f‹Ó huvudkategorier. Bildh‹Ëden kommer att çÏdras till 50): ");
define("_ALBM_PARENT","ŽÖvergripande kategori:");
define("_ALBM_SAVE","Spara çÏdringarna");
define("_ALBM_CATDELETED","Kategori Raderad.");
define("_ALBM_CATDEL_WARNING","VARNING: ŽÄr Ni sçÌer på att Ni vill radera denna Kategori och ALLA dess Foto och Kommentarer?");
define("_ALBM_YES","Ja");
define("_ALBM_NO","Nej");
define("_ALBM_NEWCATADDED","Ny Kategori sparad!");
define("_ALBM_ERROREXIST","FEL: Fotot som Ni skickade in finns redan i databasen!");
define("_ALBM_ERRORTITLE","FEL: Ni méÔte ange en TITEL!");
define("_ALBM_ERRORDESC","Fel: Ni méÔte ange en BESKRIVNING!");
define("_ALBM_WEAPPROVED","Vi godkçÏner Ert inskickade bidrag till foto databasen.");
define("_ALBM_THANKSSUBMIT","Tack f‹Ó Ert bidrag!");
define("_ALBM_CONFUPDATED","Uppdateringen av Konfigurationen lyckades!");
?>
<?php
// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_ALBM_NEW','Ny');
define('_ALBM_UPDATED','Uppdaterad');
define('_ALBM_GROUPPERM_GLOBAL','Globala RçÕtigheter');

}

?>
