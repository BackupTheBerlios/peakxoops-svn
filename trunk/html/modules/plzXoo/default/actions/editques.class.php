<?php

require_once dirname(__FILE__)."/../forms/EditQuestionForm.class.php";

class default_EditquesAction extends mojaLE_AbstractAction
{
	function execute(&$controller,&$request,&$user)
	{
		exFrame::init(EXFRAME_PERM);
		// ��ȡ���¤Υ����å�
		exPerm::GuardRedirect('post_question','index.php',_MD_PLZXOO_ERROR_PERMISSION);

        $id = isset($_REQUEST['qid']) ? intval($_REQUEST['qid']) : 0;
        $handler=&plzXoo::getHandler('question');
        $obj=null;

        if($id)
            $obj=&$handler->get($id);
        if(!is_object($obj)) {
            $obj=&$handler->create();
            $obj->setVar('uid',$user->uid());
        }
        else {
    		// �Խ����¤γ�ǧ
    		if(!$obj->isEnableEdit($user)) {
    			$request->setAttribute('message',_MD_PLZXOO_ERROR_PERMISSION);
    			return VIEW_ERROR;
    		}

			// ���ơ�������1,2�Ȱۤʤ��Τϴ����԰ʳ����å�
			if( ! in_array( $obj->getVar('status') , array(1,2) ) ) {
				if( ! is_object( $GLOBALS['xoopsUser'] ) || ! $GLOBALS['xoopsUser']->isAdmin() )
					return VIEW_ERROR;
			}
        }

        $editform =& new EditQuestionForm();
        if($editform->init($obj)==ACTIONFORM_POST_SUCCESS) {
            $editform->update($obj); // �������Ƥ򥪥֥������Ȥ˼������
            if( $handler->insert($obj) ) {
				// update size of category
				$category_handler =& plzXoo::getHandler('category');
				$category =& $category_handler->get( $obj->getVar('cid') ) ;
				$category->updateSize();
				$category_handler->insert( $category ) ;
                return VIEW_SUCCESS ;
            } else {
                return VIEW_ERROR ;
            }
        }

		// ���ƥ�����������
		$cHandler=&plzXoo::getHandler('category');
		$categories=&$cHandler->getObjects();

        $request->setAttribute('editform',$editform);
        $request->setAttribute('categories',$categories);
        return VIEW_INPUT;
	}
	
	function isSecure()
	{
		return true;
	}
}

?>