<?php

define('_MD_PICO_TOP','トップ');
define('_MD_PICO_CREATED','作成');
define('_MD_PICO_MODIFIED','更新');
define('_MD_PICO_VIEWED','閲覧数');
define('_MD_PICO_NEXT','次');
define('_MD_PICO_PREV','前');
define('_MD_PICO_CATEGORYINDEX','カテゴリートップ');

define('_MD_PICO_CATEGORY','カテゴリー');
define('_MD_PICO_CATEGORIES','カテゴリー');
define('_MD_PICO_SUBCATEGORY','サブカテゴリー');
define('_MD_PICO_SUBCATEGORIES','サブカテゴリー');
define('_MD_PICO_CONTENT','コンテンツ');
define('_MD_PICO_CONTENTS','コンテンツ');

define('_MD_PICO_LINK_MAKECATEGORY','サブカテゴリー作成');
define('_MD_PICO_LINK_MAKESUBCATEGORY','サブカテゴリー作成');
define('_MD_PICO_LINK_MAKECONTENT','コンテンツ作成');
define('_MD_PICO_LINK_EDITCATEGORY','カテゴリー編集');
define('_MD_PICO_LINK_EDITCONTENT','コンテンツ編集');

define('_MD_PICO_LINK_PRINTERFRIENDLY','プリンタ用画面');
define('_MD_PICO_LINK_TELLAFRIEND','友達に伝える');
define('_MD_PICO_MAILTOENCODING','Shift_JIS'); // don't define it for singlebyte
define('_MD_PICO_FMT_TELLAFRIENDSUBJECT','%sで見つけた記事');
define('_MD_PICO_FMT_TELLAFRIENDBODY',"興味深い記事を見つけました\n記事タイトル:%s");

define('_MD_PICO_ERR_SQL','SQLエラーが発生しました。行: ');
define('_MD_PICO_ERR_PIDLOOP','親子関係でループが発生しています');

define('_MD_PICO_MSG_UPDATED','更新しました');

define('_MD_PICO_ERR_READCATEGORY','このカテゴリーの読み出し権限がありません');
define('_MD_PICO_ERR_CREATECATEGORY','カテゴリー作成権限がありません');
define('_MD_PICO_ERR_CATEGORYMANAGEMENT','カテゴリー管理権限がありません');
define('_MD_PICO_ERR_READCONTENT','指定されたコンテンツは存在しません');
define('_MD_PICO_ERR_CREATECONTENT','コンテンツ作成権限がありません');
define('_MD_PICO_ERR_EDITCONTENT','コンテンツ編集権限がありません');
define('_MD_PICO_ERR_DELETECONTENT','コンテンツ削除権限がありません');

define('_MD_PICO_MSG_CATEGORYMADE','カテゴリーを作成しました');
define('_MD_PICO_MSG_CATEGORYUPDATED','カテゴリーを更新しました');
define('_MD_PICO_MSG_CATEGORYDELETED','カテゴリーを削除しました');
define('_MD_PICO_MSG_CONTENTMADE','コンテンツを作成しました');
define('_MD_PICO_MSG_CONTENTUPDATED','コンテンツを更新しました');
define('_MD_PICO_MSG_CONTENTDELETED','コンテンツを削除しました');

define('_MD_PICO_CATEGORYMANAGER','カテゴリーマネージャ');
define('_MD_PICO_CONTENTMANAGER','コンテンツマネージャ');
define('_MD_PICO_TH_SUBJECT','表題');
define('_MD_PICO_TH_HTMLHEADER','HTMLヘッダー');
define('_MD_PICO_TH_BODY','本文');
define('_MD_PICO_TH_FILTERS','本文フィルター');
define('_MD_PICO_TH_WEIGHT','表示順');
define('_MD_PICO_TH_USECACHE','本文キャッシュ');
define('_MD_PICO_NOTE_USECACHEDSC','※閲覧条件によって内容が異なるコンテンツの場合にはOFFにしてください。ただし、ここがONでない記事は検索対象となりません。');
define('_MD_PICO_TH_VISIBLE','表示');
define('_MD_PICO_TH_CATEGORYTITLE','タイトル');
define('_MD_PICO_TH_CATEGORYDESC','説明');
define('_MD_PICO_TH_CATEGORYPARENT','親カテゴリー');
define('_MD_PICO_TH_CATEGORYWEIGHT','表示順');
define('_MD_PICO_TH_CATEGORYOPTIONS','オプション');
define('_MD_PICO_SUBCATEGORY_COUNT','サブカテゴリー数');
define('_MD_PICO_MSG_CONFIRMDELETECATEGORY','このカテゴリーに含まれるコンテンツもすべて削除されますがよろしいですか？');
define('_MD_PICO_MSG_CONFIRMDELETECONTENT','コンテンツを削除してよろしいですか？');
define('_MD_PICO_MSG_GOTOPREFERENCE4EDITTOP','トップカテゴリーは特別なカテゴリーです。設定変更は管理画面の一般設定で行います');
define('_MD_PICO_LABEL_HTMLHEADERONOFF','HTMLヘッダカスタマイズ部表示');
define('_MD_PICO_LABEL_INPUTHELPER','入力支援ON/OFF');


// filters
define('_MD_PICO_FILTERS_EVALTITLE','phpコード');
define('_MD_PICO_FILTERS_EVALDESC','eval()に渡してPHPコードとして解釈/実行されます');
define('_MD_PICO_FILTERS_EVALINITWEIGHT',0);
define('_MD_PICO_FILTERS_HTMLSPECIALCHARSTITLE','HTML特殊文字エスケープ');
define('_MD_PICO_FILTERS_HTMLSPECIALCHARSDESC','明示的にHTMLとしての解釈を禁止したい時に有効にします。BBCode等の各種修飾処理と併用する時には必ず先頭に置いてください。');
define('_MD_PICO_FILTERS_HTMLSPECIALCHARSINITWEIGHT',5);
define('_MD_PICO_FILTERS_TEXTWIKITITLE','PEAR TextWiki');
define('_MD_PICO_FILTERS_TEXTWIKIDESC','TextWikiルールで整形されます');
define('_MD_PICO_FILTERS_TEXTWIKIINITWEIGHT',15);
define('_MD_PICO_FILTERS_XOOPSTPLTITLE','Smarty(XoopsTpl)');
define('_MD_PICO_FILTERS_XOOPSTPLDESC','Smartyテンプレートとして解釈されます');
define('_MD_PICO_FILTERS_XOOPSTPLINITWEIGHT',15);
define('_MD_PICO_FILTERS_NL2BRTITLE','自動改行');
define('_MD_PICO_FILTERS_NL2BRDESC','改行文字を&lt;br /&gt;に置き換えます');
define('_MD_PICO_FILTERS_NL2BRINITWEIGHT',30);
define('_MD_PICO_FILTERS_SMILEYTITLE','顔文字変換');
define('_MD_PICO_FILTERS_SMILEYDESC',':-) などのスマイリーが画像に置き換わります');
define('_MD_PICO_FILTERS_SMILEYINITWEIGHT',30);
define('_MD_PICO_FILTERS_XCODETITLE','BBCode変換');
define('_MD_PICO_FILTERS_XCODEDESC','自動リンクおよびBBCodeが有効になります');
define('_MD_PICO_FILTERS_XCODEINITWEIGHT',30);


?>