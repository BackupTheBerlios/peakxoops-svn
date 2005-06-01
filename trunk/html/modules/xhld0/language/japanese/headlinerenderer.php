<?php
// $Id: headlinerenderer.php,v 1.1 2003/07/02 17:59:05 onokazu Exp $
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

if (function_exists('mb_convert_encoding') && ! class_exists( 'XhldRendererLocal' ) ) {
	class XhldRendererLocal extends XhldRenderer
	{
		function XhldRendererLocal( &$headline , $mydirname='xhld0' )
		{
			parent::XhldRenderer( $headline , $mydirname ) ;
			if( ! preg_match( '/(EUC-JP|UTF-8|SJIS)/i' , mb_internal_encoding() ) ) {
				mb_internal_encoding( 'EUC-JP' ) ;
			}
		}

		function convertFromUtf8(&$value, $key)
		{
			if( ! is_string( $value ) ) return ;
			if( stristr( _CHARSET , 'iso-8859-1' ) ) {
				$value = utf8_decode( $value ) ;
			} else if( $this->_hl->getVar('headline_encoding') == 'iso-8859-1' && ! $this->_hl->getVar('headline_allowhtml') ) {
				$value = htmlentities( utf8_decode( $value ) ) ;
			} else {
				$value = mb_convert_encoding( $value , mb_internal_encoding() , 'UTF-8' ) ;
			}
		}

		function &convertToUtf8(&$xmlfile)
		{
			$encoding = $this->_hl->getVar('headline_encoding') ;

			// auto detection
			if( empty( $encoding ) ) {
				$top_of_xml = substr( $xmlfile , 0 , 255 ) ;
				preg_match( "/^<\?xml .* encoding=['\"]?([0-9a-z_-]+)/i", $top_of_xml , $regs ) ;
				if( empty( $regs ) ) {
					$encoding = 'utf-8' ;
				} else if( stristr( $regs[1] , 'JIS' ) ) {
					$encoding = 'shift_jis' ;
				} else if( stristr( $regs[1] , 'euc' ) ) {
					$encoding = 'euc-jp' ;
				} else if( stristr( $regs[1] , 'utf-8' ) ) {
					$encoding = 'utf-8' ;
				} else {
					$encoding = strtolower( $regs[1] ) ;
				}
				$this->_hl->setVar( 'headline_encoding' , $encoding ) ;
				$headline_handler =& xoops_getmodulehandler('headline', $this->_mydirname);
				$headline_handler->insert($this->_hl);
			}

			switch( strtolower( $encoding ) ) {
				case 'iso-8859-1' :
					$xmlfile = utf8_encode( $xmlfile ) ;
					break ;
				case 'shift_jis' :
					$xmlfile = str_replace( chr( 0 ) , '' , mb_convert_encoding( $xmlfile , "UTF-8" , "Shift_JIS" ) ) ;
					break ;
				case 'euc-jp' :
					$xmlfile = str_replace( chr( 0 ) , '' , mb_convert_encoding( $xmlfile , "UTF-8" , "EUC-JP" ) ) ;
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