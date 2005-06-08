<?php
// $Id: sitemap.plugin.php,v 1.1 2005/01/15 21:01:11 gij Exp $
// FILE		::	xhnewbb.php
// AUTHOR	::	Ryuji AMANO <info@ryus.biz>
// WEB		::	Ryu's Planning <http://ryus.biz/>
//

function b_sitemap_xhnewbb(){
    global $xoopsModuleConfig;
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::getInstance();
    $sitemap = array();
    
    if($xoopsModuleConfig["show_subcategoris"]){ // サブカテ表示のときのみ実行 by Ryuji
        // カテゴリを得る
        $sql = 'SELECT DISTINCT c.* FROM '.$db->prefix('xhnewbb_categories').' c, '.$db->prefix("xhnewbb_forums").' f WHERE f.cat_id=c.cat_id GROUP BY c.cat_id, c.cat_title, c.cat_order ORDER BY c.cat_order';
        $result = $db->query($sql);
        $categories = array();
        while ( $cat_row = $db->fetchArray($result) ) {
            $i = $cat_row["cat_id"];
            $sitemap['parent'][$i]['id'] = $cat_row["cat_id"];
            $sitemap['parent'][$i]['title'] = $myts->makeTboxData4Show($cat_row["cat_title"]);
            $sitemap['parent'][$i]['url'] = "index.php?cat=".$cat_row["cat_id"];
            $categories[] = $cat_row["cat_id"];
        }
    }

    // フォーラム情報取得
    $sql = "SELECT f.* FROM ".$db->prefix("xhnewbb_forums")." f LEFT JOIN ".$db->prefix("xhnewbb_categories")." c ON f.cat_id=c.cat_id ORDER BY f.forum_id";
    $result = $db->query($sql);
    //$forums = array();
    $i=0;
    while($forum_row = $db->fetchArray($result)){
        //if(in_array($forum_row["cat_id"], $categories)){
            if($xoopsModuleConfig["show_subcategoris"]){ // サブカテ表示のときのみ実行 by Ryuji
                $j = $forum_row["cat_id"];
    			$sitemap['parent'][$j]['child'][$i]['id'] = $forum_row["forum_id"];
    			$sitemap['parent'][$j]['child'][$i]['title'] = $myts->makeTboxData4Show($forum_row["forum_name"]);
    			$sitemap['parent'][$j]['child'][$i]['image'] = 2;
    			$sitemap['parent'][$j]['child'][$i]['url'] = "viewforum.php?forum=".$forum_row['forum_id'];
            }else{
                // サブカテ非表示ならフォーラムをルートにする
                $sitemap['parent'][$i]['id'] = $forum_row["forum_id"];
                $sitemap['parent'][$i]['title'] = $myts->makeTboxData4Show($forum_row["forum_name"]);
                $sitemap['parent'][$i]['url'] = "viewforum.php?forum=".$forum_row['forum_id'];
            }
        $i++;
        //}
    }
    //print_r($categories);
    return $sitemap;
}


?>