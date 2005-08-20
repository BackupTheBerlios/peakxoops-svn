<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^myalbum\d*$/' , $mydirname ) ) die ( "invalid dirname of myalbum: " . htmlspecialchars( $mydirname ) ) ;

eval( '
function '.$mydirname.'_search( $keywords , $andor , $limit , $offset , $userid )
{
	return myalbum_search_base( "'.$mydirname.'" , $keywords , $andor , $limit , $offset , $userid ) ;
}
' ) ;

if( ! function_exists( 'myalbum_search_base' ) ) {

function myalbum_search_base( $mydirname , $keywords , $andor , $limit , $offset , $userid )
{
	global $xoopsDB ;

	include( XOOPS_ROOT_PATH."/modules/$mydirname/include/read_configs.php" ) ;

	// XOOPS Search module
	$showcontext = empty( $_GET['showcontext'] ) ? 0 : 1 ;
	$select4con = $showcontext ? "t.description" : "''" ;

	$sql = "SELECT l.lid,l.cid,l.title,l.submitter,l.date,$showcontext FROM $table_photos l LEFT JOIN $table_text t ON t.lid=l.lid LEFT JOIN ".$xoopsDB->prefix("users")." u ON l.submitter=u.uid WHERE status>0" ;

	if( $userid > 0 ) {
		$sql .= " AND l.submitter=".$userid." ";
	}

	$whr = "" ;
	if( is_array( $keywords ) && count( $keywords ) > 0 ) {
		$whr = "AND (" ;
		switch( strtolower( $andor ) ) {
			case "and" :
				foreach( $keywords as $keyword ) {
					$whr .= "CONCAT(l.title,' ',t.description,' ',u.uname) LIKE '%$keyword%' AND " ;
				}
				$whr = substr( $whr , 0 , -5 ) ;
				break ;
			case "or" :
				foreach( $keywords as $keyword ) {
					$whr .= "CONCAT(l.title,' ',t.description,' ',u.uname) LIKE '%$keyword%' OR " ;
				}
				$whr = substr( $whr , 0 , -4 ) ;
				break ;
			default :
				$whr .= "CONCAT(l.title,'  ',t.description,' ',u.uname) LIKE '%{$keywords[0]}%'" ;
				break ;
		}
		$whr .= ")" ;
	}

	$sql = "$sql $whr ORDER BY l.date DESC";
	$result = $xoopsDB->query( $sql , $limit , $offset ) ;
	$ret = array() ;
	$context = '' ;
	$myts =& MyTextSanitizer::getInstance();
	while( $myrow = $xoopsDB->fetchArray($result) ) {

		// get context for module "search"
		if( function_exists( 'search_make_context' ) && $showcontext ) {
			$context = search_make_context( strip_tags( $myts->displayTarea( $myrow['description'] , 0 , 1 , 1 , 1 , 1 ) ) , $keywords ) ;
		}

		$ret[] = array(
			"image" => "images/pict.gif" ,
			"link" => "photo.php?lid=".$myrow["lid"] ,
			"title" => $myrow["title"] ,
			"time" => $myrow["date"] ,
			"uid" => $myrow["submitter"] ,
			"context" => $context
		) ;
	}
	return $ret;
}

}

?>