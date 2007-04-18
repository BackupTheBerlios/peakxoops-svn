<?php

require dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

// get clipping (raw data)
$clipping_id = intval( @$_POST['clipping_id'] ) ;
$clipping = d3pipes_common_get_clipping( $mydirname , $clipping_id ) ;
if( $clipping === false ) {
	die( _MD_D3PIPES_ERR_INVALIDCLIPPINGID ) ;
}

// special check of update_clipping
if( ! is_object( $xoopsUser ) || ! $xoopsUser->isAdmin() ) {
	die( _MD_D3PIPES_ERR_PERMISSION ) ;
}

$highlight = empty( $_POST['highlight_clipping'] ) ? 0 : 1 ;

$result = $db->query( "UPDATE ".$db->prefix($mydirname."_clippings")." SET highlight=$highlight WHERE clipping_id=$clipping_id" ) ;

redirect_header( XOOPS_URL.'/modules/'.$mydirname.'/index.php?page=clipping&clipping_id='.$clipping_id , 3 , _MD_D3PIPES_MSG_CLIPPINGUPDATED ) ;
exit ;

?>