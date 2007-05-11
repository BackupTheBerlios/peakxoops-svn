<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'dbtheme' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","DB theme");

// A brief description of this module
define($constpref."_DESC","管理画面上でテーマを編集できるようにするモジュール");

// admin menus
define($constpref.'_ADMENU_MYLANGADMIN','言語定数管理') ;
define($constpref.'_ADMENU_MYTPLSADMIN','テンプレート管理') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','ブロック管理/アクセス権限') ;
define($constpref.'_ADMENU_MYPREFERENCES','一般設定') ;

// blocks
define($constpref.'_BNAME_THEMEHOOK','テーマフックブロック') ;

// configs
define($constpref.'_BASETHEME','ベーステーマ') ;
define($constpref.'_BASETHEMEDSC','ベースとなるテーマを変更する時には、ここにテーマディレクトリ名を設定した後に、モジュールアップデートをかけてください。') ;
define($constpref.'_CSSCACHETIME','CSSのブラウザキャッシュ時間(sec)') ;

}


?>