<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobilePageSession extends XoopsTableObject
{
	function XmobilePageSession()
	{
		// define object elements
		$this->initVar('page_session_id', XOBJ_DTYPE_INT, '', true);
		$this->initVar('session_id', XOBJ_DTYPE_TXTBOX, '', true, 32);
		$this->initVar('last_access', XOBJ_DTYPE_INT, time(), true);
		$this->initVar('page', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('contents', XOBJ_DTYPE_TXTAREA, '', false);

		$this->setAttribute('dohtml',1);
		$this->setAttribute('dosmiley',1);
		$this->setAttribute('doxcode',1);
		$this->setAttribute('doimage',1);

		// define primary key
		$this->setKeyFields(array('page_session_id'));
		$this->setAutoIncrementField('page_session_id');
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobilePageSessionHandler extends XoopsTableObjectHandler
{
	var $controller;
	var $sessionHandler;

	var $tableName = 'xmobile_page_session';
	var $mClass = 'XmobilePageSession';

	var $session_id = '';
	var $page_session_id = null;
	var $page_count = 0;
	var $timeoutFlag = 0;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobilePageSessionHandler($db)
	{
		XoopsTableObjectHandler::XoopsTableObjectHandler($db);
		$this->tableName = $this->db->prefix($this->tableName);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setPageSession(&$controller,$html_array)
	{
		$myts =& MyTextSanitizer::getInstance();

		$this->page_count = count($html_array);
		$this->controller = $controller;
		$this->sessionHandler =& $this->controller->getSessionHandler();
		$this->session_id = $this->sessionHandler->getSessionID();
		if($this->session_id == '')
		{
			$this->session_id = $this->sessionHandler->createSessionId();
		}

		if($ret = $this->deletePageSession())
		{
//			return false;
		}

		for($page=1; $page <= $this->page_count; $page++)
		{
			$html_str = $html_array[$page];
//			$html_str = $this->db->quoteString($html_str);

			$this->mClass =& $this->create();
			$this->mClass->setVar('session_id', $this->session_id);
			$this->mClass->setVar('last_access', time());
			$this->mClass->setVar('page', $page);
			$this->mClass->setVar('contents', $html_str);
//			$ret = $this->insert($this->mClass);
			$ret = $this->insert($this->mClass,true);

			// debug
			if($ret)
			{
				$this->controller->utils->setDebugMessage(__CLASS__, 'setPageSession insert', 'Successed');
			}
			else
			{
//				$this->controller->utils->setDebugMessage(__CLASS__, 'setPageSession insert', 'Failed');
				$this->controller->utils->setDebugMessage(__CLASS__, 'setPageSession Error', $this->getErrors());
			}
		}

		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'setPageSession page_count', $this->page_count);

		return true;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getPageSession(&$controller,$page)
	{
		global $xoopsModuleConfig;
		$myts =& MyTextSanitizer::getInstance();

		$this->controller = $controller;
		$this->session_id = $this->controller->sessionHandler->getSessionID();
		$limit_access = time() - $xoopsModuleConfig['session_limit'];

		$criteria =& new CriteriaCompo();
		$criteria = $criteria->add(new Criteria('session_id', $myts->addSlashes($this->session_id)));

		$pageSessionArray =& $this->getObjects($criteria);
		$this->page_count = count($pageSessionArray);

		if($this->page_count > 0)
		{
			if($xoopsModuleConfig['session_limit'] > 0)
			{
				$this->deleteTimeOutPageSession();
			}

			$contents = '';
			foreach($pageSessionArray as $pageSession)
			{
				if($pageSession->getVar('page') == $page)
				{
					if($pageSession->getVar('last_access') < $limit_access)
					{
						$this->setTimeOutFlag();
						$contents = false;
					}
					else
					{
						$this->updatePageSession($pageSession);
						$contents = $pageSession->getVar('contents','show');
					}
				}
			}
		}
		else
		{
			$contents = false;
		}

		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'page', $page);
		$this->controller->utils->setDebugMessage(__CLASS__, 'max_page', $this->page_count);
		if($this->getErrors() != '')
		{
			$this->controller->utils->setDebugMessage(__CLASS__, 'getPageSession Error', $this->getErrors());
		}

		return $contents;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getPageCount()
	{
		return $this->page_count;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getSessionID()
	{
		return $this->session_id;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function updatePageSession(&$pageSession)
	{
		if(!is_object($pageSession))
		{
			return false;
		}
		else
		{
//			$this->session_id = $this->controller->sessionHandler->createSessionId();
//			$pageSession->setVar('session_id',$this->session_id);
			$pageSession->setVar('last_access',time());
			if($this->insert($pageSession,true))
			{
				// debug
				$this->controller->utils->setDebugMessage(__CLASS__, 'updatePageSession', 'Successed');
				return true;
			}
			else
			{
				// debug
				$this->controller->utils->setDebugMessage(__CLASS__, 'updatePageSession', 'Failed');
				return false;
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function deletePageSession()
	{
		$myts =& MyTextSanitizer::getInstance();

		$criteria =& new CriteriaCompo();
		$criteria = $criteria->add(new Criteria('session_id', $myts->addSlashes($this->session_id)));
		$pageSessionCount = $this->getCount($criteria);
		if($pageSessionCount > 0)
		{
			if($ret = $this->deleteAll($criteria,true))
			{
				return true;
			}
			else
			{
				//debug
				$this->controller->utils->setDebugMessage(__CLASS__, 'deletePageSession Error', $this->getErrors());
				return false;
			}
		}
		else
		{
			return true;
		}

//		$this->mClass =& $this->get($this->session_id);
//		$this->delete($this->mClass);
//		unset($this->session_id);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setTimeOutFlag()
	{
		$this->timeoutFlag = true;
		unset($this->mClass);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function deleteTimeOutPageSession()
	{
		global $xoopsModuleConfig;
		$limit_access = time() - $xoopsModuleConfig['session_limit'];
		$criteria = new Criteria('last_access', $limit_access);
		if(!$ret = $this->deleteAll($criteria,true))
		{
			//debug
			$this->controller->utils->setDebugMessage(__CLASS__, 'deleteTimeOutPageSession Error', $this->getErrors());
			return false;
		}
		else
		{
			//debug
			$this->controller->utils->setDebugMessage(__CLASS__, 'deleteTimeOutPageSession','Successed');
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
