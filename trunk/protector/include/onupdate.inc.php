<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

global $xoopsDB , $msgs ;

$check_result = $xoopsDB->query( "DELETE FROM ".$xoopsDB->prefix("protector_access") ) ;
if( ! $check_result ) {

	$ret = $xoopsDB->queryF( "
	
	CREATE TABLE ".$xoopsDB->prefix("protector_access")." (
	  ip varchar(255) NOT NULL default '0.0.0.0',
	  request_uri varchar(255) NOT NULL default '',
	  expire int NOT NULL default 0
	) TYPE=MyISAM
	
	" ) ;

}

$xoopsDB->query( "DELETE FROM ".$xoopsDB->prefix("newblocks")." WHERE dirname='protector' AND func_file='protector_block.php' AND show_func='b_protector_show'" ) ;


?>