<?php
// $Id: forumform.inc.php,v 1.3 2004/12/20 04:23:18 gij Exp $
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

////////// hack start
if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}

include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";


// variable check
$nosmiley = empty( $nosmiley ) ? 0 : 1 ;
$icon = empty( $icon ) ? 'icon7.gif' : htmlspecialchars( $icon , ENT_QUOTES ) ;
$solved = isset( $solved ) ? $solved : 1 ;
$post_id = empty( $post_id ) ? 0 : $post_id ;
$formTitle = empty( $formTitle ) ? "" : $formTitle ;
$guestName = empty( $guestName ) ? "" : $guestName ;

//$forum_form = new XoopsTableForm("", "forumform", 'post.php');
$forum_form = new XoopsThemeForm($formTitle, "forumform", 'post.php');
if ( $forumdata['forum_type'] == 1 ) {
	$type = _MD_XHNEWBB_PRIVATE;
}else{
	switch ($forumdata['forum_access']){
	  case 1:
		$type = _MD_XHNEWBB_REGCANPOST;
		break;
	  case 2:
		$type = _MD_XHNEWBB_ANONCANPOST;
		break;
	  case 3:
		$type = _MD_XHNEWBB_MODSCANPOST;
		break;
	}
}
$forum_form->addElement(new XoopsFormLabel(_MD_XHNEWBB_ABOUTPOST,$type));

$forum_form->addElement(new XoopsFormText(_MD_XHNEWBB_SUBJECTC , 'subject', 60, 100, $subject), true);

if($post_id > 0){
	// edit (Alert "not reply but edit")
	$forum_form->addElement(new XoopsFormLabel(_MD_XHNEWBB_EDITMODEC, _MD_XHNEWBB_ALERTEDIT));
}else{
	// new post
	// poster field is displayed only for guest. The poster name will be added after message body
	if(!$xoopsUser){
		$forum_form->addElement(new XoopsFormText(_MD_XHNEWBB_GUESTNAMEC , 'guestName', 60, 100, $guestName), true);
	}else{
		$forum_form->addElement(new XoopsFormLabel(_MD_XHNEWBB_UNAMEC,sprintf(_MD_XHNEWBB_FMT_UNAME,$xoopsUser->getVar('uname'))));
	}
}
//icon of message
$icons_tray =  new XoopsFormElementTray(_MD_XHNEWBB_MESSAGEICON,'&nbsp; &nbsp;');
//$icons_radio = new XoopsFormRadio(_MD_XHNEWBB_MESSAGEICON, 'icon', $icon);
$icons_radio = new XoopsFormRadio('', 'icon', $icon);
$subject_icons = XoopsLists::getSubjectsList();
foreach ($subject_icons as $iconfile) {
	$icons_radio->addOption($iconfile, '<img src="'.XOOPS_URL.'/images/subject/'.$iconfile.'" alt="" />');
}
if( ! empty( $xoopsModuleConfig['xhnewbb_use_solved'] ) && is_object( @$xoopsUser ) && ( $xoopsUser->isAdmin() || xhnewbb_is_moderator( $forum , $xoopsUser->getVar('uid') ) ) ) {
	$solved_checkbox = new XoopsFormCheckbox('', 'solved', $solved ) ;
	$solved_checkbox->addOption( 1 , _MD_XHNEWBB_SOLVEDCHECKBOX ) ;
} else {
	$solved_checkbox = new XoopsFormHidden('solved', 0) ;
}
$icons_tray->addElement($icons_radio);
$icons_tray->addElement($solved_checkbox);
$forum_form->addElement($icons_tray);

//message body
$tarea_tray =  new XoopsFormElementTray(_MD_XHNEWBB_MESSAGEC,'<br />');
$tarea_tray->addElement(new XoopsFormDhtmlTextArea("", 'message', $message, 15, 60), true);
if ( !empty($isreply) && isset($hidden) && $hidden != "" ) {
	$forum_form->addElement(new XoopsFormHidden('isreply', 1));
	$forum_form->addElement(new XoopsFormHidden('hidden', $hidden));
	$quoteButton = new XoopsFormButton('', 'quote', _MD_XHNEWBB_QUOTE, 'button');
	$quoteButton->setExtra(" onclick='xoopsGetElementById(\"message\").value=xoopsGetElementById(\"message\").value + xoopsGetElementById(\"hidden\").value; xoopsGetElementById(\"hidden\").value=\"\";'");
	$tarea_tray->addElement($quoteButton);
}
$forum_form->addElement($tarea_tray);

