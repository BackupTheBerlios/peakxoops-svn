<?php
// $Id: modinfo.php,v 1.1 2003/07/02 17:59:05 onokazu Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format
define("_MI_DEFAULT_DTFMT_SHORT","m/d H:i");

// The name of this module
define("_MI_HEADLINES_NAME","ヘッドライン");

// A brief description of this module
define("_MI_HEADLINES_DESC","RSS/XML形式のニュース記事をブロック内に表示します");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","ヘッドラインブロック");
define("_MI_HEADLINES_BDESC","取得したヘッドラインをフィード毎に個別表示するブロック");
define("_MI_HEADLINES_BNAME_MIXED","最新ヘッドラインブロック");
define("_MI_HEADLINES_BDESC_MIXED","取得したヘッドラインをまとめて最新順に並び替えて表示するブロック");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","フィード管理");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","ブロック・グループ管理");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","表示モード選択");
define("_MI_HEADLINES_INDEX_VIEWMODED","モジュールトップページの表示形式の選択");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","新着一覧表示");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","クラシック表示");
define("_MI_HEADLINES_MIXED_MAXITEM","新着リストの表示タイトル総数");
define("_MI_HEADLINES_MIXED_MAXITEMD", "表示モード選択が「新着一覧表示」の時、リストの最大表示件数の設定 (単位は行数)");
define("_MI_HEADLINES_MIXED_MAXLEN","新着リストの最大表示文字数");
define("_MI_HEADLINES_MIXED_MAXLEND", "表示モード選択が「新着一覧表示」の時、タイトルの最大表示文字数の設定 (単位はbyte)");
define("_MI_HEADLINES_PROXY_HOST","プロクシホスト");
define("_MI_HEADLINES_PROXY_HOSTD","プロクシ経由でRSS/ATOMを取得する場合、ここにそのホスト名またはIPを記述します。<br />プロクシを経由しない場合は、空欄のままにします");
define("_MI_HEADLINES_PROXY_PORT","プロクシポート番号");
define("_MI_HEADLINES_PROXY_PORTD","プロクシを経由する場合、そのポート番号を数字で入力します") ;
define("_MI_HEADLINES_PROXY_USER","プロクシユーザ名");
define("_MI_HEADLINES_PROXY_USERD","プロクシが認証を必要とする場合、そのユーザ名を入力します<br />必要がなければ空欄のままにします") ;
define("_MI_HEADLINES_PROXY_PASS","プロクシパスワード");
define("_MI_HEADLINES_PROXY_PASSD","プロクシが認証を必要とする場合、そのパスワードを入力します<br />必要がなければ空欄のままにします") ;
define("_MI_HEADLINES_SHORTDTFMT","記事発行時間のフォーマット（短縮形）");
define("_MI_HEADLINES_SHORTDTFMTD","PHPのdate()関数のフォーマットで記述します。<br /><a href='http://jp.php.net/date'>PHPマニュアルを参照</a>") ;
define("_MI_HEADLINES_MIXPICKUP","新着一覧には各フィードの取得上限しか載らない");
define("_MI_HEADLINES_MIXPICKUPD","「いいえ」の場合、各フィードで設定されたメインページやブロックの最大表示件数は無視され、純粋に新しい記事から順に並びます");

}

?>