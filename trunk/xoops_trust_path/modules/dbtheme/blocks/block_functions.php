<?php

function b_dbtheme_theme_hook_show( $options )
{
	$mydirname = empty( $options[0] ) ? 'dbtheme' : $options[0] ;
	$tpl_name = empty( $options[1] ) ? $mydirname.'_theme.html' : $options[1] ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;
	$tpl_name = preg_replace( '/[^0-9a-zA-Z_.-]/' , '' , $tpl_name ) ;

	/* if( ! file_exists( XOOPS_ROOT_PATH.'/class/smarty/plugins/resource.dbtheme.php' ) ) {
		$ret = array( 'content' => 'resource.dbtheme.php is not set properly' ) ;
		return $ret ;
	} */

	if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		// Cube Legacy
		@define( 'DBTHEME_THEME_NAME' , $tpl_name ) ;
		@define( 'DBTHEME_MYDIRNAME' , $mydirname ) ;

	} else {
		// X2.0.x
		$module_handler =& xoops_gethandler( 'module' ) ;
		$module =& $module_handler->getByDirname( $mydirname ) ;
		$config_handler =& xoops_gethandler( 'config' ) ;
		$mod_config =& $config_handler->getConfigsByCat( 0 , $module->getVar( 'mid' ) ) ;

		if( ! empty( $mod_config['base_theme'] ) ) {
			$GLOBALS['xoopsTpl']->assign( array(
				'xoops_theme' => $mod_config['base_theme'] ,
				'xoops_imageurl' => XOOPS_THEME_URL.'/'.$mod_config['base_theme'].'/' ,
				'xoops_themecss' => XOOPS_URL.'/modules/'.$mydirname.'/?template=style.css' , // TODO (?)
				'xoops_dbthemecssurl' => XOOPS_URL.'/modules/'.$mydirname.'/?template=' ,
			) ) ;
		}

		$obj_serialized = serialize( $GLOBALS['xoopsTpl'] ) ;
		unset( $GLOBALS['xoopsTpl'] ) ;
		$obj_serialized = preg_replace( '/xoopstpl/i' , 'dbthmtpl' , substr( $obj_serialized , 0 , 20 ) ) . substr( $obj_serialized , 20 ) ;
		//var_dump( $obj_serialized ) ;
		$GLOBALS['xoopsTpl'] = unserialize( $obj_serialized ) ;
		//var_dump( get_class( $GLOBALS['xoopsTpl'] ) ) ;

		$GLOBALS['xoopsConfig']['theme_set'] = 'dbtheme:'.$tpl_name."\n" ;
		return array() ;
	}
}


class dbthmtpl extends XoopsTpl {

	function display($resource_name, $cache_id = null, $compile_id = null)
	{
		if( substr( $resource_name , 0 , 8 ) == 'dbtheme:' ) {
			$resource_name = 'db:' . substr( $resource_name , 8 , strpos( $resource_name , "\n" ) - 8 ) ;
		}
		parent::display($resource_name, $cache_id, $compile_id);
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