<?php

// piCal xoops用ブロックモジュール
// pical_mini_calendar.php
// ブロックとしての月別カレンダーの表示（事実上、センターブロック専用）
// by GIJ=CHECKMATE (PEAK Corp. http://www.peak.ne.jp/)

if( ! defined( 'PICAL_BLOCK_MONTHLY_CALENDAR_INCLUDED' ) ) {

define( 'PICAL_BLOCK_MONTHLY_CALENDAR_INCLUDED' , 1 ) ;

function pical_monthly_calendar_show( $options )
{
	global $xoopsConfig , $xoopsDB ;

	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	// 各種パスの設定
	$mod_path = XOOPS_ROOT_PATH."/modules/$mydirname" ;
	$mod_url = XOOPS_URL."/modules/$mydirname" ;

	// piCalクラスの定義
	if( ! class_exists( 'piCal_xoops' ) ) {
		require_once( "$mod_path/class/piCal.php" ) ;
		require_once( "$mod_path/class/piCal_xoops.php" ) ;
	}

	// オブジェクトの生成
	$cal = new piCal_xoops( "" , $xoopsConfig['language'] , true ) ;

	// cid による影響を受けないようにする
	$cal->now_cid = 0 ;

	// 各プロパティの設定
	$cal->conn = $xoopsDB->conn ;	// 本来はprivateメンバなので将来的にはダメ
	include( "$mod_path/include/read_configs.php" ) ;
	$cal->base_url = $mod_url ;
	$cal->base_path = $mod_path ;
	$cal->images_url = "$mod_url/images/$skin_folder" ;
	$cal->images_path = "$mod_path/images/$skin_folder" ;

	$original_level = error_reporting( E_ALL ^ E_NOTICE ) ;
	require_once( "$mod_path/include/patTemplate.php" ) ;
	$tmpl = new PatTemplate() ;
	$tmpl->readTemplatesFromFile( "$cal->images_path/block_monthly.tmpl.html" ) ;

	// スキンフォルダのセット
	$tmpl->addVar( "WholeBoard" , "SKINPATH" , $cal->images_url ) ;

	// 言語のセット
	$tmpl->addVar( "WholeBoard" , "LANG_PREV_MONTH" , _MB_PICAL_PREV_MONTH ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_NEXT_MONTH" , _MB_PICAL_NEXT_MONTH ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_YEAR" , _MB_PICAL_YEAR ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_MONTH" , _MB_PICAL_MONTH ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_JUMP" , _MB_PICAL_JUMP ) ;

	// コントローラ・ボタンなどの処理先
	$tmpl->addVar( "WholeBoard" , "GET_TARGET" , "$mod_url/index.php" ) ;
	$tmpl->addVar( "WholeBoard" , "QUERY_STRING" , '' ) ;

	// カレンダーヘッダ部等に必要な情報を連想配列で返す
	$tmpl->addVars( "WholeBoard" , $cal->get_calendar_information( 'M' ) ) ;

	// カレンダー本体
	$tmpl->addVar( "WholeBoard" , "CALENDAR_BODY" , $cal->get_monthly_html( "$mod_url/index.php" ) ) ;

	// 長期イベントの凡例
	foreach( $cal->long_event_legends as $bit => $legend ) {
		$tmpl->addVar( "LongEventLegends" , "BIT_MASK" , 1 << ( $bit - 1 ) ) ;
		$tmpl->addVar( "LongEventLegends" , "LEGEND_ALT" , _PICAL_MB_ALLDAY_EVENT . " $bit" ) ;
		$tmpl->addVar( "LongEventLegends" , "LEGEND" , $legend ) ;
		$tmpl->addVar( "LongEventLegends" , "SKINPATH" , $cal->images_url ) ;
		$tmpl->parseTemplate( "LongEventLegends" , "a" ) ;
	}

	// 最後にpatTemplateでパースしたものを返す
	$block['content'] = $tmpl->getParsedTemplate( "WholeBoard" ) ;

	error_reporting( $original_level ) ;

	return $block ;
}



function pical_monthly_calendar_edit( $options )
{
	return '' ;
}

}

?>