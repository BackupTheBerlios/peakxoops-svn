<?php
if(!defined('XOOPS_ROOT_PATH')) exit();

if(!defined('XMOBILE_URL')) define('XMOBILE_URL', XOOPS_URL.'/modules/xmobile');
if(!defined('XMOBILE_INDEX_URL')) define('XMOBILE_INDEX_URL', XOOPS_URL.'/modules/xmobile/index.php');
// ʸ�������ɤ�����
// ʸ�����������Զ�礬���������ϡ�ɬ�פ˱����ƽ񤭴�����
if(!defined('HTML_CODE')) define('HTML_CODE', 'SJIS');
if(!defined('CHARA_SET')) define('CHARA_SET', 'Shift_JIS');
if(!defined('SCRIPT_CODE')) define('SCRIPT_CODE', 'EUC-JP');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileControl
{
	var $utils = null;
	var $render = null;
	var $sessionHandler = null;
	var $session;
	var $pluginHandler = null;
	var $pluginObject = null;
	var $pluginState = null;
	var $pluginClassName = null;
	var $action = null;
	var $actionState = null;
	var $action_array = array('default','plugin','login','logout','lostpass','userinfo','notifications','register','search','pmessage','showpage');
	var $view_array = array('default','list','detail','edit','confirm','showpage');
	var $viewState = null;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileControl()
	{
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function &getInstance()
	{
		static $instance;
		if(!isset($instance)) 
		{
			$instance = new XmobileControl();
		}
		return $instance;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ǽ�˹Ԥ������
// �ƥ��饹�����������å����Υ����å���
	function prepare()
	{
		$this->setUtils();
		$this->convertRequest();
		$this->setSessionHandler();
		$this->setRender();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 2���ܤ˹Ԥ������
// ��������󡢥ӥ塼���ץ饰�������Υ��饹������
	function setAction()
	{
		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/Action.class.php';

		$this->actionState = $this->getRequestActionState();
		$this->viewState = $this->getRequestViewState();
		$className = ucfirst($this->actionState).'Action';
		$fileName = XOOPS_ROOT_PATH.'/modules/xmobile/actions/'.$className.'.php';

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'ActionClassName', $className);
//		$this->utils->setDebugMessage(__CLASS__, 'ActionFileName', $fileName);

		if(!file_exists($fileName))
		{
			trigger_error('Action File Not Exists');
			die();
		}
		require_once $fileName;

		if(class_exists($className))
		{
			$this->setPluginHandler();
			$this->action =& new $className();
			$this->action->prepare($this, $this->pluginHandler);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 3���ܤ˹Ԥ������
// �����󥿡��������������ѥ⥸�塼��ץ饰���󤬻��Ѳ�ǽ�ʾ�硢����Ͽ
	function setAccessLog()
	{
		global $xoopsModuleConfig;
		// Analyzer
		if(in_array('Analyzer', $xoopsModuleConfig['modules_can_use']))
		{
			$this->setAnalyzerPlugin();
		}
		// logcounterx
		if(in_array('logcounterx', $xoopsModuleConfig['modules_can_use']))
		{
			$this->setLogcounterxPlugin();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// setAction()����ƤӽФ����ץ饰���󥯥饹������
// �ץ饰����̾�����˿������ޤޤ����ϡ����饹̾�Ͽ��������
	function setPluginHandler()
	{
		global $xoopsDB;

		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/Plugin.class.php';

		$this->pluginState = $this->getRequestPluginState();
		if(preg_match("/(^\w+)\d$/", $this->pluginState,$matches))
		{
			$this->pluginClassName = $matches[1];
		}
		else
		{
			$this->pluginClassName = $this->pluginState;
		}

		$className = 'Xmobile'.ucfirst($this->pluginClassName).'Plugin';
		$handlerName = 'Xmobile'.ucfirst($this->pluginClassName).'PluginHandler';
		$fileName = XOOPS_ROOT_PATH.'/modules/xmobile/plugins/'.$this->pluginState.'.php';

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'PluginClassName', $className);
//		$this->utils->setDebugMessage(__CLASS__, 'PluginhandlerName', $handlerName);
//		$this->utils->setDebugMessage(__CLASS__, 'PluginFileName', $fileName);

		if(!file_exists($fileName))
		{
			trigger_error('Plugin File Not Exists');
			die();
		}
		require_once $fileName;

		if(class_exists($className))
		{
			$this->pluginHandler =& new $handlerName($GLOBALS['xoopsDB']);
			$this->pluginHandler->prepare($this);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �Ǹ�˹Ԥ������
// ���ꤵ�줿����������¹Ը塢���̤˽���
	function executeAction()
	{
		if($this->action!==null)	// is_object
		{
			$this->action->execute();
		}

		if($this->render!==null)	// is_object
		{
			$this->render->setOutPut();
//			$this->render->setBody()
			$this->setDebugMessage();
			$this->render->display();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function executeView()
	{
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �桼�ƥ���ƥ����饹������
	function setUtils()
	{
		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/Utils.class.php';
		$this->utils =& XmobileUtils::getInstance();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getUtils()
	{
		return $this->utils;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ���å���󥯥饹���������ȹ�
	function setSessionHandler()
	{
		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/XmobileSession.php';
//		$this->sessionHandler =& xoops_getmodulehandler('session','xmobile');
		$this->sessionHandler =& new XmobileSessionHandler($GLOBALS['xoopsDB'],$this);
//		$this->sessionHandler->checkSession($this);
		$this->sessionHandler->checkSession();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function &getSessionHandler()
	{
		return $this->sessionHandler;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ���������饹������
	function setRender()
	{
		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/Render.class.php';
		$this->render =& XmobileRender::getInstance();;
		$this->render->prepare($this);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getActionState()
	{
		return $this->actionState;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ꥯ�����Ȥ��줿�����������������action_array��ʸ����Ⱦȹ礹��
// ����ͤ�'default'
	function getRequestActionState()
	{
		$actonState = trim($this->utils->getGetPost('act','default'));

//		if(!preg_match("/^\w+$/", $actonState))
//		{
//			trigger_error('Invalid Actoin');
//			exit();
//		}

		if(!in_array($actonState, $this->action_array))
		{
			trigger_error('Invalid Actoin');
			exit();
		}
		return $actonState;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getPluginState()
	{
		return $this->pluginState;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ꥯ�����Ȥ��줿�ץ饰�����������ƻ��Ѳ�ǽ�ʥ⥸�塼�������Ⱦȹ礹��
// ����ͤ�'default'
	function getRequestPluginState()
	{
		global $xoopsModuleConfig;

		$pluginState = trim($this->utils->getGetPost('plg','default'));

		if($pluginState == 'default') return $pluginState;

		if(!in_array($pluginState, $xoopsModuleConfig['modules_can_use']))
		{
			trigger_error('Invalid Plugin');
			exit();
		}
		return $pluginState;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getViewState()
	{
		return $this->viewState;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ꥯ�����Ȥ��줿�ӥ塼���������view_array��ʸ����Ⱦȹ礹��
// ����ͤ�'default'
	function getRequestViewState()
	{
		$viewState = trim($this->utils->getGetPost('view','default'));

		if($viewState == '') return 'default';

		if($viewState == 'default') return $viewState;

		if(!in_array($viewState, $this->view_array))
		{
			trigger_error('Invalid View');
			exit();
		}
		return $viewState;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ǥХå��⡼�ɤ�ͭ���ʾ�硢�ǥХå���å�������render���Ϥ�
	function setDebugMessage()
	{
		global $xoopsModuleConfig;

		if($xoopsModuleConfig['debug_mode'])
		{
			$this->render->setDebugMessage($this->utils->getDebugMessage());
//			$this->render->template->assign('debug_message',$this->utils->getDebugMessage());
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function convertRequest()
	{
		if(isset($_GET))
		{
			$this->convertEnc($_GET, $type='get');
		}
		if(isset($_POST))
		{
			$this->convertEnc($_POST, $type='post');
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ꥯ�����Ȥ�ʸ�����󥳡��ɤ�EUC-JP���Ѵ�
	function convertEnc($value, $type)
	{
		foreach($value as $key=>$val)
		{
		
			if($val != '')
			{
				if(is_array($val))
				{
					$this->convertEnc($val, $type);
				}
				else
				{
//					$code = mb_detect_encoding($val);
					$code = mb_detect_encoding($val, 'auto');
			// debug
//			$this->utils->setDebugMessage(__CLASS__, 'http_input value', $val);
//			$this->utils->setDebugMessage(__CLASS__, 'http_input encodeing', $code);

//					if(!eregi('euc', $code) && $code != '')
					if(!preg_match('/EUC-JP/i', $code))
					{
//						$val = mb_convert_encoding($val, 'EUC-JP', $code);
						$val = mb_convert_encoding($val, 'EUC-JP', 'auto');
					}
				}

				if($type == 'get')
				{
					$_GET[$key] = $val;
				}
				elseif($type == 'post')
				{
					$_POST[$key] = $val;
				}
			}
			unset($key);unset($val);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// analyzer�⥸�塼��ץ饰���󤬻��Ѳ�ǽ�ʾ��
	function setAnalyzerPlugin()
	{
		global $xoopsModuleConfig;

		$className = 'XmobileAnalyzerPlugin';
		$handlerName = 'XmobileAnalyzerPluginHandler';
		$fileName = XOOPS_ROOT_PATH.'/modules/xmobile/plugins/Analyzer.php';

		if(!file_exists($fileName))
		{
			return;
		}
		require_once $fileName;

		if(!class_exists($className))
		{
			return;
		}
		$analyzerPluginHandler =& new $handlerName($GLOBALS['xoopsDB']);
//		$analyzerPluginHandler->prepare($this);
		$analyzerPluginHandler->setAccessLog();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// logcounterx�⥸�塼��ץ饰���󤬻��Ѳ�ǽ�ʾ��
	function setLogcounterxPlugin()
	{
		global $xoopsModuleConfig;

		$className = 'XmobileLogcounterxPlugin';
		$handlerName = 'XmobileLogcounterxPluginHandler';
		$fileName = XOOPS_ROOT_PATH.'/modules/xmobile/plugins/logcounterx.php';

		if(!file_exists($fileName))
		{
			return;
		}
		require_once $fileName;

		if(!class_exists($className))
		{
			return;
		}
		$analyzerPluginHandler =& new $handlerName($GLOBALS['xoopsDB']);
//		$analyzerPluginHandler->prepare($this);
		$analyzerPluginHandler->setAccessLog();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
