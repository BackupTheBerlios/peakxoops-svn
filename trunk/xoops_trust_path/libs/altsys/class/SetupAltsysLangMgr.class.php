<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

define('ALTSYS_MYLANGUAGE_ROOT_PATH', XOOPS_ROOT_PATH . '/my_language');


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
		$langman->language = $this->mLanguageName ;
		$langman->read( $fileBodyName.'.php' , $dirname ) ;
	}

	function loadGlobalMessageCatalog()
	{
		/* if (!$this->_loadFile(XOOPS_ROOT_PATH . "/modules/legacy/language/" . $this->mLanguageName . "/global.php")) {
			$this->_loadFile(XOOPS_ROOT_PATH . "/modules/legacy/language/english/global.php");
		} */
		$this->_loadLanguage( 'legacy' , 'global' ) ;

		//
		// Now, if XOOPS_USE_MULTIBYTES isn't defined, set zero to it.
		//
		if (!defined("XOOPS_USE_MULTIBYTES")) {
			define("XOOPS_USE_MULTIBYTES", 0);
		}
	}


}

?>