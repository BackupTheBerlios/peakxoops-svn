<?php
// $Id: index.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
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

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

include '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH."/modules/$mydirname/include/functions.php";
include_once XOOPS_ROOT_PATH."/modules/$mydirname/include/gtickets.php";

$op = empty( $_POST['op'] ) ? '' : $_POST['op'] ;
if( empty( $op ) && ! empty( $_GET['op'] ) ) $op = $_GET['op'] ;

// encodings allowed
$encodings_tmp = explode( '|' , _AM_ENCODINGS ) ;
$allowed_encodings = array( '' => _AM_ENCODING_AUTO ) ;
foreach( $encodings_tmp as $namecolontitle ) {
	list( $name , $title ) = explode( ':' , $namecolontitle ) ;
	$allowed_encodings[ $name ] = empty( $title ) ? $name : $title ;
}

function xhld_get_hl_form( $hl , $action = 'new' )
{
	// add or edit
	if( $action == 'new' ) {
		$form_title = _AM_ADDHEADL ;
		$op = 'addgo' ;
	} else {
		$form_title = _AM_EDITHEADL ;
		$op = 'editgo' ;
	}

	include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';

	$form = new XoopsThemeForm( $form_title , 'headline_form', 'index.php');
	$form->addElement(new XoopsFormText(_AM_SITENAME, 'headline_name', 40, 4096, $hl->getVar('headline_name')), true);

	$url_text = new XoopsFormText('', 'headline_url', 45, 4096, $hl->getVar('headline_url'));
	$url_tray = new XoopsFormElementTray(_AM_URL, '') ;
	$url_tray->addElement( $url_text , true ) ;
	$url_tray->addElement( new XoopsFormLabel( "<img src='../images/html.gif' onClick=\"window.open(document.headline_form.headline_url.value,'','');return(false);\" alt='HTML' />" ) ) ;
	$form->addElement( $url_tray ) ;

	$rssurl_text = new XoopsFormText( '' , 'headline_rssurl', 60, 4096, $hl->getVar('headline_rssurl'));
	$rssurl_tray = new XoopsFormElementTray(_AM_URLEDFXML, '') ;
	$rssurl_tray->addElement( $rssurl_text , true ) ;
	$rssurl_tray->addElement( new XoopsFormLabel( "<img src='../images/xml.gif' onClick=\"window.open(document.headline_form.headline_rssurl.value,'','');return(false);\" alt='XML' />" ) ) ;
	$form->addElement( $rssurl_tray ) ;

	$syndic_sel = new XoopsFormSelect(_AM_SYNDICATIONTYPE, 'headline_syndication', $hl->getVar('headline_syndication'));
	$syndic_sel->addOptionArray(array('' => _AM_SYNDICATIONTYPE_AUTO, 'RSS' => 'RSS', 'ATOM' => 'ATOM'));
	$form->addElement($syndic_sel);

	$form->addElement(new XoopsFormText(_AM_TITLEPATTERN, 'headline_titlepattern', 50, 4096, $hl->getVar('headline_titlepattern')), false);
	$form->addElement(new XoopsFormText(_AM_TITLEEXCLUDE, 'headline_titleexclude', 50, 4096, $hl->getVar('headline_titleexclude')), false);
	$form->addElement(new XoopsFormText(_AM_LINKPATTERN, 'headline_linkpattern', 50, 4096, $hl->getVar('headline_linkpattern')), false);
	$form->addElement(new XoopsFormText(_AM_LINKEXCLUDE, 'headline_linkexclude', 50, 4096, $hl->getVar('headline_linkexclude')), false);
	$form->addElement(new XoopsFormText(_AM_ORDER, 'headline_weight', 4, 3, $hl->getVar('headline_weight')));

	$enc_sel = new XoopsFormSelect(_AM_ENCODING, 'headline_encoding', $hl->getVar('headline_encoding'));
	$enc_sel->addOptionArray( $GLOBALS['allowed_encodings'] );
	$form->addElement($enc_sel);

	$cache_text = new XoopsFormText('', 'headline_cachetime', 6, 6, $hl->getVar('headline_cachetime') / 60 ) ;
	$cache_text->setExtra( 'style="text-align:right;"' ) ;
	$cache_tray = new XoopsFormElementTray(_AM_CACHETIME, '') ;
	$cache_tray->addElement( $cache_text , true ) ;
	$cache_tray->addElement( new XoopsFormLabel( sprintf( _MINUTES , '' ) ) ) ;
	$form->addElement( $cache_tray ) ;

	$timeout_text = new XoopsFormText('', 'headline_timeout', 4, 4, $hl->getVar('headline_timeout') ) ;
	$timeout_text->setExtra( 'style="text-align:right;"' ) ;
	$timeout_tray = new XoopsFormElementTray(_AM_TIMEOUT, '') ;
	$timeout_tray->addElement( $timeout_text , true ) ;
	$timeout_tray->addElement( new XoopsFormLabel( sprintf( _SECONDS , '' ) ) ) ;
	$form->addElement( $timeout_tray ) ;

	$form->addElement(new XoopsFormRadioYN(_AM_ALLOWHTML, 'headline_allowhtml', $hl->getVar('headline_allowhtml'), _YES, _NO));

	$form->insertBreak(_AM_MAINSETT);
	$form->addElement(new XoopsFormRadioYN(_AM_DISPLAY, 'headline_display', $hl->getVar('headline_display'), _YES, _NO));
	$form->addElement(new XoopsFormRadioYN(_AM_DISPIMG, 'headline_mainimg', $hl->getVar('headline_mainimg'), _YES, _NO));
	$form->addElement(new XoopsFormRadioYN(_AM_DISPFULL, 'headline_mainfull', $hl->getVar('headline_mainfull'), _YES, _NO));
	$form->addElement(new XoopsFormText(_AM_DISPMAX, 'headline_mainmax', 5, 5, intval($hl->getVar('headline_mainmax'))),true);

	$form->insertBreak(_AM_BLOCKSETT);
	$form->addElement(new XoopsFormRadioYN(_AM_ASBLOCK, 'headline_asblock', $hl->getVar('headline_asblock'), _YES, _NO));
	$form->addElement(new XoopsFormRadioYN(_AM_DISPIMG, 'headline_blockimg', $hl->getVar('headline_blockimg'), _YES, _NO));
	$form->addElement(new XoopsFormText(_AM_DISPMAX, 'headline_blockmax', 5, 5, intval($hl->getVar('headline_blockmax'))),true);

	$form->insertBreak();
	$form->addElement(new XoopsFormHidden('headline_id', $hl->getVar('headline_id')));
	$form->addElement(new XoopsFormHidden('op', $op));

	$button_tray = new XoopsFormElementTray('' , '&nbsp;') ;
	$button_tray->addElement( new XoopsFormButton('', 'headline_submit', _SUBMIT, 'submit') ) ;
	if( $action != 'new' ) $button_tray->addElement( new XoopsFormButton('', 'headline_saveas', _AM_SAVEAS, 'submit') ) ;
	$form->addElement( $button_tray ) ;

	// Ticket
	$form->addElement( $GLOBALS['xoopsGTicket']->getTicketXoopsForm( __LINE__ ) ) ;

	return $form ;
}



