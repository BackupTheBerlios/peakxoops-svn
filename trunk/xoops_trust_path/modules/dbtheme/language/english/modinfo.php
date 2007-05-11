<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'dbtheme' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","DB theme");

// A brief description of this module
define($constpref."_DESC","A module enables you to edit your theme in admin area");

// admin menus
define($constpref.'_ADMENU_MYLANGADMIN','Languages') ;
define($constpref.'_ADMENU_MYTPLSADMIN','Theme templates') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','Blocks/Permissions') ;
define($constpref.'_ADMENU_MYPREFERENCES','Preferences') ;

// blocks
define( $constpref.'_BNAME_THEMEHOOK' , 'Theme hook block' ) ;

// configs
define($constpref.'_BASETHEME','Base theme set') ;
define($constpref.'_BASETHEMEDSC','If you want to change the base of DB theme, update this module after change it. (Specify theme set as directory name)') ;
define($constpref.'_CSSCACHETIME','CSS cache time for browser (sec)') ;


}


?>