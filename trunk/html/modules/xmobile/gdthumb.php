<?php
/*
����������������������������������������������������
GD��ư����ͥ������

Copyright 2002- Akihiro Asai. All rights reserved.

http://aki.adam.ne.jp
aki@mx3.adam.ne.jp

����������������������������������������������������

�� ��ǽ����
�����ꤵ�줿���᡼���Υ���ͥ����ɽ�����ޤ���
�����Ϥ����礭������ꤹ������Ǥ��ޤ���
�����Ϥ���륤�᡼���Υ����ڥ�����ϰݻ�����ޤ���

�� ������ˡ
����� gdthumb.php?path=xxx/xxx.[ jpg | png | gif ]&mw=xx&mh=xx
�� pass����ʬ�ˤϲ����ؤΥѥ������
�� mw��ɽ�������κ��粣����mh��ɽ�������κ��粣�������������ǽ��
�� ���ꤷ�ʤ��ä����ϥǥե���Ȥ������ͤ���ѡ�
�����饹�Ȥ��ƻ��Ѥ�����ϡ��֥��饹�Ȥ��ƻ��Ѥ�����ˤϡ������װʹߤ򥳥��ȥ����Ȥ��Ʋ�������

�� ��������
2002/08/19 �����������ʬ�������ľ��
2003/01/31 �ǥե���Ȥǥ����ڥ����椬����
2003/04/11 ���粣���Ⱥ�����������������ǽ
2003/04/25 GD2�Ѥ˴ؿ��ѹ�
2003/06/21 GD1/2��С������˱������ѹ��Ǥ���褦�˽���
2003/06/25 imageCopyResampled����ʬ����
2004/01/28 ������ץ����Τ��ľ����������pass�פ��path�פ��ѹ���
2005/12/08 �ؿ��μ�ưȽ�� gif�������б� Ʃ��gif��Ʃ��png���б���GD2.0.1�ʹߡ�
*/

// ���饹�Ȥ��ƻ��Ѥ�����ˤϡ��ʲ���6�Ԥ򥳥��ȥ�����
//$objg = new gdthumb();
//list($Ck, $Msg) = $objg->Main($_GET["path"], $_GET["mw"], $_GET["mh"]);
//if(!$Ck) { // ���顼�ξ��
//	header("Content-Type: text/html; charset=euc-jp");
//	print $Msg;
//}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['width']))
{
	$get_width = intval($_GET['width']);
	// ������300px������
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
	$width = 96; // 1�ʾ����
}
$height = 0; // ���ꤷ�ʤ�����0 ���ꤹ�����1�ʾ����

include_once '../../mainfile.php';
$photo_path = $_GET['photo'];
$photo_path = XOOPS_ROOT_PATH.$photo_path;

if(!isset($photo_path))
{
	return array(0, "���᡼���Υѥ������ꤵ��Ƥ��ޤ���");
	exit;
}

if(!file_exists($photo_path))
{
	return array(0, "���ꤵ�줿�ѥ��˥ե����뤬���Ĥ���ޤ���");
	exit;
}


$size = @GetimageSize($photo_path);
$re_size = $size;

//�����ڥ�����������
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
// gif����
	case "1":

		// �����Υ����������ꥵ�����ʲ����ä����Ϥ��Τޤ޽���
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
			// ����ͥ�������ԲĤξ��ʵ�С�������к���
			$dst_im = imageCreate($re_size[0], $re_size[1]);
			imageColorAllocate($dst_im, 255, 255, 214); //�طʿ�

			// ������ʸ����������
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
	// jpg����
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
	// png����
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
		return array(0, "���᡼���η����������Ǥ���");
		exit;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
endswitch;


//return array(1,"");

?>