if( $op == 'update' ) {

	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$hlman =& xoops_getmodulehandler('headline');
	$msg = '';
	if( empty( $_POST['headline_id'] ) ) $_POST['headline_id'] = array() ;
	foreach ($_POST['headline_id'] as $i => $id) {
		$need_refetch = false ;
		$id = intval( $id ) ;
		$i = intval( $i ) ;
		$hl =& $hlman->get($id);
		if( ! is_object( $hl ) ) {
			continue ;
		}

		// POST vars
		$headline_display = empty($_POST['headline_display'][$i]) ? 0 : 1 ;
		$headline_asblock = empty($_POST['headline_asblock'][$i]) ? 0 : 1 ;
		$headline_encoding = empty($_POST['headline_encoding'][$i]) ? 0 : $_POST['headline_encoding'][$i];
		$headline_cachetime = empty($_POST['headline_cachetime'][$i]) ? 0 : intval( $_POST['headline_cachetime'][$i] * 60 ) ;
		$headline_weight = empty($_POST['headline_weight'][$i]) ? 0 : intval( $_POST['headline_weight'][$i] ) ;
		$headline_mainmax = empty($_POST['headline_mainmax'][$i]) ? 0 : intval( $_POST['headline_mainmax'][$i] ) ;
		$headline_blockmax = empty($_POST['headline_blockmax'][$i]) ? 0 : intval( $_POST['headline_blockmax'][$i] ) ;

		// checking values
		// minimum value 10min
		if( $headline_cachetime < 600 ) $headline_cachetime = 600 ;

		// check whether is it necessary to refetch or not
		if( $headline_display || $headline_asblock ) $need_refetch = true ;

		// SetVars
		$hl->setVar('headline_cachetime', $headline_cachetime);
		$hl->setVar('headline_display', $headline_display);
		$hl->setVar('headline_mainmax', $headline_mainmax);
		$hl->setVar('headline_weight', $headline_weight);
		$hl->setVar('headline_asblock', $headline_asblock);
		$hl->setVar('headline_blockmax', $headline_blockmax);
		$hl->setVar('headline_encoding', $headline_encoding);
		if( $need_refetch ) {
			$hl->setVar('headline_updated', 0);
			$hl->setVar('headline_xml', array());
		}

		// remove block caches
		@unlink( XOOPS_CACHE_PATH."/db%3Axhld{$mydirnumber}_block_rss.html" ) ;
		@unlink( XOOPS_CACHE_PATH."/db%3Axhld{$mydirnumber}_block_mixed.html" ) ;

		if( $hlman->insert( $hl ) ) {
			$renderer =& xhld_getrenderer($hl,$mydirname);
			if( $need_refetch ) {
				if( $renderer->updateCache( true ) === false ) {
					// save success , fetch fail
					$msg .= '<br />'.sprintf(_AM_FAILUPDATE, $hl->getVar('headline_name')).'<br />' ;
					$msg .= $renderer->getErrors() ;
				}
			}
		} else {
			// save fail
			$msg .= '<br />'.sprintf(_AM_FAILUPDATE, $hl->getVar('headline_name'));
			foreach( $hl->getErrors() as $error ) {
				$msg .= '<br />'.$error ;
			}
		}
		$i ++ ;
	}
	if( $msg != '' ) {
		xoops_cp_header();
		include( './mymenu.php' ) ;
		echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>" ;
		xoops_error( $msg ) ;
		xoops_cp_footer();
		exit ;
	}
	redirect_header( 'index.php', 2 , _AM_DBUPDATED ) ;
	exit ;
}


