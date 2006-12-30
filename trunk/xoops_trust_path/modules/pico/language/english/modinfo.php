<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","pico");

// A brief description of this module
define($constpref."_DESC","a module for staic contents");

// admin menus
define( $constpref.'_ADMENU_CONTENTSADMIN' , 'Contents list' ) ;
define( $constpref.'_ADMENU_CATEGORYACCESS' , 'Permissions of Categories' ) ;
define( $constpref.'_ADMENU_IMPORT' , 'Import/Sync' ) ;

// configurations
define($constpref.'_TOP_MESSAGE','Description of TOP category');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_MENUINMODULETOP','Display menu(index) in the top of this module');
define($constpref.'_LISTASINDEX',"Display contents index in category's top");
define($constpref.'_LISTASINDEXDSC','YES means auto made list is displayed in the top of the category. NO means a content with the highest priority is displayeed instead auto made list');
define($constpref.'_SHOW_BREADCRUMBS','Display breadcrumbs');
define($constpref.'_SHOW_PAGENAVI','Display page navigation');
define($constpref.'_SHOW_PRINTICON','Display printer friendly icon');
define($constpref.'_SHOW_TELLAFRIEND','Display tell a friend icon');
define($constpref.'_USE_TAFMODULE','Use "tellafriend" module');
define($constpref.'_FILTERS','Default filter set');
define($constpref.'_FILTERSDSC','input filter names separated with | (pipe)');
define($constpref.'_FILTERSDEFAULT','htmlspecialchars|smiley|xcode|nl2br');
define($constpref.'_USE_VOTE','use the feature of VOTE');
define($constpref.'_GUESTVOTE_IVL','Vote from guests');
define($constpref.'_GUESTVOTE_IVLDSC','Set this 0, to disable voting from guest. The other this number means time(sec.) to allow second post from the same IP.');
define($constpref.'_HTMLHEADER','common HTML header');
define($constpref.'_CSS_URI','URI of CSS file for this module');
define($constpref.'_CSS_URIDSC','relative or absolute path can be set. default: index.css');
define($constpref.'_IMAGES_DIR','Directory for image files');
define($constpref.'_IMAGES_DIRDSC','relative path should be set in the module directory. default: images');
define($constpref.'_BODY_EDITOR','Editor for body');
define($constpref.'_COM_DIRNAME','Comment-integration: dirname of d3forum');
define($constpref.'_COM_FORUM_ID','Comment-integration: forum ID');

// blocks
define($constpref.'_BNAME_MENU','Menu');
define($constpref.'_BNAME_CONTENT','Content');
define($constpref.'_BNAME_LIST','List');

}


?>