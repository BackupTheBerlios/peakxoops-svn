<?php
// $Id: newtopic.php,v 1.3 2005/02/10 19:04:21 gij Exp $
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

$forum = intval( @$_GET['forum'] ) ;

if ( empty($forum) ) {
	die(_MD_XHNEWBB_ERRORFORUM);
}


$sql = "SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id = $forum";
if ( !$result = $xoopsDB->query($sql) ) {
	die(_MD_XHNEWBB_ERROROCCURED);
}
$forumdata = $xoopsDB->fetchArray($result);
if ( $forumdata['forum_type'] == 1 ) {
	// To get here, we have a logged-in user. So, check whether that user is allowed to post in
	// this private forum.
	$accesserror = 0; //initialize
	if ( $xoopsUser ) {
		//check if the user has forum admin right
		if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
			if ( !xhnewbb_check_priv_forum_post($xoopsUser->uid(), $forum ) ) {
				$accesserror = 1;
			}
		}
	} else {
		$accesserror = 1;
	}
	if ( $accesserror == 1 ) {
		die(_MD_XHNEWBB_NORIGHTTOPOST);
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
		die(_MD_XHNEWBB_NORIGHTTOPOST);
	}
}
include XOOPS_ROOT_PATH.'/header.php';
$istopic = 1;
$pid=0;
$subject = "";
$message = "";
$myts =& MyTextSanitizer::getInstance();
$hidden = "";
$post_id = 0;
$topic_id = 0;
$formTitle = _MD_XHNEWBB_POST ;
include XOOPS_ROOT_PATH.'/modules/xhnewbb/include/forumform.inc.php';
include XOOPS_ROOT_PATH.'/footer.php';

?>