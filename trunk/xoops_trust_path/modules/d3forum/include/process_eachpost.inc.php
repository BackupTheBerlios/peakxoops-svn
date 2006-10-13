<?php

	// can_vote
	$can_vote = ( $uid || $xoopsModuleConfig['guest_vote_interval'] ) ? true : false ;

	// invisible
	if( $post_row['invisible'] || ! $post_row['approval'] ) {
		if( $isadminormod ) {
			// $post_row['icon'] = $post_row['approval'] ? 8 : 9 ;
		} else {
			$post_row['subject'] = $post_row['post_text'] = $post_row['guest_name'] = $post_row['approval'] ? _MD_D3FORUM_ALT_INVISIBLE : _MD_D3FORUM_ALT_UNAPPROVAL ;
			$post_row['uid'] = $post_row['icon'] = $post_row['attachsig'] = 0 ;
			$post_row['guest_email'] = $post_row['guest_url'] = $post_row['guest_trip'] = $post_row['poster_ip'] = $post_row['modifier_ip'] = '' ;
			$can_vote = false ;
		}
	}

	// get this poster's object
	$user_handler =& xoops_gethandler( 'user' ) ;
	$poster_obj =& $user_handler->get( intval( $post_row['uid'] ) ) ;
	if( is_object( $poster_obj ) && ! $post_row['hide_uid'] ) {
		// active user's post
		$poster_uname4disp = $poster_obj->getVar( 'uname' ) ;
		$poster_regdate = $poster_obj->getVar( 'user_regdate' ) ;
		$poster_from4disp = $myts->makeTboxData4Show( $poster_obj->getVar( 'user_from' ) ) ;
		$poster_rank = $poster_obj->rank() ;
		$poster_rank_title4disp = htmlspecialchars( @$poster_rank['title'] , ENT_QUOTES ) ;
		$poster_rank_image4disp = htmlspecialchars( @$poster_rank['image'] , ENT_QUOTES ) ;
		$poster_is_online = $poster_obj->isOnline() ;
		$poster_avatar4disp = htmlspecialchars( $poster_obj->getVar( 'user_avatar' ) , ENT_QUOTES ) ;
		$poster_posts_count = intval( $poster_obj->getVar( 'posts' ) ) ;

		// signature
		if( $xoopsModuleConfig['allow_sig'] && $post_row['attachsig'] ) {
			$signature4disp = $myts->displayTarea( $poster_obj->getVar('user_sig', 'N'), 0, 1, 1, $xoopsModuleConfig['allow_sigimg'] ) ;
		} else {
			$signature4disp = '' ;
		}

		// permissions
		$can_reply = ( $topic_row['topic_locked'] || $post_row['invisible'] || ! $post_row['approval'] ) ? false : $can_post ;
		if( $isadminormod ) {
			$can_edit = true ;
			$can_delete = true ;
		} else if( $post_row['uid'] == $uid ) {
			$can_edit = $can_edit && time() < $post_row['post_time'] + $xoopsModuleConfig['selfeditlimit'] ? true : false ;
			$can_delete = $can_delete && time() < $post_row['post_time'] + $xoopsModuleConfig['selfdellimit'] ? true : false ;
			$can_delete = false ;
		} else {
			$can_edit = false ;
			$can_delete = false ;
		}
	} else {
		// guest or quitted or hidden user's post
		$poster_uname4disp = empty( $post_row['guest_name'] ) ? $xoopsModuleConfig['anonymous_name'] : htmlspecialchars( $post_row['guest_name'] , ENT_QUOTES ) ;
		$poster_regdate = $post_row['post_time'] ;
		$poster_from4disp = '' ;
		$poster_rank_title4disp = '' ;
		$poster_rank_image4disp = '' ;
		$poster_is_online = false ;
		$poster_avatar4disp = '' ;
		$poster_posts_count = 0 ;

		// signature
		$signature4disp = '' ;

		// permissions
		$can_reply = ( $topic_row['topic_locked'] || $post_row['invisible'] || ! $post_row['approval'] ) ? false : $can_post ;
		if( $isadminormod ) {
			$can_edit = true ;
			$can_delete = true ;
		} else {
			$can_edit = false ;
			$can_delete = false ;
		}
	}

	// tree structure (ul & tree_address)
	$depth_diff = $post_row['depth_in_tree'] - @$previous_depth ;
	$previous_depth = $post_row['depth_in_tree'] ;
	$ul_in = $ul_out = '' ;
	if( $depth_diff > 0 ) {
		for( $i = 0 ; $i < $depth_diff ; $i ++ ) {
			$ul_in .= '<ul type="none" class="eachbranch">' ;
			$tree_addresses[] = 1 ;
		}
	} else {
		if( $depth_diff < 0 ) {
			for( $i = 0 ; $i < - $depth_diff ; $i ++ ) {
				$ul_out .= '</ul>' ;
				array_pop( $tree_addresses ) ;
			}
		}
		@$tree_addresses[ sizeof( $tree_addresses ) - 1 ] ++ ;
	}

?>