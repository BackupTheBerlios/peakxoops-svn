<?php

define( 'PICO_EXTRA_FIELDS_PREFIX' , 'extra_fields_' ) ;
define( 'PICO_EXTRA_FIELDS_PREFIX_SHORT' , 'ef_' ) ;
define( 'PICO_EXTRA_IMAGES_PREFIX' , 'extra_images_' ) ;
define( 'PICO_EXTRA_IMAGES_PREFIX_SHORT' , 'ei_' ) ;
// %1$s: field_name   %2$s: size_key  %3$s: image_id
define( 'PICO_EXTRA_IMAGES_FMT' , '%s_%s_%s' ) ;
define( 'PICO_EXTRA_IMAGES_REMOVAL_COMMAND' , 'remove.gif' ) ;


// you can override this class by specifying your sub class into the preferences

class PicoExtraFields {

var $mydirname ;
var $categoryObj = null ;
var $mod_config ;
var $auto_approval = false ;
var $isadminormod = false ;
var $content_id = 0 ;
var $images_path ;
var $image_sizes ;
var $requests = array() ;


function PicoExtraFields( $mydirname , $categoryObj , $content_id = 0 )
{
	$this->mydirname = $mydirname ;
	$this->categoryObj = $categoryObj ;
	$this->mod_config = $this->categoryObj->getOverriddenModConfig() ;
	$cat_data = $this->categoryObj->getData() ;
	$this->auto_approval = $cat_data['post_auto_approved'] ;
	$this->isadminormod = $cat_data['isadminormod'] ;
	$this->content_id = $content_id ;
	$this->images_path = XOOPS_ROOT_PATH.'/'.$this->mod_config['extra_images_dir'] ;
	$this->image_sizes = preg_split( '/\s+/' , $this->mod_config['extra_images_size'] ) ;
}


function getSerializedRequestsFromPost()
{
	$ret = array() ;
	$myts =& MyTextSanitizer::getInstance() ;

	// text fields
	foreach( $_POST as $key => $val ) {
		if( strncmp( $key , PICO_EXTRA_FIELDS_PREFIX , strlen( PICO_EXTRA_FIELDS_PREFIX ) ) === 0 ) {
			$ret[ substr( $key , strlen( PICO_EXTRA_FIELDS_PREFIX ) ) ] = $this->stripSlashesGPC( $val ) ;
		} elseif( strncmp( $key , PICO_EXTRA_FIELDS_PREFIX_SHORT , strlen( PICO_EXTRA_FIELDS_PREFIX_SHORT ) ) === 0 ) {
			$ret[ substr( $key , strlen( PICO_EXTRA_FIELDS_PREFIX_SHORT ) ) ] = $this->stripSlashesGPC( $val ) ;
		}
	}

	// process $_FILES (only adminormod )
	if( $this->canUploadImages() && ! empty( $_FILES ) && is_array( $_FILES ) ) {
		$this->uploadImages( $ret ) ;
	}

	$this->requests = $ret ;

	return pico_common_serialize( $ret ) ;
}


function syncContentEfSortables( $content_id )
{
	// store it into the table `content_ef_sortables`
	$sortables = array_map( 'trim' , explode( ',' , $this->mod_config['extra_fields_sortables'] ) ) ;
	if( ! empty( $sortables ) ) {
		$db =& Database::getInstance() ;
		$fields = array() ;
		$values = array() ;
		foreach( $sortables as $key => $field ) {
			$fields[] = "`ef{$key}`" ;
			$values[] = "'".mysql_real_escape_string( @$this->requests[ $field ] )."'" ;
		}
		$db->queryF( "REPLACE ".$db->prefix("{$this->mydirname}_content_ef_sortables")." (`content_id`,".implode(',',$fields).") VALUES ($content_id,".implode(',',$values).")" ) ;
	}
}


// virtual
function canUploadImages()
{
	return $this->isadminormod ;
}


function uploadImages( &$extra_fields )
{
	foreach( $_FILES as $key => $file ) {
		if( strncmp( $key , PICO_EXTRA_IMAGES_PREFIX , strlen( PICO_EXTRA_IMAGES_PREFIX ) ) === 0 ) {
			$this->uploadImage( $extra_fields , $file , substr( $key , strlen( PICO_EXTRA_IMAGES_PREFIX ) ) ) ;
		} else if( strncmp( $key , PICO_EXTRA_IMAGES_PREFIX_SHORT , strlen( PICO_EXTRA_IMAGES_PREFIX_SHORT ) ) === 0 ) {
			$this->uploadImage( $extra_fields , $file , substr( $key , strlen( PICO_EXTRA_IMAGES_PREFIX_SHORT ) ) ) ;
		}
	}
}


function uploadImage( &$extra_fields , $file , $field_name )
{
	// check it is true uploaded file
	if( ! is_uploaded_file( $file['tmp_name'] ) ) {
		return false ;
	}

	// check the directory exists
	if( ! is_dir( $this->images_path ) ) {
		die( 'create upload directory for pico first' ) ;
	}

	// command for removing. upload "remove.gif"
	if( $file['name'] == PICO_EXTRA_IMAGES_REMOVAL_COMMAND ) {
		foreach( array_keys( $this->image_sizes ) as $size_key ) {
			unlink( $this->getImageFullPath( $field_name , $size_key , $extra_fields[ $field_name ] ) ) ;
		}
		$extra_fields[ $field_name ] = '' ;
		return true ;
	}

	// create id
	$id = $this->createId( $extra_fields , $file , $field_name ) ;

	// create temp file name
	$tmp_image = $this->images_path.'/tmp_'.$id ;

	// set mask
	$prev_mask = @umask( 0022 ) ;

	// move temporary
	$upload_result = move_uploaded_file( $file['tmp_name'] , $tmp_image ) ;
	if( ! $upload_result ) {
		die( 'check the permission/owner of the directory '.htmlspecialchars( $this->mod_config['extra_images_dir'] , ENT_QUOTES ) ) ;
	}
	@chmod( $tmp_image , 0644 ) ;

	// check the file is image or not
	$check_result = @getimagesize( $tmp_image ) ;
	if( ! is_array( $check_result ) || empty( $check_result['mime'] ) ) {
		@unlink( $tmp_image ) ;
		die( 'An invalid image file is uploaded' ) ;
	}

	// set image_id ( = $id . $ext )
	$image_id = $id . '.' . $this->getExtFromMime( $check_result['mime'] ) ;

	// resize loop
	foreach( $this->image_sizes as $size_key => $size_option ) {
		$image_path = $this->getImageFullPath( $field_name , $size_key , $image_id ) ;
		$this->resizeImage( $size_option , $tmp_image , $image_path ) ;
	}

	// force remove remove temporary
	@unlink( $tmp_image ) ;

	// gabage collection (TODO)
	$this->removeUnlinkedImages( $id ) ;

	// restore mask
	@umask( $prev_mask ) ;

	// set extra_fields
	$extra_fields[ $field_name ] = $image_id ;
}


// Resize by ImageMagick
function resizeImage( $size_option , $tmp_image , $image_path )
{
	$sizes = preg_split( '/\D+/' , trim( $size_option ) ) ;
	$box_w = empty( $sizes[0] ) ? 480 : intval( $sizes[0] ) ;
	$box_h = empty( $sizes[1] ) ? 480 : intval( $sizes[1] ) ;
	$quality = empty( $sizes[2] ) ? 65 : intval( $sizes[2] ) ; // 0-100

	exec( $this->mod_config['image_magick_path']."convert -quality $quality -thumbnail {$box_w}x{$box_h} $tmp_image $image_path" ) ;
	@chmod( $image_path , 0644 ) ;
}


function createId( $extra_fields , $file , $field_name )
{
	$salt = defined( 'XOOPS_SALT' ) ? XOOPS_SALT : XOOPS_DB_PREFIX . XOOPS_DB_USER ;
	return substr( md5( time() . $salt ) , 8 , 16 ) ;
}


function getImageFullPath( $field_name , $size_key , $image_id )
{
	return $this->images_path.'/'.sprintf( PICO_EXTRA_IMAGES_FMT , $field_name , $size_key , $image_id ) ;
}


function getExtFromMime( $mime )
{
	switch( strtolower( $mime ) ) {
		case 'image/gif' :
			return 'gif' ;
		case 'image/png' :
			return 'png' ;
		default :
			return 'jpg' ;
	}
}


function removeUnlinkedImages( $current_id )
{
	$glob_pattern = '*'.substr($current_id,-1).'.*' ; // 1/16 random match
	//$glob_pattern = '*' ;

	$db =& Database::getInstance() ;

	foreach( glob( $this->images_path.'/'.$glob_pattern ) as $filename ) {
		if( strstr( $filename , $current_id ) ) continue ;
		if( preg_match( '/([0-9a-f]{16}\.[a-z]{3})$/' , $filename , $regs ) ) {
			$image_id = $regs[1] ;
			list( $count ) = $db->fetchRow( $db->query( "SELECT COUNT(*) FROM ".$db->prefix($this->mydirname."_contents")." WHERE extra_fields LIKE '%".addslashes($image_id)."%'" ) ) ;
			if( $count <= 0 ) {
				unlink( $filename ) ;
			}
		}
	}
}


function stripSlashesGPC( $data )
{
	if( ! get_magic_quotes_gpc() ) return $data ;
	if( is_array( $data ) ) {
		return array_map( array( $this , 'stripSlashesGPC' ) , $data ) ;
	} else {
		return stripslashes( $data ) ;
	}
}



}

?>