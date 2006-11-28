<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

$cat_id = isset( $_POST['cat_id'] ) ? intval( $_POST['cat_id'] ) : intval( @$_GET['cat_id'] ) ;

// get&check this category ($category4assign, $category_row), override options
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// special check for makecategory
if( ! $category4assign['can_makesubcategory'] ) die( _MD_PICO_ERR_CREATECATEGORY ) ;

// TRANSACTION PART
// permissions will be set same as the parent category. (also moderator)
require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
if( isset( $_POST['categoryman_post'] ) ) {
	// create a record for category and category_access
	$new_cat_id = pico_makecategory( $mydirname ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?cat_id=$new_cat_id" , 2 , _MD_PICO_MSG_CATEGORYMADE ) ;
	exit ;
}

// FORM PART

include dirname(dirname(__FILE__)).'/include/constant_can_override.inc.php' ;
$options4html = '' ;
foreach( $xoopsModuleConfig as $key => $val ) {
	if( isset( $pico_configs_can_be_override[ $key ] ) ) {
		$options4html .= htmlspecialchars( $key , ENT_QUOTES ) . ':' . htmlspecialchars( $val , ENT_QUOTES ) . "\n" ;
	}
}

$category4assign = array(
	'id' => 0 ,
	'title' => '' ,
	'weight' => 0 ,
	'desc' => '' ,
	'options' => '' , //$options4html ,
	'option_desc' => nl2br( htmlspecialchars( implode( "\n" , array_keys( $pico_configs_can_be_override ) ) , ENT_QUOTES ) ) ,
) ;


$xoopsOption['template_main'] = $mydirname.'_main_category_form.html' ;
include XOOPS_ROOT_PATH."/header.php";

$xoopsTpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'category' => $category4assign ,
	'page' => 'makecategory' ,
	'formtitle' => _MD_PICO_LINK_MAKECATEGORY ,
	'children_count' => 0 ,
	'cat_jumpbox_options' => pico_make_cat_jumpbox_options( $mydirname , $whr_read4cat , $cat_id ) ,
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	'xoops_pagetitle' => _MD_PICO_CATEGORYMANAGER ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>