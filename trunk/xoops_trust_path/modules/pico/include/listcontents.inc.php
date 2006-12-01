<?php

// contents loop
$contents4assign = array() ;
$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_contents")." WHERE cat_id=$cat_id ORDER BY weight,content_id" ;
if( ! $ors = $xoopsDB->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
while( $content_row = $xoopsDB->fetchArray( $ors ) ) {

	// contents array
	$contents4assign[] = array(
		'id' => intval( $content_row['content_id'] ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
		'created_time' => intval( $content_row['created_time'] ) ,
		'created_time_formatted' => formatTimestamp( $content_row['created_time'] , 'm' ) ,
		'modified_time' => intval( $content_row['modified_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] , 'm' ) ,
	) ;
}

?>