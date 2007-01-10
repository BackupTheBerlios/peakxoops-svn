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
		$subject4assign = $article->getVar( 'title' ) ;
		$summary = $article->getVar('hometext') ;
		if( function_exists( 'easiestml' ) ) {
			$summary = easiestml( $summary ) ;
		}
		$summary4assign = htmlspecialchars( xoops_substr( strip_tags( $summary ) , 0 , 255 ) , ENT_QUOTES ) ;
		if( function_exists( 'easiestml' ) ) {
			$summary4assign = easiestml( $summary4assign ) ;
		}

	} else {

		$subject4assign = '' ;
		$summary4assign = '' ;

	}

	return array(
		'dirname' => $mydirname ,
		'module_name' => $module->getVar( 'name' ) ,
		'subject' => $subject4assign ,
		'uri' => XOOPS_URL.'/modules/'.$mydirname.'/index.php?page=article&amp;storyid='.$storyid ,
		'summary' => $summary4assign ,
	) ;


}


}

?>