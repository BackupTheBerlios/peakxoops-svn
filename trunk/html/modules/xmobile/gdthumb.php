<?php
/*
◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆
GD自動サムネイル作成

Copyright 2002- Akihiro Asai. All rights reserved.

http://aki.adam.ne.jp
aki@mx3.adam.ne.jp

◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆

□ 機能概要
・指定されたイメージのサムネイルを表示します。
・出力する大きさを指定する事ができます。
・出力されるイメージのアスペクト比は維持されます。

□ 使用方法
指定は gdthumb.php?path=xxx/xxx.[ jpg | png | gif ]&mw=xx&mh=xx
※ passの部分には画像へのパスを指定
※ mwに表示画像の最大横幅、mhに表示画像の最大横幅を外部より指定可能。
※ 指定しなかった場合はデフォルトの設定値を採用。
★クラスとして使用する場合は、「クラスとして使用する場合には・・・」以降をコメントアウトして下さい。

□ 更新履歴
2002/08/19 最大縦幅の部分を一部手直し
2003/01/31 デフォルトでアスペクト比が固定
2003/04/11 最大横幅と最大縦幅を外部より指定可能
2003/04/25 GD2用に関数変更
2003/06/21 GD1/2をバージョンに応じて変更できるように修正
2003/06/25 imageCopyResampledの部分を修正
2004/01/28 スクリプト全体を書き直し。引数「pass」を「path」に変更。
2005/12/08 関数の自動判別 gif形式に対応 透過gif・透過pngに対応（GD2.0.1以降）
*/

// クラスとして使用する場合には、以下の6行をコメントアウト
//$objg = new gdthumb();
//list($Ck, $Msg) = $objg->Main($_GET["path"], $_GET["mw"], $_GET["mh"]);
//if(!$Ck) { // エラーの場合
//	header("Content-Type: text/html; charset=euc-jp");
//	print $Msg;
//}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['width']))
{
	$get_width = intval($_GET['width']);
	// 最大幅300pxに制限
	if($get_width < 300)
	{
		$width = $get_width;
	}
	else
	{
		$width = 300;
	}
}
else
{
	$width = 96; // 1以上の値
}
$height = 0; // 指定しない場合は0 指定する場合は1以上の値

include_once '../../mainfile.php';
$photo_path = $_GET['photo'];
$photo_path = XOOPS_ROOT_PATH.$photo_path;

if(!isset($photo_path))
{
	return array(0, "イメージのパスが設定されていません。");
	exit;
}

if(!file_exists($photo_path))
{
	return array(0, "指定されたパスにファイルが見つかりません。");
	exit;
}


$size = @GetimageSize($photo_path);
$re_size = $size;

//アスペクト比固定処理
$tmp_width = $size[0] / $width;

if($height != 0)
{
	$tmp_height = $size[1] / $height;
}

if($tmp_width > 1 || $tmp_height > 1)
{
	if($height == 0)
	{
		if($tmp_width > 1)
		{
			$re_size[0] = $width;
			$re_size[1] = $size[1] * $width / $size[0];
		}
	}
	else
	{
		if($tmp_width > $tmp_height)
		{
			$re_size[0] = $width;
			$re_size[1] = $size[1] * $width / $size[0];
		}
		else
		{
			$re_size[1] = $height;
			$re_size[0] = $size[0] * $height / $size[1];
		}
	}
}

$imagecreate = function_exists("imagecreatetruecolor") ? "imagecreatetruecolor" : "imagecreate";
$imageresize = function_exists("imagecopyresampled") ? "imagecopyresampled" : "imagecopyresized";


switch($size[2]):
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// gif形式
	case "1":

		// 画像のサイズが指定サイズ以下だった場合はそのまま出力
		if($tmp_width <= 1 && $tmp_height <= 1) {
			header("Content-type: image/gif");
			header("Cache-control: no-cache");
//			echo readfile($photo_path);
			return readfile($photo_path);
			break;
		}

		if(function_exists('ImageCreateFromGIF'))
		{

			$image = ImageCreateFromGIF($photo_path);

			$newimage = ImageCreateTrueColor($re_size[0],$re_size[1]);

			$white = imagecolorallocate($newimage, 255, 255, 255);
			imagefilledrectangle($newimage, 0, 0, $re_size[0], $re_size[1], $white);
			imagecolortransparent($newimage,$white);

			ImageCopyResized($newimage, $image, 0, 0, 0, 0, $re_size[0], $re_size[1], $size[0], $size[1]);

			imagedestroy($image);

			if(function_exists("imagegif"))
			{
				header("content-Type: image/gif");
				imagegif($newimage);
			}
			else
			{
				header("Content-type: image/jpeg");
				imagejpeg($newimage);
			}

			header("Cache-control: no-cache");

			imagedestroy($newimage);
		}

