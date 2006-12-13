<?php 

define( 'FCK_IS_UPLOAD_CONNECTOR' , 1 ) ;

// for XOOPS
require '../../../../../../mainfile.php' ;

require_once dirname(__FILE__).'/../../browser/default/connectors/php/functions.php' ;
require dirname(__FILE__).'/../../browser/default/connectors/php/config_and_auth.inc.php' ;

FileUpload( '/' ) ;

?>