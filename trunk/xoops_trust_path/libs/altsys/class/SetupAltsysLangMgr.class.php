<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

class SetupAltsysLangMgr extends XCube_ActionFilter
{
	function preFilter()
	{
		$this->mController->mCreateLanguageManager->add('SetupAltsysLangMgr::createLanguageManager');
	}
	
	function createLanguageManager(&$langManager, $languageName)
	{
		$langManager = new AltsysLangMgr_LanguageManager();
	}
}


require_once XOOPS_ROOT_PATH . "/core/XCube_LanguageManager.class.php";
require_once XOOPS_ROOT_PATH . "/modules/legacy/kernel/Legacy_LanguageManager.class.php";

class AltsysLangMgr_LanguageManager extends Legacy_LanguageManager
{
	function _loadLanguage($dirname, $fileBodyName)
	{
		$langmanpath = XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ;
		if( ! file_exists( $langmanpath ) ) die( 'install the latest altsys' ) ;
		require_once( $langmanpath ) ;
		$langman =& D3LanguageManager::getInstance() ;
		$langman->read( $fileBodyName.'.php' , $dirname ) ;
	}
}

?>