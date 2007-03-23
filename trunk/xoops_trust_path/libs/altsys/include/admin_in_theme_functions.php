<?php

function altsys_admin_in_theme( $s )
{
	global $xoops_admin_contents ;

	$xoops_admin_contents = '' ;

	// check whether cp_functions.php is loaded
	if( ! defined( 'XOOPS_CPFUNC_LOADED' ) ) return $s ;

	// redirect
	if( strstr( $s , '<meta http-equiv="Refresh" ' ) ) return $s ;

	list( , $tmp_s ) = explode( "<div class='content'>" , $s , 2 ) ;
	if( empty( $tmp_s ) ) return $s ;

	list( $tmp_s , $tmp_after ) = explode( "<td width='1%' background='".XOOPS_URL."/modules/system/images/bg_content.gif'>" , $tmp_s ) ;
	if( empty( $tmp_after ) ) return $s ;

	$xoops_admin_contents = substr( strrev( strstr( strrev( $tmp_s ) , strrev( '</div>' ) ) ) , 0 , -6 ) ;

	return '' ;
}


function altsys_admin_in_theme_in_last()
{
	global $xoops_admin_contents , $xoopsConfig , $xoopsModule , $xoopsUser , $xoopsUserIsAdmin , $xoopsLogger , $altsysModuleConfig , $altsysModuleId ;

	while( ob_get_level() ) {
		ob_end_flush() ;
	}

	if( empty( $xoops_admin_contents ) ) return ;

	if( ! is_object( $xoopsUser ) ) exit ;

	// language files
	if( file_exists( dirname(dirname(__FILE__)).'/language/'.$xoopsConfig['language'].'/admin_in_theme.php' ) ) {
		include_once dirname(dirname(__FILE__)).'/language/'.$xoopsConfig['language'].'/admin_in_theme.php' ;
	} else {
		include_once dirname(dirname(__FILE__)).'/language/english/admin_in_theme.php' ;
	}

	// set the theme
	$xoopsConfig['theme_set'] = $altsysModuleConfig['admin_in_theme'] ;

	include dirname(__FILE__).'/admin_in_theme_header.inc.php' ;

	// include adminmenu
	include XOOPS_CACHE_PATH.'/adminmenu.php' ;

	// admin permissions
	$moduleperm_handler =& xoops_gethandler('groupperm');
	$admin_mids = $moduleperm_handler->getItemIds('module_admin', $xoopsUser->getGroups());
	$module_handler =& xoops_gethandler('module');
	$modules = $module_handler->getObjects(new Criteria('mid', "(".implode(',', $admin_mids).")", 'IN'), true);
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
		'xoops_breadcrumbs' => $xoops_breadcrumbs ,
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