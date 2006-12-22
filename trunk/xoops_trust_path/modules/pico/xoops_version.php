<?php

// language file (modinfo.php)
if( file_exists( dirname(__FILE__).'/language/'.@$xoopsConfig['language'].'/modinfo.php' ) ) {
	include dirname(__FILE__).'/language/'.@$xoopsConfig['language'].'/modinfo.php' ;
} else if( file_exists( dirname(__FILE__).'/language/english/modinfo.php' ) ) {
	include dirname(__FILE__).'/language/english/modinfo.php' ;
}
$constpref = '_MI_' . strtoupper( $mydirname ) ;


$modversion['name'] = $mydirname ;
$modversion['description'] = constant($constpref.'_DESC') ;
$modversion['version'] = 0.22 ;
$modversion['credits'] = "PEAK Corp.";
$modversion['author'] = "GIJ=CHECKMATE<br />PEAK Corp.(http://www.peak.ne.jp/)" ;
$modversion['help'] = "" ;
$modversion['license'] = "GPL" ;
$modversion['official'] = 0 ;
$modversion['image'] = 'module_icon.php' ;
$modversion['dirname'] = $mydirname ;

// Any tables can't be touched by modulesadmin.
$modversion['sqlfile'] = false ;
$modversion['tables'] = array() ;

// Admin things
$modversion['hasAdmin'] = 1 ;
$modversion['adminindex'] = 'admin/index.php' ;
$modversion['adminmenu'] = 'admin/admin_menu.php' ;

// Search
$modversion['hasSearch'] = 1 ;
$modversion['search']['file'] = 'search.php' ;
$modversion['search']['func'] = $mydirname.'_global_search' ;

// Menu
$modversion['hasMain'] = 1 ;

// Submenu (just for mainmenu)
$modversion['sub'] = array() ;
if( is_object( $GLOBALS['xoopsModule'] ) && $GLOBALS['xoopsModule']->getVar('dirname') == $mydirname ) {
	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance();
	require_once dirname(__FILE__).'/include/common_functions.php' ;
	$whr_read4cat = 'o.`cat_id` IN (' . implode( "," , pico_get_categories_can_read( $mydirname ) ) . ')' ;
	$result = $db->query("SELECT content_id,subject FROM ".$db->prefix($mydirname."_contents" )." o WHERE cat_id=0 AND show_in_menu AND visible AND $whr_read4cat" ) ;
	if( $result ) while( list( $content_id , $subject ) = $db->fetchRow( $result ) ) {
		$modversion['sub'][] = array(
			'name' => $myts->makeTboxData4Show( $subject ) ,
			'url' => 'index.php?content_id='.intval($content_id) ,
		) ;
	}
}

// All Templates can't be touched by modulesadmin.
$modversion['templates'] = array() ;

// Blocks
$modversion['blocks'][1] = array(
	'file'			=> 'blocks.php' ,
	'name'			=> constant($constpref.'_BNAME_MENU') ,
	'description'	=> '' ,
	'show_func'		=> 'b_pico_menu_show' ,
	'edit_func'		=> 'b_pico_menu_edit' ,
	'options'		=> "$mydirname||" ,
	'template'		=> '' , // use "module" template instead
	'can_clone'		=> true ,
) ;

$modversion['blocks'][2] = array(
	'file'			=> 'blocks.php' ,
	'name'			=> constant($constpref.'_BNAME_CONTENT') ,
	'description'	=> '' ,
	'show_func'		=> 'b_pico_content_show' ,
	'edit_func'		=> 'b_pico_content_edit' ,
	'options'		=> "$mydirname|0|" ,
	'template'		=> '' , // use "module" template instead
	'can_clone'		=> true ,
) ;

$modversion['blocks'][3] = array(
	'file'			=> 'blocks.php' ,
	'name'			=> constant($constpref.'_BNAME_LIST') ,
	'description'	=> '' ,
	'show_func'		=> 'b_pico_list_show' ,
	'edit_func'		=> 'b_pico_list_edit' ,
	'options'		=> "$mydirname||o.created_time DESC|10|" ,
	'template'		=> '' , // use "module" template instead
	'can_clone'		=> true ,
) ;

// Comments
$modversion['hasComments'] = 0 ;

// Configs
$modversion['config'][1] = array(
	'name'			=> 'top_message' ,
	'title'			=> $constpref.'_TOP_MESSAGE' ,
	'description'	=> '' ,
	'formtype'		=> 'textarea' ,
	'valuetype'		=> 'text' ,
	'default'		=> constant($constpref.'_TOP_MESSAGEDEFAULT') ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'show_listasindex' ,
	'title'			=> $constpref.'_SHOW_LISTASINDEX' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'show_breadcrumbs' ,
	'title'			=> $constpref.'_SHOW_BREADCRUMBS' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'show_pagenavi' ,
	'title'			=> $constpref.'_SHOW_PAGENAVI' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'show_printicon' ,
	'title'			=> $constpref.'_SHOW_PRINTICON' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'show_tellafriend' ,
	'title'			=> $constpref.'_SHOW_TELLAFRIEND' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'use_taf_module' ,
	'title'			=> $constpref.'_USE_TAFMODULE' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'filters' ,
	'title'			=> $constpref.'_FILTERS' ,
	'description'	=> $constpref.'_FILTERSDSC' ,
	'formtype'		=> 'textarea' ,
	'valuetype'		=> 'text' ,
	'default'		=> constant($constpref.'_FILTERSDEFAULT') ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'use_vote' ,
	'title'			=> $constpref.'_USE_VOTE' ,
	'description'	=> '' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "1" ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'guest_vote_interval' ,
	'title'			=> $constpref.'_GUESTVOTE_IVL' ,
	'description'	=> $constpref.'_GUESTVOTE_IVLDSC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> 86400 ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'htmlheader' ,
	'title'			=> $constpref.'_HTMLHEADER' ,
	'description'	=> '' ,
	'formtype'		=> 'textarea' ,
	'valuetype'		=> 'text' ,
	'default'		=> '' ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'css_uri' ,
	'title'			=> $constpref.'_CSS_URI' ,
	'description'	=> $constpref.'_CSS_URIDSC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'index.css' ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'images_dir' ,
	'title'			=> $constpref.'_IMAGES_DIR' ,
	'description'	=> $constpref.'_IMAGES_DIRDSC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'images' ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'body_editor' ,
	'title'			=> $constpref.'_BODY_EDITOR' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'xoopsdhtml' ,
	'options'		=> array( 'xoopsdhtml' => 'xoopsdhtml' , 'common/spaw' => 'common_spaw' , 'common/fckeditor' => 'common_fckeditor' )
) ;

$modversion['config'][] = array(
	'name'			=> 'comment_dirname' ,
	'title'			=> $constpref.'_COM_DIRNAME' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'text' ,
	'default'		=> '' ,
	'options'		=> array()
) ;

$modversion['config'][] = array(
	'name'			=> 'comment_forum_id' ,
	'title'			=> $constpref.'_COM_FORUM_ID' ,
	'description'	=> '' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> '0' ,
	'options'		=> array()
) ;


// Notification
$modversion['hasNotification'] = 0 ;

$modversion['onInstall'] = 'oninstall.php' ;
$modversion['onUpdate'] = 'onupdate.php' ;
$modversion['onUninstall'] = 'onuninstall.php' ;

// keep block's options
if( ! defined( 'XOOPS_CUBE_LEGACY' ) && substr( XOOPS_VERSION , 6 , 3 ) < 2.1 && ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname(__FILE__).'/include/x20_keepblockoptions.inc.php' ;
}

?>