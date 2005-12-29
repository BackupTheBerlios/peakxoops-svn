<?php
// $Id: admin.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
//%%%%%%        Admin Module Name  Headlines         %%%%%

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_AM_DBUPDATED' ) ) {

// list of encodings allowed   (name):(title)|(name):(title)|...
define('_AM_ENCODINGS','utf-8:UTF-8|iso-8859-1:ISO-8859-1|iso-8859-15:ISO-8859-15|us-ascii:US-ASCII') ;
define('_AM_ENCODING_AUTO',"auto d&eacute;tection") ;

define("_AM_DBUPDATED","Base de donn&eacute;es mise &agrave; jour avec succ&egrave;s!");
define('_AM_HEADLINES','Configuration des Manchettes (Num.%s)');
define('_AM_HLMAIN','Page principale de la Manchette');
define('_AM_SITENAME','Nom du site');
define('_AM_URL','URL');
define('_AM_TITLEPATTERN','Extraire avec la chaine du titre<br /><span style="font-weight:normal;">&eacute;crire ici une expression r&eacute;guli&egrave;re perl /doller/<br />Normalement, laisser &agrave; blanc</span>');
define('_AM_TITLEEXCLUDE','Exlure avec une chaine de titre<br /><span style="font-weight:normal;">(regex perl) Normalement, laisser &agrave; blanc</span>');
define('_AM_LINKPATTERN','Extraire avec la chaine du titre<br /><span style="font-weight:normal;">&eacute;crire ici une expression r&eacute;guli&egrave;re perl /business/<br />Normalement, laisser &agrave; blanc</span>');
define('_AM_LINKEXCLUDE','Exlure avec la chaine de lien<br /><span style="font-weight:normal;">(regex perl) Normalement laisser &agrave; blanc</span>');
define('_AM_ORDER', 'Ordre');
define('_AM_ENCODING', 'Type de codage');
define('_AM_CACHETIME', "Cache du Flux");
define('_AM_TIMEOUT', "Time-out lors de l'int&eacute;gration");
define('_AM_ALLOWHTML', 'Permettre l\'affichage d\'HTML &agrave; l\'int&eacute;rieur du flux XML<br /><span style="font-weight:normal;">Vous ne devriez pas permettre le HTML dans un flux RSS/ATOM qui est g&eacute;n&eacute;r&eacute; par un post d\'un visiteur du site.</span>');
define('_AM_MAINSETT', 'Param&eacute;trage de la page principale');
define('_AM_BLOCKSETT', 'Param&eacute;trage des Blocs');
define('_AM_DISPIMG', "Afficher l'image");
define('_AM_DISPFULL', 'Afficher les descriptions et les dates de publication');
define('_AM_DISPMAX', "Nombre maximal d'item &agrave; afficher");
define('_AM_DISPLAY', 'Page Principale');
define('_AM_ASBLOCK', 'Bloc');
define('_AM_ADDHEADL','Ajouter la manchette/le flux');
define('_AM_URLEDFXML','URL du lien RSS ou ATOM');
define('_AM_SYNDICATIONTYPE','Type de flux');
define('_AM_SYNDICATIONTYPE_AUTO','Auto');
define('_AM_SAVEAS','Sauvegarder');
define('_AM_UPDATE','MAJ et reint&eacute;grer');
define('_AM_EDITHEADL','Editer la Manchette');
define('_AM_WANTDEL','Etes vous sur de vouloir supprimer la manchette pour %s?');
define('_AM_INVALIDID', 'ID Invalide');
define('_AM_OBJECTNG', "Cet objet n'existe pas");
define('_AM_FAILUPDATE', 'Echec de la sauvegarde des donn&eacute;es dans la base pour la manchette %s');
define('_AM_FAILDELETE', 'Echec de la suppression des donn&eacute;es dans la base pour la manchette %s');

}

?>
