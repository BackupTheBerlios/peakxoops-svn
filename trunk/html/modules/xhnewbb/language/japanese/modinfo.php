<?php
// Module Info

// The name of this module
define("_MI_XHNEWBB_NAME","フォーラム");

// A brief description of this module
define("_MI_XHNEWBB_DESC","XOOPSフォーラムモジュール");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","投稿一覧");
define("_MI_XHNEWBB_BDESC1","このブロックを「編集」することで、様々な用途に使えます。もちろん、いくつでも置けます。");

define("_MI_XHNEWBB_ADMENU1","フォーラムの追加");
define("_MI_XHNEWBB_ADMENU2","フォーラムの編集");
define("_MI_XHNEWBB_ADMENU3","プライベートフォーラムの設定");
define("_MI_XHNEWBB_ADMENU4","投稿数の再集計");
define("_MI_XHNEWBB_ADMENU5","カテゴリの追加");
define("_MI_XHNEWBB_ADMENU6","カテゴリの編集");
define("_MI_XHNEWBB_ADMENU7","カテゴリーの削除");
define("_MI_XHNEWBB_ADMENU8","カテゴリの配置変更");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","ブロック・グループ管理");
define("_MI_XHNEWBB_ADMENU_MYTPLSADMIN","テンプレート管理");

// configurations
define('_MI_XHNEWBB_ALLOW_TEXTIMG','投稿本文内の外部画像を許可する');
define('_MI_XHNEWBB_ALLOW_TEXTIMGDSC','投稿本文に[img]タグで外部サイトの画像を表示させると、このサイトの訪問者のIPやUser-Agentを抜かれることにつながります');
define('_MI_XHNEWBB_ALLOW_SIGIMG','署名内の外部画像を許可する');
define('_MI_XHNEWBB_ALLOW_SIGIMGDSC','署名に[img]タグで外部サイトの画像を表示させると、このサイトの訪問者のIPやUser-Agentを抜かれることにつながります');

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', '表示中のトピック'); 
define ('_MI_XHNEWBB_THREAD_NOTIFYDSC', '表示中のトピックに対する通知オプション');

define ('_MI_XHNEWBB_FORUM_NOTIFY', '表示中のフォーラム'); 
define ('_MI_XHNEWBB_FORUM_NOTIFYDSC', '表示中のフォーラムに対する通知オプション');

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', 'モジュール全体');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', 'フォーラムモジュール全体における通知オプション');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', '返信の投稿');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', 'このトピックにおいて返信が投稿された場合に通知する');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC', 'このトピックにおいて返信が投稿された場合に通知する');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: トピック内に返信が投稿されました');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', '新規トピック');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', 'このフォーラムにおいて新規トピックの投稿があった場合に通知する');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC', 'このフォーラムにおいて新規トピックの投稿があった場合に通知する');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規トピックが投稿されました');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', '新規フォーラム');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP', '新規フォーラムが作成された場合に通知する');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC', '新規フォーラムが作成された場合に通知する');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規フォーラムが作成されました');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', '新規投稿');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', '新規トピックまたは返信の投稿があった場合に通知する');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', '新規トピックまたは返信の投稿があった場合に通知する');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規投稿がありました');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', '新規投稿');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', 'このフォーラムにおいて新規投稿があった場合に通知する');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', 'このフォーラムにおいて新規投稿があった場合に通知する');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: フォーラムにて新規投稿がありました');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', '新規投稿（投稿文含む）');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', '新規トピックまたは返信の投稿があった場合に通知する（投稿文付き）');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', '新規トピックまたは返信の投稿があった場合に通知する（投稿文付き）');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規投稿（投稿文付き）');


?>
