<?php

// get <link> to CSS for main
function d3pipes_main_get_link2maincss( $mydirname )
{
	global $xoopsModuleConfig ;

	$css_uri4disp = htmlspecialchars( str_replace( '{mod_url}' , XOOPS_URL.'/modules/'.$mydirname , @$xoopsModuleConfig['css_uri'] ) , ENT_QUOTES ) ;

	return '<link rel="stylesheet" type="text/css" media="all" href="'.$css_uri4disp.'" />'."\n" ;
}


// get <link> to common/lib/*.js
function d3pipes_main_get_script2commonlib( $mydirname )
{
	return '<script type="text/javascript" src="'.XOOPS_URL.'/common/lib/prototype.js"></script>'."\n".'<script type="text/javascript" src="'.XOOPS_URL.'/common/lib/scriptaculous.js"></script>'."\n" ;
}


function d3pipes_main_get_clipping_count_moduledb( $mydirname , $pipe_id )
{
	require_once dirname(dirname(__FILE__)).'/joints/clip/D3pipesClipModuledb.class.php' ;

	$clip_obj =& new D3pipesClipModuledb( $mydirname , 0 , '' ) ;
	return $clip_obj->getClippingCount( $pipe_id ) ;
}


function d3pipes_main_get_clippings_moduledb( $mydirname , $pipe_id , $num , $pos )
{
	require_once dirname(dirname(__FILE__)).'/joints/clip/D3pipesClipModuledb.class.php' ;

	$clip_obj =& new D3pipesClipModuledb( $mydirname , 0 , '' ) ;
	return $clip_obj->getClippings( $pipe_id , $num , $pos ) ;
}




?>