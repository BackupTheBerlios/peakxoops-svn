<?php

function smarty_resource_dbtheme_source($tpl_name, &$tpl_source, &$smarty)
{
	if( ( $pos = strpos( $tpl_name , '/' ) ) !== false ) {
		$tpl_name = substr( $tpl_name , 0 , $pos ) ;
	}

    $tplfile_handler =& xoops_gethandler('tplfile');
	$tplobj =& $tplfile_handler->find($GLOBALS['xoopsConfig']['template_set'], null, null, null, $tpl_name, true);
	if (count($tplobj) == 0 && $GLOBALS['xoopsConfig']['template_set'] != "default") {
		$tplobj =& $tplfile_handler->find('default', null, null, null, $tpl_name, true);
	}
	if (count($tplobj) > 0) {
        $tpl_source = $tplobj[0]->getVar('tpl_source');
        // CSS hooking
        $searches[] = '/\"\<\{\$xoops_themecss\}\>"/' ;
        $replacements[] = '"'.XOOPS_URL.'/modules/dbtheme/?template=style.css'.'"' ;
        $searches[] = '/\"\<\{\$xoops_imageurl\}\>([0-9a-zA-Z_-]+)\.(css|html|js)\"/' ;
        $replacements[] = '"'.XOOPS_URL.'/modules/dbtheme/?template=$1.$2'.'"' ;
        $tpl_source = preg_replace( $searches , $replacements , $tpl_source ) ;
        return true;
    } else {
		return false;
	}
}

function smarty_resource_dbtheme_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
	if( ( $pos = strpos( $tpl_name , '/' ) ) !== false ) {
		$tpl_name = substr( $tpl_name , 0 , $pos ) ;
	}

    $tplfile_handler =& xoops_gethandler('tplfile');
    $tplobj =& $tplfile_handler->find($GLOBALS['xoopsConfig']['template_set'], null, null, null, $tpl_name, false);
	if (count($tplobj) == 0 && $GLOBALS['xoopsConfig']['template_set'] != "default") {
		$tplobj =& $tplfile_handler->find('default', null, null, null, $tpl_name, true);
	}
	if (count($tplobj) > 0) {
        $tpl_timestamp = $tplobj[0]->getVar('tpl_lastmodified');
        return true;
    } else {
		return false;
	}
}

function smarty_resource_dbtheme_secure($tpl_name, &$smarty)
{
    // assume all templates are secure
    return true;
}

function smarty_resource_dbtheme_trusted($tpl_name, &$smarty)
{
    // not used for templates
}

?>