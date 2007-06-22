<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileMyalbumPlugin extends XmobilePlugin
{
	function XmobileMyalbumPlugin()
	{
		// call parent constructor
		XmobilePlugin::XmobilePlugin();
		// define object elements
		$this->initVar('lid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('cid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, '', true, 100);
		$this->initVar('ext', XOBJ_DTYPE_TXTBOX, '', true, 10);
		$this->initVar('res_x', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('res_y', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('submitter', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('status', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('date', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('hits', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('rating', XOBJ_DTYPE_FLOAT, '0', true);
		$this->initVar('votes', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('comments', XOBJ_DTYPE_INT, '0', true);
		// define primary key
		$this->setKeyFields(array('lid'));
		$this->setAutoIncrementField('lid');
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileMyalbumPluginHandler extends XmobilePluginHandler
{
//	var $moduleDir = 'myalbum';
//	var $categoryTableName = 'myalbum_cat';
//	var $itemTableName = 'myalbum_photos';

	var $category_id_fld = 'cid';
	var $category_pid_fld = 'pid';
	var $category_title_fld = 'title';
	var $category_order_fld = 'cid';

	var $item_id_fld = 'lid';
	var $item_cid_fld = 'cid';
	var $item_title_fld = 'title';
	var $item_order_fld = 'date';
	var $item_date_fld = 'date';
	var $item_uid_fld = 'submitter';
	var $item_hits_fld = 'hits';
	var $item_comments_fld = 'comments';

	var $item_order_sort = 'DESC';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileMyalbumPluginHandler($db)
	{
		XmobilePluginHandler::XmobilePluginHandler($db);
		$pluginName = strtolower(basename(__FILE__,'.php'));
		if(!preg_match("/^\w+$/", $pluginName))
		{
			trigger_error('Invalid pluginName');
			exit();
		}
		$this->moduleDir = $pluginName;
		$this->categoryTableName = $pluginName.'_cat';
		$this->itemTableName = $pluginName.'_photos';
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setItemCriteria()
	{
		$this->item_criteria =& new CriteriaCompo();
		$this->item_criteria->add(new Criteria('status',0,'<>'));
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 記事詳細・コメント・編集用リンクの取得
// ただし、戻り値はオブジェクトではなくHTML
	function getItemDetail()
	{
		// debug
		$this->utils->setDebugMessage(__CLASS__, 'getItemDetail criteria', $this->item_criteria->render());
		// 一意のidではなくcriteriaで検索する為、オブジェクトの配列が返される
		if(!$itemObjectArray = $this->getObjects($this->item_criteria))
		{
			// debug
			$this->utils->setDebugMessage(__CLASS__, 'getItemDetail Error', $this->getErrors());
		}

		if(count($itemObjectArray) == 0) // 表示するデータ無し
		{
			$this->controller->render->template->assign('lang_no_item_list',_MD_XMOBILE_NO_DATA);
			return false;
		}

		$itemObject = $itemObjectArray[0];

		if(!is_object($itemObject))
		{
			return false;
		}

		$this->item_id = $itemObject->getVar($this->item_id_fld);
		$url_parameter = $this->getBaseUrl();

		$detail4html = '';
		$detail4html .= _MD_XMOBILE_ITEM_DETAIL.'<br />';
		$id = $itemObject->getVar($this->item_id_fld);

		// タイトル
		if(!is_null($this->item_title_fld))
		{
			$detail4html .= _MD_XMOBILE_TITLE;
			$detail4html .= $itemObject->getVar($this->item_title_fld).'<br />';
		}
		// ユーザ名
		if(!is_null($this->item_uid_fld))
		{
			$uid = $itemObject->getVar($this->item_uid_fld);
			$uname = $this->getUserLink($uid);
			$detail4html .= _MD_XMOBILE_CONTRIBUTOR.$uname.'<br />';
		}
		// 日付・時刻
		if(!is_null($this->item_date_fld))
		{
			$date = $itemObject->getVar($this->item_date_fld);
//			$detail4html .= _MD_XMOBILE_DATE.$this->utils->getDateLong($date).'<br />';
//			$detail4html .= _MD_XMOBILE_TIME.strftime('%H:%M',$date).'<br />';
			$detail4html .= _MD_XMOBILE_LASTUPDATED_DATE.strftime('%Y-%m-%d %H:%M',$date).'<br />';
		}
		// ヒット数
		if(!is_null($this->item_hits_fld))
		{
			$detail4html .= _MD_XMOBILE_HITS.$itemObject->getVar($this->item_hits_fld).'<br />';
			// ヒットカウントの増加
			$this->increaseHitCount($this->item_id);
		}
		// 画像の表示
		$ext = $itemObject->getVar('ext');
		$photo_path = $this->moduleConfig['myalbum_photospath'].'/'.$id.'.'.$ext;
		$photo_root_path = XOOPS_ROOT_PATH.$this->moduleConfig['myalbum_photospath'].'/'.$id.'.'.$ext;
		$thumb_path = $this->moduleConfig['myalbum_thumbspath'].'/'.$id.'.'.$ext;
		$thumb_root_path = XOOPS_ROOT_PATH.$this->moduleConfig['myalbum_thumbspath'].'/'.$id.'.'.$ext;

		if(is_file($thumb_root_path))
		{
			$photo_url = '<img src="'.XOOPS_URL.$thumb_path.'">';
		}
		else
		{
			$photo_url = '<img src="'.XOOPS_URL.$photo_path.'">';
		}
		$detail4html .= $photo_url.'<br />';

		// descriptin from myalbum_text table
		$myalbumDescHandler =& new XmobileMyalbumDescHandler($this->db);
		$myalbumDescObject =& $myalbumDescHandler->get($id);
		if(is_object($myalbumDescObject))
		{
			$description = $myalbumDescObject->getVar('description');
			if($description != '')
			{
				$detail4html .= _MD_XMOBILE_CONTENTS.'<br />';
				$detail4html .= $description.'<br />';
			}
		}
		else
		{
			// debug
			$this->utils->setDebugMessage(__CLASS__, 'myalbumDescObject Error', $myalbumDescHandler->getErrors());
		}

		return $detail4html;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileMyalbumDesc extends XoopsTableObject
{
	function XmobileMyalbumDesc()
	{
		// define object elements
		$this->initVar('lid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('description', XOBJ_DTYPE_TXTAREA, '', true);

		// define primary key
		$this->setKeyFields(array('lid'));
		$this->setAutoIncrementField('lid');
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileMyalbumDescHandler extends XoopsTableObjectHandler
{
	function XmobileMyalbumDescHandler($db)
	{
		$pluginName = strtolower(basename(__FILE__,'.php'));
		if(!preg_match("/^\w+$/", $pluginName))
		{
			trigger_error('Invalid pluginName');
			exit();
		}
		$tableName = $pluginName.'_text';
		XoopsTableObjectHandler::XoopsTableObjectHandler($db);
		$this->tableName = $this->db->prefix($tableName);
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
