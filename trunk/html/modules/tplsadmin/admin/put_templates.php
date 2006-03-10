<?php
// ------------------------------------------------------------------------- //
//                          put_tplsvarsinfo.php                             //
//                    - XOOPS templates admin module -                       //
//                          GIJOE <http://www.peak.ne.jp/>                   //
// ------------------------------------------------------------------------- //

include_once( '../../../include/cp_header.php' ) ;

include_once XOOPS_ROOT_PATH.'/class/template.php';

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
	$tpl_source = rtrim( $file['content'] ) ;
	$lastmodified = $file['mtime'] ;

	// check the file is valid template
	list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix("tplfile")." WHERE tpl_tplset='default' AND tpl_file='".addslashes($tpl_file)."'" ) ) ;
	if( ! $count ) continue ;

	// check the template exists in the tplset
	if( $tplset != 'default' ) {
		list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix("tplfile")." WHERE tpl_tplset='".addslashes($tplset)."' AND tpl_file='".addslashes($tpl_file)."'" ) ) ;
		if( $count <= 0 ) {
			// copy from 'default' to the tplset
			$result = $db->query( "SELECT * FROM ".$db->prefix("tplfile")." WHERE tpl_tplset='default' AND tpl_file='".addslashes($tpl_file)."'" ) ;
			while( $row = $db->fetchArray( $result ) ) {
				$db->query( "INSERT INTO ".$db->prefix("tplfile")." SET tpl_refid='".addslashes($row['tpl_refid'])."',tpl_module='".addslashes($row['tpl_module'])."',tpl_tplset='".addslashes($tplset)."',tpl_file='".addslashes($tpl_file)."',tpl_desc='".addslashes($row['tpl_desc'])."',tpl_type='".addslashes($row['tpl_type'])."'" ) ;
				$tpl_id = $db->getInsertId() ;
				$db->query( "INSERT INTO ".$db->prefix("tplsource")." SET tpl_id='$tpl_id', tpl_source=''" ) ;
			}
		}
	}

	// UPDATE just tpl_lastmodified and tpl_source
	$drs = $db->query( "SELECT tpl_id FROM ".$db->prefix("tplfile")." WHERE tpl_tplset='".addslashes($tplset)."' AND tpl_file='".addslashes($tpl_file)."'" ) ;
	while( list( $tpl_id ) = $db->fetchRow( $drs ) ) {
		$db->query( "UPDATE ".$db->prefix("tplfile")." SET tpl_lastmodified='".addslashes($lastmodified)."',tpl_lastimported=UNIX_TIMESTAMP() WHERE tpl_id='$tpl_id'" ) ;
		$db->query( "UPDATE ".$db->prefix("tplsource")." SET tpl_source='".addslashes($tpl_source)."' WHERE tpl_id='$tpl_id'" ) ;
		xoops_template_touch( $tpl_id ) ;
	}

	$imported ++ ;
}

redirect_header( 'compilehookadmin.php' , 3 , $imported.'個のテンプレートをインポートしました' ) ;
exit ;

?>
