<?php

include_once('./../../../include/cp_header.php');

xoops_cp_header();
include( './mymenu.php' ) ;


//echo "[ <a href='".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getvar('mid')."'>"._PREFERENCES."</a> ]"; // thx osewa ni natteru hito

if(file_exists(XOOPS_ROOT_PATH."/modules/sitemap/language/".$xoopsConfig["language"]."/readme.html")){
    include XOOPS_ROOT_PATH."/modules/sitemap/language/".$xoopsConfig["language"]."/readme.html";
}else{
    include XOOPS_ROOT_PATH."/modules/sitemap/language/english/readme.html";
}

xoops_cp_footer();

?>