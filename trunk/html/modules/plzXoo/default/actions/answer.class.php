<?php

require_once dirname(__FILE__)."/../forms/EditAnswerForm.class.php";

class default_AnswerAction extends mojaLE_AbstractAction
{
	function execute(&$controller,&$request,&$user)
	{
		exFrame::init(EXFRAME_PERM);
		// 回答権限のチェック
		exPerm::GuardRedirect('post_answer','index.php',_MD_PLZXOO_ERROR_PERMISSION);

        $qid = isset($_REQUEST['qid']) ? intval($_REQUEST['qid']) : 0;
        $qHandler=&plzXoo::getHandler('question');
		// ここで qid を確認
		$question =& $qHandler->get($qid);
		if(!is_object($question)) {
			$request->setAttribute('error_message',_MD_PLZXOO_ERROR_QUESTION_NOT_EXISTS);
			return VIEW_ERROR;
		}
		elseif($question->getVar('status')!=1) {
			$request->setAttribute('error_message',_MD_PLZXOO_ERROR_QUESTION_CLOSED);
			return VIEW_ERROR;
		}
		elseif($question->getVar('uid')==$user->uid()) {
			exPerm::GuardRedirect('post_answer_myself','index.php',_MD_PLZXOO_ERROR_PERMISSION); // GIJ
		} 

        $id = isset($_REQUEST['aid']) ? intval($_REQUEST['aid']) : 0;
        $handler=&plzXoo::getHandler('answer');

        $obj=&$handler->get($id);
        if(!is_object($obj)) {
            $obj=&$handler->create();
            $obj->setVar('uid',$user->uid());
            $obj->setVar('qid',$qid);
        }
        else {
    		// 権限の確認
    		if(!$obj->isEnableEdit($user)) {
    			$request->setAttribute('error_message',_MD_PLZXOO_ERROR_PERMISSION);
    			return VIEW_ERROR;
    		}
        }

        $editform =& new EditAnswerForm();
        if($editform->init($obj)==ACTIONFORM_POST_SUCCESS) {
            $editform->update($obj); // 入力内容をオブジェクトに受け取る
			$request->setAttribute('question',$question);
			if($handler->insert($obj)) {
				// 回答件数を増加させる
				$question->updateSize();
				$qHandler->insert($question);
				return VIEW_SUCCESS;
			}
			else
				return VIEW_ERROR;
        }

        $request->setAttribute('editform',$editform);
        $request->setAttribute('question',$question);
        $request->setAttribute('answer',$obj);
        return VIEW_INPUT;
	}
	
	function isSecure()
	{
		return true;
	}
}

?>