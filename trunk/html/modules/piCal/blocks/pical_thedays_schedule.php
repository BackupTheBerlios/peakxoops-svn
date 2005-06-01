<?php

// piCal xoops�ѥ֥�å��⥸�塼��
// pical_thedays_schedule.php
// caldate�ǻ��ꤵ�줿�����Υ������塼���֥�å���ɽ��
// by GIJ=CHECKMATE (PEAK Corp. http://www.peak.ne.jp/)

if( ! defined( 'PICAL_BLOCK_THEDAYS_SCHEDULE_INCLUDED' ) ) {

define( 'PICAL_BLOCK_THEDAYS_SCHEDULE_INCLUDED' , 1 ) ;

function pical_thedays_schedule_show_tpl( $options )
{
	global $xoopsConfig , $xoopsDB ;

	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;
	$now_cid = empty( $options[1] ) ? 0 : intval( $options[1] ) ;

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

	// cid �ˤ��ʤ����
	$cal->now_cid = $now_cid ;

	// �ƥץ�ѥƥ�������
	$cal->conn = $xoopsDB->conn ;	// �����private���ФʤΤǾ���Ū�ˤϥ���
	include( "$mod_path/include/read_configs.php" ) ;
	$cal->base_url = $mod_url ;
	$cal->base_path = $mod_path ;
	$cal->images_url = "$mod_url/images/$skin_folder" ;
	$cal->images_path = "$mod_path/images/$skin_folder" ;

	// �֥�å�����μ�ʬ���Ȥ�񤭴����� title �� %s ��ޤ�뤳��
	global $block_arr , $i ;
	if( is_object( $block_arr[$i] ) ) {
		$title_fmt = $block_arr[$i]->getVar( 'title' ) ;
		$title = sprintf( $title_fmt , sprintf( _PICAL_FMT_MD , $cal->month_short_names[ date( 'n' , $cal->unixtime ) ] , $cal->date_short_names[ date( 'j' , $cal->unixtime ) ] ) ) ;
		$block_arr[$i]->setVar( 'title' , $title ) ;
	}

	$block =& $cal->get_blockarray_date_event( "$mod_url/index.php" ) ;
	return $block ;
}



function pical_thedays_schedule_edit( $options )
{
	global $xoopsDB , $xoopsConfig ;

	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;
	$now_cid = empty( $options[1] ) ? 0 : intval( $options[1] ) ;

	// �Ƽ�ѥ�������
	$mod_path = XOOPS_ROOT_PATH."/modules/$mydirname" ;
	$mod_url = XOOPS_URL."/modules/$mydirname" ;

	// piCal���饹�����
	require_once( "$mod_path/class/piCal.php" ) ;
	require_once( "$mod_path/class/piCal_xoops.php" ) ;

	// ���֥������Ȥ�����
	$cal = new piCal_xoops( date( 'Y-n-j' ) , $xoopsConfig['language'] , true ) ;
	$cal->use_server_TZ = true ;

	// �ƥץ�ѥƥ�������
	$cal->conn = $xoopsDB->conn ;	// �����private���ФʤΤǾ���Ū�ˤϥ���
	include( "$mod_path/include/read_configs.php" ) ;
	$cal->base_url = $mod_url ;
	$cal->base_path = $mod_path ;
	$cal->images_url = "$mod_url/images/$skin_folder" ;
	$cal->images_path = "$mod_path/images/$skin_folder" ;

	$ret = "<input type='hidden' name='options[0]' value='$mydirname' />\n" ;

	// ���ƥ��꡼����ܥå���������
	$ret .= _MB_PICAL_CATSEL . ':' ;
	$ret .= "<select name='options[1]'>\n<option value='0'>"._ALL."</option>\n" ;
	foreach( $cal->categories as $cid => $cat ) {
		$selected = $now_cid == $cid ? "selected='selected'" : "" ;
		$depth_desc = str_repeat( '-' , intval( $cat->cat_depth ) ) ;
		$cat_title4show = $cal->text_sanitizer_for_show( $cat->cat_title ) ;
		$ret .= "\t<option value='$cid' $selected>$depth_desc $cat_title4show</option>\n" ;
	}
	$ret .= "</select>\n" ;

	return $ret ;
}

}

?>