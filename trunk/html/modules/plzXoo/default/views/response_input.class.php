<?php

require_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

class default_ResponseView_input
{
	function &execute (&$controller, &$request, &$user)
	{
		$editform=&$request->getAttribute('editform');
		$question=&$request->getAttribute('question');
		$answer=&$request->getAttribute('answer');

		$form = new XoopsThemeForm(_MD_PLZXOO_LANG_RESPONSE,'Response','','POST');

		$form->addElement(new XoopsFormHidden('aid',$editform->aid_));
		$form->addElement(new XoopsFormHidden($editform->ticket_->name_,$editform->ticket_->value_));

		//-------------------------
		// Select
		//-------------------------
/*		if(isset($editform->point_)) {
			$select =new XoopsFormSelect(_MD_PLZXOO_LANG_POINT,'point', $editform->point_);
				$select->addOption(20, _MD_PLZXOO_LANG_POINT_20 );
				$select->addOption(10, _MD_PLZXOO_LANG_POINT_10 );
				$select->addOption(0, _MD_PLZXOO_LANG_POINT_0 );
			$form->addElement($select);
			unset($select);
		}*/


		//-------------------------
		// TextArea(Plain)
		//-------------------------
		$form->addElement(new XoopsFormTextArea(_MD_PLZXOO_LANG_COMMENT,'comment',$editform->comment_,3, 50 ));


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
		$renderer->setTemplate('response.tpl');

		$renderer->setAttribute('xoopsform',$form);
		$renderer->setAttribute('editform',$editform);
		$renderer->setAttribute('question',$question);
		$renderer->setAttribute('answer',$answer->getStructure());

		return $renderer;
	}
}

?>