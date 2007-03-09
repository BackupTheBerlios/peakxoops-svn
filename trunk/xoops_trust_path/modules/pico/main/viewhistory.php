<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;

// get $content_history_id
$content_history_id = intval( @$_GET['content_history_id'] ) ;

// get $history_row and $content_id
$history_row = $db->fetchArray( $db->query( "SELECT oh.*,up.uname AS poster_uname,mp.uname AS modifier_uname FROM ".$db->prefix($mydirname."_content_histories")." oh LEFT JOIN ".$db->prefix("users")." up ON oh.poster_uid=up.uid LEFT JOIN ".$db->prefix("users")." mp ON oh.modifier_uid=mp.uid WHERE oh.content_history_id=$content_history_id" ) ) ;
if( empty( $history_row['content_id'] ) ) die( 'Invalid content_history_id' ) ;
$content_id = intval( $history_row['content_id'] ) ;

// get and process $cat_id
$cat_id = pico_get_cat_id_from_content_id( $mydirname , $content_id ) ;

// get&check this category ($category4assign, $category_row), override options
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// special check for viewhistory
if( ! $category4assign['can_edit'] ) die( _MD_PICO_ERR_EDITCONTENT ) ;

if( headers_sent() ) die( 'headers are already sent' ) ;
header( 'Content-Type: text/plain' ) ;
echo "content_id: {$history_row['content_id']}
subject:    {$history_row['subject']}
cat_id:     {$history_row['cat_id']}
vpath:      {$history_row['vpath']}
created:    ".formatTimestamp($history_row['created_time'],'m')." ({$history_row['poster_ip']}) {$history_row['poster_uname']}({$history_row['poster_uid']})
modified:   ".formatTimestamp($history_row['modified_time'],'m')." ({$history_row['modifier_ip']}) {$history_row['modifier_uname']}({$history_row['modifier_uid']})
filters:    {$history_row['filters']}

htmlheader:
{$history_row['htmlheader']}

body:
{$history_row['body']}
" ;

exit ;

?>