<?php

function b_d3forum_list_topics_show( $options )
{
	global $xoopsUser ;

	$mydirname = empty( $options[0] ) ? 'd3forum' : $options[0] ;
	$max_topics = empty( $options[1] ) ? 10 : intval( $options[1] ) ;
	$show_fullsize = empty( $options[2] ) ? false : true ;
	$now_order = empty( $options[3] ) ? 'time' : trim( $options[3] ) ;
	$is_markup = empty( $options[4] ) ? false : true ;
	$categories = empty( $options[5] ) ? array() : explode(',',$options[5]) ;
	$this_template = empty( $options[6] ) ? 'db:'.$mydirname.'_block_list_topics.html' : trim( $options[6] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname($mydirname);
	$config_handler =& xoops_gethandler('config');
	$configs = $config_handler->getConfigList( $module->mid() ) ;

	// allow markup or not
	if( empty( $configs['allow_mark'] ) ) {
		$is_markup = false ;
	}

	// use solved or not
//	if( empty( $configs['use_solved'] ) ) {
		$sel_solved = '1 AS topic_solved' ;
//	} else {
//		$sel_solved = 't.topic_solved' ;
//	}

	// order
	$whr_order = '1' ;
	switch( $now_order ) {
		case 'views':
			$odr = 't.topic_views DESC';
			break;
		case 'replies':
			$odr = 't.topic_posts_count DESC';
			break;
		case 'votes':
			$odr = 't.topic_votes_count DESC';
			break;
		case 'points':
			$odr = 't.topic_votes_sum DESC';
			break;
		case 'average':
			$odr = 't.topic_votes_sum/t.topic_votes_count DESC, topic_votes_count DESC';
			$whr_order = 't.topic_votes_count>0' ;
			break;
		case 'time':
		default:
			$odr = 't.topic_last_post_time DESC';
			break;
	}

	// forums can be read by current viewer (check by forum_access)
	require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
	$whr_forum = "t.forum_id IN (".implode(",",d3forum_get_forums_can_read( $mydirname )).")" ;

	// categories
	if( empty( $categories ) ) {
		$whr_categories = '1' ;
		$categories4assign = '' ;
	} else {
		for( $i = 0 ; $i < count( $categories ) ; $i ++ ) {
			$categories[ $i ] = intval( $categories[ $i ] ) ;
		}
		$whr_categories = 'f.cat_id IN ('.implode(',',$categories).')' ;
		$categories4assign = implode(',',$categories) ;
	}

	if( $uid > 0 && $is_markup ) {
		$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_uid, t.topic_last_post_id, t.topic_last_post_time, t.topic_views, t.topic_votes_count, t.topic_votes_sum, t.topic_posts_count, $sel_solved, t.forum_id, f.forum_title, u2t.u2t_marked FROM ".$db->prefix($mydirname."_topics")." t LEFT JOIN ".$db->prefix($mydirname."_forums")." f ON f.forum_id=t.forum_id LEFT JOIN ".$db->prefix($mydirname."_users2topics")." u2t ON u2t.topic_id=t.topic_id AND u2t.uid=$uid WHERE ! t.topic_invisible AND ($whr_forum) AND ($whr_categories) AND ($whr_order) ORDER BY u2t.u2t_marked<=>1 DESC , $odr" ;
	} else {
		$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_uid, t.topic_last_post_id, t.topic_last_post_time, t.topic_views, t.topic_votes_count, t.topic_votes_sum, t.topic_posts_count, $sel_solved, t.forum_id, f.forum_title, 0 AS u2t_marked FROM ".$db->prefix($mydirname."_topics")." t LEFT JOIN ".$db->prefix($mydirname."_forums")." f ON f.forum_id=t.forum_id WHERE ! t.topic_invisible AND ($whr_forum) AND ($whr_categories) AND ($whr_order) ORDER BY $odr" ;
	}
//	var_dump( $sql ) ;

	if( ! $result = $db->query( $sql , $max_topics , 0 ) ) return array() ;

	$constpref = '_MB_' . strtoupper( $mydirname ) ;

	$block = array( 
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$configs['images_dir'] ,
		'mod_config' => $configs ,
		'categories' => $categories4assign ,
		'full_view' => $show_fullsize ,
		'lang_forum' => constant($constpref.'_FORUM') ,
		'lang_topic' => constant($constpref.'_TOPIC') ,
		'lang_replies' => constant($constpref.'_REPLIES') ,
		'lang_views' => constant($constpref.'_VIEWS') ,
		'lang_votescount' => constant($constpref.'_VOTESCOUNT') ,
		'lang_votessum' => constant($constpref.'_VOTESSUM') ,
		'lang_lastpost' => constant($constpref.'_LASTPOST') ,
		'lang_linktosearch' => constant($constpref.'_LINKTOSEARCH') ,
		'lang_linktolistcategories' => constant($constpref.'_LINKTOLISTCATEGORIES') ,
		'lang_linktolistforums' => constant($constpref.'_LINKTOLISTFORUMS') ,
		'lang_linktolisttopics' => constant($constpref.'_LINKTOLISTTOPICS') ,
	) ;
	while( $topic_row = $db->fetchArray( $result ) ) {
		$topic4assign = array(
			'id' => intval( $topic_row['topic_id'] ) ,
			'title' => $myts->makeTboxData4Show( $topic_row['topic_title'] ) ,
			'forum_id' => intval( $topic_row['forum_id'] ) ,
			'forum_title' => $myts->makeTboxData4Show( $topic_row['forum_title'] ) ,
			'replies' => $topic_row['topic_posts_count'] - 1 ,
			'views' => intval( $topic_row['topic_views'] ) ,
			'votes_count' => $topic_row['topic_votes_count'] ,
			'votes_sum' => intval( $topic_row['topic_votes_sum'] ) ,
			'last_post_id' => intval( $topic_row['topic_last_post_id'] ) ,
			'last_post_time' => intval( $topic_row['topic_last_post_time'] ) ,
			'last_post_time_formatted' => formatTimestamp($topic_row['topic_last_post_time'] , 'm' ) ,
			'last_uid' => intval( $topic_row['topic_last_uid'] ) ,
			'last_uname' => XoopsUser::getUnameFromId( $topic_row['topic_last_uid'] ) ,
			'solved' => intval( $topic_row['topic_solved'] ) ,
			'u2t_marked' => intval( $topic_row['u2t_marked'] ) ,
		) ;
		$block['topics'][] = $topic4assign ;
	}

	$tpl =& new XoopsTpl() ;
	$tpl->assign( 'block' , $block ) ;
	$ret['content'] = $tpl->fetch( $this_template ) ;
	return $ret ;
}



function b_d3forum_list_topics_edit( $options )
{
	$mydirname = empty( $options[0] ) ? $GLOBALS['mydirname'] : $options[0] ;
	$max_topics = empty( $options[1] ) ? 10 : intval( $options[1] ) ;
	$show_fullsize = empty( $options[2] ) ? false : true ;
	$now_order = empty( $options[3] ) ? 'time' : trim( $options[3] ) ;
	$is_markup = empty( $options[4] ) ? false : true ;
	$categories = empty( $options[5] ) ? array() : explode(',',$options[5]) ;
	$this_template = empty( $options[6] ) ? 'db:'.$mydirname.'_block_list_topics.html' : trim( $options[6] ) ;

	if( preg_match( '/[^0-9a-zA-Z_-]/' , $mydirname ) ) die( 'Invalid mydirname' ) ;

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

	for( $i = 0 ; $i < count( $categories ) ; $i ++ ) {
		$categories[ $i ] = intval( $categories[ $i ] ) ;
	}

	$orders = array(
		'time' => _MB_D3FORUM_ORDERTIMED ,
		'views' => _MB_D3FORUM_ORDERVIEWSD ,
		'replies' => _MB_D3FORUM_ORDERREPLIESD ,
		'votes' => _MB_D3FORUM_ORDERVOTESD ,
		'points' => _MB_D3FORUM_ORDERPOINTSD ,
		'average' => _MB_D3FORUM_ORDERAVERAGED ,
	) ;
	$order_options = '' ;
	foreach( $orders as $order_value => $order_name ) {
		$selected = $order_value == $now_order ? "selected='selected'" : "" ;
		$order_options .= "<option value='$order_value' $selected>$order_name</option>\n" ;
	}

	$form = "
		<input type='hidden' name='options[0]' value='$mydirname' />
		<label for='o1'>" . sprintf( _MB_D3FORUM_DISPLAY , "</label><input type='text' size='4' name='options[1]' id='o1' value='$max_topics' style='text-align:right;' />" ) . "
		<br />
		"._MB_D3FORUM_DISPLAYF."&nbsp;:
		<input type='radio' name='options[2]' id='o21' value='1' $fullyes_checked /><label for='o21'>"._YES."</label>
		<input type='radio' name='options[2]' id='o20' value='0' $fullno_checked /><label for='o20'>"._NO."</label>
		<br />
		<label for='orderrule'>"._MB_D3FORUM_ORDERRULE."</label>&nbsp;:
		<select name='options[3]' id='orderrule'>
			$order_options
		</select>
		<br />
		"._MB_D3FORUM_MARKISUP."&nbsp;:
		<input type='radio' name='options[4]' id='markupyes' value='1' $markupyes_checked /><label for='markupyes'>"._YES."</label>
		<input type='radio' name='options[4]' id='markupno' value='0' $markupno_checked /><label for='markupno'>"._NO."</label>
		<br />
		<label for='categories'>"._MB_D3FORUM_CATLIMIT."</label>&nbsp;:
		<input type='text' size='20' name='options[5]' id='categories' value='".implode(',',$categories)."' />"._MB_D3FORUM_CATLIMITDSC."
		<br />
		<label for='this_template'>"._MB_D3FORUM_THISTEMPLATE."</label>&nbsp;:
		<input type='text' size='60' name='options[6]' id='this_template' value='".htmlspecialchars($this_template,ENT_QUOTES)."' />
		<br />
	\n" ;

	return $form;
}

?>