<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileNewsPlugin extends XmobilePlugin
{
	function XmobileNewsPlugin()
	{
		// call parent constructor
		XmobilePlugin::XmobilePlugin();

		// define object elements
		$this->initVar('storyid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('uid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('created', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('published', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('expired', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('hostname', XOBJ_DTYPE_TXTBOX, '', true, 20);
		$this->initVar('nohtml', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('nosmiley', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('hometext', XOBJ_DTYPE_TXTAREA, '', true);
		$this->initVar('bodytext', XOBJ_DTYPE_TXTAREA, '', true);
		$this->initVar('counter', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('topicid', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('ihome', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('notifypub', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('story_type', XOBJ_DTYPE_TXTBOX, '', true, 5);
		$this->initVar('topicdisplay', XOBJ_DTYPE_INT, '0', true);
		$this->initVar('topicalign', XOBJ_DTYPE_TXTBOX, '', true, 1);
		$this->initVar('comments', XOBJ_DTYPE_INT, '0', true);

		// define primary key
		$this->setKeyFields(array('storyid'));
		$this->setAutoIncrementField('storyid');
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function assignSanitizerElement()
	{
		$dohtml = 0;
		$dosmiley = 0;

		if($this->getVar('nohtml') == 0) $dohtml = 1;
		if($this->getVar('nosmiley') == 0) $dosmiley = 1;

		$this->initVar('dohtml',XOBJ_DTYPE_INT,$dohtml);
		$this->initVar('dosmiley',XOBJ_DTYPE_INT,$dosmiley);
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileNewsPluginHandler extends XmobilePluginHandler
{
//	var $moduleDir = 'news';
//	var $categoryTableName = 'topics';
//	var $itemTableName = 'stories';

	var $category_id_fld = 'topic_id';
	var $category_pid_fld = 'topic_pid';
	var $category_title_fld = 'topic_title';
	var $category_order_fld = 'topic_id';

	var $item_id_fld = 'storyid';
	var $item_cid_fld = 'topicid';
	var $item_title_fld = 'title';
	var $item_description_fld = 'hometext';
	var $item_order_fld = 'published';
	var $item_date_fld = 'published';
	var $item_uid_fld = 'uid';
	var $item_hits_fld = 'counter';
	var $item_comments_fld = 'comments';
	var $item_extra_fld = array('bodytext'=>'');
	var $item_order_sort = 'DESC';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileNewsPluginHandler($db)
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
		$this->categoryTableName = 'topics'. $dirnumber;
		$this->itemTableName = 'stories'. $dirnumber;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function setItemCriteria()
	{
		$this->item_criteria =& new CriteriaCompo();
		$item_criteria_1 = new CriteriaCompo();
		$item_criteria_1->add(new Criteria('published', 0, '>'));
		$item_criteria_1->add(new Criteria('published', time(), '<='));
		$item_criteria_2 = new CriteriaCompo();
		$item_criteria_2->add(new Criteria('expired', 0));
		$item_criteria_2->add(new Criteria('expired', time(), '>'),'OR');
		$this->item_criteria->add($item_criteria_1);
		$this->item_criteria->add($item_criteria_2);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
