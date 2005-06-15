<?php
// $Id: index.php,v 1.2 2005/04/06 09:49:05 gij Exp $
// FILE		::	index.php
// AUTHOR	::	Ryuji AMANO <info@ryus.biz>
// WEB		::	Ryu's Planning <http://ryus.biz/>
//

require_once "../../../include/cp_header.php";
xoops_cp_header();
$plugins_path = XOOPS_ROOT_PATH . "/modules/waiting/plugins";
$module_handler =& xoops_gethandler('module');
$block = array();

//���󥹥ȡ��뤵��Ƥ���⥸�塼��ꥹ�Ȥ����롣
$mod_lists = $module_handler->getList(new Criteria(1,1),true);
echo "<h4>"._AM_WAITING_PLUGINLIST."</h4>";
echo "<table class='outer'>";
//echo "<th colspan='2'>"._AM_WAITING_PLUGINLIST."</th>";
echo "<th>"._AM_WAITING_MODNAME."</th><th>"._AM_WAITING_STATUS."</th>";
$style="odd";
foreach ($mod_lists as $mod => $name){
    // �⥸�塼��¦�˥ץ饰�����Ѱդ���Ƥ��뤫�����å�
    //  plugin modules/DIRNAME/include/waiting.plugin.php
    //  lang   modules/DIRNAME/language/LANG/waiting.php
    $plugin_flag = "&nbsp;";
    $mod_plugin_file = XOOPS_ROOT_PATH."/modules/".$mod."/include/waiting.plugin.php";
    if(file_exists($mod_plugin_file)){
        $plugin_flag = "module";
    }else{
        // �⥸�塼��¦�ˤʤ���С�waiting���õ����
        $plugin_file = "$plugins_path/{$mod}.php";
        if (file_exists($plugin_file)){
            $plugin_flag = "waiting";
        }
    }
    printf("<tr class='%s'><td>%s</td><td>%s</td></tr>", $style, $name, $plugin_flag);
    $style = ($style == "odd") ? "even" : "odd";
}
echo "</table>";
echo _AM_WAITING_PLUGINLIST_DESC;

xoops_cp_footer();
?>