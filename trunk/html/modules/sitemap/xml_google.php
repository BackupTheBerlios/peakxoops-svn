<?php

if( ! defined( 'SITEMAP_ROOT_CONTROLLER_LOADED' ) ) {
	if( ! empty( $_SERVER['REQUEST_URI'] ) ) {
		$_SERVER['REQUEST_URI'] = str_replace( 'xml_google.php' , 'modules/sitemap/xml_google.php' , $_SERVER['REQUEST_URI'] ) ;
	} else {
		$_SERVER['REQUEST_URI'] = '/modules/sitemap/xml_google.php' ;
	}
	define( 'SITEMAP_ROOT_CONTROLLER_LOADED' , 1 ) ;
	chdir( './modules/sitemap/' ) ;
	require dirname(__FILE__).'/modules/sitemap/xml_google.php' ;
	exit ;
} else {
	require '../../mainfile.php' ;
}

$sitemap_configs = @$xoopsModuleConfig ;
$sitemap_configs['alltime_guest'] = true ;

require_once XOOPS_ROOT_PATH.'/class/template.php' ;

$myts =& MyTextSanitizer::getInstance() ;

$sitemap_configs['with_lastmod'] = true ;


if (function_exists('mb_http_output')) {
	mb_http_output('pass');
}
header ('Content-Type:text/xml; charset=utf-8');

if (file_exists(XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/modinfo.php'))
{
	include_once(XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/modinfo.php');
}
else
{
	if (file_exists(XOOPS_ROOT_PATH . '/modules/system/language/english/modinfo.php'))
	{
		include_once(XOOPS_ROOT_PATH . '/modules/system/language/english/modinfo.php');
	}
}

include_once(XOOPS_ROOT_PATH . '/modules/sitemap/include/sitemap.php');

$xoopsTpl = new XoopsTpl();

// for All-time guest mode (backup uid & set as Guest)
//if( is_object( $xoopsUser ) && ! empty( $sitemap_configs['alltime_guest'] ) ) {
//	$backup_uid = $xoopsUser->getVar('uid') ;
//	$xoopsUser = '' ;
//	$xoopsUserIsAdmin = false ;
//	$xoopsTpl->assign(array('xoops_isuser' => false, 'xoops_userid' => 0, 'xoops_uname' => '', 'xoops_isadmin' => false));
//}

$sitemap = sitemap_show();

// for All-time guest mode (restore $xoopsUser*)
//if( ! empty( $backup_uid ) && ! empty( $sitemap_configs['alltime_guest'] ) ) {
//	$member_handler =& xoops_gethandler('member');
//	$xoopsUser =& $member_handler->getUser( $backup_uid ) ;
//	$xoopsUserIsAdmin = $xoopsUser->isAdmin();
//}

// ユーザメニュ用言語ファイルを読む
/* if(!defined("_MB_SYSTEM_VACNT")){
    $lang_file = XOOPS_ROOT_PATH."/modules/system/language/".$xoopsConfig["language"]."/blocks.php";
    if(file_exists($lang_file)){
        include_once($lang_file);
    }else{
        $lang_file = XOOPS_ROOT_PATH."/modules/system/language/english/blocks.php";
        include_once($lang_file);
    }
}
$xoopsTpl->assign('lang', array(
	'youraccount' => _MB_SYSTEM_VACNT,
	'editaccount' => _MB_SYSTEM_EACNT,
	'notifications' => _MB_SYSTEM_NOTIF,
	'logout' => _MB_SYSTEM_LOUT,
// 	'messages' => $new_messages,
	'inbox' => _MB_SYSTEM_INBOX,
	'adminmenu' => _MB_SYSTEM_ADMENU,
));

/// ユーザメニューブロックのブロックタイトルを取得
$sql = "SELECT title FROM " . $xoopsDB->prefix("newblocks") . " WHERE show_func = 'b_system_user_show'" ;
$result = $xoopsDB->query($sql);
list($usermenu) = $xoopsDB->fetchRow($result);

$myts =& MyTextSanitizer::getInstance();

$msgs = $sitemap_configs['msgs'];

$xoopsTpl->assign('usermenu', $myts->makeTboxData4Show($usermenu)); */

$xoopsTpl->assign('lastmod', gmdate( 'Y-m-d\TH:i:s\Z' ) ); // TODO
$xoopsTpl->assign('sitemap', $sitemap);
$xoopsTpl->assign('msgs', $myts->displayTarea($msgs,1));
$xoopsTpl->assign('show_subcategoris', $sitemap_configs["show_subcategoris"]);

$xoopsTpl->assign('this', array(
	'mods' => $xoopsModule->getVar('dirname'),
	'name' => $xoopsModule->getVar('name')
));

$xoopsTpl->display('db:sitemap_xml_google.html');


?>