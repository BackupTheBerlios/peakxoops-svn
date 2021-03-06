<?php
// リクエストされたビューが'confirm'（各種投稿ビュー）の場合に限り
// リファラーをセットし、クッキー以外でセッションキーを渡せるようにする
// mainfile.php読み込み後、セッションが復元されるので、その前に記述が必要
function checkRequestView()
{
	$check_result = false;

	if(isset($_GET['view']))
	{
		$viewState = trim($_GET['view']);
		if(!preg_match("/^\w+$/", $viewState))
		{
			trigger_error('Invalid view');
			exit();
		}
	}
	elseif(isset($_POST['view']))
	{
		$viewState = trim($_POST['view']);
		if(!preg_match("/^\w+$/", $viewState))
		{
			trigger_error('Invalid view');
			exit();
		}
	}
	else
	{
		$viewState = 'default';
	}
/*
	if($viewState == 'showpage')
	{
		if(isset($_GET[session_name()]))
		{
			$php_session_id = trim($_GET[session_name()]);
			if(strlen($php_session_id) > 32)
			{
				trigger_error('Invalid session_id');
				exit();
			}
			if(!preg_match("/^\w+$/", $php_session_id))
			{
				trigger_error('Invalid session_id');
				exit();
			}
			$check_result = true;
		}
	}
*/
//	if($viewState == 'confirm')
	if($viewState == 'confirm' || isset($_POST['form_op']))
	{
		if(isset($_POST[session_name()]))
		{
			$php_session_id = trim($_POST[session_name()]);
			if(strlen($php_session_id) > 32)
			{
				trigger_error('Invalid session_id');
				exit();
			}
			if(!preg_match("/^\w+$/", $php_session_id))
			{
				trigger_error('Invalid session_id');
				exit();
			}
			$check_result = true;
		}
	}
	return $check_result;
}

if(checkRequestView())
{
	if(isset($_POST['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = htmlspecialchars($_POST['HTTP_REFERER'], ENT_QUOTES);
	ini_set('session.use_only_cookies',0);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once '../../mainfile.php';
require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/Control.class.php';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$xmobileControl =& XmobileControl::getInstance();

$xmobileControl->prepare();
$xmobileControl->setAction();
// カウンタ・アクセス解析用モジュールプラグインが使用可能な場合、ログを記録
$xmobileControl->setAccessLog();
$xmobileControl->executeAction();
//$xmobileControl->executeView();
?>
