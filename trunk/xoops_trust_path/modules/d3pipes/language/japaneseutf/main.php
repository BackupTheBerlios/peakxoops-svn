<?php

define('_MD_D3PIPES_H2_INDEX','インデックス');
define('_MD_D3PIPES_H2_LATESTHEADLINES','最新記事一覧');
define('_MD_D3PIPES_H2_EACHPIPE','記事一覧');
define('_MD_D3PIPES_H2_CLIPPING','切り抜き詳細');


define('_MD_D3PIPES_JOINT_FETCH','外部から取得');
define('_MD_D3PIPES_JOINT_BLOCK','ブロック関数からの取得/解析');
define('_MD_D3PIPES_JOINT_PARSE','XML解析');
define('_MD_D3PIPES_JOINT_UTF8TO','コード変換(UTF8から)');
define('_MD_D3PIPES_JOINT_UTF8FROM','コード変換(UTF8へ)');
define('_MD_D3PIPES_JOINT_CLIP','ローカル保存');
define('_MD_D3PIPES_JOINT_FILTER','絞り込み');
define('_MD_D3PIPES_JOINT_REASSIGN','再割り当て');
define('_MD_D3PIPES_JOINT_UNION','他パイプの連結');

define('_MD_D3PIPES_N4J_FETCH','RSS/ATOM等のURLを記入');
define('_MD_D3PIPES_N4J_BLOCK','モジュールのdirnameを記入');
define('_MD_D3PIPES_N4J_PARSE','RDF/RSS/ATOMの別を記入（判らなければ空欄）');
define('_MD_D3PIPES_N4J_UTF8TO','通常は、内部エンコーディングを記入');
define('_MD_D3PIPES_N4J_UTF8FROM','通常は、XMLのエンコーディングを記入');
define('_MD_D3PIPES_N4J_CLIP','キャッシュ時間を記入(単位は秒)');
define('_MD_D3PIPES_N4J_FILTER','正規表現など絞り込むためのパターンを記入');
define('_MD_D3PIPES_N4J_REASSIGN','再割り当てのルールを記入');
define('_MD_D3PIPES_N4J_UNION','統合するパイプ番号すべてをカンマ区切りで記入');


define('_MD_D3PIPES_TH_PUBTIME','発行日時');
define('_MD_D3PIPES_TH_PIPENAME','パイプ名');
define('_MD_D3PIPES_TH_HEADLINE','見出し');
define('_MD_D3PIPES_TH_LINKURL','リンクURL');
define('_MD_D3PIPES_TH_DESCRIPTION','記事詳細');
define('_MD_D3PIPES_TH_ACTIONTOCLIPPING','この切り抜きへの操作');

define('_MD_D3PIPES_LABEL_HIGHLIGHTCLIPPING','注目マークをつける');

define('_MD_D3PIPES_BTN_UPDATE','更新する');

define('_MD_D3PIPES_FMT_EXTERNALLINK','%sへの外部リンク');

define('_MD_D3PIPES_MSG_CLIPPINGUPDATED','切り抜きを更新しました');

define('_MD_D3PIPES_ERR_INVALIDCLIPPINGID','該当する切り抜きはありません');
define('_MD_D3PIPES_ERR_INVALIDPIPEID','該当するパイプがありません');
define('_MD_D3PIPES_ERR_PERMISSION','操作権限がありません');
define('_MD_D3PIPES_ERR_INVALIDPIPEIDINBLOCK','該当するパイプを表示できません。ブロック管理の「編集」からパイプを再度指定し直してください');
define('_MD_D3PIPES_ERR_PARSETYPEMISMATCH','XML解析のタイプがマッチしていないため、エントリを抽出できません');
define('_MD_D3PIPES_ERR_CACHEFOLDERNOTWRITABLE','キャッシュ用ディレクトリがないか書込可能になっていません');
define('_MD_D3PIPES_ERR_INVALIDURIINFETCH','取得ジョイントで有効なURI指定がされていません');
define('_MD_D3PIPES_ERR_CANTCONNECTINFETCH','取得先に接続できません');
define('_MD_D3PIPES_ERR_URLFOPENINFETCH','allow_url_fopenがoffの場合はfopenは利用できません');
define('_MD_D3PIPES_ERR_INVALIDDIRNAMEINBLOCK','ブロック関数ジョイントでモジュールディレクトリ名の指定にミスがあります');
define('_MD_D3PIPES_ERR_INVALIDFILEINBLOCK','ブロック関数ジョイントでファイル名指定にミスがあります');
define('_MD_D3PIPES_ERR_INVALIDFUNCINBLOCK','ブロック関数ジョイントで関数名指定にミスがあります');


?>