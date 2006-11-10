<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;

if( @$_POST['mode'] == 'edit' && ! empty( $_POST['post_id'] ) ) {

	// EDIT
	$post_id = intval( $_POST['post_id'] ) ;

	// get this "post" from given $post_id
	$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_posts")." WHERE post_id=$post_id" ;
	if( ! $prs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
	if( $xoopsDB->getRowsNum( $prs ) <= 0 ) die( _MD_D3FORUM_ERR_READPOST ) ;
	$post_row = $xoopsDB->fetchArray( $prs ) ;
	$topic_id = intval( $post_row['topic_id'] ) ;
	
	// get&check this topic ($topic4assign, $topic_row, $forum_id), count topic_view up, get $prev_topic, $next_topic
	include dirname(dirname(__FILE__)).'/include/process_this_topic.inc.php' ;

	$pid = 0 ;
	$mode = 'edit' ;

} else if( @$_POST['mode'] == 'reply' && ! empty( $_POST['pid'] ) ) {

	// REPLY
	$post_id = intval( $_POST['pid'] ) ;

	// get this "post" from given $post_id
	$sql = "SELECT * FROM ".$xoopsDB->prefix($mydirname."_posts")." WHERE post_id=$post_id" ;
	if( ! $prs = $xoopsDB->query( $sql ) ) die( _MD_D3FORUM_ERR_SQL.__LINE__ ) ;
	if( $xoopsDB->getRowsNum( $prs ) <= 0 ) die( _MD_D3FORUM_ERR_READPOST ) ;
	$post_row = $xoopsDB->fetchArray( $prs ) ;
	$topic_id = intval( $post_row['topic_id'] ) ;
	
	// get&check this topic ($topic4assign, $topic_row, $forum_id), count topic_view up, get $prev_topic, $next_topic
	include dirname(dirname(__FILE__)).'/include/process_this_topic.inc.php' ;

	$pid = $post_id ;
	$mode = 'reply' ;

} else {

	// NEWTOPIC
	$forum_id = intval( @$_POST['forum_id'] ) ;
	$pid = 0 ;
	$mode = 'newtopic' ;

}

// get&check this forum ($forum4assign, $forum_row, $cat_id, $isadminormod), override options
if( ! include dirname(dirname(__FILE__)).'/include/process_this_forum.inc.php' ) die( _MD_D3FORUM_ERR_READFORUM ) ;

// get&check this category ($category4assign, $category_row), override options
if( ! include dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ) die( _MD_D3FORUM_ERR_READCATEGORY ) ;

if( $mode != 'newtopic' ) {
	// get $post4assign
	include dirname(dirname(__FILE__)).'/include/process_this_post.inc.php' ;
}


// Permissions
if( $mode == 'edit' ) {
	// check edit permission
	if( empty( $can_edit ) ) die( _MD_D3FORUM_ERR_EDITPOST ) ;
	if( ! is_object( $xoopsUser ) ) die( _MD_D3FORUM_ERR_EDITPOST ) ; // TODO
	else if( ! $isadminormod && ( $post_row['uid'] != $xoopsUser->getVar('uid') || time() >= $post_row['post_time'] + $xoopsModuleConfig['selfeditlimit'] ) ) die( _MD_D3FORUM_ERR_EDITPOST ) ;
} else if( $mode == 'reply' ) {
	// check reply permission
	if( empty( $can_reply ) ) die( _MD_D3FORUM_ERR_REPLYPOST ) ;
	if( ! $isadminormod && ( $post_row['invisible'] || ! $post_row['approval'] ) ) {
		die( _MD_D3FORUM_ERR_REPLYPOST ) ;
	}
} else {
	// check post permission (new topic)
	if( empty( $can_post ) ) die( _MD_D3FORUM_ERR_POSTFORUM ) ;
	// comment integration
	if( ! empty( $forum_row['forum_external_link_format'] ) ) {
		if( empty( $_POST['external_link_id'] ) ) {
			die( _MD_D3FORUM_ERR_FORUMASCOMMENT ) ;
		} else {
			$external_link_id = intval( $_POST['external_link_id'] ) ;
		}
	}
}


// FETCH request (POST)
$requests_01 = array( 'html' , 'smiley' , 'xcode' , 'br' , 'number_entity' , 'special_entity' , 'attachsig' , 'hide_uid' ) ;
if( $isadminormod ) $requests_01[] = 'invisible' ;
$requests_int = array( 'icon' ) ;
$requests_text = array( 'subject' , 'message' , 'guest_name' , 'guest_email' , 'guest_url' , 'guest_pass' ) ;

// 0/1 flags
foreach( $requests_01 as $key ) {
	$$key = empty( $_POST[$key] ) ? 0 : 1 ;
}
// integer
foreach( $requests_int as $key ) {
	$$key = intval( @$_POST[ $key ] ) ;
}
// text
foreach( $requests_text as $key ) {
	$$key = trim( $myts->stripSlashesGPC( @$_POST[ $key ] ) ) ;
}

// Validations after FETCH
$subject = $subject ? $subject : _NOTITLE ;
if( $icon < 0 || $icon >= sizeof( $d3forum_icon_meanings ) ) $icon = 0 ;
if( empty( $xoopsModuleConfig['allow_html'] ) ) $html = 0 ;
if( empty( $xoopsModuleConfig['allow_sig'] ) ) $allow_sig = 0 ;
if( empty( $xoopsModuleConfig['allow_hideuid'] ) || ! $uid ) $hide_uid = 0 ;


if( !empty($_POST['contents_preview']) ) {

	//
	// PREVIEW
	//

	if( $mode == 'reply' ) {
		// references to post reply
		$reference_message4html = $myts->displayTarea( $post_row['post_text'] , $post_row['html'] , $post_row['smiley'] , $post_row['xcode'] , $xoopsModuleConfig['allow_textimg'] , $post_row['br'] , 0 , $post_row['number_entity'] , $post_row['special_entity'] ) ;
		$reference_time = intval( $post_row['post_time'] ) ;
		if( ! empty( $post_row['guest_name'] ) ) {
			$reference_name4html = htmlspecialchars( $post_row['guest_name'] , ENT_QUOTES ) ;
		} else if( $post_row['uid'] && empty( $post_row['hide_uid'] ) ) {
			$reference_name4html = XoopsUser::getUnameFromId( $post_row['uid'] ) ;
		} else {
			$reference_name4html = $xoopsModuleConfig['anonymous_name'] ;
		}
		$reference_subject4html = $myts->makeTboxData4Show( $post_row['subject'] , $post_row['number_entity'] , $post_row['special_entity'] ) ;
		$quote4html = "[quote sitecite=modules/".$mydirname."/index.php?post_id=".$pid."]\n".sprintf(_MD_D3FORUM_USERWROTE,$reference_name4html)."\n".$myts->makeTareaData4Edit( $post_row['post_text'] , $post_row['number_entity'] )."[/quote]";
	}

	// user's post data
	$preview_subject4html = $myts->makeTboxData4Show( $subject , $number_entity , $special_entity ) ;
	$preview_message4html = $myts->displayTarea( $message , $html , $smiley , $xcode , @$xoopsModuleConfig['allow_textimg'] , $br , 0 , $number_entity , $special_entity ) ;
	$subject4html = $myts->makeTboxData4Edit( $subject , $number_entity ) ;
	$message4html = $myts->makeTareaData4Edit( $message , $number_entity ) ;
	$guest_name4html = $myts->makeTboxData4Edit( $guest_name ) ;
	$guest_email4html = $myts->makeTboxData4Edit( $guest_email ) ;
	$guest_url4html = $myts->makeTboxData4Edit( $guest_url ) ;
	$guest_pass4html = $myts->makeTboxData4Edit( $guest_pass ) ;

	// options
	$notify = empty( $_POST['notify'] ) ? 0 : 1 ;
	$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
	$u2t_marked = empty( $_POST['u2t_marked'] ) ? 0 : 1 ;
	$approval = @$_POST['approval'] || @$post_row['approval'] ;

	$formTitle = _MD_D3FORUM_FORMTITLEINPREVIEW ;
	switch( $mode ) {
		case 'edit' : $formTitle .= ' ('._MD_D3FORUM_EDITMODEC.')' ; break ;
		case 'reply' : $formTitle .= ' ('._MD_D3FORUM_POSTREPLY.')' ; break ;
		case 'newtopic' : $formTitle .= ' ('._MD_D3FORUM_POSTASNEWTOPIC.')' ; break ;
	}
	$ispreview = true ;

	include dirname(dirname(__FILE__)).'/include/display_post_form.inc.php' ;

} else {

	//
	// POST
	//

	require_once dirname(dirname(__FILE__)).'/include/transact_functions.php' ;

	// make set part of INSERT or UPDATE
	$set4sql = "modified_time=UNIX_TIMESTAMP(), modifier_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."'" ;

	foreach( $requests_01 as $key ) {
		$set4sql .= ",$key='".$$key."'" ;
	}
	foreach( $requests_int as $key ) {
		$set4sql .= ",$key='".$$key."'" ;
	}
	/*foreach( $requests_text as $key ) {
		$set4sql .= ",$key='".addslashes($$key)."'" ;
	}*/
	$set4sql .= ",subject='".addslashes($subject)."'" ;
	$set4sql .= ",post_text='".addslashes($message)."'" ;

	// guest's post
	if( $mode != 'edit' && $uid == 0 || $mode == 'edit' && $post_row['uid'] == 0 ) {
		@list( $guest_name , $trip_base ) = explode( '#' , $guest_name , 2 ) ;
		if( ! trim( @$guest_name ) ) $guest_name = $xoopsModuleConfig['anonymous_name'] ;
		if( ! empty( $trip_base ) && function_exists( 'crypt' ) ) {
			$salt = strtr( preg_replace( '[^\.-z]' , '.' , substr( $trip_base . 'H.' , 1 , 2 ) ) , ':;<=>?@[\]^_`' , 'ABCDEFGabcdef' ) ;
			$guest_trip = substr( crypt( $trip_base , $salt ) , -10 ) ;
		} else {
			$guest_trip = '' ;
		}
		foreach( array('guest_name','guest_email','guest_url','guest_trip') as $key ) {
			$set4sql .= ",$key='".addslashes($$key)."'" ;
		}
		if( ! empty( $guest_pass ) ) {
			$set4sql .= ",guest_pass_md5='".md5($guest_pass.'d3forum')."'" ;
		}
	}

	if( $mode == 'edit' ) {
		// edit

		// approval
		if( $isadminormod ) {
			if( ! empty( $_POST['approval'] ) && empty( $post_row['approval'] ) ) {
				$set4sql .= ',approval=1' ;
				$need_notify = true ;
			}
		} else if( ! $forum_permissions[$forum_id]['post_auto_approved'] ) {
			// approval never turned off by edit
			$set4sql .= ',invisible=1' ;
			$need_admin_notify = true ;
		}
		// update post specified post_id
		if( ! $xoopsDB->query( "UPDATE ".$xoopsDB->prefix($mydirname."_posts")." SET $set4sql WHERE post_id=$post_id" ) ) die( "DB ERROR IN UPDATE post" ) ;
		d3forum_sync_topic( $mydirname , $topic_id , true , ! (boolean)$post_row['pid'] ) ;
	} else if( $mode == 'reply' ) {
		// reply

		// approval
		if( $forum_permissions[$forum_id]['post_auto_approved'] ) {
			$set4sql .= ',approval=1' ;
			$need_notify = true ;
		} else {
			$set4sql .= ',approval=0' ;
			$need_admin_notify = true ;
		}
		// create post under specified post_id
		if( ! $xoopsDB->query( "INSERT INTO ".$xoopsDB->prefix($mydirname."_posts")." SET $set4sql,pid=$pid,topic_id=$topic_id,post_time=UNIX_TIMESTAMP(),poster_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',uid='$uid'" ) ) die( "DB ERROR IN INSERT post" ) ;
		$post_id = $xoopsDB->getInsertId() ;
		d3forum_sync_topic( $mydirname , $topic_id ) ;
	} else {
		// newtopic

		// approval
		if( $forum_permissions[$forum_id]['post_auto_approved'] ) {
			$set4sql .= ',approval=1' ;
			$topic_invisible = 0 ;
			$need_notify = true ;
		} else {
			$set4sql .= ',approval=0' ;
			$topic_invisible = 1 ;
			$need_admin_notify = true ;
		}
		// create topic and get a new topic_id
		if( ! $xoopsDB->query( "INSERT INTO ".$xoopsDB->prefix($mydirname."_topics")." SET forum_id=$forum_id,topic_invisible=$topic_invisible,topic_external_link_id=".intval(@$external_link_id) ) ) die( "DB ERROR IN INSERT topic" ) ;
		$topic_id = $xoopsDB->getInsertId() ;
		// create post in the topic
		if( ! $xoopsDB->query( "INSERT INTO ".$xoopsDB->prefix($mydirname."_posts")." SET $set4sql,topic_id=$topic_id,post_time=UNIX_TIMESTAMP(),poster_ip='".addslashes(@$_SERVER['REMOTE_ADDR'])."',uid='$uid'" ) ) die( "DB ERROR IN INSERT post" ) ;
		$post_id = $xoopsDB->getInsertId() ;
		d3forum_sync_topic( $mydirname , $topic_id , true , true ) ;
	}


	// increment post
	if( is_object( @$xoopsUser ) && $mode != 'edit' ) {
		$xoopsUser->incrementPost() ;
	}

	// set u2t_marked
	if( $uid && @$xoopsModuleConfig['allow_mark'] ) {
		$u2t_marked = empty( $_POST['u2t_marked'] ) ? 0 : 1 ;
		$xoopsDB->query( "UPDATE ".$xoopsDB->prefix($mydirname."_users2topics")." SET u2t_marked=$u2t_marked,u2t_time=UNIX_TIMESTAMP() WHERE uid=$uid AND topic_id=$topic_id" ) ;
		if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->query( "INSERT INTO ".$xoopsDB->prefix($mydirname."_users2topics")." SET uid=$uid,topic_id=$topic_id,u2t_marked=$u2t_marked,u2t_time=UNIX_TIMESTAMP()" ) ;
	}

	// Define tags for notification message
	$tags = array(
		'POSTER_UNAME' => $uid > 0 ? $xoopsUser->getVar('uname') :  $guest_name ,

		'POST_TITLE' => $subject ,
		'POST_BODY' => $message ,
		'POST_URL' => XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" ,
		'TOPIC_TITLE' => @$topic_row['topic_title'] ,
		'TOPIC_URL' => XOOPS_URL."/modules/$mydirname/index.php?topic_id=$topic_id" ,
		'FORUM_TITLE' => $forum_row['forum_title'] ,
		'FORUM_URL' => XOOPS_URL."/modules/$mydirname/index.php?forum_id=$forum_id" ,
		'CAT_TITLE' => $cat_row['cat_title'] ,
		'CAT_URL' => XOOPS_URL."/modules/$mydirname/index.php?cat_id=$cat_id" ,
	) ;

	$notification_handler =& xoops_gethandler('notification') ;
	$users2notify = get_users_can_read_forum( $mydirname , $forum_id , $cat_id ) ;
	if( empty( $users2notify ) ) $users2notify = array( 0 ) ;

	if( ! empty( $need_notify ) ) {
		if( $mode == 'newtopic' ) {
			// Notify for newtopic
			d3forum_trigger_event( 'global' , 0 , 'newtopic' , $tags , $users2notify ) ;
			d3forum_trigger_event( 'category' , $cat_id , 'newtopic' , $tags , $users2notify ) ;
			d3forum_trigger_event( 'forum' , $forum_id , 'newtopic' , $tags , $users2notify ) ;
		}
		// Notify for newpost
		d3forum_trigger_event( 'global' , 0 , 'newpost' , $tags , $users2notify ) ;
		d3forum_trigger_event( 'category' , $cat_id , 'newpost' , $tags , $users2notify ) ;
		d3forum_trigger_event( 'forum' , $forum_id , 'newpost' , $tags , $users2notify ) ;
		d3forum_trigger_event( 'topic' , $topic_id , 'newpost' , $tags , $users2notify ) ;
		// special event (the meaning of "ALL&FULL POSTS" contains self-post)
		d3forum_trigger_event( 'global' , 0 , 'newpostfull' , $tags , $users2notify , 0 ) ;
	}

	if( ! empty( $need_admin_notify ) ) {
		// Notify for new waiting approval
		d3forum_trigger_event( 'global' , 0 , 'waiting' , $tags , $users2notify ) ;
	}

	// If user checked notification box, subscribe them to the
	// appropriate event; if unchecked, then unsubscribe
	if( ! empty( $xoopsUser ) && ! empty( $xoopsModuleConfig['notification_enabled']) && in_array( 'topic-newpost' , @$xoopsModuleConfig['notification_events'] ) ) {
		if (!empty($_POST['notify'])) {
			$notification_handler->subscribe( 'topic', $topic_id , 'newpost' ) ;
		} else {
			$notification_handler->unsubscribe( 'topic', $topic_id , 'newpost' ) ;
		}
	}

	// topic_solved of the topic
	if( ! empty( $xoopsModuleConfig['use_solved'] ) ) {
		if( $isadminormod ) {
			// adminormod can turn "solved" both on and off
			$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
			$xoopsDB->query( "UPDATE ".$xoopsDB->prefix($mydirname."_topics")." SET topic_solved=$solved WHERE topic_id=$topic_id" ) ;
		} else if( $mode != 'edit' ) {
			// normal's post will be forced to turn solved off
			$xoopsDB->query( "UPDATE ".$xoopsDB->prefix($mydirname."_topics")." SET topic_solved=0 WHERE topic_id=$topic_id" ) ;
		}
	}

	$redirect_message = $mode == 'edit' ? _MD_D3FORUM_MSG_THANKSEDIT : _MD_D3FORUM_MSG_THANKSPOST ;
	if( substr( $forum_row['forum_external_link_format'] , 0 , 11 ) == '{XOOPS_URL}' && ! empty( $external_link_id ) ) {
		redirect_header( sprintf( str_replace( '{XOOPS_URL}' , XOOPS_URL , $forum_row['forum_external_link_format'] ) , $external_link_id ) , 2 , $redirect_message ) ;
	} else {
		redirect_header( XOOPS_URL."/modules/$mydirname/index.php?post_id=$post_id" , 2 , $redirect_message ) ;
	}
	exit ;
}

?>