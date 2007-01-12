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
define( $constpref.'_ADMENU_CONTENTSADMIN' , 'コンテンツ一括管理' ) ;
define( $constpref.'_ADMENU_CATEGORYACCESS' , 'カテゴリーアクセス権限' ) ;
define( $constpref.'_ADMENU_IMPORT' , 'インポート/同期' ) ;

// configurations
define($constpref.'_TOP_MESSAGE','モジュールトップのメッセージ');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_MENUINMODULETOP','モジュールトップでは自動生成メニューを表示する');
define($constpref.'_LISTASINDEX','カテゴリートップでリストを表示する');
define($constpref.'_LISTASINDEXDSC','「はい」の場合、カテゴリートップではサブカテゴリーと直下のコンテンツがリスト式に表示されます。「いいえ」の場合、そのカテゴリー内で最も表示優先度の高いコンテンツが表示されます。');
define($constpref.'_SHOW_BREADCRUMBS','パンくずを表示する');
define($constpref.'_SHOW_PAGENAVI','ページナビゲーションを表示する');
define($constpref.'_SHOW_PRINTICON','印刷画面へのリンクを表示する');
define($constpref.'_SHOW_TELLAFRIEND','友達に紹介するリンクを表示する');
define($constpref.'_USE_TAFMODULE','tellafriendモジュールを利用する');
define($constpref.'_FILTERS','デフォルトフィルターセット');
define($constpref.'_FILTERSDSC','フィルター名を|で区切って入力します');
define($constpref.'_FILTERSDEFAULT','htmlspecialchars|smiley|xcode|nl2br');
define($constpref.'_USE_VOTE','投票機能を利用する');
define($constpref.'_GUESTVOTE_IVL','ゲスト投票の時間制限');
define($constpref.'_GUESTVOTE_IVLDSC','同一のIPからは、この時間（秒数）内は投票することができません');
define($constpref.'_HTMLHEADER','コンテンツ共通HTMLヘッダ');
define($constpref.'_CSS_URI','モジュール用CSSのURI');
define($constpref.'_CSS_URIDSC','このモジュール専用のCSSファイルのURIを相対パスまたは絶対パスで指定します。デフォルトはindex.cssです。');
define($constpref.'_IMAGES_DIR','イメージファイルディレクトリ');
define($constpref.'_IMAGES_DIRDSC','このモジュール用のイメージが格納されたディレクトリをモジュールディレクトリからの相対パスで指定します。デフォルトはimagesです。');
define($constpref.'_BODY_EDITOR','本文編集エディタ');
define($constpref.'_COM_DIRNAME','コメント統合するd3forumのdirname');
define($constpref.'_COM_FORUM_ID','コメント統合するフォーラムの番号');

// blocks
define($constpref.'_BNAME_MENU','メニュー');
define($constpref.'_BNAME_CONTENT','コンテンツ内容');
define($constpref.'_BNAME_LIST','コンテンツ一覧');

// Notify Categories
define($constpref.'_NOTCAT_GLOBAL', 'モジュール全体');
define($constpref.'_NOTCAT_GLOBALDSC', 'このpicoモジュール全体における通知オプション');

// Each Notifications
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENT', '承認待ち');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTCAP', 'コンテンツの新規登録・変更などで、承認が必要な投稿があった場合に通知する（モデレータ以外には通知されません）');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTSBJ', '[{X_SITENAME}] {X_MODULE}: 承認待ち');

}


?>