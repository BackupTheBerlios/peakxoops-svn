<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     pico_list
 * Version:  1.0
 * Date:     2009/11/20
 * Author:   GIJOE
 * Purpose:  
 * Input:    dir = dirname (default: caller's mydirname)
 *           cat_id = 
 *           order =  (default: o.created_time DESC)
 *           limit =
 *           template = 
 *           item = if this is specified, assign rendered text instead of output
 *           tags = separated with space or comma
 * 
 * Examples:
 *           {pico_list dir="pico"}
 * -------------------------------------------------------------
 */


require_once XOOPS_TRUST_PATH.'/modules/pico/include/common_functions.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/class/pico.textsanitizer.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/class/PicoUriMapper.class.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/class/PicoPermission.class.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/models/PicoModelCategory.class.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/models/PicoModelContent.class.php' ;

function smarty_function_pico_list( $params , &$smarty )
{
	// parameters
	$mydirname = @$params['dir'] . @$params['dirname'] ;
	$cat_ids = @$params['id'] . @$params['cat_id'] ;
	$order = empty( $params['order'] ) ? 'o.created_time DESC' : $params['order'] ;
	$limit_params = @$params['limit'] ;
	$template = @$params['template'] ;
	$var_name = @$params['item'] . @$params['assign'] ;
	$tags = @$params['tags'] ;

	// validate parameters
	if( empty( $mydirname ) ) $mydirname = $smarty->get_template_vars( 'mydirname' ) ;
	if( empty( $mydirname ) ) {
		echo 'error '.__FUNCTION__.' [specify dirname]';
		return ;
	}

	require_once XOOPS_ROOT_PATH.'/modules/'.$mydirname.'/blocks/blocks.php' ;

	if( $var_name ) {
		// just assign
		$assigns = b_pico_list_show( array( $mydirname , $cat_ids , $order , $limit_params , $template , true , $tags , 'disable_renderer' => true ) ) ;
		$smarty->assign( $var_name , $assigns ) ;
	} else {
		// display
		$block = b_pico_list_show( array( $mydirname , $cat_ids , $order , $limit_params , $template , true , $tags ) ) ;
		echo @$block['content'] ;
	}
}

?>