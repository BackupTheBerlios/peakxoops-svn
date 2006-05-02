<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format


// Appended by Xoops Language Checker -GIJOE- in 2006-05-02 13:15:22
define('_MI_HEADLINES_FETCHMETHOD','method to fetch RSS/ATOM');
define('_MI_HEADLINES_FETCHMETHOD_DSC','use Snoopy if possible. fopen() can work "allow_url_fopen on" in php.ini');
define('_MI_HEADLINES_FM_SNOOPY','snoopy');
define('_MI_HEADLINES_FM_FOPEN','fopen()');
define('_MI_HEADLINES_FM_SSC','stream_socket_client() (PHP5)');

// Appended by Xoops Language Checker -GIJOE- in 2006-02-03 16:31:39
define('_MI_HEADLINES_ADMENU_MYTPLSADMIN','Templates');

define("_MI_DEFAULT_DTFMT_SHORT","j M ah:i");

// The name of this module
define("_MI_HEADLINES_NAME","Manchettes");

// A brief description of this module
define("_MI_HEADLINES_DESC","Affiche les flux RSS/XML d'autres sites");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Titres &agrave; la une");
define("_MI_HEADLINES_BDESC","Montrer les Titres &agrave; la Une RSS/ATOM dans des cellules distinctes");
define("_MI_HEADLINES_BNAME_MIXED","Titres r&eacute;cents &agrave; la Une");
define("_MI_HEADLINES_BDESC_MIXED","Montrer les Titres &agrave; la Une RSS/ATOM dans une vue agr&eacute;g&eacute;e");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Liste des Manchettes");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocs/Groupes");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Vue par d&eacute;faut");
define("_MI_HEADLINES_INDEX_VIEWMODED","S&eacute;lectionnez un type de vue comme page principale du module");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Nouveaut&eacute;s en premier");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classique");
define("_MI_HEADLINES_MIXED_MAXITEM","Nbre maximal d'items");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Sp&eacute;cifier le nombre maximal d'enregistrements du flux RSS/ATOM dans la vue des items r&eacute;cents");
define("_MI_HEADLINES_MIXED_MAXLEN","Longueur maximale");
define("_MI_HEADLINES_MIXED_MAXLEND", "Sp&eacute;cifier le nombre maximal de caract&egrave;res des titres dans la vue des liens r&eacute;cents (en bytes)");
define("_MI_HEADLINES_PROXY_HOST","Proxy host");
define("_MI_HEADLINES_PROXY_HOSTD","Si vous r&eacute;cup&eacute;rer les flux RSS/ATOM au travers d'un serveur proxy, d&eacute;finissez le nom du host ou l'adresse IP ici<br />Sinon, laisser &agrave; blanc.");
define("_MI_HEADLINES_PROXY_PORT","Port Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Si vous r&eacute;cup&eacute;rez les flux RSS/ATOM au travers d'un serveur proxy, d&eacute;finissez le num&eacute;ro du port") ;
define("_MI_HEADLINES_PROXY_USER","Utilisateur Proxy");
define("_MI_HEADLINES_PROXY_USERD","Si votre serveur proxy exige l'authentification BASIC, d&eacute;finissez le nom d'utilisateur<br />Sinon, laisser &agrave; blanc") ;
define("_MI_HEADLINES_PROXY_PASS","Mot de passe Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Si votre serveur proxy exige l'authentification BASIC, d&eacute;finissez le mot de passe<br />Sinon, laisser &agrave; blanc") ;
define("_MI_HEADLINES_SHORTDTFMT","Format court des dates et heures");
define("_MI_HEADLINES_SHORTDTFMTD","D&eacute;crire ici les premiers param&egrave;tres de la fonction PHP date().<br /><a href='http://fr.php.net/date'>Aller au manuel PHP</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Ne pas prendre un item comme r&eacute;cent si son num&eacute;ro de flux est au dessus du nombre maximal d'item &agrave; raffraichir");
define("_MI_HEADLINES_MIXPICKUPD","Si vous mettez cette option &agrave; NON, le param&egrave;tre 'Nombre maximal d'items' de chaque flux sera ignor&eacute;.");

}

?>