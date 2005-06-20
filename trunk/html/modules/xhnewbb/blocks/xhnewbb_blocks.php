<?php
// $Id: xhnewbb_new.php,v 1.4 2004/11/25 03:27:41 gij Exp $
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
// Recent private forums block (Bloc Forum privò«                            //
// Author: L'òóuipe de TheNetSpace ( http://www.thenetspace.com )            //
// ------------------------------------------------------------------------- //

function b_xhnewbb_main_show( $options )
{
	global $xoopsUser ;

	$max_topics = empty( $options[0] ) ? 10 : intval( $options[0] ) ;
	$show_fullsize = empty( $options[1] ) ? false : true ;
	$now_order = empty( $options[2] ) ? 'time' : trim( $options[2] ) ;
	$now_class = empty( $options[3] ) ? 'public' : trim( $options[3] ) ;
	$is_markup = empty( $options[4] ) ? false : true ;

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$block = array();
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

	switch( $now_order ) {
		case 'views':
			$odr = 't.topic_views DESC';
			break;
		case 'replies':
			$odr = 't.topic_replies DESC';
			break;
		case 'time':
		default:
			$odr = 't.topic_time DESC';
			break;
	}

	switch( $now_class ) {
		case 'both' :
			$whr_class = "1" ;
			break ;
		case 'private' :
			$whr_class = "f.forum_type = 1" ;
			break ;
		case 'public' :
		default :
			$whr_class = "f.forum_type <> 1" ;
			break ;
	}

	if( $uid > 0 && $is_markup ) {
		$query="SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_time, t.topic_views, t.topic_replies, t.topic_solved, t.forum_id, f.forum_name, p.post_id, p.uid, p.subject, u2t.u2t_marked FROM ".$db->prefix("xhnewbb_topics")." t LEFT JOIN ".$db->prefix("xhnewbb_forums")." f ON f.forum_id=t.forum_id LEFT JOIN ".$db->prefix("xhnewbb_posts")." p ON p.topic_id=t.topic_id AND p.post_time >= t.topic_time-2 LEFT JOIN ".$db->prefix("xhnewbb_users2topics")." u2t ON  u2t.topic_id=t.topic_id AND u2t.uid=$uid WHERE $whr_class ORDER BY u2t.u2t_marked<=>1 DESC , $odr" ;
	} else {
		$query="SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_time, t.topic_views, t.topic_replies, t.topic_solved, t.forum_id, f.forum_name, p.post_id, p.uid, p.subject, 0 AS u2t_marked FROM ".$db->prefix("xhnewbb_topics")." t LEFT JOIN ".$db->prefix("xhnewbb_forums")." f ON f.forum_id=t.forum_id LEFT JOIN ".$db->prefix("xhnewbb_posts")." p ON p.topic_id=t.topic_id AND p.post_time >= t.topic_time-2 WHERE $whr_class ORDER BY $odr" ;
	}

	if (!$result = $db->query($query,$max_topics,0)) {
		return false;
	}
	$block['full_view'] = $show_fullsize ;
	$block['lang_forum'] = _MB_XHNEWBB_FORUM;
	$block['lang_topic'] = _MB_XHNEWBB_TOPIC;
	$block['lang_replies'] = _MB_XHNEWBB_RPLS;
	$block['lang_views'] = _MB_XHNEWBB_VIEWS;
	$block['lang_lastpost'] = _MB_XHNEWBB_LPOST;
	$block['lang_visitforums'] = _MB_XHNEWBB_VSTFRMS;
	$block['lang_listalltopics'] = _MB_XHNEWBB_LISTALLTOPICS;
	while ($arr = $db->fetchArray($result)) {
		$topic['forum_id'] = $arr['forum_id'];
		$topic['forum_name'] = $myts->makeTboxData4Show($arr['forum_name']);
		$topic['id'] = $arr['topic_id'];
		$topic['title'] = $myts->makeTboxData4Show($arr['topic_title']);
		$topic['replies'] = $arr['topic_replies'];
		$topic['views'] = $arr['topic_views'];
		$topic['post_id'] = $arr['topic_last_post_id'];
//		$lastpostername = $db->query("SELECT post_id, uid, subject FROM ".$db->prefix("xhnewbb_posts")." WHERE post_id = ".$topic['post_id']);
//		while ($tmpdb=$db->fetchArray($lastpostername)) {
//			$tmpuser = XoopsUser::getUnameFromId($tmpdb['uid']);
//			if ( $options[1] != 0 ) {
//				$topic['time'] = formatTimestamp($arr['topic_time'],'m')." $tmpuser";
			// Ryuji_edit(2003-11-11) hack start
		$topic['date'] = formatTimestamp($arr['topic_time'],'m');
		$topic['poster'] = XoopsUser::getUnameFromId($arr['uid']);
		$topic['last_subject'] = $myts->makeTboxData4Show($arr['subject']);
			// Ryuji_edit(2003-11-11) hack end
//			}
//		}
		$topic['solved'] = $arr['topic_solved'];
		$topic['u2t_marked'] = $arr['u2t_marked'];
		$block['topics'][] =& $topic;
		unset($topic);
	}

	return $block;
}



