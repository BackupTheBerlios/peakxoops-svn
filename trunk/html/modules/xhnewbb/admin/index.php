<?php
// $Id: index.php,v 1.1.1.1 2003/11/26 05:17:41 ryuji_amano Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
include '../../../include/cp_header.php';
include_once dirname(dirname(__FILE__)).'/include/functions.php' ;
include dirname(dirname(__FILE__)).'/include/config.php' ;

// branch for altsys
if( defined( 'XOOPS_TRUST_PATH' ) && ! empty( $_GET['lib'] ) ) {
	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
	$mydirpath = dirname( dirname( __FILE__ ) ) ;

	// common libs (eg. altsys)
	$lib = preg_replace( '[^a-zA-Z0-9_-]' , '' , $_GET['lib'] ) ;
	$page = preg_replace( '[^a-zA-Z0-9_-]' , '' , @$_GET['page'] ) ;
	
	if( file_exists( XOOPS_TRUST_PATH.'/libs/'.$lib.'/'.$page.'.php' ) ) {
		include XOOPS_TRUST_PATH.'/libs/'.$lib.'/'.$page.'.php' ;
	} else if( file_exists( XOOPS_TRUST_PATH.'/libs/'.$lib.'/index.php' ) ) {
		include XOOPS_TRUST_PATH.'/libs/'.$lib.'/index.php' ;
	} else {
		die( 'wrong request' ) ;
	}
	exit ;
}

xoops_cp_header();
if( file_exists( './mymenu.php' ) ) include( './mymenu.php' ) ;
echo"<table width='100%' border='0' cellspacing='1' class='outer'>"
."<tr><td class=\"odd\">";
echo "<a href='./index.php'><h4>"._MD_XHNEWBB_A_FORUMCONF."</h4></a>";
if(isset($mode)) {

}
else {
?>
<table border="0" cellpadding="4" cellspacing="1" width="100%">

<tr class='bg1' align="left">
	<td><span class='fg2'><a href="<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=addforum"><?php echo _MD_XHNEWBB_A_ADDAFORUM;?></a></span></td>
	<td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2ADDFORUM;?></span></td>
</tr>
<tr class='bg1' align="left">
	<td><span class='fg2'><a href='<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=editforum'><?php echo _MD_XHNEWBB_A_EDITAFORUM;?></a></span></td>
	<td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2EDITFORUM;?></span></td>
</tr>
<tr class='bg1' align='left'>
	<td><span class='fg2'><a href="<?php echo $bbUrl['admin']?>/admin_priv_forums.php?mode=editforum"><?php echo _MD_XHNEWBB_A_SETPRIVFORUM;?></a></span></td>
	<td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2SETPRIV;?></span></td>
</tr>
<tr class='bg1' align='left'>
	<td><span class='fg2'><a href="<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=sync"><?php echo _MD_XHNEWBB_A_SYNCFORUM;?></a></span></td>
	<td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2SYNC;?></span></td>
</tr>
<tr class='bg1' align='left'>
	<td><span class='fg2'><a href="<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=addcat"><?php echo _MD_XHNEWBB_A_ADDACAT;?></a></span></td>
	<td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2ADDCAT;?></span></td>
</tr>
<tr class='bg1' align='left'>
	<td><span class='fg2'><a href="<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=editcat"><?php echo _MD_XHNEWBB_A_EDITCATTTL;?></a></span></td>
	<td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2EDITCAT;?></span></td>
</tr>
<tr class='bg1' align='left'>
     <td><span class='fg2'><a href="<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=remcat"><?php echo _MD_XHNEWBB_A_RMVACAT;?></a></span></td>
     <td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2RMVCAT;?></span></td>
</tr>
<tr class='bg1' align='left'>
     <td><span class='fg2'><a href="<?php echo $bbUrl['admin'];?>/admin_forums.php?mode=catorder"><?php echo _MD_XHNEWBB_A_REORDERCAT;?></a></span></td>
     <td><span class='fg2'><?php echo _MD_XHNEWBB_A_LINK2ORDERCAT;?></span></td>
</tr>

</table>
<?php
}

echo"</td></tr></table>";
xoops_cp_footer();
?>