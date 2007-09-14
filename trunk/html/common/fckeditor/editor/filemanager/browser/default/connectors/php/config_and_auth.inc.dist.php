<?php 

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// configurations
define( 'FCK_UPLOAD_NAME' , 'NewFile' ) ;
define( 'FCK_UPLOAD_PATH' , XOOPS_UPLOAD_PATH.'/fckeditor' ) ;
define( 'FCK_UPLOAD_URL' , XOOPS_UPLOAD_URL.'/fckeditor' ) ;
define( 'FCK_FILE_PREFIX' , '' ) ; // not in use now
define( 'FCK_USER_PREFIX' , 'uid%06d_' ) ;
define( 'FCK_CHECK_USER_PREFIX4NORMAL' , true ) ;
define( 'FCK_CHECK_USER_PREFIX4ADMIN' , false ) ;
$fck_uploadable_groups = array() ; // specify groups can upload images
//$fck_uploadable_groups = array( 2 , 4 ) ; // sample
//define( 'FCK_FUNCTION_AFTER_IMGUPLOAD' , 'fck_resize_by_imagemagick' ) ;


$fck_resource_type_extensions = array(
	'File' => array() ,
	'Image' => array( 'jpeg' , 'jpg' , 'png' , 'gif' ) ,
	'Flash' => array( 'swf' , 'fla' ) ,
	'Media' => array( 'jpeg' , 'jpg' , 'png' , 'gif' , 'swf' , 'fla' , 'avi' , 'mpg' , 'mpeg' , 'mov' ) ,
) ;
$fck_allowed_extensions = array() ;

// check directory for uploading
if( ! is_dir( FCK_UPLOAD_PATH ) ) {
	SendError( '1', '', '', 'Create '.htmlspecialchars(FCK_UPLOAD_URL).' first' ) ;
}


// authentication

// check is user
if( ! is_object( $xoopsUser ) ) {
	SendError( '1', '', '', 'Only registered user can use fckeditor' ) ;
	exit ;
}

// check isadmin
if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
	// for Cube 2.1 (check if legacy module admin)
	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( 'legacy' ) ;
	$fck_isadmin = $xoopsUser->isAdmin( $module->getVar('mid') ) ;
} else {
	$fck_isadmin = $xoopsUser->isAdmin(1) ; // system module admin
}

// users other than admin
$fck_canupload = $fck_isadmin ;
if( ! $fck_isadmin ) {
	$fck_canupload = count( array_intersect( $xoopsUser->getGroups() , $fck_uploadable_groups ) ) > 0 ? true : false ;
}

// un-uploadable users cannot use browser
if( empty( $fck_isadmin ) && empty( $fck_canupload ) ) {
	SendError( '1', '', '', 'Only admin of system module can upload' ) ;
	exit ;
}


if( empty( $fck_isadmin ) ) {
	// permissions for normal users
	// never permit files other than image files
	$fck_allowed_extensions = array(
		'jpg' => 'image/jp' ,
		'jpeg' => 'image/jp' ,
		'png' => 'image/png' , 
		'gif' => 'image/gif' ,
	) ;
	$fck_user_prefix = sprintf( FCK_USER_PREFIX , $xoopsUser->getVar('uid') ) ;
	$fck_check_user_prefix = FCK_CHECK_USER_PREFIX4NORMAL ;
} else {
	// permissions for admin (Only admin of system module can upload)
	$fck_allowed_extensions = array(
		'jpg' => 'image/jp' , // both ok image/jpeg, image/jpg
		'jpeg' => 'image/jp' ,
		'png' => 'image/png' , 
		'gif' => 'image/gif' ,
		'doc' => '' ,
		'xls' => '' ,
		'txt' => '' ,
		'pdf' => '' ,
		'swf' => '' ,
		'fla' => '' ,
		'mpeg' => '' ,
		'mpg' => '' ,
		'avi' => '' ,
		'wmv' => '' ,
		'mov' => '' ,
	) ;
	$fck_user_prefix = sprintf( FCK_USER_PREFIX , $xoopsUser->getVar('uid') ) ;
	$fck_check_user_prefix = FCK_CHECK_USER_PREFIX4ADMIN ;
}


function fck_resize_by_imagemagick( $new_filefullpath )
{
	$max_width = 480 ;
	$max_height = 480 ;

	$image_stats = getimagesize( $new_filefullpath ) ;
	if( $image_stats[0] > $max_width || $image_stats[1] > $max_height ) {
		exec( "mogrify -geometry {$max_width}x{$max_height} $new_filefullpath" ) ;
	}
}

?>