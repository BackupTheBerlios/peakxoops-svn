<?php

require_once dirname(__FILE__)."/../forms/EditQuestionForm.class.php";

class default_EditquesAction extends mojaLE_AbstractAction
{
	function execute(&$controller,&$request,&$user)
	{
		exFrame::init(EXFRAME_PERM);
		// 投函権限のチェック
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
    		// 権限の確認
    		if(!$obj->isEnableEdit($user)) {
    			$request->setAttribute('message',_MD_PLZXOO_ERROR_PERMISSION);
    			return VIEW_ERROR;
    		}
        }

        $editform =& new EditQuestionForm();
        if($editform->init($obj)==ACTIONFORM_POST_SUCCESS) {
            $editform->update($obj); // 入力内容をオブジェクトに受け取る
            return $handler->insert($obj) ?
                VIEW_SUCCESS : VIEW_ERROR;
        }

		// カテゴリ一覧を取得
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