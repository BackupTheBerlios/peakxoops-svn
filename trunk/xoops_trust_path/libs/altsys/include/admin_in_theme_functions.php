<?php

function altsys_admin_in_theme( $s )
{
	global $xoops_admin_contents , $xoops_debug_mode ;

	// redirect
	if( strstr( $s , '<meta http-equiv="Refresh" ' ) ) return $s ;

	list( , $tmp_s ) = explode( "<div class='content'>" , $s ) ;
	if( empty( $tmp_s ) ) {
		$xoops_admin_contents = $s ;
	} else {
		list( $tmp_s , $tmp_after ) = explode( "<td width='1%' background='".XOOPS_URL."/modules/system/images/bg_content.gif'>" , $tmp_s ) ;
		if( empty( $tmp_after ) ) {
			$xoops_admin_contents = $s ;
		} else {
			$xoops_admin_contents = substr( strrev( strstr( strrev( $tmp_s ) , strrev( '</div>' ) ) ) , 0 , -6 ) ;
		}
	}

	register_shutdown_function( 'altsys_admin_in_theme_in_last' ) ;

	return '' ;
}


function altsys_admin_in_theme_in_last()
{
	global $xoops_admin_contents , $xoops_debug_mode , $xoopsConfig , $xoopsUser , $xoopsLogger , $altsysModuleConfig ;

	if( altsys_get_core_type() == ALTSYS_CORE_TYPE_X20 ) {
		// cheat header.php :-)
		$xoopsOption['template_main'] = 'system_dummy' ;
		$xoopsUserIsAdmin = true ;
		global $block_arr , $i ;
		include XOOPS_ROOT_PATH.'/header.php' ;
	} else {
		// Smarty
		require_once XOOPS_ROOT_PATH.'/class/template.php' ;
		$xoopsTpl =& new XoopsTpl() ;
	}

	// set the theme
	$xoopsConfig['theme_set'] = $altsysModuleConfig['admin_in_theme'] ;

	// include adminmenu
	include XOOPS_CACHE_PATH.'/adminmenu.php' ;

	// admin permissions
	$moduleperm_handler =& xoops_gethandler('groupperm');
	$admin_mids = $moduleperm_handler->getItemIds('module_admin', $xoopsUser->getGroups());
	$module_handler =& xoops_gethandler('module');
	$modules =& $module_handler->getObjects(new Criteria('mid', "(".implode(',', $admin_mids).")", 'IN'), true);
	$admin_mids = array_keys($modules);

	// menu items &= admin permissions
	$xoops_admin_menu_ft = array_flip( array_intersect( array_flip( $xoops_admin_menu_ft ) , $admin_mids ) ) ;
	$xoops_admin_menu_ml = array_flip( array_intersect( array_flip( $xoops_admin_menu_ml ) , $admin_mids ) ) ;
	$xoops_admin_menu_sd = array_flip( array_intersect( array_flip( $xoops_admin_menu_sd ) , $admin_mids ) ) ;

	// adminmenu as a block
	$admin_menu_block_contents = '<div class="adminmenu_block">'.implode( "\n" , $xoops_admin_menu_ft ).'</div>' ;
	$admin_menu_block = array( array(
		'title' => 'Admin Menu' ,
		'content' => $admin_menu_block_contents ,
		'weight' => 0 ,
	) ) ;
	$lblocks = $xoopsTpl->get_template_vars( 'xoops_lblocks' ) ;
	if( ! is_array( $lblocks ) ) $lblocks = array() ;
	$xoopsTpl->assign( 'xoops_lblocks' , array_merge( $admin_menu_block , $lblocks ) ) ;

	// javascripts
	$xoops_admin_menu_js .= '
		var thresholdY = 15;
		var ordinata_margin = 20;
		function moveLayers() {'.implode("\n",$xoops_admin_menu_ml).'}
		function shutdown() {'.implode("\n",$xoops_admin_menu_sd).'}' ;

	// assignment
	$xoopsTpl->assign( array(
		'xoops_theme' => $xoopsConfig['theme_set'] ,
		'xoops_imageurl' => XOOPS_THEME_URL.'/'.$xoopsConfig['theme_set'].'/',
		'xoops_themecss'=> xoops_getcss($xoopsConfig['theme_set']),
		'xoops_requesturi' => htmlspecialchars($GLOBALS['xoopsRequestUri'], ENT_QUOTES),
		'xoops_sitename' => htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES),
		'xoops_showlblock' => 1 ,
		'xoops_js' => '//--></script><script type="text/javascript" src="'.XOOPS_URL.'/include/xoops.js"></script><script type="text/javascript" src="'.XOOPS_URL.'/include/layersmenu.js"></script><script type="text/javascript"><!--'."\n".$xoops_admin_menu_js ,
		'xoops_runs_admin_side' => 1 ,
		'xoops_slogan' => htmlspecialchars($xoopsConfig['slogan'], ENT_QUOTES) ,
		'xoops_contents' => $xoops_admin_contents . '<div id="adminmenu_layers">' . $xoops_admin_menu_dv . '</div>' ,
	) ) ;

	// rendering
	$xoopsTpl->display( $xoopsConfig['theme_set'].'/theme.html' ) ;

	// for XOOPS 2.0.14/15/16 from xoops.org
	if( is_object( @$xoopsLogger ) && method_exists( $xoopsLogger , 'render' ) && in_array( $xoopsConfig['debug_mode'] , array( 1 , 2 ) ) ) {
		$xoopsLogger->activated = true ;
		echo $xoopsLogger->render('') ;
	}
}


?>