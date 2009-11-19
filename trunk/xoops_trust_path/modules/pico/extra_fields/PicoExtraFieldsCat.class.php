<?php

require_once dirname(__FILE__).'/PicoExtraFields.class.php' ;

// you can override this class by specifying your sub class into the preferences

class PicoExtraFieldsCat extends PicoExtraFields {

function removeUnlinkedImages( $current_id )
{
	$glob_pattern = '*'.substr($current_id,-1).'_c.*' ; // 1/16 random match
	//$glob_pattern = '*_c.*' ;

	$db =& Database::getInstance() ;

	foreach( glob( $this->images_path.'/'.$glob_pattern ) as $filename ) {
		if( strstr( $filename , $current_id ) ) continue ;
		if( preg_match( '/([0-9a-f]{16}_c\.[a-z]{3})$/' , $filename , $regs ) ) {
			$image_id = $regs[1] ;
			list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($this->mydirname."_categories")." WHERE cat_extra_fields LIKE '%".addslashes($image_id)."%'" ) ) ;
			if( $count <= 0 ) {
				unlink( $filename ) ;
			}
		}
	}
}


function createId( $extra_fields , $file , $field_name )
{
	$salt = defined( 'XOOPS_SALT' ) ? XOOPS_SALT : XOOPS_DB_PREFIX . XOOPS_DB_USER ;
	return substr( md5( time() . $salt ) , 8 , 16 ).'_c' ;
}



}

?>