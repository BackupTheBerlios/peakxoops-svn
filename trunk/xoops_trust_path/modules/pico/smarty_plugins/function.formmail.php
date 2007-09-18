<?php

require_once XOOPS_TRUST_PATH.'/modules/pico/class/FormProcessByHtml.class.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/class/PicoFormProcessBySmartyBase.class.php' ;


// for debug (checking out ranged)
//if( ! empty( $_POST ) ) $_POST['selbox'] = '3' ;
//if( ! empty( $_POST ) ) $_POST['favorite_fruit'][] = 'kiwi' ;

function smarty_function_formmail( $params , &$smarty )
{
	$controller =& new PicoFormProcessBySmartyFormmail() ;
	if( ! empty( $params['to'] ) ) {
		$controller->toEmails = explode( ',' , $params['to'] ) ;
	} else if( trim( $GLOBALS['xoopsConfig']['adminmail'] ) != '' ) {
		$controller->toEmails = array( $GLOBALS['xoopsConfig']['adminmail'] ) ;
	} else {
		die( 'set "to" params as email address' ) ;
	}
	$controller->execute( $params , $smarty ) ;
}


class PicoFormProcessBySmartyFormmail extends PicoFormProcessBySmartyBase
{
	var $toEmails = array() ; // public

	function __construct()
	{
		$this->mypluginname = 'formmail' ;
	}


	function executeLast()
	{
		// create mail_body
		$mail_body = 'URL: ' . $this->content_uri . "\n" . $this->form_processor->renderForMail( _MD_PICO_FORMMAIL_MAILFLDSEP , _MD_PICO_FORMMAIL_MAILMIDSEP ) ;
		if( function_exists( 'easiestml' ) ) {
			$mail_body = easiestml( $mail_body ) ;
		}

		// create subject
		$subject = sprintf( _MD_PICO_FORMMAIL_MAILSUBJECT , $this->content4disp['subject_raw'] ) ;

		// send mail
		$xoopsMailer =& getMailer() ;
		$xoopsMailer->useMail() ;
		$xoopsMailer->setToEmails( $this->toEmails ) ;
		//$xoopsMailer->setFromEmail( $usersEmail ) ;
		$xoopsMailer->setFromName( $GLOBALS['xoopsConfig']['sitename'] ) ;
		$xoopsMailer->setSubject( $subject ) ;
		$xoopsMailer->setBody( $mail_body ) ;
		$xoopsMailer->send() ;
	}

}


?>