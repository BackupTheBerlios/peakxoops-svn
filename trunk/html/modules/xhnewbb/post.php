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
foreach (array('forum', 'topic_id', 'post_id', 'order', 'pid') as $getint) {
	${$getint} = isset($_POST[$getint]) ? intval($_POST[$getint]) : 0;
}
$viewmode = (isset($_POST['viewmode']) && $_POST['viewmode'] != 'flat') ? 'thread' : 'flat';
if ( empty($forum) ) {
	redirect_header(XOOPS_URL."/modules/xhnewbb/index.php", 2, _MD_XHNEWBB_ERRORFORUM);
	exit();
} else {
	$sql = "SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id = ".$forum;
	if ( !$result = $xoopsDB->query($sql) ) {
		redirect_header(XOOPS_URL."/modules/xhnewbb/index.php",2,_MD_XHNEWBB_ERROROCCURED);
		exit();
	}
	$forumdata = $xoopsDB->fetchArray($result);

	// GIJ Patch
	if( empty( $forumdata['allow_html'] ) ) $_POST['nohtml'] = 1 ;

	if ( $forumdata['forum_type'] == 1 ) {
	// To get here, we have a logged-in user. So, check whether that user is allowed to view
	// this private forum.
		$accesserror = 0;
		if ( $xoopsUser ) {
			if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
				if ( !xhnewbb_check_priv_forum_auth($xoopsUser->uid(), $_POST['forum'], true) ) {
					$accesserror = 1;
				}
			}
		} else {
			$accesserror = 1;
		}

		if ( $accesserror == 1 ) {
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?order=".$order."&viewmode=".$viewmode."&forum=".$forum,2,_MD_XHNEWBB_NORIGHTTOPOST);
			exit();
		}
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
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?order=".$order."&viewmode=".$viewmode."&forum=".$forum,2,_MD_XHNEWBB_NORIGHTTOPOST);
			exit();
		}
	}
	if ( !empty($_POST['contents_preview']) ) {
		include XOOPS_ROOT_PATH."/header.php";
		echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td>";
		$myts =& MyTextSanitizer::getInstance();
		$p_subject = $myts->makeTboxData4Preview($_POST['subject']);
		$p_message = $myts->previewTarea( $_POST['message'] , intval( ! @$_POST['nohtml'] ) , intval( ! @$_POST['nosmiley'] ) , 1 , @$GLOBALS['xoopsModuleConfig']['xhnewbb_allow_textimg'] ) ; // GIJ
		/*
		$nosmiley = !empty($_POST['nosmiley']) ? 1 : 0;
		$nohtml = !empty($_POST['nohtml']) ? 1 : 0;
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
		themecenterposts($p_subject,$p_message);
		echo "<br />";
		$subject = $myts->makeTboxData4PreviewInForm(@$_POST['subject']);
		$message = $myts->makeTareaData4PreviewInForm(@$_POST['message']);
		$hidden = $myts->makeTboxData4PreviewInForm(@$_POST['hidden']);
		$notify = !empty($_POST['notify']) ? 1 : 0;

		$guestName = $myts->makeTboxData4PreviewInForm(@$_POST['guestName']); // Ryuji_edit(2003-05-06)

		$attachsig = !empty($_POST['attachsig']) ? 1 : 0;
		$icon = preg_match( '/^icon[1-7]\.gif$/' , @$_POST['icon'] ) ? $_POST['icon'] : '' ;
		$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
		$formTitle = _MD_XHNEWBB_FORMTITLEINPREVIEW ;
		include XOOPS_ROOT_PATH.'/modules/xhnewbb/include/forumform.inc.php';
		echo"</td></tr></table>";
	} else {
		include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';
		//Ryuji_edit(2003-05-06)
		if((isset($_POST['message']))&&(!empty ($_POST['guestName']))){
			$_POST['message'] = sprintf(_MD_XHNEWBB_FMT_GUESTSPOSTHEADER,$_POST['guestName']).$_POST['message'];
		}
		
		if ( !empty($post_id) ) {
			$editerror = 0;
			$forumpost = new ForumPosts($post_id);
			if ( $xoopsUser ) {
				if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
					if ($forumpost->islocked() || ($forumpost->uid() != $xoopsUser->getVar("uid") && !xhnewbb_is_moderator($forum, $xoopsUser->getVar("uid")))) {
						$editerror = 1;
					}
				}
			} else {
				$editerror = 1;
			}
			if ( $editerror == 1 ) {
				redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$topic_id."&post_id=".$post_id."&order=".$order."&viewmode=".$viewmode."&pid=".$pid."&forum=".$forum,2,_MD_XHNEWBB_EDITNOTALLOWED);
				exit();
			}
			$editor = $xoopsUser->getVar("uname");
   			$on_date = _MD_XHNEWBB_ON." ".formatTimestamp(time());
			//$message .= "\n\n<small>[ "._MD_XHNEWBB_EDITEDBY." ".$editor." ".$on_date." ]</small>";
		} else {
			$isreply = 0;
			$isnew = 1;
			if ( $xoopsUser && empty($_POST['noname']) ) {
				$uid = $xoopsUser->getVar("uid");
			} else {
				if ( $forumdata['forum_access'] == 2 ) {
					$uid = 0;
				} else {
					if ( !empty($topic_id) ) {
						redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$topic_id."&order=".$order."&viewmode=".$viewmode."&pid=".$pid."&forum=".$forum,2,_MD_XHNEWBB_ANONNOTALLOWED);
					} else {
						redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=".$forum,2,_MD_XHNEWBB_ANONNOTALLOWED);
					}
					exit();
				}
			}
			$forumpost = new ForumPosts();
			$forumpost->setForum($forum);
			if (isset($pid) && $pid != "") {
				$forumpost->setParent($pid);
			}
			if (!empty($topic_id)) {
				$forumpost->setTopicId($topic_id);
				$isreply = 1;
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
		$forumpost->setAttachsig(@$_POST['attachsig']);
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
		if( ! empty( $xoopsModuleConfig['xhnewbb_use_solved'] ) && $uid > 0 ) {
			$xoopsDB->query( "UPDATE ".$xoopsDB->prefix("xhnewbb_users2topics")." SET u2t_marked=1 , u2t_time=".time()." WHERE uid='$uid' AND topic_id='$topic_id'" ) ;
			if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->query( 'INSERT INTO '.$xoopsDB->prefix('xhnewbb_users2topics')." SET uid='$uid',topic_id='$topic_id',u2t_marked=1 , u2t_time=".time() ) ;
		}

		// RMV-NOTIFY
		// Define tags for notification message
		$tags = array();
		$tags['THREAD_NAME'] = $_POST['subject'];
		$tags['THREAD_URL'] = XOOPS_URL . "/modules/" . $xoopsModule->dirname() . "/viewtopic.php?forum=$forum&post_id=$postid&topic_id=" . $forumpost->topic();
		$tags['POST_URL'] = $tags['THREAD_URL'] . '#forumpost' . $postid;
		include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/include/notification.inc.php';
		$forum_info = xhnewbb_notify_iteminfo ('forum', $forum);
		$tags['FORUM_NAME'] = $forum_info['name'];
		$tags['FORUM_URL'] = $forum_info['url'];
		$notification_handler =& xoops_gethandler('notification');
		if (!empty($isnew)) {
			if (empty($isreply)) {
				// Notify of new thread
				$notification_handler->triggerEvent('forum', $forum, 'new_thread', $tags);
			} else {
				// Notify of new post
				$notification_handler->triggerEvent('thread', $topic_id, 'new_post', $tags);
			}
			$notification_handler->triggerEvent('global', 0, 'new_post', $tags);
			$notification_handler->triggerEvent('forum', $forum, 'new_post', $tags);
			$myts =& MyTextSanitizer::getInstance();
			$tags['POST_CONTENT'] = $myts->stripSlashesGPC($_POST['message']);
			$tags['POST_NAME'] = $myts->stripSlashesGPC($_POST['subject']);
			$notification_handler->triggerEvent('global', 0, 'new_fullpost', $tags);
		}

		// If user checked notification box, subscribe them to the
		// appropriate event; if unchecked, then unsubscribe

		if (!empty($xoopsUser) && !empty($xoopsModuleConfig['notification_enabled'])) {
			if (!empty($_POST['notify'])) {
				$notification_handler->subscribe('thread', $forumpost->getTopicId(), 'new_post');
			} else {
				$notification_handler->unsubscribe('thread', $forumpost->getTopicId(), 'new_post');
			}
		}

		if ( $_POST['viewmode'] == "flat" ) {
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$forumpost->topic()."&amp;post_id=".$postid."&amp;order=".$order."&amp;viewmode=flat&amp;pid=".$pid."&amp;forum=".$forum."#forumpost".$postid."",2,_MD_XHNEWBB_THANKSSUBMIT);
			exit();
		} else {
			$post_id = $forumpost->postid();
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$forumpost->topic()."&amp;post_id=".$postid."&amp;order=".$order."&amp;viewmode=thread&amp;pid=".$pid."&amp;forum=".$forum."#forumpost".$postid."",2,_MD_XHNEWBB_THANKSSUBMIT);
			exit();
		}
	}
	include XOOPS_ROOT_PATH.'/footer.php';
}
?>