//$forum_form->addElement(new XoopsFormDhtmlTextArea(_MD_XHNEWBB_MESSAGEC, 'message', $message, 15, 60), true);


//options
$option_tray = new XoopsFormElementTray(_MD_XHNEWBB_OPTIONS,'<br />');

if ( $xoopsUser && $forumdata['forum_access'] == 2 && !empty($post_id) ) {
	$noname = !empty($noname) ? 1 : 0;
	$noname_checkbox = new XoopsFormCheckBox('', 'noname', $noname);
	$noname_checkbox->addOption(1, _MD_XHNEWBB_POSTANONLY);
	$option_tray->addElement($noname_checkbox);
}

//smiley
$smiley_checkbox = new XoopsFormCheckBox('', 'nosmiley', $nosmiley);
$smiley_checkbox->addOption(1, _MD_XHNEWBB_DISABLESMILEY);
$option_tray->addElement($smiley_checkbox);

//html
if ( $forumdata['allow_html'] ) {
	$html_checkbox = new XoopsFormCheckBox('', 'nohtml', $nohtml);
	$html_checkbox->addOption(1, _MD_XHNEWBB_DISABLEHTML);
	$option_tray->addElement($html_checkbox);
} else {
	$forum_form->addElement(new XoopsFormHidden('nohtml', 1));
}

//signature
if ( $forumdata['allow_sig'] && $xoopsUser ) {
	if (isset($_POST['contents_preview'])) {
	} else {
		if ($xoopsUser->getVar('attachsig') || !empty($attachsig)) {
			$attachsig = 1;
		} else {
			$attachsig = 0;
		}
	}
	$sig_checkbox = new XoopsFormCheckBox('', 'attachsig', $attachsig);
	$sig_checkbox->addOption(1, _MD_XHNEWBB_ATTACHSIG);
	$option_tray->addElement($sig_checkbox);
}

//notify
if (!empty($xoopsUser) && !empty($xoopsModuleConfig['notification_enabled'])) {
	$forum_form->addElement(new XoopsFormHidden('istopic', 1));
	if (!empty($notify)) {
		// If 'notify' set, use that value (e.g. preview)
		//echo ' checked="checked"';
	} else {
		// Otherwise, check previous subscribed status...
		$notification_handler =& xoops_gethandler('notification');
		if (!empty($topic_id) && $notification_handler->isSubscribed('thread', $topic_id, 'new_post', $xoopsModule->getVar('mid'), $xoopsUser->getVar('uid'))) {
			$notify = 1;
		} else {
			$notify = 0;
		}
	}
	$notify_checkbox = new XoopsFormCheckBox('', 'notify', $notify);
	$notify_checkbox->addOption(1, _MD_XHNEWBB_NEWPOSTNOTIFY);
	$option_tray->addElement($notify_checkbox);
}

$forum_form->addElement($option_tray);

$post_id = isset($post_id) ? intval($post_id) : '';
$topic_id = isset($topic_id) ? intval($topic_id) : '';
$order = isset($order) ? intval($order) : '';
$pid = isset($pid) ? intval($pid) : 0;

$forum_form->addElement(new XoopsFormHidden('pid', intval($pid)));
$forum_form->addElement(new XoopsFormHidden('post_id', $post_id));
$forum_form->addElement(new XoopsFormHidden('topic_id', $topic_id));
$forum_form->addElement(new XoopsFormHidden('forum', intval($forum)));
$forum_form->addElement(new XoopsFormHidden('viewmode', $viewmode));
$forum_form->addElement(new XoopsFormHidden('order', $order));

$button_tray = new XoopsFormElementTray('' ,'');
$button_tray->addElement(new XoopsFormButton('', 'contents_preview', _PREVIEW, 'submit'));
$button_tray->addElement(new XoopsFormButton('', 'contents_submit', _SUBMIT, 'submit'));
$cancel_button = new XoopsFormButton('', 'contents_submit', _MD_XHNEWBB_CANCELPOST, 'button');
$cancel_script = "onclick='location=\"";
if ( isset($topic_id) && $topic_id != "" ) {
	$cancel_script .= "viewtopic.php?topic_id=".intval($topic_id)."&amp;forum=".intval($forum)."\"'";
} else {
	$cancel_script .= "viewforum.php?forum=".intval($forum)."\"'";
}
$cancel_button->setExtra($cancel_script);
$button_tray->addElement($cancel_button);
$forum_form->addElement($button_tray);

$forum_form->display();
?>