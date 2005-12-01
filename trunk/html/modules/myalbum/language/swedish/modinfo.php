<?php
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MI_LOADED' ) ) {






// Appended by Xoops Language Checker -GIJOE- in 2004-10-04 16:06:33
define('_ALBM_CFG_DEFAULTORDER','Default order in category\'s view');

// Appended by Xoops Language Checker -GIJOE- in 2004-06-24 17:58:59
define('_ALBM_CFG_USESITEIMG','AnvçÏd [siteimg] vid ImageManager Integration');
define('_ALBM_CFG_DESCUSESITEIMG','Integrated Image Manager input [siteimg] istçÍlet f‹Ó [img].<br />Ni méÔte modifiera module.textsanitizer.php eller varje modul f‹Ó att aktivera [siteimg] taggen.');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-19 13:56:06
define('_ALBM_CFG_MIDDLEPIXEL','Max bild storlek vid visning av bilder en och en.');
define('_ALBM_CFG_DESCMIDDLEPIXEL','Specificera (breddxh‹Ëd) t.ex. 480x480');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:55
define('_ALBM_CFG_DESCPERPAGE','Ange valbara nummer separerade med \'|\' t.ex.) 10|20|50|100');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-05 15:14:38
define('_ALBM_CFG_ALLOWNOIMAGE','TilléÕs inskickade utan bilder');
define('_ALBM_CFG_ALLOWEDEXTS','Filtyper som kan laddas upp');
define('_ALBM_CFG_DESCALLOWEDEXTS','Ange filçÏdelser med avgrçÏsare \'|\'. (t.ex. \'jpg|jpeg|gif|png\').<br />Alla tecken méÔte vara skrivna i små bokstç×er. Ange inga punkter eller mellanrum');
define('_ALBM_CFG_ALLOWEDMIME','MIME Typer som kan laddas upp');
define('_ALBM_CFG_DESCALLOWEDMIME','Ange MIME Typer med avgrçÏsare \'|\'. (t.ex. \'image/gif|image/jpeg|image/png\')<br />Om Ni inte vill att filen skall kontrolleras mot MIME Typ, lçÎna fçÍtet blankt.');
define('_ALBM_MYALBUM_ADMENU_IMPORT','Importera Bilder');
define('_ALBM_MYALBUM_ADMENU_EXPORT','Exportera Bilder');
define('_ALBM_MYALBUM_ADMENU_MYBLOCKSADMIN','Block&Grupp Administration');

define( 'MYALBUM_MI_LOADED' , 1 ) ;

// The name of this module
define("_ALBM_MYALBUM_NAME","MyAlbum");

// A brief description of this module
define("_ALBM_MYALBUM_DESC","Skapar ett fotoalbum dçÓ anvçÏdare kan s‹Ìa/lçÈga till/bed‹Îma olika foto.");

// Names of blocks for this module (Not all module has blocks)
define("_ALBM_BNAME_RECENT","Nyinkommna Foto");
define("_ALBM_BNAME_HITS","Topplacerade Foto");
define("_ALBM_BNAME_RANDOM","Slumpvalt Foto");
define("_ALBM_BNAME_RECENT_P","Nyinkommna Foto med Miniatyrer");
define("_ALBM_BNAME_HITS_P","Topplacerade Foto med Miniatyrer");