if( $op == 'addgo' || $op == 'editgo' ) {

	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$hlman =& xoops_getmodulehandler( 'headline' ) ;

	// get headline object
	if( $op == 'addgo' || ! empty( $_POST['headline_saveas'] ) ) {
		$hl =& $hlman->create();
	} else {
		$hl =& $hlman->get( intval( $_POST['headline_id'] ) ) ;
		if( ! is_object( $hl ) ) {
			xoops_cp_header();
			include( './mymenu.php' ) ;
			echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
			xoops_error(_AM_OBJECTNG);
			xoops_cp_footer();
			exit ;
		}
	}

	// POST vars
	$headline_display = empty($_POST['headline_display']) ? 0 : 1 ;
	$headline_mainfull = empty($_POST['headline_mainfull']) ? 0 : 1 ;
	$headline_mainimg = empty($_POST['headline_mainimg']) ? 0 : 1 ;
	$headline_asblock = empty($_POST['headline_asblock']) ? 0 : 1 ;
	$headline_blockimg = empty($_POST['headline_blockimg']) ? 0 : 1 ;
	$headline_encoding = empty($_POST['headline_encoding']) ? 0 : $_POST['headline_encoding'];
	$headline_cachetime = empty($_POST['headline_cachetime']) ? 0 : intval( $_POST['headline_cachetime'] * 60 ) ;
	$headline_weight = empty($_POST['headline_weight']) ? 0 : intval( $_POST['headline_weight'] ) ;
	$headline_mainmax = empty($_POST['headline_mainmax']) ? 0 : intval( $_POST['headline_mainmax'] ) ;
	$headline_blockmax = empty($_POST['headline_blockmax']) ? 0 : intval( $_POST['headline_blockmax'] ) ;
	$headline_titlepattern = empty($_POST['headline_titlepattern']) ? '' : trim( $_POST['headline_titlepattern'] ) ;
	$headline_titleexclude = empty($_POST['headline_titleexclude']) ? '' : trim( $_POST['headline_titleexclude'] ) ;
	$headline_linkpattern = empty($_POST['headline_linkpattern']) ? '' : trim( $_POST['headline_linkpattern'] ) ;
	$headline_linkexclude = empty($_POST['headline_linkexclude']) ? '' : trim( $_POST['headline_linkexclude'] ) ;
	$headline_name = empty($_POST['headline_name']) ? '' : trim( $_POST['headline_name'] ) ;
	$headline_url = empty($_POST['headline_url']) ? '' : trim( $_POST['headline_url'] ) ;
	$headline_rssurl = empty($_POST['headline_rssurl']) ? '' : trim( $_POST['headline_rssurl'] ) ;
	$headline_syndication = empty($_POST['headline_syndication']) ? '' : trim( $_POST['headline_syndication'] ) ;
	$headline_timeout = empty($_POST['headline_timeout']) ? '' : intval( $_POST['headline_timeout'] ) ;
	$headline_allowhtml = empty($_POST['headline_allowhtml']) ? '' : intval( $_POST['headline_allowhtml'] ) ;

	// checking values
	// minimum cachetime 10min
	if( $headline_cachetime < 600 ) $headline_cachetime = 600 ;
	// check if the pattern is valid for preg
	if( ! empty( $headline_titlepattern ) && preg_match( $headline_titlepattern , '' ) === false ) {
		$headline_titlepattern = "/$headline_titlepattern/" ;
		if( preg_match( $headline_titlepattern , '' ) === false ) {
			$headline_titlepattern = "" ;
		}
	}
	if( ! empty( $headline_titleexclude ) && preg_match( $headline_titleexclude , '' ) === false ) {
		$headline_titleexclude = "/$headline_titleexclude/" ;
		if( preg_match( $headline_titleexclude , '' ) === false ) {
			$headline_titleexclude = "" ;
		}
	}
	if( ! empty( $headline_linkpattern ) && preg_match( $headline_linkpattern , '' ) === false ) {
		$headline_linkpattern = "/$headline_linkpattern/" ;
		if( preg_match( $headline_linkpattern , '' ) === false ) {
			$headline_linkpattern = "" ;
		}
	}
	if( ! empty( $headline_linkexclude ) && preg_match( $headline_linkexclude , '' ) === false ) {
		$headline_linkexclude = "/$headline_linkexclude/" ;
		if( preg_match( $headline_linkexclude , '' ) === false ) {
			$headline_linkexclude = "" ;
		}
	}

	// SetVars
	$hl->setVar('headline_name', $headline_name);
	$hl->setVar('headline_url', $headline_url);
	$hl->setVar('headline_rssurl', $headline_rssurl);
	$hl->setVar('headline_syndication', $headline_syndication);
	$hl->setVar('headline_timeout', $headline_timeout);
	$hl->setVar('headline_allowhtml', $headline_allowhtml);
	$hl->setVar('headline_titlepattern', $headline_titlepattern);
	$hl->setVar('headline_titleexclude', $headline_titleexclude);
	$hl->setVar('headline_linkpattern', $headline_linkpattern);
	$hl->setVar('headline_linkexclude', $headline_linkexclude);
	$hl->setVar('headline_display', $headline_display);
	$hl->setVar('headline_weight', $headline_weight);
	$hl->setVar('headline_asblock', $headline_asblock);
	$hl->setVar('headline_encoding', $headline_encoding);
	$hl->setVar('headline_cachetime', $headline_cachetime );
	$hl->setVar('headline_mainfull', $headline_mainfull);
	$hl->setVar('headline_mainimg', $headline_mainimg);
	$hl->setVar('headline_mainmax', $headline_mainmax);
	$hl->setVar('headline_blockimg', $headline_blockimg);
	$hl->setVar('headline_blockmax', $headline_blockmax);
	$hl->setVar('headline_updated', 0);
	$hl->setVar('headline_xml', array());

	// remove block caches
	@unlink( XOOPS_CACHE_PATH."/db%3Axhld{$mydirnumber}_block_rss.html" ) ;
	@unlink( XOOPS_CACHE_PATH."/db%3Axhld{$mydirnumber}_block_mixed.html" ) ;

	$msg = '' ;
	if( $hlman->insert( $hl ) ) {
		$renderer =& xhld_getrenderer( $hl , $mydirname ) ;
		if( $renderer->updateCache( true ) !== false ) {
			// save success , fetch success
			redirect_header('index.php', 2, _AM_DBUPDATED);
			exit ;
		}
		// save success , fetch fail
		$msg .= '<br />'.sprintf(_AM_FAILUPDATE, $hl->getVar('headline_name')).'<br />' ;
		$msg .= $renderer->getErrors() ;
	} else {
		// save fail
		$msg .= sprintf(_AM_FAILUPDATE, $hl->getVar('headline_name')) ;
		foreach( $hl->getErrors() as $error ) {
			$msg .= '<br />'.$error ;
		}
	}
	xoops_cp_header();
	include( './mymenu.php' ) ;
	echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
	xoops_error($msg);
	xoops_cp_footer();
	exit ;
}


