<?php
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MI_LOADED' ) ) {






// Appended by Xoops Language Checker -GIJOE- in 2004-10-04 16:06:33
define('_ALBM_CFG_DEFAULTORDER','Default order in category\'s view');

// Appended by Xoops Language Checker -GIJOE- in 2004-06-24 17:58:59
define('_ALBM_CFG_USESITEIMG','Anv��d [siteimg] vid ImageManager Integration');
define('_ALBM_CFG_DESCUSESITEIMG','Integrated Image Manager input [siteimg] ist��let f�� [img].<br />Ni m��te modifiera module.textsanitizer.php eller varje modul f�� att aktivera [siteimg] taggen.');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-19 13:56:06
define('_ALBM_CFG_MIDDLEPIXEL','Max bild storlek vid visning av bilder en och en.');
define('_ALBM_CFG_DESCMIDDLEPIXEL','Specificera (breddxh��d) t.ex. 480x480');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:55
define('_ALBM_CFG_DESCPERPAGE','Ange valbara nummer separerade med \'|\' t.ex.) 10|20|50|100');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-05 15:14:38
define('_ALBM_CFG_ALLOWNOIMAGE','Till��s inskickade utan bilder');
define('_ALBM_CFG_ALLOWEDEXTS','Filtyper som kan laddas upp');
define('_ALBM_CFG_DESCALLOWEDEXTS','Ange fil��delser med avgr��sare \'|\'. (t.ex. \'jpg|jpeg|gif|png\').<br />Alla tecken m��te vara skrivna i sm� bokst��er. Ange inga punkter eller mellanrum');
define('_ALBM_CFG_ALLOWEDMIME','MIME Typer som kan laddas upp');
define('_ALBM_CFG_DESCALLOWEDMIME','Ange MIME Typer med avgr��sare \'|\'. (t.ex. \'image/gif|image/jpeg|image/png\')<br />Om Ni inte vill att filen skall kontrolleras mot MIME Typ, l��na f��tet blankt.');
define('_ALBM_MYALBUM_ADMENU_IMPORT','Importera Bilder');
define('_ALBM_MYALBUM_ADMENU_EXPORT','Exportera Bilder');
define('_ALBM_MYALBUM_ADMENU_MYBLOCKSADMIN','Block&Grupp Administration');

define( 'MYALBUM_MI_LOADED' , 1 ) ;

// The name of this module
define("_ALBM_MYALBUM_NAME","MyAlbum");

// A brief description of this module
define("_ALBM_MYALBUM_DESC","Skapar ett fotoalbum d�� anv��dare kan s��a/l��ga till/bed��ma olika foto.");

// Names of blocks for this module (Not all module has blocks)
define("_ALBM_BNAME_RECENT","Nyinkommna Foto");
define("_ALBM_BNAME_HITS","Topplacerade Foto");
define("_ALBM_BNAME_RANDOM","Slumpvalt Foto");
define("_ALBM_BNAME_RECENT_P","Nyinkommna Foto med Miniatyrer");
define("_ALBM_BNAME_HITS_P","Topplacerade Foto med Miniatyrer");

// Config Items
define( "_ALBM_CFG_PHOTOSPATH" , "S��v�� till Fotona" ) ;
define( "_ALBM_CFG_DESCPHOTOSPATH" , "S��v�� till katalogen som XOOPS �� installerad i.<br />(F��sta tecknet m��te vara '/'. Sista tecknet skall INTE vara  '/'.)<br />Denna katalogs r��tigheter �� 777 eller 707 i unix." ) ;
define( "_ALBM_CFG_THUMBSPATH" , "S��v�� till Miniatyrbilderna" ) ;
define( "_ALBM_CFG_DESCTHUMBSPATH" , "Samma som 'S��v�� till Fotona'." ) ;
//define( "_ALBM_CFG_USEIMAGICK" , "Anv��d ImageMagick f�� behandling av bilder" ) ;
//define( "_ALBM_CFG_DESCIMAGICK" , "Not use ImageMagick cause Not work resize or rotate the main photo, and make thumbnails by GD.<br />Det �� b��tre att anv��da ImageMagick om du kan." ) ;
define( "_ALBM_CFG_IMAGINGPIPE" , "Paket f�� bildbehandling" ) ;
define( "_ALBM_CFG_DESCIMAGINGPIPE" , "N��tan alla PHP installationer kan anv��da GD. Men GD �� funktionellt underl��sen de andra tv� paketen.<br />Det �� b��tre att anv��da ImageMagick eller NetPBM om du kan." ) ;
define( "_ALBM_CFG_FORCEGD2" , "Tvinga GD2 konvertering" ) ;
define( "_ALBM_CFG_DESCFORCEGD2" , "��ven om GD �� paketerad tillsammans med PHP och den anv��der GD2(truecolor) konvertering.<br />Vissa PHP konfigurationer misslyckas att skapa miniatyrbilder i GD2<br />Denna inst��lning g��ler endast om man anv��der GD" ) ;
define( "_ALBM_CFG_IMAGICKPATH" , "S��v�� till ImageMagick" ) ;
define( "_ALBM_CFG_DESCIMAGICKPATH" , "Fullst��dig s��v�� till 'convert'<br />(Sista tecknet skall INTE vara '/'.)<br />Denna inst��lning g��ler endast om man anv��der ImageMagick" ) ;
define( "_ALBM_CFG_NETPBMPATH" , "S��v�� till NetPBM" ) ;
define( "_ALBM_CFG_DESCNETPBMPATH" , "Fullst��dig s��v�� till 'pnmscale' mm.<br />(Sista tecknet skall INTE vara '/'.)<br />Denna inst��lning g��ler endast om man anv��der NetPBM" ) ;
define( "_ALBM_CFG_POPULAR" , "Tr��far f�� att bli Popul��" ) ;
define( "_ALBM_CFG_NEWDAYS" , "Dagar mellan visning av iconer f�� 'new'&'update'" ) ;
define( "_ALBM_CFG_NEWPHOTOS" , "Antal Foto som Nya p� Top Page" ) ;
define( "_ALBM_CFG_PERPAGE" , "Visade Foto per sida" ) ;
define( "_ALBM_CFG_MAKETHUMB" , "G�� Miniatyr bild" ) ;
define( "_ALBM_CFG_DESCMAKETHUMB" , "N�� Ni ��drar 'Nej' till 'Ja', ��r det l��pligt att 'G��a om Miniatyrer'." ) ;
//define( "_ALBM_CFG_THUMBWIDTH" , "Bredd p� Miniatyrbild" ) ;
//define( "_ALBM_CFG_DESCTHUMBWIDTH" , "H��den p� Miniatyrbilden avg��s automatiskt utifr�� bredden." ) ;
define( "_ALBM_CFG_THUMBSIZE" , "Storlek p� Miniatyrer (pixel)" ) ;
define( "_ALBM_CFG_THUMBRULE" , "Ber��ningsregel f�� att g��a miniatyrer" ) ;
define( "_ALBM_CFG_WIDTH" , "Max Foto bredd" ) ;
define( "_ALBM_CFG_DESCWIDTH" , "Detta inneb�� att fotots bredd kommer att f����dras.<br />Om du anv��der GD utan truecolor, inneb�� detta begr��sning av bredden." ) ;
define( "_ALBM_CFG_HEIGHT" , "Max foto h��d" ) ;
define( "_ALBM_CFG_DESCHEIGHT" , "Samma som 'Max foto bredd'." ) ;
define( "_ALBM_CFG_FSIZE" , "Max filstorlek" ) ;
define( "_ALBM_CFG_DESCFSIZE" , "Begr��sning av storleken p� den uppladdade filen." ) ;
define( "_ALBM_CFG_NEEDADMIT" , "Beh��er godk��nande f�� nytt foto" ) ;
define( "_ALBM_CFG_ADDPOSTS" , "Det nummer som l��gs till 'User's posts' vid publicering av ett foto." ) ;
define( "_ALBM_CFG_DESCADDPOSTS" , "Normalt, 0 eller 1. Mindre �� 0 betyder 0" ) ;

