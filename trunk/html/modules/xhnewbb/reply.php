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
include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';

$forumpost = new ForumPosts( intval( @$_GET['post_id'] ) ) ;
$post_id = $forumpost->postid() ;
if( empty( $post_id ) ) {
	die(_MD_XHNEWBB_ERRORPOST);
}
$topic_id = $forumpost->topic() ;
$forum = $forumpost->forum() ;

// parent id
$pid = isset( $_GET['pid'] ) ? intval( $_GET['pid'] ) : 0 ;

// lock check
if ( xhnewbb_is_locked($topic_id) ) {
	die(_MD_XHNEWBB_TOPICLOCKED);
}

$sql = "SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id = $forum";
if ( !$result = $xoopsDB->query($sql) ) {
	die(_MD_XHNEWBB_ERROROCCURED);
}
$forumdata = $xoopsDB->fetchArray($result);
$myts =& MyTextSanitizer::getInstance();

// CHECK ACCESS RIGHTS BY FORUM TYPE 
if ( $forumdata['forum_type'] == 1 ) {
	// To get here, we have a logged-in user. So, check whether that user is allowed to post in
	// this private forum.
	$accesserror = 0; //initialize
	if ( $xoopsUser ) {
		if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
			if ( !xhnewbb_check_priv_forum_post($xoopsUser->uid(), $forum) ) {
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

$reference_message4html = $forumpost->text('Show');
$reference_date4html = formatTimestamp( $forumpost->posttime() ) ;
$reference_name4html = $forumpost->uid() ? XoopsUser::getUnameFromId( $forumpost->uid() ) : $xoopsConfig['anonymous'] ;
//$r_content = _MD_XHNEWBB_BY." ".$r_name." "._MD_XHNEWBB_ON." ".$r_date."<br /><br />"; */

$reference_subject4html = $forumpost->subject('Show');

if( ! preg_match( '/^Re:/i' , $reference_subject4html ) ) {
	$subject4html = 'Re: '. $reference_subject4html ;
} else {
	$subject4html = $reference_subject4html ;
}
$message4html = "" ;
$quote4html = "[quote]\n".sprintf(_MD_XHNEWBB_USERWROTE,$reference_name4html)."\n".$forumpost->text("Quotes")."[/quote]";
// themecenterposts($r_subject,$r_content);
//echo "<br />";
$pid = $post_id ;
$post_id = 0 ;
$topic_id = $forumpost->topic() ;
$forum = $forumpost->forum() ;
$u2t_marked = $forumpost->u2t_marked() ;
$isreply =1 ;
$formTitle = _MD_XHNEWBB_REPLY ;
$mode = 'reply' ;

include XOOPS_ROOT_PATH.'/modules/xhnewbb/include/forumform.inc.php';

$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".XOOPS_URL."/modules/xhnewbb/index.css\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) , "xoops_pagetitle" => $formTitle ) ) ;

include XOOPS_ROOT_PATH.'/footer.php';
?>