/*
		if(function_exists("imagecreatefromgif"))
		{
			$src_im = imagecreatefromgif($photo_path);
			$dst_im = $imagecreate($re_size[0], $re_size[1]);

			$transparent = imagecolortransparent($src_im);
			$colorstotal = imagecolorstotal ($src_im);

			if(function_exists("imagecreatetruecolor"))
			{
				$dst_im = imagecreatetruecolor($re_size[0], $re_size[1]);
				$tc = imagecolorsforindex($src_im, $transparent);
				imagefill ($dst_im, 0, 0, imagecolorallocate ($dst_im, $tc["red"], $tc["green"], $tc["blue"]));
				imagetruecolortopalette ($dst_im, false, $colorstotal);
				imagecolortransparent ($dst_im, imagecolorclosest ($dst_im, $tc["red"], $tc["green"], $tc["blue"]));
				imagecopyresampled ($dst_im, $src_im, 0, 0, 0, 0, $re_size[0], $re_size[1], $size[0], $size[1]);
			}
			else
			{
				$dst_im = imagecreate($re_size[0], $re_size[1]);
				if (0 <= $transparent && $transparent < $colorstotal)
				{
					imagepalettecopy ($dst_im, $src_im);
					imagefill ($dst_im, 0, 0, $transparent);
					imagecolortransparent ($dst_im, $transparent);
				}
				imageresize($dst_im, $src_im, 0, 0, 0, 0, $re_size[0], $re_size[1], $size[0], $size[1]);
			}

			if(function_exists("imagegif"))
			{
				header("content-Type: image/gif");
				imagegif($dst_im);
				imagedestroy($src_im);
				imagedestroy($dst_im);
			}
			else
			{
				header("content-Type: image/png");
				imagepng($dst_im);
				imagedestroy($src_im);
				imagedestroy($dst_im);
			}
		}
		else
		{
			// サムネイル作成不可の場合（旧バージョン対策）
			$dst_im = imageCreate($re_size[0], $re_size[1]);
			imageColorAllocate($dst_im, 255, 255, 214); //背景色

			// 枠線と文字色の設定
			$black = imageColorAllocate($dst_im, 0, 0, 0);
			$red = imageColorAllocate($dst_im, 255, 0, 0);

			imagestring($dst_im, 5, 10, 10, "GIF $size[0]x$size[1]", $red);
			imageRectangle ($dst_im, 0, 0, ($re_size[0]-1), ($re_size[1]-1), $black);
			header("content-Type: image/png");
			imagepng($dst_im);
			imagedestroy($src_im);
			imagedestroy($dst_im);
		}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// jpg形式
	case "2":

		$src_im = imageCreateFromJpeg($photo_path);
		$dst_im = $imagecreate($re_size[0], $re_size[1]);
		$imageresize( $dst_im, $src_im, 0, 0, 0, 0, $re_size[0], $re_size[1], $size[0], $size[1]);

		header("content-Type: image/jpeg");
		header("cache-control: no-cache");
		imageJpeg($dst_im);
		imagedestroy($src_im);
		imagedestroy($dst_im);

		break;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// png形式
	case "3":

		$src_im = imagecreatefrompng($photo_path);

		$colortransparent = imagecolortransparent($src_im);
		if ($colortransparent > -1) {
			$dst_im = $imagecreate($re_size[0], $re_size[1]);
			imagepalettecopy($dst_im, $src_im);
			imagefill($dst_im, 0, 0, $colortransparent);
			imagecolortransparent($dst_im, $colortransparent);
			$imageresize($dst_im,$src_im, 0, 0, 0, 0, $re_size[0], $re_size[1], $size[0], $size[1]);
		} else {
			$dst_im = $imagecreate($re_size[0], $re_size[1]);
			$imageresize($dst_im,$src_im, 0, 0, 0, 0, $re_size[0], $re_size[1], $size[0], $size[1]);
			imagetruecolortopalette($dst_im, false, imagecolorstotal($src_im));
		}

		header("content-Type: image/png");
		header("cache-control: no-cache");
		imagepng($dst_im);
		imagedestroy($src_im);
		imagedestroy($dst_im);

		break;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	default:
		return array(0, "イメージの形式が不明です。");
		exit;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
endswitch;


//return array(1,"");

?>