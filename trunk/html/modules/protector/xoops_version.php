<?php
// $Id: xoops_version.php,v 1.13 2003/04/01 22:51:21 mvandam Exp $
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
$modversion['name'] = _MI_PROTECTOR_NAME;
$modversion['version'] = '2.51';
$modversion['description'] = _MI_PROTECTOR_DESC;
$modversion['credits'] = "PEAK Corp.";
$modversion['author'] = "GIJ=CHECKMATE<br />PEAK Corp.(http://www.peak.ne.jp/)" ;
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/protector_slogo.gif";
$modversion['dirname'] = "protector";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "protector_log";
$modversion['tables'][1] = "protector_access";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Templates

// Blocks
$modversion['blocks'] = array() ;

// Menu
$modversion['hasMain'] = 0;

// Config
$modversion['config'][] = array(
	'name'			=> 'global_disabled' ,
	'title'			=> '_MI_PROTECTOR_GLOBAL_DISBL' ,
	'description'	=> '_MI_PROTECTOR_GLOBAL_DISBLDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "0" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'reliable_ips' ,
	'title'			=> '_MI_PROTECTOR_RELIABLE_IPS' ,
	'description'	=> '_MI_PROTECTOR_RELIABLE_IPSDSC' ,
	'formtype'		=> 'textarea' ,
	'valuetype'		=> 'array' ,
	'default'		=> "^192.168.|127.0.0.1" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'log_level' ,
	'title'			=> '_MI_PROTECTOR_LOG_LEVEL' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=>  255 ,
	'options'		=> array( '_MI_PROTECTOR_LOGLEVEL0' => 0 , '_MI_PROTECTOR_LOGLEVEL15' => 15 , '_MI_PROTECTOR_LOGLEVEL63' => 63 , '_MI_PROTECTOR_LOGLEVEL255' => 255 )
) ;
$modversion['config'][] = array(
	'name'			=> 'session_fixed_topbit' ,
	'title'			=> '_MI_PROTECTOR_HIJACK_TOPBIT' ,
	'description'	=> '_MI_PROTECTOR_HIJACK_TOPBITDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'int' ,
	'default'		=> 32 ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'groups_denyipmove' ,
	'title'			=> '_MI_PROTECTOR_HIJACK_DENYGP' ,
	'description'	=> '_MI_PROTECTOR_HIJACK_DENYGPDSC' ,
	'formtype'		=> 'group_multi' ,
	'valuetype'		=> 'array' ,
	'default'		=> array(1) ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'san_nullbyte' ,
	'title'			=> '_MI_PROTECTOR_SAN_NULLBYTE' ,
	'description'	=> '_MI_PROTECTOR_SAN_NULLBYTEDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "1" ,
	'options'		=> array()
) ;
/* $modversion['config'][] = array(
	'name'			=> 'die_nullbyte' ,
	'title'			=> '_MI_PROTECTOR_DIE_NULLBYTE' ,
	'description'	=> '_MI_PROTECTOR_DIE_NULLBYTEDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "1" ,
	'options'		=> array()
) ; */
$modversion['config'][] = array(
	'name'			=> 'die_badext' ,
	'title'			=> '_MI_PROTECTOR_DIE_BADEXT' ,
	'description'	=> '_MI_PROTECTOR_DIE_BADEXTDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "1" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'contami_action' ,
	'title'			=> '_MI_PROTECTOR_CONTAMI_ACTION' ,
	'description'	=> '_MI_PROTECTOR_CONTAMI_ACTIONDS' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> 3 ,
	'options'		=> array( '_MI_PROTECTOR_OPT_NONE' => 0 , '_MI_PROTECTOR_OPT_EXIT' => 3 , '_MI_PROTECTOR_OPT_BIP' => 7 )
) ;
$modversion['config'][] = array(
	'name'			=> 'isocom_action' ,
	'title'			=> '_MI_PROTECTOR_ISOCOM_ACTION' ,
	'description'	=> '_MI_PROTECTOR_ISOCOM_ACTIONDSC' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> 0 ,
	'options'		=> array( '_MI_PROTECTOR_OPT_NONE' => 0 , '_MI_PROTECTOR_OPT_SAN' => 1 , '_MI_PROTECTOR_OPT_EXIT' => 3 , '_MI_PROTECTOR_OPT_BIP' => 7 )
) ;
$modversion['config'][] = array(
	'name'			=> 'union_action' ,
	'title'			=> '_MI_PROTECTOR_UNION_ACTION' ,
	'description'	=> '_MI_PROTECTOR_UNION_ACTIONDSC' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> 0 ,
	'options'		=> array( '_MI_PROTECTOR_OPT_NONE' => 0 , '_MI_PROTECTOR_OPT_SAN' => 1 , '_MI_PROTECTOR_OPT_EXIT' => 3 , '_MI_PROTECTOR_OPT_BIP' => 7 )
) ;
$modversion['config'][] = array(
	'name'			=> 'id_forceintval' ,
	'title'			=> '_MI_PROTECTOR_ID_INTVAL' ,
	'description'	=> '_MI_PROTECTOR_ID_INTVALDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "0" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'file_dotdot' ,
	'title'			=> '_MI_PROTECTOR_FILE_DOTDOT' ,
	'description'	=> '_MI_PROTECTOR_FILE_DOTDOTDSC' ,
	'formtype'		=> 'yesno' ,
	'valuetype'		=> 'int' ,
	'default'		=> "1" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'bf_count' ,
	'title'			=> '_MI_PROTECTOR_BF_COUNT' ,
	'description'	=> '_MI_PROTECTOR_BF_COUNTDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'int' ,
	'default'		=> "10" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_skipmodules' ,
	'title'			=> '_MI_PROTECTOR_DOS_SKIPMODS' ,
	'description'	=> '_MI_PROTECTOR_DOS_SKIPMODSDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'text' ,
	'default'		=> "" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_expire' ,
	'title'			=> '_MI_PROTECTOR_DOS_EXPIRE' ,
	'description'	=> '_MI_PROTECTOR_DOS_EXPIREDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'int' ,
	'default'		=> "60" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_f5count' ,
	'title'			=> '_MI_PROTECTOR_DOS_F5COUNT' ,
	'description'	=> '_MI_PROTECTOR_DOS_F5COUNTDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'int' ,
	'default'		=> "10" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_f5action' ,
	'title'			=> '_MI_PROTECTOR_DOS_F5ACTION' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> "exit" ,
	'options'		=> array( '_MI_PROTECTOR_DOSOPT_NONE' => 'none' , '_MI_PROTECTOR_DOSOPT_SLEEP' => 'sleep' , '_MI_PROTECTOR_DOSOPT_EXIT' => 'exit' , '_MI_PROTECTOR_DOSOPT_BIP' => 'bip' , '_MI_PROTECTOR_DOSOPT_HTA' => 'hta' )
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_crcount' ,
	'title'			=> '_MI_PROTECTOR_DOS_CRCOUNT' ,
	'description'	=> '_MI_PROTECTOR_DOS_CRCOUNTDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'int' ,
	'default'		=> "30" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_craction' ,
	'title'			=> '_MI_PROTECTOR_DOS_CRACTION' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> "exit" ,
	'options'		=> array( '_MI_PROTECTOR_DOSOPT_NONE' => 'none' , '_MI_PROTECTOR_DOSOPT_SLEEP' => 'sleep' , '_MI_PROTECTOR_DOSOPT_EXIT' => 'exit' , '_MI_PROTECTOR_DOSOPT_BIP' => 'bip' , '_MI_PROTECTOR_DOSOPT_HTA' => 'hta' )
) ;
$modversion['config'][] = array(
	'name'			=> 'dos_crsafe' ,
	'title'			=> '_MI_PROTECTOR_DOS_CRSAFE' ,
	'description'	=> '_MI_PROTECTOR_DOS_CRSAFEDSC' ,
	'formtype'		=> 'text' ,
	'valuetype'		=> 'text' ,
	'default'		=> "/(msnbot|Googlebot|Yahoo! Slurp)/i" ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'bip_except' ,
	'title'			=> '_MI_PROTECTOR_BIP_EXCEPT' ,
	'description'	=> '_MI_PROTECTOR_BIP_EXCEPTDSC' ,
	'formtype'		=> 'group_multi' ,
	'valuetype'		=> 'array' ,
	'default'		=> array(1) ,
	'options'		=> array()
) ;
$modversion['config'][] = array(
	'name'			=> 'disable_features' ,
	'title'			=> '_MI_PROTECTOR_DISABLES' ,
	'description'	=> '' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'int' ,
	'default'		=> 1 ,
	'options'		=> array('xmlrpc'=>1,'xmlrpc + 2.0.9.2 bugs'=>1025,'_NONE'=>0)
) ;
$modversion['config'][] = array(
	'name'			=> 'passwd_disabling_bip' ,
	'title'			=> '_MI_PROTECTOR_PASSWD_BIP' ,
	'description'	=> '_MI_PROTECTOR_PASSWD_BIPDSC' ,
	'formtype'		=> 'password' ,
	'valuetype'		=> 'text' ,
	'default'		=> '' ,
	'options'		=> array()
) ;


// Search
$modversion['hasSearch'] = 0;

// Comments
$modversion['hasComments'] = 0;

// Config Settings (only for modules that need config settings generated automatically)

// Notification

$modversion['hasNotification'] = 0;

// On Install (turn banip on)
 $modversion['onInstall'] = 'include/oninstall.inc.php' ;

// On Update
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	include dirname( __FILE__ ) . "/include/onupdate.inc.php" ;
}

?>