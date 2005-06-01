<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format
define("_MI_DEFAULT_DTFMT_SHORT","j M ah:i");

// The name of this module
define("_MI_HEADLINES_NAME","Manchettes");

// A brief description of this module
define("_MI_HEADLINES_DESC","Affiche les flux RSS/XML d'autres sites");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Titres � la une");
define("_MI_HEADLINES_BNAME_MIXED","Titres r�cents � la Une");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Liste des Manchettes");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocs/Groupes");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Vue par d�faut");
define("_MI_HEADLINES_INDEX_VIEWMODED","S�lectionnez un type de vue comme page principale du module");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Nouveaut�s en premier");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classique");
define("_MI_HEADLINES_MIXED_MAXITEM","Nbre maximal d'items");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Sp�cifier le nombre maximal d'enregistrements du flux RSS/ATOM dans la vue des items r�cents");
define("_MI_HEADLINES_MIXED_MAXLEN","Longueur maximale");
define("_MI_HEADLINES_MIXED_MAXLEND", "Sp�cifier le nombre maximal de caract�res des titres dans la vue des liens r�cents (en bytes)");
define("_MI_HEADLINES_PROXY_HOST","Proxy host");
define("_MI_HEADLINES_PROXY_HOSTD","Si vous r�cup�rer les flux RSS/ATOM au travers d'un serveur proxy, d�finissez le nom du host ou l'adresse IP ici<br />Sinon, laisser � blanc.");
define("_MI_HEADLINES_PROXY_PORT","Port Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Si vous r�cup�rez les flux RSS/ATOM au travers d'un serveur proxy, d�finissez le num�ro du port") ;
define("_MI_HEADLINES_PROXY_USER","Utilisateur Proxy");
define("_MI_HEADLINES_PROXY_USERD","Si votre serveur proxy exige l'authentification BASIC, d�finissez le nom d'utilisateur<br />Sinon, laisser � blanc") ;
define("_MI_HEADLINES_PROXY_PASS","Mot de passe Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Si votre serveur proxy exige l'authentification BASIC, d�finissez le mot de passe<br />Sinon, laisser � blanc") ;
define("_MI_HEADLINES_SHORTDTFMT","Format court des dates et heures");
define("_MI_HEADLINES_SHORTDTFMTD","D�crire ici les premiers param�tres de la fonction PHP date().<br /><a href='http://fr.php.net/date'>Aller au manuel PHP</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Ne pas prendre un item comme r�cent si son num�ro de flux est au dessus du nombre maximal d'item � raffraichir");
define("_MI_HEADLINES_MIXPICKUPD","Si vous mettez cette option � NON, le param�tre 'Nombre maximal d'items' de chaque flux sera ignor�.");

}

?>