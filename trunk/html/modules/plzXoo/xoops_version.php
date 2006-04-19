<?php

// <--- BASIC PROPERTY --->
$modversion['name'] = _MI_PLZXOO_NAME;
$modversion['version'] = 0.90;
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


// Keep the values of block's options when module is updated (by nobunobu)
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}

?>