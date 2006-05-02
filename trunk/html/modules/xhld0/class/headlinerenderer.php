<?php
// $Id: headlinerenderer.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
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

if( ! class_exists( 'XhldRenderer' ) ) {

$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
include_once XOOPS_ROOT_PATH.'/class/template.php';
include_once XOOPS_ROOT_PATH."/modules/$mydirname/language/".$GLOBALS['xoopsConfig']['language'].'/main.php';

class XhldRenderer
{
	// holds reference to xhld class object
	var $_hl;

	// XoopTemplate object
	var $_tpl;

	var $_mydirname;
	var $_mydirnumber;

	var $_feed;

	var $_block;

	var $_errors = array();

	var $config = array() ;

	// RSS or ATOM parser
	var $_parser;


	function XhldRenderer(&$headline,$mydirname='xhld0')
	{
		$this->_hl =& $headline;
		$this->_tpl = new XoopsTpl();
		$this->_mydirname = $mydirname ;
		if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
		$this->_mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

		// get config
		$module_handler =& xoops_gethandler("module");
		$module =& $module_handler->getByDirname($this->_mydirname);
		$config_handler =& xoops_gethandler("config");
		$this->config =& $config_handler->getConfigsByCat(0,$module->getVar("mid"));
	}

	function updateCache( $is_admin = false )
	{
		if( empty( $this->config['fetch_method'] ) ) {

			// snoopy (0)
			$error_level_stored = error_reporting() ;
			error_reporting( $error_level_stored & ~ E_NOTICE ) ;
			// includes Snoopy class for remote file access
			require_once(XOOPS_ROOT_PATH."/class/snoopy.php");
			$snoopy = new Snoopy;
			// TIMEOUT from config
			// $snoopy->read_timeout = $this->config['snoopy_timeout'] ;
			$snoopy->read_timeout = $this->_hl->getVar( 'headline_timeout' ) ;
			$snoopy->_fp_timout = $this->_hl->getVar( 'headline_timeout' ) ;
			// Set proxy if needed
			if( trim( $this->config['proxy_host'] ) != '' ) {
				$snoopy->proxy_host = $this->config['proxy_host'] ;
				$snoopy->proxy_port = $this->config['proxy_port'] > 0 ? intval( $this->config['proxy_port'] ) : 8080 ;
				$snoopy->user = $this->config['proxy_user'] ;
				$snoopy->pass = $this->config['proxy_pass'] ;
			}
			//URL fetch
			if( ! $snoopy->fetch( $this->_hl->getVar( 'headline_rssurl' ) ) || ! $snoopy->results ) {
				// set errors
				$this->_setErrors( 'Could not open file: '.htmlspecialchars( $this->_hl->getVar('headline_rssurl') ) ) ;
				if( ! empty( $snoopy->error ) ) $this->_setErrors( "Snoopy status=" . htmlspecialchars( $snoopy->error ) ) ;
				if( $snoopy->timed_out ) $this->_setErrors( "Timed out" ) ;
				$is_fetch_error = true ;
			} else {
				$http_content = $snoopy->results ;
			}
			error_reporting( $error_level_stored ) ;

		} else if( $this->config['fetch_method'] == 2 ) {

			die( 'xhld fetch method not implemented' ) ;
			// stream_socket_client (2)
/*			$url_elements = parse_url( $this->_hl->getVar('headline_rssurl') ) ;
			if( @$url_elements['scheme'] == 'http' ) {
				$socket = 'tcp://' . $url_elements['host'] . ':80' ;
			} else if( @$url_elements['scheme'] == 'https' ) {
				$socket = 'tcp://' . $url_elements['host'] . ':443' ;
			} else {
				$socket = $url_elements['scheme'] . '://' . $url_elements['host'] . ':' . $url_elements['port'] ;
			}
			$fp = stream_socket_client( $socket , $errno , $errstr , $this->_hl->getVar( 'headline_timeout' ) ) ;
			if( empty( $url_elements['path'] ) ) $url_elements['path'] = '/' ;
			$fp = fopen( $this->_hl->getVar( 'headline_rssurl' ) , 'rb' ) ;
			if( ! $fp ) {
				$this->_setErrors( "stream_socket_client error ($errono) ".htmlspecialchars( $errstr ) ) ;
			} else {
				fputs ($fp, "GET ".$url_elements['path']." HTTP/1.1\r\nHost: ".$url_elements['host']."\r\nAccept: *"."/"."*\r\n\r\n");
				$http_header = '' ;
				$http_content = '' ;
				while( ! feof( $fp ) ) {
					$line = fgets( $fp , 65536 ) ;
					$http_header .= $line ;
					if( in_array( $line , array( "\n" , "\r\n" , "\r" ) ) ) break ;
				}
				while( ! feof( $fp ) ) {
					$line = fgets( $fp , 65536 ) ;
					$http_content .= $line ;
				}
				fclose( $fp ) ;
			} */

		} else {

			// fopen (1 or fallback)
			$fp = @fopen( $this->_hl->getVar( 'headline_rssurl' ) , 'rb' ) ;
			if( ! $fp ) {
				$this->_setErrors( 'Could not open file: '.htmlspecialchars( $this->_hl->getVar('headline_rssurl') ) ) ;
				$is_fetch_error = true ;
			} else {
				$http_content = '' ;
				while( ! feof( $fp ) ) {
					$line = fgets( $fp , 65536 ) ;
					$http_content .= $line ;
				}
				fclose( $fp ) ;
			}

		}

		// error in fetch
		if( ! empty( $is_fetch_error ) ) {
			if( $is_admin ) {
				return false ;
			} else {
				// For visitors access, old data will be alive.
				$this->_hl->setVar('headline_updated', time(), true );
				$headline_handler =& xoops_getmodulehandler('headline', $this->_mydirname);
				return $headline_handler->insert($this->_hl);
			}
		}

		$xml_utf8 = trim( $this->convertToUtf8( $http_content ) ) ;

		// $xml_utf8 = str_replace( $xml_utf8 , chr(0) , '' ) ;

		if( ! $this->_parse( $xml_utf8 ) ) {
			if( $is_admin ) {
				return false ;
			} else {
				// For visitors access, old data will be alive.
				$this->_hl->setVar('headline_updated', time(), true );
				$headline_handler =& xoops_getmodulehandler('headline', $this->_mydirname);
				return $headline_handler->insert($this->_hl);
			}
		}

		$channel_data = $this->_parser->getChannelData();
		array_walk( $channel_data , array( $this , 'convertFromUtf8' ) ) ;

		$image_data = $this->_parser->getImageData();
		array_walk( $image_data , array( $this , 'convertFromUtf8' ) ) ;

		$no_pubdate = false ;
		$items = $this->_parser->getItems() ;
		$items_extracted = array() ;
		$title_pattern = $this->_hl->getVar('headline_titlepattern') ;
		$title_exclude = $this->_hl->getVar('headline_titleexclude') ;
		$link_pattern = $this->_hl->getVar('headline_linkpattern') ;
		$link_exclude = $this->_hl->getVar('headline_linkexclude') ;
		foreach( array_keys( $items ) as $i ) {
			if( empty( $items[$i]['pubdate'] ) ) {
				$items[$i]['pubdate'] = '' ;
				$no_pubdate = true ;
			}
			array_walk( $items[$i] , array( $this , 'convertFromUtf8' ) ) ;
			if( $title_pattern && ! preg_match( $title_pattern , $items[$i]['title'] ) ) continue ;
			if( $title_exclude && preg_match( $title_exclude , $items[$i]['title'] ) ) continue ;
			if( $link_pattern && ! preg_match( $link_pattern , $items[$i]['link'] ) ) continue ;
			if( $link_exclude && preg_match( $link_exclude , $items[$i]['link'] ) ) continue ;
			// sanitize (strip tags if html is not allowed)
			if( ! $this->_hl->getVar('headline_allowhtml' ) ) {
				$items[$i]['description'] = htmlspecialchars( @$items[$i]['description'] , ENT_QUOTES ) ;
				$items[$i]['content'] = htmlspecialchars( @$items[$i]['content'] , ENT_QUOTES ) ;
				array_walk( $items[$i] , array( $this , 'stripTags' ) ) ;
				$items[$i]['description'] = nl2br( preg_replace( '/(\n{2,})/s' , "\n" , @$items[$i]['description'] ) ) ;
				$items[$i]['content'] = nl2br( preg_replace( '/(\n{2,})/s' , "\n" , @$items[$i]['content'] ) ) ;
			}
			$items_extracted[] = $items[$i] ;
		}
		if( ! $no_pubdate ) usort( $items_extracted , create_function( '$a,$b' , 'return $a["pubdate"] < $b["pubdate"] ? 1 : -1 ;' ) ) ;

		$parsed_cache = array(
			'channel' => ( empty( $channel_data ) ? array() : $channel_data ) ,
			'image' => ( empty( $image_data ) ? array() : $image_data ) ,
			'items' => ( empty( $items_extracted ) ? array() : $items_extracted )
		) ;

		$this->_hl->setVar('headline_xml', $parsed_cache , true ) ;
		$this->_hl->setVar('headline_updated', time() , true );
		$headline_handler =& xoops_getmodulehandler('headline', $this->_mydirname);
		$ret = $headline_handler->insert($this->_hl);
		$this->_hl->vars['headline_xml']['value'] = serialize( $this->_hl->vars['headline_xml']['value'] ) ; // bug of XoopsObject XOBJ_DTYPE_ARRAY
		return $ret ;
	}

	function renderFeed( $force_update = false )
	{
		if ($force_update || $this->_hl->cacheExpired()) {
			if (!$this->updateCache()) {
				return false;
			}
		}

		$parsed_cache = $this->_hl->getVar( 'headline_xml' ) ;
		if( empty( $parsed_cache ) ) return false ;

		$this->_tpl->clear_all_assign();
		$this->_tpl->assign('xoops_url', XOOPS_URL);
		$this->_tpl->assign_by_ref('channel', $parsed_cache['channel']);
		if ($this->_hl->getVar('headline_mainimg') == 1) {
			$this->_tpl->assign_by_ref('image', $parsed_cache['image']);
		}
		if ($this->_hl->getVar('headline_mainfull') == 1) {
			$this->_tpl->assign('show_full', true);
		} else {
			$this->_tpl->assign('show_full', false);
		}

		$items = $parsed_cache['items'] ;
		$count = count($items);
		$max = ($count > $this->_hl->getVar('headline_mainmax')) ? $this->_hl->getVar('headline_mainmax') : $count;

		$i = 0 ;
		foreach( $items as $item ) {
			$item['pubdate_utz'] = xoops_getUserTimestamp( $item['pubdate'] ) ;
			$item['date_short'] = date( _DATESTRING , xoops_getUserTimestamp( $item['pubdate'] ) ) ;
			$item['date'] = formatTimestamp( $item['pubdate'] , 'm' ) ;
			$this->_tpl->append('items', $item);
			if( ++ $i >= $max ) break ;
		}

		$this->_tpl->assign(array('lang_lastbuild' => _HL_LASTBUILD, 'lang_language' => _HL_LANGUAGE, 'lang_description' => _HL_DESCRIPTION, 'lang_webmaster' => _HL_WEBMASTER, 'lang_category' => _HL_CATEGORY, 'lang_generator' => _HL_GENERATOR, 'lang_title' => _HL_TITLE, 'lang_pubdate' => _HL_PUBDATE, 'lang_description' => _HL_DESCRIPTION, 'lang_more' => _MORE, 'dtfmt_long' => _DATESTRING));
		$this->_feed = $this->_tpl->fetch("db:xhld{$this->_mydirnumber}_feed.html");
		return true;
	}


	function renderBlock($force_update = false , $maxlen = 255 )
	{
		if ($force_update || $this->_hl->cacheExpired()) {
			if (!$this->updateCache()) {
				return false;
			}
		}

		$dtfmt_short = empty( $this->config["dtfmt_short"] ) ? '' : $this->config["dtfmt_short"] ;

		$parsed_cache = $this->_hl->getVar( 'headline_xml' ) ;
		if( empty( $parsed_cache ) ) return false ;

		$this->_tpl->clear_all_assign();
		$this->_tpl->assign('xoops_url', XOOPS_URL);
		$this->_tpl->assign_by_ref('channel', $parsed_cache['channel']);
		if ($this->_hl->getVar('headline_blockimg') == 1) {
			$this->_tpl->assign_by_ref('image', $parsed_cache['image']);
		}

		$items = $parsed_cache['items'] ;
		$count = count($items);
		$max = ($count > $this->_hl->getVar('headline_blockmax')) ? $this->_hl->getVar('headline_blockmax') : $count;

		$i = 0 ;
		foreach( $items as $item ) {

			if( strlen( $item['title'] ) >= $maxlen ) {
				if( ! XOOPS_USE_MULTIBYTES ) {
					$item['title'] = substr( $item['title'] , 0 , $maxlen - 1 ) . "..." ;
				} else if( function_exists( 'mb_strcut' ) ) {
					$item['title'] = mb_strcut( $item['title'] , 0 , $maxlen - 1 ) . "..." ;
				}
			}

			$item['pubdate_utz'] = xoops_getUserTimestamp( $item['pubdate'] ) ;
			$item['date_short'] = date( $dtfmt_short , xoops_getUserTimestamp( $item['pubdate'] ) ) ;
			$item['date'] = formatTimestamp( $item['pubdate'] , 'm' ) ;

			$this->_tpl->append('items', $item);
			if( ++ $i >= $max ) break ;
		}

		$this->_tpl->assign(array('mod_url' => XOOPS_URL.'/modules/'.$this->_mydirname, 'site_name' => $this->_hl->getVar('headline_name'), 'site_url' => $this->_hl->getVar('headline_url'), 'site_id' => $this->_hl->getVar('headline_id'), 'dtfmt_long' => _DATESTRING, 'dtfmt_short' => $dtfmt_short));
		$this->_block = $this->_tpl->fetch("db:xhld{$this->_mydirnumber}_block.html");
		return true;
	}


	function getRawDataAsArray($force_update = false , $itemsperfeed = 100 , $maxlen = 255 )
	{
		if ($force_update || $this->_hl->cacheExpired()) {
			if (!$this->updateCache()) {
				return false;
			}
		}

		$ret = array(
			'site_name' => $this->_hl->getVar('headline_name'),
			'site_url' => $this->_hl->getVar('headline_url'),
			'site_id' => $this->_hl->getVar('headline_id')
		) ;

		$parsed_cache = $this->_hl->getVar( 'headline_xml' ) ;
		if( empty( $parsed_cache ) ) return array() ;

		$ret['channel_data'] = $parsed_cache['channel'] ;
		if ($this->_hl->getVar('headline_blockimg') == 1) {
			$ret['image_data'] = $parsed_cache['image'];
		}

		$i = 0 ;
		$ret['items'] = array() ;
		$items = array_slice( $parsed_cache['items'] , 0 , $itemsperfeed ) ;
		foreach( $items as $item ) {
			if( strlen( $item['title'] ) >= $maxlen ) {
				if( ! XOOPS_USE_MULTIBYTES ) {
					$item['title'] = substr( $item['title'] , 0 , $maxlen - 1 ) . "..." ;
				} else if( function_exists( 'mb_strcut' ) ) {
					$item['title'] = mb_strcut( $item['title'] , 0 , $maxlen - 1 ) . "..." ;
				}
			}
			$ret['items'][] = $item ;
		}

		return $ret ;
	}


	function _parse( $xml )
	{
		if (isset($this->_parser)) {
			return true;
		}

		// auto decision
		if( $this->_hl->getVar('headline_syndication') == '' ) {
			if( stristr( substr( $xml , 0 , 255 ) , 'http://purl.org/atom/' ) ) {
				$this->_hl->setVar('headline_syndication','ATOM',true) ;
			} else {
				$this->_hl->setVar('headline_syndication','RSS',true) ;
			}
			$headline_handler =& xoops_getmodulehandler('headline', $this->_mydirname);
			$headline_handler->insert($this->_hl);
		}

		if( $this->_hl->getVar('headline_syndication') == 'ATOM' ) {
			// atom
			if( ! class_exists( 'XhldXmlAtomParser' ) ) {
				include_once XOOPS_ROOT_PATH."/modules/$this->_mydirname/class/xmlatomparser.php";
			}
			$this->_parser = new XhldXmlAtomParser( $xml );
		} else {
			// rss
			if( ! class_exists( 'XhldXmlRss2Parser' ) ) {
				include_once XOOPS_ROOT_PATH."/modules/$this->_mydirname/class/xmlrss2parser.php";
			}
			$this->_parser = new XhldXmlRss2Parser( $xml );
		}

		switch( $this->_hl->getVar('headline_encoding') ) {
			/* case 'iso-8859-1':
				$this->_parser->useIsoEncoding();
				break; */
			case 'us-ascii':
				$this->_parser->useAsciiEncoding();
				break;
			case 'utf-8':
			default:
				$this->_parser->useUtfEncoding();
				break;
		}
		$result = $this->_parser->parse();
		if (!$result) {
			$this->_setErrors($this->_parser->getErrors(false));
			unset($this->_parser);
			return false;
		}
		return true;
	}

	function getFeed()
	{
		return $this->_feed;
	}

	function getBlock()
	{
		return $this->_block;
	}

	function _setErrors( $errs )
	{
		if( is_array( $errs ) ) {
			foreach( $errs as $err ) {
				$this->_errors[] = $err ;
			}
		} else {
			$this->_errors[] = $errs ;
		}
	}

	function getErrors($ashtml = true)
	{
		if (!$ashtml) {
			return $this->_errors;
		} else {
		$ret = '';
		if (count($this->_errors) > 0) {
			foreach ($this->_errors as $error) {
				$ret .= $error.'<br />';
			}
		}
		return $ret;
		}
	}

	function stripTags( &$value )
	{
		if( ! is_string( $value ) ) return ;
		$value = strip_tags( $value ) ;
	}

	// abstract
	// overide this method in /language/your_language/headlinerenderer.php
	// this method is called by the array_walk function
	// return void
	function convertFromUtf8(&$value, $key)
	{
		if( ! is_string( $value ) ) return ;
		if( stristr( _CHARSET , 'iso-8859-1' ) ) $value = utf8_decode( $value ) ;
		else if( $this->_hl->getVar('headline_encoding') == 'iso-8859-1' && ! $this->_hl->getVar('headline_allowhtml') ) $value = htmlentities( utf8_decode( $value ) ) ;
	}

	// abstract
	// overide this method in /language/your_language/headlinerenderer.php
	// return string
	function convertToUtf8(&$xmlfile)
	{
		$encoding = $this->_hl->getVar('headline_encoding') ;

		// auto detection
		if( empty( $encoding ) ) {
			$top_of_xml = substr( $xmlfile , 0 , 255 ) ;
			preg_match( "/^<\?xml .* encoding=['\"]?([0-9a-z_-]+)/i", $top_of_xml , $regs ) ;
			if( empty( $regs ) ) {
				$encoding = 'utf-8' ;
			} else {
				$encoding = strtolower( $regs[1] ) ;
			}
			$this->_hl->setVar( 'headline_encoding' , $encoding , true ) ;
			$headline_handler =& xoops_getmodulehandler('headline', $this->_mydirname);
			$headline_handler->insert($this->_hl);
		}

		switch( strtolower( $encoding ) ) {
			case 'iso-8859-1' :
				$xmlfile = utf8_encode( $xmlfile ) ;
				break ;
			case 'utf-8' :
			default :
				break ;
		}

		return $xmlfile;
	}
}

}

?>