// Config Items
define( "_ALBM_CFG_PHOTOSPATH" , "S‹ÌvçÈ till Fotona" ) ;
define( "_ALBM_CFG_DESCPHOTOSPATH" , "S‹ÌvçÈ till katalogen som XOOPS çÓ installerad i.<br />(F‹Ósta tecknet méÔte vara '/'. Sista tecknet skall INTE vara  '/'.)<br />Denna katalogs rçÕtigheter çÓ 777 eller 707 i unix." ) ;
define( "_ALBM_CFG_THUMBSPATH" , "S‹ÌvçÈ till Miniatyrbilderna" ) ;
define( "_ALBM_CFG_DESCTHUMBSPATH" , "Samma som 'S‹ÌvçÈ till Fotona'." ) ;
//define( "_ALBM_CFG_USEIMAGICK" , "AnvçÏd ImageMagick f‹Ó behandling av bilder" ) ;
//define( "_ALBM_CFG_DESCIMAGICK" , "Not use ImageMagick cause Not work resize or rotate the main photo, and make thumbnails by GD.<br />Det çÓ bçÕtre att anvçÏda ImageMagick om du kan." ) ;
define( "_ALBM_CFG_IMAGINGPIPE" , "Paket f‹Ó bildbehandling" ) ;
define( "_ALBM_CFG_DESCIMAGINGPIPE" , "NçÔtan alla PHP installationer kan anvçÏda GD. Men GD çÓ funktionellt underlçÈsen de andra två paketen.<br />Det çÓ bçÕtre att anvçÏda ImageMagick eller NetPBM om du kan." ) ;
define( "_ALBM_CFG_FORCEGD2" , "Tvinga GD2 konvertering" ) ;
define( "_ALBM_CFG_DESCFORCEGD2" , "ŽÄven om GD çÓ paketerad tillsammans med PHP och den anvçÏder GD2(truecolor) konvertering.<br />Vissa PHP konfigurationer misslyckas att skapa miniatyrbilder i GD2<br />Denna instçÍlning gçÍler endast om man anvçÏder GD" ) ;
define( "_ALBM_CFG_IMAGICKPATH" , "S‹ÌvçÈ till ImageMagick" ) ;
define( "_ALBM_CFG_DESCIMAGICKPATH" , "FullstçÏdig s‹ÌvçÈ till 'convert'<br />(Sista tecknet skall INTE vara '/'.)<br />Denna instçÍlning gçÍler endast om man anvçÏder ImageMagick" ) ;
define( "_ALBM_CFG_NETPBMPATH" , "S‹ÌvçÈ till NetPBM" ) ;
define( "_ALBM_CFG_DESCNETPBMPATH" , "FullstçÏdig s‹ÌvçÈ till 'pnmscale' mm.<br />(Sista tecknet skall INTE vara '/'.)<br />Denna instçÍlning gçÍler endast om man anvçÏder NetPBM" ) ;
define( "_ALBM_CFG_POPULAR" , "TrçÇfar f‹Ó att bli PopulçÓ" ) ;
define( "_ALBM_CFG_NEWDAYS" , "Dagar mellan visning av iconer f‹Ó 'new'&'update'" ) ;
define( "_ALBM_CFG_NEWPHOTOS" , "Antal Foto som Nya på Top Page" ) ;
define( "_ALBM_CFG_PERPAGE" , "Visade Foto per sida" ) ;
define( "_ALBM_CFG_MAKETHUMB" , "G‹Ó Miniatyr bild" ) ;
define( "_ALBM_CFG_DESCMAKETHUMB" , "NçÓ Ni çÏdrar 'Nej' till 'Ja', ŽÄr det lçÎpligt att 'G‹Óa om Miniatyrer'." ) ;
//define( "_ALBM_CFG_THUMBWIDTH" , "Bredd på Miniatyrbild" ) ;
//define( "_ALBM_CFG_DESCTHUMBWIDTH" , "H‹Ëden på Miniatyrbilden avg‹Ós automatiskt utifréÏ bredden." ) ;
define( "_ALBM_CFG_THUMBSIZE" , "Storlek på Miniatyrer (pixel)" ) ;
define( "_ALBM_CFG_THUMBRULE" , "BerçÌningsregel f‹Ó att g‹Óa miniatyrer" ) ;
define( "_ALBM_CFG_WIDTH" , "Max Foto bredd" ) ;
define( "_ALBM_CFG_DESCWIDTH" , "Detta innebçÓ att fotots bredd kommer att f‹ÓçÏdras.<br />Om du anvçÏder GD utan truecolor, innebçÓ detta begrçÏsning av bredden." ) ;
define( "_ALBM_CFG_HEIGHT" , "Max foto h‹Ëd" ) ;
define( "_ALBM_CFG_DESCHEIGHT" , "Samma som 'Max foto bredd'." ) ;
define( "_ALBM_CFG_FSIZE" , "Max filstorlek" ) ;
define( "_ALBM_CFG_DESCFSIZE" , "BegrçÏsning av storleken på den uppladdade filen." ) ;
define( "_ALBM_CFG_NEEDADMIT" , "Beh‹×er godkçÏnande f‹Ó nytt foto" ) ;
define( "_ALBM_CFG_ADDPOSTS" , "Det nummer som lçÈgs till 'User's posts' vid publicering av ett foto." ) ;
define( "_ALBM_CFG_DESCADDPOSTS" , "Normalt, 0 eller 1. Mindre çÓ 0 betyder 0" ) ;

