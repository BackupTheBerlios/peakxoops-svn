<?php
// ------------------------------------------------------------------------- //
//                          put_tplsvarsinfo.php                             //
//                    - XOOPS templates admin module -                       //
//                          GIJOE <http://www.peak.ne.jp/>                   //
// ------------------------------------------------------------------------- //

include_once( '../../../include/cp_header.php' ) ;

include_once XOOPS_ROOT_PATH.'/modules/tplsadmin/include/tpls_functions.php' ;

$db =& Database::getInstance() ;


if( empty( $_FILES['tplset_archive']['tmp_name'] ) || ! is_uploaded_file( $_FILES['tplset_archive']['tmp_name'] ) ) die( 'No file was uploaded.' ) ;

//
// EXTRACT STAGE
//

if( substr( $_FILES['tplset_archive']['name'] , -4 ) == '.zip' ) {

	// zip
	include_once dirname(dirname(__FILE__)).'/include/Archive_Zip.php' ;
	$reader = new Archive_Zip( $_FILES['tplset_archive']['tmp_name'] ) ;
	$files = $reader->extract( array( 'extract_as_string' => true ) ) ;
	if( ! is_array( @$files ) ) die( $reader->errorName() ) ;
	$do_upload = true ;

} else if( substr( $_FILES['tplset_archive']['name'] , -4 ) == '.tgz' || substr( $_FILES['tplset_archive']['name'] , -7 ) == '.tar.gz' ) {

	// tar.gz
	include_once XOOPS_ROOT_PATH.'/class/class.tar.php' ;
	$tar = new tar() ;
	$tar->openTar( $_FILES['tplset_archive']['tmp_name'] ) ;
	$files = array() ;
	foreach( $tar->files as $id => $info ) {
		$files[] = array(
			'filename' => $info['name'] ,
			'mtime' => $info['time'] ,
			'content' => $info['file'] ,
		) ;
	}
	if( empty( $files ) ) die( 'Invalid archive' ) ;
	$do_upload = true ;
}

if( empty( $do_upload ) ) exit ;

//
// IMPORT STAGE
//

$tplset = @$_POST['tplset'] ;
if( ! preg_match( '/^[0-9A-Za-z_-]{1,16}$/' , $tplset ) ) {
	die( "Invalid tplset specified" ) ;
}

$imported = 0 ;
foreach( $files as $file ) {

	if( ! empty( $file['folder'] ) ) continue ;
	$pos = strrpos( $file['filename'] , '/' ) ;
	$tpl_file = $pos === false ? $file['filename'] : substr( $file['filename'] , $pos + 1 ) ;

	if( tplsadmin_import_data( $tplset , $tpl_file , rtrim( $file['content'] ) , $file['mtime'] ) ) $imported ++ ;

}

redirect_header( 'compilehookadmin.php' , 3 , $imported.'個のテンプレートをインポートしました' ) ;
exit ;

?>
