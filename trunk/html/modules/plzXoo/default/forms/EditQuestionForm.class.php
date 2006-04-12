<?php

require_once "exForm/Form.php";
require_once "include/OnetimeTicket.php";

class EditQuestionForm extends exActionFormEx
{
	var $qid_;
	var $cid_;
	var $uid_;
	var $subject_;
	var $body_;
	var $input_date_;
	var $priority_;

	var $ticket_;

	function fetch(&$master) {
		if(!exOnetimeTicket::inquiry(get_class($this))) {
			$this->addError(_MD_PLZXOO_ERROR_TICKET);
			// 再発行
			$this->ticket_=new exOnetimeTicket(get_class($this),3600);
			$this->ticket_->setSession();
		}
		else
			exOnetimeTicket::unsetSession($this);

		$this->subject_ = trim($_POST['subject']);
		if(!$this->subject_) {
			$this->addError(_MD_PLZXOO_ERROR_SUBJECT_REQUIRED);
		}
		if(!$this->validateMaxLength($this->subject_, 255)) {
			$this->addError(_MD_PLZXOO_ERROR_SUBJECT_SIZEOVER);
		}
		
		// 指定されたカテゴリが存在するか確認
		$this->cid_=intval($_POST['cid']);
		$handler=&plzXoo::getHandler('category');
		if(!is_object($handler->get($this->cid_)))
			$this->addError(_MD_PLZXOO_ERROR_CID_INJURY);

		$this->priority_=intval($_POST['priority']);
		if(!$this->validateInRange($this->priority_,1,5))
			$this->addError(_MD_PLZXOO_ERROR_PRIORITY_RANGEOVER);

		$this->body_ = $_POST['body'];
		if(!$this->body_) {
			$this->addError(_MD_PLZXOO_ERROR_BODY_REQUIRED);
		}
	}

	function load(&$master) {
		$this->qid_ = $master->getVar ( 'qid', 'e' );
		$this->cid_ = $master->getVar ( 'cid', 'e' );
		$this->uid_ = $master->getVar ( 'uid', 'e' );
		$this->subject_ = $master->getVar ( 'subject', 'e' );
		$this->body_ = $master->getVar ( 'body', 'e' );
		$this->input_date_ = $master->getVar ( 'input_date', 'e' );
		$this->priority_ = $master->getVar ( 'priority', 'e' );

		$this->ticket_=new exOnetimeTicket(get_class($this),3600);
		$this->ticket_->setSession();
	}

	function update(&$master) {
		$master->setVar ( 'cid', $this->cid_ );
		$master->setVar ( 'subject', $this->subject_ );
		$master->setVar ( 'body', $this->body_ );
		$master->setVar ( 'priority', $this->priority_ );
	}
}


?>