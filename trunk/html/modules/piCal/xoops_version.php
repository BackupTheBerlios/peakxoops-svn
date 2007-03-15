<?php
// $Id: xoops_version.php,v 1.4 2003/02/12 11:37:53 okazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

// piCal xoops用モジュール記述ファイル
// xoops_version.php
// by GIJ=CHECKMATE (PEAK Corp. http://www.peak.ne.jp/)

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;
$mydirname = basename( dirname( __FILE__ ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;


$modversion['name'] = _MI_PICAL_NAME . $mydirnumber ;
$modversion['version'] = 0.91;
$modversion['description'] = _MI_PICAL_DESC;
$modversion['credits'] = "PEAK Corp.";
$modversion['author'] = "GIJ=CHECKMATE<br />PEAK Corp.(http://www.peak.ne.jp/)" ;
$modversion['help'] = "" ;
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/pical{$mydirnumber}_slogo.gif";
$modversion['dirname'] = $mydirname ;

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/pical{$mydirnumber}.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "pical{$mydirnumber}_event";
$modversion['tables'][1] = "pical{$mydirnumber}_cat";
$modversion['tables'][2] = "pical{$mydirnumber}_plugins";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/admission.php";
$modversion['adminmenu'] = "admin/menu.php";

// Blocks
$modversion['blocks'][1] = array(
	'file'			=> "pical_mini_calendar.php" ,
	'name'			=> _MI_PICAL_BNAME_MINICAL . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_MINICAL_DESC ,
	'show_func'		=> "pical_mini_calendar_show" ,
	'edit_func'		=> 'pical_mini_calendar_edit' ,
//	'template'		=> "pical{$mydirnumber}_mini_calendar.html",
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}"
) ;

$modversion['blocks'][2] = array(
	'file'			=> 'pical_monthly_calendar.php' ,
	'name'			=> _MI_PICAL_BNAME_MONTHCAL . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_MONTHCAL_DESC ,
	'show_func'		=> "pical_monthly_calendar_show" ,
	'edit_func'		=> 'pical_monthly_calendar_edit' ,
//	'template'		=> "pical{$mydirnumber}_monthly_calendar.html" ,
	'options'		=> "{$mydirname}"
) ;

$modversion['blocks'][3] = array(
	'file'			=> 'pical_todays_schedule.php' ,
	'name'			=> _MI_PICAL_BNAME_TODAYS . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_TODAYS_DESC ,
	'show_func'		=> "pical_todays_schedule_show_tpl" ,
	'edit_func'		=> 'pical_todays_schedule_edit' ,
	'template'		=> "pical{$mydirnumber}_todays_schedule.html" ,
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}|0"
) ;

$modversion['blocks'][4] = array(
	'file'			=> 'pical_thedays_schedule.php' ,
	'name'			=> _MI_PICAL_BNAME_THEDAYS . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_THEDAYS_DESC ,
	'show_func'		=> "pical_thedays_schedule_show_tpl" ,
	'edit_func'		=> 'pical_thedays_schedule_edit' ,
	'template'		=> "pical{$mydirnumber}_todays_schedule.html" ,
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}|0"
) ;

$modversion['blocks'][5] = array(
	'file'			=> 'pical_coming_schedule.php' ,
	'name'			=> _MI_PICAL_BNAME_COMING . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_COMING_DESC ,
	'show_func'		=> "pical_coming_schedule_show_tpl" ,
	'edit_func'		=> 'pical_coming_schedule_edit' ,
	'template'		=> "pical{$mydirnumber}_coming_schedule.html" ,
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}|5|0|0|0"
) ;

$modversion['blocks'][6] = array(
	'file'			=> 'pical_after_schedule.php' ,
	'name'			=> _MI_PICAL_BNAME_AFTER . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_AFTER_DESC ,
	'show_func'		=> "pical_after_schedule_show_tpl" ,
	'edit_func'		=> 'pical_after_schedule_edit' ,
	'template'		=> "pical{$mydirnumber}_coming_schedule.html" ,
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}|5|0|0|0"
) ;

