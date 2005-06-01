<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

eval( '

function b_sitemap_'.$mydirname.'(){

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();

	$result = $db->query( "SELECT headline_id,headline_name FROM ".$db->prefix("xhld'.$mydirnumber.'")." WHERE headline_display=1 ORDER BY headline_weight" ) ;

	$ret = array() ;
	while( list( $id , $name ) = $db->fetchRow( $result ) ) {

		$ret["parent"][] = array(
			"id" => $id ,
			"title" => $myts->makeTboxData4Show( $name ) ,
			"url" => "index.php?id=$id"
		) ;

	}

	return $ret ;
}

' ) ;

?>