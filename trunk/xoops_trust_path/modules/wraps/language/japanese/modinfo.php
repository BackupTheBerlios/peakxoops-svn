<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'wraps' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

define( $constpref.'_MODULE_DESCRIPTION' , '�ڡ�����å����ѥ⥸�塼��' ) ;

define( $constpref.'_UPDATE_SEARCH_INDEX' , '�����ѥ���ǥå����ι���' ) ;

}


?>