<?php

function d3pipes_admin_fetch_joints( $mydirname )
{
	$ret = array() ;

	$joints_base = XOOPS_TRUST_PATH.'/modules/d3pipes/joints' ;

	if( $handler = @opendir( $joints_base ) ) {
		while( ( $dir = readdir( $handler ) ) !== false ) {
			if( substr( $dir , 0 , 1 ) == '.' ) continue ;
			$dir = preg_replace( '/[^0-9a-zA-Z_]/' , '' , $dir ) ;
			if( ! is_dir( $joints_base . '/' . $dir ) ) continue ;
			$lang_joint = defined( '_MD_D3PIPES_JOINT_'.strtoupper($dir) ) ? constant( '_MD_D3PIPES_JOINT_'.strtoupper($dir) ) : $dir ;
			$ret[ $dir ] = $lang_joint ;
		}
	}
	ksort( $ret ) ;

	return $ret ;
}


function d3pipes_admin_fetch_classes( $mydirname , $joint_type )
{
	$classes_base = XOOPS_TRUST_PATH.'/modules/d3pipes/joints/'.$joint_type ;

	$ret = array() ;

	if( $handler = @opendir( $classes_base ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 1 ) == '.' ) continue ;
			$file = str_replace( '..' , '' , $file ) ;
			if( ! file_exists( $classes_base . '/' . $file ) ) continue ;
			$joint_class = strtolower( substr( $file , strlen( 'D3pipes'.$joint_type ) , - strlen( '.class.php' ) ) ) ;
			$ret[ $joint_class ] = $joint_class ;
		}
	}

	return $ret ;
}


function d3pipes_admin_get_notice4joint( $mydirname , $all_joints )
{
	$joint_notices = array() ;
	foreach( array_keys( $all_joints ) as $joint ) {
		$joint_notices[ $joint ] = defined( '_MD_D3PIPES_N4J_'.strtoupper($joint) ) ? constant( '_MD_D3PIPES_N4J_'.strtoupper($joint) ) : '' ;
	}

	return $joint_notices ;
}

?>