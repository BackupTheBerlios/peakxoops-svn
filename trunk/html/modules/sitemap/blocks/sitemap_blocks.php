<?php

function b_sitemap_show( $options )
{
	global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsUserIsAdmin;
	global $sitemap_configs ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname('sitemap');
	$config_handler =& xoops_gethandler('config');
	$sitemap_configs = $config_handler->getConfigsByCat(0, $module->getVar('mid'));

	$block = array();

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

	// for All-time guest mode (backup uid & set as Guest)
	if( is_object( $xoopsUser ) && ! empty( $sitemap_configs['alltime_guest'] ) ) {
		$backup_uid = $xoopsUser->getVar('uid') ;
		$backup_userisadmin = $xoopsUserIsAdmin ;
		$xoopsUser = '' ;
		$xoopsUserIsAdmin = false ;
	}

	$sitemap = sitemap_show();

	// for All-time guest mode (restore $xoopsUser*)
	if( ! empty( $backup_uid ) && ! empty( $sitemap_configs['alltime_guest'] ) ) {
		$member_handler =& xoops_gethandler('member');
		$xoopsUser =& $member_handler->getUser( $backup_uid ) ;
		$xoopsUserIsAdmin = $backup_userisadmin ;
	}

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
	$block['lang'] = array(
		'youraccount' => _MB_SYSTEM_VACNT,
		'editaccount' => _MB_SYSTEM_EACNT,
		'notifications' => _MB_SYSTEM_NOTIF,
		'logout' => _MB_SYSTEM_LOUT,
		// 'messages' => $new_messages,
		'inbox' => _MB_SYSTEM_INBOX,
		'adminmenu' => _MB_SYSTEM_ADMENU,
		'openclose' => _MB_SITEMAP_OPENCLOSE,
	);

	// ユーザメニューブロックのブロックタイトルを取得
	$sql = "SELECT title FROM " . $xoopsDB->prefix("newblocks") . " WHERE show_func = 'b_system_user_show'" ;
	$result = $xoopsDB->query($sql);
	list($usermenu) = $xoopsDB->fetchRow($result);

	$msgs = $sitemap_configs['msgs'];

	$block['this']['mods'] = 'sitemap';

	$block['cols'] = intval( $options[0] ) ;

	$block['usermenu'] = $usermenu;
	$block['sitemap'] = $sitemap;
	$block['msgs'] = $msgs;
	$block['show_subcategoris'] = $sitemap_configs['show_subcategoris'];

	if( $sitemap_configs['alltime_guest'] ) {
		$block['isuser'] = 0 ;
		$block['isadmin'] = 0 ;
	} else {
		$block['isuser'] = is_object( $xoopsUser ) ;
		$block['isadmin'] = $xoopsUserIsAdmin ;
	}

	$sitemap_configs = @$sitemap_configsBackup ;

	return $block;
}




function b_sitemap_edit( $options )
{
	return '
		'._MB_SITEMAP_COLS.': <input type="text" size="2" maxlength="2" name="options[0]" value="'.intval($options[0]).'" />
	' ;
}


?>