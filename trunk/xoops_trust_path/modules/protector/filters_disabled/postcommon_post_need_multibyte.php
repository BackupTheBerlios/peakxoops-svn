<?php

// Don't enable this for site using single-byte
// Perhaps, japanese, schinese, tchinese, and korean can use it

function protector_postcommon_post_need_multibyte()
{
	if( ! function_exists( 'mb_strlen' ) ) return true ;

	global $xoopsUser ;
	$protector =& Protector::getInstance() ;

	// dare to ignore arrays
	foreach( $_POST as $data ) {
		if( is_object( $data ) ) continue ;
		if( strlen( $data ) > 100 ) {
			if( strlen( $data ) == mb_strlen( $data ) ) {
				$protector->message .= "No multibyte character was found ($data)\n" ;
				$uid = is_object( $xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
				$protector->output_log( 'Singlebyte SPAM' , $uid , false , 128 ) ;
				die( 'Protector rejects your post, because your post looks like SPAM' ) ;
			}
		}
	}

	return true ;
}

?>