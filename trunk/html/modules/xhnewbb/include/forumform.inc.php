<?php

if( ! defined('XOOPS_ROOT_PATH') ) exit ;

// variable check
$nosmiley = empty( $nosmiley ) ? 0 : 1 ;
$icon = empty( $icon ) ? 'icon7.gif' : htmlspecialchars( $icon , ENT_QUOTES ) ;
$solved = isset( $solved ) ? $solved : 1 ;
$pid = empty( $pid ) ? 0 : intval( $pid ) ;
$post_id = empty( $post_id ) ? 0 : intval( $post_id ) ;
$topic_id = empty( $topic_id ) ? 0 : intval( $topic_id ) ;
$forum = empty( $forum ) ? 0 : intval( $forum ) ;
$formTitle = empty( $formTitle ) ? "" : $formTitle ;
$guestName = empty( $guestName ) ? "" : $guestName ;
$mode = ! in_array( @$mode , array('newtopic','edit','reply','preview') ) ? 'newtopic' : $mode ;
$allow_html = $forumdata['allow_html'] ;
$nohtml = isset( $nohtml ) ? intval( $nohtml ) : 1 ;

if( is_object( @$xoopsUser ) ) {
	$uid = $xoopsUser->getVar('uid') ;
	$allow_sig = $forumdata['allow_sig'] ;
	$attachsig = isset( $attachsig ) ? intval( $attachsig ) : $xoopsUser->getVar('attachsig') ;
	// notification (what a buggy functions ... :-x
	if( ! empty( $xoopsModuleConfig['notification_enabled'] ) && in_array( 'thread-new_post' , @$xoopsModuleConfig['notification_events'] ) ) {
		$allow_notify = true ;
		if( isset( $notify ) ) {
			$notify = intval( $notify ) ;
		} else {
			$notification_handler =& xoops_gethandler('notification') ;
			if( ! empty( $topic_id ) && $notification_handler->isSubscribed('thread' , $topic_id , 'new_post' , $xoopsModule->getVar('mid') , $uid ) ) {
				$notify = 1;
			} else {
				$notify = 0;
			}
		}
	} else {
		$allow_notify = false ;
		$notify = 0 ;
	}
} else {
	$uid = 0 ;
	$allow_sig = false ;
	$attachsig = 0 ;
	$allow_notify = false ;
	$notify = 0 ;
}

$xoopsOption['template_main'] = 'xhnewbb_post_form.html' ;

// message for each forum types
if ( $forumdata['forum_type'] == 1 ) {
	$type = _MD_XHNEWBB_PRIVATE;
} else {
	switch( $forumdata['forum_access'] ) {
	  case 1:
		$type = _MD_XHNEWBB_REGCANPOST;
		break;
	  case 2:
		$type = _MD_XHNEWBB_ANONCANPOST;
		break;
	  case 3:
		$type = _MD_XHNEWBB_MODSCANPOST;
		break;
	}
}

// solved changeable?
if( ! empty( $xoopsModuleConfig['xhnewbb_use_solved'] ) && is_object( @$xoopsUser ) && ( $xoopsUser->isAdmin() || xhnewbb_is_moderator( $forum , $xoopsUser->getVar('uid') ) ) ) {
	$can_change_solved = true ;
} else {
	$can_change_solved = false ;
}

$xoopsTpl->assign( array(
	'mode' => $mode ,
	'formtitle' => $formTitle ,
	'viewmode' => $viewmode ,
	'order' => $order ,
	'message_about_post' => $type ,
	'uid' => $uid ,
	'uname' => $uid ? $xoopsUser->getVar('uname') : $guestName ,
	'subject' => @$subject4html ,
	'message' => @$message4html ,
	'reference_quote' => @$quote4html ,
	'reference_subject' => @$reference_subject4html ,
	'reference_message' => @$reference_message4html ,
	'reference_name' => @$reference_name4html ,
	'reference_date' => @$reference_date4html ,
	'icons' => array(
		'icon1.gif' ,
		'icon2.gif' ,
		'icon3.gif' ,
		'icon4.gif' ,
		'icon5.gif' ,
		'icon6.gif' ,
		'icon7.gif' ,
		) ,
	'solved' => $solved ,
	'solved_checked' => $solved ? 'checked="checked"' : '' ,
	'can_change_solved' => $can_change_solved ,
	'pid' => $pid ,
	'post_id' => $post_id ,
	'topic_id' => $topic_id ,
	'forum' => $forum ,
	'u2t_marked' => intval( @$u2t_marked ) ,
	'nosmiley' => $nosmiley ,
	'nosmiley_checked' => $nosmiley ? 'checked="checked"' : '' ,
	'allow_sig' => $allow_sig ,
	'attachsig' => $attachsig ,
	'attachsig_checked' => $attachsig ? 'checked="checked"' : '' ,
	'allow_notify' => $allow_notify ,
	'notify' => $notify ,
	'notify_checked' => $notify ? 'checked="checked"' : '' ,
	'allow_html' => $allow_html ,
	'nohtml' => $nohtml ,
	'nohtml_checked' => $nohtml ? 'checked="checked"' : '' ,
) ) ;

?>