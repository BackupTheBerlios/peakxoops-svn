<?php 

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// configurations
define( 'FCK_UPLOAD_NAME' , 'NewFile' ) ;
define( 'FCK_UPLOAD_PATH' , XOOPS_UPLOAD_PATH.'/fckeditor' ) ;
define( 'FCK_UPLOAD_URL' , XOOPS_UPLOAD_URL.'/fckeditor' ) ;
define( 'FCK_FILE_PREFIX' , 'fck' ) ;

$fck_allowed_extensions = array() ;

// check directory for uploading
if( ! is_dir( FCK_UPLOAD_PATH ) ) {
	SendError( '1', '', '', 'Create '.htmlspecialchars(FCK_UPLOAD_URL).' first' ) ;
}


// authentication

// check is user
if( ! is_object( $xoopsUser ) ) {
	SendError( '1', '', '', 'Only registered user can use fckeditor' ) ;
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

// not implemented yet (TODO)
$fck_canupload = $fck_isadmin ;

if( empty( $fck_isadmin ) && empty( $fck_canupload ) ) {
	// permissions for normal without upload
	if( ! empty( $_FILES ) ) {
		SendError( '1', '', '', 'Only admin of system module can upload' ) ;
	}
} else if( empty( $fck_isadmin ) ) {
	// permissions for normal with upload
	$fck_allowed_extensions = array(
		'jpg' => 'image/jp' , // both ok image/jpeg, image/jpg
		'jpeg' => 'image/jp' ,
		'png' => 'image/png' , 
		'gif' => 'image/gif' ,
	) ;
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
	) ;
}


?>