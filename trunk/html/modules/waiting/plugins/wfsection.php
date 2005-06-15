<?php
function b_waiting_wfsection()
{
	$xoopsDB =& Database::getInstance();
	$block = array();

	// wf-section articles
	$result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("wfs_article")." WHERE published=0");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/wfsection/admin/allarticles.php?action=submitted";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _MB_WAITING_WAITINGS ;
	}

	return $block;
}
?>