define( "_ALBM_CFG_CATONSUBMENU" , "Registrera Topp kategorier i undermeny" ) ;
define( "_ALBM_CFG_NAMEORUNAME" , "Publicistens namn visas" ) ;
define( "_ALBM_CFG_DESCNAMEORUNAME" , "V��j vilket 'namn' som visas" ) ;
define( "_ALBM_OPT_USENAME" , "Riktigt Namn" ) ;
define( "_ALBM_OPT_USEUNAME" , "Alias Namn" ) ;

define( "_ALBUM_OPT_CALCFROMWIDTH" , "Bredd:specificerad  h��d:automatisk" ) ;
define( "_ALBUM_OPT_CALCFROMHEIGHT" , "Bredd:automatisk  bredd:specificerad" ) ;
define( "_ALBUM_OPT_CALCWHINSIDEBOX" , "ange storlek i specificerad ruta" ) ;

// Sub menu titles
define("_ALBM_TEXT_SMNAME1","L��g till");
define("_ALBM_TEXT_SMNAME2","Popul��a");
define("_ALBM_TEXT_SMNAME3","Topplacerade");
define("_ALBM_TEXT_SMNAME4","Mina Foto");

// Names of admin menu items
define("_ALBM_MYALBUM_ADMENU0","Inskickade foto");
define("_ALBM_MYALBUM_ADMENU1","Foto Underh��l");
define("_ALBM_MYALBUM_ADMENU2","L��g till/Editera Kategorier");
define("_ALBM_MYALBUM_ADMENU3","Kontrollera Konf&Milj�");
define("_ALBM_MYALBUM_ADMENU4","Batch Registrering");
define("_ALBM_MYALBUM_ADMENU5","G�� om Miniatyrer");

?><?php
// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_ALBM_CFG_VIEWCATTYPE','Typ av vy i Kategorier');
define('_ALBM_CFG_COLSOFTABLEVIEW','Antal kolumner i tabell vyn');
define('_ALBM_OPT_VIEWLIST','List Vy');
define('_ALBM_OPT_VIEWTABLE','Tabell Vy');
define('_ALBM_MYALBUM_ADMENU_GPERM','Globala R��tigheter');
define('_MI_MYALBUM_GLOBAL_NOTIFY','Globala');
define('_MI_MYALBUM_GLOBAL_NOTIFYDSC','Globala underr��telseval r��ande myAlbum-P');
define('_MI_MYALBUM_CATEGORY_NOTIFY','Kategori');
define('_MI_MYALBUM_CATEGORY_NOTIFYDSC','Underr��telseval som g��ler f�� denna fotokategori');
define('_MI_MYALBUM_PHOTO_NOTIFY','Foto');
define('_MI_MYALBUM_PHOTO_NOTIFYDSC','Underr��telseval som g��ler f�� detta foto');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFY','Nytt Foto');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYCAP','Underr��ta mig n�� n��ot nytt foto har lagts till');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYDSC','Mottag underr��telse n�� n��ot nytt foto har lagts till');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: Automatisk underr��telse : Nytt foto');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFY','Nytt Foto');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYCAP','Underr��ta mig n�� n��ot nytt foto har lagts till i denna kategori');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYDSC','Mottag underr��telse n�� n��ot nytt foto har lagts till i denna kategori');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: Automatisk underr��telse : Nytt foto');

}

?>
