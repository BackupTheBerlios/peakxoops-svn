<?php

eval( '

function '.$mydirname.'_global_search( $keywords , $andor , $limit , $offset , $userid )
{
	return pico_global_search_base( "'.$mydirname.'" , $keywords , $andor , $limit , $offset , $userid ) ;
}

' ) ;


if( ! function_exists( 'pico_global_search_base' ) ) {

function pico_global_search_base( $mydirname , $keywords , $andor , $limit , $offset , $userid )
{
	// not implemented for uid specifications
	if( ! empty( $userid ) ) {
		return array() ;
	}

	$db =& Database::getInstance() ;

	// XOOPS Search module
	$showcontext = empty( $_GET['showcontext'] ) ? 0 : 1 ;
	$select4con = $showcontext ? "`body_cached` AS text" : "'' AS text" ;

	if( is_array( $keywords ) && count( $keywords ) > 0 ) {
		switch( strtolower( $andor ) ) {
			case "and" :
				$whr = "" ;
				foreach( $keywords as $keyword ) {
					$whr .= "(`subject` LIKE '%$keyword%' OR `body_cached` LIKE '%$keyword%') AND " ;
				}
				$whr .= "1" ;
				break ;
			case "or" :
				$whr = "" ;
				foreach( $keywords as $keyword ) {
					$whr .= "(`subject` LIKE '%$keyword%' OR `body_cached` LIKE '%$keyword%') OR " ;
				}
				$whr .= "0" ;
				break ;
			default :
				$whr = "(`subject` LIKE '%$keywords[0]%' OR `body_cached` LIKE '%{$keywords[0]}%')" ;
				break ;
		}
	} else {
		$whr = 1 ;
	}

	$sql = "SELECT `content_id`,`subject`,`created_time`,$select4con FROM ".$db->prefix( $mydirname."_contents WHERE ($whr) ORDER BY 1" ) ;
	$result = $db->query( $sql , $limit , $offset ) ;
	$ret = array() ;
	$context = '' ;
	while( list( $content_id , $subject , $created_time , $text ) = $db->fetchRow( $result ) ) {

		// get context for module "search"
		if( function_exists( 'search_make_context' ) && $showcontext ) {
			$full_context = strip_tags( $text ) ;
			if( function_exists( 'easiestml' ) ) $full_context = easiestml( $full_context ) ;
			$context = search_make_context( $full_context , $keywords ) ;
		}

		$ret[] = array(
			"image" => "" ,
			"link" => "index.php?content_id=$content_id" ,
			"title" => $subject ,
			"time" => $created_time ,
			"uid" => "0" ,
			"context" => $context
		) ;
	}

	return $ret ;
}

}


?>