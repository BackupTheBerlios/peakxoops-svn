<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3pipes' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","D3 PIPES");

// A brief description of this module
define($constpref."_DESC","RSS等のシンジケーションを自由自在に扱うためのモジュール");

// admin menus
define($constpref.'_ADMENU_PIPE','パイプ管理') ;
define($constpref.'_ADMENU_CACHE','キャッシュ管理') ;
define($constpref.'_ADMENU_CLIPPING','切り抜き管理') ;
define($constpref.'_ADMENU_JOINT','ジョイント初期設定') ;
define($constpref.'_ADMENU_JOINTCLASS','ジョイントクラス初期設定') ;
define($constpref.'_ADMENU_MYTPLSADMIN','テンプレート管理') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','ブロック管理/アクセス権限') ;
define($constpref.'_ADMENU_MYPREFERENCES','一般設定') ;

// blocks
define($constpref.'_BNAME_ASYNC','非同期パイプ一覧ブロック') ;

// configs
define($constpref.'_INDEXTOTAL','モジュールトップで表示する最新ヘッドラインの総数');
define($constpref.'_INDEXEACH','モジュールトップで表示する最新ヘッドラインに１パイプから引っ張ってくる最大数');
define($constpref.'_ENTRIESAPIPE','パイプ個別表示やRSS/ATOMで表示するエントリ数');
define($constpref.'_ARCB_FETCHED','切り抜きを自動削除する日数（取得日ベース）');
define($constpref.'_ARCB_FETCHEDDSC','エントリを切り抜きとして保存した日から何日で削除するかを指定します。自動削除しない場合は0を指定します。また、コメントやハイライト属性がついたコメントは削除されません。あえて削除する場合は切り抜き管理から明示的に削除してください。');
define($constpref.'_INTERNALENC','内部エンコーディング');
define($constpref.'_CSS_URI','モジュール用CSSのURI');
define($constpref.'_CSS_URIDSC','このモジュール専用のCSSファイルのURIを相対パスまたは絶対パスで指定します。デフォルトは{mod_url}/index.php?page=main_cssです。');
define($constpref.'_IMAGES_DIR','イメージファイルディレクトリ');
define($constpref.'_IMAGES_DIRDSC','このモジュール用のイメージが格納されたディレクトリをモジュールディレクトリからの相対パスで指定します。デフォルトはimagesです。');
define($constpref.'_COM_DIRNAME','コメント統合するd3forumのdirname');
define($constpref.'_COM_FORUM_ID','コメント統合するフォーラムの番号');

}


?>