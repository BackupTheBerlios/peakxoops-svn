<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php';
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;

$topic_id = intval( @$_GET['topic_id'] ) ;

// get&check this topic ($topic4assign, $topic_row, $forum_id), count topic_view up, get $prev_topic, $next_topic
include dirname(dirname(__FILE__)).'/include/process_this_topic.inc.php' ;

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ;

// get&check this category ($category4assign, $category_row), override options
include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// special permission check for topicmanager
if( ! $isadminormod ) die( _MD_D3FORUM_ERR_MODERATEFORUM ) ;


// TRANSACTION PART
require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;
if( ! empty( $_POST['topicman_post'] ) ) {
	if ( ! $xoopsGTicket->check( true , 'd3forum' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}
	d3forum_update_topic_from_post( $mydirname , $topic_id , $forum_id , $forum_permissions , $isadmin ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php?topic_id=$topic_id" , 2 , _MD_D3FORUM_TOPICMANAGERDONE ) ;
	exit ;
}

// get target forums
$jump_box_forums = array() ;
foreach( $forum_permissions as $forum_id => $perms ) {
	if( $perms['is_moderator'] ) $jump_box_forums[] = $forum_id ;
}
$whr4forum_jump_box = empty( $jump_box_forums ) ? '0' : 'f.forum_id IN ('.implode(',',$jump_box_forums).')' ;


// FORM PART

// dare to set 'template_main' after header.php (for disabling cache)
include XOOPS_ROOT_PATH."/header.php";
$xoopsOption['template_main'] = $mydirname.'_main_topicmanager.html' ;

// make edit data (special patch)
$topic4assign['title4edit'] = $myts->makeTboxData4Edit( $topic_row['topic_title'] , 1 ) ;

$xoopsTpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'category' => $category4assign ,
	'forum' => $forum4assign ,
	'topic' => $topic4assign ,
	'forum_jumpbox_options' => d3forum_make_jumpbox_options( $mydirname , '1' , $isadmin ? '1' : $whr4forum_jump_box , $topic_row['forum_id'] ) ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'd3forum') ,
	'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	'xoops_pagetitle' => _MD_D3FORUM_TOPICMANAGER ,
) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>