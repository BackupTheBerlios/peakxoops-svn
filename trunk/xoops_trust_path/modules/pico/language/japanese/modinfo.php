<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","pico");

// A brief description of this module
define($constpref."_DESC","静的コンテンツ作成モジュール");

// admin menus
define( $constpref.'_ADMENU_CATEGORYACCESS' , 'カテゴリーアクセス権限' ) ;

// configurations
define($constpref.'_TOP_MESSAGE','モジュールトップのメッセージ');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_SHOW_LISTASINDEX','カテゴリートップでリストを表示する');
define($constpref.'_SHOW_BREADCRUMBS','パンくずを表示する');
define($constpref.'_SHOW_PAGENAVI','ページナビゲーションを表示する');
define($constpref.'_SHOW_PRINTICON','印刷画面へのリンクを表示する');
define($constpref.'_SHOW_TELLAFRIEND','友達に紹介するリンクを表示する');
define($constpref.'_FILTERS','デフォルトフィルターセット');
define($constpref.'_FILTERSDSC','フィルター名を|で区切って入力する');
define($constpref.'_FILTERSDEFAULT','');
define($constpref.'_USE_VOTE','投票機能を利用する');
define($constpref.'_GUESTVOTE_IVL','ゲスト投票の時間制限');
define($constpref.'_GUESTVOTE_IVLDSC','同一のIPからは、この時間（秒数）内は投票することができない');
define($constpref.'_HTMLHEADER','コンテンツ共通HTMLヘッダ');
define($constpref.'_CSS_URI','モジュール用CSSのURI');
define($constpref.'_CSS_URIDSC','このモジュール専用のCSSファイルのURIを相対パスまたは絶対パスで指定します。デフォルトはindex.cssです。');
define($constpref.'_IMAGES_DIR','イメージファイルディレクトリ');
define($constpref.'_IMAGES_DIRDSC','このモジュール用のイメージが格納されたディレクトリをモジュールディレクトリからの相対パスで指定します。デフォルトはimagesです。');
define($constpref.'_COM_DIRNAME','コメント統合するd3forumのdirname');
define($constpref.'_COM_FORUM_ID','コメント統合するフォーラムの番号');



}


?>