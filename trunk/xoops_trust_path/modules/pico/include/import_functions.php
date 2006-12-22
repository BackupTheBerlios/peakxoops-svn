<?php

$GLOBALS['pico_tables'] = array(
	'category_permissions' => array(
		'cat_id' ,
		'uid' ,
		'groupid' ,
		'permissions' ,
	) ,
	'categories' => array(
		'cat_id' ,
		'pid' ,
		'cat_title' ,
		'cat_desc' ,
		'cat_depth_in_tree' ,
		'cat_order_in_tree' ,
		'cat_path_in_tree' ,
		'cat_unique_path' ,
		'cat_weight' ,
		'cat_options' ,
	) ,
	'contents' => array(
		'content_id' ,
		'cat_id' ,
		'weight' ,
		'created_time' ,
		'modified_time' ,
		'poster_uid' ,
		'poster_ip' ,
		'modifier_uid' ,
		'modifier_ip' ,
		'subject' ,
		'subject_waiting' ,
		'visible' ,
		'approval' ,
		'use_cache' ,
		'allow_comment' ,
		'show_in_navi' ,
		'show_in_menu' ,
		'viewed' ,
		'votes_sum' ,
		'votes_count' ,
		'htmlheader' ,
		'htmlheader_waiting' ,
		'body' ,
		'body_waiting' ,
		'body_cached' ,
		'filters' ,
	) ,
	'content_votes' => array(
		'vote_id' ,
		'content_id' ,
		'uid' ,
		'vote_point' ,
		'vote_time' ,
		'vote_ip' ,
	) ,
) ;


function pico_import_errordie()
{
	$db =& Database::getInstance() ;

	echo _MD_A_PICO_ERR_SQLONIMPORT ;
	echo $db->logger->dumpQueries() ;
	exit ;
}



function pico_import_from_tinyd( $mydirname , $import_mid )
{
	$db =& Database::getInstance() ;

	// get name of `contents` table 
	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->get( $import_mid ) ;
	list( $from_table_base ) = $module->getInfo('tables') ;
	if( empty( $from_table_base ) ) pico_import_errordie() ;
	$target_dirname = $module->getVar('dirname') ;

	// categories
	// skip all

	// category_permissions
	// skip all

	// content_votes (delete all)
	$db->query( "DELETE FROM ".$db->prefix($mydirname."_content_votes") ) ;

	// contents (temporary body_waiting,body_cached for reconstruct filters)
	$to_table = $db->prefix( $mydirname.'_contents' ) ;
	$from_table = $db->prefix( $from_table_base ) ;
	$db->query( "DELETE FROM `$to_table`" ) ;
	$irs = $db->query( "INSERT INTO `$to_table` (content_id,cat_id,weight,created_time,modified_time,subject,visible,allow_comment,show_in_navi,show_in_menu,htmlheader,body,filters,body_waiting,body_cached,subject_waiting) SELECT storyid,0,blockid,UNIX_TIMESTAMP(created),UNIX_TIMESTAMP(last_modified),title,visible,!nocomments,1,submenu,html_header,`text`,nohtml,nosmiley,nobreaks,address FROM `$from_table`" ) ;
	if( ! $irs ) pico_import_errordie() ;

	// update filters
	$db->query( "UPDATE `$to_table` SET filters='textwiki' WHERE filters='16'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='textwiki|xcode' WHERE filters='18'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='eval' WHERE filters='8'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='eval|xcode' WHERE filters='10'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='htmlspecialchars' WHERE filters='3'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='' WHERE filters='2'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='htmlspecialchars|xcode' WHERE filters='1'" ) ;
	$db->query( "UPDATE `$to_table` SET filters='xcode' WHERE filters='0'" ) ;
	$db->query( "UPDATE `$to_table` SET filters=CONCAT(filters,'|smiley') WHERE body_waiting='0'" ) ;
	$db->query( "UPDATE `$to_table` SET filters=CONCAT(filters,'|nl2br') WHERE body_cached='0'" ) ;
	$db->query( "UPDATE `$to_table` SET body_waiting='',body_cached=''" ) ;

	// import page wrap as db content (subject_waiting is temporary for address)
	$result = $db->query( "SELECT content_id,subject_waiting FROM `$to_table` WHERE subject_waiting<>''" ) ;
	if( ! $result ) pico_import_errordie() ;
	while( list( $id , $address ) = $db->fetchRow( $result ) ) {
		if( file_exists( XOOPS_ROOT_PATH.'/modules/'.$target_dirname.'/content/'.$address ) ) {
			$body = file_get_contents( XOOPS_ROOT_PATH.'/modules/'.$target_dirname.'/content/'.$address ) ;
			// convert encoding
			if( function_exists( 'mb_convert_encoding' ) ) {
				$body = mb_convert_encoding( $body , mb_internal_encoding() , "auto" ) ;
			}
		} else {
			$body = '' ;
		}
		$urs = $db->query( "UPDATE `$to_table` SET subject_waiting='', filters='', body='".addslashes($body)."' WHERE content_id=$id" ) ;
		if( ! $urs ) pico_import_errordie() ;
	}

}

function pico_import_from_pico( $mydirname , $import_mid )
{
	$db =& Database::getInstance() ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$from_module =& $module_handler->get( $import_mid ) ;

	foreach( $GLOBALS['pico_tables'] as $table_name => $columns ) {
		$to_table = $db->prefix( $mydirname.'_'.$table_name ) ;
		$from_table = $db->prefix( $from_module->getVar('dirname').'_'.$table_name ) ;
		$columns4sql = implode( ',' , $columns ) ;
		$db->query( "DELETE FROM `$to_table`" ) ;
		$irs = $db->query( "INSERT INTO `$to_table` ($columns4sql) SELECT $columns4sql FROM `$from_table`" ) ;
		if( ! $irs ) pico_import_errordie() ;
	}
}


?>