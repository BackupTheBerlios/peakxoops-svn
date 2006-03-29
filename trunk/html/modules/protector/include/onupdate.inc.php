<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

global $xoopsDB , $msgs ;

$check_result = $xoopsDB->query( "DELETE FROM ".$xoopsDB->prefix("protector_access") ) ;
if( ! $check_result ) {

	$ret = $xoopsDB->queryF( "
	
	CREATE TABLE ".$xoopsDB->prefix("protector_access")." (
	  ip varchar(255) NOT NULL default '0.0.0.0',
	  request_uri varchar(255) NOT NULL default '',
	  expire int NOT NULL default 0,
	  KEY (ip),
	  KEY (request_uri),
	  KEY (expire)
	) TYPE=MyISAM
	
	" ) ;

}

if( substr( XOOPS_VERSION , 6 , 3 ) > 2.0 ) {
	$block_instance_title = defined( '_MI_PROTECTOR_BNAME1' ) ? _MI_PROTECTOR_BNAME1 : 'Protector' ;
	$xoopsDB->query( "DELETE FROM ".$xoopsDB->prefix("block_instance")." WHERE title='".addslashes($block_instance_title)."'" ) ;
}

$xoopsDB->query( "DELETE FROM ".$xoopsDB->prefix("newblocks")." WHERE dirname='protector' AND func_file='protector_block.php' AND show_func='b_protector_show'" ) ;

$xoopsDB->query( "ALTER TABLE ".$xoopsDB->prefix("config")." ADD KEY (conf_title)" ) ;

$xoopsDB->query( "ALTER TABLE ".$xoopsDB->prefix("protector_access")." ADD malicious_actions varchar(255) NOT NULL default '' AFTER request_uri, ADD KEY (malicious_actions), ADD KEY (ip), ADD KEY (request_uri), ADD KEY (expire)" ) ;


?>