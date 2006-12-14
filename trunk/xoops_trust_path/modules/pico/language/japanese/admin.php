<?php

define('_MD_A_MYMENU_MYTPLSADMIN','テンプレート管理');
define('_MD_A_MYMENU_MYBLOCKSADMIN','ブロック管理/アクセス権限');
define('_MD_A_MYMENU_MYPREFERENCES','一般設定');

// contents list admin
define('_MD_A_PICO_H2_CONTENTS','コンテンツ一括管理');
define('_MD_A_PICO_TH_CONTENTSID','ID');
define('_MD_A_PICO_TH_CONTENTSSUBJECT','記事名');
define('_MD_A_PICO_TH_CONTENTSWEIGHT','表示順');
define('_MD_A_PICO_TH_CONTENTSVISIBLE','表示');
define('_MD_A_PICO_TH_CONTENTSSHOWINNAVI','Navi');
define('_MD_A_PICO_TH_CONTENTSSHOWINMENU','Menu');
define('_MD_A_PICO_TH_CONTENTSALLOWCOMMENT','Com');
define('_MD_A_PICO_TH_CONTENTSFILTERS','フィルター');
define('_MD_A_PICO_TH_CONTENTSACTIONS','アクション');
define('_MD_A_PICO_LEGEND_CONTENTSTHS','表示:表示する &nbsp; Navi:ページナビに表示する &nbsp; Menu:メニューに表示する &nbsp; Com:コメント可能');
define('_MD_A_PICO_BTN_MOVE','移動');
define('_MD_A_PICO_LABEL_CONTENTSRIGHTCHECKED','右端がチェックされた記事を:');
define('_MD_A_PICO_MSG_CONTENTSMOVED','移動しました');

// category_access
define('_MD_A_PICO_LABEL_SELECTCATEGORY','カテゴリーを選択');
define('_MD_A_PICO_H2_GROUPPERMS','グループ毎の権限');
define('_MD_A_PICO_H2_USERPERMS','ユーザー毎の権限');
define('_MD_A_PICO_TH_UID','ユーザID');
define('_MD_A_PICO_TH_UNAME','ユーザ名');
define('_MD_A_PICO_TH_GROUPNAME','グループ名');
define('_MD_A_PICO_NOTICE_ADDUSERS','※ユーザを個別に新規追加する場合、ユーザID（数字）かユーザ名のいずれかを直接入力してください。<br />閲覧権限を外せば、そのユーザはこのリストからも消えます。');

// import
define('_MD_A_PICO_H2_IMPORTFROM','インポート');
define('_MD_A_PICO_LABEL_SELECTMODULE','モジュール選択');
define('_MD_A_PICO_BTN_DOIMPORT','インポート実行');
define('_MD_A_PICO_CONFIRM_DOIMPORT','本当にインポートを実行してよろしいですか？');
define('_MD_A_PICO_MSG_IMPORTDONE','インポート完了しました');
define('_MD_A_PICO_ERR_INVALIDMID','指定されたモジュールからはインポートできません');
define('_MD_A_PICO_ERR_SQLONIMPORT','インポートに失敗しました。インポート元とインポート先で、テーブル構造が違う可能性があります。両方とも最新版にアップデートしているか確認してください');
define('_MD_A_PICO_HELP_IMPORTFROM','インポート可能なのは、pico・TinyDです。可能な限りオリジナル情報を損なわない形でインポートしますが、完全な再現はできません。各種権限・モデレータについてチェックしてください。なおインポートの成功・不成功にかかわらず、現在のモジュール内の情報は全削除されます。');


?>