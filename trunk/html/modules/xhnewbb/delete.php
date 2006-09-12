<?php

include dirname(__FILE__).'/include/common_prepend.php';

$post = new ForumPosts( intval( @$_GET['post_id'] ) ) ;
$post_id = $post->postid() ;
if( empty( $post_id ) ) {
	die( _MD_XHNEWBB_ERRORPOST ) ;
}

$topic_id = $post->topic() ;
$forum = $post->forum() ;
$uid = $xoopsUser->getVar('uid') ;

// count children
include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
$mytree = new XoopsTree( $xoopsDB->prefix("xhnewbb_posts") , "post_id" , "pid" ) ;
$children_count = count( $mytree->getAllChild( $post_id ) ) ;

if( ! is_object( @$xoopsUser ) ) die( _MD_XHNEWBB_DELNOTALLOWED ) ;

if( $xoopsUser->isAdmin() || xhnewbb_is_moderator( $forum , $uid ) ) {
	// moderator delelete
	$isadminormod = true ;
} else if( $uid == $post->uid() && $xoopsModuleConfig['xhnewbb_selfdellimit'] > 0 ) {
	// self delete
	if( time() < $post->posttime() + intval( $xoopsModuleConfig['xhnewbb_selfdellimit'] ) ) {
		// before time limit
		include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
		$mytree = new XoopsTree( $xoopsDB->prefix("xhnewbb_posts") , "post_id" , "pid" ) ;
		if( $children_count ) {
			// child(ren) exist(s)
			redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order" , 2 , _MD_XHNEWBB_DELCHILDEXISTS ) ;
			exit ;
		} else {
			// all green for self delete
			$isadminormod = false ;
		}
	} else {
		// after time limit
		redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order" , 2 , _MD_XHNEWBB_DELTIMELIMITED ) ;
		exit ;
	}
} else {
	// no perm
	die( _MD_XHNEWBB_DELNOTALLOWED ) ;
}


if( ! empty( $_POST['ok'] ) ) {
	$post->delete() ;
	xhnewbb_sync( $post->forum() , "forum" ) ;
	xhnewbb_sync( $post->topic() , "topic" ) ;

	if( $post->istopic() ) {
		redirect_header( XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum" , 2 , _MD_XHNEWBB_POSTSDELETED ) ;
		exit ;
	} else {
		redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order" , 2 , _MD_XHNEWBB_POSTSDELETED ) ;
		exit ;
	}
} else {
	include XOOPS_ROOT_PATH."/header.php";
	xoops_confirm( array( 'ok' => 1 ) , "?post_id=$post_id&viewmode=$viewmode&order=$order" , $children_count ? _MD_XHNEWBB_AREUSUREDEL : _MD_XHNEWBB_AREUSUREDELONE ) ;

	$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) , "xoops_pagetitle" => _DELETE ) ) ;


	include XOOPS_ROOT_PATH.'/footer.php';
}

?>