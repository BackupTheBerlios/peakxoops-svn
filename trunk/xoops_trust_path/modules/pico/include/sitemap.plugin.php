<?php

function b_sitemap_pico( $mydirname )
{
	include_once dirname(__FILE__).'/common_functions.php' ;

	$submenus = pico_get_submenu( $mydirname ) ;
	$show_subcat = @$GLOBALS['sitemap_configs']['show_subcategoris'] ? true : false ;
	$ret = array() ;
	$p_count = 0 ;
	foreach( $submenus as $submenu ) {
		$p_count ++ ;
		$ret['parent'][$p_count] = array(
			'title' => $submenu['name'] ,
			'url' => $submenu['url'] ,
			'image' => 1 ,
		) ;
		if( $show_subcat && ! empty( $submenu['sub'] ) ) {
			foreach( $submenu['sub'] as $subsubmenu ) {
				$ret['parent'][$p_count]['child'][] = array(
					'title' => $subsubmenu['name'] ,
					'url' => $subsubmenu['url'] ,
					'image' => 2 ,
				) ;
			}
		}
	}

	return $ret;
}

?>