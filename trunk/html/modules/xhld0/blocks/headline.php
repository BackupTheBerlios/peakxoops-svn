<?php
// $Id: headline.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
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
if( ! defined( 'XHLD_BLOCK_INCLUDED' ) ) {

define( 'XHLD_BLOCK_INCLUDED' , 1 ) ;

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
include_once XOOPS_ROOT_PATH."/modules/$mydirname/include/functions.php";

function b_xhld_show( $options )
{
	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	$cols = empty( $options[1] ) ? 1 : intval( $options[1] ) ;
	$maxlen = empty( $options[2] ) ? 128 : intval( $options[2] ) ;
	$extraction = empty( $options[3] ) ? 'A' : $options[3] ;

	$criteria = new CriteriaCompo();
	$criteria->add( new Criteria('headline_asblock', 1) ) ;
	if( substr( $options[3] , 0 , 1 ) == 'F' ) {
		// displaying only a feed
		$criteria->add( new Criteria('headline_id', intval( substr( $options[3] , 1 ) ) ) ) ;
	} // displaying feeds belongs the specified category (not yet)

	global $xoopsConfig;
	$block = array();
	$block['feeds'] = array() ;
	$hlman =& xoops_getmodulehandler( 'headline' , $mydirname , true ) ;
	if( ! $hlman ) {
		$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
		$hlman =& xoops_getmodulehandler( 'headline' , $mydirname , true );
		if( ! $hlman ) return array() ;
	}

	$headlines =& $hlman->getObjects($criteria);
	$count = count($headlines);
	for ($i = 0; $i < $count; $i++) {
		$renderer =& xhld_getrenderer($headlines[$i],$mydirname);
		if (!$renderer->renderBlock( false , $maxlen )) {
			if( $xoopsConfig['debug_mode'] > 0 ) {
				$block['feeds'][] = sprintf(_HL_FAILGET, $headlines[$i]->getVar('headline_name')).'<br />'.$renderer->getErrors();
			}
			continue;
		}
		$block['feeds'][] = $renderer->getBlock();
	}
	$block['cols'] = $cols ;
	$block['td_attr'] = 'width="'.(100/$cols).'%" valign="top" id="xhld"' ;
	$block['mod_url'] = XOOPS_URL.'/modules/'.$mydirname ;
	return $block;
}


function b_xhld_edit( $options )
{
	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;
	$mydirname4edit = htmlspecialchars( $mydirname , ENT_QUOTES ) ;
	$cols = empty( $options[1] ) ? 1 : intval( $options[1] ) ;
	$maxlen = empty( $options[2] ) ? 128 : intval( $options[2] ) ;
	$extraction = empty( $options[3] ) ? 'A' : $options[3] ;

	// make options for extraction
	$hlman =& xoops_getmodulehandler('headline', $mydirname);
	$headlines =& $hlman->getObjects(new Criteria('headline_asblock', 1));
	$extraction_options = "<option value='A'>"._ALL."</option>\n<option value=''>----</option>\n" ;
	foreach( $headlines as $headline ) {
		$extraction_options .= "<option value='".sprintf( 'F%05d' , $headline->getVar('headline_id' ) )."'>".$headline->getVar('headline_name')."</option>\n" ;
	}
	$extraction_options = preg_replace( "/(value='$extraction')/" , "\$1 selected='selected'" , $extraction_options ) ;

	$ret = "
		<input type='hidden' name='options[0]' value='$mydirname4edit' />
		"._MB_HEADLINES_COLS.":<input type='text' name='options[1]' value='$cols' size='2' />
		<br />
		"._MB_HEADLINES_MAXLEN.":<input type='text' name='options[2]' value='$maxlen' size='4' />
		<br />
		"._MB_HEADLINES_EXTRACT.":
		<select name='options[3]'>
			$extraction_options
		</select>
		\n";

	return $ret ;
}


function b_xhld_mixed_show( $options )
{
	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;

	$maxitem = empty( $options[1] ) ? 10 : intval( $options[1] ) ;
	$maxlen = empty( $options[2] ) ? 128 : intval( $options[2] ) ;
	$maxitemafeed = empty( $options[3] ) ? 99 : intval( $options[3] ) ;

	$block = array();
	$hlman =& xoops_getmodulehandler( 'headline' , $mydirname , true );
	if( ! $hlman ) {
		$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
		$hlman =& xoops_getmodulehandler( 'headline' , $mydirname , true );
		if( ! $hlman ) return array() ;
	}
	$headlines =& $hlman->getObjects(new Criteria('headline_asblock', 1));
	$count = count($headlines);
	$items = array() ;
	for ($i = 0; $i < $count; $i++) {

		// list( $usec , $sec ) = explode( " " , microtime() ) ;
		// $starttime = $sec + $usec ;

		$renderer =& xhld_getrenderer($headlines[$i],$mydirname);
		$itemsperfeed = empty( $renderer->config["mixed_mode"] ) ? 100 : $headlines[$i]->getVar('headline_blockmax') ;
		$tmp_data = $renderer->getRawDataAsArray( false , min( $itemsperfeed , $maxitemafeed ) , $maxlen ) ;
		$dtfmt_short = empty( $renderer->config["dtfmt_short"] ) ? '' : $renderer->config["dtfmt_short"] ;

		// list( $usec , $sec ) = explode( " " , microtime() ) ;
		// echo "<p>" . ( $sec + $usec - $starttime ) . "sec.</p>" ;

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
					'description' => empty( $item['description'] ) ? '' : $item['description']
				) ;
			}
		}
	}

	// order by pubdate desc
	usort( $items , create_function( '$a,$b' , 'return $a["sort_weight"] < $b["sort_weight"] ? 1 : -1 ;' ) ) ;

	$block['maxitem'] = $maxitem ;
	$block['items'] = $items ;
	$block['mod_url'] = XOOPS_URL.'/modules/'.$mydirname ;
	$block['dtfmt_short'] = empty( $dtfmt_short ) ? '' : $dtfmt_short ;
	return $block ;
}


function b_xhld_mixed_edit( $options )
{
	$mydirname = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0] ;
	$mydirname4edit = htmlspecialchars( $mydirname , ENT_QUOTES ) ;
	$maxitem = empty( $options[1] ) ? 10 : intval( $options[1] ) ;
	$maxlen = empty( $options[2] ) ? 128 : intval( $options[2] ) ;
	$maxitemafeed = empty( $options[3] ) ? 99 : intval( $options[3] ) ;

	$ret = "
		<input type='hidden' name='options[0]' value='$mydirname4edit' />
		"._MB_HEADLINES_MAXITEM_MIXED.":<input type='text' name='options[1]' value='$maxitem' size='3' />
		<br />
		"._MB_HEADLINES_MAXLEN.":<input type='text' name='options[2]' value='$maxlen' size='4' />
		<br />
		"._MB_HEADLINES_MAXITEMAFEED_MIXED.":<input type='text' name='options[3]' value='$maxitemafeed' size='4' />\n" ;

	return $ret ;
}


}

?>