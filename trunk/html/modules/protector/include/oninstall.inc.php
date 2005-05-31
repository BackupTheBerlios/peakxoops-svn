<?php

function xoops_module_install_protector( $module )
{
	global $xoopsConfig , $xoopsDB ;

	if( $xoopsConfig['enable_badips'] ) return true ;
	if( isset( $_SERVER['REMOTE_ADDR'] ) && $_SERVER['REMOTE_ADDR'] != '' && is_array( $xoopsConfig['bad_ips'] ) ) {
		foreach( $xoopsConfig['bad_ips'] as $bi ) {
			if( ! empty( $bi ) && preg_match( "/$bi/" , $_SERVER['REMOTE_ADDR'] ) ) {
				return false ;
			}
		}
	}

	$xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix("config")." SET conf_value=1 WHERE conf_name='enable_badips' AND conf_modid=0 AND conf_catid=1" ) ;
	return true ;
}


?>