$modversion['blocks'][7] = array(
	'file'			=> 'pical_new_event.php' ,
	'name'			=> _MI_PICAL_BNAME_NEW . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_NEW_DESC ,
	'show_func'		=> "pical_new_event_show_tpl" ,
	'edit_func'		=> "pical_new_event_edit" ,
	'template'		=> "pical{$mydirnumber}_new_event.html" ,
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}|5|0"
) ;

$modversion['blocks'][8] = array(
	'file'			=> "pical_minical_ex.php" ,
	'name'			=> _MI_PICAL_BNAME_MINICALEX . " ($mydirname)" ,
	'description'	=> _MI_PICAL_BNAME_MINICALEX_DESC ,
	'show_func'		=> "pical_minical_ex_show" ,
	'edit_func'		=> 'pical_minical_ex_edit' ,
	'template'		=> "pical{$mydirnumber}_minical_ex.html" ,
	'can_clone'		=> true ,
	'options'		=> "{$mydirname}|2|0"
) ;


// Menu
$modversion['hasMain'] = 1;

$subcount = 1 ;
global $cal ;
if( isset( $cal ) && strtolower( get_class( $cal ) ) == 'pical_xoops' ) {
	if( $cal->insertable ) {
		$modversion['sub'][$subcount]['name'] = _MI_PICAL_SM_SUBMIT ;
		$modversion['sub'][$subcount++]['url'] = "index.php?action=Edit&amp;caldate=$cal->caldate" ;
	}
	foreach( $cal->categories as $cid => $cat ) {
		if( $cat->ismenuitem ) {
			$modversion['sub'][$subcount]['name'] = $cal->text_sanitizer_for_show( $cat->cat_title ) ;
			$modversion['sub'][$subcount++]['url'] = "index.php?cid=$cid" ;
		}
	}
}


// Config Settings
$modversion['hasconfig'] = 1;

// 'name' が 'pical_' から始まらないものは、xoops側の設定
$modversion['config'][1] = array( 
	'name'			=> 'users_authority' ,
	'title'			=> '_MI_USERS_AUTHORITY' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> '1' ,
	'options'		=> array( '_MI_OPT_AUTH_NONE'=>0 , '_MI_OPT_AUTH_WAIT'=>1 , '_MI_OPT_AUTH_POST'=>3 , '_MI_OPT_AUTH_BYGROUP'=>256 )
) ;

$modversion['config'][2] = array( 
	'name'			=> 'guests_authority' ,
	'title'			=> '_MI_GUESTS_AUTHORITY' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> '0' ,
	'options'		=> array( '_MI_OPT_AUTH_NONE'=>0 , '_MI_OPT_AUTH_WAIT'=>1 , '_MI_OPT_AUTH_POST'=>3 )
) ;

$modversion['config'][3] = array( 
	'name'			=> 'default_view' ,
	'title'			=> '_MI_DEFAULT_VIEW' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'Monthly' ,
	'options'		=> array( '_MI_OPT_MINI_MONTHLY'=>'Monthly' , '_MI_OPT_MINI_WEEKLY'=>'Weekly' , '_MI_OPT_MINI_DAILY'=>'Daily' , '_MI_OPT_MINI_LIST'=>'List' )
) ;

$modversion['config'][4] = array( 
	'name'			=> 'mini_calendar_target' ,
	'title'			=> '_MI_MINICAL_TARGET' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'MONTHLY' ,
	'options'		=> array( '_MI_OPT_MINI_PHPSELF'=>'PHP_SELF' , '_MI_OPT_MINI_MONTHLY'=>'MONTHLY' , '_MI_OPT_MINI_WEEKLY'=>'WEEKLY' , '_MI_OPT_MINI_DAILY'=>'DAILY' , '_MI_OPT_MINI_LIST'=>'LIST' )
) ;

$modversion['config'][5] = array( 
	'name'			=> 'skin_folder' ,
	'title'			=> '_MI_SKINFOLDER' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'default' ,
	'options'		=> array()
) ;


// 'name' が 'pical_' から始まるものは、piCalオブジェクトのプロパティ
$modversion['config'][6] = array( 
	'name'			=> 'pical_locale' ,
	'title'			=> '_MI_PICAL_LOCALE' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> _MI_PICAL_DEFAULTLOCALE ,
	'options'		=> array()
) ;

