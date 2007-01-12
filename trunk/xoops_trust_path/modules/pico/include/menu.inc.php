<?php

// top category
$categories4assign = array() ;
if( ! empty( $category_permissions[0] ) ) {
	$categories4assign[0] = array(
		'id' => 0 ,
		'title' => $xoopsModule->getVar('name') ,
		'depth_in_tree' => 0 ,
		'isadminormod' => ! empty( $category_permissions[ $cat_id ]['is_moderator'] ) || $isadmin ,
	) ;
}

// categories loop
$sql = "SELECT c.* FROM ".$db->prefix($mydirname."_categories")." c WHERE ($whr_read4cat) ORDER BY c.cat_order_in_tree" ;
if( ! $crs = $db->query( $sql ) ) {
	echo $db->logger->dumpQueries() ;
	exit ;
}
while( $cat_row = $db->fetchArray( $crs ) ) {
	$cat_id = intval( $cat_row['cat_id'] ) ;
	$category4assign = array(
		'id' => intval( $cat_row['cat_id'] ) ,
		'title' => $myts->makeTboxData4Show( $cat_row['cat_title'] ) ,
		'depth_in_tree' => $cat_row['cat_depth_in_tree'] + 1 ,
		'isadminormod' => ! empty( $category_permissions[ $cat_id ]['is_moderator'] ) || $isadmin ,
	) ;
	$categories4assign[ $cat_id ] = $category4assign + $cat_row ;
}

foreach( array_keys( $categories4assign ) as $cat_id ) {
	// contents loop
	$sql = "SELECT o.* FROM ".$db->prefix($mydirname."_contents")." o WHERE o.cat_id=$cat_id ORDER BY o.weight" ;
	if( ! $ors = $db->query( $sql ) ) {
		echo $db->logger->dumpQueries() ;
		exit ;
	}
	$invisible_contents_counter = 0 ;
	while( $content_row = $db->fetchArray( $ors ) ) {
		if( ! $content_row['visible'] ) {
			$invisible_contents_counter ++ ;
			continue ;
		}
		if( ! $content_row['show_in_menu'] ) continue ;
		$content4assign = array(
			'id' => intval( $content_row['content_id'] ) ,
			'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
			'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
			'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
		) ;
		$categories4assign[ $cat_id ]['contents'][] = $content4assign + $content_row ;
	}
	$categories4assign[ $cat_id ]['invisible_contents_counter'] = $invisible_contents_counter ;
}

?>