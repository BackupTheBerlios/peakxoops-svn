<?php

class default_Answer_delView_input
{
	function &execute (&$controller, &$request, &$user)
	{
		$editform=&$request->getAttribute('editform');
		$answer=&$request->getAttribute('obj');

		$renderer = new mojaLE_Renderer($controller,$request,$user);
		$renderer->setTemplate('answer_delete.tpl');

		$renderer->setAttribute('editform',$editform);
		$renderer->setAttribute('answer',$answer->getStructure());

		return $renderer;
	}
}

?>