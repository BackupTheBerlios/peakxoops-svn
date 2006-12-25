<?php

// contents loop
$sql = "SELECT o.*,c.cat_id,c.cat_title,c.cat_depth_in_tree FROM ".$db->prefix($mydirname."_contents")." o LEFT JOIN ".$db->prefix($mydirname."_categories")." c ON o.cat_id=c.cat_id WHERE ($whr_read4content) AND o.visible AND o.show_in_menu ORDER BY c.cat_order_in_tree,o.weight" ;
if( ! $result = $db->query( $sql ) ) {
	echo $db->logger->dumpQueries() ;
	exit ;
}

while( $content_row = $db->fetchArray( $result ) ) {
	$cat_id = intval( $content_row['cat_id'] ) ;
	if( empty( $cat4assign[$cat_id] ) ) {
		if( $cat_id == 0 ) {
			$cat4assign[$cat_id] = array(
				'id' => 0 ,
				'title' => $xoopsModule->getVar('name') ,
				'depth_in_tree' => 0 ,
			) ;
		} else {
			$cat4assign[$cat_id] = array(
				'id' => intval( $content_row['cat_id'] ) ,
				'title' => $myts->makeTboxData4Show( $content_row['cat_title'] ) ,
				'depth_in_tree' => $content_row['cat_depth_in_tree'] + 1 ,
			) ;
		}
	}
	$content4assign = array(
		'id' => intval( $content_row['content_id'] ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
		'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
	) ;
	$cat4assign[$cat_id]['contents'][] = $content4assign + $content_row ;
}

$categories4assign = @$cat4assign ;

?>