<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
//////////////////////////////////////////////////////////////////////////
class XmobileAnalyzerPlugin extends XmobilePlugin
{
	function XmobileAnalyzerPlugin()
	{
		// call parent constructor
		XmobilePlugin::XmobilePlugin();
	}
}
//////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////
class XmobileAnalyzerPluginHandler extends XmobilePluginHandler
{
	var $moduleDir = 'Analyzer';
//////////////////////////////////////////////////////////////////////////
	function XmobileAnalyzerPluginHandler($db)
	{
		XmobilePluginHandler::XmobilePluginHandler($db);
	}
//////////////////////////////////////////////////////////////////////////
	function setAccessLog()
	{
		$this->analyzer_show();
	}
//////////////////////////////////////////////////////////////////////////
	//---Access log record block---
	function analyzer_show()
	{
		require XOOPS_ROOT_PATH.'/modules/Analyzer/class/cls_analyzer.php';
		$ana = new analyzer();

		$ana->delete_data();
		if ( $ana->chk_admin() ) {
			return array();
		}

		if ( $ana->chk_ip() ) {
			$ana->chk_ana();
		}
		return array();
	}
}
//////////////////////////////////////////////////////////////////////////
?>