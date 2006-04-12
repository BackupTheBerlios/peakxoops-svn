<?php

require_once "include/ListController.php";
require_once XOOPS_ROOT_PATH."/modules/plzXoo/default/forms/CategorySearchFilter.class.php";

class default_DefaultIndexAction extends mojaLE_AbstractAction
{
	function execute(&$controller,&$request,&$user)
	{
		$handler =& plzXoo::getHandler('question');

		$listController=new ListController();
		$listController->filter_=new CategorySearchFilter();
		$listController->filter_->fetch();
		
		$listController->fetch($handler->getCount($listController->filter_->getCriteria()),20);
		$criteria=&$listController->getCriteria();

		// ����
		$objs=&$handler->getObjects($criteria);
		$request->setAttribute('questions',$objs);

		$listController->freeze();
		$request->setAttribute('listController',$listController);

		return VIEW_SUCCESS;
	}

	function isSecure()
	{
		return false;
	}
}

?>