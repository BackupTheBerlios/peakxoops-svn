<?php

require_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

class default_AnswerView_input
{
	function &execute (&$controller, &$request, &$user)
	{
		$editform=&$request->getAttribute('editform');
		$question=&$request->getAttribute('question');

		$form = new XoopsThemeForm('Answer','editanswer','','POST');
		$form->addElement(new XoopsFormHidden('aid',$editform->aid_));
		$form->addElement(new XoopsFormHidden('qid',$editform->qid_));
		$form->addElement(new XoopsFormDhtmlTextArea(_MD_PLZXOO_LANG_ANSWER_BODY,'body',$editform->body_,6,50));

		//Ticket
		$form->addElement(new XoopsFormHidden($editform->ticket_->name_,$editform->ticket_->value_));

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
		$renderer->setTemplate('edit_answer.tpl');
		$renderer->setAttribute('xoopsform',$form);
		$renderer->setAttribute('editform',$editform);
		$renderer->setAttribute('question',$question);
		$renderer->setAttribute('answer',$request->getAttribute('answer'));
		return $renderer;
	}
}

?>