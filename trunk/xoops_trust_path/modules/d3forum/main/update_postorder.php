<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;

// update cookie
setcookie( $mydirname.'_postorder' , intval( $_GET['postorder'] ) ) ;

$allowed_identifiers = array( 'post_id' , 'topic_id' , 'forum_id' ) ;

if( in_array( $_GET['ret_id'] , $allowed_identifiers ) ) {
	$ret_request = $_GET['ret_id'] . '=' . intval( $_GET['ret_val'] ) ;
} else {
	$ret_request = "topic_id=$topic_id" ;
}

header( "Location: ".XOOPS_URL."/modules/$mydirname/index.php?$ret_request" ) ;
exit ;

?>