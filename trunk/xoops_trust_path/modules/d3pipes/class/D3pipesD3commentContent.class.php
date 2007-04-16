<?php

require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;

// a class for d3forum comment integration
class D3pipesD3commentContent extends D3commentAbstract {

function fetchSummary( $external_link_id )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextsanitizer::getInstance() ;

	$mydirname = $this->mydirname ;
	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( $mydirname ) ;
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	$clipping_id = intval( $external_link_id ) ;
	$clipping = d3pipes_common_get_clipping( $mydirname , $clipping_id ) ;
	if( $clipping === false ) return array() ;

	return array(
		'dirname' => $mydirname ,
		'module_name' => $module->getVar( 'name' ) ,
		'subject' => $myts->makeTboxData4Show( $clipping['headline'] ) ,
		'uri' => XOOPS_URL.'/modules/'.$mydirname.'/index.php?page=clipping&amp;clipping_id='.$clipping_id ,
		'summary' => htmlspecialchars( @$clipping['link'] , ENT_QUOTES ) ,
	) ;
}


}

?>