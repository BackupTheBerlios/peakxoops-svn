<?php

require_once dirname(dirname(__FILE__)).'/D3pipesParseAbstract.class.php' ;
if( ! class_exists( 'XML' ) ) {
	require_once dirname(dirname(dirname(__FILE__))).'/class/xml.php' ;
}

class D3pipesParseKeithxml extends D3pipesParseAbstract {

	var $parse_parameters = array(
		'rss2' => array(
			'bases' => array(
				'rss.channel.item' ,
			) ,
			'indexes' => array(
				'pubtime'=>'pubDate|dc:date' ,
				'link'=>'link' ,
				'headline'=>'title' ,
				'fingerprint'=>'guid|link' ,
				'category'=>'category' ,
				'description'=>'description' ,
				'content_encoded'=>'content:encoded' ,
			) ,
			'minimum_elements' => array(
				'#(\<description\>)(.*)(\<\/description\>)#isU' ,
				'#(\<content\:encoded\>)(.*)(\<\/content\:encoded\>)#isU' ,
			) ,
			'post_filter_func' => '' ,
		) ,
		'rss1' => array(
			'bases' => array(
				'rdf:RDF.item' ,
			) ,
			'indexes' => array(
				'pubtime'=>'dc:date' ,
				'link'=>'link' ,
				'headline'=>'title' ,
				'fingerprint'=>'link' ,
				'description'=>'description' ,
			) ,
			'minimum_elements' => array() ,
			'post_filter_func' => '' ,
		) ,
		'atom' => array(
			'bases' => array(
				'feed.entry' ,
			) ,
			'indexes' => array(
				'pubtime'=>'updated|published' ,
				'link'=>'link' ,
				'headline'=>'title' ,
				'fingerprint'=>'id' ,
				'description'=>'content' ,
			) ,
			'minimum_elements' => array() ,
			'post_filter_func' => 'atom_post_filter' ,
		) ,
	) ;

	var $params = array() ;


	function parse_option()
	{
		$xml_type = trim( strtolower( $this->option ) ) ;
		switch( $xml_type ) {
			case 'rss' : $xml_type = 'rss2' ; break ;
			case 'rdf' : $xml_type = 'rss1' ; break ;
		}
		if( empty( $this->parse_parameters[ $xml_type ] ) ) {
			$this->params =& $this->parse_parameters['rss2'] ;
		} else {
			$this->params =& $this->parse_parameters[ $xml_type ] ;
		}
	}


	function filterInsideMinElement( $matches )
	{
		return $matches[1].strip_tags($matches[2]).$matches[3] ;
	}


	function execute( $xml_source , $max_entries = '' )
	{
		$this->parse_option() ;

		// prefilter
		foreach( $this->params['minimum_elements'] as $search ) {
			$xml_source = preg_replace_callback( $search , array( $this , 'filterInsideMinElement' ) , $xml_source ) ;
		}

		$data = XML_unserialize( $xml_source ) ;

		// try various loop bases
		$base_found = false ;
		foreach( $this->params['bases'] as $base ) {
			$loop_base =& $data ;
			foreach( explode( '.' , $base ) as $index ) {
				$loop_base =& $loop_base[ $index ] ;
			}
			if( is_array( $loop_base ) ) {
				$base_found = true ;
				break ;
			}
		}
		if( ! $base_found ) return array() ;

		$items = array() ;
		$attributes = array() ;
		foreach( $loop_base as $entry_key => $entry ) {
			// attribute or data ?
			if( preg_match( '/(\d+) attr/' , $entry_key , $regs ) ) {
				$attributes[ $regs[1] ] = $entry ;
				continue ;
			} else if( ! is_numeric( $entry_key ) ) {
				// just an item/entry
				$entry = $loop_base ;
				$single_item = true ;
			}

			$item = array() ;
			foreach( $this->params['indexes'] as $api_tag => $xml_tags ) {
				foreach( explode( '|' , $xml_tags ) as $tag ) {
					if( isset( $entry[ $tag ] ) ) {
						if( strstr( $api_tag , 'time' ) ) {
							$item[ $api_tag ] = $this->dateToUnix( $entry[ $tag ] ) ;
							// $item[ $api_tag ] = $this->dateToUnix( '2007-10-10T12:34:56.7Z' ) ; // DEBUG
						} else {
							$item[ $api_tag ] = $entry[ $tag ] ;
						}
						break ;
					}
				}
			}
			if( ! empty( $this->params['post_filter_func'] ) ) $item = call_user_func( array( $this , $this->params['post_filter_func'] ) , $item ) ;
			if( empty( $item['pubtime'] ) ) $item['pubtime'] = time() ;
			$items[] = $item ;
			
			if( ! empty( $single_item ) ) break ;

		}

		// sort pubtime DESC if pubtime exists
		if( ! empty( $items[0]['pubtime'] ) ) {
			usort( $items , array( $this , 'pubtime_sort' ) ) ;
		}

		return $items ;
	}


	function pubtime_sort( $a , $b )
	{
		return @$a['pubtime'] > @$b['pubtime'] ? -1 : 1 ;
	}


	function atom_post_filter( $entry )
	{
		if( is_array( $entry['link'] ) ) {
			foreach( $entry['link'] as $key => $val ) {
				if( isset( $val['type'] ) && $val['type'] == 'text/html' ) {
					$entry['link'] = $val['href'] ;
				}
			}
		}
		if( is_array( $entry['link'] ) ) $entry['link'] = '' ; // TODO

		return $entry ;
	}

}

?>
