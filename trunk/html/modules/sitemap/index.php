<?php

include '../../mainfile.php';

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

$xoopsOption['template_main'] = 'sitemap_index.html';
include(XOOPS_ROOT_PATH . '/header.php');

// for All-time guest mode (backup uid & set as Guest)
if( is_object( $xoopsUser ) && ! empty( $xoopsModuleConfig['alltime_guest'] ) ) {
	$backup_uid = $xoopsUser->getVar('uid') ;
	$backup_userisadmin = $xoopsUserIsAdmin ;
	$xoopsUser = '' ;
	$xoopsUserIsAdmin = false ;
	$xoopsTpl->assign(array('xoops_isuser' => false, 'xoops_userid' => 0, 'xoops_uname' => '', 'xoops_isadmin' => false));
}

$sitemap = sitemap_show();

// for All-time guest mode (restore $xoopsUser*)
if( ! empty( $backup_uid ) && ! empty( $xoopsModuleConfig['alltime_guest'] ) ) {
	$member_handler =& xoops_gethandler('member');
	$xoopsUser =& $member_handler->getUser( $backup_uid ) ;
	$xoopsUserIsAdmin = $backup_userisadmin ;
}

// PM受信数を得る by Ryuji
// if(is_object($xoopsUser)){
//     $pm_handler =& xoops_gethandler('privmessage');
//     $criteria = new CriteriaCompo(new Criteria('read_msg', 0));
//     $criteria->add(new Criteria('to_userid', $xoopsUser->getVar('uid')));
//     $new_messages = $pm_handler->getCount($criteria);
// }else{
//     $new_messages = 0;
// }

// ユーザメニュ用言語ファイルを読む
if(!defined("_MB_SYSTEM_VACNT")){
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

$msgs = $xoopsModuleConfig['msgs'];

$xoopsTpl->assign('usermenu', $myts->makeTboxData4Show($usermenu));
$xoopsTpl->assign('sitemap', $sitemap);
$xoopsTpl->assign('msgs', $myts->displayTarea($msgs,1));
$xoopsTpl->assign('show_subcategoris', $xoopsModuleConfig["show_subcategoris"]);

$xoopsTpl->assign('this', array(
	'mods' => $xoopsModule->getVar('dirname'),
	'name' => $xoopsModule->getVar('name')
));

include XOOPS_ROOT_PATH . '/footer.php';

?>