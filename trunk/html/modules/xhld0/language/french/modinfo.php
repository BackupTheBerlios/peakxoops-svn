<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format

// Appended by Xoops Language Checker -GIJOE- in 2005-08-09 17:42:01
define('_MI_HEADLINES_BDESC','Shows headline news via RSS/ATOM in separate cells');
define('_MI_HEADLINES_BDESC_MIXED','Shows headline news via RSS/ATOM in an aggregated view');

define("_MI_DEFAULT_DTFMT_SHORT","j M ah:i");

// The name of this module
define("_MI_HEADLINES_NAME","Manchettes");

// A brief description of this module
define("_MI_HEADLINES_DESC","Affiche les flux RSS/XML d'autres sites");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Titres à la une");
define("_MI_HEADLINES_BNAME_MIXED","Titres rñÄents à la Une");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Liste des Manchettes");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocs/Groupes");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Vue par dñÇaut");
define("_MI_HEADLINES_INDEX_VIEWMODED","SñÍectionnez un type de vue comme page principale du module");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","NouveautñÔ en premier");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classique");
define("_MI_HEADLINES_MIXED_MAXITEM","Nbre maximal d'items");
define("_MI_HEADLINES_MIXED_MAXITEMD", "SpñÄifier le nombre maximal d'enregistrements du flux RSS/ATOM dans la vue des items rñÄents");
define("_MI_HEADLINES_MIXED_MAXLEN","Longueur maximale");
define("_MI_HEADLINES_MIXED_MAXLEND", "SpñÄifier le nombre maximal de caractïÓes des titres dans la vue des liens rñÄents (en bytes)");
define("_MI_HEADLINES_PROXY_HOST","Proxy host");
define("_MI_HEADLINES_PROXY_HOSTD","Si vous rñÄupñÓer les flux RSS/ATOM au travers d'un serveur proxy, dñÇinissez le nom du host ou l'adresse IP ici<br />Sinon, laisser à blanc.");
define("_MI_HEADLINES_PROXY_PORT","Port Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Si vous rñÄupñÓez les flux RSS/ATOM au travers d'un serveur proxy, dñÇinissez le numñÓo du port") ;
define("_MI_HEADLINES_PROXY_USER","Utilisateur Proxy");
define("_MI_HEADLINES_PROXY_USERD","Si votre serveur proxy exige l'authentification BASIC, dñÇinissez le nom d'utilisateur<br />Sinon, laisser à blanc") ;
define("_MI_HEADLINES_PROXY_PASS","Mot de passe Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Si votre serveur proxy exige l'authentification BASIC, dñÇinissez le mot de passe<br />Sinon, laisser à blanc") ;
define("_MI_HEADLINES_SHORTDTFMT","Format court des dates et heures");
define("_MI_HEADLINES_SHORTDTFMTD","DñÄrire ici les premiers paramïÕres de la fonction PHP date().<br /><a href='http://fr.php.net/date'>Aller au manuel PHP</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Ne pas prendre un item comme rñÄent si son numñÓo de flux est au dessus du nombre maximal d'item à raffraichir");
define("_MI_HEADLINES_MIXPICKUPD","Si vous mettez cette option à NON, le paramïÕre 'Nombre maximal d'items' de chaque flux sera ignoré.");

}

?>