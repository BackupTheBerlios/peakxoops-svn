<?php

$db =& Database::getInstance() ;

if( ! empty( $_POST['submit'] ) ) {
	$db->query( "DELETE FROM ".$db->prefix($mydirname."_indexes") ) ;
	$imported_count = 0 ;
	$wrap_base_path = XOOPS_TRUST_PATH.'/wraps/'.$mydirname ;
	if( $handler = @opendir( $wrap_base_path . '/' ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 1 ) == '.' ) continue ;
			$file_path = $wrap_base_path . '/' . $file ;
			if( is_file( $file_path ) && in_array( strrchr( $file , '.' ) , array( '.html' , '.htm' , '.txt' ) ) ) {
				$body = file_get_contents( $file_path ) ;
				$mtime = intval( @filemtime( $file_path ) ) ;
				if( preg_match( '/\<title\>([^<>]+)\<\/title\>/ie' , $body , $regs ) ) {
					$title = $regs[1] ;
				} else {
					$title = $file ;
				}

				$result = $db->query( "INSERT INTO ".$db->prefix($mydirname."_indexes")." SET `filename`='".addslashes($file)."', `title`='".addslashes($title)."', `mtime`='$mtime', `body`='".addslashes($body)."'" ) ;
				if( $result ) $imported_count ++ ;
			}
		}
	}

	redirect_header( XOOPS_URL.'/modules/'.$mydirname.'/index.php?mode=admin&amp;page=index' , 3 , 'Imported: '.$imported_count ) ;
	exit ;
}


xoops_cp_header() ;

echo "
<form action='?mode=admin&amp;page=index' method='post'>
	<input type='submit' name='submit' value='update search database' />
</form>" ;

xoops_cp_footer() ;

?>