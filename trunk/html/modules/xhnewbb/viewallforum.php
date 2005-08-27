<?php
// $Id: viewallforum.php,v 1.8 2005/02/10 19:04:21 gij Exp $
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

include "header.php";

$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

// updating u2t_marked
if( $uid > 0 && ! empty( $_POST['update_mark'] ) && ! empty( $_POST['topic_ids'] ) ) {
	foreach( $_POST['topic_ids'] as $topic_id ) {
		$topic_id = intval( $topic_id ) ;
		$mark_value = empty( $_POST['marked'][$topic_id] ) ? 0 : 1 ;
		$xoopsDB->query( "UPDATE ".$xoopsDB->prefix("xhnewbb_users2topics")." SET u2t_marked=$mark_value WHERE uid='$uid' AND topic_id='$topic_id'" ) ;
		if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->query( 'INSERT INTO '.$xoopsDB->prefix('xhnewbb_users2topics')." SET uid='$uid',topic_id='$topic_id',u2t_marked=$mark_value" ) ;
	}

	redirect_header( XOOPS_URL."/modules/xhnewbb/viewallforum.php" , 0 , _MD_XHNEWBB_UPDATED ) ;
}

// updating topic_solved
if( $uid > 0 && ! empty( $_GET['flip_solved'] ) && ! empty( $_GET['topic_id'] ) && ( $xoopsUser->isAdmin() || xhnewbb_is_moderator( $myrow['forum_id'] , $uid ) ) ) {
	$xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix("xhnewbb_topics")." SET topic_solved = ! topic_solved WHERE topic_id=".intval($_GET['topic_id']) ) ;
	if( ! headers_sent() ) {
		header( "Location: ".XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=".@$_GET['solved']."&sortname=".@$_GET['sortname']."&sortorder=".@$_GET['sortorder']."&sortsince=".intval(@$_GET['sortsince'])."&start=".intval(@$_GET['start']) ) ;
		exit ;
	}
}

// this page uses smarty template
// this must be set before including main header.php
$xoopsOption['template_main'] = 'xhnewbb_viewallforum.html';
include XOOPS_ROOT_PATH."/header.php";

// sort order
$sel_sort_array = array("f.forum_name"=>_MD_XHNEWBB_FORUMNAME, "t.topic_title"=>_MD_XHNEWBB_TOPICTITLE, "t.topic_replies"=>_MD_XHNEWBB_NUMBERREPLIES, "u.uname"=>_MD_XHNEWBB_TOPICPOSTER, "t.topic_views"=>_MD_XHNEWBB_VIEWS, "p.post_time"=>_MD_XHNEWBB_LASTPOSTTIME);
if ( !isset($_GET['sortname']) || !in_array($_GET['sortname'], array_keys($sel_sort_array)) ) {
	$sortname = "p.post_time";
} else {
	$sortname = $_GET['sortname'];
}

$xoopsTpl->assign('lang_sortby', _MD_XHNEWBB_SORTEDBY);

$forum_selection_sort = '<select name="sortname">';
foreach ( $sel_sort_array as $sort_k => $sort_v ) {
	$forum_selection_sort .= '<option value="'.$sort_k.'"'.(($sortname == $sort_k) ? ' selected="selected"' : '').'>'.$sort_v.'</option>';
}
$forum_selection_sort .= '</select>';
$xoopsTpl->assign('forum_selection_sort', $forum_selection_sort);

// solved or unsolved
$sel_solved_array = array("unsolved"=>_MD_XHNEWBB_SOLVEDNO, "solved"=>_MD_XHNEWBB_SOLVEDYES, "both"=>_MD_XHNEWBB_SOLVEDBOTH);
$whr_solved_array = array("unsolved"=>'t.topic_solved=0', "solved"=>'t.topic_solved=1', "both"=>'1');
if ( !isset($_GET['solved']) || !in_array($_GET['solved'], array_keys($sel_solved_array)) ) {
	$solved = "both";
} else {
	$solved = $_GET['solved'];
}

$xoopsTpl->assign('lang_solvedby', _MD_XHNEWBB_WHRSOLVED);

$forum_selection_solved = '<select name="solved">';
foreach ( $sel_solved_array as $solved_k => $solved_v ) {
	$forum_selection_solved .= '<option value="'.$solved_k.'"'.(($solved == $solved_k) ? ' selected="selected"' : '').'>'.$solved_v.'</option>';
}
$forum_selection_solved .= '</select>';
$xoopsTpl->assign('forum_selection_solved', $forum_selection_solved);

