<?php

function b_pico_list_allowed_order()
{
	return array(
		'o.weight' ,
		'o.weight DESC' ,
		'o.created_time' ,
		'o.created_time DESC' ,
		'o.modified_time' ,
		'o.modified_time DESC' ,
		'o.viewed' ,
		'o.viewed DESC' ,
		'o.votes_sum' ,
		'o.votes_sum DESC' ,
		'o.votes_count' ,
		'o.votes_count DESC' ,
	) ;
}


function b_pico_list_show( $options )
{
	global $xoopsUser ;

	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$categories = trim( @$options[1] ) === '' ? array() : explode(',',$options[1]) ;
	$selected_order = empty( $options[2] ) || ! in_array( $options[2] , b_pico_list_allowed_order() ) ? 'o.created_time' : $options[2] ;
	$contents_num = empty( $options[3] ) ? 10 : intval( $options[3] ) ;
	$this_template = empty( $options[4] ) ? 'db:'.$mydirname.'_block_list.html' : trim( $options[4] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	// categories can be read by current viewer (check by category_permissions)
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

	$sql = "SELECT o.content_id,o.vpath,o.subject,o.created_time,o.modified_time,o.poster_uid,c.cat_id,c.cat_title FROM ".$db->prefix($mydirname."_contents")." o LEFT JOIN ".$db->prefix($mydirname."_categories")." c ON o.cat_id=c.cat_id WHERE ($whr_read4cat) AND ($whr_categories) AND o.visible ORDER BY $selected_order,o.content_id LIMIT $contents_num" ;
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
		$block['contents'][] = array(
			'id' => intval( $content_row['content_id'] ) ,
			'link' => pico_make_content_link4html( $configs , $content_row ) ,
			'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
			'created_time' => $content_row['created_time'] ,
			'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
			'modified_time' => $content_row['modified_time'] ,
			'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
			'poster_uid' => $content_row['poster_uid'] ,
			'cat_id' => intval( $content_row['cat_id'] ) ,
			'cat_title' => $myts->makeTboxData4Show( $content_row['cat_title'] ) ,
		) ;
	}

	$tpl =& new XoopsTpl() ;
	$tpl->assign( 'block' , $block ) ;
	$ret['content'] = $tpl->fetch( $this_template ) ;
	return $ret ;
}



function b_pico_list_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'pico' : $options[0] ;
	$categories = trim( @$options[1] ) === '' ? array() : explode(',',$options[1]) ;
	$selected_order = empty( $options[2] ) || ! in_array( $options[2] , b_pico_list_allowed_order() ) ? 'o.created_time' : $options[2] ;
	$contents_num = empty( $options[3] ) ? 10 : intval( $options[3] ) ;
	$this_template = empty( $options[4] ) ? 'db:'.$mydirname.'_block_list.html' : trim( $options[4] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	for( $i = 0 ; $i < count( $categories ) ; $i ++ ) {
		$categories[ $i ] = intval( $categories[ $i ] ) ;
	}

	$order_options = '' ;
	foreach( b_pico_list_allowed_order() as $order ) {
		$order_options .= '<option value="'.htmlspecialchars($order).'" '.($order==$selected_order?'selected="selected"':'').'>'.htmlspecialchars($order).'</option>' ;
	}

	$form = "
		<input type='hidden' name='options[0]' value='$mydirname' />
		<label for='categories'>"._MB_PICO_CATLIMIT."</label>&nbsp;:
		<input type='text' size='20' name='options[1]' id='categories' value='".implode(',',$categories)."' />"._MB_PICO_CATLIMITDSC."
		<br />
		<label for='this_template'>"._MB_PICO_SELECTORDER."</label>&nbsp;:
		<select name='options[2]' id='select_order'>
			$order_options
		</select>
		<br />
		<label for='contents_num'>"._MB_PICO_CONTENTSNUM."</label>&nbsp;:
		<input type='text' size='4' name='options[3]' id='contents_num' value='$contents_num' />
		<br />
		<label for='this_template'>"._MB_PICO_THISTEMPLATE."</label>&nbsp;:
		<input type='text' size='60' name='options[4]' id='this_template' value='".htmlspecialchars($this_template,ENT_QUOTES)."' />
		<br />
	\n" ;

	return $form;
}

?>