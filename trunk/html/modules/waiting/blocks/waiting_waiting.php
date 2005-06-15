<?php
// $Id: waiting_waiting.php,v 1.8 2005/04/20 03:43:55 gij Exp $
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
// プラグインで拡張可能な承認待ちブロック
// 各プラグイン内でモジュールのインストール状況も確認する。

function b_waiting_waiting_show($options)
{
    global $xoopsUser, $xoopsConfig;

    $userlang = $xoopsConfig['language'] ;

    // プラグイン用言語ファイルの読込
    $lang_dir = XOOPS_ROOT_PATH . "/modules/waiting/language";
    if( file_exists( "$lang_dir/$userlang/plugins.php" ) ) {
        include_once( "$lang_dir/$userlang/plugins.php" ) ;
    } else if( file_exists( "$lang_dir/english/plugins.php" ) ) {
        include_once( "$lang_dir/english/plugins.php" ) ;
    }

    $plugins_path = XOOPS_ROOT_PATH . "/modules/waiting/plugins";
    $xoopsDB =& Database::getInstance();
    $module_handler =& xoops_gethandler('module');
    $block = array();

    //インストールされているモジュールリストを得る。
    $mod_lists = $module_handler->getList(new Criteria(1,1),true);
    //print_r($mod_lists);
    foreach ($mod_lists as $mod => $name){
        //モジュールのプラグインがあれば、requireして、承認待ち情報を得る。
        // モジュール側にプラグインが用意されているかチェック
        //  plugin modules/DIRNAME/include/waiting.plugin.php
        //  lang   modules/DIRNAME/language/LANG/waiting.php
        $plugin_flag = false;
        $mod_plugin_file = XOOPS_ROOT_PATH."/modules/$mod/include/waiting.plugin.php";
        if(file_exists($mod_plugin_file)){
            // 対象モジュール内プラグイン
            // waiting用言語ファイルが対象モジュール内にあれば読み込む
            $mod_plugin_lng = XOOPS_ROOT_PATH."/modules/$mod/language/$userlang/waiting.php";
            if(file_exists($mod_plugin_lng)){
                include_once($mod_plugin_lng);
            }else{
                $mod_plugin_lng = XOOPS_ROOT_PATH."/modules/".$mod."/language/english/waiting.php";
                if(file_exists($mod_plugin_lng)){
                    include_once($mod_plugin_lng);
                }
            }
            // 対象モジュール内プラグインを読み込む
            require_once($mod_plugin_file);
            $plugin_flag = true;
        }else{
            // search from waiting if there are no plugin in the module
            $plugin_file = "$plugins_path/{$mod}.php";
            // no language files will be read
            // waiting内プラグインを読み込む
            if (file_exists($plugin_file)){
                include_once($plugin_file);
                $plugin_flag = true;
            }
        }

        // call the plugin
        if($plugin_flag){
            if (function_exists("b_waiting_" . $mod)){
                // get the list of waitings
                $_tmp = call_user_func("b_waiting_" . $mod);
                if(isset($_tmp["lang_linkname"])){
                    if( @$_tmp["pendingnum"] > 0 || $options[0] > 0){
                        $block["modules"][$mod]["pending"][] = $_tmp;
                    }
                    unset($_tmp);
                }else{
                    // lang_linknameが無ければ、複数返してる
                    foreach($_tmp as $_one){
                        if( @$_one["pendingnum"] > 0 || $options[0] > 0){
                            $block["modules"][$mod]["pending"][] = $_one;
                        }
                    }
                }
            }

            // for older compatibilities
            // Hacked by GIJOE （行き当たりバッタリのHackですみません）
            $i = 0 ;
            while( 1 ) {
                $function_name = "b_waiting_{$mod}_$i" ;
                if (function_exists( $function_name )){
                    $_tmp = call_user_func( $function_name ) ;
                    ++ $i ;
                    if($_tmp["pendingnum"] > 0 || $options[0] > 0){
                        $block["modules"][$mod]["pending"][] = $_tmp;
                    }
                    unset($_tmp);
                } else break ;
            }
            // End of Hack
            // if(count($block["modules"][$mod]) > 0){
            if ( ! empty( $block["modules"][$mod] ) ) {
                $block["modules"][$mod]["name"] = $name;
            }
        }
        //echo $mod."|".$name;
        //プラグインを読み込む
//         if (file_exists($mod_plugin_file)){
//             require_once($mod_plugin_file);
//         }
    }
    //print_r($block);
    return $block;
}

function b_waiting_waiting_edit($options){

	$mod_url = XOOPS_URL."/modules/waiting" ;

    $form = _MB_WAITING_NOWAITING_DISPLAY."&nbsp;<input type='radio' name='options[0]' value='1'";
    if ( $options[0] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."<input type='radio' name='options[0]' value='0'";
    if ( $options[0] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .=" />&nbsp;"._NO;
    $form .="<br />\n<br />\n<a href='$mod_url/admin/index.php'><img src='$mod_url/images/folder16.gif' />"._MB_WAITING_LINKTOPLUGINCHECK."</a>" ;

    return $form;
}

?>