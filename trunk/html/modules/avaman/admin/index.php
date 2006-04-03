<?php

$avaman_allowed_exts = array(
	'gif' => 'image/gif' ,
	'jpg' => 'image/jpeg' ,
	'jpeg' => 'image/jpeg' ,
	'png' => 'image/png' ,
) ;


include_once( '../../../include/cp_header.php' ) ;

include_once "../include/gtickets.php" ;

$db =& Database::getInstance() ;
$myts =& MyTextSanitizer::getInstance() ;

//
// POST Stage
//

if( ! empty( $_POST['modify_avatars'] ) ) {

	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	// rename
	$avatar_ids = array() ;
	if( is_array( @$_POST['avatar_names'] ) ) {
		foreach( $_POST['avatar_names'] as $avatar_id => $avatar_name ) {
			$avatar_id = intval( $avatar_id ) ;
			$db->query( "UPDATE ".$db->prefix("avatar")." SET avatar_name='".$myts->addSlashes($avatar_name)."' WHERE avatar_id=".intval($avatar_id) ) ;
			$avatar_ids[] = $avatar_id ;
		}
	}

	// display
	foreach( $avatar_ids as $avatar_id ) {
		if( empty( $_POST['avatar_displays'][$avatar_id] ) ) {
			$db->query( "UPDATE ".$db->prefix("avatar")." SET avatar_display=0 WHERE avatar_id=$avatar_id" ) ;
		} else {
			$db->query( "UPDATE ".$db->prefix("avatar")." SET avatar_display=1 WHERE avatar_id=$avatar_id" ) ;
		}
	}

	// weight
	foreach( $avatar_ids as $avatar_id ) {
		$db->query( "UPDATE ".$db->prefix("avatar")." SET avatar_weight='".intval(@$_POST['avatar_weights'][$avatar_id])."' WHERE avatar_id=$avatar_id" ) ;
	}

	// delete
	foreach( $avatar_ids as $avatar_id ) {
		if( ! empty( $_POST['avatar_deletes'][$avatar_id] ) ) {
			$result = $db->query( "SELECT avatar_file FROM ".$db->prefix("avatar")." WHERE avatar_id=$avatar_id" ) ;
			if( $result ) {
				list( $file ) = $db->fetchRow( $result ) ;
				if( strstr( $file , '..' ) ) die( '.. found.' ) ;
				@unlink( XOOPS_UPLOAD_PATH . '/' . $file ) ;
				$db->query( "DELETE FROM ".$db->prefix("avatar")." WHERE avatar_id=$avatar_id" ) ;
			}
		}
	}

	redirect_header( "index.php" , 2 , _AM_AVAMAN_DBUPDATED ) ;
	exit ;
}


