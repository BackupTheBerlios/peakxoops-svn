<?php
// $Id: post.php,v 1.5 2005/02/10 19:04:21 gij Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

include 'header.php';
include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';

// get real topic_id, forum and CHECK THE PRIVILEGES
if( ! empty( $_POST['post_id'] ) ) {

	// EDIT
	$forumpost = new ForumPosts( intval( $_POST['post_id'] ) ) ;
	$post_id = $forumpost->postid() ;
	if( empty( $post_id ) ) {
		die(_MD_XHNEWBB_ERRORPOST);
	}
	if( $forumpost->islocked() ) {
		die(_MD_XHNEWBB_TOPICLOCKED);
	}
	$topic_id = $forumpost->topic() ;
	$forum = $forumpost->forum() ;
	$pid = 0 ;
	$isedit = 1 ;

	if( ! is_object( $xoopsUser ) || ! ( $xoopsUser->isAdmin() || $forumpost->uid() == $xoopsUser->getVar("uid") || xhnewbb_is_moderator($forum, $xoopsUser->getVar("uid")) ) ) {
		die(_MD_XHNEWBB_EDITNOTALLOWED);
	}

} else if( ! empty( $_POST['pid'] ) ) {
	// REPLY
	$parent_post = new ForumPosts( intval( $_POST['pid'] ) ) ;
	$pid = $parent_post->postid() ;
	if( empty( $pid ) ) {
		die(_MD_XHNEWBB_ERRORPOST);
	}
	if( $parent_post->islocked() ) {
		die(_MD_XHNEWBB_TOPICLOCKED);
	}
	$topic_id = $parent_post->topic() ;
	$forum = $parent_post->forum() ;
	$post_id = 0 ;
} else {
	// NEW
	$topic_id = 0 ;
	$forum = intval( @$_POST['forum'] ) ;
	$post_id = 0 ;
	$pid = 0 ;
}


if( empty( $forum ) ) {
	die(_MD_XHNEWBB_ERRORFORUM);
}


$sql = "SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id = ".$forum;
if ( !$result = $xoopsDB->query($sql) ) {
	die(_MD_XHNEWBB_ERROROCCURED);
}
$forumdata = $xoopsDB->fetchArray($result);

// GIJ Patch
if( empty( $forumdata['allow_html'] ) ) $_POST['nohtml'] = 1 ;

// CHECK ACCESS RIGHTS BY FORUM TYPE 
if ( $forumdata['forum_type'] == 1 ) {
// To get here, we have a logged-in user. So, check whether that user is allowed to view
// this private forum.
	$accesserror = 0;
	if ( $xoopsUser ) {
		if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
			if ( !xhnewbb_check_priv_forum_post($xoopsUser->uid(), $_POST['forum']) ) {
				$accesserror = 1;
			}
		}
	} else {
		$accesserror = 1;
	}

	if ( $accesserror == 1 ) {
		die(_MD_XHNEWBB_NORIGHTTOPOST);
	}

	require_once dirname(__FILE__).'/include/perm_functions.php' ;
	$users2notify = get_users_can_read_forum( $forum ) ;
	if( empty( $users2notify ) ) $users2notify = array( 0 ) ;

} else {
	$accesserror = 0;
	if ( $forumdata['forum_access'] == 3 ) {
		if ( $xoopsUser ) {
			if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
				if ( !xhnewbb_is_moderator($forum, $xoopsUser->uid()) ) {
					$accesserror = 1;
				}
			}
		} else {
			$accesserror = 1;
		}
	} elseif ( $forumdata['forum_access'] == 1 && !$xoopsUser ) {
		$accesserror = 1;
	}
	if ( $accesserror == 1 ) {
		die(_MD_XHNEWBB_NORIGHTTOPOST);
	}

	$users2notify = array() ;
}



