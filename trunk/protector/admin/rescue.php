<?php
$xoopsOption['nocommon'] = true ;
require_once( '../../../mainfile.php' ) ;

$message = '' ;

// UPDATE STAGE
if( ! empty( $_POST['passwd'] ) && trim( $_POST['passwd'] ) != '' ) {
	// Checking Referer deeply against CSRF
	if( strpos( $_SERVER['HTTP_REFERER'] , XOOPS_URL.'/modules/protector/admin/' ) !== 0 ) {
		die( "Turn REFERER on (or disable Personal Firewalls like Norton" ) ;
	}

	// DB connect
	$conn = @mysql_connect( XOOPS_DB_HOST , XOOPS_DB_USER , XOOPS_DB_PASS ) ;
	mysql_select_db( XOOPS_DB_NAME , $conn ) ;

	// Authentication
	$encrypted_passwd4sql = '*=*' . addslashes( md5( trim( $_POST['passwd'] ) . XOOPS_DB_PREFIX ) ) ;
	$result = mysql_query( "SELECT count(*) FROM ".XOOPS_DB_PREFIX."_config WHERE conf_title='_MI_PROTECTOR_PASSWD_BIP' AND conf_value='$encrypted_passwd4sql'" , $conn ) ;

	// Result
	if( mysql_result( $result , 0 , 0 ) == 1 ) {
		// disable ban IP
		mysql_query( "UPDATE ".XOOPS_DB_PREFIX."_config SET conf_value='0' WHERE conf_modid='0' AND conf_name='enable_badips'" , $conn ) ;
		mysql_query( "DELETE FROM ".XOOPS_DB_PREFIX."_protector_access" , $conn ) ;
		if( ! headers_sent() ) {
			header( "Location: ".XOOPS_URL."/" ) ;
			exit ;
		} else {
			$message = "<span style='color:blue;'>DB UPDATED</span>" ;
		}
	} else {
		$message = "<span style='color:red;'>WRONG PASSWORD</span>" ;
	}
}
?>
<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Protector Rescue</title>
<body>

<p><?php echo $message ; ?></p>

<form action='' method='POST'>
	<p>Input your Password</p>
	<input type='password' name='passwd' size='15' />
	<input type='submit' name='submit' value='SUBMIT' />
</form>

</body>
</html>
