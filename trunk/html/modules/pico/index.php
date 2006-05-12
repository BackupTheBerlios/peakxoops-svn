<?php

require '../../mainfile.php' ;
if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'set XOOPS_TRUST_PATH in mainfile.php' ) ;

$mydirname = basename( dirname( __FILE__ ) ) ;
$mydirpath = dirname( __FILE__ ) ;

if( @$_GET['mode'] == 'admin' ) {
	require XOOPS_TRUST_PATH.'/modules/pico/admin.php' ;
} else {
	require XOOPS_TRUST_PATH.'/modules/pico/main.php' ;
}

?>