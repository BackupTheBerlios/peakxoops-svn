<?php

// render admin in theme.html
if( is_object( $xoopsUser ) ) {
	$xoops_subpath = substr( $_SERVER['REQUEST_URI'] , strpos( strrev( XOOPS_URL ) , strrev( $_SERVER['HTTP_HOST'] ) ) ) ;
	if( preg_match( '#(^/admin.php|^/modules/system/|^/modules/[a-zA-Z0-9_.-]+/admin/)#' , $xoops_subpath ) ) {
		// The request looks like admin
		require_once dirname(__FILE__).'/altsys_functions.php' ;
		if( ! empty( $GLOBALS['altsysModuleConfig']['admin_in_theme'] ) && file_exists( XOOPS_THEME_PATH.'/'.$GLOBALS['altsysModuleConfig']['admin_in_theme'].'/theme.html' ) ) {
			// configs OK
			require_once dirname(__FILE__).'/admin_in_theme_functions.php' ;

			// for XOOPS 2.0.14/15/16 from xoops.org
			global $xoopsLogger , $xoops_debug_mode ;
			if( is_object( @$xoopsLogger ) && method_exists( $xoopsLogger , 'render' ) ) {
				$xoops_debug_mode = $xoopsLogger->activated ;
			}

			ob_start( 'altsys_admin_in_theme' ) ;
		}
	}
}

?>