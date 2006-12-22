<?php

function b_pico_menu_show( $options )
{
	global $xoopsUser ;

	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$categories = trim( @$options[1] ) === '' ? array() : explode(',',$options[1]) ;
	$this_template = empty( $options[2] ) ? 'db:'.$mydirname.'_block_menu.html' : trim( $options[2] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	// categories can be read by current viewer (check by category_permissions)
	require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
	$whr_read4cat = 'o.`cat_id` IN (' . implode( "," , pico_get_categories_can_read( $mydirname ) ) . ')' ;

	// categories
	if( $categories === array() ) {
		$whr_categories = '1' ;
		$categories4assign = '' ;
	} else {
		for( $i = 0 ; $i < count( $categories ) ; $i ++ ) {
			$categories[ $i ] = intval( $categories[ $i ] ) ;
		}
		$whr_categories = 'o.cat_id IN ('.implode(',',$categories).')' ;
		$categories4assign = implode(',',$categories) ;
	}

	$sql = "SELECT o.content_id,o.subject,o.created_time,o.modified_time,o.poster_uid,c.cat_id,c.cat_title,c.cat_depth_in_tree FROM ".$db->prefix($mydirname."_contents")." o LEFT JOIN ".$db->prefix($mydirname."_categories")." c ON o.cat_id=c.cat_id WHERE ($whr_read4cat) AND ($whr_categories) AND o.visible AND o.show_in_menu ORDER BY c.cat_order_in_tree,o.weight" ;
	if( ! $result = $db->query( $sql ) ) {
		echo $db->logger->dumpQueries() ;
		exit ;
	}

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'mod_config' => $configs ,
		'categories' => $categories4assign ,
		'lang_category' => constant($constpref.'_CATEGORY') ,
		'lang_topcategory' => constant($constpref.'_TOPCATEGORY') ,
	) ;

	while( $content_row = $db->fetchArray( $result ) ) {
		$cat_id = intval( $content_row['cat_id'] ) ;
		$cat4assign[$cat_id]['id'] = intval( $content_row['cat_id'] ) ;
		$cat4assign[$cat_id]['title'] = $myts->makeTboxData4Show( $content_row['cat_title'] ) ;
		$cat4assign[$cat_id]['depth_in_tree'] = intval( $content_row['cat_depth_in_tree'] ) ;
		$cat4assign[$cat_id]['contents'][] = array(
			'id' => intval( $content_row['content_id'] ) ,
			'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
			'created_time' => $content_row['created_time'] ,
			'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
			'modified_time' => $content_row['modified_time'] ,
			'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
			'poster_uid' => $content_row['poster_uid'] ,
		) ;
	}
	$block['categories'] = @$cat4assign ;

	$tpl =& new XoopsTpl() ;
	$tpl->assign( 'block' , $block ) ;
	$ret['content'] = $tpl->fetch( $this_template ) ;
	return $ret ;
}



function b_pico_menu_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$categories = trim( @$options[1] ) === '' ? array() : explode(',',$options[1]) ;
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

?>