// sort order
$sortorder = (!isset($_GET['sortorder']) || $_GET['sortorder'] != "ASC") ? "DESC" : "ASC";
$forum_selection_order = '<select name="sortorder">';
$forum_selection_order .= '<option value="ASC"'.(($sortorder == "ASC") ? ' selected="selected"' : '').'>'._MD_XHNEWBB_ASCENDING.'</option>';
$forum_selection_order .= '<option value="DESC"'.(($sortorder == "DESC") ? ' selected="selected"' : '').'>'._MD_XHNEWBB_DESCENDING.'</option>';
$forum_selection_order .= '</select>';
$xoopsTpl->assign('forum_selection_order', $forum_selection_order);

// since
$sortsince = !empty($_GET['sortsince']) ? intval($_GET['sortsince']) : 100;
$sel_since_array = array(1, 7, 30, 100);
$forum_selection_since = '<select name="sortsince">';
foreach ($sel_since_array as $sort_since_v) {
	$forum_selection_since .= '<option value="'.$sort_since_v.'"'.(($sortsince == $sort_since_v) ? ' selected="selected"' : '').'>'.sprintf(_MD_XHNEWBB_FROMLASTDAYS,$sort_since_v).'</option>';
}
$forum_selection_since .= '<option value="365"'.(($sortsince == 365) ? ' selected="selected"' : '').'>'.sprintf(_MD_XHNEWBB_THELASTYEAR,365).'</option>';
$forum_selection_since .= '<option value="10000"'.(($sortsince == 10000) ? ' selected="selected"' : '').'>'.sprintf(_MD_XHNEWBB_BEGINNING,10000).'</option>';
$forum_selection_since .= '</select>';
$xoopsTpl->assign('forum_selection_since', $forum_selection_since);
$xoopsTpl->assign('lang_go', _MD_XHNEWBB_GO);

