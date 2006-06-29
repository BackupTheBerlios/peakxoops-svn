<?php

/********* begin configuratin *********/

// allowed requests (you can hack it)
$allowed_requests = array(
	'uname' => '' ,
	'email' => '' ,
	'pass' => '' ,
	'vpass' => '' ,
	'url' => '' ,
	'timezone_offset' => doubleval( $xoopsConfig['default_TZ'] ) ,
	'user_viewemail' => 0 ,
	'user_mailok' => 0 ,
	'agree_disc' => 0 ,
	// 'sex' => 0 , // tinyint
	// 'birth' => '2000-01-01' , // date
) ;

$auto_belong_groups = array( XOOPS_GROUP_USERS ) ; // default (2)
$allow_blank_email = false ;
$allow_blank_vpass = false ;

/********* end configuratin *********/



include_once XOOPS_ROOT_PATH."/class/xoopslists.php";

$config_handler =& xoops_gethandler('config');
$xoopsConfigUser =& $config_handler->getConfigsByCat(XOOPS_CONF_USER);

if (empty($xoopsConfigUser['allow_register'])) {
    redirect_header('index.php', 6, _US_NOREGISTER);
    exit();
}

foreach( $allowed_requests as $key => $val ) {
	if( ! isset( $_POST[$key] ) ) continue ;
	switch( strtolower( gettype( $val ) ) ) {
		case 'double' :
			$$key = doubleval( $_POST[$key] ) ;
			break ;
		case 'integer' :
			$$key = intval( $_POST[$key] ) ;
			break ;
		case 'string' :
			$$key = get_magic_quotes_gpc() ? stripslashes( $_POST[$key] ) : $_POST[$key] ;
			break ;
	}
	$allowed_requests[$key] = $$key ;
}


$email4check = $allow_blank_email ? substr(md5(time()),-6).'@example.com' : @$email ;
$vpass = $allow_blank_vpass ? @$pass : @$vpass ;

if( ! empty( $_POST['do_register'] ) && ! ( $stop_reason = userCheck( $uname , $email4check , $pass , $vpass ) ) ) {

	if( empty( $agree_disc ) ) die( _US_UNEEDAGREE ) ;

	include XOOPS_ROOT_PATH.'/header.php';
	$member_handler =& xoops_gethandler('member');
	$newuser =& $member_handler->createUser();
	$newuser->setVar('user_viewemail',$user_viewemail, true);
	$newuser->setVar('uname', $uname, true);
	$newuser->setVar('email', $email, true);
	if ($url != '') {
		$newuser->setVar('url', formatURL($url), true);
	}
	$newuser->setVar('user_avatar','blank.gif', true);
	$actkey = substr(md5(uniqid(mt_rand(), 1)), 0, 8);
	$newuser->setVar('actkey', $actkey, true);
	$newuser->setVar('pass', md5($pass), true);
	$newuser->setVar('timezone_offset', $timezone_offset, true);
	$newuser->setVar('user_regdate', time(), true);
	$newuser->setVar('uorder',$xoopsConfig['com_order'], true);
	$newuser->setVar('umode',$xoopsConfig['com_mode'], true);
	$newuser->setVar('user_mailok',$user_mailok, true);
	if ($xoopsConfigUser['activation_type'] == 1) {
		$newuser->setVar('level', 1, true);
	}
	if (!$member_handler->insertUser($newuser)) {
		echo _US_REGISTERNG;
		include XOOPS_ROOT_PATH.'/footer.php';
		exit();
	}

	$newid = $newuser->getVar('uid') ;

	// groups
	foreach( $auto_belong_groups as $group ) {
		$member_handler->addUserToGroup( intval( $group ) , $newid ) ;
	}

	$xoopsOption['template_main'] = 'minihaku_register_success.html' ;
	if ($xoopsConfigUser['activation_type'] == 1) {
		// bug ?
		//redirect_header('index.php', 4, _US_ACTLOGIN);
		//exit();
		$xoopsTpl->assign( 'message' , _US_ACTLOGIN ) ;
	} else if ($xoopsConfigUser['activation_type'] == 0) {
		$xoopsMailer =& getMailer();
		$xoopsMailer->useMail();
		$xoopsMailer->setTemplate('register.tpl');
		$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
		$xoopsMailer->assign('ADMINMAIL', $xoopsConfig['adminmail']);
		$xoopsMailer->assign('SITEURL', XOOPS_URL."/");
		$xoopsMailer->setToUsers(new XoopsUser($newid));
		$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
		$xoopsMailer->setFromName($xoopsConfig['sitename']);
		$xoopsMailer->setSubject(sprintf(_US_USERKEYFOR, $uname));
		if ( !$xoopsMailer->send() ) {
			$xoopsTpl->assign( 'message' , _US_YOURREGMAILNG ) ;
		} else {
			$xoopsTpl->assign( 'message' , _US_YOURREGISTERED ) ;
		}
	} elseif ($xoopsConfigUser['activation_type'] == 2) {
		$xoopsMailer =& getMailer();
		$xoopsMailer->useMail();
		$xoopsMailer->setTemplate('adminactivate.tpl');
		$xoopsMailer->assign('USERNAME', $uname);
		$xoopsMailer->assign('USEREMAIL', $email);
		$xoopsMailer->assign('USERACTLINK', XOOPS_URL.'/user.php?op=actv&id='.$newid.'&actkey='.$actkey);
		$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
		$xoopsMailer->assign('ADMINMAIL', $xoopsConfig['adminmail']);
		$xoopsMailer->assign('SITEURL', XOOPS_URL."/");
		$member_handler =& xoops_gethandler('member');
		$xoopsMailer->setToGroups($member_handler->getGroup($xoopsConfigUser['activation_group']));
		$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
		$xoopsMailer->setFromName($xoopsConfig['sitename']);
		$xoopsMailer->setSubject(sprintf(_US_USERKEYFOR, $uname));
		if ( !$xoopsMailer->send() ) {
			$xoopsTpl->assign( 'message' , _US_YOURREGMAILNG ) ;
		} else {
			$xoopsTpl->assign( 'message' , _US_YOURREGISTERED2 ) ;
		}
	}

	if ($xoopsConfigUser['new_user_notify'] == 1 && !empty($xoopsConfigUser['new_user_notify_group'])) {
		$xoopsMailer =& getMailer();
		$xoopsMailer->useMail();
		$member_handler =& xoops_gethandler('member');
		$xoopsMailer->setToGroups($member_handler->getGroup($xoopsConfigUser['new_user_notify_group']));
		$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
		$xoopsMailer->setFromName($xoopsConfig['sitename']);
		$xoopsMailer->setSubject(sprintf(_US_NEWUSERREGAT,$xoopsConfig['sitename']));
		$xoopsMailer->setBody(sprintf(_US_HASJUSTREG, $uname));
		$xoopsMailer->send();
	}
	include XOOPS_ROOT_PATH.'/footer.php';
	exit ;

} else {

	include XOOPS_ROOT_PATH.'/header.php' ;
	$xoopsOption['template_main'] = 'minihaku_register.html' ;
	$xoopsTpl->assign(
		array(
			'stop_reason' => @$stop_reason ,
			'timezone_options' => XoopsLists::getTimeZoneList() ,
			'reg_disclaimer' => $xoopsConfigUser['reg_disclaimer'] ,
		)
	) ;
	$xoopsTpl->assign( $allowed_requests ) ;
	include XOOPS_ROOT_PATH.'/footer.php' ;
	exit ;

}


?>
