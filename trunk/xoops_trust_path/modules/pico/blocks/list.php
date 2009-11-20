<?php

function b_pico_list_get_order_options( $mod_config )
{
	$builtin_orders = array(
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
		'o.weight,o.created_time' ,
		'o.weight,o.created_time DESC' ,
		'o.weight,o.content_id' ,
		'o.weight,o.content_id DESC' ,
	) ;
	$ret = array_combine( $builtin_orders , $builtin_orders ) ;

	$sortables = array_map( 'trim' , explode( ',' , $mod_config['extra_fields_sortables'] ) ) ;
	if( ! empty( $sortables ) ) {
		foreach( $sortables as $key => $field ) {
			$ret[ "e.ef{$key}" ] = "$field" ;
			$ret[ "e.ef{$key} DESC" ] = "$field DESC" ;
		}
	}

	return $ret ;
}


function b_pico_list_show( $options )
{
	// options
	$mytrustdirname = basename(dirname(dirname(__FILE__))) ;
	$mydirname = empty( $options[0] ) ? $mytrustdirname : $options[0] ;
	$categories = trim( @$options[1] ) === '' ? array() : array_map( 'intval' , explode( ',' , $options[1] ) ) ;
	$selected_order = empty( $options[2] ) ? 'o.created_time DESC' : $options[2] ;
	$limit_offset = empty( $options[3] ) ? '10' : preg_replace( '/[^0-9,]/' , '' , $options[3] ) ;
	if( strstr( $limit_offset , ',' ) ) {
		list( $offset , $limit ) = array_map( 'intval' , explode( ',' , $limit_offset ) ) ;
	} else {
		$offset = 0 ;
		$limit = intval( $limit_offset ) ;
	}
	$this_template = empty( $options[4] ) ? 'db:'.$mydirname.'_block_list.html' : trim( $options[4] ) ;
	$display_body = empty( $options[5] ) ? false : true ;
	$tags = empty( $options[6] ) ? '' : trim( $options[6] ) ;

	// mydirname check
	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	// module config (not overridden yet)
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$mod_config = $config_handler->getConfigList( $module->mid() ) ;

	// content handler
	$content_handler =& new PicoContentHandler( $mydirname ) ;

	// contentObjects
	$picoPermission =& PicoPermission::getInstance() ;
	$permissions = $picoPermission->getPermissions( $mydirname ) ;
	if( sizeof( $categories ) == 0 ) {
		// no category specified
		$mod_config_overridden = $mod_config ;
		$contents4assign = $content_handler->getContents4assign( '1' , $selected_order , $offset , $limit , false , $tags ) ;
	} else if( sizeof( $categories ) == 1 && $categories[0] > 0 ) {
		// single category (not hierarchical) eg) cat_id=1
		$cat_id = abs( $categories[0] ) ;
		$currentCategoryObj =& new PicoCategory( $mydirname , $cat_id , $permissions ) ;
		$mod_config_overridden = $currentCategoryObj->getOverriddenModConfig() ;
		$contents4assign = $content_handler->getContents4assign( 'o.cat_id='.$cat_id , $selected_order , $offset , $limit , false , $tags ) ;
	} else if( sizeof( $categories ) == 1 && $categories[0] < 0 ) {
		// single category (hierarchical)  eg) cat_id=-1
		$cat_id = abs( $categories[0] ) ;
		$currentCategoryObj =& new PicoCategory( $mydirname , $cat_id , $permissions ) ;
		$mod_config_overridden = $currentCategoryObj->getOverriddenModConfig() ;
		$child_ids = $currentCategoryObj->getChildIds() ;
		$contents4assign = $content_handler->getContents4assign( 'o.cat_id IN ('.$cat_id.','.implode(',',$child_ids).')' , $selected_order , $offset , $limit , false , $tags ) ;
	} else {
		// multi category  eg) cat_id=1,2,3
		$mod_config_overridden = $mod_config ;
		$contents4assign = $content_handler->getContents4assign( 'o.cat_id IN ('.implode(',',$categories).')' , $selected_order , $offset , $limit , false , $tags ) ;
	}

	// compatibility for 1.5/1.6
	foreach( array_keys( $contents4assign ) as $i ) {
		$contents4assign[$i]['body'] = $display_body ? $contents4assign[$i]['body_cached'] : '' ;
	}

	// constpref
	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	// make an array named 'block'
	$block = array( 
		'mytrustdirname' => $mytrustdirname ,
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$mod_config_overridden['images_dir'] ,
		'mod_config_overridden' => $mod_config_overridden ,
		'mod_config' => $mod_config ,
		'contents' => $contents4assign ,
		'display_body' => $display_body ,
		'lang_category' => constant($constpref.'_CATEGORY') ,
		'lang_topcategory' => constant($constpref.'_TOPCATEGORY') ,
	) ;

	if( empty( $options['disable_renderer'] ) ) {
		// render it
		require_once XOOPS_ROOT_PATH.'/class/template.php' ;
		$tpl =& new XoopsTpl() ;
		$tpl->assign( 'block' , $block ) ;
		$ret['content'] = $tpl->fetch( $this_template ) ;
		return $ret ;
	} else {
		// just assign it
		return $block ;
	}
}



function b_pico_list_edit( $options )
{
	// options
	$mytrustdirname = basename(dirname(dirname(__FILE__))) ;
	$mydirname = empty( $options[0] ) ? $mytrustdirname : $options[0] ;
	$categories = trim( @$options[1] ) === '' ? array() : array_map( 'intval' , explode( ',' , $options[1] ) ) ;
	$selected_order = empty( $options[2] ) ? 'o.created_time DESC' : $options[2] ;
	$limit_offset = empty( $options[3] ) ? '10' : preg_replace( '/[^0-9,]/' , '' , $options[3] ) ;
	$this_template = empty( $options[4] ) ? 'db:'.$mydirname.'_block_list.html' : trim( $options[4] ) ;
	$display_body = empty( $options[5] ) ? false : true ;
	$tags = empty( $options[6] ) ? '' : trim( $options[6] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	// module config (not overridden yet)
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$mod_config = $config_handler->getConfigList( $module->mid() ) ;

	require_once XOOPS_ROOT_PATH.'/class/template.php' ;
	$tpl =& new XoopsTpl() ;
	$tpl->assign( array(
		'mydirname' => $mydirname ,
		'categories' => $categories ,
		'categories_imploded' => implode( ',' , $categories ) ,
		'order_options' => b_pico_list_get_order_options( $mod_config ) ,
		'selected_order' => $selected_order ,
		'contents_num' => $limit_offset ,
		'this_template' => $this_template ,
		'display_body' => $display_body ,
		'tags' => $tags ,
	) ) ;
	return $tpl->fetch( 'db:'.$mydirname.'_blockedit_list.html' ) ;
}

?>