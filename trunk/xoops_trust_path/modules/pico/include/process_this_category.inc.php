<?php

// get this "category" from given $cat_id
$sql = "SELECT * FROM ".$db->prefix($mydirname."_categories")." c WHERE $whr_read4cat AND c.cat_id=$cat_id" ;
if( ! $crs = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
if( $db->getRowsNum( $crs ) <= 0 ) {
	$cat_row = array(
		'cat_id' => 0 ,
		'pid' => 0 ,
		'cat_title' => $xoopsModule->getVar('name') ,
		'cat_desc' => $xoopsModuleConfig['top_message'] ,
		'cat_weight' => 0 ,
		'cat_path_in_tree' => serialize( array() ) ,
	) ;
} else {
	$cat_row = $db->fetchArray( $crs ) ;
}

$isadminormod = (boolean)$category_permissions[ $cat_id ]['is_moderator'] || $isadmin ;
$category4assign = array(
	'id' => intval( $cat_row['cat_id'] ) ,
	'pid' => $cat_row['pid'] ,
	'title' => $myts->makeTboxData4Show( $cat_row['cat_title'] ) ,
	'desc' => $myts->displayTarea( $cat_row['cat_desc'] ) ,
	'isadminormod' => $isadminormod ,
	'can_post' => ( $isadminormod || @$category_permissions[ $cat_id ]['can_post'] ) ,
	'can_edit' => ( $isadminormod || @$category_permissions[ $cat_id ]['can_edit'] ) ,
	'can_delete' => ( $isadminormod || @$category_permissions[ $cat_id ]['can_delete'] ) ,
	'can_makesubcategory' => ( $isadminormod || @$category_permissions[ $cat_id ]['can_makesubcategory'] ) ,
	'paths_raw' => unserialize( $cat_row['cat_path_in_tree'] ) ,
) ;

// $xoopsModuleConfig override
$cat_configs = @unserialize( @$cat_row['cat_options'] ) ;
if( is_array( $cat_configs ) ) foreach( $cat_configs as $key => $val ) {
	if( isset( $xoopsModuleConfig[ $key ] ) ) {
		$xoopsModuleConfig[ $key ] = $val ;
	}
}

// get top $content_id if necessary
if( empty( $content_id ) && empty( $xoopsModuleConfig['show_listasindex'] ) ) {
	$content_id = pico_get_top_content_id_from_cat_id( $mydirname , $cat_id ) ;
}

?>