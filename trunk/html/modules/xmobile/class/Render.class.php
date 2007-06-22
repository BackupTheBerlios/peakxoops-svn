<?php
// HTML出力用クラス
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileRender
{
	var $controller;
	var $pageSessionHandler;

	var $headerTemplateName = 'xmobile_header.html';
	var $contentsTemplateName = '';
	var $footerTemplateName = 'xmobile_footer.html';
	var $template = null;
	var $header = '';
	var $title = '';
	var $body = '';
	var $footer = '';
	var $debugMessage = '';
	var $outPut = '';

	var $headerStrLen = 0;
	var $contentsStrLen = 0;
	var $footerStrLen = 0;

	var $maxDataSize;
	var $dataSize;
	var $hasPage = 0;
	var $session_id = '';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileRender()
	{
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function &getInstance()
	{
		static $instance;
		if(!isset($instance)) 
		{
			$instance = new XmobileRender();
		}
		return $instance;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function prepare(&$controller)
	{
		$this->controller = $controller;
		require_once XOOPS_ROOT_PATH.'/class/template.php';
		require_once SMARTY_DIR.'Smarty.class.php';
		$this->template =& new XoopsTpl();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// コンテンツ出力用テンプレートの指定
// アクションに応じて、各アクションクラスで指定
// 指定しない場合はxmobile_contents.htmlを使用
	function setTemplate($template_name)
	{
		$this->contentsTemplateName = $template_name;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 画面出力処理
// 必要に応じて文字エンコードを変換後表示
	function display()
	{
		$this->outPut = $this->outPut.$this->debugMessage.'</body></html>';

		if(SCRIPT_CODE != HTML_CODE)
		{
			$this->outPut = mb_convert_encoding($this->outPut,HTML_CODE,SCRIPT_CODE);
		}

		echo $this->outPut;

//		mb_http_output(HTML_CODE);
//		ob_start("mb_output_handler");
//		$this->template->display('db:'.$this->contentsTemplateName);
//		ob_end_flush();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 出力用データ設定
	function setOutPut()
	{
		if(!$this->hasPage && !$this->checkDataSize())
		{
			$this->body = $this->splitPage();
		}
		$this->outPut = $this->header.$this->body.$this->footer;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// タグの置換
	function removeIntactTag($text_data)
	{
		$text_data = preg_replace('/\n/','',$text_data);
		$text_data = preg_replace('/\t/','',$text_data);
		$text_data = preg_replace('/\r/','',$text_data);
		$text_data = preg_replace('/<hr \/><hr \/>/i','<hr />',$text_data);
		$text_data = preg_replace('/<br \/><br \/>/i','<br />',$text_data);
		$text_data = preg_replace('/<br \/><\/div>/i','</div>',$text_data);
		$text_data = preg_replace('/<hr \/><\/div>$/i','</div>',$text_data);

		return $text_data;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 画像のサムネイルを生成して置換
// サムネイルはgdthumb.phpを使用して表示
// 外部リンク画像はそのまま出力
	function replaceImage($text_data)
	{
		global $xoopsModuleConfig;
		$width = $xoopsModuleConfig['thumbnail_width'];
		$imgstr = '<img src="'.XOOPS_URL.'([^"">]*)[""][^>]*>';
		$repstr = '<img src="'.XMOBILE_URL.'/gdthumb.php?photo=\\1&amp;width='.$width.'">';

//		$text_data = preg_replace($imgstr,$repstr,$text_data);
//		$text_data = mb_ereg_replace($imgstr,$repstr,$text_data);
//		$text_data = ereg_replace($imgstr,$repstr,$text_data);
		$text_data = eregi_replace($imgstr,$repstr,$text_data);

		return $text_data;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 出力データの文字数のチェック
	function checkDataSize()
	{
		global $xoopsModuleConfig;

		if($xoopsModuleConfig['max_data_size'] == 0)
		{
			$this->controller->utils->setDebugMessage(__CLASS__, 'checkDataSize', 'True');
			return true;
		}
		$this->maxDataSize = $xoopsModuleConfig['max_data_size'] * 1000;
		$this->dataSize = $this->headerStrLen + $this->bodyStrLen + $this->footerStrLen;

		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'maxDataSize', $this->maxDataSize);
		$this->controller->utils->setDebugMessage(__CLASS__, 'dataSize', $this->dataSize);

		if($this->maxDataSize > $this->dataSize)
		{
			$this->controller->utils->setDebugMessage(__CLASS__, 'checkDataSize', 'True');
			return true;
		}
		else
		{
			$this->controller->utils->setDebugMessage(__CLASS__, 'checkDataSize', 'False');
			return false;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 出力データの文字数制限が設定されている場合は
// 制限値で分割
	function splitPage()
	{
		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'splitPage', 'True');
//		$htmlOutput = '';
		$splitedContent4html = '';

		$exclusion_data_size = $this->headerStrLen + $this->footerStrLen;
		$contents_limit_size = $this->maxDataSize - $exclusion_data_size;

		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'contents_limit_size', $contents_limit_size);

		$html_split_array = preg_split('/<br \/>/i',$this->body,-1,PREG_SPLIT_NO_EMPTY);
		$page = 1;
		$save_html_array = array();
		$save_html_array[$page] = '';
		$split_str_len = 0;
		$save_str_len = 0;
		$check_str_len = 0;

		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'count html_split_array', count($html_split_array));

		foreach($html_split_array as $split_str)
		{
			$split_str_len = strlen($split_str);
			$save_str_len = strlen($save_html_array[$page]);
			$check_str_len = $save_str_len + $split_str_len;

			if($check_str_len > $contents_limit_size)
			{
//				if(!preg_match("/[<form|<select]/i",$split_str))
//				{

//					$save_html_array[$page] = $split_str;
					++$page;
					$save_html_array[$page] = $split_str.'<br />';
//				}
//				else
//				{
//					$save_html_array[$page] .= $split_str.'<br />';
//				}
			}
			else
			{
				$save_html_array[$page] .= $split_str.'<br />';
			}
		// debug
//			$this->controller->utils->setDebugMessage(__CLASS__, 'split_str_len', $split_str_len);
//			$this->controller->utils->setDebugMessage(__CLASS__, 'check_str_len', $check_str_len);
//			$this->controller->utils->setDebugMessage(__CLASS__, 'page', $page);
		}

		$html_output = $save_html_array[1];
		$thispage = 1;
		$max_page = $page;

		$save_html_array[1] = $this->title.'<hr />'.$save_html_array[1];
		$this->setPageSession($save_html_array);

		if($max_page > 1)
		{
			$html_output .= $this->getPageNavi($thispage,$max_page,$this->session_id);
//			$html_output .= $this->getPageNavi($thispage,$max_page);
		}

		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'max_page', $max_page);

		return $html_output;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// リダイレクト用画面表示
	function redirectHeader($message='',$interval=3,$baseUrl='')
	{
		global $xoopsModuleConfig,$xoopsConfig;
//		$message = htmlspecialchars($message, ENT_QUOTES);
		$interval = intval($interval);
		if($baseUrl == '')
		{
			$baseUrl = $this->controller->utils->getLinkUrl('default',null,null,$this->controller->sessionHandler->getSessionID());
		}
		elseif(preg_match("/[\\0-\\31]/", $baseUrl) || preg_match("/^(javascript|vbscript|about):/i", $baseUrl))
		{
			$baseUrl = XMOBILE_URL;
		}
		else
		{
			$baseUrl = preg_replace('/&amp;/i', '&',htmlspecialchars($baseUrl, ENT_QUOTES));
		}

//		$this->outPut = '<html><head><meta http-equiv="refresh" content="'.$interval.'; url='.$baseUrl.'" /><title>'.$xoopsModuleConfig['sitename'].'</title></head><body>';

		$this->outPut = '';
		$this->outPut .= '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
		$this->outPut .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'">';
		$this->outPut .= '<head><meta http-equiv="content-type" content="text/html; charset='.CHARA_SET.'" />';
		$this->outPut .= '<meta http-equiv="refresh" content="'.$interval.'; url='.$baseUrl.'" />';
//		$this->outPut .= '<title>'.$xoopsModuleConfig['sitename'].'</title>';
		$this->outPut .= '<title>'.$xoopsConfig['sitename'].'</title>';
		
		$this->outPut .= '<link rel="stylesheet" type="text/css" media="all" href="'.XMOBILE_URL.'/style.css" />';
		$this->outPut .= '</head><body>';

		$this->outPut .= '<div class="header">';
		if($xoopsModuleConfig['logo'] != '')
		{
			$this->outPut .= '<div class="logo"><img src="'.$xoopsModuleConfig['logo'].'" alt="'.$xoopsModuleConfig['sitename'].'"></div>';
		}
		$this->outPut .= '<div class="sitename">'.$xoopsModuleConfig['sitename'].'<hr /></div>';
		$this->outPut .= '</div>';
		$this->outPut .= '<div class="contents">'.$message.'</div>';
		$this->outPut .= $this->footer;

		$this->display();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Headerのセット
	function setHeader()
	{
		global $xoopsModuleConfig,$xoopsConfig;

//		$this->header .= '<html><head><meta http-equiv="Content-Type" content="text/html; charset='.CHARA_SET.'"><title>'.$xoopsModuleConfig['sitename'].'</title></head><body>';

// xhtml 1.0 transitional
//		$this->header .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
//		$this->header .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'" lang="'._LANGCODE.'">';

// xhtml mobile profile
		$this->header .= '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
		$this->header .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'">';
		$this->header .= '<head><meta http-equiv="content-type" content="text/html; charset='.CHARA_SET.'" />';
//		$this->header .= '<title>'.$xoopsModuleConfig['sitename'].' - '.$this->title.'</title>';
		$this->header .= '<title>'.$xoopsConfig['sitename'].' - '.$this->title.'</title>';
		$this->header .= '<link rel="stylesheet" type="text/css" media="handheld,tty,screen,projection" href="'.XMOBILE_URL.'/style.css" />';
		$this->header .= '</head><body>';


		$this->header .= $this->template->fetch('db:'.$this->headerTemplateName, null, null, false);
		$this->headerStrLen = strlen($this->header);
		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'headerStrLen', $this->headerStrLen);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Titleのセット
	function setTitle($title)
	{
		$this->title = $title;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Bodyのセット
	function setBody()
	{
		$this->body = $this->template->fetch('db:'.$this->contentsTemplateName, null, null, false);
		$this->body  = $this->removeIntactTag($this->body );
		$this->body  = $this->replaceImage($this->body );
		$this->bodyStrLen = strlen($this->body);
		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'bodyStrLen', $this->bodyStrLen);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Footerのセット
	function setFooter()
	{
		$this->footer = $this->template->fetch('db:'.$this->footerTemplateName, null, null, false);
//		$this->footer .= '</body></html>';
		$this->footerStrLen = strlen($this->footer);
		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'footerStrLen', $this->footerStrLen);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DebugMessageのセット
	function setDebugMessage($debugMessage)
	{
		$this->debugMessage = '<hr />'.$debugMessage;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	function setHasPage($value)
//	{
//		$this->hasPage = intval($value);
//	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	function getHasPage()
//	{
//		return $this->hasPage;
		// debug
//		$this->controller->utils->setDebugMessage(__CLASS__, 'hasPage', $this->hasPage);
//	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ページセッションの保存データを取得
	function displayPageSession()
	{
		$this->outPut = $this->getPageSession().$this->footer;
		$this->display();
//		exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ページセッションの初期化
// 文字数が制限値を超える場合に使用
	function setPageSession($save_html_array)
	{
		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/XmobilePageSession.php';
		$this->pageSessionHandler =& new XmobilePageSessionHandler($GLOBALS['xoopsDB']);
		$this->pageSessionHandler->setPageSession($this->controller,$save_html_array);
		$this->session_id = $this->pageSessionHandler->getSessionID();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ページセッションの保存データを取得
	function getPageSession()
	{
		$page = intval($this->controller->utils->getGet('page',0));
		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'getPageSession page', $page);

		require_once XOOPS_ROOT_PATH.'/modules/xmobile/class/XmobilePageSession.php';
		$this->pageSessionHandler =& new XmobilePageSessionHandler($GLOBALS['xoopsDB']);
		$pageSession = $this->pageSessionHandler->getPageSession($this->controller,$page);
		$this->session_id = $this->pageSessionHandler->getSessionID();
		$maxPage = $this->pageSessionHandler->getPageCount();

		if($pageSession)
		{
			$this->hasPage = true;
			$page_contents = $this->removeIntactTag($pageSession);
			$page_contents .= $this->getPageNavi($page,$maxPage,$this->session_id);

			return $page_contents;
		}
		else
		{
			$this->hasPage = false;
			return false;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// データ分割表示用ページナビゲーション
	function getPageNavi($page,$max_page,$session_id)
	{
		$pageNavi = '<hr />';

		if($page > 1)
		{
			$previous_page = $page - 1;
//			$pageNavi .= _MD_XMOBILE_PAGESIZELIMIT_OVER_PRE.'<br />';
			$pageNavi .= _MD_XMOBILE_PAGESIZELIMIT_OVER.'<br />';
			$ext = 'page='.$previous_page;
			$baseUrl = $this->controller->utils->getLinkUrl('showpage',null,null,$session_id,$ext);
			$pageNavi .= '[<a href="'.$baseUrl.'">'._MD_XMOBILE_PREV_PAGE.'</a>]';
			$pageNavi .= '&nbsp;&nbsp;';
		}
		else
		{
			$pageNavi .= _MD_XMOBILE_PAGESIZELIMIT_OVER.'<br />';
		}

		if($page < $max_page)
		{
			$next_page = $page + 1;
			$ext = 'page='.$next_page;
			$baseUrl = $this->controller->utils->getLinkUrl('showpage',null,null,$session_id,$ext);
			$pageNavi .= '[<a href="'.$baseUrl.'">'._MD_XMOBILE_NEXT_PAGE.'</a>]';
		}

		return $pageNavi;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
// 使用しない
// ページセッションの初期化 // PHPセッション用
// 文字数が制限値を超える場合に使用
	function setPageSession($save_html_array)
	{
		if(isset($_SESSION['xmobile_page']))
		{
			$_SESSION['xmobile_page'] = array();
		}

		$_SESSION['xmobile_page'] = $save_html_array;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ページセッションの保存データを取得 // PHPセッション用
	function getPageSession()
	{
		$page = intval($this->controller->utils->getGet('page',0));
		// debug
		$this->controller->utils->setDebugMessage(__CLASS__, 'getPageSession page', $page);

		if(isset($_SESSION['xmobile_page']))
		{
			$this->hasPage = true;
			$page_session = $_SESSION['xmobile_page'];
			$max_page = count($page_session);
			$page_contents = $page_session[$page];
			$page_contents .= '<hr />'.$this->getPageNavi($page,$max_page);

			return $page_contents;
		}
		else
		{
			$this->hasPage = false;
			return false;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// データ分割表示用ページナビゲーション // PHPセッション用
	function getPageNavi($page,$max_page)
	{
		$pageNavi = '<hr />';

		if($page > 1)
		{
			$previous_page = $page - 1;
			$pageNavi .= _MD_XMOBILE_PAGESIZELIMIT_OVER.'<br />';
			$ext = 'page='.$previous_page.'&'.SID;
			$baseUrl = $this->controller->utils->getLinkUrl('showpage',null,null,$this->controller->sessionHandler->getSessionID(),$ext);
			$pageNavi .= '[<a href="'.$baseUrl.'">'._MD_XMOBILE_PREV_PAGE.'</a>]';
			$pageNavi .= '&nbsp;&nbsp;';
		}
		else
		{
			$pageNavi .= _MD_XMOBILE_PAGESIZELIMIT_OVER.'<br />';
		}

		if($page < $max_page)
		{
			$next_page = $page + 1;
			$ext = 'page='.$next_page.'&'.SID;
			$baseUrl = $this->controller->utils->getLinkUrl('showpage',null,null,$this->controller->sessionHandler->getSessionID(),$ext);
			$pageNavi .= '[<a href="'.$baseUrl.'">'._MD_XMOBILE_NEXT_PAGE.'</a>]';
		}

		return $pageNavi;
	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>