<?php

function b_pico_content_show( $options )
{
	global $xoopsUser ;

	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$content_id = intval( @$options[1] ) ;
	$this_template = empty( $options[2] ) ? 'db:'.$mydirname.'_block_content.html' : trim( $options[2] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	// categories can be read by current viewer (check by category_permissions)
	$whr_read4content = 'o.`cat_id` IN (' . implode( "," , pico_get_categories_can_read( $mydirname ) ) . ')' ;

	$sql = "SELECT * FROM ".$db->prefix($mydirname."_contents")." o WHERE ($whr_read4content) AND content_id='$content_id' AND o.visible" ;
	if( ! $result = $db->query( $sql ) ) return array() ;
	if( ! $db->getRowsNum( $result ) ) return array() ;

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	$content_row = $db->fetchArray( $result ) ;

	// assigning
	$content4assign = array(
		'id' => intval( $content_row['content_id'] ) ,
		'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
		'body' => pico_filter_body( $mydirname , $content_row , $content_row['use_cache'] ) ,
	) ;
	$content4assign += $content_row ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'mod_config' => $configs ,
		'content' => $content4assign ,
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



function b_pico_content_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$content_id = intval( @$options[1] ) ;
	$this_template = empty( $options[2] ) ? 'db:'.$mydirname.'_block_content.html' : trim( $options[2] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$form = "
		<input type='hidden' name='options[0]' value='$mydirname' />
		<label for='categories'>"._MB_PICO_CONTENT_ID."</label>&nbsp;:
		<input type='text' size='20' name='options[1]' id='content_id' value='$content_id' />
		<br />
		<label for='this_template'>"._MB_PICO_THISTEMPLATE."</label>&nbsp;:
		<input type='text' size='60' name='options[2]' id='this_template' value='".htmlspecialchars($this_template,ENT_QUOTES)."' />
		<br />
	\n" ;

	return $form;
}



?>