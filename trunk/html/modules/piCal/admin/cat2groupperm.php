<?php

require_once( '../../../include/cp_header.php' ) ;
require_once( 'mygrouppermform.php' ) ;
require_once( XOOPS_ROOT_PATH."/class/xoopstree.php" ) ;

// for "Duplicatable"
$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

require_once( XOOPS_ROOT_PATH."/modules/$mydirname/include/gtickets.php" ) ;

// the names of tables
$cat_table = $xoopsDB->prefix( "pical{$mydirnumber}_cat" ) ;

// language files
$language = $xoopsConfig['language'] ;
if( ! file_exists( XOOPS_ROOT_PATH . "/modules/system/language/$language/admin/blocksadmin.php") ) $language = 'english' ;
include_once( XOOPS_ROOT_PATH . "/modules/system/language/$language/admin.php" ) ;

if( ! empty( $_POST['submit'] ) ) {

	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	include( "mygroupperm.php" ) ;
	redirect_header( XOOPS_URL."/modules/$mydirname/admin/cat2groupperm.php" , 1 , _MD_AM_DBUPDATED );
	exit ;
}


// creating Objects of XOOPS
$myts =& MyTextSanitizer::getInstance();
$cattree = new XoopsTree( $cat_table , "cid" , "pid" ) ;
$form = new MyXoopsGroupPermForm( _AM_MENU_CAT2GROUP , $xoopsModule->mid() , 'pical_cat' , _AM_CAT2GROUPDESC ) ;

$cat_tree_array = $cattree->getChildTreeArray( 0 , 'weight ASC,cat_title' ) ;

foreach( $cat_tree_array as $cat ) {
	$form->addItem( intval( $cat['cid'] ) , $myts->makeTBoxData4Show( $cat['cat_title'] ) , intval( $cat['pid'] ) ) ;
}

xoops_cp_header();
include( './mymenu.php' ) ;
echo $form->render() ;
xoops_cp_footer();

?>
