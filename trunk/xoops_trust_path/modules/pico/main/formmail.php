<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.inc.php' ;
require_once XOOPS_TRUST_PATH.'/modules/pico/class/FormProcessByHtml.class.php' ;

// read language files for formmail
$langmanpath = XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ;
require_once( $langmanpath ) ;
$langman =& D3LanguageManager::getInstance() ;
$langman->read( 'formmail.php' , $mydirname , 'pico' ) ;

// get content_id
$content_id = intval( @$_GET['content_id'] ) ;

// get $cat_id from $content_id
$cat_id = pico_main_get_cat_id_from_content_id( $mydirname , $content_id ) ;

// check,fetch and assign the category (set $content_id if necessary)
require dirname(dirname(__FILE__)).'/include/process_this_category.inc.php' ;

// get&check this content
require dirname(dirname(__FILE__)).'/include/process_this_content.inc.php' ;

// content_uri
$content_uri = pico_common_unhtmlspecialchars( XOOPS_URL.'/modules/'.$mydirname.'/'.$content4assign['link'] ) ;

// session index
$session_index = $mydirname . '_formmail_' . $content_id ;

if( empty( $_SESSION[ $session_index ] ) || ! is_array( $_SESSION[ $session_index ] ) ) {
	header( 'Location: '.$content_uri ) ;
	exit ;
}

// init form processor
$form_processor =& new FormProcessByHtml() ;
$form_processor->importSession( $_SESSION[ $session_index ] , false ) ;

if( count( $form_processor->getErrors() ) ) {
	redirect_header( XOOPS_URL.'/modules/'.$mydirname.'/' , 3 , _MD_PICO_FORMMAIL_MSG_ERRORANONYMOUS ) ;
}

// clear session
unset( $_SESSION[ $session_index ] ) ;

// create mail_body
$mail_body = 'URL: ' . $content_uri . "\n" . $form_processor->renderForMail( _MD_PICO_FORMMAIL_MAILFLDSEP , _MD_PICO_FORMMAIL_MAILMIDSEP ) ;

// create subject
$subject = sprintf( _MD_PICO_FORMMAIL_MAILSUBJECT , $content4assign['subject_raw'] ) ;

// send mail
$xoopsMailer =& getMailer() ;
$xoopsMailer->useMail() ;
$xoopsMailer->setToEmails( $xoopsConfig['adminmail'] ) ;
//$xoopsMailer->setFromEmail( $usersEmail ) ;
$xoopsMailer->setFromName( $xoopsConfig['sitename'] ) ;
$xoopsMailer->setSubject( $subject ) ;
$xoopsMailer->setBody( $mail_body ) ;
$xoopsMailer->send() ;

// redirect
redirect_header( htmlspecialchars( $content_uri , ENT_QUOTES ) , 3 , _MD_PICO_FORMMAIL_MSG_SENTSUCCESSFULLY ) ;
exit ;

?>