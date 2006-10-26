<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'wraps' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

define( $constpref.'_MODULE_DESCRIPTION' , 'A little module for wrapping' ) ;

define( $constpref.'_UPDATE_SEARCH_INDEX' , 'Update indexes for searching' ) ;

// configs
define( $constpref.'_INDEX_FILE' , 'Top page' ) ;
define( $constpref.'_INDEX_FILEDSC' , 'specify the file should be wrapped when the top of this module is accessed' ) ;


}


?>