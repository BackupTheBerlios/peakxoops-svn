<?php

require_once dirname(dirname(__FILE__)).'/include/common_functions.php' ;
require_once dirname(dirname(__FILE__)).'/include/admin_functions.php' ;
require_once dirname(dirname(__FILE__)).'/class/gtickets.php' ;
$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;


$all_joints = d3pipes_admin_fetch_joints( $mydirname ) ;


//
// transaction stage
//

if( ( ! empty( $_POST['do_update'] ) || ! empty( $_POST['do_saveas'] ) ) && is_array( @$_POST['joint_weights'] ) ) {

	if ( ! $xoopsGTicket->check( true , 'd3pipes_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$joints = array() ;
	foreach( @$_POST['joint_weights'] as $i => $weight ) {
		$i = intval( $i ) ;
		$weight = intval( $weight ) ;
		$joint_type = $myts->stripSlashesGPC( @$_POST['joint_joints'][$i] ) ;
		if( empty( $joint_type ) || ! isset( $all_joints[ $joint_type ] ) ) continue ;
		$joint_class = preg_replace( '/[^0-9a-zA-Z_]/' , '' , strtolower( @$_POST['joint_classes'][$i] ) ) ;
		$valid_classes = d3pipes_admin_fetch_classes( $mydirname , $joint_type ) ;
		if( ! isset( $valid_classes[ $joint_class ] ) ) {
			$joint_class = d3pipes_common_get_default_joint_class( $mydirname , $joint_type ) ;
			if( empty( $joint_class ) ) list( $joint_class ) = array_keys( $valid_classes ) ;
		}
		$joints[ $weight ] = array(
			'joint' => $joint_type ,
			'joint_class' => $joint_class ,
			'option' => $myts->stripSlashesGPC( @$_POST['joint_option'][$i] ) ,
		) ;
	}
	ksort( $joints ) ;
	$set4sql = "`joints`='".addslashes(serialize(array_values($joints)))."',name='".$myts->addSlashes(@$_POST['name'])."',url='".$myts->addSlashes(@$_POST['url'])."',image='".$myts->addSlashes(@$_POST['image'])."'" ;
	
	$pipe_id = intval( @$_POST['pipe_id'] ) ;
	if( $pipe_id > 0 && empty( $_POST['do_saveas'] ) ) {
		$db->query( "UPDATE ".$db->prefix($mydirname."_pipes")." SET ".$set4sql.",modified_time=UNIX_TIMESTAMP(),lastfetch_time=0 WHERE `pipe_id`=$pipe_id" ) ;
	} else {
		$db->query( "INSERT INTO ".$db->prefix($mydirname."_pipes")." SET ".$set4sql.",created_time=UNIX_TIMESTAMP(),modified_time=UNIX_TIMESTAMP(),lastfetch_time=0" ) ;
	}

	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=pipe" , 3 , _MD_A_D3PIPES_MSG_PIPEUPDATED ) ;
	exit ;
}

if( ! empty( $_POST['do_delete'] ) ) {

	if ( ! $xoopsGTicket->check( true , 'd3pipes_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$pipe_id = intval( @$_POST['pipe_id'] ) ;
	$db->query( "DELETE FROM ".$db->prefix($mydirname."_pipes")." WHERE pipe_id=$pipe_id" ) ;

	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=pipe" , 3 , _MD_A_D3PIPES_MSG_PIPEUPDATED ) ;
	exit ;
}

if( ! empty( $_POST['do_batchupdate'] ) ) {

	if ( ! $xoopsGTicket->check( true , 'd3pipes_admin' ) ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	foreach( $_POST['name'] as $pipe_id => $name ) {
		$pipe_id = intval( $pipe_id ) ;
		$name4sql = $myts->addSlashes( $name ) ;
		$weight4sql = intval( @$_POST['weight'][$pipe_id] ) ;
		$flags4sql = '' ;
		foreach( array( 'main_disp' , 'main_list' , 'main_aggr' , 'main_rss' , 'block_disp' , 'in_submenu' ) as $key ) {
			$flags4sql .= ",`$key`=".( empty( $_POST[$key][$pipe_id] ) ? '0' : '1' ) ;
		}
		$db->query( "UPDATE ".$db->prefix($mydirname."_pipes")." SET name='$name4sql',weight='$weight4sql' $flags4sql WHERE pipe_id=$pipe_id" ) ;
	}

	redirect_header( XOOPS_URL."/modules/$mydirname/admin/index.php?page=pipe" , 3 , _MD_A_D3PIPES_MSG_PIPEUPDATED ) ;
	exit ;
}



//
// form stage
//

$result = $db->query( "SELECT pipe_id FROM ".$db->prefix($mydirname."_pipes")." ORDER BY weight" ) ;
$pipes4assign = array() ;
while( list( $pipe_id_tmp ) = $db->fetchRow( $result ) ) {
	$pipes4assign[ $pipe_id_tmp ] = d3pipes_common_get_pipe4assign( $mydirname , $pipe_id_tmp ) ;
}


$pipe_id = intval( @$_GET['pipe_id'] ) ;
$blank_joint = array( 'joint' => '' , 'joint_class' => '' , 'option' => '' ) ;

if( $pipe_id == 0 ) {
	// LIST
	$template = 'admin_pipe_list.html' ;
	$pipe4edit = array() ;
} else if( isset( $pipes4assign[ $pipe_id ] ) ) {
	// EDIT (DETAIL)
	$template = 'admin_pipe_edit.html' ;
	$pipe4edit = $pipes4assign[ $pipe_id ] ;
	$pipe4edit['joints'] = array_merge( $pipe4edit['joints'] , array_fill( 0 , 3 , $blank_joint ) ) ;
} else {
	// NEW
	$pipe_id = -1 ;
	$template = 'admin_pipe_edit.html' ;
	$pipe4edit = array(
		'id' => -1 ,
		'name' => '' ,
		'joints' => array(
			array( 'joint' => 'fetch' , 'joint_class' => d3pipes_common_get_default_joint_class( $mydirname , 'fetch' ) , 'option' => '' ) ,
			array( 'joint' => 'parse' , 'joint_class' => d3pipes_common_get_default_joint_class( $mydirname , 'parse' ) , 'option' => '' ) ,
			array( 'joint' => 'utf8to' , 'joint_class' => d3pipes_common_get_default_joint_class( $mydirname , 'utf8to' ) , 'option' => $xoopsModuleConfig['internal_encoding'] ) ,
			array( 'joint' => 'clip' , 'joint_class' => d3pipes_common_get_default_joint_class( $mydirname , 'clip' ) , 'option' => '' ) ,
		) ,
	) ;
	$pipe4edit['joints'] = array_merge( $pipe4edit['joints'] , array_fill( 0 , 3 , $blank_joint ) ) ;
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
	'pipe_id' => $pipe_id ,
	'pipes' => $pipes4assign ,
	'pipe' => $pipe4edit ,
	'joints' => array( '' => '----' ) + $all_joints ,
	'joint_notices' => array( '' => '' ) + d3pipes_admin_get_notice4joint( $mydirname , $all_joints ) ,
	'gticket_hidden' => $xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'd3pipes_admin') ,
) ) ;
$tpl->display( 'db:'.$mydirname.'_'.$template ) ;
xoops_cp_footer();

?>