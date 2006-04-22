<?php

// <--- BASIC PROPERTY --->
$modversion['name'] = _MI_PLZXOO_NAME;
$modversion['version'] = 0.93;
$modversion['description'] = _MI_PLZXOO_NAME_DESC;

$modversion['credits'] = "";
$modversion['author'] = "" ;
$modversion['license'] = "";
$modversion['official'] = 0;
$modversion['image'] = "images/plzXoo.png";
$modversion['dirname'] = "plzXoo";

// <--- TEMPLATE PROPERTY --->
$modversion['use_smarty']=1;
$modversion['templates'][0]['file'] = 'plzxoo_index.html';
$modversion['templates'][0]['description'] = '';
$modversion['templates'][1]['file'] = 'plzxoo_detail.html';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'plzxoo_header_category.html';
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = 'plzxoo_header_nocategory.html';
$modversion['templates'][3]['description'] = '';

// <--- BLOCK PROPERTY --->
$modversion['blocks'][1]['file'] = 'plzxoo_block_list.php';
$modversion['blocks'][1]['name'] = _MI_PLZXOO_BNAME1 ;
$modversion['blocks'][1]['show_func'] = 'plzxoo_block_list_show';
$modversion['blocks'][1]['edit_func'] = 'plzxoo_block_list_edit';
$modversion['blocks'][1]['template'] = 'plzxoo_block_list.html';
$modversion['blocks'][1]['options'] = 'plzXoo|5|50|0|0';
$modversion['blocks'][1]['can_clone'] = 'true';

// <--- SQL PROPERTY --->
$modversion['sqlfile']['mysql']='sql/mysql.sql';
$modversion['tables'][0] = 'plzxoo_question';
$modversion['tables'][1] = 'plzxoo_answer';
$modversion['tables'][2] = 'plzxoo_category';

// <--- ADMIN PROPERTY --->
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// <--- MENU PROPERTY --->
$modversion['hasMain'] = 1;

// <--- SEARCH PROPERTY --->
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "plzxoo_search";

// <--- CONFIG PROPERTY --->
$modversion['config'][1]['name']='points';
$modversion['config'][1]['title']='_MI_PLZXOO_POINTS';
$modversion['config'][1]['description']='_MI_PLZXOO_POINTS_DESC';
$modversion['config'][1]['formtype']='text';
$modversion['config'][1]['valuetype']='string';
$modversion['config'][1]['default']="0|5:2|10:1";

$modversion['config'][2]['name']='points2posts';
$modversion['config'][2]['title']='_MI_PLZXOO_POINTS2POSTS';
$modversion['config'][2]['description']='_MI_PLZXOO_POINTS2POSTS_DESC';
$modversion['config'][2]['formtype']='yesno';
$modversion['config'][2]['valuetype']='int';
$modversion['config'][2]['default']=1 ;

// <--- NOTIFICATION PROPERTY --->
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php' ;
$modversion['notification']['lookup_func'] = "plzXoo_notify_iteminfo" ;

$modversion['notification']['category'][1]['name'] = 'global';
$modversion['notification']['category'][1]['title'] = _MI_PLZXOO_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MI_PLZXOO_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php');
$modversion['notification']['category'][2]['name'] = 'category';
$modversion['notification']['category'][2]['title'] = _MI_PLZXOO_CATEGORY_NOTIFY;
$modversion['notification']['category'][2]['description'] = _MI_PLZXOO_CATEGORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = array('index.php');
$modversion['notification']['category'][2]['item_name'] = 'cid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['category'][3]['name'] = 'question';
$modversion['notification']['category'][3]['title'] = _MI_PLZXOO_QUESTION_NOTIFY;
$modversion['notification']['category'][3]['description'] = _MI_PLZXOO_QUESTION_NOTIFYDSC;
$modversion['notification']['category'][3]['subscribe_from'] = array('index.php');
$modversion['notification']['category'][3]['item_name'] = 'qid';
$modversion['notification']['category'][3]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name'] = 'newq';
$modversion['notification']['event'][1]['category'] = 'global';
$modversion['notification']['event'][1]['title'] = _MI_PLZXOO_GLOBAL_NEWQ_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MI_PLZXOO_GLOBAL_NEWQ_NOTIFYCAP;
$modversion['notification']['event'][1]['description'] = _MI_PLZXOO_GLOBAL_NEWQ_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newq_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MI_PLZXOO_GLOBAL_NEWQ_NOTIFYSBJ;

$modversion['notification']['event'][2]['name'] = 'newq';
$modversion['notification']['event'][2]['category'] = 'category';
$modversion['notification']['event'][2]['title'] = _MI_PLZXOO_CATEGORY_NEWQ_NOTIFY;
$modversion['notification']['event'][2]['caption'] = _MI_PLZXOO_CATEGORY_NEWQ_NOTIFYCAP;
$modversion['notification']['event'][2]['description'] = _MI_PLZXOO_CATEGORY_NEWQ_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'category_newq_notify';
$modversion['notification']['event'][2]['mail_subject'] = _MI_PLZXOO_CATEGORY_NEWQ_NOTIFYSBJ;

$modversion['notification']['event'][3]['name'] = 'newa';
$modversion['notification']['event'][3]['category'] = 'question';
$modversion['notification']['event'][3]['title'] = _MI_PLZXOO_QUESTION_NEWA_NOTIFY;
$modversion['notification']['event'][3]['caption'] = _MI_PLZXOO_QUESTION_NEWA_NOTIFYCAP;
$modversion['notification']['event'][3]['description'] = _MI_PLZXOO_QUESTION_NEWA_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'question_newa_notify';
$modversion['notification']['event'][3]['mail_subject'] = _MI_PLZXOO_QUESTION_NEWA_NOTIFYSBJ;


// Keep the values of block's options when module is updated (by nobunobu)
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}

?>