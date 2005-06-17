<?php
// $Id: reply.php,v 1.3 2005/02/10 19:04:21 gij Exp $
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
	${$getint} = isset($_GET[$getint]) ? intval($_GET[$getint]) : 0;
}
$viewmode = (isset($_GET['viewmode']) && $_GET['viewmode'] != 'flat') ? 'thread' : 'flat';
if ( empty($forum) ) {
	redirect_header(XOOPS_URL."/modules/xhnewbb/index.php", 2, _MD_XHNEWBB_ERRORFORUM);
	exit();
} elseif ( empty($topic_id) ) {
	redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum", 2, _MD_XHNEWBB_ERRORTOPIC);
	exit();
} elseif ( empty($post_id) ) {
	redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&order=$order&viewmode=$viewmode&pid=$pid&forum=$forum", 2, _MD_XHNEWBB_ERRORPOST);
	exit();
} else {
	if ( xhnewbb_is_locked($topic_id) ) {
		redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&order=$order&viewmode=$viewmode&pid=$pid&forum=$forum", 2, _MD_XHNEWBB_TOPICLOCKED);
		exit();
	}
	$sql = "SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id = $forum";
	if ( !$result = $xoopsDB->query($sql) ) {
		redirect_header(XOOPS_URL."/modules/xhnewbb/index.php",1,_MD_XHNEWBB_ERROROCCURED);
		exit();
	}
	$forumdata = $xoopsDB->fetchArray($result);
	$myts =& MyTextSanitizer::getInstance();
	if ( $forumdata['forum_type'] == 1 ) {
		// To get here, we have a logged-in user. So, check whether that user is allowed to post in
		// this private forum.
		$accesserror = 0; //initialize
		if ( $xoopsUser ) {
			if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
				if ( !xhnewbb_check_priv_forum_auth($xoopsUser->uid(), $forum, true) ) {
					$accesserror = 1;
				}
			}
		} else {
			$accesserror = 1;
		}
		if ( $accesserror == 1 ) {
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&post_id=$post_id&order=$order&viewmode=$viewmode&pid=$pid&forum=$forum",2,_MD_XHNEWBB_NORIGHTTOPOST);
			exit();
		}
		// Ok, looks like we're good.
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
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&post_id=$post_id&order=$order&viewmode=$viewmode&pid=$pid&forum=$forum",2,_MD_XHNEWBB_NORIGHTTOPOST);
			exit();
		}
    }
	include XOOPS_ROOT_PATH.'/header.php';
	include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';
	$forumpost = new ForumPosts($post_id);
	$r_message = $forumpost->text();
	$r_date = formatTimestamp($forumpost->posttime());
	$r_name = ($forumpost->uid() != 0) ? XoopsUser::getUnameFromId($forumpost->uid()) : $xoopsConfig['anonymous'];
	$r_content = _MD_XHNEWBB_BY." ".$r_name." "._MD_XHNEWBB_ON." ".$r_date."<br /><br />";
	$r_content .= $r_message;
	$r_subject=$forumpost->subject();
	if (!preg_match("/^Re:/i",$r_subject)) {
		$subject = 'Re: '.$myts->htmlSpecialChars($r_subject);
	} else {
		$subject = $myts->htmlSpecialChars($r_subject);
	}
	$q_message = $forumpost->text("Quotes");
	$hidden = "[quote]\n";
	$hidden .= sprintf(_MD_XHNEWBB_USERWROTE,$r_name);
	$hidden .= "\n".$q_message."[/quote]";
	$message = "";
	themecenterposts($r_subject,$r_content);
	echo "<br />";
	$pid=$post_id;
	unset($post_id);
	$topic_id=$forumpost->topic();
	$forum=$forumpost->forum();
	$isreply =1;
	$istopic = 0;
	include XOOPS_ROOT_PATH.'/modules/xhnewbb/include/forumform.inc.php';
	include XOOPS_ROOT_PATH.'/footer.php';
}
?>