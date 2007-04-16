<?php

require dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

// @ini_set( 'display_errors' , 0 ) ;

// fetch unique_id
$unique_id = preg_replace( '/[^0-9a-z]/' , '' , $_GET['unique_id'] ) ;

// fetch max_entries
$max_entries = intval( @$_GET['max_entries'] ) ;
if( $max_entries > 50 ) $max_entries = 50 ;

// fetch pipe_row
$pipe_id = intval( @$_GET['pipe_id'] ) ;
$pipe4assign = d3pipes_common_get_pipe4assign( $mydirname , $pipe_id ) ;

// specialcheck for js
if( empty( $pipe4assign['block_disp'] ) ) {
	echo "d3pipes_insert_html('{$mydirname}_async_block_{$unique_id}','invalid pipe_id');" ;
	exit ;
}

// fetch entries
$entries = d3pipes_common_fetch_entries( $mydirname , $pipe4assign , $max_entries , $errors , $xoopsModuleConfig ) ;

// assign
require_once XOOPS_ROOT_PATH.'/class/template.php' ;
$xoopsTpl =& new XoopsTpl() ;
$xoopsTpl->assign(
	array(
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
		'xoops_config' => $xoopsConfig ,
		'mod_config' => @$xoopsModuleConfig ,
		'xoops_breadcrumbs' => @$xoops_breadcrumbs ,
		'xoops_pagetitle' => @$pagetitle4assign ,
		'errors' => $errors ,
		'pipe' => $pipe4assign ,
		'entries' => $entries ,
		'timezone_offset' => xoops_getUserTimestamp( 0 ) ,
		'xoops_module_header' => d3pipes_main_get_link2maincss( $mydirname ) . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

$html = strtr( $xoopsTpl->fetch( 'db:'.$mydirname.'_main_jsbackend.html' ) , "\n\r'" , "   " ) ;

echo "d3pipes_insert_html('{$mydirname}_async_block_{$unique_id}','$html');" ;

exit ;

?>