if ( !empty($_POST['contents_preview']) ) {
	include XOOPS_ROOT_PATH."/header.php";
	echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td>";
	$myts =& MyTextSanitizer::getInstance();
	$reference_subject4html = $myts->makeTboxData4Preview($_POST['subject']);
	$reference_message4html = $myts->previewTarea( $_POST['message'] , intval( ! @$_POST['nohtml'] ) , intval( ! @$_POST['nosmiley'] ) , 1 , @$GLOBALS['xoopsModuleConfig']['xhnewbb_allow_textimg'] ) ;
	$nosmiley = empty( $_POST['nosmiley'] ) ? 0 : 1 ;
	$nohtml = empty( $_POST['nohtml'] ) ? 0 : 1 ;
	/*
	if ( $nosmiley && $nohtml ) {
		$p_message = $myts->makeTareaData4Preview($_POST['message'],0,0,1);
	} elseif ( $nohtml ) {
		$p_message = $myts->makeTareaData4Preview($_POST['message'],0,1,1);
	} elseif ( $nosmiley ) {
		$p_message = $myts->makeTareaData4Preview($_POST['message'],1,0,1);
	} else {
		$p_message = $myts->makeTareaData4Preview($_POST['message'],1,1,1);
	}
	*/
	//themecenterposts($p_subject,$p_message);
	//echo "<br />";
	$subject4html = $myts->makeTboxData4PreviewInForm(@$_POST['subject']);
	$message4html = $myts->makeTareaData4PreviewInForm(@$_POST['message']);
	$hidden4html = $myts->makeTboxData4PreviewInForm(@$_POST['hidden']);
	$notify = !empty($_POST['notify']) ? 1 : 0;

	$guestName = $myts->makeTboxData4PreviewInForm(@$_POST['guestName']); // Ryuji_edit(2003-05-06)

	$attachsig = !empty($_POST['attachsig']) ? 1 : 0;
	$icon = preg_match( '/^icon[1-7]\.gif$/' , @$_POST['icon'] ) ? $_POST['icon'] : '' ;
	$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
	$u2t_marked = empty( $_POST['u2t_marked'] ) ? 0 : 1 ;
	$formTitle = _MD_XHNEWBB_FORMTITLEINPREVIEW ;
	$mode = 'preview' ;

	include XOOPS_ROOT_PATH.'/modules/xhnewbb/include/forumform.inc.php';
	//echo"</td></tr></table>";

} else {

	if( ! is_object( @$forumpost ) ) {
		$isreply = 0;
		$isnew = 1;
		if( is_object( @$xoopsUser ) ) {
			// user's post
			$uid = $xoopsUser->getVar("uid");
		} else if ( $forumdata['forum_access'] == 2 ) {
			// guest's post
			$uid = 0;
			// Insert guest name into the top of message (origined Ryuji)
			if( ! empty( $_POST['guestName'] ) ) {
				$_POST['message'] = sprintf( _MD_XHNEWBB_FMT_GUESTSPOSTHEADER , $_POST['guestName'] ) . @$_POST['message'] ;
			}
		} else {
			die(_MD_XHNEWBB_ANONNOTALLOWED);
		}
		$forumpost = new ForumPosts();
		$forumpost->setForum($forum);
		if ( $pid > 0 ) {
			$forumpost->setParent($pid);
			$isreply = 1;
		}
		if ( $topic_id > 0 ) {
			$forumpost->setTopicId($topic_id);
		}
		$forumpost->setIp($_SERVER['REMOTE_ADDR']);
		$forumpost->setUid($uid);
	}
	$subject = xoops_trim(@$_POST['subject']);
	$subject = ($subject == '') ? _NOTITLE : $subject;
	$icon = preg_match( '/^icon[1-7]\.gif$/' , @$_POST['icon'] ) ? $_POST['icon'] : '' ;
	$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
	$forumpost->setSubject($subject);
	$forumpost->setText(@$_POST['message']);
	$forumpost->setNohtml(@$_POST['nohtml']);
	$forumpost->setNosmiley(@$_POST['nosmiley']);
	$forumpost->setIcon($icon);
	$forumpost->setSolved(@$_POST['solved']);
	if( $forumdata['allow_sig'] ) {
		$forumpost->setAttachsig( @$_POST['attachsig'] ) ;
	} else {
		$forumpost->setAttachsig( 0 ) ;
	}
	if (!$postid = $forumpost->store()) {
		include_once(XOOPS_ROOT_PATH.'/header.php');
		xoops_error('Could not insert forum post');
		include_once(XOOPS_ROOT_PATH.'/footer.php');
		exit();
	}
	if (is_object($xoopsUser) && !empty($isnew)) {
		$xoopsUser->incrementPost();
	}

	// set u2t_marked
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
	$topic_id = $forumpost->topic() ;
	$u2t_marked = empty( $_POST['u2t_marked'] ) ? 0 : 1 ;
	if( ! empty( $xoopsModuleConfig['xhnewbb_allow_mark'] ) && $uid > 0 ) {
		$xoopsDB->query( "UPDATE ".$xoopsDB->prefix("xhnewbb_users2topics")." SET u2t_marked=$u2t_marked , u2t_time=".time()." WHERE uid='$uid' AND topic_id='$topic_id'" ) ;
		if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->query( 'INSERT INTO '.$xoopsDB->prefix('xhnewbb_users2topics')." SET uid='$uid',topic_id='$topic_id',u2t_marked=$u2t_marked , u2t_time=".time() ) ;
	}

	// RMV-NOTIFY
	// Define tags for notification message
	$tags = array();
	$tags['THREAD_NAME'] = $_POST['subject'];
	$tags['THREAD_URL'] = XOOPS_URL . "/modules/" . $xoopsModule->dirname() . "/viewtopic.php?post_id=$postid&topic_id=" . $forumpost->topic();
	$tags['POST_URL'] = $tags['THREAD_URL'] . '#forumpost' . $postid;
	include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/include/notification.inc.php';
	$forum_info = xhnewbb_notify_iteminfo ('forum', $forum);
	$tags['FORUM_NAME'] = $forum_info['name'];
	$tags['FORUM_URL'] = $forum_info['url'];
	$notification_handler =& xoops_gethandler('notification');
	if (!empty($isnew)) {
		if (empty($isreply)) {
			// Notify of new thread
			$notification_handler->triggerEvent('forum', $forum, 'new_thread', $tags , $users2notify );
		} else {
			// Notify of new post
			$notification_handler->triggerEvent('thread', $topic_id, 'new_post', $tags , $users2notify );
		}
		$notification_handler->triggerEvent('global', 0, 'new_post', $tags , $users2notify );
		$notification_handler->triggerEvent('forum', $forum, 'new_post', $tags , $users2notify );
		$myts =& MyTextSanitizer::getInstance();
		$tags['POST_CONTENT'] = $myts->stripSlashesGPC($_POST['message']);
		$tags['POST_NAME'] = $myts->stripSlashesGPC($_POST['subject']);
		$notification_handler->triggerEvent('global', 0, 'new_fullpost', $tags , $users2notify );
	}

	// If user checked notification box, subscribe them to the
	// appropriate event; if unchecked, then unsubscribe
	if( ! empty( $xoopsUser ) && ! empty( $xoopsModuleConfig['notification_enabled']) && in_array( 'thread-new_post' , @$xoopsModuleConfig['notification_events'] ) ) {
		if (!empty($_POST['notify'])) {
			$notification_handler->subscribe('thread', $forumpost->getTopicId(), 'new_post');
		} else {
			$notification_handler->unsubscribe('thread', $forumpost->getTopicId(), 'new_post');
		}
	}

	$post_id = $forumpost->postid();
	redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$forumpost->topic()."&amp;post_id=".$forumpost->postid()."&amp;viewmode=$viewmode&amp;order=$order#forumpost".$forumpost->postid() , 2 , empty( $isedit ) ? _MD_XHNEWBB_THANKSSUBMIT : _MD_XHNEWBB_THANKSEDIT ) ;
	exit ;
}

$xoopsTpl->assign( "xoops_module_header" , "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".XOOPS_URL."/modules/xhnewbb/index.css\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ) ;

include XOOPS_ROOT_PATH.'/footer.php';
?>
