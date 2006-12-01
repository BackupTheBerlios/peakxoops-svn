<?php

// abstract class for d3forum comment integration
class D3commentAbstract {

var $mydirname = '' ;

function D3commentAbstract( $mydirname )
{
	$this->mydirname = $mydirname ;
}

function fetchSummary( $link_id )
{
	// return array( 'module_name' => '' , 'subject' => '' , 'uri' => '' , 'summary' => '' ) ;
	// all values should be HTML escaped.
}


function external_link_id( $params )
{
	return intval( @$params['id'] ) ;
}


}

?>