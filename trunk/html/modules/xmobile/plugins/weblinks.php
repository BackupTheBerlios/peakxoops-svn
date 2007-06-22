<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileWeblinksPlugin extends XmobilePlugin
{
	function XmobileWeblinksPlugin()
	{
		// call parent constructor
//		XmobilePlugin::XmobilePlugin();

		// define object elements
		$this->initVar('lid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('uid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('cids', XOBJ_DTYPE_TXTBOX, '', true, 100);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, '', true, 100);
		$this->initVar('url', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('banner', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('description', XOBJ_DTYPE_TXTAREA, '', true);
		$this->initVar('name', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('nameflag', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('mail', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('mailflag', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('company', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('addr', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('tel', XOBJ_DTYPE_TXTBOX, '', true, 255);
//		$this->initVar('search', XOBJ_DTYPE_TXTBOX, '', true, );
//		$this->initVar('passwd', XOBJ_DTYPE_TXTBOX, '', true, 255);
//		$this->initVar('admincomment', XOBJ_DTYPE_TXTAREA, '', true);
		$this->initVar('mark', XOBJ_DTYPE_TXTBOX, '', true, 3);
		$this->initVar('time_create', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('time_update', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('hits', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('rating', XOBJ_DTYPE_FLOAT, '0', true);
		$this->initVar('votes', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('comments', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('width', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('height', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('recommend', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('mutual', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('broken', XOBJ_DTYPE_INT, '0', true);
//		$this->initVar('rss_url', XOBJ_DTYPE_TXTBOX, '', true, 255);
//		$this->initVar('rss_flag', XOBJ_DTYPE_INT, '0', true);
//		$this->initVar('rss_xml', XOBJ_DTYPE_TXTAREA, '', true);
//		$this->initVar('rss_update', XOBJ_DTYPE_INT, '0', true);
//		$this->initVar('usercomment', XOBJ_DTYPE_TXTAREA, '', true);
		$this->initVar('zip', XOBJ_DTYPE_TXTBOX, '', true, 100);
		$this->initVar('state', XOBJ_DTYPE_TXTBOX, '', true, 100);
		$this->initVar('city', XOBJ_DTYPE_TXTBOX, '', true, 100);
		$this->initVar('addr2', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('fax', XOBJ_DTYPE_TXTBOX, '', true, 255);

		// define primary key
		$this->setKeyFields(array('lid'));
		$this->setAutoIncrementField('lid');
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileWeblinksPluginHandler extends XmobilePluginHandler
{
//	var $moduleDir = 'weblinks';
//	var $categoryTableName = 'weblinks_category';
//	var $itemTableName = 'weblinks_link';

	var $category_id_fld = 'cid';
	var $category_pid_fld = 'pid';
	var $category_title_fld = 'title';
	var $category_order_fld = 'orders';

	var $item_id_fld = 'lid';
//	var $item_cid_fld = 'cids';
	var $item_title_fld = 'title';
	var $item_description_fld = 'description';
	var $item_uid_fld = 'uid';
	var $item_order_fld = 'time_create';
	var $item_date_fld = 'time_create';
	var $item_hits_fld = 'hits';
	var $item_comments_fld = 'comments';

	var $item_order_sort = 'DESC';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileWeblinksPluginHandler($db)
	{
		XmobilePluginHandler::XmobilePluginHandler($db);
		$pluginName = strtolower( basename( __FILE__ , '.php' ) );
		if( ! preg_match( '/^(\D+)(\d?)$/' , $pluginName , $regs ) )
		{
			trigger_error( 'Invalid pluginName '. htmlspecialchars( $pluginName ) );
		}
		else
		{
			$dirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;
		}
		$this->moduleDir = $pluginName;
		$this->categoryTableName = 'weblinks'.$dirnumber.'_category';
		$this->itemTableName = 'weblinks'.$dirnumber.'_link';
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setItemCriteria()
	{
		$this->item_criteria =& new CriteriaCompo();
		if($this->category_id != 0)
		{
			$lids = $this->getLidsFromCid($this->category_id);
			$this->item_criteria->add(new criteria($this->item_id_fld,$lids,'IN'));
		}

		if(!is_null($this->item_order_fld))
		{
			$this->item_criteria->setSort($this->item_order_fld);
		}
		if(!is_null($this->item_order_sort))
		{
			$this->item_criteria->setOrder($this->item_order_sort);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 最新記事一覧の取得
// ただし、戻り値はオブジェクトではなく配列
	function getRecentList()
	{
		global $xoopsModuleConfig;

		$this->setNextViewState('detail');
		$this->setBaseUrl();
		$this->setItemParameter();
		if(!is_null($this->item_date_fld))
		{
			$this->item_criteria->setSort($this->item_date_fld);
			$this->item_criteria->setOrder('DESC');
			$this->item_criteria->setLimit($xoopsModuleConfig['recent_title_row']);
		}

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'getRecentList criteria', $this->item_criteria->render());
		if(!$itemObjectArray = $this->getObjects($this->item_criteria))
		{
			$this->utils->setDebugMessage(__CLASS__, 'getRecentlist Error', $this->getErrors());
		}

		if(count($itemObjectArray) == 0) // 表示するデータ無し
		{
			$this->controller->render->template->assign('lang_no_item_list',_MD_XMOBILE_NO_DATA);
			return false;
		}

		$recent_list = array();
		$i = 0;
		foreach($itemObjectArray as $itemObject)
		{
			$id = $itemObject->getVar($this->item_id_fld);
			$title = $itemObject->getVar($this->item_title_fld);
			$url_parameter = $this->getBaseUrl();
			if(!is_null($this->category_pid_fld) && !is_null($this->category_pid))
			{
				$url_parameter .= '&amp;'.$this->category_pid_fld.'='.$this->category_pid;
			}
			$url_parameter .= '&amp;'.$this->category_id_fld.'='.$this->getCidFromId($id);
			if(!is_null($this->item_cid_fld))
			{
				$cid = $itemObject->getVar($this->item_cid_fld);
				$url_parameter .= '&amp;'.$this->item_cid_fld.'='.$cid;
			}
			if(!is_null($this->item_id_fld))
			{
				$url_parameter .= '&amp;'.$this->item_id_fld.'='.$id;
			}
			$date = '';
			if(!is_null($this->item_date_fld))
			{
				$date = strftime('%Y-%m-%d %H:%M',$itemObject->getVar($this->item_date_fld));
			}

			$recent_list[$i]['title'] = $this->adjustTitle($title);
			$recent_list[$i]['url'] = $url_parameter;
			$recent_list[$i]['date'] = $date;
			$i++;
		}
		return $recent_list;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 記事詳細・コメント・編集用リンクの取得
// ただし、戻り値はオブジェクトではなくHTML
	function getItemDetail()
	{
		global $xoopsConfig;
		// debug
		$this->utils->setDebugMessage(__CLASS__, 'getItemDetail criteria', $this->item_criteria->render());
		// 一意のidではなくcriteriaで検索する為、オブジェクトの配列が返される
		if(!$itemObjectArray = $this->getObjects($this->item_criteria))
		{
			// debug
			$this->utils->setDebugMessage(__CLASS__, 'getItemDetail Error', $this->getErrors());
		}

		if(count($itemObjectArray) == 0)
		{
			return false;
		}

		$itemObject = $itemObjectArray[0];

		if(!is_object($itemObject))
		{
			return false;
		}

		$this->item_id = $itemObject->getVar($this->item_id_fld);
		$url_parameter = $this->getBaseUrl();

		$title = $itemObject->getVar($this->item_title_fld);
		$uid = $itemObject->getVar($this->item_uid_fld);
		$uname = $this->getUserLink($uid);
		if(!is_null($this->item_date_fld))
		{
			$date = $itemObject->getVar($this->item_date_fld);
		}
		if(!is_null($this->item_hits_fld))
		{
			$hits = $itemObject->getVar($this->item_hits_fld);
			// ヒットカウントの増加
			$this->increaseHitCount($this->item_id);
		}
		$comments = $itemObject->getVar($this->item_comments_fld);

		$description = $itemObject->getVar($this->item_description_fld);
		$url = $itemObject->getVar('url');
		$company = $itemObject->getVar('company');
		$addr = $itemObject->getVar('addr');
		$tel = $itemObject->getVar('tel');
		$zip = $itemObject->getVar('zip');
		$state = $itemObject->getVar('state');
		$city = $itemObject->getVar('city');
		$addr2 = $itemObject->getVar('addr2');
		$recommend = $itemObject->getVar('recommend');
		$mutual = $itemObject->getVar('mutual');

		$detail4html = '';
		$detail4html .= _MD_XMOBILE_ITEM_DETAIL.'<br />';
		// タイトル
		$detail4html .= _MD_XMOBILE_TITLE.$title.'<br />';
		// ユーザ名
		$detail4html .= _MD_XMOBILE_CONTRIBUTOR.$uname.'<br />';
		// 日付・時刻
		$detail4html .= _MD_XMOBILE_DATE.$this->utils->getDateLong($date).'<br />';
		$detail4html .= _MD_XMOBILE_TIME.strftime('%H:%M',$date).'<br />';
		// WebサイトのURL
		if($url !== '')
		{
			$detail4html .= 'url：&nbsp;'.$url.'<br />';
		}
		// 会社名
		if($company !== '')
		{
			$detail4html .= _WLS_COMPANY.'：&nbsp;'.$company.'<br />';
		}
		// 住所
		if($state !== '' || $city !== '' || $addr !== '' || $addr2 !== '')
		{
			$detail4html .= _WLS_ADDR.'：';
			if($zip !== '')
			{
				$detail4html .= '〒'.$zip;
			}
			$detail4html .= $state.$city.$addr.$addr2.'<br />';
			// link google mobile
//			$title_encode = urlencode(mb_convert_encoding($title,HTML_CODE,SCRIPT_CODE));
//			$addr_encode = urlencode(mb_convert_encoding($state.$city.$addr.$addr2,HTML_CODE,SCRIPT_CODE));
//			$detail4html .= '[<a href="http://www.google.co.jp/imode?q='.$title_encode.'&near='.$addr_encode.'&dm=none&site=local&hl=ja&lr=&ie=Shift_JIS&btnG=%8c%9f%8d%f5">map</a>]<br />';
		}
		// 電話番号
		if($tel !== '')
		{
			// 初期設定では電話を発信可能にしていません
//			$tel_link = preg_replace('/[\(\)-]/','',$tel);
//			$detail4html .= _WLS_TEL.'：<a href="tel:'.$tel_link.'">'.$tel.'</a><br />';
			$detail4html .= _WLS_TEL.'：'.$tel.'<br />';
		}
		// ヒット数
		$detail4html .= _WLS_HITS.'：&nbsp;'.$hits.'<br />';
		// コメント
//		$detail4html .= _COMMENTS.'：&nbsp;'.$comments.'<br />';
		// おすすめリンク
		if($recommend)
		{
//		$detail4html .= _WLS_SITE_RECOMMEND.'<br />';
		}
		// 相互リンク
		if($mutual)
		{
//		$detail4html .= _WLS_SITE_MUTUAL.'<br />';
		}
		// 説明
		if($description !== '')
		{
			$detail4html .= _MD_XMOBILE_DESCRIPTION.'<br />';
			$detail4html .= $description.'<br />';
		}
		return $detail4html;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getLidsFromCid($cid)
	{
		global $xoopsModuleConfig;

		$cid = intval($cid);
		$sql = 'SELECT lid FROM '.$this->db->prefix('weblinks_catlink').' WHERE cid = '.$cid;

		$this->utils->setDebugMessage(__CLASS__, 'getLidFromCid sql', $sql);

		$ret = $this->db->query($sql);
		$count = $this->db->getRowsNum($ret);
		$result = $this->db->query($sql);
		if($count == 0)
		{
			return false;
		}
		$lids = '(';
		while(list($lid) = $this->db->fetchRow($result))
		{
			$lid = intval($lid);
			$lids .= ','.$lid;
		}
		$lids .= ')';
		$lids = preg_replace('/^\(,/','(',$lids);
		return $lids;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getCidFromId($lid)
	{
		global $xoopsModuleConfig;

		$lid = intval($lid);
		$sql = 'SELECT cid FROM '.$this->db->prefix('weblinks_catlink').' WHERE lid = '.$lid;

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'getCidFromId sql', $sql);

//		$ret = $this->db->query($sql);
		$ret = $this->db->query($sql,0,1);
		if(!$ret)
		{
			return false;
		}
		while(list($cid) = $this->db->fetchRow($ret))
		{
			return intval($cid);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setCategoryParentId()
	{
		if(is_null($this->category_pid_fld)) return;

		$this->category_pid = intval($this->utils->getGetPost($this->category_pid_fld, 0));

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'category_pid', $this->category_pid);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getChildItemCountById($id)
	{
		global $xoopsModuleConfig;

		$ids = intval($id);
		$idArray = $this->categoryTree->getAllChildId($ids);
		if(count($idArray) > 0)
		{
			$ids .= ',';
			$ids .= join(',',$idArray);
		}
		$sql = 'SELECT lid FROM '.$this->db->prefix('weblinks_catlink').' WHERE cid IN('.$ids.')';
		// debug
		$this->utils->setDebugMessage(__CLASS__, 'getItemCountById sql', $sql);

		$ret = $this->db->query($sql);
		if($ret)
		{
			$itemCount = $this->db->getRowsNum($ret);
			$this->utils->setDebugMessage(__CLASS__, 'getItemCountById count', $itemCount);
			return $itemCount;
		}
		else
		{
			return false;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
