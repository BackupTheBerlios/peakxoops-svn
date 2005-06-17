<?php
// $Id: delete.php,v 1.3 2005/02/10 19:04:21 gij Exp $
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

$forum = isset($_REQUEST['forum']) ? intval($_REQUEST['forum']) : 0;
$post_id = isset($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : 0;
$topic_id = isset($_REQUEST['topic_id']) ? intval($_REQUEST['topic_id']) : 0;
$order = isset($_REQUEST['order']) ? intval($_REQUEST['order']) : 0;
$viewmode = @$_REQUEST['viewmode'] != 'flat' ? 'thread' : 'flat';
if ( empty($forum) ) {
	redirect_header( XOOPS_URL."/modules/xhnewbb/index.php", 2, _MD_XHNEWBB_ERRORFORUM);
	exit();
} elseif ( empty($post_id) ) {
	redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum", 2, _MD_XHNEWBB_ERRORPOST);
	exit();
}

if ( $xoopsUser ) {
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		if ( !xhnewbb_is_moderator($forum, $xoopsUser->uid()) ) {
			redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&order=$order&viewmode=$viewmode&forum=$forum", 2, _MD_XHNEWBB_DELNOTALLOWED);
			exit();
		}
	}
} else {
	redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&order=$order&viewmode=$viewmode&forum=$forum", 2, _MD_XHNEWBB_DELNOTALLOWED);
	exit();
}

include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';

if ( !empty($_POST['ok']) ) {
	if ( !empty($post_id) ) {
		$post = new ForumPosts($post_id);
		$post->delete();
		xhnewbb_sync($post->forum(), "forum");
		xhnewbb_sync($post->topic(), "topic");
	}
	if ( $post->istopic() ) {
		redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum", 2, _MD_XHNEWBB_POSTSDELETED);
		exit();
	} else {
		redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&order=$order&viewmode=$viewmode&forum=$forum", 2, _MD_XHNEWBB_POSTSDELETED);
		exit();
	}
} else {
	include XOOPS_ROOT_PATH."/header.php";
	xoops_confirm(array('post_id' => $post_id, 'viewmode' => $viewmode, 'order' => $order, 'forum' => $forum, 'topic_id' => $topic_id, 'ok' => 1), XOOPS_URL."/modules/xhnewbb/delete.php", _MD_XHNEWBB_AREUSUREDEL);
}
include XOOPS_ROOT_PATH.'/footer.php';
?>