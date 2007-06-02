<?php

define( 'PROTECTOR_PRECHECK_INCLUDED' , 1 ) ;

if( class_exists( 'Database' ) ) die( 'Protector: precheck.inc.php should be included just before common.php' ) ;

// set $_SERVER['REQUEST_URI'] for IIS
if ( empty( $_SERVER[ 'REQUEST_URI' ] ) ) {		 // Not defined by IIS
	// Under some configs, IIS makes SCRIPT_NAME point to php.exe :-(
	if ( !( $_SERVER[ 'REQUEST_URI' ] = @$_SERVER['PHP_SELF'] ) ) {
		$_SERVER[ 'REQUEST_URI' ] = $_SERVER['SCRIPT_NAME'];
	}
	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {
		$_SERVER[ 'REQUEST_URI' ] .= '?' . $_SERVER[ 'QUERY_STRING' ];
	}
}

protector_prepare() ;

function protector_prepare()
{
	// check the access is from install/index.php
	if( defined( '_INSTALL_CHARSET' ) ) die( 'To use installer, remove protector\'s lines from mainfile.php first.' ) ;

	// Protector class
	require_once dirname(dirname(__FILE__)).'/class/protector.php' ;

	// bad_ips
	$bad_ips = Protector::get_bad_ips() ;
	foreach( $bad_ips as $bad_ip ) {
		if( $bad_ip && substr( @$_SERVER['REMOTE_ADDR'] , 0 , strlen( $bad_ip ) ) == $bad_ip ) {
			die( 'You are registered as BAD_IP by Protector.' ) ;
		}
	}

	// Preferences (for performance, I dare to use an irregular method)
	$conn = @mysql_connect( XOOPS_DB_HOST , XOOPS_DB_USER , XOOPS_DB_PASS ) ;
	if( ! $conn ) die( 'db connection failed.' ) ;
	if( ! mysql_select_db( XOOPS_DB_NAME , $conn ) ) die( 'db selection failed.' ) ;

	// Protector object
	$protector =& Protector::getInstance( $conn ) ;
	$conf = $protector->getConf() ;

	// global enabled or disabled
	if( ! empty( $conf['global_disabled'] ) ) return true ;

	// reliable ips
	$conf['reliable_ips'] = 'a:1:{i:0;s:0:\"\";}';
	$reliable_ips = @unserialize( $conf['reliable_ips'] ) ;
	if( ! is_array( $reliable_ips ) ) {
		// for the environment of (buggy core version && magic_quotes_gpc)
		$reliable_ips = @unserialize( stripslashes( $conf['reliable_ips'] ) ) ;
		if( ! is_array( $reliable_ips ) ) $reliable_ips = array() ;
	}
	$is_reliable = false ;
	foreach( $reliable_ips as $reliable_ip ) {
		if( ! empty( $reliable_ip ) && preg_match( '/'.$reliable_ip.'/' , $_SERVER['REMOTE_ADDR'] ) ) {
			$is_reliable = true ;
		}
	}

	// "Big Umbrella" subset version
	if( ! empty( $conf['enable_bigumbrella'] ) ) $protector->bigumbrella_init() ;

	// force intval variables whose name is *id
	if( ! empty( $conf['id_forceintval'] ) ) $protector->intval_allrequestsendid() ;

	// eliminate '..' from requests looks like file specifications
	if( ! $is_reliable && ! empty( $conf['file_dotdot'] ) ) $protector->eliminate_dotdot() ;

	// Check uploaded files
	if( ! $is_reliable && ! empty( $_FILES ) && ! empty( $conf['die_badext'] ) && ! defined( 'PROTECTOR_SKIP_FILESCHECKER' ) && ! $protector->check_uploaded_files() ) {
		$protector->output_log( $protector->last_error_type ) ;
		$protector->purge() ;
	}

	// Variables contamination
	if( ! $protector->check_contami_systemglobals() ) {
		if( ( $conf['contami_action'] & 4 ) ) {
			$protector->_should_be_banned = true ;
			$_GET = $_POST = array() ;
		}
		$protector->output_log( $protector->last_error_type ) ;
		if( $conf['contami_action'] & 2 ) $protector->purge() ;
	}

	// prepare for DoS
	//if( ! $protector->check_dos_attack_prepare() ) {
	//	$protector->output_log( $protector->last_error_type , 0 , true ) ;
	//}

	if( ! empty( $conf['disable_features'] ) ) $protector->disable_features() ;

}

?>