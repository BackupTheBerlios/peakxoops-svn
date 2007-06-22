<?php
//NE+
//never-ever.info
/* ---------------------------------------------------------------------------*/

function b_xmobile_qr_show( $options )
{
	$qr_num = empty( $options[0] ) ? 0 : intval( $options[0] ) ;
	$qrimg_dir = empty( $options[1] ) ? "" : htmlspecialchars( $options[1] ) ;


	$block = array() ;
	if( $qr_num == 0 && $qrimg_dir!="" && file_exists( XOOPS_ROOT_PATH."/modules/$qrimg_dir/qrcode_image.php" ) ){
		include_once XOOPS_ROOT_PATH . "/modules/$qrimg_dir/include/functions.php";
		$myts =& MyTextSanitizer::getInstance();
		$url = XOOPS_URL . "/modules/xmobile/";	//qr code strings
		if ( strtolower(_LANGCODE) == "ja" )
		{
			$url = qrcode_convert_encoding( $url , 'SJIS' , _CHARSET );
		}
		$url = rawurlencode( $url );
		$url = ereg_replace( "%20" , "+" , $url );
		$block['qrimg'] = "<img src='".XOOPS_URL."/modules/$qrimg_dir/qrcode_image.php?d=$url&amp;e=M&amp;s=3&amp;v=0&amp;t=P&amp;rgb=000000' />\n";
	} elseif ( $qr_num > 0 ) {
		require_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
		$qrimg_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH . '/modules/xmobile/images/qr/' );
		$images = array();
		$i = 1;
		foreach( $qrimg_array as $v ) {
			$images[ $i++ ] = $v;
		}
		$block['qrimg'] = "<img src='". XOOPS_URL . "/modules/xmobile/images/qr/" . htmlspecialchars( $images[ $qr_num ] ) ."' />\n";
	}

	$block['msg'] = _BLOCK_XMOBILE_QR_MSG;

	return $block ;
}


function b_xmobile_qr_edit( $options )
{
	$qrimage = empty( $options[0] ) ? 0 : intval( $options[0] ) ;
	$qr_mod_dir = empty( $options[1] ) ? "" : htmlspecialchars( $options[1] ) ;

	require_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
	$qrimg_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH . '/modules/xmobile/images/qr/' );

	$i = 0;
	$qr  = "<select name='options[0]'>";
	$qr .= "<option value='". $i ."' ".($qrimage==$i?"selected='selected'":"").">---</option>";
	foreach( $qrimg_array as $v ) {
		$qr .= "<option value='". ++$i ."' ".($qrimage==$i?"selected='selected'":"").">".htmlspecialchars( $v )."</option>";
	}
	$qr .= "</select>";

	$form = _BLOCK_XMOBILE_QR_CODE . "&nbsp;" . $qr . "&nbsp;" . _BLOCK_XMOBILE_QR_CODE_DESC ."<br />\n" .
			_BLOCK_XMOBILE_QR_MOD_DIR . "<input type='text' name='options[1]' value='". $qr_mod_dir ."'>";

	return $form ;
}
?>