<?php

define( 'PROTECTOR_POSTCHECK_INCLUDED' , 1 ) ;

if( class_exists( 'Database' ) ) protector_postcommon() ;
else if( !isset($xoopsOption['nocommon']) ) die( 'Protector: postcheck.inc.php should be included just after common.php' ) ;

function protector_postcommon()
{
	global $xoopsUser , $xoopsModule ;

	// Protector class
	require_once dirname(dirname(__FILE__)).'/class/protector.php' ;
	$db =& Database::getInstance() ;
	$protector =& Protector::getInstance( $db->conn ) ;
	$conf = $protector->getConf() ;

	// global enabled or disabled
	if( ! empty( $conf['global_disabled'] ) ) return true ;

	// group1_ips (groupid=1)
	if( is_object( $xoopsUser ) && in_array( 1 , $xoopsUser->getGroups() ) ) {
		$group1_ips = Protector::get_group1_ips() ;
		if( implode( '' , $group1_ips ) ) {
			foreach( $group1_ips as $group1_ip ) {
				if( $group1_ip && substr( @$_SERVER['REMOTE_ADDR'] , 0 , strlen( $group1_ip ) ) == $group1_ip ) $group1_allow = 1 ;
			}
			if( empty( $group1_allow ) ) die( 'This account is disabled for your IP by Protector' ) ;
		}
	}

	// reliable ips
	$reliable_ips = unserialize( $conf['reliable_ips'] ) ;
	foreach( $reliable_ips as $reliable_ip ) {
		if( ! empty( $reliable_ip ) && preg_match( '/'.$reliable_ip.'/' , $_SERVER['REMOTE_ADDR'] ) ) {
			return true ;
		}
	}

	// user information (uid and can be banned)
	if( is_object( @$xoopsUser ) ) {
		$uid = $xoopsUser->getVar('uid') ;
		$can_ban = count( array_intersect( $xoopsUser->getGroups() , unserialize( $conf['bip_except'] ) ) ) ? false : true ;
	} else {
		// login failed check
		if( ( ! empty( $_POST['uname'] ) && ! empty( $_POST['pass'] ) ) || ( ! empty( $_COOKIE['autologin_uname'] ) && ! empty( $_COOKIE['autologin_pass'] ) ) ) {
			$protector->check_brute_force() ;
		}
		$uid = 0 ;
		$can_ban = true ;
	}

	// If precheck has already judged that he should be banned
	if( $can_ban && $protector->_should_be_banned ) {
		$protector->register_bad_ips() ;
	}

	// DOS/CRAWLER skipping based on 'dirname' or getcwd()
	$skip_dirnames = explode( '|' , $conf['dos_skipmodules'] ) ;
	if( ! is_array( $skip_dirnames ) ) $skip_dirnames = array() ;
	if( is_object( @$xoopsModule ) ) {
		if( in_array( $xoopsModule->getVar('dirname') , $skip_dirnames ) ) {
			$dos_skipping = true ;
		}
	} else {
		foreach( $skip_dirnames as $skip_dirname ) {
			if( $skip_dirname && strstr( getcwd() , $skip_dirname ) ) {
				$dos_skipping = true ;
				break ;
			}
		}
	}

	// DoS Attack
	if( empty( $dos_skipping ) && ! $protector->check_dos_attack( $uid , $can_ban ) ) {
		$protector->output_log( $protector->last_error_type , $uid , true , 16 ) ;
	}


	// check session hi-jacking
	$ips = explode( '.' ,  @$_SESSION['protector_last_ip'] ) ;
	$protector_last_numip = @$ips[0] * 0x1000000 + @$ips[1] * 0x10000 + @$ips[2] * 0x100 + @$ips[3] ;
	$ips = explode( '.' ,  $_SERVER['REMOTE_ADDR'] ) ;
	$remote_numip = @$ips[0] * 0x1000000 + @$ips[1] * 0x10000 + @$ips[2] * 0x100 + @$ips[3] ;
	$shift = 32 - @$conf['session_fixed_topbit'] ;
	if( $shift < 32 && $shift >= 0 && ! empty( $_SESSION['protector_last_ip'] ) && $protector_last_numip >> $shift != $remote_numip >> $shift ) {
		if( is_object( $xoopsUser ) && count( array_intersect( $xoopsUser->getGroups() , unserialize( $conf['groups_denyipmove'] ) ) ) ) {
			$protector->purge( true ) ;
		}
	}
	$_SESSION['protector_last_ip'] = $_SERVER['REMOTE_ADDR'] ;

	// SQL Injection "Isolated /*"
	if( ! $protector->check_sql_isolatedcommentin( $conf['isocom_action'] & 1 ) ) {
		if( ( $conf['isocom_action'] & 4 ) && $can_ban ) $protector->register_bad_ips() ;
		$protector->output_log( 'ISOCOM' , $uid , 64 ) ;
		if( $conf['isocom_action'] & 2 ) $protector->purge() ;
	}

	// SQL Injection "UNION"
	if( ! $protector->check_sql_union( $conf['union_action'] & 1 ) ) {
		if( ( $conf['union_action'] & 4 ) && $can_ban ) $protector->register_bad_ips() ;
		$protector->output_log( 'UNION' , $uid , 64 ) ;
		if( $conf['union_action'] & 2 ) $protector->purge() ;
	}

	if( ! empty( $_POST ) ) {
		// SPAM Check
		if( is_object( $xoopsUser ) ) {
			if( ! $xoopsUser->isAdmin() && $conf['spamcount_uri4user'] ) {
				$protector->spam_check( intval( $conf['spamcount_uri4user'] ) , $xoopsUser->getVar('uid') ) ;
			}
		} else if( $conf['spamcount_uri4guest'] ) {

			$protector->spam_check( intval( $conf['spamcount_uri4guest'] ) , 0 ) ;
		}

		// filter plugins for POST on postcommon stage
		$filters_base = XOOPS_TRUST_PATH.'/modules/protector/filters_enabled' ;
		$dh = opendir( $filters_base ) ;
		while( ( $file = readdir( $dh ) ) !== false ) {
			if( substr( $file , 0 , 16 ) == 'postcommon_post_' ) {
				@include_once $filters_base.'/'.$file ;
				if( function_exists( 'protector_'.substr($file,0,-4) ) ) {
					call_user_func( 'protector_'.substr($file,0,-4) ) ;
				}
			}
		}
		closedir( $dh ) ;
	}
}

?>