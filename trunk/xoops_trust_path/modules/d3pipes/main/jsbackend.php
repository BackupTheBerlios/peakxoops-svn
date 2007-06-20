<?php

require dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

@ini_set( 'display_errors' , 0 ) ;

// fetch unique_id
$unique_id = preg_replace( '/[^0-9a-z]/' , '' , $_GET['unique_id'] ) ;

// fetch max_entries
$max_entries = intval( @$_GET['max_entries'] ) ;
if( $max_entries > 50 ) $max_entries = 50 ;

// fetch union_class
$union_class = $_GET['union_class'] == 'separated' ? 'separated' : 'mergesort' ;

// fetch pipe_row
$pipe_ids = empty( $_GET['pipe_ids'] ) ? array(0) : explode( ',' , preg_replace( '/[^0-9,:]/' , '' ,  $_GET['pipe_ids'] ) ) ;

// Union object
$union_obj =& d3pipes_common_get_joint_object( $mydirname , 'union' , $union_class , sizeof( $pipe_ids ) == 1 ? $pipe_ids[0].':'.$max_entries : implode( ',' , $pipe_ids ) ) ;
$union_obj->setModConfigs( $xoopsModuleConfig ) ;
$entries = $union_obj->execute( array() , $max_entries ) ;
$pipes_entries = method_exists( $union_obj , 'getPipesEntries' ) ? $union_obj->getPipesEntries() : array() ;
$errors = $union_obj->getErrors() ;

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
		'entries' => $entries ,
		'pipes_entries' => $pipes_entries ,
		'timezone_offset' => xoops_getUserTimestamp( 0 ) ,
		'xoops_module_header' => d3pipes_main_get_link2maincss( $mydirname ) . "\n" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

$html = addslashes( strtr( $xoopsTpl->fetch( 'db:'.$mydirname.'_main_jsbackend.html' ) , "\n\r" , "  " ) ) ;

echo "d3pipes_insert_html('{$mydirname}_async_block_{$unique_id}','$html');" ;

exit ;

?>