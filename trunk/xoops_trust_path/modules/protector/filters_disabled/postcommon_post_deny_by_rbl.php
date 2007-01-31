<?php

function protector_postcommon_post_deny_by_rbl()
{
	// RBL servers (don't enable too many servers)
	$rbls = array(
		'niku.2ch.net' ,
#		'list.dsbl.org' ,
#		'bl.spamcop.net' ,
#		'sbl-xbl.spamhaus.org' ,
#		'all.rbl.jp' ,
#		'opm.blitzed.org' ,
#		'bsb.empty.us' ,
#		'bsb.spamlookup.net' ,
	) ;

	global $xoopsUser ;
	$protector =& Protector::getInstance() ;

	$rev_ip = implode( '.' , array_reverse( explode( '.' , @$_SERVER['REMOTE_ADDR'] ) ) ) ;

	foreach( $rbls as $rbl ) {
		$host = $rev_ip . '.' . $rbl ;
		if( gethostbyname( $host ) != $host ) {
			$protector->message .= "DENY by $rbl\n" ;
			$uid = is_object( $xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
			$protector->output_log( 'RBL SPAM' , $uid , false , 128 ) ;
			die( 'Protector rejects your post, because your IP is registered in RBL' ) ;
		}
	}
	
	return true ;
}

?>