<?php

// get <link> to CSS for main
function d3pipes_main_get_link2maincss( $mydirname )
{
	global $xoopsModuleConfig ;

	$css_uri4disp = htmlspecialchars( str_replace( '{mod_url}' , XOOPS_URL.'/modules/'.$mydirname , @$xoopsModuleConfig['css_uri'] ) , ENT_QUOTES ) ;

	return '<link rel="stylesheet" type="text/css" media="all" href="'.$css_uri4disp.'" />'."\n" ;
}



?>