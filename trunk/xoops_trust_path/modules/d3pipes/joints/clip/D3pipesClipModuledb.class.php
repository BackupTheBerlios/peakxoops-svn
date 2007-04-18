<?php

require_once dirname(dirname(__FILE__)).'/D3pipesClipAbstract.class.php' ;

class D3pipesClipModuledb extends D3pipesClipAbstract {

	// store
	function execute( $entries , $max_entries = 10 )
	{
		if( empty( $entries[0] ) ) return $entries ;

		// delete expired clippings
		$this->removeExpired() ;

		$db =& Database::getInstance() ;
		$clip_table = $db->prefix( $this->mydirname.'_clippings' ) ;

		// entries may be sorted by putime desc ...
		$entries = array_reverse( $entries ) ;

		foreach( $entries as $i => $entry ) {
			$fingerprint4sql = addslashes( @$entry['fingerprint'] ) ;
			if( empty( $fingerprint4sql ) ) continue ;
			list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM $clip_table WHERE fingerprint='$fingerprint4sql' AND pipe_id=$this->pipe_id" ) ) ;
			if( $count > 0 ) continue ;

			$pubtime4sql = empty( $entry['pubtime'] ) ? time() : intval( $entry['pubtime'] ) ;
			$link4sql = empty( $entry['link'] ) ? '' : addslashes( $entry['link'] ) ;
			$headline4sql = empty( $entry['headline'] ) ? '(no title)' : addslashes( $entry['headline'] ) ;

			$db->queryF( "INSERT INTO $clip_table SET pipe_id=$this->pipe_id,fingerprint='$fingerprint4sql',pubtime=$pubtime4sql,link='$link4sql',headline='$headline4sql',data='".addslashes(serialize($entry))."',fetched_time=UNIX_TIMESTAMP()" ) ;
		}

		return $this->getCaches( $max_entries ) ;
	}

	// fetch multiple entries
	function getCaches( $max_entries = 10 )
	{
		$db =& Database::getInstance() ;

		$clip_table = $db->prefix( $this->mydirname.'_clippings' ) ;

		$result = $db->query( "SELECT clipping_id,data FROM $clip_table WHERE pipe_id=$this->pipe_id ORDER BY pubtime DESC,clipping_id DESC" ) ;
		
		$entries = array() ;
		while( list( $clipping_id , $entry_serialized ) = $db->fetchRow( $result ) ) {
			$entries[] = unserialize( $entry_serialized ) + array( 'clipping_id' => $clipping_id ) ;
		}

		return $entries ;
	}

	// fetch single entry
	function getClipping( $clipping_id )
	{
		$db =& Database::getInstance() ;

		$clip_table = $db->prefix( $this->mydirname.'_clippings' ) ;

		$clipping_id = intval( $clipping_id ) ;
		list( $pipe_id , $highlight , $weight , $fetched_time , $data_serialized ) = $db->fetchRow( $db->query( "SELECT pipe_id,highlight,weight,fetched_time,data FROM $clip_table WHERE clipping_id=$clipping_id" ) ) ;

		if( empty( $data_serialized ) ) return false ;
		else return unserialize( $data_serialized ) + array(
			'pipe_id' => intval( $pipe_id ) ,
			'clipping_highlight' => $highlight ,
			'clipping_weight' => $weight ,
			'clipping_fetched_time' => $fetched_time ,
		) ;
	}


	function removeExpired()
	{
		if( empty( $this->mod_configs['removeclips_by_fetched'] ) ) return ;

		$db =& Database::getInstance() ;

		$clip_table = $db->prefix( $this->mydirname.'_clippings' ) ;

		// d3forum integration
		$d3comment_dirname = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , $this->mod_configs['comment_dirname'] ) ;
		$d3comment_forum_id = intval( $this->mod_configs['comment_forum_id'] ) ;
		if( ! file_exists( XOOPS_ROOT_PATH.'/modules/'.$d3comment_dirname.'/mytrustdirname.php' ) ) $d3comment_forum_id = 0 ;
		if( $d3comment_forum_id > 0 ) {
			$d3comment_join4sql = "LEFT JOIN ".$db->prefix($d3comment_dirname."_topics")." t ON t.forum_id=$d3comment_forum_id AND t.topic_external_link_id=c.clipping_id" ;
			$whr_d3comment = 't.topic_id IS NULL' ;
		} else {
			$d3comment_join4sql = '' ;
			$whr_d3comment = '1' ;
		}

		$whr = 'c.fetched_time < UNIX_TIMESTAMP() - '.( $this->mod_configs['removeclips_by_fetched'] * 86400 ) ;
		$result = $db->query( "SELECT c.clipping_id FROM $clip_table c $d3comment_join4sql WHERE $whr AND ! highlight AND ($whr_d3comment)" ) ;
		while( list( $clipping_id ) = $db->fetchRow( $result ) ) {
			$db->queryF( "DELETE FROM $clip_table WHERE clipping_id=$clipping_id" ) ;
		}

	}
}


?>
