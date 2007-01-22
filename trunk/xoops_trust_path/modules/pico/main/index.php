<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

// get content_id
$content_id = intval( @$_GET['content_id'] ) ;

if( empty( $content_id ) ) {
	// parse path_info
	if( $xoopsModuleConfig['use_wraps_mode'] ) list( $content_id , $cat_id , $pico_path_info ) = pico_parse_path_info( $mydirname ) ;
	// category view
	if( empty( $cat_id ) ) $cat_id = intval( @$_GET['cat_id'] ) ;
} else {
	// get $cat_id from $content_id
	$cat_id = pico_get_cat_id_from_content_id( $mydirname , $content_id ) ;
}

// check,fetch and assign the category (set $content_id if necessary)
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// get $subcategories
require dirname(dirname(__FILE__)).'/include/listsubcategories.inc.php' ;

if( empty( $content_id ) ) {
	if( ! empty( $pico_path_info ) ) {
		// HTML wrapping without DB
		$xoopsOption['template_main'] = $mydirname.'_main_viewcontent.html' ;
		$content4assign = pico_read_wrapped_file( $mydirname , $pico_path_info ) ;
		$pagetitle4assign = $content4assign['subject'] ;
	} else if( empty( $cat_id ) && @$_GET['cat_id'] !== "0" && @$xoopsModuleConfig['show_menuinmoduletop'] || @$_GET['page'] == 'menu' ) {
		// auto-made menu
		require dirname(dirname(__FILE__)).'/include/menu.inc.php' ;
		$xoopsOption['template_main'] = $mydirname.'_main_menu.html' ;
		$pagetitle4assign = $xoopsModule->getVar('name') ;
	} else if( ! @$xoopsModuleConfig['show_listasindex'] ) {
		// redirect to the top of the content
		$content_id = pico_get_top_content_id_from_cat_id( $mydirname , $cat_id ) ;
		if( $content_id ) {
			$redirect_uri = XOOPS_URL.'/modules/'.$mydirname.'/'.pico_make_content_link4html( $xoopsModuleConfig , $content_id , $mydirname ) ;
			if( headers_sent() ) {
				redirect_header( $redirect_uri , 0 , '&nbsp;' ) ;
			} else {
				header( 'Location: '.$redirect_uri ) ;
			}
		}
	}
	if( empty( $xoopsOption['template_main'] ) ) {
		// list contents of the category
		require dirname(dirname(__FILE__)).'/include/listcontents.inc.php' ;
		$xoopsOption['template_main'] = $mydirname.'_main_listcontents.html' ;
		$pagetitle4assign = $category4assign['title'] ;
	}
}

if( empty( $xoopsOption['template_main'] ) ) {
	// display the content with detail
	require dirname(dirname(__FILE__)).'/include/process_this_content.inc.php' ;
	$xoopsOption['template_main'] = $mydirname.'_main_viewcontent.html' ;
	$pagetitle4assign = $content4assign['subject'] ;
}

// xoops header
include XOOPS_ROOT_PATH.'/header.php';

// assign
$xoopsTpl->assign(
	array(
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
		'mod_config' => $xoopsModuleConfig ,
		'uid' => $uid ,
		'category' => @$category4assign ,
		'categories' => @$categories4assign ,
		'subcategories' => @$subcategories4assign ,
		'contents' => @$contents4assign ,
		'content' => @$content4assign ,
		'next_content' => @$next_content4assign ,
		'prev_content' => @$prev_content4assign ,
		'cat_jumpbox_options' => pico_make_cat_jumpbox_options( $mydirname , $whr_read4cat , @$content_row['cat_id'] ) ,
		'xoops_pagetitle' => @$pagetitle4assign ,
		'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".str_replace('{mod_url}',XOOPS_URL.'/modules/'.$mydirname,$xoopsModuleConfig['css_uri'])."\" />\n" . @$xoopsModuleConfig['htmlheader'] . "\n" . @$content4assign['htmlheader'] . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

if( @$_GET['page'] == 'print' ) {
	// for printer
	$xoopsTpl->assign( 'sitename' , htmlspecialchars($xoopsConfig['sitename']) ) ;
	$xoopsTpl->display( 'db:'.$mydirname.'_independent_print.html' ) ;
} else {
	// for monitor
	include XOOPS_ROOT_PATH.'/footer.php';
}

?>