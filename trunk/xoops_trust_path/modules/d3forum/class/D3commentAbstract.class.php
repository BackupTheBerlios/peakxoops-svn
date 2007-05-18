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
function fetchSummary( $link_id )
{
	return '' ;
	// return array( 'module_name' => '' , 'subject' => '' , 'uri' => '' , 'summary' => '' ) ;
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


}

?>