function b_xhnewbb_main_edit( $options )
{
	$max_topics = empty( $options[0] ) ? 10 : intval( $options[0] ) ;
	$show_fullsize = empty( $options[1] ) ? false : true ;
	$now_order = empty( $options[2] ) ? 'time' : trim( $options[2] ) ;
	$now_class = empty( $options[3] ) ? 'public' : trim( $options[3] ) ;
	$is_markup = empty( $options[4] ) ? false : true ;

	if( $show_fullsize ) {
		$fullyes_checked = "checked='checked'" ;
		$fullno_checked = "" ;
	} else {
		$fullno_checked = "checked='checked'" ;
		$fullyes_checked = "" ;
	}

	if( $is_markup ) {
		$markupyes_checked = "checked='checked'" ;
		$markupno_checked = "" ;
	} else {
		$markupno_checked = "checked='checked'" ;
		$markupyes_checked = "" ;
	}

	$orders = array( 'time' => _MB_XHNEWBB_ORDERTIMED , 'views' => _MB_XHNEWBB_ORDERVIEWSD , 'replies' => _MB_XHNEWBB_ORDERREPLIESD ) ;
	$order_options = '' ;
	foreach( $orders as $order_value => $order_name ) {
		$selected = $order_value == $now_order ? "selected='selected'" : "" ;
		$order_options .= "<option value='$order_value' $selected>$order_name</option>\n" ;
	}

	$classes = array( 'public' => _MB_XHNEWBB_CLASSPUBLIC , 'both' => _MB_XHNEWBB_CLASSBOTH , 'private' => _MB_XHNEWBB_CLASSPRIVATE ) ;
	$class_options = '' ;
	foreach( $classes as $class_value => $class_name ) {
		$selected = $class_value == $now_class ? "selected='selected'" : "" ;
		$class_options .= "<option value='$class_value' $selected>$class_name</option>\n" ;
	}

	$form = sprintf( _MB_XHNEWBB_DISPLAY , "<input type='text' size='4' name='options[0]' value='$max_topics' style='text-align:right;' />" ) ;
	$form .= "\n<br />
		"._MB_XHNEWBB_DISPLAYF."&nbsp;:
		<input type='radio' name='options[1]' value='1' $fullyes_checked />"._YES."
		<input type='radio' name='options[1]' value='0' $fullno_checked />"._NO."
		<br />
		<select name='options[2]'>
			$order_options
		</select>
		<br />
		<select name='options[3]'>
			$class_options
		</select>
		<br />
		"._MB_XHNEWBB_MARKISUP."&nbsp;:
		<input type='radio' name='options[4]' value='1' $markupyes_checked />"._YES."
		<input type='radio' name='options[4]' value='0' $markupno_checked />"._NO."
	\n" ;

	return $form;
}

?>
