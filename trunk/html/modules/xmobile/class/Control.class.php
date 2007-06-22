<?php
if(!defined('XOOPS_ROOT_PATH')) exit();

if(!defined('XMOBILE_URL')) define('XMOBILE_URL', XOOPS_URL.'/modules/xmobile');
if(!defined('XMOBILE_INDEX_URL')) define('XMOBILE_INDEX_URL', XOOPS_URL.'/modules/xmobile/index.php');
// 文字コードの設定
// 文字化け等の不具合が生じた場合は、必要に応じて書き換える
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
// 最初に行われる処理
// 各クラスの生成。セッションのチェック等
	function prepare()
	{
		$this->setUtils();
		$this->convertRequest();
		$this->setSessionHandler();
		$this->setRender();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 2番目に行われる処理
// アクション、ビュー、プラグイン等のクラスを生成
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
// 3番目に行われる処理
// カウンタ・アクセス解析用モジュールプラグインが使用可能な場合、ログを記録
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
// setAction()から呼び出し、プラグインクラスを生成
// プラグイン名末尾に数字が含まれる場合は、クラス名は数字を除く
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
// 最後に行われる処理
// 指定されたアクションを実行後、画面に出力
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
// ユーティリティクラスを生成
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
// セッションクラスを生成・照合
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
// レンダークラスを生成
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
// リクエストされたアクションを取得してaction_arrayの文字列と照合する
// 初期値は'default'
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
// リクエストされたプラグインを取得して使用可能なモジュールの設定と照合する
// 初期値は'default'
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
// リクエストされたビューを取得してview_arrayの文字列と照合する
// 初期値は'default'
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
// デバッグモードが有効な場合、デバッグメッセージをrenderに渡す
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
// リクエストの文字エンコードをEUC-JPに変換
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
// analyzerモジュールプラグインが使用可能な場合
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
// logcounterxモジュールプラグインが使用可能な場合
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
