<?php

define( 'PICO_EXTRA_FIELDS_PREFIX' , 'extra_fields_' ) ;
define( 'PICO_EXTRA_IMAGES_PREFIX' , 'extra_images_' ) ;
define( 'PICO_EXTRA_IMAGES_FMT_MAIN' , 'main_%s.gif' ) ; // %s is replaced by $id
define( 'PICO_EXTRA_IMAGES_FMT_SMALL' , 'small_%s.gif' ) ;

class PicoExtraFields {

var $mydirname ;
var $mod_config ;
var $auto_approval ;
var $isadminormod ;
var $content_id ;
var $images_dir_full_path ;

function PicoExtraFields( $mydirname , $mod_config , $auto_approval , $isadminormod , $content_id )
{
	$this->mydirname = $mydirname ;
	$this->mod_config = $mod_config ;
	$this->auto_approval = $auto_approval ;
	$this->isadminormod = $isadminormod ;
	$this->content_id = $content_id ;
	$this->images_path = XOOPS_ROOT_PATH.'/'.$mod_config['extra_images_dir'] ;
}


function getSerializedRequestsFromPost()
{
	$ret = array() ;
	$myts =& MyTextSanitizer::getInstance() ;

	// text fields
	foreach( $_POST as $key => $val ) {
		if( strncmp( $key , PICO_EXTRA_FIELDS_PREFIX , strlen( PICO_EXTRA_FIELDS_PREFIX ) ) === 0 ) {
			$ret[ substr( $key , strlen( PICO_EXTRA_FIELDS_PREFIX ) ) ] = $myts->stripSlashesGPC( $val ) ;
		}
	}

	// process $_FILES (only adminormod )
	if( $this->isadminormod && ! empty( $_FILES ) && is_array( $_FILES ) ) {
		$this->uploadImages( $ret ) ;
	}

	return serialize( $ret ) ;
}


function uploadImages( &$extra_fields )
{
	foreach( $_FILES as $key => $file ) {
		if( strncmp( $key , PICO_EXTRA_IMAGES_PREFIX , strlen( PICO_EXTRA_IMAGES_PREFIX ) ) === 0 ) {
			$this->uploadImage( $extra_fields , $file , substr( $key , strlen( PICO_EXTRA_IMAGES_PREFIX ) ) ) ;
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

	// image sizes
	$sizes = preg_split( '/\D+/' , $this->mod_config['extra_images_size'] ) ;
	$main_width = $sizes[0] > 10 ? intval( $sizes[0] ) : 480 ;
	$main_height = $sizes[1] > 10 ? intval( $sizes[1] ) : 480 ;
	$small_width = $sizes[2] > 10 ? intval( $sizes[2] ) : 160 ;
	$small_height = $sizes[3] > 10 ? intval( $sizes[3] ) : 160 ;

	// create file names
	$salt = defined( 'XOOPS_SALT' ) ? XOOPS_SALT : XOOPS_DB_PREFIX . XOOPS_DB_USER ;
	$id = substr( md5( time() . $salt ) , 8 , 16 ) ;
	$tmp_image = $this->images_path.'/tmp_'.$id ;
	$main_image = $this->images_path.'/'.sprintf( PICO_EXTRA_IMAGES_FMT_MAIN , $id ) ;
	$small_image = $this->images_path.'/'.sprintf( PICO_EXTRA_IMAGES_FMT_SMALL , $id ) ;

	// set mask
	$prev_mask = @umask( 0022 ) ;

	// move temporary
	$upload_result = move_uploaded_file( $file['tmp_name'] , $tmp_image ) ;

	// check the file is image or not
	$check_result = @getimagesize( $tmp_image ) ;
	if( ! is_array( $check_result ) || empty( $check_result['mime'] ) ) {
		die( 'An invalid image file is uploaded' ) ;
	}

	// create main image
	exec( $this->mod_config['image_magick_path']."convert -geometry {$main_width}x{$main_height} $tmp_image $main_image" ) ;

	// create small image
	exec( $this->mod_config['image_magick_path']."convert -geometry {$small_width}x{$small_height} $tmp_image $small_image" ) ;

	// force remove remove temporary
	@unlink( $tmp_image ) ;

	// try to remove old file
	if( ! empty( $extra_fields[ $field_name ] ) ) {
		@unlink( $this->images_path.'/'.sprintf( PICO_EXTRA_IMAGES_FMT_MAIN , $extra_fields[ $field_name ] ) ) ;
		@unlink( $this->images_path.'/'.sprintf( PICO_EXTRA_IMAGES_FMT_SMALL , $extra_fields[ $field_name ] ) ) ;
	}

	// restore mask
	@umask( $prev_mask ) ;

	// set extra_fields
	$extra_fields[ $field_name ] = $id ;
}


}

?>