$modversion['config'][7] = array( 
	'name'			=> 'pical_sunday_color' ,
	'title'			=> '_MI_SUNDAYCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#CC0000' ,
	'options'		=> array()
) ;

$modversion['config'][8] = array( 
	'name'			=> 'pical_sunday_bgcolor' ,
	'title'			=> '_MI_SUNDAYBGCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#FFEEEE' ,
	'options'		=> array()
) ;

$modversion['config'][9] = array( 
	'name'			=> 'pical_weekday_color' ,
	'title'			=> '_MI_WEEKDAYCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#000066' ,
	'options'		=> array()
) ;

$modversion['config'][10] = array( 
	'name'			=> 'pical_weekday_bgcolor' ,
	'title'			=> '_MI_WEEKDAYBGCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#FFFFFF' ,
	'options'		=> array()
) ;

$modversion['config'][11] = array( 
	'name'			=> 'pical_saturday_color' ,
	'title'			=> '_MI_SATURDAYCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#0000FF' ,
	'options'		=> array()
) ;

$modversion['config'][12] = array( 
	'name'			=> 'pical_saturday_bgcolor' ,
	'title'			=> '_MI_SATURDAYBGCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#EEF7FF' ,
	'options'		=> array()
) ;

$modversion['config'][13] = array( 
	'name'			=> 'pical_holiday_color' ,
	'title'			=> '_MI_HOLIDAYCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#CC0000' ,
	'options'		=> array()
) ;

$modversion['config'][14] = array( 
	'name'			=> 'pical_holiday_bgcolor' ,
	'title'			=> '_MI_HOLIDAYBGCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#FFEEEE' ,
	'options'		=> array()
) ;

$modversion['config'][15] = array( 
	'name'			=> 'pical_targetday_bgcolor' ,
	'title'			=> '_MI_TARGETDAYBGCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#CCFF99' ,
	'options'		=> array()
) ;

$modversion['config'][16] = array( 
	'name'			=> 'pical_calhead_color' ,
	'title'			=> '_MI_CALHEADCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#009900' ,
	'options'		=> array()
) ;

$modversion['config'][17] = array( 
	'name'			=> 'pical_calhead_bgcolor' ,
	'title'			=> '_MI_CALHEADBGCOLOR' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '#CCFFCC' ,
	'options'		=> array()
) ;

$modversion['config'][18] = array( 
	'name'			=> 'pical_frame_css' ,
	'title'			=> '_MI_CALFRAMECSS' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'border:solid 1px green; background-color:white;' ,
	'options'		=> array()
) ;

$modversion['config'][19] = array( 
	'name'			=> 'pical_can_output_ics' ,
	'title'			=> '_MI_CANOUTPUTICS' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> '1' ,
	'options'		=> array( '_MI_OPT_CANNOTOUTPUTICS'=>0 , '_MI_OPT_CANOUTPUTICS'=>1 )
) ;

$modversion['config'][20] = array( 
	'name'			=> 'pical_max_rrule_extract' ,
	'title'			=> '_MI_MAXRRULEEXTRACT' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> '100' ,
	'options'		=> array()
) ;

$modversion['config'][21] = array( 
	'name'			=> 'pical_week_start' ,
	'title'			=> '_MI_WEEKSTARTFROM' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> '0' ,
	'options'		=> array( '_MI_OPT_STARTFROMSUN'=>0 , '_MI_OPT_STARTFROMMON'=>1 )
) ;

$modversion['config'][22] = array( 
	'name'			=> 'pical_week_numbering' ,
	'title'			=> '_MI_WEEKNUMBERING' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> '0' ,
	'options'		=> array( '_MI_OPT_WEEKNOEACHMONTH'=>0 , '_MI_OPT_WEEKNOWHOLEYEAR'=>1 )
) ;