// ARCHIVE UPLOAD
if( ! empty( $_FILES['upload_archive']['tmp_name'] ) && is_uploaded_file( $_FILES['upload_archive']['tmp_name'] ) ) {

	// extract stage
	$orig_filename4check = strtolower( $_FILES['upload_archive']['name'] ) ;
	$orig_ext4check = substr( $orig_filename4check , strrpos( $orig_filename4check , '.' ) + 1 ) ;
	if( $orig_ext4check == 'zip' ) {
	
		// zip
		include_once dirname(dirname(__FILE__)).'/include/Archive_Zip.php' ;
		$reader = new Archive_Zip( $_FILES['upload_archive']['tmp_name'] ) ;
		$files = $reader->extract( array( 'extract_as_string' => true ) ) ;
		if( ! is_array( @$files ) ) die( $reader->errorName() ) ;
	
	} else if( $orig_ext4check == 'tar' || $orig_ext4check == 'tgz' || $orig_ext4check == 'gz' ) {
	
		// tar or tgz or tar.gz
		include_once XOOPS_ROOT_PATH.'/class/class.tar.php' ;
		$tar = new tar() ;
		$tar->openTar( $_FILES['upload_archive']['tmp_name'] ) ;
		$files = array() ;
		foreach( $tar->files as $id => $info ) {
			$files[] = array(
				'filename' => $info['name'] ,
				'mtime' => $info['time'] ,
				'content' => $info['file'] ,
			) ;
		}
		if( empty( $files ) ) die( _AM_AVAMAN_ERR_INVALIDARCHIVE ) ;

	} else if( ! empty( $avaman_allowed_exts[$orig_ext4check] ) ) {
	
		// a single image file
		$files = array() ;
		$files[] = array(
			'filename' => $_FILES['upload_archive']['name'] ,
			'mtime' => time() ,
			'content' => function_exists( 'file_get_contents' ) ? file_get_contents( $_FILES['upload_archive']['tmp_name'] ) : implode( file( $_FILES['upload_archive']['tmp_name'] ) ) ,
		) ;
	} else {
		die( _AM_AVAMAN_INVALIDEXT ) ;
	}

	// import stage
	$imported = 0 ;
	foreach( $files as $file ) {
	
		if( ! empty( $file['folder'] ) ) continue ;
		$file_pos = strrpos( $file['filename'] , '/' ) ;
		$file_name = $file_pos === false ? $file['filename'] : substr( $file['filename'] , $file_pos + 1 ) ;
		$ext_pos = strrpos( $file_name , '.' ) ;
		if( $ext_pos === false ) continue ;
		$ext = strtolower( substr( $file_name , $ext_pos + 1 ) ) ;
		if( empty( $avaman_allowed_exts[$ext] ) ) continue ;
		$file_node = substr( $file_name , 0 , $ext_pos ) ;
		$save_file_name = uniqid( 'savt' ) . '.' . $ext ;
		$fw = fopen( XOOPS_UPLOAD_PATH.'/'.$save_file_name , "w" ) ;
		if( ! $fw ) continue ;
		@fwrite( $fw , $file['content'] ) ;
		@fclose( $fw ) ;
		$db->query( "INSERT INTO ".$db->prefix("avatar")." SET avatar_file='".addslashes($save_file_name)."', avatar_name='".addslashes($file_node)."', avatar_mimetype='".addslashes(@$avaman_allowed_exts[$ext])."', avatar_created=UNIX_TIMESTAMP(), avatar_display=1, avatar_weight=0, avatar_type='S'" ) ;

		$imported ++ ;
	}
	
	redirect_header( 'index.php' , 3 , sprintf( _AM_AVAMAN_FILEUPLOADED , $imported )  ) ;
	exit ;
}












// Form Stage

xoops_cp_header() ;

$sql = "SELECT avatar_id , avatar_file , avatar_name , avatar_created , avatar_display , avatar_weight  FROM ".$db->prefix("avatar")." WHERE avatar_type='S' ORDER BY avatar_weight,avatar_id" ;
$result = $db->query( $sql ) ;

echo "
<form action='' id='avaman_upload' method='post' enctype='multipart/form-data' class='odd'>
	<label for='upload_archive'>"._AM_AVAMAN_UPLOAD."</label>
	<br />
	<input type='file' id='upload_archive' name='upload_archive' size='60' />
	<input type='submit' value='"._SUBMIT."' />
</form>
<form action='' id='avaman_list' method='post'>
<table class='outer' id='avaman_main'>
	<tr>
		<th>id </th><th>file</th><th>name</th><th>created</th><th>display</th><th>weight</th><th>delete</th>
	</tr>\n" ;

while( list( $avatar_id , $avatar_file , $avatar_name , $avatar_created , $avatar_display , $avatar_weight ) = $db->fetchRow( $result ) ) {
	$evenodd = @$evenodd == 'even' ? 'odd' : 'even' ;
	echo "
	<tr>
		<td class='$evenodd'>$avatar_id</td>
		<td class='$evenodd'><img src='".XOOPS_UPLOAD_URL.'/'.urlencode($avatar_file)."' alt='' /></td>
		<td class='$evenodd'><input type='text' size='24' name='avatar_names[$avatar_id]' value='".htmlspecialchars($avatar_name,ENT_QUOTES)."' /></td>
		<td class='$evenodd'> ".formatTimestamp($avatar_created)."</td>
		<td class='$evenodd'><input type='checkbox' name='avatar_displays[$avatar_id]' ".($avatar_display?"checked='checked'":"")." /></td>
		<td class='$evenodd'><input type='text' size='4' name='avatar_weights[$avatar_id]' value='$avatar_weight' /></td>
		<td class='$evenodd'><input type='checkbox' name='avatar_deletes[$avatar_id]' /></td>
	</tr>\n" ;
}
echo "
</table>
<input type='submit' name='modify_avatars' value='"._SUBMIT."' />
".$xoopsGTicket->getTicketHtml( __LINE__ )."
</form>
" ;

xoops_cp_footer() ;

?>
