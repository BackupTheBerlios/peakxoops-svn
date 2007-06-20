<?php

require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
require_once dirname(dirname(__FILE__)).'/include/admin_functions.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;
$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

//
// request stage
//

$allowed_requests = array( 'name' , 'url' , 'rssurl' , 'clip' ) ;
$requests = array() ;
$lacked_requests = array() ;
foreach( $allowed_requests as $allowed_request ) {
	if( ! isset( $_POST[ $allowed_request ] ) || $_POST[ $allowed_request ] === '' ) {
		$lacked_requests[ $allowed_request ] = true ;
	} else {
		$requests[ $allowed_request ] = $myts->stripSlashesGPC( $_POST[ $allowed_request ] ) ;
	}
}

//
// form stage
//

// create form for pipe admin
$post_hiddens = array() ;
if( empty( $lacked_requests ) ) {
	$post_hiddens = array(
		'name' => $requests['name'] ,
		'url' => $requests['url'] ,
		'joint_weights[0]' => 0 ,
		'joint_joints[0]' => 'fetch' ,
		'joint_option[0]' => $requests['rssurl'] ,
		'joint_weights[1]' => 10 ,
		'joint_joints[1]' => 'parse' ,
		'joint_option[1]' => '' ,
	) ;
	if( strtolower( $xoopsModuleConfig['internal_encoding'] ) != 'utf-8' ) {
		$post_hiddens += array(
			'joint_weights[2]' => 20 ,
			'joint_joints[2]' => 'utf8to' ,
			'joint_option[2]' => $xoopsModuleConfig['internal_encoding'] ,
		) ;
	}
	if( $requests['clip'] ) {
		$post_hiddens += array(
			'joint_weights[3]' => 30 ,
			'joint_joints[3]' => 'clip' ,
			'joint_option[3]' => '' ,
		) ;
	}
}


//
// display stage
//

xoops_cp_header();
include dirname(__FILE__).'/mymenu.php' ;
$tpl =& new XoopsTpl() ;
$tpl->assign( array(
	'mydirname' => $mydirname ,
	'mod_name' => $xoopsModule->getVar('name') ,
	'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
	'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
	'mod_config' => $xoopsModuleConfig ,
	'yesno_options' => array( 1 => _YES , 0 => _NO ) ,
	'requests_raw' => $requests ,
	'lacked_requests' => $lacked_requests ,
	'post_hiddens' => $post_hiddens ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'd3pipes_admin') ,
) ) ;
$tpl->display( 'db:'.$mydirname.'_admin_wizard_fetch.html' ) ;
xoops_cp_footer();

?>