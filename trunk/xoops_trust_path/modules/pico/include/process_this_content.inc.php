<?php

// visible check
$whr4visible = $isadminormod ? '1' : 'visible' ;

// get this "content" from given $content_id
$sql = "SELECT * FROM ".$db->prefix($mydirname."_contents")." o WHERE content_id='$content_id' AND ($whr4visible)" ;
if( ! $ors = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
if( $db->getRowsNum( $ors ) <= 0 ) {
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php" , 2 , _MD_PICO_ERR_READCONTENT ) ;
	exit ;
}
$content_row = $db->fetchArray( $ors ) ;

// body/filter/cache
$body4assign = $myts->displayTarea( $content_row['body'] ) ;

// assigning
$content4assign = array(
	'id' => intval( $content_row['content_id'] ) ,
	'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
	'htmlheader' => $content_row['htmlheader'] ,
	'body' => $body4assign ,
	'visible' => intval( $content_row['visible'] ) ,
	'can_edit' => $category4assign['can_edit'] ,
) ;

?>