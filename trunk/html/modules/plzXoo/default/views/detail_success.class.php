<?php

class default_DetailView_success
{
	function &execute (&$controller, &$request, &$user)
	{
		$question=&$request->getAttribute('question');
		$answers_obj=&$request->getAttribute('answers');

		$answers=array();
		foreach($answers_obj as $answer) {
			$ret = $answer->getStructure();
    		$ret['enable_edit']=$answer->isEnableEdit($user);
    		$ret['enable_delete']=$answer->isEnableDelete($user);
    		$answers[]=&$ret;
    		unset($ret);
		}

		// 権限チェック
		$question_arr = $question->getStructure();
		$question_arr['enable_edit']=$question->isEnableEdit($user);
		$question_arr['enable_delete']=$question->isEnableDelete($user);
		
		// メッセージ権限のチェック
		$question_arr['enable_message'] = is_object($user) ? 
			($user->isAdmin() || $user->uid()==$question->getVar('uid')) : false;

		$renderer = new mojaLE_XoopsTplRenderer($controller,$request,$user);
		$renderer->setTemplate('plzxoo_detail.html');
		$renderer->setAttribute('question',$question_arr);
		$renderer->setAttribute('answers',$answers);
		$renderer->setAttribute('enable_post_answer',exPerm::isPerm('post_answer')&& $question->getVar('uid') != $user->uid() | exPerm::isPerm('post_answer_myself') ) ; // GIJ
		return $renderer;
	}
}

?>