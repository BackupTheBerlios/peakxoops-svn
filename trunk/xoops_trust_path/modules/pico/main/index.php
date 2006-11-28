<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

// get content_id
$content_id = intval( @$_GET['content_id'] ) ;

// get and process $cat_id
$cat_id = $content_id ? pico_get_cat_id_from_content_id( $mydirname , $content_id ) : intval( @$_GET['cat_id'] ) ;

// check,fetch and assign the category (set $content_id if necessary)
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// get $subcategories
require dirname(dirname(__FILE__)).'/include/listsubcategories.inc.php' ;

if( $content_id ) {
	// check,fetch and assign the content
	require dirname(dirname(__FILE__)).'/include/process_this_content.inc.php' ;
	$xoopsOption['template_main'] = $mydirname.'_main_viewcontent.html' ;
	$pagetitle4assign = $content4assign['subject'] ;
} else {
	// list contents of the category
	require dirname(dirname(__FILE__)).'/include/listcontents.inc.php' ;
	$xoopsOption['template_main'] = $mydirname.'_main_listcontents.html' ;
	$pagetitle4assign = $category4assign['title'] ;
}

include XOOPS_ROOT_PATH.'/header.php';

$xoopsTpl->assign(
	array(
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
		'mod_config' => $xoopsModuleConfig ,
		'uid' => $uid ,
		'category' => $category4assign ,
		'subcategories' => $subcategories4assign ,
		'contents' => @$contents4assign ,
		'content' => @$content4assign ,
		'cat_jumpbox_options' => pico_make_cat_jumpbox_options( $mydirname , $whr_read4cat , @$content_row['cat_id'] ) ,
		'xoops_pagetitle' => @$pagetitle4assign ,
		'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>