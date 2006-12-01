<?php

// a class for d3forum comment integration
class PicoD3commentContent extends D3commentAbstract {

function fetchSummary( $external_link_id )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextsanitizer::getInstance() ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( $this->mydirname ) ;

	$content_id = intval( $external_link_id ) ;
	$mydirname = $this->mydirname ;
	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	// query
	$content_row = $db->fetchArray( $db->query( "SELECT * FROM ".$db->prefix($mydirname."_contents")." WHERE content_id=$content_id" ) ) ;

	return array(
		'dirname' => $mydirname ,
		'module_name' => $module->getVar( 'name' ) ,
		'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
		'uri' => XOOPS_URL.'/modules/'.$mydirname.'/index.php?content_id='.$content_id ,
		'summary' => xoops_substr( strip_tags( $content_row['body_cached'] ) , 0 , 255 ) ,
	) ;
}


}

?>