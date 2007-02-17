<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","pico");

// A brief description of this module
define($constpref."_DESC","un module pour g�rer contenu statique");

// admin menus
define( $constpref.'_ADMENU_CONTENTSADMIN' , 'Liste de Contentu' ) ;
define( $constpref.'_ADMENU_CATEGORYACCESS' , 'Permissions des Cat�gories' ) ;
define( $constpref.'_ADMENU_IMPORT' , 'Importer/Synchroniser' ) ;

// configurations
define($constpref.'_USE_WRAPSMODE','Activer le mode Ins�rtion (wraps)');
define($constpref.'_WRAPSAUTOREGIST','Activer l\'auto-enregistrement des fichiers HTML ins�r�s dans la BD comme contenu');
define($constpref.'_TOP_MESSAGE','Description de la cat�gorie TOP');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_MENUINMODULETOP','Afficher menu(index) en t�te de ce module');
define($constpref.'_LISTASINDEX',"Afficher l\'index de contenu dans l\'en t�te des cat�gories");
define($constpref.'_LISTASINDEXDSC','OUI signifie que la liste est faite automatique et s\'affiche au dessus de la
cat�gorie. NON signifie que le contenu avec la plushaute priorot� est affich� au lieu de la liste automatique');
define($constpref.'_SHOW_BREADCRUMBS','Afficher r�sum�s');
define($constpref.'_SHOW_PAGENAVI','Afficher page navigation');
define($constpref.'_SHOW_PRINTICON','Afficher l\'icone du format imprimable');
define($constpref.'_SHOW_TELLAFRIEND','Afficher l\'icone pour informer un ami');
define($constpref.'_USE_TAFMODULE','Utiliser le module "tellafriend"');
define($constpref.'_FILTERS','S�rie de filtres par d�faut');
define($constpref.'_FILTERSDSC','Ajoutez les noms des filtres s�par�s par | ');
define($constpref.'_FILTERSDEFAULT','htmlspecialchars|smiley|xcode|nl2br');
define($constpref.'_USE_VOTE','Activer l\'option de VOTE');
define($constpref.'_GUESTVOTE_IVL','Vote des visiteurs');
define($constpref.'_GUESTVOTE_IVLDSC','Ajoutez 0, pour d�sactiver le vote des visiteurs anonymes. Autrement ajoutez un nombre �quivalent au temps (sec.) pour permettre un second vote de m�me IP.');
define($constpref.'_HTMLHEADER','En t�te HTML commun');
define($constpref.'_CSS_URI','URI du fichier CSS pour ce module');
define($constpref.'_CSS_URIDSC','Vous pouvez indiquer une adresse relative ou absolue. Par d�faut: {mod_url}/index.css');
define($constpref.'_IMAGES_DIR','Dossier pour les fichiers images');
define($constpref.'_IMAGES_DIRDSC','Vous pouvez indiquer une adresse relative ou absolue. Par d�faut: images');
define($constpref.'_BODY_EDITOR','Editeur du document');
define($constpref.'_COM_DIRNAME','Int�gration-commentaires: nom du dossier de d3forum');
define($constpref.'_COM_FORUM_ID','Int�gration-commentaires: ID forum');

// blocks
define($constpref.'_BNAME_MENU','Menu');
define($constpref.'_BNAME_CONTENT','Contenu');
define($constpref.'_BNAME_LIST','Liste');

// Notify Categories
define($constpref.'_NOTCAT_GLOBAL', 'global');
define($constpref.'_NOTCAT_GLOBALDSC', 'notifications de ce module');

// Each Notifications
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENT', 'Contenu en attente');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTCAP', 'Notifier si de nouveaux messages ou modifications sont attente   (Juste notifier aux administrations ou aux mod�rateurs)');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTSBJ', '[{X_SITENAME}] {X_MODULE}: en attente');

}


?>