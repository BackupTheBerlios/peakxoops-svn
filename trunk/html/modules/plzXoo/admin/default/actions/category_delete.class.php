<?php
/**
@version $Id$
*/

// FIXME
require_once "exForm/ConfirmTicketForm.php";

class default_Category_deleteAction extends mojaLE_AbstractAction
{
	function execute(&$controller,&$request,&$user)
	{
		// FIXME
		$id=isset($_REQUEST['cid']) ? intval ($_REQUEST['cid']) : 0;

		// FIXME
		$handler=&plzXoo::getHandler('category');

		$obj=&$handler->get($id);
		if(!is_object($obj)) {
			return VIEW_ERROR;
		}
    
		// =======================================================================
		// Permission Check etc...  ������¤Υ����å��ʤɤ�ɬ�פʤ餳���˥����ɤ��
		// ======================================================================= 

		// FIXME
		$editform = new exConfirmTicketForm();
		$editform->setErrorMessage(_MD_A_PLZXOO_ERROR_TICKET);
   
		if($editform->init(strtolower(get_class($this)))==ACTIONFORM_POST_SUCCESS) {
			$editform->release();

			// ----------------------------------------------
			// �ҥ��ƥ��꡼�����ä��饨�顼
			// ----------------------------------------------
			$cid =  $obj->getVar('cid') ;
			$child_handler =& plzXoo::getHandler('category');
			$children =& $child_handler->getObjects( new Criteria('pid',$cid) ) ;
			if( ! empty( $children ) ) return VIEW_ERROR ;

			// ----------------------------------------------
			// �֤鲼���äƤ�����䡦�����򤹤٤ƺ��
			// ----------------------------------------------
			$question_handler =& plzXoo::getHandler('question');
			$answer_handler =& plzXoo::getHandler('answer');
			$questions =& $question_handler->getObjects( new Criteria('cid',$cid) ) ;
			foreach( $questions as $question ) {
				$qid = $question->getVar('qid') ;
				$answers =& $answer_handler->getObjects( new Criteria('qid',$qid) ) ;
				foreach( $answers as $answer ) {
					$answer_handler->delete( $answer ) ;
				}

				$question_handler->delete( $question ) ;
			}

			return $handler->delete($obj) ?
				VIEW_SUCCESS : VIEW_ERROR;
		}

		$request->setAttribute('editform',$editform);
		$request->setAttribute('obj',$obj);

		return VIEW_INPUT;
	}

	function isSecure()
	{
		return true;
	}
}

?>
