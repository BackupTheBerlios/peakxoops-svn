<?php

// abstract class for d3forum comment integration
class D3commentAbstract {

var $d3forum_dirname = '' ;
var $mydirname = '' ;

function D3commentAbstract( $d3forum_dirname , $target_dirname )
{
	$this->d3forum_dirname = $d3forum_dirname ;
	$this->mydirname = $target_dirname ;
}


// abstract (override it)
// get reference description as string
function fetchDescription( $link_id )
{
	return false ;
}


// abstract (override it)
// get reference information as array
function fetchSummary( $link_id )
{
	return array( 'module_name' => '' , 'subject' => '' , 'uri' => '' , 'summary' => '' ) ;
	// all values should be HTML escaped.
}


function external_link_id( $params )
{
	return @$params['id'] ;
}


// minimum check
// if you want to allow "string id", override it
function validate_id( $link_id )
{
	$ret = intval( $link_id ) ;
	if( $ret <= 0 ) return false ;
	return $ret ;
}


// callback on newtopic/edit/reply/delete
// abstract
function onUpdate( $mode , $link_id , $forum_id , $topic_id , $post_id = 0 )
{
	return true ;
}


// returns posts count
function getPostsCount( $forum_id , $link_id )
{
	$db =& Database::getInstance() ;

	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($this->d3forum_dirname."_posts")." p LEFT JOIN ".$db->prefix($this->d3forum_dirname."_topics")." t ON t.topic_id=p.topic_id WHERE t.forum_id=$forum_id AND t.topic_external_link_id='$link_id'" ) ) ;

	return intval( $count ) ;
}


// returns topics count
function getTopicsCount( $forum_id , $link_id )
{
	$db =& Database::getInstance() ;

	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($this->d3forum_dirname."_topics")." t WHERE t.forum_id=$forum_id AND t.topic_external_link_id='$link_id'" ) ) ;

	return intval( $count ) ;
}


}

?>