define( "_ALBM_CFG_CATONSUBMENU" , "Registrera Topp kategorier i undermeny" ) ;
define( "_ALBM_CFG_NAMEORUNAME" , "Publicistens namn visas" ) ;
define( "_ALBM_CFG_DESCNAMEORUNAME" , "VçÍj vilket 'namn' som visas" ) ;
define( "_ALBM_OPT_USENAME" , "Riktigt Namn" ) ;
define( "_ALBM_OPT_USEUNAME" , "Alias Namn" ) ;

define( "_ALBUM_OPT_CALCFROMWIDTH" , "Bredd:specificerad  h‹Ëd:automatisk" ) ;
define( "_ALBUM_OPT_CALCFROMHEIGHT" , "Bredd:automatisk  bredd:specificerad" ) ;
define( "_ALBUM_OPT_CALCWHINSIDEBOX" , "ange storlek i specificerad ruta" ) ;

// Sub menu titles
define("_ALBM_TEXT_SMNAME1","LçÈg till");
define("_ALBM_TEXT_SMNAME2","PopulçÓa");
define("_ALBM_TEXT_SMNAME3","Topplacerade");
define("_ALBM_TEXT_SMNAME4","Mina Foto");

// Names of admin menu items
define("_ALBM_MYALBUM_ADMENU0","Inskickade foto");
define("_ALBM_MYALBUM_ADMENU1","Foto UnderhéÍl");
define("_ALBM_MYALBUM_ADMENU2","LçÈg till/Editera Kategorier");
define("_ALBM_MYALBUM_ADMENU3","Kontrollera Konf&Miljö");
define("_ALBM_MYALBUM_ADMENU4","Batch Registrering");
define("_ALBM_MYALBUM_ADMENU5","G‹Ó om Miniatyrer");

?><?php
// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_ALBM_CFG_VIEWCATTYPE','Typ av vy i Kategorier');
define('_ALBM_CFG_COLSOFTABLEVIEW','Antal kolumner i tabell vyn');
define('_ALBM_OPT_VIEWLIST','List Vy');
define('_ALBM_OPT_VIEWTABLE','Tabell Vy');
define('_ALBM_MYALBUM_ADMENU_GPERM','Globala RçÕtigheter');
define('_MI_MYALBUM_GLOBAL_NOTIFY','Globala');
define('_MI_MYALBUM_GLOBAL_NOTIFYDSC','Globala underrçÕtelseval r‹Óande myAlbum-P');
define('_MI_MYALBUM_CATEGORY_NOTIFY','Kategori');
define('_MI_MYALBUM_CATEGORY_NOTIFYDSC','UnderrçÕtelseval som gçÍler f‹Ó denna fotokategori');
define('_MI_MYALBUM_PHOTO_NOTIFY','Foto');
define('_MI_MYALBUM_PHOTO_NOTIFYDSC','UnderrçÕtelseval som gçÍler f‹Ó detta foto');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFY','Nytt Foto');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYCAP','UnderrçÕta mig nçÓ néÈot nytt foto har lagts till');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYDSC','Mottag underrçÕtelse nçÓ néÈot nytt foto har lagts till');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: Automatisk underrçÕtelse : Nytt foto');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFY','Nytt Foto');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYCAP','UnderrçÕta mig nçÓ néÈot nytt foto har lagts till i denna kategori');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYDSC','Mottag underrçÕtelse nçÓ néÈot nytt foto har lagts till i denna kategori');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: Automatisk underrçÕtelse : Nytt foto');

}

?>
