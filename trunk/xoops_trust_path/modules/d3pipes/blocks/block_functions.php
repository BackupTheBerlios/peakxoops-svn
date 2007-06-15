<?php

require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;

function b_d3pipes_sync_show( $options )
{
	$mydirname = empty( $options[0] ) ? 'd3pipes' : $options[0] ;
	$unique_id = empty( $options[1] ) ? uniqid( rand() ) : htmlspecialchars( $options[1] , ENT_QUOTES ) ; // just dummy
	$pipe_ids = empty( $options[2] ) ? array(0) : explode( ',' , preg_replace( '/[^0-9,:]/' , '' ,  $options[2] ) ) ;
	$max_entries = empty( $options[3] ) ? 0 : intval( $options[3] ) ;
	$this_template = empty( $options[4] ) ? 'db:'.$mydirname.'_block_sync.html' : trim( $options[4] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	// Union object
	$union_obj =& d3pipes_common_get_joint_object_default( $mydirname , 'union' , sizeof( $pipe_ids ) == 1 ? $pipe_ids[0].':'.$max_entries : implode( ',' , $pipe_ids ) ) ;
	$union_obj->setModConfigs( $configs ) ;
	$entries = $union_obj->execute( array() , $max_entries ) ;
	$errors = $union_obj->getErrors() ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'xoops_config' => $GLOBALS['xoopsConfig'] ,
		'mod_config' => $configs ,
		'pipe_ids' => $pipe_ids ,
		'max_entries' => $max_entries ,
		'errors' => $errors ,
		'entries' => $entries ,
		'timezone_offset' => xoops_getUserTimestamp( 0 ) ,
	) ;

	if( empty( $options['disable_renderer'] ) ) {
		require_once XOOPS_ROOT_PATH.'/class/template.php' ;
		$tpl =& new XoopsTpl() ;
		$tpl->assign( 'block' , $block ) ;
		$ret['content'] = $tpl->fetch( $this_template ) ;
		return $ret ;
	} else {
		return $block ;
	}
}


function b_d3pipes_async_show( $options )
{
	$mydirname = empty( $options[0] ) ? 'd3pipes' : $options[0] ;
	$unique_id = empty( $options[1] ) ? uniqid( rand() ) : htmlspecialchars( $options[1] , ENT_QUOTES ) ;
	$pipe_ids = empty( $options[2] ) ? array(0) : explode( ',' , preg_replace( '/[^0-9,:]/' , '' ,  $options[2] ) ) ;
	$max_entries = empty( $options[3] ) ? 0 : intval( $options[3] ) ;
	$this_template = empty( $options[4] ) ? 'db:'.$mydirname.'_block_async.html' : trim( $options[4] ) ;

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
		'pipe_ids' => $pipe_ids ,
		'max_entries' => $max_entries ,
		'lang_async_noscript' => constant($constpref."_ASYNC_NOSCRIPT") ,
	) ;

	if( empty( $options['disable_renderer'] ) ) {
		require_once XOOPS_ROOT_PATH.'/class/template.php' ;
		$tpl =& new XoopsTpl() ;
		$tpl->assign( 'block' , $block ) ;
		$ret['content'] = $tpl->fetch( $this_template ) ;
		return $ret ;
	} else {
		return $block ;
	}
}


// edit func both for async and sync
function b_d3pipes_async_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'd3pipes' : $options[0] ;
	//$unique_id = empty( $options[1] ) ? uniqid(rand()) : $options[1] ;
	$pipe_ids = empty( $options[2] ) ? array('') : explode( ',' , preg_replace( '/[^0-9,:]/' , '' ,  $options[2] ) ) ;
	$max_entries = empty( $options[3] ) ? 0 : intval( $options[3] ) ;
	$this_template = empty( $options[4] ) ? '' : trim( $options[4] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	require_once XOOPS_ROOT_PATH.'/class/template.php' ;
	$tpl =& new XoopsTpl() ;
	$tpl->assign( array(
		'mydirname' => $mydirname ,
		'uniqid' => uniqid(rand()) ,
		'pipe_ids' => $pipe_ids ,
		'pipe_options' => b_d3pipes_get_pipe_options( $mydirname ) ,
		'max_entries' => $max_entries ,
		'this_template' => $this_template  ,
	) ) ;
	return $tpl->fetch( 'db:'.$mydirname.'_blockedit_async.html' ) ;
}


// make options for selecting pipes
function b_d3pipes_get_pipe_options( $mydirname )
{
	$mytrustdirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	require_once dirname(dirname(__FILE__)).'/include/admin_functions.php' ;

	require_once( XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ) ;
	$langman =& D3LanguageManager::getInstance() ;
	$langman->read( 'admin.php' , $mydirname , $mytrustdirname ) ;

	$db =& Database::getInstance() ;

	$result = $db->query( "SELECT pipe_id,name,joints FROM ".$db->prefix($mydirname."_pipes")." WHERE block_disp ORDER BY weight,pipe_id" ) ;
	$pipe_options = array( '' => '----' ) ;
	while( $myrow = $db->fetchArray( $result ) ) {
		$joints = unserialize( $myrow['joints'] ) ;
		$pipe_options[ intval( $myrow['pipe_id'] ) ] = htmlspecialchars( '(' . $myrow['pipe_id'] . ') ' . d3pipes_admin_judge_type_of_pipe( $joints ) . ' - ' . $myrow['name'] , ENT_QUOTES ) ;
	}
	
	return $pipe_options ;
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