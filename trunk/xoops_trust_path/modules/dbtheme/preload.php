<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

if( ! preg_match( '/^[0-9a-zA-Z_-]+$/' , $mydirname ) ) exit ;

if( ! class_exists( 'DbthemePreloadBase' ) ) {


class DbthemePreloadBase extends XCube_ActionFilter
{
	function DbthemePreloadBase(&$controller)
	{
		parent::XCube_ActionFilter($controller);
		$controller->mRoot->mDelegateManager->add('LegacyThemeHandler.GetInstalledThemes', array( &$this , 'getInstalledThemes4Dbtheme' ) ) ;
	}

	function getInstalledThemes4Dbtheme(&$results)
	{
		require_once XOOPS_ROOT_PATH . "/core/XCube_Theme.class.php";

		if ($handler = opendir(XOOPS_THEME_PATH)) {
			while (($dirname = readdir($handler)) !== false) {
				if ($dirname == "." || $dirname == "..") {
					continue;
				}

				// for fast judgement (You have to name your theme like '*db')
				if( substr( $dirname , -2 ) != 'db' ) continue ;

				$themeDir = XOOPS_THEME_PATH . "/" . $dirname;
				if (is_dir($themeDir)) {
					$theme =& new XCube_Theme();
					$theme->mDirname = $dirname;

					if ($theme->loadManifesto($themeDir . "/manifesto.ini.php")) {
						if ($theme->mRenderSystemName == 'Legacy_DbthemeRenderSystem') {
							$results[] =& $theme;
						}
					}
					unset($theme);
				}
			}
			closedir($handler);
		}
	}
}

}

eval( 'class '.ucfirst( $mydirname ).'_DbthemePreload extends DbthemePreloadBase { var $mydirname = "'.$mydirname.'" ; }' ) ;

?>