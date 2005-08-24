<?php

class Protector {

var $_conn ;
var $_conf = array() ;

var $_bad_globals = array() ;

var $message = '' ;
var $warning = false ;
var $error = false ;
var $_doubtful_requests = array() ;

var $_logged = false ;

var $_done_badext = false ;
var $_done_intval = false ;
var $_done_dotdot = false ;
var $_done_nullbyte = false ;
var $_done_contami = false ;
var $_done_isocom = false ;
var $_done_union = false ;
var $_done_dos = false ;

var $_safe_badext = true ;
var $_safe_contami = true ;
var $_safe_isocom = true ;
var $_safe_union = true ;

var $_should_be_banned = false ;

var $_dos_stage = null ;

var $last_error_type = 'UNKNOWN' ;


// Constructor
function Protector( $conn )
{
	$this->_conn = $conn ;

	// Preferences (for performance, I dare to use an irregular method)
	$result = mysql_query( "SELECT conf_name,conf_value FROM ".XOOPS_DB_PREFIX."_config WHERE conf_title like '_MI_PROTECTOR%'" , $conn ) ;
	if( mysql_num_rows( $result ) < 5 ) return false ;
	$this->_conf = array() ;
	while( list( $key , $val ) = mysql_fetch_row( $result ) ) {
		$this->_conf[ $key ] = $val ;
	}

	if( ! empty( $this->_conf['global_disabled'] ) ) return true ;

	// against PHP_SELF XSS
	if( preg_match( '/[<>\'";\n ]/' , @$_SERVER['PHP_SELF'] ) ) {
		$this->message .= "Invalid PHP_SELF '{$_SERVER['PHP_SELF']}' found.\n" ;
		$this->output_log( 'PHP_SELF XSS' ) ;
		die( 'invalid PHP_SELF' ) ;
	}

	$this->_bad_globals = array( 'GLOBALS' , '_SESSION' , 'HTTP_SESSION_VARS' , '_GET' , 'HTTP_GET_VARS' , '_POST' , 'HTTP_POST_VARS' , '_COOKIE' , 'HTTP_COOKIE_VARS' , '_SERVER' , 'HTTP_SERVER_VARS' , '_REQUEST' , '_ENV' , '_FILES' , 'xoopsDB' , 'xoopsUser' , 'xoopsUserId' , 'xoopsUserGroups' , 'xoopsUserIsAdmin' , 'xoopsConfig' , 'xoopsOption' , 'xoopsModule' , 'xoopsModuleConfig' ) ;

	$this->_initial_recursive( $_GET , 'G' ) ;
	$this->_initial_recursive( $_POST , 'P' ) ;
	$this->_initial_recursive( $_COOKIE , 'C' ) ;
}


function _initial_recursive( $val , $key )
{
	if( is_array( $val ) ) {
		foreach( $val as $subkey => $subval ) {
			// check bad globals
			if( in_array( $subkey , $this->_bad_globals , true ) ) {
				$this->message .= "Attempt to inject '$subkey' was found.\n" ;
				$this->_safe_contami = false ;
				$this->last_error_type = 'CONTAMI' ;
			}
			$this->_initial_recursive( $subval , $key . '_' . base64_encode( $subkey ) ) ;
		}
	} else {
		// check nullbyte attack
		if( $this->_conf['san_nullbyte'] && strstr( $val , chr(0) ) ) {
			$val = str_replace( chr(0) , ' ' , $val ) ;
			$this->replace_doubtful( $key , $val ) ;
			$this->message .= "Injecting Null-byte '$val' found.\n" ;
			$this->output_log( 'NullByte' , 0 , false , 64 ) ;
			// $this->purge() ;
		}

		// register as doubtful requests against SQL Injections
		if( preg_match( '?[\s\'"`/]?' , $val ) ) {
			$this->_doubtful_requests["$key"] = $val ;
		}
	}
}


function &getInstance( $conn )
{
	static $instance ;
	if( ! isset( $instance ) ) {
		$instance = new Protector( $conn ) ;
	}
	return $instance ;
}


function getConf()
{
	return $this->_conf ;
}


function purge( $redirect_to_top = false )
{
	// clear all session values
	if( isset( $_SESSION ) ) foreach( $_SESSION as $key => $val ) {
		$_SESSION[ $key ] = '' ;
		if( isset( $GLOBALS[ $key ] ) ) $GLOBALS[ $key ] = '' ;
	}

	if( ! headers_sent() ) {
		// clear typical session id of PHP
		setcookie( 'PHPSESSID' , '' , time() - 3600 , '/' , '' , 0 ) ;
		if( isset( $_COOKIE[ session_name() ] ) ) {
			setcookie( session_name() , '' , time() - 3600 , '/' , '' , 0 ) ;
		}

		// clear autologin cookie
		$xoops_cookie_path = defined('XOOPS_COOKIE_PATH') ? XOOPS_COOKIE_PATH : preg_replace( '?http://[^/]+(/.*)$?' , "$1" , XOOPS_URL ) ;
		if( $xoops_cookie_path == XOOPS_URL ) $xoops_cookie_path = '/' ;
		setcookie('autologin_uname', '', time() - 3600, $xoops_cookie_path, '', 0);
		setcookie('autologin_pass', '', time() - 3600, $xoops_cookie_path, '', 0);
	}

	if( $redirect_to_top ) {
		Header( 'Location: '.XOOPS_URL.'/' ) ;
	}

	exit ;
}


function output_log( $type = 'UNKNOWN' , $uid = 0 , $unique_check = false , $level = 1 )
{
	if( $this->_logged ) return true ;

	if( ! ( $this->_conf['log_level'] & $level ) ) return true ;

	if( empty( $this->_conn ) ) return false ;

	$ip = $_SERVER['REMOTE_ADDR'] ;
	$agent = $_SERVER['HTTP_USER_AGENT'] ;

	if( $unique_check ) {
		$result = mysql_query( "SELECT ip,type FROM ".XOOPS_DB_PREFIX."_protector_log ORDER BY timestamp DESC LIMIT 1" , $this->_conn ) ;
		list( $last_ip , $last_type ) = mysql_fetch_row( $result ) ;
		if( $last_ip == $ip && $last_type == $type ) {
			$this->_logged = true ;
			return true ;
		}
	}

	mysql_query( "INSERT INTO ".XOOPS_DB_PREFIX."_protector_log SET ip='".addslashes($ip)."',agent='".addslashes($agent)."',type='".addslashes($type)."',description='".addslashes($this->message)."',uid='".intval($uid)."'" , $this->_conn ) ;
	$this->_logged = true ;
	return true ;
}


function register_bad_ips( $ip = null )
{
	if( empty( $ip ) ) $ip = $_SERVER['REMOTE_ADDR'] ;
	if( empty( $ip ) ) return false ;

	$db = Database::getInstance() ;
	$rs = $db->query( "SELECT conf_value FROM ".$db->prefix("config")." WHERE conf_name='bad_ips' AND conf_modid=0 AND conf_catid=1" ) ;
	list( $bad_ips_serialized ) = $db->fetchRow( $rs ) ;
	$bad_ips = unserialize( $bad_ips_serialized ) ;
	$bad_ips[] = $ip ;

	$conf_value = addslashes( serialize( array_unique( $bad_ips ) ) ) ;
	$db->queryF( "UPDATE ".$db->prefix("config")." SET conf_value='$conf_value' WHERE conf_name='bad_ips' AND conf_modid=0 AND conf_catid=1" ) ;

	return true ;
}


function deny_by_htaccess( $ip = null )
{
	if( empty( $ip ) ) $ip = $_SERVER['REMOTE_ADDR'] ;
	if( empty( $ip ) ) return false ;
	if( ! function_exists( 'file_get_contents' ) ) return false ;

	$target_htaccess = XOOPS_ROOT_PATH.'/.htaccess' ;
	$backup_htaccess = XOOPS_ROOT_PATH.'/uploads/.htaccess.bak' ;

	$ht_body = file_get_contents( $target_htaccess ) ;

	// make backup as uploads/.htaccess.bak automatically
	if( $ht_body && ! file_exists( $backup_htaccess ) ) {
		$fw = fopen( $backup_htaccess , "w" ) ;
		fwrite( $fw , $ht_body ) ;
		fclose( $fw ) ;
	}

	// if .htaccess is broken, restore from backup
	if( ! $ht_body && file_exists( $backup_htaccess ) ) {
		$ht_body = file_get_contents( $backup_htaccess ) ;
	}

	// new .htaccess
	if( $ht_body === false ) {
		$ht_body = '' ;
	}

	if( preg_match( "/^(.*)#PROTECTOR#\s+(DENY FROM .*)\n#PROTECTOR#\n(.*)$/si" , $ht_body , $regs ) ) {
		if( substr( $regs[2] , - strlen( $ip ) ) == $ip ) return true ;
		$new_ht_body = $regs[1] . "#PROTECTOR#\n" . $regs[2] . " $ip\n#PROTECTOR#\n" . $regs[3] ;
	} else {
		$new_ht_body = "#PROTECTOR#\nDENY FROM $ip\n#PROTECTOR#\n" . $ht_body ;
	}

	// error_log( "$new_ht_body\n" , 3 , "/tmp/error_log" ) ;

	$fw = fopen( $target_htaccess , "w" ) ;
	@flock( $fw , LOCK_EX ) ;
	fwrite( $fw , $new_ht_body ) ;
	@flock( $fw , LOCK_UN ) ;
	fclose( $fw ) ;

	return true ;
}


function intval_allrequestsendid()
{
	global $HTTP_GET_VARS , $HTTP_POST_VARS , $HTTP_COOKIE_VARS ;

	if( $this->_done_intval ) return true ;
	else $this->_done_intval = true ;

	foreach( $_GET as $key => $val ) {
		if( substr( $key , -2 ) == 'id' && ! is_array( $_GET[ $key ] ) ) {
			$_GET[ $key ] = $HTTP_GET_VARS[ $key ] = intval( $val ) ;
			if( $_REQUEST[ $key ] == $_GET[ $key ] ){
				$_REQUEST[ $key ] = intval( $val ) ;
			}
		}
	}
	foreach( $_POST as $key => $val ) {
		if( substr( $key , -2 ) == 'id' && ! is_array( $_POST[ $key ] ) ) {
			$_POST[ $key ] = $HTTP_POST_VARS[ $key ] = intval( $val ) ;
			if( $_REQUEST[ $key ] == $_POST[ $key ] ){
				$_REQUEST[ $key ] = intval( $val ) ;
			}
		}
	}
	foreach( $_COOKIE as $key => $val ) {
		if( substr( $key , -2 ) == 'id' && ! is_array( $_COOKIE[ $key ] ) ) {
			$_COOKIE[ $key ] = $HTTP_COOKIE_VARS[ $key ] = intval( $val ) ;
			if( $_REQUEST[ $key ] == $_COOKIE[ $key ] ){
				$_REQUEST[ $key ] = intval( $val ) ;
			}
		}
	}

	return true ;
}


function eliminate_dotdot()
{
	global $HTTP_GET_VARS , $HTTP_POST_VARS , $HTTP_COOKIE_VARS ;

	if( $this->_done_dotdot ) return true ;
	else $this->_done_dotdot = true ;

	foreach( $_GET as $key => $val ) {
		if( is_array( $_GET[ $key ] ) ) continue ;
		if( substr( trim( $val ) , 0 , 3 ) == '../' || strstr( $val , '../../' ) ) {
			$this->last_error_type = 'DirTraversal' ;
			$this->message .= "Directory Traversal '$val' found.\n" ;
			$this->output_log( $this->last_error_type , 0 , false , 128 ) ;
			$sanitized_val = str_replace( chr(0) , '' , $val ) ;
			if( substr( $sanitized_val , -2 ) != ' .' ) $sanitized_val .= ' .' ;
			$_GET[ $key ] = $HTTP_GET_VARS[ $key ] = $sanitized_val ;
			if( $_REQUEST[ $key ] == $_GET[ $key ] ){
				$_REQUEST[ $key ] = $sanitized_val ;
			}
		}
	}
/*	foreach( $_POST as $key => $val ) {
		if( is_array( $_POST[ $key ] ) ) continue ;
		if( substr( trim( $val ) , 0 , 3 ) == '../' || strstr( $val , '../../' ) ) {
			$this->last_error_type = 'ParentDir' ;
			$this->message .= "Doubtful file specification '$val' found.\n" ;
			$this->output_log( $this->last_error_type , 0 , false , 128 ) ;
			$sanitized_val = str_replace( chr(0) , '' , $val ) ;
			if( substr( $sanitized_val , -2 ) != ' .' ) $sanitized_val .= ' .' ;
			$_POST[ $key ] = $HTTP_POST_VARS[ $key ] = $sanitized_val ;
			if( $_REQUEST[ $key ] == $_POST[ $key ] ){
				$_REQUEST[ $key ] = $sanitized_val ;
			}
		}
	}
	foreach( $_COOKIE as $key => $val ) {
		if( is_array( $_COOKIE[ $key ] ) ) continue ;
		if( substr( trim( $val ) , 0 , 3 ) == '../' || strstr( $val , '../../' ) ) {
			$this->last_error_type = 'ParentDir' ;
			$this->message .= "Doubtful file specification '$val' found.\n" ;
			$this->output_log( $this->last_error_type , 0 , false , 128 ) ;
			$sanitized_val = str_replace( chr(0) , '' , $val ) ;
			if( substr( $sanitized_val , -2 ) != ' .' ) $sanitized_val .= ' .' ;
			$_COOKIE[ $key ] = $HTTP_COOKIE_VARS[ $key ] = $sanitized_val ;
			if( $_REQUEST[ $key ] == $_COOKIE[ $key ] ){
				$_REQUEST[ $key ] = $sanitized_val ;
			}
		}
	}*/

	return true ;
}


function &get_ref_from_base64index( &$current , $indexes )
{
	foreach( $indexes as $index ) {
		$index = base64_decode( $index ) ;
		if( ! is_array( $current ) ) return false ;
		$current =& $current[ $index ] ;
	}
	return $current ;
}


function replace_doubtful( $key , $val )
{
	global $HTTP_GET_VARS , $HTTP_POST_VARS , $HTTP_COOKIE_VARS ;

	$index_expression = '' ;
	$indexes = explode( '_' , $key ) ;
	$base_array = array_shift( $indexes ) ;

	switch( $base_array ) {
		case 'G' :
			$main_ref =& $this->get_ref_from_base64index( $_GET , $indexes ) ;
			$legacy_ref =& $this->get_ref_from_base64index( $HTTP_GET_VARS , $indexes ) ;
			break ;
		case 'P' :
			$main_ref =& $this->get_ref_from_base64index( $_POST , $indexes ) ;
			$legacy_ref =& $this->get_ref_from_base64index( $HTTP_POST_VARS , $indexes ) ;
			break ;
		case 'C' :
			$main_ref =& $this->get_ref_from_base64index( $_COOKIE , $indexes ) ;
			$legacy_ref =& $this->get_ref_from_base64index( $HTTP_COOKIE_VARS , $indexes ) ;
			break ;
		default :
			exit ;
	}
	if( ! isset( $main_ref ) ) exit ;
	$request_ref =& $this->get_ref_from_base64index( $_REQUEST , $indexes ) ;
	if( $request_ref !== false && $main_ref == $request_ref ) {
		$request_ref = $val ;
	}
	$main_ref = $val ;
	$legacy_ref = $val ;
}


function check_uploaded_files()
{
	if( $this->_done_badext ) return $this->_safe_badext ;
	else $this->_done_badext = true ;

	$bad_pattern = "/(\.php|\.phtml|\.phtm|\.php3|\.php4|\.cgi|\.pl|\.asp)$/i" ;
	foreach( $_FILES as $_file ) {
		if( ! empty( $_file['name'] ) && is_string( $_file['name'] ) && preg_match( $bad_pattern , $_file['name'] ) ) {
			$this->message .= "Attempt to upload {$_file['name']}.\n" ;
			$this->_safe_badext = false ;
			$this->last_error_type = 'UPLOAD' ;
		}
	}

	return $this->_safe_badext ;
}


function check_contami_systemglobals()
{
/*	if( $this->_done_contami ) return $this->_safe_contami ;
	else $this->_done_contami = true ; */

/*	foreach( $this->_bad_globals as $bad_global ) {
		if( isset( $_REQUEST[ $bad_global ] ) ) {
			$this->message .= "Attempt to inject '$bad_global' was found.\n" ;
			$this->_safe_contami = false ;
			$this->last_error_type = 'CONTAMI' ;
		}
	}*/

	return $this->_safe_contami ;
}


function check_sql_isolatedcommentin( $sanitize = true )
{
	if( $this->_done_isocom ) return $this->_safe_isocom ;
	else $this->_done_isocom = true ;

	foreach( $this->_doubtful_requests as $key => $val ) {
		$str = $val ;
		while( $str = strstr( $str , '/*' ) ) { /* */
			$str = strstr( substr( $str , 2 ) , '*/' ) ;
			if( $str === false ) {
				$this->message .= "Isolated comment-in found. ($val)\n" ;
				if( $sanitize ) $this->replace_doubtful( $key , $val . '*/' ) ;
				$this->_safe_isocom = false ;
				$this->last_error_type = 'ISOCOM' ;
			}
		}
	}
	return $this->_safe_isocom ;
}


function check_sql_union( $sanitize = true )
{
	if( $this->_done_union ) return $this->_safe_union ;
	else $this->_done_union = true ;

	foreach( $this->_doubtful_requests as $key => $val ) {

		$str = str_replace( array( '/*' , '*/' ) , '' , preg_replace( '?/\*.+\*/?sU' , '' , $val ) ) ;
		if( preg_match( '/\sUNION\s+(ALL|SELECT)/i' , $str ) ) {
			$this->message .= "Pattern like SQL injection found. ($val)\n" ;
			if( $sanitize ) $this->replace_doubtful( $key , preg_replace( '/union/i' , 'uni-on' , $val ) ) ;
			$this->_safe_union = false ;
			$this->last_error_type = 'UNION' ;
		}
	}
	return $this->_safe_union ;
}


function check_dos_attack( $uid = 0 , $can_ban = false )
{
	global $xoopsDB ;

	if( $this->_done_dos ) return true ;

	$ip = $_SERVER['REMOTE_ADDR'] ;
	$uri = $_SERVER['REQUEST_URI'] ;
	$ip4sql = addslashes( $ip ) ;
	$uri4sql = addslashes( $uri ) ;
	if( empty( $ip ) || $ip == '' ) return true ;

	// gargage collection
	$result = $xoopsDB->queryF( "DELETE FROM ".$xoopsDB->prefix("protector_access")." WHERE expire < UNIX_TIMESTAMP()" ) ;

	// for older version before updated this module 
	if( $result === false ) {
		$this->_done_dos = true ;
		return true ;
	}

	// sql for recording access log (INSERT should be placed after SELECT)
	$sql4insertlog = "INSERT INTO ".$xoopsDB->prefix("protector_access")." SET ip='$ip4sql',request_uri='$uri4sql',expire=UNIX_TIMESTAMP()+'".intval($this->_conf['dos_expire'])."'" ;

	// F5 attack check (High load & same URI)
	$result = $xoopsDB->query( "SELECT COUNT(*) FROM ".$xoopsDB->prefix("protector_access")." WHERE ip='$ip4sql' AND request_uri='$uri4sql'" ) ;
	list( $f5_count ) = $xoopsDB->fetchRow( $result ) ;
	if( $f5_count > $this->_conf['dos_f5count'] ) {

		// delayed insert
		$xoopsDB->queryF( $sql4insertlog ) ;

		// extends the expires of the IP with 5 minutes at least (pending)
		// $result = $xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix("protector_access")." SET expire=UNIX_TIMESTAMP()+300 WHERE ip='$ip4sql' AND expire<UNIX_TIMESTAMP()+300" ) ;

		// actions for F5 Attack
		$this->_done_dos = true ;
		$this->last_error_type = 'DoS' ;
		switch( $this->_conf['dos_f5action'] ) {
			default :
			case 'exit' :
				$this->output_log( $this->last_error_type , $uid , true , 16 ) ;
				exit ;
			case 'bip' :
				if( $can_ban ) $this->register_bad_ips() ;
				break ;
			case 'hta' :
				if( $can_ban ) $this->deny_by_htaccess() ;
				break ;
			case 'sleep' :
				sleep( 5 ) ;
				break ;
		}
		return false ;
	}

	// Check its Agent
	if( preg_match( $this->_conf['dos_crsafe'] , $_SERVER['HTTP_USER_AGENT'] ) ) {
		// welcomed crawler
		$this->_done_dos = true ;
		return true ;
	}

	// Crawler check (High load & different URI)
	$result = $xoopsDB->query( "SELECT COUNT(*) FROM ".$xoopsDB->prefix("protector_access")." WHERE ip='$ip4sql'" ) ;
	list( $crawler_count ) = $xoopsDB->fetchRow( $result ) ;

	// delayed insert
	$xoopsDB->queryF( $sql4insertlog ) ;

	if( $crawler_count > $this->_conf['dos_crcount'] ) {

		// actions for bad Crawler
		$this->_done_dos = true ;
		$this->last_error_type = 'CRAWLER' ;
		switch( $this->_conf['dos_craction'] ) {
			default :
			case 'exit' :
				$this->output_log( $this->last_error_type , $uid , true , 16 ) ;
				exit ;
			case 'bip' :
				if( $can_ban ) $this->register_bad_ips() ;
				break ;
			case 'hta' :
				if( $can_ban ) $this->deny_by_htaccess() ;
				break ;
			case 'sleep' :
				sleep( 5 ) ;
				break ;
		}
		return false ;
	}

	return true ;
}


/* function check_dos_attack_prepare()
{
	$ip = $_SERVER['REMOTE_ADDR'] ;
	$uri = $_SERVER['REQUEST_URI'] ;
	$ip4sql = addslashes( $ip ) ;
	$uri4sql = addslashes( $uri ) ;
	if( empty( $ip ) || $ip == '' ) return true ;

	$result = mysql_query( "DELETE FROM ".XOOPS_DB_PREFIX."_protector_access WHERE expire < UNIX_TIMESTAMP()" , $this->_conn ) ;

	// for older version before updated this module 
	if( $result === false ) {
		$this->_done_dos = true ;
		return true ;
	}

	// record access log
	mysql_query( "INSERT INTO ".XOOPS_DB_PREFIX."_protector_access SET ip='$ip4sql',request_uri='$uri4sql',expire=UNIX_TIMESTAMP()+'".intval($this->_conf['dos_expire'])."'" , $this->_conn ) ;

	// F5 attack check (High load & same URI)
	$result = mysql_query( "SELECT COUNT(*) FROM ".XOOPS_DB_PREFIX."_protector_access WHERE ip='$ip4sql' AND request_uri='$uri4sql'" , $this->_conn ) ;
	$f5_count = mysql_result( $result , 0 , 0 ) ;
	if( $f5_count > $this->_conf['dos_f5count'] ) {

		// extends the expires of the IP with 5 minutes at least
		$result = mysql_query( "UPDATE ".XOOPS_DB_PREFIX."_protector_access SET expire=UNIX_TIMESTAMP()+300 WHERE ip='$ip4sql' AND expire<UNIX_TIMESTAMP()+300" , $this->_conn ) ;

		// actions for F5 Attack
		$this->_done_dos = true ;
		$this->last_error_type = 'DoS' ;
		switch( $this->_conf['dos_f5action'] ) {
			case 'exit' :
				$this->output_log( $this->last_error_type , 0 , true ) ;
				exit ;
			case 'bip' :
				sleep( 5 ) ; // only the lowest protection here
				$this->_should_be_banned = true ;
				break ;
			case 'sleep' :
				sleep( 5 ) ;
				break ;
		}
		return false ;
	}

	// Check its Agent
	if( preg_match( $this->_conf['dos_crsafe'] , $_SERVER['HTTP_USER_AGENT'] ) ) {
		// welcomed crawler
		$this->_done_dos = true ;
		return true ;
	}

	// Crawler check (High load & different URI)
	$result = mysql_query( "SELECT COUNT(*) FROM ".XOOPS_DB_PREFIX."_protector_access WHERE ip='$ip4sql'" , $this->_conn ) ;
	$crawler_count = mysql_result( $result , 0 , 0 ) ;
	if( $crawler_count > $this->_conf['dos_crcount'] ) {

		// actions for bad Crawler
		$this->_done_dos = true ;
		$this->last_error_type = 'CRAWLER' ;
		switch( $this->_conf['dos_craction'] ) {
			case 'exit' :
				$this->output_log( $this->last_error_type , 0 , true ) ;
				exit ;
			case 'bip' :
				sleep( 5 ) ; // only the lowest protection here
				$this->_should_be_banned = true ;
				break ;
			case 'sleep' :
				sleep( 5 ) ;
				break ;
		}
		return false ;

	}

	$this->_done_dos = true ;
	return true ;
} */


// 
function check_brute_force()
{
	global $xoopsDB ;

	$ip = $_SERVER['REMOTE_ADDR'] ;
	$uri = $_SERVER['REQUEST_URI'] ;
	$ip4sql = addslashes( $ip ) ;
	$uri4sql = addslashes( $uri ) ;
	if( empty( $ip ) || $ip == '' ) return true ;

	$victim_uname = empty( $_COOKIE['autologin_uname'] ) ? $_POST['uname'] : $_COOKIE['autologin_uname'] ;
	$mal4sql = addslashes( "BRUTE FORCE: $victim_uname" ) ;

	// gargage collection
	$result = $xoopsDB->queryF( "DELETE FROM ".$xoopsDB->prefix("protector_access")." WHERE expire < UNIX_TIMESTAMP()" ) ;

	// sql for recording access log (INSERT should be placed after SELECT)
	$sql4insertlog = "INSERT INTO ".$xoopsDB->prefix("protector_access")." SET ip='$ip4sql',request_uri='$uri4sql',malicious_actions='$mal4sql',expire=UNIX_TIMESTAMP()+600" ;

	// count check
	$result = $xoopsDB->query( "SELECT COUNT(*) FROM ".$xoopsDB->prefix("protector_access")." WHERE ip='$ip4sql' AND malicious_actions like 'BRUTE FORCE:%'" ) ;
	list( $bf_count ) = $xoopsDB->fetchRow( $result ) ;
	if( $bf_count > $this->_conf['bf_count'] ) {
		$this->register_bad_ips() ;
		$this->last_error_type = 'BruteForce' ;
		$this->message .= "Trying to login as '".addslashes($victim_uname)."' found.\n" ;
		$this->output_log( 'BRUTE FORCE' , 0 , true ) ;
		exit ;
	}
	// delayed insert
	$xoopsDB->queryF( $sql4insertlog ) ;
}



function disable_features()
{
	global $HTTP_POST_VARS , $HTTP_GET_VARS , $HTTP_COOKIE_VARS ;


	// disable "Notice: Undefined index: ..."
	$error_reporting_level = error_reporting( 0 ) ;


	//
	// bit 1 : disable XMLRPC , criteria bug
	//
	if( $this->_conf['disable_features'] & 1 ) {

		// zx 2005/1/5 disable xmlrpc.php in root
		if( ! stristr( $_SERVER['SCRIPT_NAME'] , 'modules' ) && substr( $_SERVER['SCRIPT_NAME'] , -10 ) == 'xmlrpc.php' ) {
			$this->output_log( 'xmlrpc' ) ;
			exit ;
		}

		// security bug of class/criteria.php 2005/6/27
		if( $_POST['uname'] === '0' || $_COOKIE['autologin_pass'] === '0' ) {
			$this->output_log( 'CRITERIA' ) ;
			exit ;
		}
	}


	//
	// bit 11 : XSS+CSRFs in XOOPS < 2.0.10
	//
	if( $this->_conf['disable_features'] & 1024 ) {

		// root controllers
		if( ! stristr( $_SERVER['SCRIPT_NAME'] , 'modules' ) ) {
			// zx 2004/12/13 misc.php debug (file check)
			if( substr( $_SERVER['SCRIPT_NAME'] , -8 ) == 'misc.php' && ( $_GET['type'] == 'debug' || $_POST['type'] == 'debug' ) && ! preg_match( '/^dummy_[0-9]+\.html$/' , $_GET['file'] ) ) {
				$this->output_log( 'misc debug' ) ;
				exit ;
			}
		
			// zx 2004/12/13 misc.php smilies
			if( substr( $_SERVER['SCRIPT_NAME'] , -8 ) == 'misc.php' && ( $_GET['type'] == 'smilies' || $_POST['type'] == 'smilies' ) && ! preg_match( '/^[0-9a-z_]*$/i' , $_GET['target'] ) ) {
				$this->output_log( 'misc smilies' ) ;
				exit ;
			}
		
			// zx 2005/1/5 edituser.php avatarchoose
			if( substr( $_SERVER['SCRIPT_NAME'] , -12 ) == 'edituser.php' && $_POST['op'] == 'avatarchoose' && strstr( $_POST['user_avatar'] , '..' ) ) {
				$this->output_log( 'edituser avatarchoose' ) ;
				exit ;
			}
		}
	
		// zx 2005/1/4 findusers
		if( substr( $_SERVER['SCRIPT_NAME'] , -24 ) == 'modules/system/admin.php' && ( $_GET['fct'] == 'findusers' || $_POST['fct'] == 'findusers' ) ) {
			foreach( $_POST as $key => $val ) {
				if( strstr( $key , "'" ) || strstr( $val , "'" ) ) {
					$this->output_log( 'findusers' ) ;
					exit ;
				}
			}
		}
	
		// preview CSRF zx 2004/12/14 
		// news submit.php
		if( substr( $_SERVER['SCRIPT_NAME'] , -23 ) == 'modules/news/submit.php' && isset( $_POST['preview'] ) && strpos( $_SERVER['HTTP_REFERER'] , XOOPS_URL.'/modules/news/submit.php' ) !== 0 ) {
			$HTTP_POST_VARS['nohtml'] = $_POST['nohtml'] = 1 ;
		}
		// news admin/index.php
		if( substr( $_SERVER['SCRIPT_NAME'] , -28 ) == 'modules/news/admin/index.php' && ( $_POST['op'] == 'preview' || $_GET['op'] == 'preview' ) && strpos( $_SERVER['HTTP_REFERER'] , XOOPS_URL.'/modules/news/admin/index.php' ) !== 0 ) {
			$HTTP_POST_VARS['nohtml'] = $_POST['nohtml'] = 1 ;
		}
		// comment comment_post.php
		if( isset( $_POST['com_dopreview'] ) && ! strstr( substr( $_SERVER['HTTP_REFERER'] , -16 ) , 'comment_post.php' ) ) {
			$HTTP_POST_VARS['dohtml'] = $_POST['dohtml'] = 0 ;
		}
		// disable preview of system's blocksadmin
		if( substr( $_SERVER['SCRIPT_NAME'] , -24 ) == 'modules/system/admin.php' && ( $_GET['fct'] == 'blocksadmin' || $_POST['fct'] == 'blocksadmin') && isset( $_POST['previewblock'] ) /* && strpos( $_SERVER['HTTP_REFERER'] , XOOPS_URL.'/modules/system/admin.php' ) !== 0 */ ) {
			die( "Danger! don't use this preview. Use 'blocks admin module' instead.(by Protector)" ) ;
		}
		// tpl preview
		if( substr( $_SERVER['SCRIPT_NAME'] , -24 ) == 'modules/system/admin.php' && ( $_GET['fct'] == 'tplsets' || $_POST['fct'] == 'tplsets') ) {
			if( $_POST['op'] == 'previewpopup' || $_GET['op'] == 'previewpopup' || isset( $_POST['previewtpl'] ) ) {
				die( "Danger! don't use this preview.(by Protector)" ) ;
			}
		}

	}


	// restore reporting level
	error_reporting( $error_reporting_level ) ;
}


}
?>