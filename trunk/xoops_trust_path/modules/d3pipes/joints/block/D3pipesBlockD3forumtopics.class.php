<?php

require_once dirname(dirname(__FILE__)).'/D3pipesBlockAbstract.class.php' ;

class D3pipesBlockD3forumtopics extends D3pipesBlockAbstract {

	var $target_dirname = '' ;

	function init()
	{
		// parse and check option for this class
		$params = array_map( 'trim' , explode( '|' , $this->option ) ) ;
		if( empty( $params[0] ) ) {
			$this->errors[] = _MD_D3PIPES_ERR_INVALIDDIRNAMEINBLOCK."\n($this->pipe_id)" ;
			return false ;
		}
		$this->target_dirname = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , $params[0] ) ;

		// configurations (file, name, block_options)
		$this->func_file = XOOPS_ROOT_PATH.'/modules/'.$this->target_dirname.'/blocks/blocks.php' ;
		$this->func_name = 'b_d3forum_list_topics_show' ;
		$this->block_options = array(
			'disable_renderer' => true ,
			0 => $this->target_dirname , // mydirname of pico
			1 => 10 , // max_entries
			2 => false , // show_fullsize
			3 => 'time' , // order by
			4 => false , // is_markup
			5 => @$params[1] , // categories
		) ;

		return true ;
	}

	function reassign( $data )
	{
		$data = $this->unhtmlspecialchars( $data ) ; // d3 modules has a rule assigning escaped variables

		$entries = array() ;
		foreach( $data['topics'] as $topic ) {
			$entries[] = array(
				'pubtime' => $topic['last_post_time'] , // timestamp
				'link' => $data['mod_url'].'/index.php?topic_id='.$topic['id'] ,
				'headline' => $topic['title'] ,
				'fingerprint' => $data['mod_url'].'/index.php?topic_id='.$topic['id'] ,
				'description' => '' ,
			) ;
		}

		return $entries ;
	}


}

?>