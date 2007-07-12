<?php

require dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

$rss_styles = array( 'rss20' , 'rss10' , 'atom' ) ;

// fetch pipe_row
$pipe_id = intval( @$_GET['pipe_id'] ) ;
$pipe4assign = d3pipes_common_get_pipe4assign( $mydirname , $pipe_id ) ;

// specialcheck for xml
if( empty( $pipe4assign['main_rss'] ) ) {
	redirect_header( XOOPS_URL.'/modules/'.$mydirname.'/' , 3 , _MD_D3PIPES_ERR_INVALIDPIPEID ) ;
	exit ;
}

// fetch entries
$entries = d3pipes_common_fetch_entries( $mydirname , $pipe4assign , $xoopsModuleConfig['entries_per_eachpipe'] , $errors , $xoopsModuleConfig ) ;

// Utf8from object
$utf8from_obj =& d3pipes_common_get_joint_object_default( $mydirname , 'utf8from' , $xoopsModuleConfig['internal_encoding'] ) ;

// assign
require_once XOOPS_TRUST_PATH.'/libs/altsys/class/D3Tpl.class.php' ;
$xoopsTpl =& new D3Tpl() ;
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
		'pipe' => $utf8from_obj->execute( $pipe4assign ) ,
		'entries' => $utf8from_obj->execute( $entries ) ,
		'timezone_offset' => xoops_getUserTimestamp( 0 ) ,
		'xoops_module_header' => d3pipes_main_get_link2maincss( $mydirname ) . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

if( function_exists( 'mb_http_output' ) ) mb_http_output( 'pass' ) ;
header( 'Content-Type:text/xml; charset=utf-8' ) ;

$style = in_array( @$_GET['style'] , $rss_styles ) ? $_GET['style'] : $rss_styles[0] ;
$xoopsTpl->display( 'db:'.$mydirname.'_independent_'.$style.'.html' ) ;

exit ;

?>