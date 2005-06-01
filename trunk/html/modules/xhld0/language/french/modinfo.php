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
define("_MI_HEADLINES_BNAME","Titres à la une");
define("_MI_HEADLINES_BNAME_MIXED","Titres récents à la Une");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Liste des Manchettes");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocs/Groupes");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Vue par défaut");
define("_MI_HEADLINES_INDEX_VIEWMODED","Sélectionnez un type de vue comme page principale du module");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Nouveautés en premier");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classique");
define("_MI_HEADLINES_MIXED_MAXITEM","Nbre maximal d'items");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Spécifier le nombre maximal d'enregistrements du flux RSS/ATOM dans la vue des items récents");
define("_MI_HEADLINES_MIXED_MAXLEN","Longueur maximale");
define("_MI_HEADLINES_MIXED_MAXLEND", "Spécifier le nombre maximal de caractères des titres dans la vue des liens récents (en bytes)");
define("_MI_HEADLINES_PROXY_HOST","Proxy host");
define("_MI_HEADLINES_PROXY_HOSTD","Si vous récupérer les flux RSS/ATOM au travers d'un serveur proxy, définissez le nom du host ou l'adresse IP ici<br />Sinon, laisser à blanc.");
define("_MI_HEADLINES_PROXY_PORT","Port Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Si vous récupérez les flux RSS/ATOM au travers d'un serveur proxy, définissez le numéro du port") ;
define("_MI_HEADLINES_PROXY_USER","Utilisateur Proxy");
define("_MI_HEADLINES_PROXY_USERD","Si votre serveur proxy exige l'authentification BASIC, définissez le nom d'utilisateur<br />Sinon, laisser à blanc") ;
define("_MI_HEADLINES_PROXY_PASS","Mot de passe Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Si votre serveur proxy exige l'authentification BASIC, définissez le mot de passe<br />Sinon, laisser à blanc") ;
define("_MI_HEADLINES_SHORTDTFMT","Format court des dates et heures");
define("_MI_HEADLINES_SHORTDTFMTD","Décrire ici les premiers paramètres de la fonction PHP date().<br /><a href='http://fr.php.net/date'>Aller au manuel PHP</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Ne pas prendre un item comme récent si son numéro de flux est au dessus du nombre maximal d'item à raffraichir");
define("_MI_HEADLINES_MIXPICKUPD","Si vous mettez cette option à NON, le paramètre 'Nombre maximal d'items' de chaque flux sera ignoré.");

}

?>