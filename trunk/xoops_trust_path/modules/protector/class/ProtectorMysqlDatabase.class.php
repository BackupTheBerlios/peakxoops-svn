<?php

if( file_exists( XOOPS_ROOT_PATH.'/class/database/drivers/'.XOOPS_DB_TYPE.'/database.php' ) ) {
	require_once XOOPS_ROOT_PATH.'/class/database/drivers/'.XOOPS_DB_TYPE.'/database.php';
} else {
	require_once XOOPS_ROOT_PATH.'/class/database/'.XOOPS_DB_TYPE.'database.php';
}

require_once XOOPS_ROOT_PATH.'/class/database/database.php' ;

class ProtectorMySQLDatabase extends XoopsMySQLDatabaseProxy
{

var $doubtful_requests = array() ;
var $doubtful_needles = array(
	// 'order by' ,
	'concat' ,
	'information_schema' ,
	'select' ,
	'union' ,
	'/*' , /**/
	'--' ,
	'#' ,
) ;


function ProtectorMySQLDatabase()
{
	$protector =& Protector::getInstance() ;
	$this->doubtful_requests = $protector->getDblayertrapDoubtfuls() ;
	$this->doubtful_needles = array_merge( $this->doubtful_needles , $this->doubtful_requests ) ;
}


function injectionFound( $sql )
{
	$protector =& Protector::getInstance() ;

	$protector->last_error_type = 'SQL Injection' ;
	$protector->message .= $sql ;
	$protector->output_log( $protector->last_error_type ) ;
	die( 'SQL Injection found' ) ;
}


function removeQuotedStrings( $sql )
{
	$sql = trim( $sql ) ;
	$sql_len = strlen( $sql ) ;
	$char = '' ;
	$string_start = '' ;
	$in_string = false;
	$ret = '' ;

	for( $i = 0 ; $i < $sql_len ; $i ++ ) {
		$char = $sql[$i] ;
		if( $in_string ) {
			while( 1 ) {
				$i = strpos( $sql , $string_start , $i ) ;
				if( $i === false ) {
					return $ret ;
				} else if( /* $string_start == '`' || */ $sql[$i-1] != '\\' ) {
					$string_start = '' ;
					$in_string = false ;
					break ;
				} else {
					$j = 2 ;
					$escaped_backslash = false ;
					while( $i - $j > 0 && $sql[$i-$j] == '\\' ) {
						$escaped_backslash = ! $escaped_backslash ;
						$j++;
					}
					if ($escaped_backslash) {
						$string_start = '' ;
						$in_string = false ;
						break ;
					} else {
						$i++;
					}
				}
			}
		} else if( $char == '"' || $char == "'" ) { // dare to ignore ``
			$in_string = true ;
			$string_start = $char ;
		} else {
			$ret .= $char ;
		}
		// dare to ignore comment
		// because unescaped ' or " have been already checked in stage1
	}

	return $ret ;
}



function checkSql( $sql )
{
	// stage1: addslashes() processed or not
	foreach( $this->doubtful_requests as $request ) {
		if( addslashes( $request ) != $request ) {
			if( stristr( $sql , trim( $request ) ) ) {
				$this->injectionFound( $sql ) ;
			}
		}
	}

	// stage2: doubtful requests exists and outside of quotations ('or")
	// $_GET['d'] = '1 UNION SELECT ...'
	// NG: select a from b where c=$d
	// OK: select a from b where c='$d_escaped'
	// $_GET['d'] = '(select ... FROM)'
	// NG: select a from b where c=(select ... from)
	$sql_wo_strings = $this->removeQuotedStrings( $sql ) ;
	foreach( $this->doubtful_requests as $request ) {
		var_dump( $sql_wo_strings , trim( $request ) ) ;
		if( strstr( $sql_wo_strings , trim( $request ) ) ) {
			$this->injectionFound( $sql ) ;
		}
	}

	// stage3: comment exists or not without quoted strings (too sensitive?)
	if( preg_match( '/(\/\*|\-\-|\#)/' , $sql_wo_strings ) ) {
		$this->injectionFound( $sql ) ;
	}
}


function &query( $sql , $limit = 0 , $start = 0 )
{
	$sql4check = substr( $sql , 7 ) ;
	foreach( $this->doubtful_needles as $needle ) {
		if( stristr( $sql4check , $needle ) ) {
			$this->checkSql( $sql ) ;
			break ;
		}
	}

	if( ! defined( 'XOOPS_DB_PROXY' ) ) {
		$ret = parent::queryF( $sql , $limit , $start ) ;
	} else {
		$ret = parent::query( $sql , $limit , $start ) ;
	}
	return $ret ;
}

}

?>