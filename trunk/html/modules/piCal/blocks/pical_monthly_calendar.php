<?php

// piCal xoops�ѥ֥�å��⥸�塼��
// pical_mini_calendar.php
// �֥�å��Ȥ��Ƥη��̥���������ɽ���ʻ��¾塢���󥿡��֥�å����ѡ�
// by GIJ=CHECKMATE (PEAK Corp. http://www.peak.ne.jp/)

if( ! defined( 'PICAL_BLOCK_MONTHLY_CALENDAR_INCLUDED' ) ) {

define( 'PICAL_BLOCK_MONTHLY_CALENDAR_INCLUDED' , 1 ) ;

function pical_monthly_calendar_show( $options )
{
	global $xoopsConfig , $xoopsDB ;

	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	// �Ƽ�ѥ�������
	$mod_path = XOOPS_ROOT_PATH."/modules/$mydirname" ;
	$mod_url = XOOPS_URL."/modules/$mydirname" ;

	// piCal���饹�����
	if( ! class_exists( 'piCal_xoops' ) ) {
		require_once( "$mod_path/class/piCal.php" ) ;
		require_once( "$mod_path/class/piCal_xoops.php" ) ;
	}

	// ���֥������Ȥ�����
	$cal = new piCal_xoops( "" , $xoopsConfig['language'] , true ) ;

	// cid �ˤ��ƶ�������ʤ��褦�ˤ���
	$cal->now_cid = 0 ;

	// �ƥץ�ѥƥ�������
	$cal->conn = $xoopsDB->conn ;	// �����private���ФʤΤǾ���Ū�ˤϥ���
	include( "$mod_path/include/read_configs.php" ) ;
	$cal->base_url = $mod_url ;
	$cal->base_path = $mod_path ;
	$cal->images_url = "$mod_url/images/$skin_folder" ;
	$cal->images_path = "$mod_path/images/$skin_folder" ;

	$original_level = error_reporting( E_ALL ^ E_NOTICE ) ;
	require_once( "$mod_path/include/patTemplate.php" ) ;
	$tmpl = new PatTemplate() ;
	$tmpl->readTemplatesFromFile( "$cal->images_path/block_monthly.tmpl.html" ) ;

	// ������ե�����Υ��å�
	$tmpl->addVar( "WholeBoard" , "SKINPATH" , $cal->images_url ) ;

	// ����Υ��å�
	$tmpl->addVar( "WholeBoard" , "LANG_PREV_MONTH" , _MB_PICAL_PREV_MONTH ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_NEXT_MONTH" , _MB_PICAL_NEXT_MONTH ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_YEAR" , _MB_PICAL_YEAR ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_MONTH" , _MB_PICAL_MONTH ) ;
	$tmpl->addVar( "WholeBoard" , "LANG_JUMP" , _MB_PICAL_JUMP ) ;

	// ����ȥ��顦�ܥ���ʤɤν�����
	$tmpl->addVar( "WholeBoard" , "GET_TARGET" , "$mod_url/index.php" ) ;
	$tmpl->addVar( "WholeBoard" , "QUERY_STRING" , '' ) ;

	// ���������إå�������ɬ�פʾ����Ϣ��������֤�
	$tmpl->addVars( "WholeBoard" , $cal->get_calendar_information( 'M' ) ) ;

	// ������������
	$tmpl->addVar( "WholeBoard" , "CALENDAR_BODY" , $cal->get_monthly_html( "$mod_url/index.php" ) ) ;

	// Ĺ�����٥�Ȥ�����
	foreach( $cal->long_event_legends as $bit => $legend ) {
		$tmpl->addVar( "LongEventLegends" , "BIT_MASK" , 1 << ( $bit - 1 ) ) ;
		$tmpl->addVar( "LongEventLegends" , "LEGEND_ALT" , _PICAL_MB_ALLDAY_EVENT . " $bit" ) ;
		$tmpl->addVar( "LongEventLegends" , "LEGEND" , $legend ) ;
		$tmpl->addVar( "LongEventLegends" , "SKINPATH" , $cal->images_url ) ;
		$tmpl->parseTemplate( "LongEventLegends" , "a" ) ;
	}

	// �Ǹ��patTemplate�ǥѡ���������Τ��֤�
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