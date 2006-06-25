#!/usr/local/bin/php
<?php
$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

// dummy variables
$_SERVER['REMOTE_ADDR'] = '192.168.0.1' ;
$_SERVER['REQUEST_URI'] = '/modules/'.$mydirname.'/' ;

//$xoopsOption['nocommon'] = true ;
require '../../../mainfile.php';
require_once XOOPS_ROOT_PATH."/modules/$mydirname/include/functions.php";

$module_handler =& xoops_gethandler('module');
$xoopsModule =& $module_handler->getByDirname($mydirname);

$hlman =& xoops_getmodulehandler('headline');
$headlines =& $hlman->getObjects( new Criteria( '1' , '1' ) ) ;
$count = count( $headlines ) ;

foreach( $headlines as $hl ) {
	if( ! $hl->getVar( 'headline_display' ) && ! $hl->getVar( 'headline_asblock' ) ) continue ;
	$renderer =& xhld_getrenderer( $hl , $mydirname ) ;
	$renderer->updateCache( false ) ;
}

?>
