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
}
?>