if( $op == 'edit' ) {

	$hlman =& xoops_getmodulehandler('headline') ;

	$headline_id = empty($_GET['headline_id']) ? 0 : intval($_GET['headline_id']);	$hl =& $hlman->get( $headline_id ) ;
	if( ! is_object( $hl ) ) {
		xoops_cp_header();
		include( './mymenu.php' ) ;
		echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
		xoops_error(_AM_INVALIDID);
		xoops_cp_footer();
		exit ;
	}

	xoops_cp_header();
	include( './mymenu.php' ) ;
	echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4><br />";
	//echo '<a href="index.php">'. _AM_HLMAIN .'</a>&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;'.$hl->getVar('headline_name').'<br /><br />';
	$form = xhld_get_hl_form( $hl , 'edit' ) ;
	$form->display();
	xoops_cp_footer();
	exit ;
}


if ($op == 'delete') {

	$hlman =& xoops_getmodulehandler('headline') ;

	$headline_id = empty($_GET['headline_id']) ? 0 : intval($_GET['headline_id']);	$hl =& $hlman->get( $headline_id ) ;
	if( ! is_object( $hl ) ) {
		xoops_cp_header();
		include( './mymenu.php' ) ;
		echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
		xoops_error(_AM_INVALIDID);
		xoops_cp_footer();
		exit ;
	}

	xoops_cp_header();
	include( './mymenu.php' ) ;
	$name = $hl->getVar('headline_name');
	echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
	//echo '<a href="index.php">'. _AM_HLMAIN .'</a>&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;'.$name.'<br /><br />';
	$hiddens = array( 'op' => 'deletego', 'headline_id' => $hl->getVar('headline_id') ) + $GLOBALS['xoopsGTicket']->getTicketArray( __LINE__ ) ;
	xoops_confirm( $hiddens , 'index.php', sprintf( _AM_WANTDEL , $name ) ) ;
	xoops_cp_footer() ;
	exit ;
}


