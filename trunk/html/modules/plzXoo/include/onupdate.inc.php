<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// referer check
$ref = xoops_getenv('HTTP_REFERER');
if( $ref == '' || strpos( $ref , XOOPS_URL.'/modules/system/admin.php' ) === 0 ) {
	/* Module specific part */

	global $xoopsDB ;
	// add column 'for_search'
	$result = $xoopsDB->query( "SELECT COUNT(`for_search`) FROM ".$xoopsDB->prefix("plzxoo_question") ) ;
	if( $result === false ) {
		$xoopsDB->query( "ALTER TABLE ".$xoopsDB->prefix("plzxoo_question")." ADD `for_search` mediumtext NOT NULL default '' AFTER `size`" ) ;
	}

	/* General part */

	// Keep the values of block's options when module is updated (by nobunobu)
	include dirname( __FILE__ ) . "/updateblock.inc.php" ;
}

?>