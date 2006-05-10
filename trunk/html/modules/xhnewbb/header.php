<?php
// $Id: header.php,v 1.1.1.1 2003/11/26 05:17:31 ryuji_amano Exp $
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

include '../../mainfile.php';
include XOOPS_ROOT_PATH.'/modules/xhnewbb/functions.php';
include XOOPS_ROOT_PATH.'/modules/xhnewbb/config.php';

$topic_id = isset($_GET['topic_id']) ? intval($_GET['topic_id']) : 0;
if( $topic_id > 0 ) {
	$forum_result = $xoopsDB->query( "SELECT forum_id FROM ".$xoopsDB->prefix("xhnewbb_topics")." WHERE topic_id = $topic_id" ) ;
	list( $forum ) = $xoopsDB->fetchRow( $forum_result ) ;
	$forum = intval( $forum ) ;
	$_GET['forum'] = $forum ;
}

$viewmode = in_array( @$_GET['viewmode'] , array( 'flat' , 'thread' ) ) ? $_GET['viewmode'] : '' ;
$order = in_array( @$_GET['order'] , array( 'ASC' , 'DESC' ) ) ? $_GET['order'] : '' ;



?>