<?php

require dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

$xoopsOption['template_main'] = $mydirname.'_main_eachpipe.html' ;

// xoops header
include XOOPS_ROOT_PATH.'/header.php';

// fetch pipe_row
$pipe_id = intval( @$_GET['pipe_id'] ) ;
$pipe4assign = d3pipes_common_get_pipe4assign( $mydirname , $pipe_id ) ;

// specialcheck for eachpipe
if( empty( $pipe4assign['main_disp'] ) ) {
	redirect_header( XOOPS_URL.'/modules/'.$mydirname.'/' , 3 , _MD_D3PIPES_ERR_INVALIDPIPEID ) ;
	exit ;
}

// fetch entries
$entries = d3pipes_common_fetch_entries( $mydirname , $pipe4assign , $xoopsModuleConfig['entries_per_eachpipe'] , $errors , $xoopsModuleConfig ) ;

// pagenavigation
$last_joint = $pipe4assign['joints'][ sizeof( $pipe4assign['joints'] ) - 1 ] ;
if( $last_joint['joint'] == 'clip' && $last_joint['joint_class'] == 'moduledb' ) {
	$pos = intval( @$_GET['pos'] ) ;
	$clipping_count = d3pipes_main_get_clipping_count_moduledb( $mydirname , $pipe_id ) ;
	require_once XOOPS_ROOT_PATH.'/class/pagenav.php' ;
	$pagenav = new XoopsPageNav( $clipping_count , $xoopsModuleConfig['entries_per_eachpipe'] , $pos , 'pos' , "page=eachpipe&amp;pipe_id=$pipe_id" ) ;
	$pagenav4assign = $pagenav->renderNav( 10 ) ;
	//if( $pos > 0 ) {
	// refetch entries
	$entries = d3pipes_main_get_clippings_moduledb( $mydirname , $pipe_id , $xoopsModuleConfig['entries_per_eachpipe'] , $pos ) ;
	//}
} else {
	$pagenav4assign = '' ;
}

// pagetitle & xoops_breadcrumbs
$pagetitle4assign = empty( $pipe4assign['name'] ) ? _MD_D3PIPES_H2_EACHPIPE : $pipe4assign['name'] ;
$xoops_breadcrumbs[] = array( 'name' => $pagetitle4assign ) ;

// assign
$xoopsTpl->assign(
	array(
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
		'xoops_config' => $xoopsConfig ,
		'mod_config' => $xoopsModuleConfig ,
		'xoops_breadcrumbs' => $xoops_breadcrumbs ,
		'xoops_pagetitle' => $pagetitle4assign ,
		'errors' => $errors ,
		'clipping_pagenav' => $pagenav4assign ,
		'pipe' => $pipe4assign ,
		'entries' => $entries ,
		'timezone_offset' => xoops_getUserTimestamp( 0 ) ,
		'xoops_module_header' => d3pipes_main_get_link2maincss( $mydirname ) . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>