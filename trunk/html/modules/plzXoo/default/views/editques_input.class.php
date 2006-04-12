<?php

require_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

class default_EditquesView_input
{
	function &execute (&$controller, &$request, &$user)
	{
		$editform=&$request->getAttribute('editform');

		$form = new XoopsThemeForm(_MD_PLZXOO_LANG_QUESTION,'editquestion','','POST');
		$form->addElement(new XoopsFormHidden('qid',$editform->qid_));
		$form->addElement(new XoopsFormText(_MD_PLZXOO_LANG_SUBJECT,'subject',64,255,$editform->subject_));
		$form->addElement(new XoopsFormDhtmlTextArea(_MD_PLZXOO_LANG_BODY,'body',$editform->body_,6,50));

		//Ticket
		$form->addElement(new XoopsFormHidden($editform->ticket_->name_,$editform->ticket_->value_));

		//¥«¥Æ¥´¥ê
		$categories=&$request->getAttribute('categories');
		if(count($categories)) {
			$select = new XoopsFormSelect(_MD_PLZXOO_LANG_CATEGORY,'cid',$editform->cid_);
			foreach($categories as $category) {
				$select->addOption($category->getVar('cid'),$category->getVar('name'));
			}
			$form->addElement($select);
			unset($select);
		}
		else {
			$form->addElement(new XoopsFormHidden('cid',$editform->cid_));
		}

		//Priority
		$select = new XoopsFormSelect(_MD_PLZXOO_LANG_PRIORITY,'priority',$editform->priority_);
		for($i=1;$i<=5;$i++)
			$select->addOption($i,$i);

		$form->addElement($select);

		//-------------------------
		// Tray & Button
		//-------------------------
		$tray = new XoopsFormElementTray(_MD_PLZXOO_LANG_CONTROL);

		// preview (check isset($_POST['preview']))
//		$tray->addElement( new XoopsFormButton ( '' /* CAPITON(NO REQUIRED) */, 'preview', 'DISPLAY STRING', 'submit' ) );

		$tray->addElement( new XoopsFormButton ( '', 'submit', _MD_PLZXOO_LANG_SUBMIT, 'submit' ) );
		$tray->addElement( new XoopsFormButton ( '' /* CAPITON(NO REQUIRED) */, 'reset', _MD_PLZXOO_LANG_RESET, 'reset' ) );

		$backButton = new XoopsFormButton ( '' /* CAPITON(NO REQUIRED) */, "back", _MD_PLZXOO_LANG_GO_BACK, "button" );
		$backButton->setExtra('onclick="javascript:history.go(-1);"');
		$tray->addElement($backButton);

		// add tray
		$form->addElement($tray);

		$renderer = new mojaLE_Renderer($controller,$request,$user);
		$renderer->setTemplate('edit_question.tpl');
		$renderer->setAttribute('xoopsform',$form);
		$renderer->setAttribute('editform',$editform);
		return $renderer;
	}
}

?>