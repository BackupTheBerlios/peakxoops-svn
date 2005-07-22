<?php
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","悪意ある攻撃からXOOPSを守るためのモジュール<br />DoS,SQL Injection,変数汚染といった攻撃を主に防ぎます。");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","このブロックを効果的に利用するためには、すべてのページで左サイドに表示するようにし、表示優先順位を一番高く（並び順の数字を最小）します");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Protect Center");
define("_MI_PROTECTOR_ADVISORY","セキュリティガイド");
define("_MI_PROTECTOR_PREFIXMANAGER","PREFIX マネージャ");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','動作の一時的中断');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','あらゆる防御動作を一時的に無効化します。<br />問題が解決されたら無効化を解除することをお忘れなく');
define('_MI_PROTECTOR_RELIABLE_IPS','信用できるIP');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','DoS等の攻撃検知を行わない生IPアドレスを、| で区切って記述します。^は先頭を、$は末尾を表します。');
define('_MI_PROTECTOR_LOG_LEVEL','ログレベル');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','ログ出力一切なし');
define('_MI_PROTECTOR_LOGLEVEL15','危険性の高いものだけログを取る');
define('_MI_PROTECTOR_LOGLEVEL63','危険性の低いものはログしない');
define('_MI_PROTECTOR_LOGLEVEL255','全種類のロギングを有効とする');

define('_MI_PROTECTOR_HIJACK_DENYGP','IP変動を禁止するグループ');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','セッションハイジャック対策：<br />セッション中に異なるIPアドレスからのアクセスを禁止するグループを指定します<br />（管理者についてONにすることをお勧めします）');
define('_MI_PROTECTOR_SAN_NULLBYTE','ヌル文字列をスペースに変更する');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','文字列終了キャラクターである "\\0" は、悪意ある攻撃に利用されます。<br />これを見つけた時点でスペースに書き換えます<br />（ONがお勧めです）');
define('_MI_PROTECTOR_DIE_NULLBYTE','ヌル文字列を見つけた時点での強制終了');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','文字列終了キャラクターである "\\0" は、悪意ある攻撃に利用されます。<br />（ONがお勧めです）');
define('_MI_PROTECTOR_DIE_BADEXT','実行可能ファイルアップロードによる強制終了');
define('_MI_PROTECTOR_DIE_BADEXTDSC','拡張子が.phpなど、サーバ上で実行可能となりえるファイルがアップロードされた場合に強制終了します。<br />B-WikiやPukiWikiModをお使いで、頻繁にPHPソースファイルを添付する方は、OFFにして下さい');
define('_MI_PROTECTOR_CONTAMI_ACTION','変数汚染が見つかった時の処理');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','XOOPSのシステムグローバルを上書きしようとする攻撃を見つけた場合の処理を選択します。<br />（初期値は「強制終了」）');
define('_MI_PROTECTOR_ISOCOM_ACTION','孤立コメントが見つかった時の処理');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','SQLインジェクション対策：<br />ペアになる*/のない/*を見つけた時の処理を決めます。<br />無害化方法：最後に */ をつけます<br />「無害化」がお勧めです');
define('_MI_PROTECTOR_UNION_ACTION','UNIONが見つかった時の処理');
define('_MI_PROTECTOR_UNION_ACTIONDSC','SQLインジェクション対策：<br />SQLのUNION構文を検出した時の処理を決めます。<br />無害化方法：UNION を uni-on とします<br />「無害化」がお勧めです');
define('_MI_PROTECTOR_ID_INTVAL','ID風変数の強制変換');
define('_MI_PROTECTOR_ID_INTVALDSC','変数名がidで終わるものを、数字だと強制認識させます。myLinks派生モジュールに特に有効で、XSSなども防げますが、一部のモジュールで動作不良の原因となる可能性があります。');
define('_MI_PROTECTOR_FILE_DOTDOT','DirectoryTraversalの禁止');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','DirectoryTraversalを試みていると判断されたリクエスト文字列から、".." というパターンを取り除きます');

define('_MI_PROTECTOR_BF_COUNT','Brute Force対策');
define('_MI_PROTECTOR_BF_COUNTDSC','パスワード総当たりに対抗します。10分間中、ここで指定した回数以上、ログインに失敗すると、そのIPを拒否します。');

define('_MI_PROTECTOR_DOS_SKIPMODS','DoS監視の対象から外すモジュール');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','外したいモジュールのdirnameを|で区切って入力してください。チャット系モジュールなどに有効です');

define('_MI_PROTECTOR_DOS_EXPIRE','DoS等の監視時間 (秒)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','DoSや悪意あるクローラーのアクセス頻度を追うための監視単位時間');

define('_MI_PROTECTOR_DOS_F5COUNT','F5アタックと見なす回数');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','DoS攻撃の防御<br />上で設定した監視時間内に、この回数以上、同一URIへのアクセスがあったら、攻撃されたと見なします');
define('_MI_PROTECTOR_DOS_F5ACTION','F5アタックへの対処');

define('_MI_PROTECTOR_DOS_CRCOUNT','悪意あるクローラーと見なす回数');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','悪意あるクローラー（メアド収集ボット等）への対策<br />上で設定した監視時間内に、この回数以上、サイト内をさぐったら、悪意あるクローラーと見なします');
define('_MI_PROTECTOR_DOS_CRACTION','悪意あるクローラーへの対処');

define('_MI_PROTECTOR_DOS_CRSAFE','拒否しない User-Agent');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','無条件でクロール許可するエージェント名を、perlの正規表現で記述します<br />例) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','なし (ログのみ取る)');
define('_MI_PROTECTOR_OPT_SAN','無害化');
define('_MI_PROTECTOR_OPT_EXIT','強制終了');
define('_MI_PROTECTOR_OPT_BIP','拒否IP登録');

define('_MI_PROTECTOR_DOSOPT_NONE','なし (ログのみ取る)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep(非推奨)');
define('_MI_PROTECTOR_DOSOPT_EXIT','exit');
define('_MI_PROTECTOR_DOSOPT_BIP','拒否IPリストに載せる');
define('_MI_PROTECTOR_DOSOPT_HTA','.htaccessにDENY登録(試験的実装)');

define('_MI_PROTECTOR_BIP_EXCEPT','拒否IP登録の保護グループ');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','ここで指定されたユーザーからのアクセスは、条件を満たしてしまっても、拒否IPとして登録されません。ただし、そのユーザーがログインしていないと意味がありませんので、ご注意下さい。');
define('_MI_PROTECTOR_PATCH2092','Xoops 2.0.9.2以下に存在する穴へのパッチ');
define('_MI_PROTECTOR_PASSWD_BIP','レスキューパスワード');
define('_MI_PROTECTOR_PASSWD_BIPDSC','もし、何らかの理由で、あなた自身がXOOPSにIP拒否されてしまった場合の救済手段を提供します。<br /> XOOPS_URL/modules/protector/admin/rescue.php にアクセスして、ここで指定したパスワードを入力して下さい。<br />ここでパスワードが設定されていないと、レスキュー機能自体が無効になりますのでご注意下さい。<br />このパスワードは平文で保存されますので、万一覗かれても良いよう、あなたの重要なパスワードと同一にはしないで下さい。');

?>
