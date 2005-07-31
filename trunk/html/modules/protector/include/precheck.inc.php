<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

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
	// Preferences (for performance, I dare to use an irregular method)
	$conn = @mysql_connect( XOOPS_DB_HOST , XOOPS_DB_USER , XOOPS_DB_PASS ) ;
	mysql_select_db( XOOPS_DB_NAME , $conn ) ;

	// Protector class
	require_once( XOOPS_ROOT_PATH . '/modules/protector/class/protector.php' ) ;
	$protector =& Protector::getInstance( $conn ) ;
	$conf = $protector->getConf() ;

	// petit-encrypt password for disabling bad_ips
	// I know this method is not a good way :-)
	if( substr( $conf['passwd_disabling_bip'] , 0 , 3 ) != '*=*' ) {
		$encrypted_password4sql = addslashes( '*=*' . md5( $conf['passwd_disabling_bip'] . XOOPS_DB_PREFIX ) ) ;
		mysql_query( "UPDATE ".XOOPS_DB_PREFIX."_config SET conf_value='$encrypted_password4sql' WHERE conf_title='_MI_PROTECTOR_PASSWD_BIP' AND conf_name='passwd_disabling_bip'" , $conn ) ;
	}

	// global enabled or disabled
	if( ! empty( $conf['global_disabled'] ) ) return true ;

	// reliable ips
	$reliable_ips = unserialize( $conf['reliable_ips'] ) ;
	$is_reliable = false ;
	foreach( $reliable_ips as $reliable_ip ) {
		if( ! empty( $reliable_ip ) && preg_match( '/'.$reliable_ip.'/' , $_SERVER['REMOTE_ADDR'] ) ) {
			$is_reliable = true ;
		}
	}

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
