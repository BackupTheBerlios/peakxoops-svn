<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
//////////////////////////////////////////////////////////////////////////
class XmobileLogcounterxPlugin extends XmobilePlugin
{
	function XmobileLogcounterxPlugin()
	{
		// call parent constructor
		XmobilePlugin::XmobilePlugin();
	}
}
//////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////
class XmobileLogcounterxPluginHandler extends XmobilePluginHandler
{
	var $moduleDir = 'logcounterx';
//////////////////////////////////////////////////////////////////////////
	function XmobileLogcounterxPluginHandler($db)
	{
		XmobilePluginHandler::XmobilePluginHandler($db);
	}
//////////////////////////////////////////////////////////////////////////
	function setAccessLog()
	{
//		include_once XOOPS_ROOT_PATH. '/modules/logcounterx/include/functions.php';
		include_once XOOPS_ROOT_PATH. '/modules/logcounterx/blocks/count_up.php';
//		if(!isset($_SERVER['HTTP_REFERER']))
//		{
//			$_SERVER['HTTP_REFERER'] = XMOBILE_URL;
//		}
		$ret = b_logcounterx_inc_counter();
	}
}
//////////////////////////////////////////////////////////////////////////
?>