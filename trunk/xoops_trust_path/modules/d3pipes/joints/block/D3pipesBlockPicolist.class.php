<?php

require_once dirname(dirname(__FILE__)).'/D3pipesBlockAbstract.class.php' ;

class D3pipesBlockPicolist extends D3pipesBlockAbstract {

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
		$this->func_name = 'b_pico_list_show' ;
		$this->block_options = array(
			'disable_renderer' => true ,
			0 => $this->target_dirname , // mydirname of pico
			1 => @$params[1] , // category limitation
			2 => 'o.modified_time DESC' , // order by
			3 => 10 , // max_entries
			4 => '' , // template (nonsense)
		) ;

		return true ;
	}

	function reassign( $data )
	{
		$entries = array() ;
		foreach( $data['contents'] as $content ) {
			$entries[] = array(
				'pubtime' => $content['modified_time'] , // timestamp
				'link' => $data['mod_url'].'/'.$content['link'] ,
				'headline' => $content['subject'] ,
				'fingerprint' => $data['mod_url'].'/'.$content['link'] ,
				'description' => '' ,
			) ;
		}

		return $entries ;
	}


}

?>
