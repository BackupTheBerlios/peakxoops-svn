<?php

require_once dirname(__FILE__).'/D3pipesJointAbstract.class.php' ;

class D3pipesUnionAbstract extends D3pipesJointAbstract {

	var $union_ids = array() ;

	// constructor
	function D3pipesUnionAbstract( $mydirname , $pipe_id , $option = '' )
	{
		$this->mydirname = $mydirname ;
		$this->pipe_id = intval( $pipe_id ) ;
		if( trim( $option ) == '' ) $union_idnums = array() ;
		else $union_idnums = array_map( 'trim' , explode( ',' , $option ) ) ;

		foreach( $union_idnums as $idnum ) {
			list( $pipe_id , $num ) = explode( ':' , $idnum ) ;
			if( intval( @$pipe_id ) > 0 ) {
				$this->union_ids[] = array(
					'pipe_id' => intval( $pipe_id ) ,
					'num' => intval( @$num ) > 0 ? intval( $num ) : 10 ,
				) ;
			}
		}
	}
	
	function execute( $entries , $max_entries = 10 ) {}
}


?>