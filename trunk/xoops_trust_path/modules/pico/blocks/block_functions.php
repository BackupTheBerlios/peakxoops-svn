<?php

function b_pico_menu_show( $options )
{
	global $xoopsUser ;

	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$categories = empty( $options[1] ) ? array(0) : explode(',',$options[1]) ;
	$this_template = empty( $options[2] ) ? 'db:'.$mydirname.'_block_menu.html' : trim( $options[2] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	// forums can be read by current viewer (check by forum_access)
	require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
	$whr_read4cat = 'o.`cat_id` IN (' . implode( "," , pico_get_categories_can_read( $mydirname ) ) . ')' ;

	// categories
	for( $i = 0 ; $i < count( $categories ) ; $i ++ ) {
		$categories[ $i ] = intval( $categories[ $i ] ) ;
	}
	$whr_categories = 'o.cat_id IN ('.implode(',',$categories).')' ;
	$categories4assign = implode(',',$categories) ;

	$sql = "SELECT content_id,subject FROM ".$db->prefix($mydirname."_contents")." o WHERE ($whr_read4cat) AND ($whr_categories) AND o.visible AND o.show_in_menu ORDER BY o.weight,o.content" ;
	if( ! $result = $db->query( $sql ) ) return array() ;

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'mod_config' => $configs ,
		'categories' => $categories4assign ,
	) ;

	while( $content_row = $db->fetchArray( $result ) ) {
		$block['contents'][] = array(
			'id' => intval( $content_row['content_id'] ) ,
			'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
		) ;
	}

	$tpl =& new XoopsTpl() ;
	$tpl->assign( 'block' , $block ) ;
	$ret['content'] = $tpl->fetch( $this_template ) ;
	return $ret ;
}



function b_pico_menu_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$categories = empty( $options[1] ) ? array(0) : explode(',',$options[1]) ;
	$this_template = empty( $options[2] ) ? 'db:'.$mydirname.'_block_menu.html' : trim( $options[2] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	for( $i = 0 ; $i < count( $categories ) ; $i ++ ) {
		$categories[ $i ] = intval( $categories[ $i ] ) ;
	}

	$form = "
		<input type='hidden' name='options[0]' value='$mydirname' />
		<label for='categories'>"._MB_PICO_CATLIMIT."</label>&nbsp;:
		<input type='text' size='20' name='options[1]' id='categories' value='".implode(',',$categories)."' />"._MB_PICO_CATLIMITDSC."
		<br />
		<label for='this_template'>"._MB_PICO_THISTEMPLATE."</label>&nbsp;:
		<input type='text' size='60' name='options[2]' id='this_template' value='".htmlspecialchars($this_template,ENT_QUOTES)."' />
		<br />
	\n" ;

	return $form;
}


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

	// forums can be read by current viewer (check by forum_access)
	require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
	$whr_read4cat = 'o.`cat_id` IN (' . implode( "," , pico_get_categories_can_read( $mydirname ) ) . ')' ;

	$sql = "SELECT * FROM ".$db->prefix($mydirname."_contents")." o WHERE ($whr_read4cat) AND content_id='$content_id' AND o.visible" ;
	if( ! $result = $db->query( $sql ) ) return array() ;
	if( ! $db->getRowsNum( $result ) ) return array() ;

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	$content_row = $db->fetchArray( $result ) ;
	
	// body/filter/cache
	if( $content_row['use_cache'] ) {
		if( $content_row['body_cached'] ) {
			$body4assign = $content_row['body_cached'] ;
		} else {
			$body4assign = pico_filter_body( $mydirname , $content_row['body'] , $content_row['filters'] , $content_id ) ;
			$db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET body_cached='".addslashes($body4assign)."' WHERE content_id='$content_id'" ) ;
		}
	} else {
		$body4assign = pico_filter_body( $mydirname , $content_row['body'] , $content_row['filters'] , $content_id ) ;
	}

	// assigning
	$content4assign = array(
		'id' => intval( $content_row['content_id'] ) ,
		'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
		'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
		'body' => $body4assign ,
	) ;
	$content4assign += $content_row ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'mod_config' => $configs ,
		'content' => $content4assign ,
	) ;

	$tpl =& new XoopsTpl() ;
	$tpl->assign( 'block' , $block ) ;
	$ret['content'] = $tpl->fetch( $this_template ) ;
	return $ret ;
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