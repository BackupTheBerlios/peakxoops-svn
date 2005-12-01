<?php
// 繁體中文化：http://www.cyai.net/ UTF-8中文版請到本網站下載
// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","日時");
define("_AM_TH_USER","會員");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","種類");
define("_AM_TH_DESCRIPTION","詳細");

define( "_AM_TH_BADIPS" , "禁止IP一覽");
define( "_AM_TH_ENABLEIPBANS" , "將IP禁止設定為有效");

define( "_AM_LABEL_REMOVE" , "將所點選的移除:");
define( "_AM_BUTTON_REMOVE" , "確定刪除");
define( "_AM_JS_REMOVECONFIRM" , "確定真的要刪除嗎？");
define( "_AM_MSG_PRUPDATED" , "設定已經更新完成！");
define( "_AM_MSG_REMOVED" , "已經刪除完畢！");


// prefix_manager.php
define("_AM_H3_PREFIXMAN" , "前置語管理");
define("_AM_MSG_DBUPDATED" , "資料庫已更新了！");
define("_AM_CONFIRM_DELETE" , "請確定是否要刪除全部資料？");
define("_AM_TXT_HOWTOCHANGEDB" , "要更改前綴必須先修改 %s/mainfile.php 的內容如下：<br /><br />define(\'XOOPS_DB_PREFIX\', \'<b>%s</b>\');");


// advisory.php
define("_AM_ADV_NOTSECURE","非建議值");

define("_AM_ADV_REGISTERGLOBALS","這個設定容易會招來各式各樣的變數污染攻擊。");
define("_AM_ADV_ALLOWURLFOPEN","使用這個設定，會有任意讓外部執行scripts的危險！");
define("_AM_ADV_DBPREFIX","資料庫的前置語為預設值的xoops，導致SQL Injections會比較弱，<br />不要忘記儘量將SQL Injection等的安全對策的設定為ON");
define("_AM_ADV_LINK_TO_PREFIXMAN","前往前置語管理");
define("_AM_ADV_MAINUNPATCHED","mainfile.php如果不設定讀取本檔案來保護時，Protector的守護範圍會有限制，<br />請務必讀取README安裝說明，照著步驟修改mainfile.php");
define("_AM_ADV_RESCUEPASSWORD","救援密碼");
define("_AM_ADV_RESCUEPASSWORDUNSET","未設置");
define("_AM_ADV_RESCUEPASSWORDSHORT","可以的話請設定六個文字以上");

define("_AM_ADV_SUBTITLECHECK","Protector的作動確認<font color=red>(沒事請勿亂按，以免網站呈現不正常)</font>");
define("_AM_ADV_AT1STSETPASSWORD","自己也有可能被自動設定成禁止IP行列，請自己先行設定『救援密碼』");
define("_AM_ADV_CHECKCONTAMI","變數感染");
define("_AM_ADV_CHECKISOCOM","comment孤立");

?>