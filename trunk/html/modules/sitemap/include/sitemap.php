<?php
include_once(XOOPS_ROOT_PATH . '/class/xoopstree.php');

// ����
function sitemap_show()
{
	global $xoopsUser, $xoopsConfig, $sitemap_configs ;
	$plugin_dir = XOOPS_ROOT_PATH . "/modules/sitemap/plugins/";

	// invisible weights
	$invisible_weights = array() ;
	if( trim( @$sitemap_configs['invisible_weights'] ) !== '' ) {
		$invisible_weights = explode( ',' , $sitemap_configs['invisible_weights'] ) ;
	}

	// invisible dirnames
	$invisible_dirnames = empty( $sitemap_configs['invisible_dirnames'] ) ? '' : str_replace( ' ' , '' , $sitemap_configs['invisible_dirnames'] ) . ',' ;

	$block = array();

	@$block['lang_home'] = _MB_SYSTEM_HOME;
	@$block['lang_close'] = _CLOSE;
	$module_handler =& xoops_gethandler('module');
	$criteria = new CriteriaCompo(new Criteria('hasmain', 1));
	$criteria->add(new Criteria('isactive', 1));
	$modules =& $module_handler->getObjects($criteria, true);
	$moduleperm_handler =& xoops_gethandler('groupperm');
	$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
	$read_allowed = $moduleperm_handler->getItemIds('module_read', $groups);
	foreach (array_keys($modules) as $i) {
		if (in_array($i, $read_allowed) && ! in_array($modules[$i]->getVar('weight'),$invisible_weights) && ! stristr( $invisible_dirnames , $modules[$i]->getVar('dirname').',' ) ) {
			if ($modules[$i]->getVar('dirname') == 'sitemap') {
				continue;
			}
			$block['modules'][$i]['id'] = $i;
			$block['modules'][$i]['name'] = $modules[$i]->getVar('name');
			$block['modules'][$i]['directory'] = $modules[$i]->getVar('dirname');
			$old_error_reporting = error_reporting() ;
			error_reporting( $old_error_reporting & (~E_NOTICE) ) ;
			$sublinks =& $modules[$i]->subLink();
			error_reporting( $old_error_reporting ) ;
			if (count($sublinks) > 0) {
				foreach($sublinks as $sublink){
					$block['modules'][$i]['sublinks'][] = array('name' => $sublink['name'], 'url' => XOOPS_URL.'/modules/'.$modules[$i]->getVar('dirname').'/'.$sublink['url']);
				}
			} else {
				$block['modules'][$i]['sublinks'] = array();
			}
            /// ���ä���ץ饰������� by Ryuji
            //�⥸�塼��Υץ饰���󤬤���С�require���ơ���������롣
            // �⥸�塼��¦�˥ץ饰�����Ѱդ���Ƥ��뤫�����å�
            //  plugin modules/DIRNAME/include/sitemap.plugin.php
            //  lang   modules/DIRNAME/language/LANG/sitemap.php
            $mod = $modules[$i]->getVar("dirname");
            $plugin_flag = false;
            $mod_plugin_file = XOOPS_ROOT_PATH."/modules/".$mod."/include/sitemap.plugin.php";
            if(file_exists($mod_plugin_file)){
                $mod_plugin_lng = XOOPS_ROOT_PATH."/modules/".$mod."/language/".$xoopsConfig['language']."/sitemap.php";
                if(file_exists($mod_plugin_lng)){
                    include_once($mod_plugin_lng);
                }else{
                    $mod_plugin_lng = XOOPS_ROOT_PATH."/modules/".$mod."/language/english/sitemap.php";
                    if(file_exists($mod_plugin_lng)){
                        include_once($mod_plugin_lng);
                    }
                }
                require_once($mod_plugin_file);
                $plugin_flag = true;
            }else{
                // �⥸�塼��¦�ˤʤ���С�sitemap���õ����
                $mod_plugin_dir = $plugin_dir ;
                $mod_plugin_file = $mod_plugin_dir . $mod . ".php";
                $mod_plugin_lng = $mod_plugin_dir . $xoopsConfig['language'] . ".lng.php";
                //����ե�������ɤ߹���
                if (file_exists($mod_plugin_lng)){
                    include_once($mod_plugin_lng);
                }else{
                    $mod_plugin_lng = $mod_plugin_dir . "english" . ".lng.php";
                    if (file_exists($mod_plugin_lng)){
                        include_once($mod_plugin_lng);
                    }
                }
                //�ץ饰������ɤ߹���
                if (file_exists($mod_plugin_file)){
                    require_once($mod_plugin_file);
                    $plugin_flag = true;
                }
            }
    
            // �ץ饰�����call
            if($plugin_flag){
                if (function_exists("b_sitemap_" . $mod)){
                    //���ƥ���ꥹ�Ȥ����롣
                    $_tmp = call_user_func("b_sitemap_" . $mod);
                    //$block['modules'][$i]['path'] = $_tmp["path"];
                    if (isset($_tmp["parent"])) {
                        $block['modules'][$i]['parent'] = $_tmp["parent"];
                    }
                }
            }
        }
    }
	return $block;
}

// mylinks��news�ʤɤ褯����ѥ�����Υ��ƥ���ꥹ�Ȥ����뤿���function
function sitemap_get_categoires_map($table, $id_name, $pid_name, $title_name, $url, $order = ""){
    global $sitemap_configs;
    $mytree = new XoopsTree($table, $id_name, $pid_name);
    $xoopsDB =& Database::getInstance();
    
    $sitemap = array();
	$myts =& MyTextSanitizer::getInstance();

	$i = 0;
	$sql = "SELECT `$id_name`,`$title_name` FROM `$table` WHERE `$pid_name`=0" ;
	if ($order != '')
	{
		$sql .= " ORDER BY `$order`" ;
	}
	$result = $xoopsDB->query($sql);
	while (list($catid, $name) = $xoopsDB->fetchRow($result))
	{
		// �Ƥν���
		$sitemap['parent'][$i]['id'] = $catid;
		$sitemap['parent'][$i]['title'] = $myts->makeTboxData4Show( $name ) ;
		$sitemap['parent'][$i]['url'] = $url.$catid;

		// �Ҥν���
        if(@$sitemap_configs["show_subcategoris"]){ // ���֥���ɽ���ΤȤ��Τ߼¹� by Ryuji
    		$j = 0;
    		$child_ary = $mytree->getChildTreeArray($catid, $order);
    		foreach ($child_ary as $child)
    		{
    			$count = strlen($child['prefix']) + 1; // MEMO prefix��Ĺ���ǥ��֥��Ƥο�����Ƚ�ꤷ�Ƥ�
    			$sitemap['parent'][$i]['child'][$j]['id'] = $child[$id_name];
    			$sitemap['parent'][$i]['child'][$j]['title'] = $myts->makeTboxData4Show( $child[$title_name] ) ;
    			$sitemap['parent'][$i]['child'][$j]['image'] = (($count > 3) ? 4 : $count);
    			$sitemap['parent'][$i]['child'][$j]['url'] = $url.$child[$id_name];
    
    			$j++;
    		}
        }
        $i++;
	}
    return $sitemap;
}

?>