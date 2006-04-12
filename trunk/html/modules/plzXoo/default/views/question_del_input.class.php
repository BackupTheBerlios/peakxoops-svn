<?php

class default_Question_delView_input
{
	function &execute (&$controller, &$request, &$user)
	{
		$editform=&$request->getAttribute('editform');
		$question=&$request->getAttribute('question');

		$renderer = new mojaLE_Renderer($controller,$request,$user);
		$renderer->setTemplate('question_delete.tpl');

		$renderer->setAttribute('editform',$editform);
		$renderer->setAttribute('question',$question->getStructure());

		return $renderer;
	}
}

?>