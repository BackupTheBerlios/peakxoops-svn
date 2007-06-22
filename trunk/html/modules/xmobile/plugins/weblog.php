<?php
if(!defined('XOOPS_ROOT_PATH')) exit();

// アクセス権限 0：権限なし、1：一覧閲覧許可、2：詳細閲覧許可、4：投稿許可、8：編集許可
if(!defined('XMOBILE_NOPERM')) define('XMOBILE_NOPERM', 0);
if(!defined('XMOBILE_CAN_READ_LIST')) define('XMOBILE_CAN_READ_LIST', 1);
if(!defined('XMOBILE_CAN_READ_DETAIL')) define('XMOBILE_CAN_READ_DETAIL', 2);
if(!defined('XMOBILE_CAN_POST')) define('XMOBILE_CAN_POST', 4);
if(!defined('XMOBILE_CAN_EDIT')) define('XMOBILE_CAN_EDIT', 8);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileWeblogPlugin extends XmobilePlugin
{
	function XmobileWeblogPlugin()
	{
		// call parent constructor
		XmobilePlugin::XmobilePlugin();

		// define object elements
		$this->initVar('blog_id', XOBJ_DTYPE_INT, null, true);
		$this->initVar('user_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('cat_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('created', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, '', false, 128);
		$this->initVar('contents', XOBJ_DTYPE_TXTAREA, '', false);
		$this->initVar('private', XOBJ_DTYPE_TXTBOX, '', false, 1);
		$this->initVar('comments', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('reads', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('trackbacks', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('description', XOBJ_DTYPE_TXTAREA, '', false);
		$this->initVar('dohtml', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('dobr', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('permission_group', XOBJ_DTYPE_TXTBOX, 'all', false, 255);

		// define primary key
		$this->setKeyFields(array('blog_id'));
		$this->setAutoIncrementField('blog_id');

//		$this->initFormElements();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function assignSanitizerElement()
	{
		$this->initVar('dosmiley',XOBJ_DTYPE_INT,1);
		$this->initVar('doxcode',XOBJ_DTYPE_INT,1);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initFormElements()
	{
		if(!$this->isNew())
		{
			$this->assignEditFormElement(array('name'=>'blog_id','type'=>'hidden','value'=>'blog_id'));
			$this->_formCaption = _EDIT;
		}
		else
		{
			$this->_formCaption = _CREATE;
		}
		$this->assignEditFormElement(array('name'=>'user_id','type'=>'hidden','value'=>'user_id'));
		$this->assignEditFormElement(array('name'=>'cat_id','type'=>'hidden','value'=>'cat_id'));
		$this->assignEditFormElement(array('name'=>'title','type'=>'text','title'=>_MD_XMOBILE_TITLE, 'value'=>'title', 'size'=>64, 'maxlength'=>128));

		return true;
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileWeblogPluginHandler extends XmobilePluginHandler
{
//	var $moduleDir = 'weblog';
//	var $categoryTableName = 'weblog_category';
//	var $itemTableName = 'weblog';

	var $category_id_fld = 'cat_id';
	var $category_pid_fld = 'cat_pid';
	var $category_title_fld = 'cat_title';
	var $category_order_fld = 'cat_id';

	var $item_id_fld = 'blog_id';
	var $item_cid_fld = 'cat_id';
	var $item_title_fld = 'title';
	var $item_description_fld = 'contents';
	var $item_order_fld = 'created';
	var $item_date_fld = 'created';
	var $item_uid_fld = 'user_id';
	var $item_hits_fld = 'reads';
	var $item_comments_fld = 'comments';

	var $item_order_sort = 'DESC';

	var $weblog_perm = 0;
	var $weblog_cat_post = null;
	var $new_id = 0;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileWeblogPluginHandler($db)
	{
		XmobilePluginHandler::XmobilePluginHandler($db);
		$pluginName = strtolower(basename(__FILE__,'.php'));
		if(!preg_match("/^\w+$/", $pluginName))
		{
			trigger_error('Invalid pluginName');
			exit();
		}
		$this->moduleDir = $pluginName;
		$this->categoryTableName = $pluginName.'_category';
		$this->itemTableName = $pluginName;
		$this->ticket = new XoopsGTicket;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// モジュールのグループアクセス権限チェック
	function setModulePerm($gperm_name='module_read')
	{
		$pluginState = $this->controller->getPluginState();
		if($pluginState == 'default')
		{
			$this->modulePerm = true;
		}
		else
		{
			$user =& $this->sessionHandler->getUser();
			$this->modulePerm = $this->utils->getModulePerm($user, $this->mid, $gperm_name='module_read');
		}
		// debug
		$this->utils->setDebugMessage(__CLASS__, 'modulePerm', $this->modulePerm);
		$this->checkWeblogPerm();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setItemCriteria()
	{
		$this->item_criteria =& new CriteriaCompo();
		$item_criteria_1 = new CriteriaCompo();
		$item_criteria_1->add(new Criteria('private', 'N'));
		$item_criteria_1->add(new Criteria('user_id', $this->sessionHandler->getUid()),'OR');
		$this->item_criteria->add($item_criteria_1);

		if($this->moduleConfig['use_permissionsystem'])
		{
			$item_criteria_2 = new CriteriaCompo();
			$user =& $this->sessionHandler->getUser();
			$groupid_array = $this->utils->getGroupIdArray($user);
			if(is_object($user))
			{
				foreach($groupid_array as $groupid)
				{
					$item_criteria_2->add(new Criteria('permission_group', '%|'.$groupid.'|%', 'LIKE'),'OR');
				}
			}
			else
			{
				$groupid = 3;
				$item_criteria_2->add(new Criteria('permission_group', '%|'.$groupid.'|%', 'LIKE'),'OR');
			}
			$item_criteria_2->add(new Criteria('permission_group', 'all', 'LIKE'),'OR');
			$this->item_criteria->add($item_criteria_2);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 編集画面
	function getEditView()
	{
		$this->setNextViewState('confirm');
		$this->setBaseUrl();
		$this->setCategoryParameter();
		$entry_type = htmlspecialchars($this->utils->getGetPost('entry_type', ''), ENT_QUOTES);
		$this->controller->render->template->assign('item_detail',$this->renderEntryForm($entry_type));
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 投稿画面
	function getConfirmView()
	{
		$this->setNextViewState('detail');
		$this->setBaseUrl();
		$this->setCategoryParameter();
		$entry_type = htmlspecialchars($this->utils->getGetPost('entry_type', ''), ENT_QUOTES);
		$this->controller->render->template->assign('item_detail',$this->saveEntry($entry_type));
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 記事詳細・コメント・編集用リンクの取得
// ただし、戻り値はオブジェクトではなくHTML
//	function getDetailView()
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
		$itemObject->assignSanitizerElement();

		$detail4html = '';
		$detail4html .= _MD_XMOBILE_ITEM_DETAIL.'<br />';
		// タイトル
		if(!is_null($this->item_title_fld))
		{
			$title = $itemObject->getVar($this->item_title_fld);
			$detail4html .= _MD_XMOBILE_TITLE.$title.'<br />';
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
			$detail4html .= _MD_XMOBILE_DATE.$this->utils->getDateLong($date).'<br />';
			$detail4html .= _MD_XMOBILE_TIME.strftime('%H:%M',$date).'<br />';
		}
		// ヒット数
		if(!is_null($this->item_hits_fld))
		{
			$detail4html .= _MD_XMOBILE_HITS.$itemObject->getVar($this->item_hits_fld).'<br />';
			// ヒットカウントの増加
			$this->increaseHitCount($this->item_id);
		}
		// 詳細
		$description = '';
		if(!is_null($this->item_description_fld))
		{
			$description = $itemObject->getVar($this->item_description_fld);
			// メンバーのみ公開
			if($this->moduleConfig['use_memberonly'])
			{
				if(!is_object($this->sessionHandler->getUser()))
				{
					$register_url = $this->utils->getLinkUrl('register',null,null,$this->sessionHandler->getSessionID());
					$memberonly_string = '<br /><a href="'.$register_url.'">'._BL_MEMBER_ONLY_READ_MORE.'</a>';
					$description = preg_replace('/(---AnonymousUserCantReadUnderHere---).*$/sm',$memberonly_string,$description);
				}
				else
				{
					$description = preg_replace('/---AnonymousUserCantReadUnderHere---/','',$description);
				}
			}
			else
			{
				$description = preg_replace('/---AnonymousUserCantReadUnderHere---/','',$description);
			}
			// 前半後半分割
			$show_letterhalf = intval($this->utils->getGet('show_letterhalf', 0));
			if($this->moduleConfig['use_separator'])
			{
				if(!$show_letterhalf)
				{
					$ext = 'cat_id='.$this->category_id.'&blog_id='.$this->item_id.'&show_letterhalf=1';
					$read_next_url = $this->utils->getLinkUrl($this->controller->getActionState(),$this->controller->getViewState(),$this->controller->getPluginState(),$this->sessionHandler->getSessionID(),$ext);
					$division_next_string = '<br /><a href="'.$read_next_url.'">'._BL_ENTRY_SEPARATOR_NEXT.'</a>';
					$description = preg_replace('/(---UnderThisSeparatorIsLatterHalf---).*$/sm',$division_next_string,$description);
				}
				else
				{
					$description = preg_replace('/---UnderThisSeparatorIsLatterHalf---/','',$description);
				}
			}
			else
			{
				$description = preg_replace('/---UnderThisSeparatorIsLatterHalf---/','',$description);
			}

			$detail4html .= _MD_XMOBILE_CONTENTS.'<br />';
			$detail4html .= $description.'<br />';
		}
		// その他の表示フィールド
		if(count($this->item_extra_fld) > 0)
		{
			foreach($this->item_extra_fld as $key=>$caption)
			{
				if($itemObject->getVar($key))
				{
					$detail4html .= $caption;
					$detail4html .= $itemObject->getVar($key).'<br />';
				}
			}
		}
		return $detail4html;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getEditLink($id=0)
	{
		$this->checkEntryAccess($id);

		if($this->weblog_perm < XMOBILE_CAN_POST)
		{
			return false;
		}
		else
		{
			$edit_link = '';
			if($id != 0 && $this->weblog_perm >= XMOBILE_CAN_EDIT)
			{
				$edit_url = $this->utils->getLinkUrl($this->controller->getActionState(),'edit',$this->controller->getPluginState(),$this->sessionHandler->getSessionID());
				$delete_url = $this->utils->getLinkUrl($this->controller->getActionState(),'edit',$this->controller->getPluginState(),$this->sessionHandler->getSessionID());
				$edit_link .= '<a href="'.$edit_url.'&amp;entry_type=edit_entry&amp;blog_id='.$id.'">'._EDIT.'</a>&nbsp;';
				$edit_link .= '<a href="'.$delete_url.'&amp;entry_type=delete_entry&amp;blog_id='.$id.'">'._DELETE.'</a>';
				$edit_link .= '<hr />';
			}
			$add_url = $this->utils->getLinkUrl($this->controller->getActionState(),'edit',$this->controller->getPluginState(),$this->sessionHandler->getSessionID());
			$edit_link .= '<a href="'.$add_url.'&amp;entry_type=new_entry&amp;cat_id='.$this->category_id.'">'._MD_XMOBILE_POSTNEW.'</a>&nbsp;';
			return $edit_link;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function getCommentLink($id)
	{
		if(!is_null($this->item_comments_fld))
		{
			include_once XOOPS_ROOT_PATH.'/modules/xmobile/class/Comments.class.php';
			$xmobile_comment =& new XmobileComments($this->controller,$this,$id,$this->category_id,$this->itemDetailPageNavi->getStart());
			$comment_link = $xmobile_comment->makeCommentLink();
			if($comment_link)
			{
				$com_count = $xmobile_comment->com_count;
				$this->updateCommentCount($id, $com_count);
				return $comment_link;
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// @return int $forum_access アクセス権限 0：権限なし、1：一覧閲覧許可、2：詳細閲覧許可、4：投稿許可、8：編集許可
	function checkWeblogPerm()
	{
		$privilege_system = $this->moduleConfig['privilege_system'];

		$user =& $this->sessionHandler->getUser();
		$groupid_array = $this->utils->getGroupIdArray($user);

		if(count($groupid_array) > 0)
		{
			$groups = join(',',$groupid_array);
		}
		else
		{
			$groups = $groups_array[0];
		}


		if($privilege_system == 'weblog')
		{
			$sql = "SELECT priv_gid FROM ".$this->db->prefix($this->moduleDir.'_priv')." WHERE priv_gid IN(".$groups.")";

			// debug
			$this->utils->setDebugMessage(__CLASS__, 'privilege sql', $sql);

			$ret = $this->db->query($sql);
			$count = $this->db->getRowsNum($ret);
			if(is_object($user) && !$this->moduleConfig['adminonly'] && $count)
			{
				$this->weblog_perm = XMOBILE_CAN_POST;
			}
		}
		elseif($privilege_system == 'XOOPS')
		{
			$groupperm_handler =& xoops_gethandler('groupperm');
//			$global_prems = $groupperm_handler->getItemIds($this->moduleDir.'_global', $groupid_array, $this->mid);
			$global_prems = $groupperm_handler->getItemIds('weblog_global', $groupid_array, $this->mid);

			foreach($global_prems as $value)
			{
				if($this->weblog_perm < $value)
				{
					$this->weblog_perm = $value;
				}
			}

			$this->weblog_cat_post_array = $groupperm_handler->getItemIds('weblog_cat_post', $groupid_array, $this->mid);
			if(count($this->weblog_cat_post_array) > 0)
			{
				$this->weblog_cat_post = join($this->weblog_cat_post_array,',');
			}
		}

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'weblog_perm', $this->weblog_perm);
		$this->utils->setDebugMessage(__CLASS__, 'weblog_cat_post', $this->weblog_cat_post);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function checkEntryAccess($id=0)
	{
		if($this->getModuleAdmin())
		{
			$this->weblog_perm = XMOBILE_CAN_EDIT;
		}
		else
		{
			if ($id != 0)
			{
				$itemObject = $this->get($id);
				if(is_object($itemObject))
				{
					$cat_id = $itemObject->getVar('cat_id');
					$user_id = $itemObject->getVar('user_id');
	
					if(($this->weblog_perm >= XMOBILE_CAN_POST) && ($this->sessionHandler->getUid() == $user_id) && (in_array($cat_id,$this->weblog_cat_post_array)))
					{
						$this->weblog_perm = XMOBILE_CAN_EDIT;
					}
				}
			}
		}

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'checkEntryAccess', $this->weblog_perm);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function renderEntryForm($entry_type)
	{
		global $xoopsModuleConfig;
		$myts =& MyTextSanitizer::getInstance();

		$cat_id = intval($this->utils->getGetPost('cat_id', 0));
		$blog_id = intval($this->utils->getGetPost('blog_id', 0));
		$session_id = $this->sessionHandler->getSessionID();
		$uid = $this->sessionHandler->getUid();
		$user =& $this->sessionHandler->getUser();

		$this->checkEntryAccess($blog_id);

		if($this->weblog_perm < 2)
		{
			return false;
		}

		$sql = 'SELECT user_id,cat_id,created,title,contents,private,comments,`reads`,trackbacks,description,dohtml,dobr,permission_group FROM '.$this->tableName.' WHERE blog_id='.$blog_id;


		// debug
		$this->utils->setDebugMessage(__CLASS__, 'renderEntryForm sql', $sql);

		$baseUrl = preg_replace('/&amp;/i','&',$this->baseUrl);

		$entry_form = '';
		$entry_form .= '<form action="'.$baseUrl.'" method="post">';
		$entry_form .= '<div class="form">';
		$entry_form .= $this->ticket->getTicketHtml();
		$entry_form .= '<input type="hidden" name="HTTP_REFERER" value="'.$this->baseUrl.'" />';
		$entry_form .= '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />';
		$entry_form .= '<input type="hidden" name="blog_id" value="'.$blog_id.'" />';
//		$entry_form .= '<input type="hidden" name="sess" value="'.$session_id.'" />';
		$entry_form .= '<input type="hidden" name="op" value="save" />';

		switch ($entry_type)
		{
			case 'new_entry':

				$title = '';
				$contents = '';
				$user_id = $uid;
				$created = time();
				$cat_id = intval($this->utils->getGetPost('cat_id', 0));
				$title = '';
				$contents = '';
				$private = 'N';
				$trackbacks = 0;
				$description = '';
				$dohtml = 0;
				$dobr = 0;
				$permission_group = 'all';

				break;

			case 'edit_entry':

				if(!$ret = $this->db->query($sql))
				{
					// debug
					$this->utils->setDebugMessage(__CLASS__, 'renderEntryForm sql error', $this->db->error());
				}

				while($data = $this->db->fetchArray($ret))
				{
					$user_id = $data['user_id'];
					$cat_id = $data['cat_id'];
					$created = $data['created'];
					$title = $myts->makeTboxData4Edit($data['title']);
					$dohtml = $data['dohtml'];
					$dobr = $data['dobr'];
					$contents = $myts->makeTareaData4Edit($data['contents']);
					$private = $myts->makeTboxData4Edit($data['private']);
					$trackbacks = $data['trackbacks'];
					$description = $myts->makeTareaData4Edit($data['description']);
					$permission_group = $myts->makeTboxData4Edit($data['permission_group']);
				}

				break;

			case 'delete_entry':

				$ret = $this->db->query($sql);
				while($data = $this->db->fetchArray($ret))
				{
					$user_id = $data['user_id'];
					$cat_id = $data['cat_id'];
					$created = $data['created'];
					$title = $myts->makeTboxData4Show($data['title']);
					$dohtml = $data['dohtml'];
					$dobr = $data['dobr'];
					$contents = $myts->makeTareaData4Show($data['contents'],$dohtml,1,1);
				}

//				$uname = $user->getUserName();
				$uname = $user->getVar('uname');
				$post_time = strftime('%Y-%m-%d %H:%M',$created);

				$entry_form .= _MD_XMOBILE_ITEM_DETAIL.'<br />';
				$entry_form .= _MD_XMOBILE_TITLE.':';
				$entry_form .= $title.'<hr />';
				$entry_form .= $contents.'<hr />';
				$entry_form .= _MD_XMOBILE_CONTRIBUTOR.'&nbsp;'.$uname.'<br />';
				$entry_form .= _MD_XMOBILE_DATE.'&nbsp;'.$post_time.'<br />';
				$entry_form .= _MD_XMOBILE_ASK_DELETE_THIS.'<hr />';
				$entry_form .= '<input type="hidden" name="blog_id" value="'.$blog_id.'" />';
				$entry_form .= '<input type="hidden" name="entry_type" value="delete_entry" />';
				$entry_form .= '<input type="submit" name="submit" value="'._DELETE.'" />&nbsp;';
				$entry_form .= '<input type="submit" name="cancel" value="'._CANCEL.'" />';
				$entry_form .= '</div>';
				$entry_form .= '</form>';

				return $entry_form;

				break;
		}

			$entry_form .= _MD_XMOBILE_CATEGORY.'<br />';

			if($this->moduleConfig['category_post_permission'] && !$this->moduleAdmin)
			{
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('cat_id','('.$this->weblog_cat_post.')','IN'));
			}
			else
			{
				$criteria = null;
			}
			$entry_form .= $this->categoryTree->makeMySelBox($cat_id,null,null,$criteria).'<br />';
			$entry_form .= '<input type="hidden" name="entry_type" value="'.$entry_type.'" />';
			$entry_form .= '<input type="hidden" name="user_id" value="'.$user_id.'" />';
			$entry_form .= '<input type="hidden" name="dobr" value="'.$dobr.'" />';
			$entry_form .= _MD_XMOBILE_TITLE.'<br />';
			$entry_form .= '<input type="text" name="title" value="'.$title.'" /><br />';
			$entry_form .= _MD_XMOBILE_MESSAGE.'<br />';
			$entry_form .= '<textarea rows="'.$xoopsModuleConfig['tarea_rows'].'" cols="'.$xoopsModuleConfig['tarea_cols'].'" name="contents">'.$contents.'</textarea><br />';
			$entry_form .= '<input type="submit" name="submit" value="'._SUBMIT.'" />&nbsp;';
			$entry_form .= '<input type="submit" name="cancel" value="'._CANCEL.'" />';
			$entry_form .= '</div>';
			$entry_form .= '</form>';

		return $entry_form;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function saveEntry($entry_type)
	{
		$myts =& MyTextSanitizer::getInstance();

		$cat_id = intval($this->utils->getPost('cat_id', 0));
		$blog_id = intval($this->utils->getPost('blog_id', 0));
		$user_id = $this->sessionHandler->getUid();
		$created = time();
		$title = $myts->makeTboxData4Save($this->utils->getPost('title', ''));
		$contents = $myts->makeTareaData4Save($this->utils->getPost('contents', ''));
		$private = $myts->makeTboxData4Save($this->utils->getPost('private', 'N'));

		if(isset($_POST['cancel']))
		{
//			$baseUrl = $this->utils->getLinkUrl($this->controller->getActionState(),'detail',$this->controller->getPluginState(),$this->sessionHandler->getSessionID());
			$baseUrl = XMOBILE_URL.'/?act=plugin&view=default&plg=weblog&sess='.$this->sessionHandler->getSessionID();
			header('Location: '.$baseUrl);
			exit();
		}

		//チケットの確認
		if(!$ticket_check = $this->ticket->check(true,'',false))
		{
			return _MD_XMOBILE_TICKET_ERROR;
		}


		$this->checkEntryAccess($blog_id);

		if($this->moduleConfig['use_permissionsystem'])
		{
			if(count($this->moduleConfig['default_permission']) > 0)
			{
	//			$default_permission = array();
//				$default_permission = '|';
//				foreach($this->moduleConfig['default_permission'] as $permission)
//				{
//					$default_permission = $permission.'|';
//				}
				$permission_group = '|1|'.join('|',$this->moduleConfig['default_permission']).'|';
			}
		}
		else
		{
			$permission_group = 'all';
		}

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'saveEntry use_permissionsystem', $this->moduleConfig['use_permissionsystem']);
		$this->utils->setDebugMessage(__CLASS__, 'saveEntry permission_group', $permission_group);

		$comments = 0;
		$reads = 0;
		$trackbacks = 0;
		$description = '';
		$dohtml = 0;
//		if($this->moduleConfig['disable_html'] != 0)
//		{
//			if($this->moduleConfig['default_dohtml'] != 0)
//			{
//				$dohtml = 1;
//			}
//		}
		$dobr = 1;


		switch ($entry_type)
		{
			case 'new_entry':

				if($this->weblog_perm < XMOBILE_CAN_POST)
				{
					return false;
				}
				$sql = "INSERT INTO ".$this->tableName." (user_id,cat_id,created,title,contents,private,comments,`reads`,trackbacks,description,dohtml,dobr,permission_group) VALUES ($user_id,$cat_id,$created,'$title','$contents','$private',$comments,$reads,$trackbacks,'$description',$dohtml,$dobr,'$permission_group')";
				if(!$ret = $this->db->query($sql))
				{
					// debug
					$this->utils->setDebugMessage(__CLASS__, 'saveEntry insert_sql error', $this->db->error());
					$body = _MD_XMOBILE_INSERT_FAILED;
				}
				else
				{
//				$blog_id = $this->db->getInsertId();
					$body = _MD_XMOBILE_INSERT_SUCCESS;
				}

				break;

			case 'edit_entry':

				if($this->weblog_perm < XMOBILE_CAN_EDIT)
				{
					return false;
				}

	//			$sql = "UPDATE ".$this->tableName." SET user_id=$user_id,cat_id=$cat_id,created=$created,title='$title',contents='$contents',private='$private',comments=$comments,`reads`=$reads,trackbacks=$trackbacks,description='$description',dohtml=$dohtml,dobr=$dobr,permission_group='$permission_group' WHERE blog_id=".$blog_id;
				$sql = "UPDATE ".$this->tableName." SET cat_id=$cat_id,title='$title',contents='$contents',private='$private' WHERE blog_id=".$blog_id;
				if(!$ret = $this->db->query($sql))
				{
					// debug
					$this->utils->setDebugMessage(__CLASS__, 'saveEntry update_sql error', $this->db->error());
					$body = _MD_XMOBILE_UPDATE_FAILED;
				}
				else
				{
					$body = _MD_XMOBILE_UPDATE_SUCCESS;
				}

				break;

			case 'delete_entry':

				if($this->weblog_perm < XMOBILE_CAN_EDIT)
				{
					return false;
				}

				$sql = "DELETE FROM ".$this->tableName." WHERE blog_id=$blog_id";
				if(!$ret = $this->db->query($sql))
				{
					// debug
					$this->utils->setDebugMessage(__CLASS__, 'saveEntry delete_sql error', $this->db->error());
					$body = _MD_XMOBILE_DELETE_FAILED;
				}
				else
				{
					$body = _MD_XMOBILE_DELETE_SUCCESS;
				}

				break;

		}

		// debug
		$this->utils->setDebugMessage(__CLASS__, 'saveEntry sql', $sql);
		return $body;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
