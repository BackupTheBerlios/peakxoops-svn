<?php

require_once "xoops/object.php";

class plzXooCategoryObject extends exXoopsObject {
	function plzXooCategoryObject($id=null)
	{
		$this->initVar('cid', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('pid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('name', XOBJ_DTYPE_TXTBOX, null, true, 255);
		$this->initVar('description', XOBJ_DTYPE_TXTAREA, null, false, null);
		$this->initVar('size', XOBJ_DTYPE_INT, 0, false);

		if ( is_array ( $id ) )
			$this->assignVars ( $id );
	}

	/// Database Connect Model
	function &getTableInfo()
	{
		$tinfo = new exTableInfomation('plzxoo_category','cid');
		return ($tinfo);
	}

	/**
	@brief 回答件数を数え直す
	@remark データオブジェクトのメソッドとしてコードが微妙だが、ここに入れるのが今のところ良い
	*/
	function updateSize()
	{
		$handler=&plzXoo::getHandler('question');
		$size=$handler->getCount(new Criteria('cid',$this->getVar('cid')));
		$this->setVar('size',$size);
	}

	function &getStructure($type='s') {
		$ret =& $this->getArray($type);
		$ret['parents'] = $this->getParents( $this->getVar('cid') ) ;
		$ret['children'] = $this->getChildren( $this->getVar('cid') ) ;

		return $ret;
	}

	/* class function */
	function getParents( $cid , $ret_array = array() )
	{
		if( $cid <= 0 ) return $ret_array ;

		$db =& Database::getInstance() ;
		$sql = "SELECT `pid`,`name` FROM ".$db->prefix('plzxoo_category')." WHERE `cid`=".intval($cid) ;
		$result = $db->query( $sql ) ;
		list( $pid , $name ) = $db->fetchRow( $result ) ;
		array_unshift( $ret_array , array( $cid => $name ) ) ;
		$ret_array = $this->getParents( $pid , $ret_array ) ;

		return $ret_array ;
	}

	/* class function */
	function getChildren( $cid )
	{
		$db =& Database::getInstance() ;
		$sql = "SELECT `cid`,`name` FROM ".$db->prefix('plzxoo_category')." WHERE `pid`=".intval($cid)." ORDER BY `name`" ;
		$result = $db->query( $sql ) ;
		$ret = array() ;
		while( list( $cid , $name ) = $db->fetchRow( $result ) ) {
			$ret[] = array( $cid => $name ) ;
		}

		return $ret ;
	}


}
?>