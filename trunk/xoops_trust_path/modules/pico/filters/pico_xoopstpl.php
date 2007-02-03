<?php

define('_MD_PICO_FILTERS_XOOPSTPLINITWEIGHT',0);
define('_MD_PICO_FILTERS_XOOPSTPLISINSECURE',1); // only admins/moderators can use it

include_once XOOPS_ROOT_PATH.'/class/template.php' ;

function pico_xoopstpl( $mydirname , $text , $content_row )
{
	global $xoopsTpl ;

	$tpl =& new XoopsTpl() ;

	if( is_object( @$xoopsTpl ) ) {
		$tpl->assign( $xoopsTpl->get_template_vars() ) ;
	}

	$temp_file = XOOPS_COMPILE_PATH.'/'.substr(md5(XOOPS_DB_PREFIX.$content_row['content_id']),16).$mydirname.'_temp_resource' ;
	if( ! $text || $text != @file_get_contents( $temp_file ) ) {
		$fw = fopen( $temp_file , 'wb' ) ;
		fwrite( $fw , $text ) ;
		fclose( $fw ) ;
		$tpl->clear_compiled_tpl( 'file:'.$temp_file ) ;
	}
	$text = $tpl->fetch( 'file:'.$temp_file ) ;
//	unlink( $temp_file ) ;

	return $text ;
}

?>