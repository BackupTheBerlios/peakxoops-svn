<?php

if( ! function_exists( 'xhld_getrenderer' ) ) {

function &xhld_getrenderer(&$headline,$mydirname)
{
	include_once XOOPS_ROOT_PATH."/modules/$mydirname/class/headlinerenderer.php";
	if (file_exists( XOOPS_ROOT_PATH."/modules/$mydirname/language/".$GLOBALS['xoopsConfig']['language'].'/headlinerenderer.php')) {
		include_once XOOPS_ROOT_PATH."/modules/$mydirname/language/".$GLOBALS['xoopsConfig']['language'].'/headlinerenderer.php';
		if (class_exists('XhldRendererLocal')) {
			$ret =& new XhldRendererLocal($headline,$mydirname);
			return $ret ;
		}
	}
	$ret =& new XhldRenderer($headline,$mydirname);
	return $ret ;
}

}

?>