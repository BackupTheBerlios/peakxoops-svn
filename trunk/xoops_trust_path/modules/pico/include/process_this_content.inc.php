<?php

// $content_id check
if( empty( $content_id ) ) {
	redirect_header( XOOPS_URL.'/' , 2 , _MD_PICO_ERR_READCONTENT ) ;
	exit ;
}

// permission check "can_readfull"
if( empty( $category_permissions[$cat_id]['can_readfull'] ) ) {
	if( is_object( $xoopsUser ) ) {
		redirect_header( XOOPS_URL.'/' , 2 , _MD_PICO_ERR_PERMREADFULL ) ;
	} else {
		redirect_header( XOOPS_URL.'/user.php' , 2 , _MD_PICO_ERR_LOGINTOREADFULL ) ;
	}
	exit ;
}

// visible check
//$whr4visible = $isadminormod ? '1' : 'o.visible' ;
$whr4visible = 'o.visible' ;

// get this "content" from given $content_id
$sql = "SELECT o.*,up.uname AS poster_uname,um.uname AS modifier_uname FROM ".$db->prefix($mydirname."_contents")." o LEFT JOIN ".$db->prefix("users")." up ON o.poster_uid=up.uid LEFT JOIN ".$db->prefix("users")." um ON o.modifier_uid=um.uid WHERE o.content_id='$content_id' AND ($whr4visible)" ;
if( ! $ors = $db->query( $sql ) ) die( _MD_PICO_ERR_SQL.__LINE__ ) ;
if( $db->getRowsNum( $ors ) <= 0 ) {
	redirect_header( XOOPS_URL."/modules/$mydirname/index.php" , 2 , _MD_PICO_ERR_READCONTENT ) ;
	exit ;
}
$content_row = $db->fetchArray( $ors ) ;

// body/filter/cache
if( $content_row['use_cache'] ) {
	if( $content_row['body_cached'] ) {
		$body4assign = $content_row['body_cached'] ;
	} else {
		$body4assign = pico_filter_body( $mydirname , $content_row ) ;
		$db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET body_cached='".addslashes($body4assign)."' WHERE content_id='$content_id'" ) ;
	}
} else {
	$body4assign = pico_filter_body( $mydirname , $content_row ) ;
}

// assigning
$content4assign = array(
	'id' => intval( $content_row['content_id'] ) ,
	'link' => pico_make_content_link4html( $xoopsModuleConfig , $content_row ) ,
	'created_time_formatted' => formatTimestamp( $content_row['created_time'] ) ,
	'modified_time_formatted' => formatTimestamp( $content_row['modified_time'] ) ,
	'poster_uname' => $myts->makeTboxData4Show( $content_row['poster_uname'] ) ,
	'modifier_uname' => $myts->makeTboxData4Show( $content_row['modifier_uname'] ) ,
	'votes_avg' => $content_row['votes_count'] ? $content_row['votes_sum'] / doubleval( $content_row['votes_count'] ) : 0 ,
	'subject' => $myts->makeTboxData4Show( $content_row['subject'] ) ,
	'body' => $body4assign ,
	'can_edit' => $category4assign['can_edit'] ,
	'can_vote' => ( $uid || $xoopsModuleConfig['guest_vote_interval'] ) ? true : false ,
) ;
$content4assign += $content_row ;

// get next content of the category
$next_content_row = $xoopsDB->fetchArray( $xoopsDB->query( "SELECT content_id,vpath,subject FROM ".$xoopsDB->prefix($mydirname."_contents")." o WHERE (weight>".$content_row['weight']." OR content_id>$content_id AND weight=".$content_row['weight'].") AND cat_id=$cat_id AND ($whr4visible) AND show_in_navi ORDER BY weight,content_id LIMIT 1" ) ) ;
if( empty( $next_content_row ) ) {
	$next_content4assign = array() ;
} else {
	$next_content4assign = array(
		'id' => $next_content_row['content_id'] ,
		'link' => pico_make_content_link4html( $xoopsModuleConfig , $next_content_row ) ,
		'subject' => $myts->makeTboxData4Show( $next_content_row['subject'] ) ,
	) ;
}

// get prev content of the category
$prev_content_row = $xoopsDB->fetchArray( $xoopsDB->query( "SELECT content_id,vpath,subject FROM ".$xoopsDB->prefix($mydirname."_contents")." o WHERE (weight<".$content_row['weight']." OR content_id<$content_id AND weight=".$content_row['weight'].") AND cat_id=$cat_id AND ($whr4visible) AND show_in_navi ORDER BY weight DESC,content_id DESC LIMIT 1" ) ) ;
if( empty( $prev_content_row ) ) {
	$prev_content4assign = array() ;
} else {
	$prev_content4assign = array(
		'id' => $prev_content_row['content_id'] ,
		'link' => pico_make_content_link4html( $xoopsModuleConfig , $prev_content_row ) ,
		'subject' => $myts->makeTboxData4Show( $prev_content_row['subject'] ) ,
	) ;
}

// make link for "tell to a friend"
if( $xoopsModuleConfig['use_taf_module'] ) {
	$content4assign['tellafriend_uri'] = XOOPS_URL.'/modules/tellafriend/index.php?target_uri='.rawurlencode( XOOPS_URL."/modules/$mydirname/".pico_make_content_link4html( $xoopsModuleConfig , $content_row ) ).'&amp;subject='.rawurlencode(sprintf(_MD_PICO_FMT_TELLAFRIENDSUBJECT,$xoopsConfig['sitename'])) ;
} else {
	$content4assign['tellafriend_uri'] = 'mailto:?subject='.pico_escape4mailto(sprintf(_MD_PICO_FMT_TELLAFRIENDSUBJECT,$xoopsConfig['sitename'])).'&amp;body='.pico_escape4mailto(sprintf(_MD_PICO_FMT_TELLAFRIENDBODY, $content_row['subject'])).'%0A'.XOOPS_URL."/modules/$mydirname/".rawurlencode(pico_make_content_link4html( $xoopsModuleConfig , $content_row )) ;
}

// count up 'viewed'
$db->queryF( "UPDATE ".$db->prefix($mydirname."_contents")." SET viewed=viewed+1 WHERE content_id='$content_id'" ) ;


?>