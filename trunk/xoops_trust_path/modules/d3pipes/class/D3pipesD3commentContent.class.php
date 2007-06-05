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


function validate_id( $link_id )
{
	$clipping_id = intval( $link_id ) ;
	$mydirname = $this->mydirname ;

	$db =& Database::getInstance() ;

	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($mydirname."_clippings")." WHERE clipping_id=$clipping_id" ) ) ;
	if( $count <= 0 ) return false ;
	else return $clipping_id ;
}


function onUpdate( $mode , $link_id , $forum_id , $topic_id , $post_id = 0 )
{
	$clipping_id = intval( $link_id ) ;
	$mydirname = $this->mydirname ;

	$db =& Database::getInstance() ;

	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($this->d3forum_dirname."_posts")." p LEFT JOIN ".$db->prefix($this->d3forum_dirname."_topics")." t ON t.topic_id=p.topic_id WHERE t.forum_id=$forum_id AND t.topic_external_link_id='$clipping_id'" ) ) ;
	$db->queryF( "UPDATE ".$db->prefix($mydirname."_clippings")." SET comments_count=$count WHERE clipping_id=$clipping_id" ) ;

	return true ;
}



}

?>