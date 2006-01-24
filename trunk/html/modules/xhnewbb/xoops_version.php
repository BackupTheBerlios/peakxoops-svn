<?php
// $Id: xoops_version.php,v 1.4 2005/02/10 19:04:21 gij Exp $
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

$modversion['name'] = _MI_XHNEWBB_NAME;
$modversion['version'] = 1.15;
$modversion['description'] = _MI_XHNEWBB_DESC;
$modversion['credits'] = "Kazumi Ono<br />( http://www.myweb.ne.jp/ )";
$modversion['author'] = "Original admin section (phpBB 1.4.4) by<br />The phpBB Group<br />( http://www.phpbb.com/ )<br />";
$modversion['help'] = "newbb.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 1;
$modversion['image'] = "images/xhnewbb_slogo.png";
$modversion['dirname'] = "xhnewbb";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "xhnewbb_categories";
$modversion['tables'][1] = "xhnewbb_forum_access";
$modversion['tables'][2] = "xhnewbb_forum_mods";
$modversion['tables'][3] = "xhnewbb_forums";
$modversion['tables'][4] = "xhnewbb_posts";
$modversion['tables'][5] = "xhnewbb_posts_text";
$modversion['tables'][6] = "xhnewbb_topics";
$modversion['tables'][7] = "xhnewbb_users2topics";


// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 1;

// Templates
$modversion['templates'][1]['file'] = 'xhnewbb_index.html';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'xhnewbb_search.html';
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = 'xhnewbb_searchresults.html';
$modversion['templates'][3]['description'] = '';
$modversion['templates'][4]['file'] = 'xhnewbb_thread.html';
$modversion['templates'][4]['description'] = '';
$modversion['templates'][5]['file'] = 'xhnewbb_viewforum.html';
$modversion['templates'][5]['description'] = '';
$modversion['templates'][6]['file'] = 'xhnewbb_viewtopic_flat.html';
$modversion['templates'][6]['description'] = '';
$modversion['templates'][7]['file'] = 'xhnewbb_viewtopic_thread.html';
$modversion['templates'][7]['description'] = '';
$modversion['templates'][8]['file'] = 'xhnewbb_viewallforum.html';
$modversion['templates'][8]['description'] = '';

// Blocks
$modversion['blocks'][1] = array(
	'file' => "xhnewbb_blocks.php" ,
	'name' => _MI_XHNEWBB_BNAME1 ,
	'description' => _MI_XHNEWBB_BDESC1 ,
	'show_func' => "b_xhnewbb_main_show" ,
	'options' => "10|1|time|public|1|0|0" ,
	'edit_func' => "b_xhnewbb_main_edit" ,
	'template' => 'xhnewbb_main_block.html' ,
	'can_clone' => true
	) ;
$modversion['blocks'][] = array(
	'file' => "xhnewbb_blocks.php" ,
	'name' => _MI_XHNEWBB_BNAME1 ,
	'description' => _MI_XHNEWBB_BDESC1 ,
	'show_func' => "b_xhnewbb_main_show" ,
	'options' => "10|1|time|public|1|0|0" ,
	'edit_func' => "b_xhnewbb_main_edit" ,
	'template' => 'xhnewbb_main_block2.html' ,
	'can_clone' => true
	) ;

// Configurations
$modversion['config'][] = array(
	'name'			=> 'xhnewbb_allow_textimg' ,
	'title'			=> '_MI_XHNEWBB_ALLOW_TEXTIMG' ,
	'description'	=> '_MI_XHNEWBB_ALLOW_TEXTIMGDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "0" ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'xhnewbb_allow_sigimg' ,
	'title'			=> '_MI_XHNEWBB_ALLOW_SIGIMG' ,
	'description'	=> '_MI_XHNEWBB_ALLOW_SIGIMGDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "0" ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'xhnewbb_use_solved' ,
	'title'			=> '_MI_XHNEWBB_USE_SOLVED' ,
	'description'	=> '_MI_XHNEWBB_USE_SOLVEDDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "0" ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'xhnewbb_allow_mark' ,
	'title'			=> '_MI_XHNEWBB_ALLOW_MARK' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "0" ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'xhnewbb_viewallbreak' ,
	'title'			=> '_MI_XHNEWBB_VIEWALLBREAK' ,
	'description'	=> '_MI_XHNEWBB_VIEWALLBREAKDSC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> "10" ,
	'options'		=> array()
) ;

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "xhnewbb_search";

