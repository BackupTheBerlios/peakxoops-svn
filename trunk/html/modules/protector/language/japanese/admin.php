<?php

// index.php
define("_AM_TH_DATETIME","日時");
define("_AM_TH_USER","ユーザ");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","種別");
define("_AM_TH_DESCRIPTION","詳細");

define( "_AM_TH_BADIPS" , '拒否IPリスト<br /><br /><span style="font-weight:normal;">生IPアドレスを、| で区切って記述します。^は先頭を、$は末尾を表します。</span>' ) ;
define( "_AM_TH_ENABLEIPBANS" , "IPによる拒否を有効にする" ) ;

define( "_AM_LABEL_REMOVE" , "チェックしたレコードを削除する:" ) ;
define( "_AM_BUTTON_REMOVE" , "削除実行" ) ;
define( "_AM_JS_REMOVECONFIRM" , "本当に削除してよろしいですか？" ) ;
define( "_AM_MSG_PRUPDATED" , "設定を更新しました" ) ;
define( "_AM_MSG_REMOVED" , "削除しました" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "PREFIX マネージャ" ) ;
define( "_AM_MSG_DBUPDATED" , "データベースが更新されました" ) ;
define( "_AM_CONFIRM_DELETE" , "全テーブルが削除されますがよろしいですか?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "prefixを変更する場合は、%s/mainfile.php 内の以下の部分を書き換えてください<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","非推奨");

define("_AM_ADV_REGISTERGLOBALS","この設定は、様々な変数汚染攻撃を招きます<br />もし、.htaccessを置けるサーバであれば、XOOPSインストールディレクトリの.htaccessを作るか編集するかして下さい");
define("_AM_ADV_ALLOWURLFOPEN","この設定だと、外部の任意のスクリプトを実行される危険性があります<br />この設定変更にはサーバの管理者権限が必要です<br />ご自身で管理しているサーバであれば、php.iniやhttpd.confを編集して下さい<br />そうでない場合は、サーバ管理者にお願いしてみて下さい");
define("_AM_ADV_USETRANSSID","セッションIDが自動的にリンクに表示される設定となっています。<br />セッションハイジャックを防ぐためにも、XOOPSインストールディレクトリに.htaccessを作るか編集するかして下さい<br /><b>php_flag session.use_trans_sid off</b>");
define("_AM_ADV_DBPREFIX","DB接頭辞がデフォルトのxoopsのままなので、SQL Injectionに弱い状態です<br />「孤立コメントの無害化」など、SQL Injection対策の設定をONにすることをお忘れなく");
define("_AM_ADV_LINK_TO_PREFIXMAN","PREFIXマネージャへ");
define("_AM_ADV_MAINUNPATCHED","READMEに記述された通りに、mainfile.php にパッチを当てて下さい");
define("_AM_ADV_RESCUEPASSWORD","レスキューパスワード");
define("_AM_ADV_RESCUEPASSWORDUNSET","未設定");
define("_AM_ADV_RESCUEPASSWORDSHORT","出来れば6字以上で設定して下さい");

define("_AM_ADV_SUBTITLECHECK","Protectorの動作チェック");
define("_AM_ADV_AT1STSETPASSWORD","自分自身が拒否IPリストに載ってしまう可能性もありますので、まずレスキューパスワードを設定してください");
define("_AM_ADV_CHECKCONTAMI","変数汚染");
define("_AM_ADV_CHECKISOCOM","孤立コメント");


?>