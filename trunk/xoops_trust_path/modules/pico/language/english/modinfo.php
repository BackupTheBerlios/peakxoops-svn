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
define($constpref.'_USE_WRAPSMODE','enable wraps mode');
define($constpref.'_USE_REWRITE','enable mod_rewrite mode');
define($constpref.'_USE_REWRITEDSC','Depends your environment. If you turn this on, rename .htaccess.rewrite_wraps(with wraps) or htaccess.rewrite_normal(without wraps) to .htaccess under XOOPS_ROOT_PATH/modules/(dirname)/');
define($constpref.'_WRAPSAUTOREGIST','enable auto-registering HTML wrapped files into DB as contents');
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
define($constpref.'_FILTERSF','Forced filters');
define($constpref.'_FILTERSFDSC','input filter names separated with ,(comma). filter:LAST means the filter is passed in the last phase. The other filters are passed in the first phase.');
define($constpref.'_FILTERSP','Prohibited filters');
define($constpref.'_FILTERSPDSC','input filter names separated with ,(comma).');
define($constpref.'_USE_VOTE','use the feature of VOTE');
define($constpref.'_GUESTVOTE_IVL','Vote from guests');
define($constpref.'_GUESTVOTE_IVLDSC','Set this 0, to disable voting from guest. The other this number means time(sec.) to allow second post from the same IP.');
define($constpref.'_HTMLHEADER','common HTML header');
define($constpref.'_CSS_URI','URI of CSS file for this module');
define($constpref.'_CSS_URIDSC','relative or absolute path can be set. default: {mod_url}/index.css');
define($constpref.'_IMAGES_DIR','Directory for image files');
define($constpref.'_IMAGES_DIRDSC','relative path should be set in the module directory. default: images');
define($constpref.'_BODY_EDITOR','Editor for body');
define($constpref.'_COM_DIRNAME','Comment-integration: dirname of d3forum');
define($constpref.'_COM_FORUM_ID','Comment-integration: forum ID');

// blocks
define($constpref.'_BNAME_MENU','Menu');
define($constpref.'_BNAME_CONTENT','Content');
define($constpref.'_BNAME_LIST','List');

// Notify Categories
define($constpref.'_NOTCAT_GLOBAL', 'global');
define($constpref.'_NOTCAT_GLOBALDSC', 'notifications about this module');

// Each Notifications
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENT', 'waitings');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTCAP', 'Notify if new posts or modifications waiting approval (Just notify to admins or moderators)');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTSBJ', '[{X_SITENAME}] {X_MODULE}: waiting');

}


?>