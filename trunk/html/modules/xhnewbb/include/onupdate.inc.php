<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// referer check
$ref = xoops_getenv('HTTP_REFERER');
if( $ref == '' || strpos( $ref , XOOPS_URL.'/modules/system/admin.php' ) === 0 ) {
	/* Module specific part */
	global $xoopsDB ;

	// newbb to xhnewbb
	$result = $xoopsDB->query( "SELECT forum_weight FROM ".$xoopsDB->prefix("xhnewbb_forums")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_forums")." ADD forum_weight int(8) NOT NULL default '0' AFTER forum_last_post_id" ) ;
	}

	// 1.0 to 1.10
	$result = $xoopsDB->query( "SELECT * FROM ".$xoopsDB->prefix("xhnewbb_users2topics")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "CREATE TABLE ".$xoopsDB->prefix("xhnewbb_users2topics")." (
		  uid mediumint(8) unsigned NOT NULL default 0,
		  topic_id int(8) unsigned NOT NULL default 0,
		  u2t_time int(10) NOT NULL default 0,
		  u2t_marked tinyint NOT NULL default 0,
		  u2t_rsv tinyint NOT NULL default 0,
		  PRIMARY KEY (uid,topic_id),
		  KEY (uid),
		  KEY (topic_id),
		  KEY (u2t_time),
		  KEY (u2t_marked),
		  KEY (u2t_rsv)
		) TYPE=MyISAM;" ) ;
	}
	$result = $xoopsDB->query( "SELECT topic_solved FROM ".$xoopsDB->prefix("xhnewbb_topics")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_topics")." ADD topic_solved tinyint(1) NOT NULL default '0', ADD topic_rsv tinyint(1) NOT NULL default '0', ADD KEY (topic_time)" ) ;

		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_posts")." ADD KEY (post_time)" ) ;
	}

	/* General part */

	// Keep the values of block's options when module is updated (by nobunobu)
	include dirname( __FILE__ ) . "/updateblock.inc.php" ;

}

?>