$modversion['config'][23] = array( 
	'name'			=> 'pical_day_start' ,
	'title'			=> '_MI_DAYSTARTFROM' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> '0' ,
	'options'		=> array( '0:00'=>0 , '1:00'=>3600 , '2:00'=>7200 , '3:00'=>10800 , '4:00'=>14400 , '5:00'=>18000 , '6:00'=>21600 )
) ;

$modversion['config'][24] = array( 
	'name'			=> 'pical_use24' ,
	'title'			=> '_MI_USE24HOUR' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> '1' ,
	'options'		=> array()
) ;

$modversion['config'][25] = array( 
	'name'			=> 'timezone_using' ,
	'title'			=> '_MI_TIMEZONE_USING' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'winter' ,
	'options'		=> array('_MI_OPT_TZ_USEXOOPS'=>'xoops','_MI_OPT_TZ_USEWINTER'=>'winter','_MI_OPT_TZ_USESUMMER'=>'summer')
) ;

$modversion['config'][26] = array(
	'name'			=> 'pical_nameoruname' ,
	'title'			=> '_MI_NAMEORUNAME' ,
	'description'	=> '_MI_DESCNAMEORUNAME' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'uname' ,
	'options'		=> array('_MI_OPT_USENAME'=>'name','_MI_OPT_USEUNAME'=>'uname')
) ;

$modversion['config'][27] = array(
	'name'			=> 'pical_proxysettings' ,
	'title'			=> '_MI_PROXYSETTINGS' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '' ,
	'options'		=> array() ,
) ;


// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "pical{$mydirnumber}_search";

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['itemName'] = 'event_id';
$modversion['comments']['pageName'] = 'index.php';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'pical_comments_approve';
$modversion['comments']['callback']['update'] = 'pical_comments_update';

// Templates
$modversion['templates'][1]['file'] = "pical{$mydirnumber}_event_detail.html";
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = "pical{$mydirnumber}_print.html";
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = "pical{$mydirnumber}_event_list.html";
$modversion['templates'][3]['description'] = '';


// Notification
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = "pical{$mydirnumber}_notify_iteminfo";

$modversion['notification']['category'][1]['name'] = 'global';
$modversion['notification']['category'][1]['title'] = _MI_PICAL_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MI_PICAL_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php');
$modversion['notification']['category'][2]['name'] = 'category';
$modversion['notification']['category'][2]['title'] = _MI_PICAL_CATEGORY_NOTIFY;
$modversion['notification']['category'][2]['description'] = _MI_PICAL_CATEGORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = array('index.php');
$modversion['notification']['category'][2]['item_name'] = 'cid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['category'][3]['name'] = 'event';
$modversion['notification']['category'][3]['title'] = _MI_PICAL_EVENT_NOTIFY;
$modversion['notification']['category'][3]['description'] = _MI_PICAL_EVENT_NOTIFYDSC;
$modversion['notification']['category'][3]['subscribe_from'] = array('index.php');
$modversion['notification']['category'][3]['item_name'] = 'event_id';
$modversion['notification']['category'][3]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name'] = 'new_event';
$modversion['notification']['event'][1]['category'] = 'global';
$modversion['notification']['event'][1]['title'] = _MI_PICAL_GLOBAL_NEWEVENT_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MI_PICAL_GLOBAL_NEWEVENT_NOTIFYCAP;
$modversion['notification']['event'][1]['description'] = _MI_PICAL_GLOBAL_NEWEVENT_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newevent_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MI_PICAL_GLOBAL_NEWEVENT_NOTIFYSBJ;

$modversion['notification']['event'][2]['name'] = 'new_event';
$modversion['notification']['event'][2]['category'] = 'category';
$modversion['notification']['event'][2]['title'] = _MI_PICAL_CATEGORY_NEWEVENT_NOTIFY;
$modversion['notification']['event'][2]['caption'] = _MI_PICAL_CATEGORY_NEWEVENT_NOTIFYCAP;
$modversion['notification']['event'][2]['description'] = _MI_PICAL_CATEGORY_NEWEVENT_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'category_newevent_notify';
$modversion['notification']['event'][2]['mail_subject'] = _MI_PICAL_CATEGORY_NEWEVENT_NOTIFYSBJ;


// Keep the values of block's options when module is updated (by nobunobu)
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}

?>
