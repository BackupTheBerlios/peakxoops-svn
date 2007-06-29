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
			@list( $pipe_id , $num ) = explode( ':' , $idnum ) ;
			if( intval( @$pipe_id ) > 0 ) {
				$this->union_ids[] = array(
					'pipe_id' => intval( $pipe_id ) ,
					'num' => intval( @$num ) > 0 ? intval( $num ) : 10 ,
				) ;
			}
		}
	}
	
	function execute( $entries , $max_entries = 10 ) {}

	function renderOptions( $index , $current_value = null )
	{
		$index = intval( $index ) ;
		$current_value = preg_replace( '/[^0-9,:]/' , '' , $current_value ) ;

		return '<input type="text" name="joint_option['.$index.']" id="joint_option_'.$index.'" value="'.htmlspecialchars($current_value,ENT_QUOTES).'" size="40" /><br />'._MD_D3PIPES_N4J_UNION ;
	}
}


?>