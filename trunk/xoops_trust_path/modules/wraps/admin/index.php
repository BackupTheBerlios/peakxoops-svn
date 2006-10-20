<?php

function wraps_register_searchable_files_recursive( $base_path , $path )
{
	global $db , $mydirname , $imported_count ;

	if( $handler = @opendir( $base_path . '/' . $path ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 1 ) == '.' ) continue ;
			$full_path = $base_path . '/' . $path . $file ;
			if( is_dir( $full_path ) ) {
				wraps_register_searchable_files_recursive( $base_path , $path . $file . '/' ) ;
			} else if( in_array( strrchr( $file , '.' ) , array( '.html' , '.htm' , '.txt' ) ) ) {
				$mtime = intval( @filemtime( $full_path ) ) ;
				$body = file_get_contents( $full_path ) ;
				if( preg_match( '/\<title\>([^<>]+)\<\/title\>/is' , $body , $regs ) ) {
					$title = $regs[1] ;
				} else {
					$title = $file ;
				}

				$result = $db->query( "INSERT INTO ".$db->prefix($mydirname."_indexes")." SET `filename`='".addslashes($path.$file)."', `title`='".addslashes($title)."', `mtime`='$mtime', `body`='".addslashes(strip_tags($body))."'" ) ;
				if( $result ) $imported_count ++ ;
			}
		}
	}
}

$db =& Database::getInstance() ;

if( ! empty( $_POST['submit'] ) ) {
	$db->query( "DELETE FROM ".$db->prefix($mydirname."_indexes") ) ;
	$imported_count = 0 ;
	wraps_register_searchable_files_recursive( XOOPS_TRUST_PATH.'/wraps/'.$mydirname , '' ) ;

	redirect_header( XOOPS_URL.'/modules/'.$mydirname.'/admin/index.php?page=index' , 3 , sprintf( _MD_A_WRAPS_FMT_UPDATED_INDEXES , $imported_count ) ) ;
	exit ;
}


xoops_cp_header() ;
$mymenu_fake_uri = 'admin/index.php?page=index' ;
include dirname(__FILE__).'/mymenu.php' ;

echo "
<form action='?page=index' method='post'>
	<input type='submit' name='submit' value='"._MD_A_WRAPS_BTN_UPDATE_INDEXES."' />
</form>" ;

xoops_cp_footer() ;

?>