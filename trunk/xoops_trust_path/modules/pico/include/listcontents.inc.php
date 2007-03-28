<?php

// auto-register
if( ! empty( $xoopsModuleConfig['wraps_auto_register'] ) && is_array( @$category4assign ) ) {
	require_once dirname(__FILE__).'/transact_functions.php' ;
	pico_auto_register_from_cat_vpath( $mydirname , $category4assign ) ;
}

// visible check
$whr4visible = $isadminormod ? '1' : 'o.visible' ;

// contents loop
$contents4assign = array() ;
$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_contents")." o WHERE o.cat_id=$cat_id AND ($whr4visible) ORDER BY o.weight,o.content_id" ;
if( ! $ors = $xoopsDB->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
while( $content_row = $xoopsDB->fetchArray( $ors ) ) {

	// contents array
	$content4assign_tmp = array(
		'id' => intval( $content_row['content_id'] ) ,
		'link' => pico_make_content_link4html( $xoopsModuleConfig , $content_row ) ,
		'subject' => $content_row['subject'] ? $myts->makeTboxData4Show( $content_row['subject'] ) : _MD_PICO_NOSUBJECT ,
		'created_time' => intval( $content_row['created_time'] ) ,
		'created_time_formatted' => formatTimestamp( $content_row['created_time'] , 'm' ) ,
		'modified_time' => intval( $content_row['modified_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] , 'm' ) ,
	) ;
	$contents4assign[] = $content4assign_tmp + $content_row ;
}

?>