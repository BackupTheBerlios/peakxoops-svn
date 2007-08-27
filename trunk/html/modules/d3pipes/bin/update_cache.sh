#!/usr/local/bin/php
<?php

if( ! empty( $_SERVER['HTTP_HOST'] ) ) die( 'This script cannot be accessed via httpd' ) ;

chdir( dirname( __FILE__ ) ) ;
$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;

// dummy variables
$_SERVER['REMOTE_ADDR'] = '192.168.0.1' ;
$_SERVER['REQUEST_URI'] = '/modules/'.$mydirname.'/' ;

require '../../../mainfile.php' ;
require_once XOOPS_TRUST_PATH."/modules/d3pipes/include/common_functions.php" ;

// mod_config
$module_handler =& xoops_gethandler('module');
$module =& $module_handler->getByDirname($mydirname);
$config_handler =& xoops_gethandler('config');
$configs = $config_handler->getConfigList( $module->mid() ) ;

// force to remove all cache of all pipes
d3pipes_common_delete_all_cache( $mydirname , 0 , true , false ) ;

// pipes loop
$db =& Database::getInstance() ;
$result = $db->query( "SELECT pipe_id FROM ".$db->prefix($mydirname."_pipes") ) ;
while( list( $pipe_id ) = $db->fetchRow( $result ) ) {
	$pipe4assign = d3pipes_common_get_pipe4assign( $mydirname , intval( $pipe_id ) ) ;
	d3pipes_common_fetch_entries( $mydirname , $pipe4assign , $configs['entries_per_eachpipe'] , $errors , $configs ) ;
}


?>