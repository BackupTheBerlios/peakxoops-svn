<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// referer check
$ref = xoops_getenv('HTTP_REFERER');
if( $ref == '' || strpos( $ref , XOOPS_URL.'/modules/system/admin.php' ) === 0 ) {
	/* Module specific part */

	global $xoopsDB ;

	// clear XML or parsed cache
	$xoopsDB->query( "UPDATE ".$xoopsDB->prefix("xhld{$mydirnumber}")." SET headline_xml='',headline_updated=0" ) ;

	// add column 'headline_syndication' and some modifications
	$result = $xoopsDB->query( "SELECT headline_syndication FROM ".$xoopsDB->prefix("xhld{$mydirnumber}") ) ;
	if( $result === false ) {
		$xoopsDB->query( "ALTER TABLE ".$xoopsDB->prefix("xhld{$mydirnumber}")." ADD headline_syndication varchar(255) NOT NULL default '', MODIFY headline_xml mediumtext NOT NULL default '', MODIFY  headline_id smallint(5) unsigned NOT NULL auto_increment, MODIFY  headline_name text NOT NULL default '', MODIFY  headline_url text NOT NULL default '', MODIFY  headline_rssurl text NOT NULL default '', MODIFY  headline_titlepattern text NOT NULL default '', MODIFY  headline_linkpattern text NOT NULL default ''" ) ;
	}

	// add column 'headline_timeout' & 'headline_allowhtml'
	$result = $xoopsDB->query( "SELECT headline_timeout FROM ".$xoopsDB->prefix("xhld{$mydirnumber}") ) ;
	if( $result === false ) {
		$xoopsDB->query( "ALTER TABLE ".$xoopsDB->prefix("xhld{$mydirnumber}")." ADD headline_timeout smallint(3) NOT NULL default '99', ADD headline_allowhtml tinyint(1) NOT NULL default '0'" ) ;
	}

	// add column 'headline_titleexclude' & 'headline_linkexclude'
	$result = $xoopsDB->query( "SELECT headline_titleexclude FROM ".$xoopsDB->prefix("xhld{$mydirnumber}") ) ;
	if( $result === false ) {
		$xoopsDB->query( "ALTER TABLE ".$xoopsDB->prefix("xhld{$mydirnumber}")." ADD headline_titleexclude text NOT NULL default '' AFTER headline_titlepattern, ADD headline_linkexclude text NOT NULL default '' AFTER headline_linkpattern" ) ;
	}

	/* For checking ALTER TABLE
	ALTER TABLE xoops_xhld0 MODIFY headline_xml text NOT NULL default '', MODIFY headline_id smallint(3) unsigned NOT NULL auto_increment, MODIFY headline_name varchar(255) NOT NULL default '', MODIFY headline_url varchar(255) NOT NULL default '', MODIFY headline_rssurl varchar(255) NOT NULL default '', MODIFY headline_titlepattern varchar(255) NOT NULL default '', MODIFY headline_linkpattern varchar(255) NOT NULL default '', DROP headline_syndication;

	ALTER table xoops_xhld0 DROP headline_timeout, DROP headline_allowhtml;

	ALTER TABLE xoops_xhld0 ADD headline_titleexclude text NOT NULL default '' AFTER headline_titlepattern, ADD headline_linkexclude text NOT NULL default '' AFTER headline_linkpattern;
	ALTER TABLE xoops_xhld0 DROP headline_titleexclude ,DROP headline_linkexclude;	*/


	/* General part */

	// Keep the values of block's options when module is updated (by nobunobu)
	include dirname( __FILE__ ) . "/updateblock.inc.php" ;

}

?>