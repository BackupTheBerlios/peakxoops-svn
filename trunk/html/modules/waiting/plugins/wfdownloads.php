<?php
//
// Modified by coldfire for WF-Downloads
// DATE: 28/07/2004 11:38:36
// XOOPS: 2.0.7
// NOTES: This works for me. No guarantees implied. YMMV.
//        I had to change the titles in the language files. Otherwise they would confilct with the myDownloads module. My Knowledge of Kanjis is quite poor. So I only prefix the Japanese titles with "wf-". Sumimansen. Dozo naoshite kudasai. Ja ne.
//

function b_waiting_wfdownloads()
{
	$xoopsDB =& Database::getInstance();
	$ret = array() ;

	// wfdownloads pending
	$block = array();
	$result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("wfdownloads_downloads")." WHERE status=0");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/wfdownloads/admin/newdownloads.php";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_FILES ;
	}
	$ret[] = $block ;

	// wfdownloads broken
	$block = array();
	$result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("wfdownloads_broken"));
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/wfdownloads/admin/brokendown.php";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_BROKENS ;
	}
	$ret[] = $block ;

	// wfdownloads modreq
	$block = array();
	$result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("wfdownloads_mod"));
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/wfdownloads/admin/modifications.php";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_MODREQS ;
	}
	$ret[] = $block ;

	// wfdownloads pending
	$block = array();
	$result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("wfdownloads_reviews")." WHERE submit=0");
	if ( $result ) {
		$block['adminlink'] = XOOPS_URL."/modules/wfdownloads/admin/index.php?op=reviews";
		list($block['pendingnum']) = $xoopsDB->fetchRow($result);
		$block['lang_linkname'] = _PI_WAITING_REVIEWS ;
	}
	$ret[] = $block ;

	return $ret;
}


?>