// Smarty
$modversion['use_smarty'] = 1;

// Notification

$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'xhnewbb_notify_iteminfo';

$modversion['notification']['category'][1]['name'] = 'thread';
$modversion['notification']['category'][1]['title'] = _MI_XHNEWBB_THREAD_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MI_XHNEWBB_THREAD_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = 'viewtopic.php';
$modversion['notification']['category'][1]['item_name'] = 'topic_id';
$modversion['notification']['category'][1]['allow_bookmark'] = 1;

$modversion['notification']['category'][2]['name'] = 'forum';
$modversion['notification']['category'][2]['title'] = _MI_XHNEWBB_FORUM_NOTIFY;
$modversion['notification']['category'][2]['description'] = _MI_XHNEWBB_FORUM_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = array('viewtopic.php', 'viewforum.php');
$modversion['notification']['category'][2]['item_name'] = 'forum';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['category'][3]['name'] = 'global';
$modversion['notification']['category'][3]['title'] = _MI_XHNEWBB_GLOBAL_NOTIFY;
$modversion['notification']['category'][3]['description'] = _MI_XHNEWBB_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][3]['subscribe_from'] = array('index.php', 'viewtopic.php', 'viewforum.php');

$modversion['notification']['event'][1]['name'] = 'new_post';
$modversion['notification']['event'][1]['category'] = 'thread';
$modversion['notification']['event'][1]['title'] = _MI_XHNEWBB_THREAD_NEWPOST_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP;
$modversion['notification']['event'][1]['description'] = _MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'xh_thread_newpost_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ;

$modversion['notification']['event'][2]['name'] = 'new_thread';
$modversion['notification']['event'][2]['category'] = 'forum';
$modversion['notification']['event'][2]['title'] = _MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY;
$modversion['notification']['event'][2]['caption'] = _MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP;
$modversion['notification']['event'][2]['description'] = _MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'xh_forum_newthread_notify';
$modversion['notification']['event'][2]['mail_subject'] = _MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ;

$modversion['notification']['event'][3]['name'] = 'new_forum';
$modversion['notification']['event'][3]['category'] = 'global';
$modversion['notification']['event'][3]['title'] = _MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY;
$modversion['notification']['event'][3]['caption'] = _MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP;
$modversion['notification']['event'][3]['description'] = _MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'xh_global_newforum_notify';
$modversion['notification']['event'][3]['mail_subject'] = _MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ;

$modversion['notification']['event'][4]['name'] = 'new_post';
$modversion['notification']['event'][4]['category'] = 'global';
$modversion['notification']['event'][4]['title'] = _MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY;
$modversion['notification']['event'][4]['caption'] = _MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP;
$modversion['notification']['event'][4]['description'] = _MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC;
$modversion['notification']['event'][4]['mail_template'] = 'xh_global_newpost_notify';
$modversion['notification']['event'][4]['mail_subject'] = _MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ;

$modversion['notification']['event'][5]['name'] = 'new_post';
$modversion['notification']['event'][5]['category'] = 'forum';
$modversion['notification']['event'][5]['title'] = _MI_XHNEWBB_FORUM_NEWPOST_NOTIFY;
$modversion['notification']['event'][5]['caption'] = _MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP;
$modversion['notification']['event'][5]['description'] = _MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC;
$modversion['notification']['event'][5]['mail_template'] = 'xh_forum_newpost_notify';
$modversion['notification']['event'][5]['mail_subject'] = _MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ;

$modversion['notification']['event'][6]['name'] = 'new_fullpost';
$modversion['notification']['event'][6]['category'] = 'global';
$modversion['notification']['event'][6]['admin_only'] = 1;
$modversion['notification']['event'][6]['title'] = _MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY;
$modversion['notification']['event'][6]['caption'] = _MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP;
$modversion['notification']['event'][6]['description'] = _MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC;
$modversion['notification']['event'][6]['mail_template'] = 'xh_global_newfullpost_notify';
$modversion['notification']['event'][6]['mail_subject'] = _MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ;

// onUpdate
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}

?>