// th link
$xoopsTpl->assign('h_forum_link', XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=$solved&amp;sortname=f.forum_name&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "f.forum_name" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_forum', _MD_XHNEWBB_FORUM);

$xoopsTpl->assign('h_topic_link', XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=$solved&amp;sortname=t.topic_title&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "t.topic_title" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_topic', _MD_XHNEWBB_TOPIC);

$xoopsTpl->assign('h_reply_link', XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=$solved&amp;sortname=t.topic_replies&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "t.topic_replies" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_replies', _MD_XHNEWBB_REPLIES);

$xoopsTpl->assign('h_poster_link', XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=$solved&amp;sortname=u.uname&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "u.uname" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_poster', _MD_XHNEWBB_POSTER);

$xoopsTpl->assign('h_views_link', XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=$solved&amp;sortname=t.topic_views&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "t.topic_views" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_views', _MD_XHNEWBB_VIEWS);

$xoopsTpl->assign('h_date_link', XOOPS_URL."/modules/xhnewbb/viewallforum.php?solved=$solved&amp;sortname=p.post_time&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "p.post_time" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_date', _MD_XHNEWBB_DATE);

$startdate = time() - (86400* $sortsince);
$start = !empty($_GET['start']) ? intval($_GET['start']) : 0;

if( $uid > 0 ) {
	$sql = 'SELECT f.forum_id, f.forum_name, t.*, u.uname, u2.uname as last_poster, p.post_time as last_post_time, p.icon, u2t.u2t_time, u2t.u2t_marked FROM '.$xoopsDB->prefix("xhnewbb_topics").' t LEFT JOIN '.$xoopsDB->prefix("xhnewbb_forums").' f ON t.forum_id=f.forum_id LEFT JOIN '.$xoopsDB->prefix('users').' u ON u.uid = t.topic_poster LEFT JOIN '.$xoopsDB->prefix('xhnewbb_posts').' p ON p.post_id = t.topic_last_post_id LEFT JOIN '.$xoopsDB->prefix('users').' u2 ON  u2.uid = p.uid LEFT JOIN '.$xoopsDB->prefix('xhnewbb_users2topics')." u2t ON  u2t.topic_id = t.topic_id AND u2t.uid = $uid WHERE ({$whr_solved_array[$solved]}) AND f.forum_access > 0 AND f.forum_type = 0 AND (p.post_time > $startdate OR t.topic_sticky=1) ORDER BY u2t.u2t_marked<=>1 DESC , t.topic_sticky DESC, $sortname $sortorder" ;
} else {
	$sql = 'SELECT f.forum_id, f.forum_name, t.*, u.uname, u2.uname as last_poster, p.post_time as last_post_time, p.icon, 0 AS u2t_time, 0 AS u2t_marked FROM '.$xoopsDB->prefix("xhnewbb_topics").' t LEFT JOIN '.$xoopsDB->prefix("xhnewbb_forums").' f ON t.forum_id=f.forum_id LEFT JOIN '.$xoopsDB->prefix('users').' u ON u.uid = t.topic_poster LEFT JOIN '.$xoopsDB->prefix('xhnewbb_posts').' p ON p.post_id = t.topic_last_post_id LEFT JOIN '.$xoopsDB->prefix('users')." u2 ON  u2.uid = p.uid WHERE ({$whr_solved_array[$solved]}) AND f.forum_access > 0 AND f.forum_type = 0 AND (p.post_time > $startdate OR t.topic_sticky=1) ORDER BY t.topic_sticky DESC, $sortname $sortorder" ;
}
if ( !$result = $xoopsDB->query($sql,25,$start) ) {
	redirect_header(XOOPS_URL."/modules/xhnewbb/index.php",2,_MD_XHNEWBB_ERROROCCURED);
	exit();
}

// Read topic 'lastread' times from cookie, if exists
// GIJ start
/* if( empty( $_COOKIE['xhnewbb_topic_lastread'] ) ) $topic_lastread = array();
else {
	$topic_lastreadtmp = explode( ',' , $_COOKIE['xhnewbb_topic_lastread'] ) ;
	foreach( $topic_lastreadtmp as $tmp ) {
		$idmin = explode( '|' , $tmp ) ;
		$id = empty( $idmin[0] ) ? 0 : intval( $idmin[0] ) ;
		$min = empty( $idmin[1] ) ? 0 : intval( $idmin[1] ) ;
		$topic_lastread[ $id ] = $min ;
	}
} */
// GIJ end


$myts =& MyTextSanitizer::getInstance() ;


while ( $myrow = $xoopsDB->fetchArray($result) ) {

 	if ( empty($myrow['last_poster']) ) {
		$myrow['last_poster'] = $xoopsConfig['anonymous'];
	}
	if ( $myrow['topic_sticky'] == 1 ) {
		$image = $bbImage['folder_sticky'];
	} elseif ( $myrow['topic_status'] == 1 ) {
		$image = $bbImage['locked_topic'];
	} else {
		if ( $myrow['topic_replies'] >= 100 ) {
//			if ( empty($topic_lastread[$myrow['topic_id']]) || ($topic_lastread[$myrow['topic_id']] * 60 < $myrow['last_post_time'] )) {
			if ( $myrow['u2t_time'] < $myrow['last_post_time'] ) {
				$image = $bbImage['hot_newposts_topic'];
			} else {
				$image = $bbImage['hot_folder_topic'];
			}
		} else {
//			if ( empty($topic_lastread[$myrow['topic_id']]) || ($topic_lastread[$myrow['topic_id']] * 60 < $myrow['last_post_time'] )) {
			if ( $myrow['u2t_time'] < $myrow['last_post_time'] ) {
				$image = $bbImage['newposts_topic'];
			} else {
				$image = $bbImage['folder_topic'];
			}
		}
	}
	$pagination = '';
	$addlink = '';
	$topiclink = XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$myrow['topic_id'];
	$totalpages = ceil(($myrow['topic_replies'] + 1) / 25 ) ;
	if ( $totalpages > 1 ) {
		$pagination .= '&nbsp;&nbsp;&nbsp;<img src="'.XOOPS_URL.'/images/icons/posticon.gif" /> ';
		for ( $i = 1; $i <= $totalpages; $i++ ) {

			if ( $i > 3 && $i < 6 && $i < $totalpages ) {
				$pagination .= "...";
			} else {
				$addlink = '&start='.(($i - 1) * 25 );
				$pagination .= '[<a href="'.$topiclink.$addlink.'">'.$i.'</a>]';
			}
		}
	}

	// icon
	if( ! preg_match( '/^icon[1-7]\.gif$/' , $myrow['icon'] ) ) $myrow['icon'] = 'icon1.gif' ;
	if( ! $myrow['topic_solved'] ) $myrow['icon'] = substr( $myrow['icon'] , 0 , 5 ) . '_r.gif' ;
	$topic_icon = '<img src="'.XOOPS_URL.'/modules/xhnewbb/images/'.$myrow['icon'].'" alt="" border="" />';
	// moderator can change solved
	if( $uid > 0 && ( $xoopsUser->isAdmin() || xhnewbb_is_moderator( $myrow['forum_id'] , $uid ) ) ) {
		$topic_icon = "<a href='".XOOPS_URL."/modules/xhnewbb/viewallforum.php?flip_solved=1&amp;topic_id={$myrow['topic_id']}&amp;solved=$solved&amp;sortname=$sortname&amp;sortsince=$sortsince&amp;sortorder=$sortorder&amp;start=$start'>$topic_icon</a>" ;
	}

	// topic_poster
	if ( $myrow['topic_poster'] != 0 && $myrow['uname'] ) {
		$topic_poster = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$myrow['topic_poster'].'">'.$myrow['uname'].'</a>';
	} else {
		$topic_poster = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$myrow['topic_poster'].'">'.$xoopsConfig['anonymous'].'</a>';
	}

	// marked
	$mark_checked = $myrow['u2t_marked'] ? 'checked="checked"' : '' ;

	$xoopsTpl->append('topics', array('forum_id'=>$myrow['forum_id'],'forum_name'=>$myts->makeTboxData4Show($myrow['forum_name']),'topic_id'=>$myrow['topic_id'], 'topic_icon'=>$topic_icon, 'topic_folder'=>$image, 'topic_title'=>$myts->makeTboxData4Show($myrow['topic_title']), 'topic_link'=>$topiclink, 'topic_page_jump'=>$pagination, 'topic_replies'=>$myrow['topic_replies'], 'topic_poster'=>$topic_poster, 'topic_views'=>$myrow['topic_views'], 'topic_last_posttime'=>formatTimestamp($myrow['last_post_time'],'m'), 'topic_last_poster'=>$myts->makeTboxData4Show($myrow['last_poster']), 'u2t_time' => $myrow['u2t_time'], 'mark_checked' => $mark_checked ));
}

$xoopsTpl->assign("mod_url" , XOOPS_URL.'/modules/xhnewbb' ) ;
$xoopsTpl->assign('php_self_abs', XOOPS_URL."/modules/xhnewbb/viewallforum.php" );
$xoopsTpl->assign('uid', $uid);

$xoopsTpl->assign('lang_by', _MD_XHNEWBB_BY);

$xoopsTpl->assign('img_newposts', $bbImage['newposts_topic']);
$xoopsTpl->assign('img_hotnewposts', $bbImage['hot_newposts_topic']);
$xoopsTpl->assign('img_folder', $bbImage['folder_topic']);
$xoopsTpl->assign('img_hotfolder', $bbImage['hot_folder_topic']);
$xoopsTpl->assign('img_locked', $bbImage['locked_topic']);
$xoopsTpl->assign('img_sticky', $bbImage['folder_sticky']);
$xoopsTpl->assign('lang_newposts', _MD_XHNEWBB_NEWPOSTS);
$xoopsTpl->assign('lang_hotnewposts', _MD_XHNEWBB_MORETHAN);
$xoopsTpl->assign('lang_hotnonewposts', _MD_XHNEWBB_MORETHAN2);
$xoopsTpl->assign('lang_nonewposts', _MD_XHNEWBB_NONEWPOSTS);
$xoopsTpl->assign('lang_legend', _MD_XHNEWBB_LEGEND);
$xoopsTpl->assign('lang_topiclocked', _MD_XHNEWBB_TOPICLOCKED);
$xoopsTpl->assign('lang_topicsticky', _MD_XHNEWBB_TOPICSTICKY);
$xoopsTpl->assign("lang_search", _MD_XHNEWBB_SEARCH);
$xoopsTpl->assign("lang_advsearch", _MD_XHNEWBB_ADVSEARCH);

$result = $xoopsDB->query( "SELECT COUNT(*) FROM ".$xoopsDB->prefix("xhnewbb_topics")." t LEFT JOIN ".$xoopsDB->prefix("xhnewbb_forums")." f ON t.forum_id=f.forum_id WHERE ({$whr_solved_array[$solved]}) AND f.forum_access > 0 AND f.forum_type = 0 AND (t.topic_time > $startdate OR t.topic_sticky = 1) " ) ;
list( $all_topics ) = $xoopsDB->fetchRow( $result ) ;
if ( $all_topics > 25 ) {
	include XOOPS_ROOT_PATH.'/modules/xhnewbb/class/xhpagenav.php';
	$nav = new XhXoopsPageNav( XOOPS_URL.'/modules/xhnewbb/viewallforum.php' , $all_topics , 25 , $start , "start" , "solved=$solved&amp;sortname=$sortname&amp;sortorder=$sortorder&amp;sortsince=$sortsince" ) ;
	$xoopsTpl->assign('forum_pagenav', $nav->renderNav(4));
} else {
	$xoopsTpl->assign('forum_pagenav', '');
}
$xoopsTpl->assign('forum_jumpbox', xhnewbb_make_jumpbox(0));
include XOOPS_ROOT_PATH."/footer.php";
?>
