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
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

if( ! class_exists( 'XhldHeadline' ) ) {

class XhldHeadline extends XoopsObject
{

	function XhldHeadline()
	{
		$this->XoopsObject();
		$this->initVar('headline_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('headline_name', XOBJ_DTYPE_TXTBOX, '', true, 4096);
		$this->initVar('headline_url', XOBJ_DTYPE_TXTBOX, 'http://', true, 4096);
		$this->initVar('headline_rssurl', XOBJ_DTYPE_TXTBOX, 'http://', true, 4096);
		$this->initVar('headline_titlepattern', XOBJ_DTYPE_TXTBOX, '', false, 4096);
		$this->initVar('headline_titleexclude', XOBJ_DTYPE_TXTBOX, '', false, 4096);
		$this->initVar('headline_linkpattern', XOBJ_DTYPE_TXTBOX, '', false, 4096);
		$this->initVar('headline_linkexclude', XOBJ_DTYPE_TXTBOX, '', false, 4096);
		$this->initVar('headline_encoding', XOBJ_DTYPE_OTHER, '', false);
		$this->initVar('headline_weight', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('headline_cachetime', XOBJ_DTYPE_INT, 3600, false);
		$this->initVar('headline_display', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('headline_mainimg', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('headline_mainfull', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('headline_mainmax', XOBJ_DTYPE_INT, 10, false);
		$this->initVar('headline_asblock', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('headline_blockimg', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('headline_blockmax', XOBJ_DTYPE_INT, 5, false);
		$this->initVar('headline_xml', XOBJ_DTYPE_ARRAY, array() , false);
		$this->initVar('headline_updated', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('headline_syndication', XOBJ_DTYPE_TXTBOX, '', false);
		$this->initVar('headline_timeout', XOBJ_DTYPE_INT, 10, false);
		$this->initVar('headline_allowhtml', XOBJ_DTYPE_INT, 0, false);
	}

	function cacheExpired()
	{
		if (time() - $this->getVar('headline_updated') > $this->getVar('headline_cachetime')) {
			return true;
		}
		return false;
	}
}

}

if( ! class_exists( 'XhldHeadlineHandler' ) ) {

class XhldHeadlineHandler
{
	var $db;
	var $_tablename;

	function XhldHeadlineHandler(&$db)
	{
		$this->db =& $db;
		// should be override
		$this->_tablename = $this->db->prefix("xhld") ;
	}

	function &getInstance(&$db)
	{
		static $instance;
		if (!isset($instance)) {
			$instance = new XhldHeadlineHandler($db);
		}
		return $instance;
	}

	function &create()
	{
		return new XhldHeadline();
	}

	function &get($id)
	{
		$id = intval($id);
		if ($id > 0) {
			$sql = "SELECT * FROM $this->_tablename WHERE headline_id=".$id;
			if (!$result = $this->db->query($sql)) {
				return false;
			}
			$numrows = $this->db->getRowsNum($result);
			if ($numrows == 1) {
				$headline = new XhldHeadline();
				$headline->assignVars($this->db->fetchArray($result));
				return $headline;
			}
		}
		return false;
	}

	function insert(&$headline)
	{
		if ( strtolower( get_class( $headline ) ) != "xhldheadline") {
			return false;
		}
		if (!$headline->cleanVars()) {
			return false;
		}
		foreach ($headline->cleanVars as $k => $v) {
			${$k} = $v;
		}
		if (empty($headline_id)) {
			$headline_id = $this->db->genId("'.$this->_tablename.'_headline_id_seq");
			$sql = "INSERT INTO $this->_tablename (headline_id, headline_name, headline_url, headline_rssurl, headline_syndication, headline_timeout, headline_allowhtml, headline_titlepattern, headline_titleexclude, headline_linkpattern, headline_linkexclude, headline_encoding, headline_cachetime, headline_asblock, headline_display, headline_weight, headline_mainimg, headline_mainfull, headline_mainmax, headline_blockimg, headline_blockmax, headline_xml, headline_updated) VALUES (".$headline_id.", ".$this->db->quoteString($headline_name).", ".$this->db->quoteString($headline_url).", ".$this->db->quoteString($headline_rssurl).", ".$this->db->quoteString($headline_syndication).", ".$this->db->quoteString($headline_timeout).", ".$this->db->quoteString($headline_allowhtml).", ".$this->db->quoteString($headline_titlepattern).", ".$this->db->quoteString($headline_titleexclude).", ".$this->db->quoteString($headline_linkpattern).", ".$this->db->quoteString($headline_linkexclude).", ".$this->db->quoteString($headline_encoding).", ".$headline_cachetime.", ".$headline_asblock.", ".$headline_display.", ".$headline_weight.", ".$headline_mainimg.", ".$headline_mainfull.", ".$headline_mainmax.", ".$headline_blockimg.", ".$headline_blockmax.", ".$this->db->quoteString($headline_xml).", ".time().")";
		} else {
			$sql = "UPDATE $this->_tablename SET headline_name=".$this->db->quoteString($headline_name).", headline_url=".$this->db->quoteString($headline_url).", headline_rssurl=".$this->db->quoteString($headline_rssurl).", headline_syndication=".$this->db->quoteString($headline_syndication).", headline_timeout=".$this->db->quoteString($headline_timeout).", headline_allowhtml=".$this->db->quoteString($headline_allowhtml).", headline_titlepattern=".$this->db->quoteString($headline_titlepattern).", headline_titleexclude=".$this->db->quoteString($headline_titleexclude).", headline_linkpattern=".$this->db->quoteString($headline_linkpattern).", headline_linkexclude=".$this->db->quoteString($headline_linkexclude).", headline_encoding=".$this->db->quoteString($headline_encoding).", headline_cachetime=".$headline_cachetime.", headline_asblock=".$headline_asblock.", headline_display=".$headline_display.", headline_weight=".$headline_weight.", headline_mainimg=".$headline_mainimg.", headline_mainfull=".$headline_mainfull.", headline_mainmax=".$headline_mainmax.", headline_blockimg=".$headline_blockimg.", headline_blockmax=".$headline_blockmax.", headline_xml = ".$this->db->quoteString($headline_xml).", headline_updated=".$headline_updated." WHERE headline_id=".$headline_id;
		}
		if (!$result = $this->db->queryF($sql)) {
			return false;
		}
		if (empty($headline_id)) {
			$headline_id = $this->db->getInsertId();
		}
		$headline->assignVar("headline_id", $headline_id);
		return $headline_id;
	}

	function delete(&$headline)
	{
		if ( strtolower( get_class( $headline ) ) != "xhldheadline") {
			return false;
		}
		$sql = sprintf("DELETE FROM $this->_tablename WHERE headline_id = %u", $headline->getVar("headline_id"));
		if (!$result = $this->db->query($sql)) {
			return false;
		}
		return true;
	}

	function &getObjects($criteria = null)
	{
		$ret = array();
		$limit = $start = 0;
		$sql = "SELECT * FROM $this->_tablename" ;
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement")) {
			$sql .= " ".$criteria->renderWhere();
			$sql .= " ORDER BY headline_weight ".$criteria->getOrder();
			$limit = $criteria->getLimit();
			$start = $criteria->getStart();
		}
		$result = $this->db->query($sql, $limit, $start);
		if (!$result) {
			return $ret;
		}
		while ($myrow = $this->db->fetchArray($result)) {
			$headline = new XhldHeadline();
			$headline->assignVars($myrow);
			$ret[] =& $headline;
			unset($headline);
		}
		return $ret;
	}

	function getCount($criteria = null)
	{
		$sql = "SELECT COUNT(*) FROM $this->_tablename";
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement")) {
			$sql .= " ".$criteria->renderWhere();
		}
		if (!$result =& $this->db->query($sql)) {
			return 0;
		}
		list($count) = $this->db->fetchRow($result);
		return $count;
	}
}

}



$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

if( strtolower( $mydirname ) != 'xhld' ) eval( '

class '.ucfirst($mydirname).'HeadlineHandler extends XhldHeadlineHandler
{
	function '.ucfirst($mydirname).'HeadlineHandler(&$db)
	{
		$this->db =& $db;
		$this->_tablename = $this->db->prefix("xhld'.$mydirnumber.'") ;
	}

	function &getInstance(&$db)
	{
		static $instance;
		if (!isset($instance)) {
			$instance = new '.ucfirst($mydirname).'HeadlineHandler($db);
		}
		return $instance;
	}
}

' ) ;

?>