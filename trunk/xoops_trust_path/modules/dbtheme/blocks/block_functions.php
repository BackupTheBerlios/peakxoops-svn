<?php

function b_dbtheme_theme_hook_show( $options )
{
	global $xoopsConfig ;

	$mydirname = empty( $options[0] ) ? 'dbtheme' : $options[0] ;
	$tpl_name = empty( $options[1] ) ? $mydirname.'_theme.html' : $options[1] ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;
	$tpl_name = preg_replace( '/[^0-9a-zA-Z_.-]/' , '' , $tpl_name ) ;

	if( ! file_exists( XOOPS_ROOT_PATH.'/class/smarty/plugins/resource.dbtheme.php' ) ) {
		$ret = array( 'content' => 'resource.dbtheme.php is not set properly' ) ;
		return $ret ;
	}

	if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		@define( 'DBTHEME_THEME_NAME' , $tpl_name ) ;
	} else {
		$xoopsConfig['theme_set'] = 'dbtheme:'.$tpl_name ;
		return array() ;
	}
}


function b_dbtheme_theme_hook_edit( $options )
{
	$mydirname = empty( $options[0] ) ? 'dbtheme' : $options[0] ;
	$tpl_name = empty( $options[1] ) ? $mydirname.'_theme.html' : $options[1] ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;
	$tpl_name = preg_replace( '/[^0-9a-zA-Z_.-]/' , '' , $tpl_name ) ;

	$form = "
		<input type='hidden' name='options[0]' value='$mydirname' />
		<label for='tpl_name'>"._MB_DBTHEME_TPL_NAME."</label>&nbsp;:
		<input type='text' size='30' name='options[1]' id='tpl_name' value='".htmlspecialchars($tpl_name,ENT_QUOTES)."' />
		<br />
	\n" ;

	return $form;
}

?>