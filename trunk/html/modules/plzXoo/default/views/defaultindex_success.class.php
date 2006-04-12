<?php

class default_DefaultindexView_success
{
	function &execute (&$controller, &$request, &$user)
	{
		$objs=&$request->getAttribute('questions');
		$questions=array();
		foreach($objs as $obj) {
			$arr=&$obj->getStructure();
			$arr['size_str']=@sprintf(_MD_PLZXOO_FORMAT_ANSWERS_COUNT,$arr['size']);
			$questions[]=&$arr;
			unset($arr);
		}

		$listController=&$request->getAttribute('listController');

		$renderer = new mojaLE_XoopsTplRenderer($controller,$request,$user);
		$renderer->setTemplate('plzxoo_index.html');
		$renderer->setAttribute('questions',$questions);
		$renderer->setAttribute('listController',$listController->getStructure());
		
		exFrame::init(EXFRAME_PERM);
		$renderer->setAttribute('enable_post_question',exPerm::isPerm('post_question'));

		return $renderer;
	}
}

?>