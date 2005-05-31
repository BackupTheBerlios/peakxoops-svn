<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Configuration file
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.1.0, 2003-03-27
// ================================================

if( ! defined( 'XOOPS_ROOT_PATH' ) ) {
	include_once( '../../../mainfile.php' ) ;
}

// language mapping
$lang_x2spaw = array(
	'english' => 'en' ,
	'french' => 'fr' ,
	'german' => 'de' ,
	'japanese' => 'ja' ,
	'nederlands' => 'nl' ,
	'swedish' => 'se' ,
	'spanish' => 'es' ,
	'tchinese' => 'zh-gb2312'
) ;
$xlang = empty( $xoopsConfig['language'] ) ? 'english' : strtolower( $xoopsConfig['language'] ) ;
$spaw_default_lang = empty( $lang_x2spaw[ $xlang ] ) ? 'en' : $lang_x2spaw[ $xlang ] ;

// directory where spaw files are located
// $spaw_dir = 'spaw/';
$spaw_dir = XOOPS_URL . '/common/spaw/' ;

// base url for images
$spaw_base_url = XOOPS_URL.'/';

// $spaw_root = dirname( dirname( __FILE__ ) ) . '/' ;
$spaw_root = XOOPS_ROOT_PATH . '/common/spaw/' ;

$spaw_default_toolbars = 'full';
$spaw_default_theme = 'default';
// $spaw_default_lang = _TC_SPAWLANG ;
$spaw_default_css_stylesheet = $spaw_dir.'wysiwyg.css';

// add javascript inline or via separate file
$spaw_inline_js = true;

// use active toolbar (reflecting current style) or static
$spaw_active_toolbar = true;

// default dropdown content
$spaw_dropdown_data['style']['default'] = 'Normal';

$spaw_dropdown_data['font']['Arial'] = 'Arial';
$spaw_dropdown_data['font']['Courier'] = 'Courier';
$spaw_dropdown_data['font']['Tahoma'] = 'Tahoma';
$spaw_dropdown_data['font']['Times New Roman'] = 'Times';
$spaw_dropdown_data['font']['Verdana'] = 'Verdana';
//$spaw_dropdown_data['font']['Serif'] = 'Serif';
//$spaw_dropdown_data['font']['Sans-serif'] = 'Sans-serif';
$spaw_dropdown_data['font']['Comic Sans MS'] = 'Cursive';
//$spaw_dropdown_data['font']['Fantasy'] = 'Fantasy';
$spaw_dropdown_data['font']['Courier New'] = 'Monospace';

$spaw_dropdown_data['fontsize']['1'] = '1';
$spaw_dropdown_data['fontsize']['2'] = '2';
$spaw_dropdown_data['fontsize']['3'] = '3';
$spaw_dropdown_data['fontsize']['4'] = '4';
$spaw_dropdown_data['fontsize']['5'] = '5';
$spaw_dropdown_data['fontsize']['6'] = '6';

$spaw_dropdown_data['paragraph']['p'] = 'Normal';
$spaw_dropdown_data['paragraph']['h1'] = 'Heading 1';
$spaw_dropdown_data['paragraph']['h2'] = 'Heading 2';
$spaw_dropdown_data['paragraph']['h3'] = 'Heading 3';
$spaw_dropdown_data['paragraph']['h4'] = 'Heading 4';
$spaw_dropdown_data['paragraph']['h5'] = 'Heading 5';
$spaw_dropdown_data['paragraph']['h6'] = 'Heading 6';

// image library related config

// allowed extentions for uploaded image files
$spaw_valid_imgs = array('gif', 'jpg', 'jpeg', 'png');

// allow upload in image library
$spaw_upload_allowed = false;

// image libraries
global $xoopsDB;

$fp = fopen( XOOPS_ROOT_PATH . '/imagemanager.php' , 'r' ) ;
$top_of_imagemanager = fread( $fp , 4096 ) ;
fclose( $fp ) ;

if( strstr( $top_of_imagemanager , '$mydirname' ) ) {
	$im_type = 'myalbum' ;
	$im_number = '' ;
} else if( preg_match( '?modules/(\D+)(\d*)/imagemanager.php?' , $top_of_imagemanager , $regs ) ) {
	$im_type = $regs[1] ;
	$im_number = $regs[2] ;
} else {
	$im_type = 'xoops' ;
}

if( $im_type == 'xoops' ) {
	// Xoops original Image Manager
	$result = $xoopsDB->query("SELECT imgcat_name, imgcat_id, imgcat_storetype FROM ".$xoopsDB->prefix('imagecategory')." ORDER BY imgcat_name ASC");
$i=0;

	$i = 0 ;
	while($imgcat = $xoopsDB->fetcharray($result)){
	
		$spaw_imglibs[$i]["type"]  = "IM";
		$spaw_imglibs[$i]["value"] = 'uploads/';
		$spaw_imglibs[$i]["text"] = $imgcat["imgcat_name"];
		$spaw_imglibs[$i]["catID"] = $imgcat["imgcat_id"];
		$spaw_imglibs[$i]["storetype"] = $imgcat["imgcat_storetype"];
		$spaw_imglibs[$i]["autoID"] = $i;
	
		$i++;
	}
} else {
	// myAlbum-P ImageManagerIntegration
	$result = $xoopsDB->query("SELECT title, cid FROM ".$xoopsDB->prefix("myalbum{$im_number}_cat")." ORDER BY title ASC");

	$i = 0 ;
	while($imgcat = $xoopsDB->fetcharray($result)){
		$spaw_imglibs[$i]["type"]  = "myAlbum-P" ;
		$spaw_imglibs[$i]["value"] = 'uploads/';
		$spaw_imglibs[$i]["text"] = $imgcat["title"] ;
		$spaw_imglibs[$i]["catID"] = $imgcat["cid"] ;
		$spaw_imglibs[$i]["storetype"] = $im_number ;
		$spaw_imglibs[$i]["autoID"] = $imgcat["cid"] ;
	
		$i++;
	}
}




/*
$spaw_imglibs = array(
  array(
    'value'   => 'uploads/',
    'text'    => 'Uploads',
  )
);
*/

?>
