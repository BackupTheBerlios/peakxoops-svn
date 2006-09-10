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
include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';

$post = new ForumPosts( intval( @$_GET['post_id'] ) ) ;
$post_id = $post->postid() ;
if( empty( $post_id ) ) {
	die(_MD_XHNEWBB_ERRORPOST);
}

$topic_id = $post->topic() ;
$forum = $post->forum() ;

$viewmode = in_array( @$_GET['viewmode'] , array( 'flat' , 'thread' ) ) ? $_GET['viewmode'] : '' ;
$order = in_array( @$_GET['order'] , array( 'ASC' , 'DESC' ) ) ? $_GET['order'] : '' ;


if ( $xoopsUser ) {
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		if ( !xhnewbb_is_moderator($forum, $xoopsUser->uid()) ) {
			die(_MD_XHNEWBB_DELNOTALLOWED);
			exit();
		}
	}
} else {
	die(_MD_XHNEWBB_DELNOTALLOWED);
}


if ( !empty($_POST['ok']) ) {
	$post->delete();
	xhnewbb_sync($post->forum(), "forum");
	xhnewbb_sync($post->topic(), "topic");

	if ( $post->istopic() ) {
		redirect_header(XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum", 2, _MD_XHNEWBB_POSTSDELETED);
		exit ;
	} else {
		redirect_header(XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order", 2, _MD_XHNEWBB_POSTSDELETED);
		exit ;
	}
} else {
	include XOOPS_ROOT_PATH."/header.php";
	xoops_confirm(array('ok' => 1), "?post_id=$post_id&viewmode=$viewmode&order=$order", _MD_XHNEWBB_AREUSUREDEL);

	$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".XOOPS_URL."/modules/xhnewbb/index.css\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) , "xoops_pagetitle" => _DELETE ) ) ;

	include XOOPS_ROOT_PATH.'/footer.php';
}
?>