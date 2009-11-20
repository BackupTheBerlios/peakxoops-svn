<?php

require_once dirname(__FILE__).'/PicoExtraFields.class.php' ;


// you can override this class by specifying your sub class into the preferences

class PicoExtraFieldsByGD2 extends PicoExtraFields {

// Resize by GD2
function resizeImage( $size_option , $src_path , $dst_path )
{
	$sizes = preg_split( '/\D+/' , trim( $size_option ) ) ;
	$box_w = empty( $sizes[0] ) ? 480 : intval( $sizes[0] ) ;
	$box_h = empty( $sizes[1] ) ? 480 : intval( $sizes[1] ) ;
	$quality = empty( $sizes[2] ) ? 65 : intval( $sizes[2] ) ; // 0-100

	list( $width , $height , $type ) = getimagesize( $src_path ) ;

	switch( $type ) {
		case 1 :
			// GIF
			$src_img = imagecreatefromgif( $src_path ) ;
			break ;
		case 2 :
			// JPEG
			$src_img = imagecreatefromjpeg( $src_path ) ;
			break ;
		case 3 :
			// PNG
			$src_img = imagecreatefrompng( $src_path ) ;
			break ;
		default :
			@rename( $src_path, $dst_path ) ;
			return 2 ;
	}

	if( $width > $box_w || $height > $box_h ) {
		if( $width / $box_w > $height / $box_h ) {
			$new_w = $box_w ;
			$scale = $width / $new_w ; 
			$new_h = intval( round( $height / $scale ) ) ;
		} else {
			$new_h = $box_h ;
			$scale = $height / $new_h ; 
			$new_w = intval( round( $width / $scale ) ) ;
		}
		$dst_img = imagecreatetruecolor( $new_w , $new_h ) ;
		imagecopyresampled( $dst_img , $src_img , 0 , 0 , 0 , 0 , $new_w , $new_h , $width , $height ) ;
	}

	if( isset( $dst_img ) && is_resource( $dst_img ) ) switch( $type ) {
		case 1 :
			// GIF
			imagegif( $dst_img , $dst_path ) ;
			break ;
		case 2 :
			// JPEG
			imagejpeg( $dst_img , $dst_path , $quality ) ;
			break ;
		case 3 :
			// PNG
			imagepng( $dst_img , $dst_path , intval( $quality / 10.0 ) ) ;
			break ;
	}

	imagedestroy( $dst_img ) ;
	imagedestroy( $src_img ) ;
}


}

?>