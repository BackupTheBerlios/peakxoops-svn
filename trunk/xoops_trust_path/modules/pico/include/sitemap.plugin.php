<?php

function b_sitemap_pico( $mydirname )
{
	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$ret = array();

	include_once dirname(__FILE__).'/common_functions.php' ;

	$whr_category = 'cat_id IN ('.implode(',',pico_get_categories_can_read( $mydirname )).')' ;
	$whr_pid = @$GLOBALS['sitemap_configs']['show_subcategoris'] ? '1' : 'pid=0' ;

	$sql = "SELECT cat_id,cat_title,pid,cat_depth_in_tree FROM ".$db->prefix($mydirname."_categories")." WHERE ($whr_category) AND ($whr_pid)" ;
	$result = $db->query($sql);

	$ret = array() ;
	$p_count = 0 ;
	while( list( $cat_id , $cat_title , $pid , $cat_depth_in_tree ) = $db->fetchRow( $result ) ) {
		if( $pid == 0 ) {
			// F1 category
			$p_count ++ ;
			$ret['parent'][$p_count] = array(
				'id' => intval( $cat_id ) ,
				'title' => $myts->makeTboxData4Show( $cat_title ) ,
				'url' => 'index.php?cat_id='.intval( $cat_id ) ,
			) ;
		} else {
			// F2,F3... category
			$ret['parent'][$p_count]['child'][] = array(
				'id' => intval( $cat_id ) ,
				'title' => $myts->makeTboxData4Show( $cat_title ) ,
				'url' => 'index.php?cat_id='.intval( $cat_id ) ,
				'image' => $cat_depth_in_tree > 2 ? 4 : $cat_depth_in_tree + 1 ,
			) ;
		}
	}

	return $ret;
}

?>