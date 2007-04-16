<?php

function b_d3pipes_async_show( $options )
{
	$mydirname = empty( $options[0] ) ? 'd3pipes' : $options[0] ;
	$unique_id = empty( $options[1] ) ? uniqid( rand() ) : htmlspecialchars( $options[1] , ENT_QUOTES ) ;
	$pipe_id = empty( $options[2] ) ? 0 : intval( $options[2] ) ;
	$max_entries = empty( $options[3] ) ? 0 : intval( $options[3] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	// insert javascript if necessary
	d3pipes_insert_javascript4async() ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'mod_config' => $configs ,
		'unique_id' => $unique_id ,
		'pipe_id' => $pipe_id ,
		'max_entries' => $max_entries ,
		'lang_async_noscript' => constant($constpref."_ASYNC_NOSCRIPT") ,
	) ;

	if( empty( $options['disable_renderer'] ) ) {
		require_once XOOPS_ROOT_PATH.'/class/template.php' ;
		$tpl =& new XoopsTpl() ;
		$tpl->assign( 'block' , $block ) ;
		$ret['content'] = $tpl->fetch( 'db:'.$mydirname.'_block_async.html' ) ;
		return $ret ;
	} else {
		return $block ;
	}
}



function b_d3pipes_async_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'd3pipes' : $options[0] ;
	//$unique_id = empty( $options[1] ) ? uniqid(rand()) : $options[1] ;
	$pipe_id = empty( $options[2] ) ? 0 : intval( $options[2] ) ;
	$max_entries = empty( $options[3] ) ? 0 : intval( $options[3] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

 	$form = "
		<input type='hidden' name='options[0]' value='$mydirname' />
		<input type='hidden' name='options[1]' value='".uniqid(rand())."' />
		<label for='pipe_id'>"._MB_D3PIPES_PIPE_ID."</label>&nbsp;:
		<input type='text' name='options[2]' id='pipe_id' value='$pipe_id' size='4' />
		<br />
		<label for='max_entries'>"._MB_D3PIPES_MAX_ENTRIES."</label>&nbsp;:
		<input type='text' name='options[3]' id='max_entries' value='$max_entries' size='4' />
		<br />
	\n" ;

	return $form;
}



function d3pipes_insert_javascript4async()
{
	// javascript placed between <head></head>
	$head_script = '
		<script type="text/javascript">
		<!--
		function d3pipes_add_script( url )
		{
			script = document.createElement("script");
			script.setAttribute("type", "text/javascript");
			script.setAttribute("src", url);
			script.setAttribute("charset", "'._CHARSET.'");
			document.getElementsByTagName("head").item(0).appendChild(script);
		}
		
		function d3pipes_insert_html( id , html )
		{
		  document.getElementById( id ).innerHTML = html ;
		}
		//-->
		</script>
	' ;

	$xoops_module_header = $GLOBALS['xoopsTpl']->get_template_vars( "xoops_module_header" ) ;
	if( ! strstr( $xoops_module_header , 'd3pipes_add_script' ) ) {
		$GLOBALS['xoopsTpl']->assign( 'xoops_module_header' , $head_script . $xoops_module_header ) ;
	}
}

?>