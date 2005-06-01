<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;

eval( '

function b_sitemap_'.$mydirname.'(){
	return b_sitemap_piCal_base( "'.$mydirname.'" ) ;
}

' ) ;

if( ! function_exists( 'b_sitemap_piCal_base' ) ) {

function b_sitemap_piCal_base( $mydirname )
{
	global $xoopsConfig , $xoopsDB , $xoopsUser ;
	$myts =& MyTextSanitizer::getInstance();

	// get $mydirnumber
	if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
	$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

	// 各種パスの設定
	$mod_path = XOOPS_ROOT_PATH."/modules/$mydirname" ;
	$mod_url = XOOPS_URL."/modules/$mydirname" ;

	// piCalクラスの定義
	if( ! class_exists( 'piCal_xoops' ) ) {
		require_once( "$mod_path/class/piCal.php" ) ;
		require_once( "$mod_path/class/piCal_xoops.php" ) ;
	}

	// オブジェクトの生成
	$cal = new piCal_xoops( '' , $xoopsConfig['language'] , true ) ;
	$cal->use_server_TZ = true ;

	// 各プロパティの設定
	$cal->conn = $xoopsDB->conn ;	// 本来はprivateメンバなので将来的にはダメ
	//$cal->table = $xoopsDB->prefix( PICAL_EVENT_TABLE ) ;
	include( "$mod_path/include/read_configs.php" ) ;

	$ret = array() ;
	foreach( $cal->categories as $cat ) {

		// only Top category is shown
		if( $cat->cat_depth > 1 ) continue ;

		$ret["parent"][] = array(
			"id" => $cat->cid ,
			"title" => $myts->makeTboxData4Show( $cat->cat_title ) ,
			"url" => "index.php?cid=$cat->cid"
		) ;

	}

	return $ret ;
}

}

?>
