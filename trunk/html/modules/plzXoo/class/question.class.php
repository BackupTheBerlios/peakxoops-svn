<?php

require_once "xoops/object.php";
require_once "xoops/user.php";

/// ���ơ������ͤ򥹥ơ�����ʸ����˳�����Ƥ�����
$GLOBALS['plzxoo_status_mapping'] = array (
	1 => _MD_PLZXOO_LANG_STATUS_OPEN,
	2 => _MD_PLZXOO_LANG_STATUS_CLOSE,
	3 => _MD_PLZXOO_LANG_STATUS_DEACTIVE
);

class plzXooQuestionObject extends exXoopsObject {
	function plzXooQuestionObject($id=null)
	{
		$this->initVar('qid', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('cid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('subject', XOBJ_DTYPE_TXTBOX, null, true, 255);
		$this->initVar('body', XOBJ_DTYPE_TXTAREA, null, true, null);
		$this->initVar('input_date', XOBJ_DTYPE_INT, time(), false);
		$this->initVar('priority', XOBJ_DTYPE_INT, 3, true);
		$this->initVar('status', XOBJ_DTYPE_INT, 1, true);
		$this->initVar('size', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('for_search', XOBJ_DTYPE_TXTAREA, null, false, null);

		if ( is_array ( $id ) )
			$this->assignVars ( $id );
	}

	function &getStructure($type='s')
	{
		$ret =& parent::getStructure($type);

   		$uHandler=&xoops_gethandler('user');
   		$user = new exXoopsUserObject($uHandler->get($this->getVar('uid')));
   		$ret['user']=$user->getArray($type);

		$ret['status_str'] = $GLOBALS['plzxoo_status_mapping'][$this->getVar('status')];

		// ���ƥ���
		if($ret['cid']) {
			$cHandler=&plzXoo::getHandler('category');
			$category=&$cHandler->get($ret['cid']);
			$ret['category']=&$category->getArray();
		}

		return $ret;
	}

	/// Database Connect Model
	function &getTableInfo()
	{
		$tinfo = new exTableInfomation('plzxoo_question','qid');
		return ($tinfo);
	}

	/**
	@brief ������������ľ��
	@remark �ǡ������֥������ȤΥ᥽�åɤȤ��ƥ����ɤ���̯�����������������Τ����ΤȤ����ɤ�
	*/
	function updateSize()
	{
		$handler=&plzXoo::getHandler('answer');
		$answers=&$handler->getObjects(new Criteria('qid',$this->getVar('qid')));
		$size=sizeof($answers);
		$this->setVar('size',$size);

		// �Ĥ��Ǥ˸����ѥե�����ɤ⹹������
		$for_search = '' ;
		foreach( $answers as $answer ) {
			$for_search .= $answer->getVar('body') . ' ' ;
		}
		$this->setVar('for_search',$for_search);
	}

	/**
	@brief �Խ����¤����뤫�ɤ���
	*/
	function isEnableEdit(&$user)
	{
		exFrame::init(EXFRAME_PERM);
		$uid = is_object($user) ? $user->uid() : 0;
		if($this->getVar('uid')==$uid)
			return exPerm::isPerm('edit_my_question');
		else
			return exPerm::isPerm('edit_other_question');
	}

	/**
	@brief ������¤����뤫�ɤ���
	*/
	function isEnableDelete(&$user)
	{
		exFrame::init(EXFRAME_PERM);
		$uid = is_object($user) ? $user->uid() : 0;
		if($this->getVar('uid')==$uid) {
			return exPerm::isPerm('delete_my_question');
		}
		else {
			return exPerm::isPerm('delete_other_question');
		}
	}
}
?>