<?php

require_once dirname(__FILE__).'/PicoExtraFields.class.php' ;


// you can override this class by specifying your sub class into the preferences

class PicoExtraFieldsByGD2 extends PicoExtraFields {

// Resize by GD2
function resizeImage( $sizes , $src_path , $dst_path )
{
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

	if( $width > $sizes[0] || $height > $sizes[1] ) {
		if( $width / $sizes[0] > $height / $sizes[1] ) {
			$new_w = $sizes[0] ;
			$scale = $width / $new_w ; 
			$new_h = intval( round( $height / $scale ) ) ;
		} else {
			$new_h = $sizes[1] ;
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
			imagejpeg( $dst_img , $dst_path , $sizes[2] ) ;
			break ;
		case 3 :
			// PNG
			imagepng( $dst_img , $dst_path , intval( $sizes[2] / 10.0 ) ) ;
			break ;
	}

	imagedestroy( $dst_img ) ;
	imagedestroy( $src_img ) ;
}


}

?>