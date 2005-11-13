<?php
// $Id: admin.php,v 1.1 2003/07/02 17:59:05 onokazu Exp $
//%%%%%%        Admin Module Name  Headlines         %%%%%

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_AM_DBUPDATED' ) ) {

// list of encodings allowed   (name):(TITLE)|(name):(TITLE)|...
define('_AM_ENCODINGS','utf-8:UTF-8|euc-jp:EUC-JP|shift_jis:SJIS|iso-8859-1:ISO-8859-1|us-ascii:US-ASCII') ;
define('_AM_ENCODING_AUTO','自動検出') ;

define('_AM_DBUPDATED','データベースを更新しました!');
define('_AM_HEADLINES','フィード管理 (No.%s)');
define('_AM_HLMAIN','ヘッドラインメイン');
define('_AM_SITENAME','サイト名');
define('_AM_URL','サイトURL');
define('_AM_TITLEPATTERN','タイトルによる絞り込み条件<br /><span style="font-weight:normal;">perlの正規表現で記入 例) /円/<br />※あえて絞り込む必要がなければ空欄のままにします</span>');
define('_AM_TITLEEXCLUDE','タイトルによる排除条件<br /><span style="font-weight:normal;">perlの正規表現で記入（通常は空欄）</span>');
define('_AM_LINKPATTERN','リンクによる絞り込み条件<br /><span style="font-weight:normal;">perlの正規表現で記入 例) /business/<br />※あえて絞り込む必要がなければ空欄のままにします</span>');
define('_AM_LINKEXCLUDE','リンクによる排除条件<br /><span style="font-weight:normal;">perlの正規表現で記入（通常は空欄）</span>');
define('_AM_ORDER', '表示順');
define('_AM_ENCODING', 'エンコード');
define('_AM_CACHETIME', '取得キャッシュ');
define('_AM_TIMEOUT', '取得時の最大待ち時間');
define('_AM_ALLOWHTML', '表示時にHTMLタグ許可する<br /><span style="font-weight:normal;">悪意ある投稿がRSSに流れてしまう可能性のあるCMS等のサイトが発行するフィードについては、HTMLを許可しないことを強くお勧めします</span>');
define('_AM_MAINSETT', 'メインページの設定');
define('_AM_BLOCKSETT', 'ブロックの設定');
define('_AM_DISPIMG', '画像を表示');
define('_AM_DISPFULL', '各ヘッドラインの公開日や要旨も表示');
define('_AM_DISPMAX', '最大表示件数');
define('_AM_DISPLAY', 'メインページ');
define('_AM_ASBLOCK', 'ブロック');
define('_AM_ADDHEADL','ヘッドラインの新規追加');
define('_AM_URLEDFXML','RSSまたはATOMのURI');
define('_AM_SYNDICATIONTYPE','フィードタイプ');
define('_AM_SYNDICATIONTYPE_AUTO','自動判別');
define('_AM_SAVEAS','別レコードとして保存');
define('_AM_UPDATE','更新・再取得');
define('_AM_EDITHEADL','ヘッドラインの編集');
define('_AM_WANTDEL','本当にこのヘッドラインを削除してもよろしいですか？<br> サイト名： %s');
define('_AM_INVALIDID', 'IDが正しくありません');
define('_AM_OBJECTNG', 'オブジェクトが存在しません');
define('_AM_FAILUPDATE', 'ヘッドラインの保存ができませんでした<br> %s');
define('_AM_FAILDELETE', 'ヘッドラインの削除ができませんでした<br> %s');

}

?>
