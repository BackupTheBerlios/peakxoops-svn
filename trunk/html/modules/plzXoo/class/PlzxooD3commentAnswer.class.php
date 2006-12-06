<?php

// a class for d3forum comment integration
class PlzxooD3commentAnswer extends D3commentAbstract {

function fetchSummary( $external_link_id )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextsanitizer::getInstance() ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( $this->mydirname ) ;

	$aid = intval( $external_link_id ) ;
	$mydirname = $this->mydirname ;
	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	// query
	$myrow = $db->fetchArray( $db->query( "SELECT a.body,q.subject,q.qid FROM ".$db->prefix("plzxoo_answer")." a LEFT JOIN ".$db->prefix("plzxoo_question")." q ON a.qid=q.qid WHERE aid=$aid" ) ) ;

	return array(
		'dirname' => $mydirname ,
		'module_name' => $module->getVar( 'name' ) ,
		'subject' => $myts->makeTboxData4Show( $myrow['subject'] ) ,
		'uri' => XOOPS_URL.'/modules/'.$mydirname.'/index.php?action=detail&amp;qid='.intval($myrow['qid']) ,
		'summary' => htmlspecialchars( xoops_substr( strip_tags( $myrow['body'] ) , 0 , 255 ) , ENT_QUOTES ) ,
	) ;
}


}

?>