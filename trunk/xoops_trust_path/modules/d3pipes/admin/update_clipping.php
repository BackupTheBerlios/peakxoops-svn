<?php

$field_defs = array(
	'headline' => 'string' ,
	'link' => 'string' ,
) ;

require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
require_once dirname(dirname(__FILE__)).'/include/admin_functions.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;
$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

// get value (from UTF-8 to
$value_utf8 = $myts->stripSlashesGPC( $_POST['value'] ) ;
$value = d3pipes_common_convert_encoding_utf8toie( $mydirname , $value_utf8 ) ;

// get clipping
$clipping_id = intval( $_GET['clipping_id'] ) ;
$clipping = d3pipes_common_get_clipping( $mydirname , $clipping_id ) ;

// get field
$field = $_GET['field'] ;
if( $clipping && isset( $field_defs[ $field ] ) ) {

	list( $data_serialized ) = $db->fetchRow( $db->query( "SELECT data FROM ".$db->prefix($mydirname."_clippings")." WHERE clipping_id=$clipping_id" ) ) ;
	$data = unserialize( $data_serialized ) ;
	$data[$field] = $value ;
	$db->query( "UPDATE ".$db->prefix($mydirname."_clippings")." SET `data`='".addslashes(serialize($data))."' WHERE clipping_id=$clipping_id" ) ;
	$db->query( "UPDATE ".$db->prefix($mydirname."_clippings")." SET `$field`='".addslashes($value)."' WHERE clipping_id=$clipping_id" ) ;
}

echo htmlspecialchars( $value , ENT_QUOTES ) ;
exit ;

?>