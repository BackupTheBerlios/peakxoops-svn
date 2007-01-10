<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'wraps' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

define( $constpref.'_MODULE_DESCRIPTION' , 'ページラップ専用モジュール' ) ;

define( $constpref.'_UPDATE_SEARCH_INDEX' , '検索用インデックスの更新' ) ;

// configs
define( $constpref.'_INDEX_FILE' , 'トップページ' ) ;
define( $constpref.'_INDEX_FILEDSC' , 'モジュールトップにアクセスされた時にラップするファイルを指定します' ) ;
define( $constpref.'_INDEXAUTOUPD' , '検索インデックスの自動更新' ) ;
define( $constpref.'_INDEXLASTUPD' , '検索インデックスの最終更新日時' ) ;


}


?>