<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;

$forum_id = intval( @$_GET['forum_id'] ) ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ;

// get&check this category ($category4assign, $category_row), override options
include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// check post permission
if( empty( $can_post ) ) die( _MD_D3FORUM_ERR_POSTFORUM ) ;


// specific variables for newtopic
$pid = 0 ;
$post_id = 0 ;
$subject4html = '' ;
$message4html = '' ;
$topic_id = 0 ;
$u2t_marked = @$xoopsModuleCongif['allow_mark'] ? 1 : 0 ;
$hide_uid = 0 ;
$invisible = 0 ;
$approval = 1 ;

$formTitle = _MD_D3FORUM_POSTASNEWTOPIC ;
$mode = 'newtopic' ;

include dirname(dirname(__FILE__)).'/include/display_post_form.inc.php' ;

?>