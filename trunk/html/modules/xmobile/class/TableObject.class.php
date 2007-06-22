<?php
if(!defined('XOOPS_ROOT_PATH')) exit();
include_once XOOPS_ROOT_PATH."/modules/xmobile/class/xoopstableobject.php";
include_once XOOPS_ROOT_PATH.'/modules/xmobile/class/gtickets.php';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileTableObject extends XoopsTableObject
{
	var $_formCaption = '';
	var $_detailElements;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function XmobileTableObject()
	{
		$this->XoopsTableObject();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		function getFormCaption()
		{
			return $this->_formCaption;
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initFormElements()
	{
		if(!$this->isNew())
		{
			$this->_formCaption = _EDIT;
		}
		else
		{
			$this->_formCaption = _CREATE;
		}

// example: assignEditFormElement($key,$class,$caption,$name,$params);
		return true;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function assignSanitizerElement()
	{
// example:
/*
		$dohtml = 0;
		$dosmiley = 0;
		$doxcode = 0;

		if($this->getVar('nohtml')) $dohtml = 1;
		if($this->getVar('nosmiley')) $dosmiley = 1;
		if($this->getVar('noxcode')) $doxcode = 1;

		$this->initVar('dohtml',XOBJ_DTYPE_INT,$dohtml);
		$this->initVar('dosmiley',XOBJ_DTYPE_INT,$dosmiley);
		$this->initVar('doxcode',XOBJ_DTYPE_INT,$doxcode);
*/
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function assignEditFormElement($key,$class,$caption,$name,$params)
	{
		$this->_formElements[$key]['class'] = $class;
		$this->_formElements[$key]['caption'] = $caption;
		$this->_formElements[$key]['name'] = $name;
		for($i=0;$i<count($params);$i++)
		{
			if(gettype($params[$i]) == 'string')
			{
				$this->_formElements[$key]['params'][$i] = '"'.$params[$i].'"';
			}
			else
			{
				$this->_formElements[$key]['params'][$i] = $params[$i];
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function renderEditForm($caption,$name,$action)
	{
		$myts =& MyTextSanitizer::getInstance();
		$formCaption = $myth->makeTboxData4Show($caption);


		$postForm = '';
		$postForm .= $formCaption.'<hr />';
		$postForm .= '<form action="'.$action.'" name="'.$name.'" method="post">';
		$postForm .= $this->makeTicket();

		if($this->isNew())
		{
			$editForm .= '<input type="hidden" name="op" value="insert" />';
		}
		else
		{
			$editForm .= '<input type="hidden" name="op" value="save" />';
		}

		foreach($this->_formElements as $key=>$formElement)
		{
			$name = $key;
			$value = $this->getVar($key, 'e');
			$class = $formElement['class'];
			$caption = $formElement['caption'];
			$params = $formElement['params'];

			switch($class)
			{
				case 'hidden':
					$postForm .= $this->makeInputHidden($name,$value);
					break;

				case 'text':
					$postForm .= $this->makeInputText($caption,$name,$value,$params);
					break;

				case 'textarea':
					$postForm .= $this->makeInputTextArea($caption,$name,$value,$params);
					break;

				case 'checkbox':
					$postForm .= $this->makeInputCheckBox($caption,$name,$value,$params);
					break;

				case 'radio':
					$postForm .= $this->makeInputRadio($caption,$name,$value,$params);
					break;

				case 'select':
					$postForm .= $this-> makeInputSelect($caption,$name,$value,$params);
					break;

				case 'dateselect':
					$postForm .= $this->makeInputDateSelect($caption,$name,$value,$params);
					break;

				case 'submit':
					$postForm .= $this->makeButtonSubmit();
					break;

				case 'cancel':
					$postForm .= $this->makeButtonCancel();
					break;

				case 'button':
					$postForm .= $this->makeButton($name,$value);
					break;

			}
		}

		return $postForm;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeInputHidden($name,$value)
	{
		$formElement = '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeInputText($caption,$name,$value,$params)
	{
		$formElement = '';
		$formElement .= $caption.'<br />';
		list($size, $maxlength) = $option;
		$formElement .= '<input type="text" name="'.$name.'" value="'.$value.'" size="'.$size.'" maxlength="'.$maxlength.'" /><br />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeInputTextArea($caption,$name,$value)
	{
		global $xoopsModuleConfig;

		$tarea_cols = $xoopsModuleConfig['tarea_cols'];
		$tarea_rows = $xoopsModuleConfig['tarea_rows'];

		$formElement = '';
		$formElement .= $caption.'<br />';
		$formElement .= '<textarea name="'.$name.'" value="'.$value.'" cols="'.$tarea_cols.'" rows="'.$tarea_rows.'"><br />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeInputCheckBox($caption,$name,$value,$params)
	{
		$formElement = '';
		$formElement .= $caption.'<br />';
		foreach($params as $option)
		{
			list($id, $title) = $option;
			$formElement .= '<input type="checkbox" name="'.$name.'[]" value="'.$id.'" />'.$title.'<br />';
		}
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeInputRadio($caption,$name,$value,$params)
	{
		$formElement = '';
		$formElement .= $caption.'<br />';
		foreach($params as $option)
		{
			list($id, $title) = $option;
			$formElement .= '<input type="radio" name="'.$name.'" value="'.$id.'" />'.$title.'<br />';
		}
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeInputSelect($caption,$name,$value,$params)
	{
		$formElement = '';
		$formElement .= $caption.'<br />';
		$formElement .= '<select name="'.$name.'">';
		foreach($params as $option)
		{
			list($id, $title) = $option;
			$sel = '';
			if($id == $value)
			{
				$sel = ' selected="selected"';
			}
			$formElement .= '<option value="'.$id.'"'.$sel.'>'.$title.'</option>';
		}
		$formElement .= '</select><br />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// not use
/*
	function makeInputDateSelect($value=null)
	{
		if(is_null($value))
		{
			$value = time();
		}

		$year = formatTimestamp('Y',intval($value));
		$month = strftime('m',intval($value));
		$day = strftime('d',intval($value));

		$formElement = '';
		$formElement.= '<select name="year">';
		for($ii=2004; $ii<=2008; $ii++)
		{
			$temp = '';
			if($ii == $year)
			{
			$temp = 'selected';
			}
			$formElement.='<option value="'.$ii.'"'.$temp.'>'.$ii.'</option>';
		}
		$formElement.= '</select>';
		$formElement.= '<select name="month">';
		for($ii=1; $ii<=12; $ii++)
		{
			$temp = '';
			if($ii == $month){
			$temp = 'selected';
			}
			$formElement.='<option value="'.$ii.'" '.$temp.'>'.$ii.'</option>';
		}
		$formElement.= '</select>';
		$formElement.= '<select name="date">';

		if($date)
		{
			for($ii=1; $ii<=31; $ii++)
			{
				$temp = '';
				if($ii == $day)
				{
					$temp = 'selected';
				}
				$formElement.='<option value="'.$ii.'" '.$temp.'>'.$ii.'</option>';
			}
			$formElement.= '</select><br />';
		}
		return $formElement;
	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeButtonSubmit($name='submit',$value=_SUBMIT)
	{
		$formElement = '<input type="button" name="'.$name.'" value="'.$value.'" />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeButtonCancel($name='cancel',$value=_CANCEL)
	{
//		$formElement = '<input type="button" name="cancel" value="'._CANCEL.'" onClick="location=\''.$element['target_url'].'\'" />';
		$formElement = '<input type="button" name="'.$name.'" value="'.$value.'" />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeButton($name,$value)
	{
		$formElement = '<input type="button" name="'.$name.'" value="'.$value.'" />';
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function makeTicket()
	{
		$ticket = new XoopsGTicket;
		$formElement = $ticket->getTicketHtml();
		return $formElement;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// not use
/*
	function makeXoopsTicket()
	{
		$tokenhandler = new XoopsMultiTokenHandler();
		$ticket =& $tokenhandler->create(get_class($this).'_edit', 600);
		$formElement = $ticket->getHtml();
		return $formElement;
	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class XmobileTableObjectHandler  extends XoopsTableObjectHandler
{
	function XmobileTableObjectHandler($db)
	{
		$this->XoopsTableObjectHandler($db);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function _checkToken()
	{
		$ticket = new XoopsGTicket;
		if($ticket_check = $ticket->check(true,'',false))
		{
			return true;
		}
		else
		{
//			$ticket->getErrors();
			return false;
//			return _MD_XMOBILE_TICKET_ERROR;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// not use
	/**
	 * check token
	 * @access private
	 * @return bool
	 */
/*
	function _checkToken()
	{
		if(class_exists('XoopsMultiTokenHandler'))
		{
			$tokenhandler = new XoopsMultiTokenHandler();
			$ret = $tokenhandler->autoValidate($this->_entityClassName.'_edit');
		}
		return $ret;
	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * @access public
	 * @param string $op	insert/save/edit/new/
	 * @param array  $keys
	 * @return bool
	 */
	function handleRecord($op='', $keys=array())
	{
		if(!$op) $op = !empty($_POST['op']) ? $_POST['op'] : '';

		if($op == 'insert' || $op == 'save')
		{
			$ret = false;
			$record =& $this->create();
			foreach($record->getKeyFields() as $k => $v)
			{
				if(!isset($_POST[MFFO_PREFIX.$v]) && ($op == 'save' || !$record->isAutoIncrement($v)))
				{
					$this->setError('Record key does not post.');
					return false;
				}
			}

			if($this->_checkToken())
			{
				$updateOnlyChanged = false;
				if($op == 'save')
				{
					$record->unsetNew();
					$updateOnlyChanged = true;
				}
				$record->setFormVars($_POST, MFFO_PREFIX);

				if($this->insert($record, false, $updateOnlyChanged))
				{
					$record->unsetNew();
					$this->_record =& $record;
					$ret = true;
					$this->_message = 'Success update database.';
				}
			}
			else
			{
				$this->setError('An illegal request was detected. please, try submit again.');
			}
			unset($record);
			return $ret;

		}
		else
		{
			if(!$op) $op = !empty($_GET['op']) ? $_GET['op'] : '';

			if($op == 'edit' || $op == 'new' || $op == '')
			{
				$record =& $this->create();
				$recordKeys = $record->getKeyFields();

				if(gettype($keys) != 'array')
				{
					$keys = array($recordKeys[0] => $keys);
				}
				foreach($recordKeys as $k => $v)
				{
					if(!array_key_exists($v, $keys) && isset($_GET[$v]))
					{
						$keys[$v] = $_GET[$v];
					}
				}

				if($op == 'edit')
				{
					unset($record);
					if(!($record =& $this->get($keys)))
					{
						$this->setError('Request record does not exist.');
						return false;
					}
				}
				else
				{
					$myts =& MyTextSanitizer::getInstance();
					$criteria = new CriteriaCompo();
					$issetkey = true;
					foreach ($recordKeys as $k => $v)
					{
						if(array_key_exists($v, $keys))
						{
							$criteria->add(new Criteria($v, $myts->addSlashes($keys[$v])));
							$record->setVar($v, $keys[$v]);
						}
						elseif(!$record->isAutoIncrement($v))
						{
							$this->setError('Record key does not post.');
							return false;
						}
						else
						{
							$issetkey = false;
						}
					}

					if($issetkey && $this->getCount($criteria))
					{
						unset($record);
						if($op == 'new')
						{
							$this->setError('Designate key already exist.');
							return false;
						}
						else
						{
							$record =& $this->get($keys);
						}
					}
				}
				$this->_record =& $record;
				unset($record);
				return true;
			}
			else
			{
				$this->setError('An illegal option was requested.');
			}
		}
		return false;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * render edit form for record that handled "function handleRecord"
	 * @access public
	 * @param string $action
	 * @return string rendered XoopsThemeForm
	 */
	function renderEditForm($action)
	{
		if(is_object($this->_record))
		{
//			$this->_record->assignFormTokenElement();
			if($this->_record->initFormElements())
			{
				return $this->_record->renderEditForm($this->_record->getFormCaption(), $this->_entityClassName, $action);
			}
			else
			{
				$this->_errors += $this->_record->getErrors();
			}
		}
		return false;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * return record that handled.
	 * @access public
	 * @return object	reference to the {@link MyFixedformObject} object
	 */
	function &getRecord()
	{
		return $this->_record;
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>