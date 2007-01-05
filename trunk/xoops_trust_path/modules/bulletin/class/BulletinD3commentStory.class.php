<?php

// a class for d3forum comment integration
class BulletinD3commentStory extends D3commentAbstract {

function fetchSummary( $external_link_id )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextsanitizer::getInstance() ;

	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( $this->mydirname ) ;

	$storyid = intval( $external_link_id ) ;
	$mydirname = $this->mydirname ;
	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$mytrustdirpath = dirname(dirname(__FILE__)) ;
	require_once $mytrustdirpath.'/class/bulletin.php' ;

	if( Bulletin::isPublishedExists( $storyid ) ){

		$article = new Bulletin( $storyid ) ;
		return array(
			'dirname' => $mydirname ,
			'module_name' => $module->getVar( 'name' ) ,
			'subject' => $article->getVar( 'title' ) ,
			'uri' => XOOPS_URL.'/modules/'.$mydirname.'/index.php?page=article&amp;storyid='.$storyid ,
			'summary' => htmlspecialchars( xoops_substr( strip_tags( $article->getVar('hometext') ) , 0 , 255 ) , ENT_QUOTES ) ,
		) ;

	} else {

		return array(
			'dirname' => $mydirname ,
			'module_name' => $module->getVar( 'name' ) ,
		) ;

	}
}


}

?>