<?php

// <--- BASIC PROPERTY --->
define ('_MI_PLZXOO_NAME','教えて！Xoo');
define ('_MI_PLZXOO_NAME_DESC','plzXoo Module');

// <--- SUBMENU PROPERTY --->
define ( '_MI_PLZXOO_SUBMENU_QUESTION','質問する' );

// <--- ADMENU PROPERTY --->
define('_MI_PLZXOO_ADMENU_1','カテゴリ一覧');
define('_MI_PLZXOO_ADMENU_2','カテゴリ新規登録');
define('_MI_PLZXOO_ADMENU_3','パーミッションの設定');
define('_MI_PLZXOO_ADMENU_MYBLOCKSADMIN','ブロック・アクセス権限');
define('_MI_PLZXOO_ADMENU_MYTPLSADMIN','テンプレート管理');

// <--- BLOCKS PROPERTY --->
define('_MI_PLZXOO_BNAME1','質問一覧');

// <--- CONFIGS PROPERTY --->
define ( '_MI_PLZXOO_POINTS','ポイント選択肢' );
define ( '_MI_PLZXOO_POINTS_DESC','選択可能なポイント（半角数字）を|で区切って入力します。<br />制限したいポイントについては、「ポイント:最大回答数」と記述します。<br />0|10:5|20:1 の場合、20ptが１件だけ、10ptが５件まで、0ptは無制限となります。' );
define ( '_MI_PLZXOO_POINTS2POSTS','ポイントを投稿数に反映する' );
define ( '_MI_PLZXOO_POINTS2POSTS_DESC','ポイント確定時に、回答を投稿した人の投稿数が、ポイント分だけ増えます。' );

// <--- NOTIFICATIONS PROPERTY --->
define( '_MI_PLZXOO_GLOBAL_NOTIFY' , 'モジュール全体' ) ;
define( '_MI_PLZXOO_GLOBAL_NOTIFYDSC' , '教えて!Xooモジュール全体における通知オプション' ) ;
define( '_MI_PLZXOO_CATEGORY_NOTIFY' , 'カテゴリー' ) ;
define( '_MI_PLZXOO_CATEGORY_NOTIFYDSC' , '選択中のカテゴリーに対する通知オプション' ) ;
define( '_MI_PLZXOO_QUESTION_NOTIFY' , '質問' ) ;
define( '_MI_PLZXOO_QUESTION_NOTIFYDSC' , 'この質問に対する通知オプション' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFY' , '新規質問' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFYCAP' , '新規に質問が登録された時に通知する' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFYDSC' , '新規に質問が登録された時に通知する' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFYSBJ' , '[{X_SITENAME}] {X_MODULE}: 質問更新' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFY' , '新規質問' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFYCAP' , 'このカテゴリに新規に質問が登録された時に通知する' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFYDSC' , 'このカテゴリに新規に質問が登録された時に通知する' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFYSBJ' , '[{X_SITENAME}] {X_MODULE}: カテゴリー内質問更新' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFY' , '新規回答' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFYCAP' , 'この質問に回答が投稿された時に通知する' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFYDSC' , 'この質問に回答が投稿された時に通知する' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFYSBJ' , '[{X_SITENAME}] {X_MODULE}: 回答更新' ) ;



?>