<?php

/* tplsadmin compiled cache hookings */

// save assigned variables for the template
function tplsadmin_save_tplsvars( $file , $smarty )
{
	if( strncmp( $file , 'db:' , 3 ) === 0 ) {
		if( $fw = @fopen( XOOPS_COMPILE_PATH.'/tplsvars_'.substr( $file , 3 ) , 'x' ) ) {
			fwrite( $fw , serialize( $smarty->_tpl_vars ) ) ;
			fclose( $fw ) ;
			return true ;
		}
	}
	return false ;
}




?>