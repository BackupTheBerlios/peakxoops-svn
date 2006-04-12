<?php

class default_CloseView_input
{
	function &execute (&$controller, &$request, &$user)
	{
		$editform=&$request->getAttribute('editform');
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

		$renderer = new mojaLE_Renderer($controller,$request,$user);
		$renderer->setTemplate('close_input.tpl');
		$renderer->setAttribute('editform',$editform);
		$renderer->setAttribute('question',$question->getStructure());
		$renderer->setAttribute('answers',$answers);

		return $renderer;
	}
}

?>