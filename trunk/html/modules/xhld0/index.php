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

include '../../mainfile.php';
include dirname( __FILE__ ) .'/include/functions.php';
include dirname( __FILE__ ) .'/include/wap_ua.inc.php';

$mydirname = basename( dirname( __FILE__ ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

// WAP
if( wap_ua() != 'HTML' ) {
	header( "Location: ".XOOPS_URL."/modules/$mydirname/wap.php" ) ;
}

$hlman =& xoops_getmodulehandler('headline');;
$hlid = isset($_GET['id']) ? intval($_GET['id']) : 0;
$xoopsOption['template_main'] = "xhld{$mydirnumber}_index.html";
include XOOPS_ROOT_PATH.'/header.php';
$headlines =& $hlman->getObjects(new Criteria('headline_display', 1));
$count = count($headlines);
for ($i = 0; $i < $count; $i++) {
	$xoopsTpl->append('feed_sites', array('id' => $headlines[$i]->getVar('headline_id'), 'name' => $headlines[$i]->getVar('headline_name'), 'syndication' => $headlines[$i]->getVar('headline_syndication')));
}
$xoopsTpl->assign('lang_headlines', _HL_HEADLINES);
$xoopsTpl->assign('mod_url', XOOPS_URL.'/modules/'.$mydirname);
if ($hlid == 0) {

// Hack by Tom
	if( ! empty( $xoopsModuleConfig["index_viewmode"] ) ) {
		$hlid = $headlines[0]->getVar('headline_id');
	} else {
		$dtfmt_short = empty( $xoopsModuleConfig["dtfmt_short"] ) ? '' : $xoopsModuleConfig["dtfmt_short"] ;
		$items = array() ;
		for ($i = 0; $i < $count; $i++) {
			$renderer =& xhld_getrenderer($headlines[$i],$mydirname);
			$itemsperfeed = empty( $xoopsModuleConfig["mixed_mode"] ) ? 100 : $headlines[$i]->getVar('headline_mainmax') ;
			$tmp_data = $renderer->getRawDataAsArray( false , $itemsperfeed , $xoopsModuleConfig["mixed_maxlen"] ) ;
			if( ! empty( $tmp_data ) ) {
				$no_pubdate_counter = $i ;
				foreach( $tmp_data['items'] as $item ) {
					if( empty( $item['pubdate'] ) ) {
						$item['pubdate'] = '' ;
						$no_pubdate_counter += $count ;
						$sort_weight = - $no_pubdate_counter ;
					} else {
						$sort_weight = $item['pubdate'] ;
					}
					$items[] = array(
						'site_name' => $tmp_data['site_name'] ,
						'site_url' => $tmp_data['site_url'] ,
						'site_id' => $tmp_data['site_id'] ,
						'channel_data' => $tmp_data['channel_data'] ,
						'image_data' => empty( $tmp_data['image_data'] ) ? array() : $tmp_data['image_data'] ,
						'title' => $item['title'] ,
						'link' => $item['link'] ,
						'sort_weight' => $sort_weight ,
						'pubdate' => $item['pubdate'] ,
						'pubdate_utz' => xoops_getUserTimestamp( $item['pubdate'] ) ,
						'date_short' => date( $dtfmt_short , xoops_getUserTimestamp( $item['pubdate'] ) ) ,
						'date' => formatTimestamp( $item['pubdate'] , 'm' ) ,
						'description' => empty( $item['description'] ) ? '' : $item['description'] ,
						'content' => empty( $item['content'] ) ? '' : $item['content']
					) ;
				}
			}
		}
		// order by pubdate desc
		usort( $items , create_function( '$a,$b' , 'return $a["sort_weight"] < $b["sort_weight"] ? 1 : -1 ;' ) ) ;

		$mixlist['lang_listtitle'] = _HL_LISTTITLE ;
		$mixlist['maxitem'] = $xoopsModuleConfig["mixed_maxitem"] ;
		$mixlist['items'] = $items ;
		$mixlist['mod_url'] = XOOPS_URL.'/modules/'.$mydirname ;
		$mixlist['dtfmt_short'] = $dtfmt_short ;
		$xoopsTpl->assign('mixlist', $mixlist);
	}
// Hack by Tom end

}
if ($hlid > 0) {
	$headline =& $hlman->get($hlid);
	if (is_object($headline)) {
		$renderer =& xhld_getrenderer($headline,$mydirname);
		if (!$renderer->renderFeed()) {
			if( $xoopsConfig['debug_mode'] > 0 ) {
				$xoopsTpl->assign('headline', '<p>'.sprintf(_HL_FAILGET, $headline->getVar('headline_name')).'<br />'.$renderer->getErrors().'</p>');
			}
		} else {
			$xoopsTpl->assign('headline', $renderer->getFeed());
		}
		$xoopsTpl->assign( 'xoops_pagetitle' , $headline->getVar('headline_name') ) ;
	}
}
include XOOPS_ROOT_PATH.'/footer.php';
?>