if( $op == 'deletego' ) {

	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$hlman =& xoops_getmodulehandler('headline') ;

	$headline_id = empty($_POST['headline_id']) ? 0 : intval($_POST['headline_id']);
	$hl =& $hlman->get( $headline_id ) ;
	if( ! is_object( $hl ) ) {
		xoops_cp_header();
		include( './mymenu.php' ) ;
		echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
		xoops_error(_AM_OBJECTNG);
		xoops_cp_footer();
		exit ;
	}

	if( ! $hlman->delete( $hl ) ) {
		xoops_cp_header();
		include( './mymenu.php' ) ;
		echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";
		xoops_error(sprintf(_AM_FAILDELETE, $hl->getVar('headline_name')));
		xoops_cp_footer();
		exit ;
	}
	redirect_header('index.php', 2, _AM_DBUPDATED);
	exit ;
}


// default (list)
	include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
	$hlman =& xoops_getmodulehandler('headline');;
	$headlines =& $hlman->getObjects( new Criteria( '1' , '1' ) );
	$count = count($headlines);
	xoops_cp_header();
	include( './mymenu.php' ) ;
	echo "<h4>".sprintf(_AM_HEADLINES,$mydirnumber)."</h4>";

	// update part
	if( $count > 0 ) {
	echo '
	<form name="headline_update_form" action="index.php" method="post">
		'.$xoopsGTicket->getTicketHtml( __LINE__ ).'
		<table class="outer">
			<tr>
				<td class="head">'._AM_SITENAME.'</td>
				<td class="head">'._AM_CACHETIME.'</td>
				<td class="head">'._AM_ENCODING.'</td>
				<td class="head">'._AM_DISPLAY.'</td>
				<td class="head">'._AM_ASBLOCK.'</td>
				<td class="head">'._AM_ORDER.'</td>
				<td class="head">&nbsp;</td>
			</tr>
	';
	for ($i = 0; $i < $count; $i++) {
		// encoding options
		$encoding_options = '' ;
		foreach( $GLOBALS['allowed_encodings'] as $value => $name ) {
			$encoding_options .= '<option value="'.$value.'"';
			if ($value == $headlines[$i]->getVar('headline_encoding')) {
				$encoding_options .= ' selected="selecetd"';
			}
			$encoding_options .= '>'.$name.'</option>';
		}
		// display checked
		$display_checked = $headlines[$i]->getVar('headline_display') ? 'checked="checked" style="background-color:#00FF00"' : '' ;
		$asblock_checked = $headlines[$i]->getVar('headline_asblock') ? 'checked="checked" style="background-color:#00FF00"' : '' ;
		// headline_id
		$id = intval( $headlines[$i]->getVar("headline_id") ) ;
		// headline_cachetime
		$cachetime = intval( $headlines[$i]->getVar("headline_cachetime") / 60 ) ;
		// mainmax & blockmax
		$mainmax = intval( $headlines[$i]->getVar("headline_mainmax") ) ;
		$blockmax = intval( $headlines[$i]->getVar("headline_blockmax") ) ;

		// highlight if fetching/rendering was failed
		if( ! $display_checked && ! $asblock_checked ) {
			$classorstyle = "class='odd'" ;
		} else if( $headlines[$i]->getVar("headline_updated") > 0 ) {
			$classorstyle = "class='even'" ;
		} else {
			$classorstyle = "class='even' style='background-color:#ffcccc;'" ;
		}

		echo "
		<tr>
			<td $classorstyle>
				<a href='../index.php?id=$id'>".$headlines[$i]->getVar("headline_name")."</a>
			</td>
			<td $classorstyle style='text-align:center;'>
				".sprintf(_MINUTES,"<input type='text' name='headline_cachetime[$i]' value='$cachetime' size='6' style='text-align:right;' />")."
			</td>
			<td $classorstyle style='text-align:center;'>
				<select name='headline_encoding[$i]'>$encoding_options</select>
			</td>
			<td $classorstyle style='text-align:center;' nowrap='nowrap'>
				<input type='text' value='$mainmax' name='headline_mainmax[$i]' size='3' maxlength='5' style='text-align:right;' />
				<input type='checkbox' value='1' name='headline_display[$i]' $display_checked />
			</td>
			<td $classorstyle style='text-align:center;' nowrap='nowrap'>
				<input type='text' value='$blockmax' name='headline_blockmax[$i]' size='3' maxlength='5' style='text-align:right;' />
				<input type='checkbox' value='1' name='headline_asblock[$i]' $asblock_checked />
			</td>
			<td $classorstyle style='text-align:center;'>
				<input type='text' maxlength='3' size='4' name='headline_weight[$i]' value='".$headlines[$i]->getVar("headline_weight")."' style='text-align:right;' />
			</td>
			<td $classorstyle>
				<a href='index.php?op=edit&amp;headline_id=$id'>"._EDIT."</a>
				&nbsp;
				<a href='index.php?op=delete&amp;headline_id=$id'>"._DELETE."</a>
				<input type='hidden' name='headline_id[$i]' value='$id' />
			</td>
		</tr>";
	}
	echo '
	</table>
	<div style="text-align:center">
		<input type="hidden" name="op" value="update" />
		<input type="submit" name="headline_update" value="'._AM_UPDATE.'" />
	</div>
	</form>';
	}

	// add part
	$hl =& $hlman->create() ;
	$form = xhld_get_hl_form( $hl ) ;
	$form->display();
	xoops_cp_footer();
	exit ;


?>