<?php// Module Info ( 繁體中文化：http://www.cyai.net/ UTF-8中文版請到本網站下載)



// Appended by Xoops Language Checker -GIJOE- in 2005-03-31 12:07:31
define('_MI_PROTECTOR_PREFIXMANAGER','Prefix Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-05 07:09:09
define('_MI_PROTECTOR_GLOBAL_DISBL','Temporary disabled');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','All protections are disabled in temporary.<br />Don\'t forget turn this off after shooting the trouble');
define('_MI_PROTECTOR_LOG_LEVEL','Logging level');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','none');
define('_MI_PROTECTOR_LOGLEVEL15','Quiet');
define('_MI_PROTECTOR_LOGLEVEL63','quiet');
define('_MI_PROTECTOR_LOGLEVEL255','full');

// The name of this moduledefine("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","這模組保護你的網站不受到(DoS attack)的攻擊，<br />主要以DoS,SQL Injection等變數感染的防護<br />要有效的利用此模組放置在會出現的左上方區塊，排序序號為最優先，並別忘記要開放訪客有讀取此區塊權力。");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","要有效的利用此模組放置在會出現的左上方區塊，排序序號為最優先 (0)");

// Menu
define("_MI_PROTECTOR_ADMININDEX","防護中心");
define('_MI_PROTECTOR_ADVISORY','安全性隱私防護');
define("_MI_PROTECTOR_MYBLOCKSADMIN","區塊及群組管理");

// Configs
define('_MI_PROTECTOR_HIJACK_DENYGP','IP變動禁止群組');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','防止session被劫取對策：<br />禁止與session中不同IP的擷取群組指定<br />（建議對管理群組開啟此項）');
define('_MI_PROTECTOR_SAN_NULLBYTE','以空白替代無效之字串');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','文字串的惡意攻擊 "\0" <br />將此有害無效的字元自動以空白來替代<br />(建議開啟此項目)');
define('_MI_PROTECTOR_DIE_NULLBYTE','發現無效文字列時強制終止');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','遭到文字串的惡意攻擊 "\0" 時強制終止<br />(建議開啟此項目)');
define('_MI_PROTECTOR_DIE_BADEXT','強制終止可以實行的檔案上傳');
define('_MI_PROTECTOR_DIE_BADEXTDSC','副檔名為PHP等的檔案可以在伺服器上直接執行上傳檔案時強制終止。<br />如果網站內有類似 B-Wiki 或是 PukiWikiMod 等會時常使用到PHP檔案附加時，請設定為OFF');
define('_MI_PROTECTOR_CONTAMI_ACTION','發現變數污染時的處理');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','有發現改寫XOOPS整體系統時的處理方式<br />(預設值為強制終止)');
define('_MI_PROTECTOR_ISOCOM_ACTION','發現孤立comment攻擊時的處理');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','SQL注入對策：<br />當發現孤立 "/*" 時的處理方式<br />無害化方式：最後方自動加上 "*/" 對策<br />(建議利用無害化方式)');
define('_MI_PROTECTOR_UNION_ACTION','發現 UNION 的處理方式');
define('_MI_PROTECTOR_UNION_ACTIONDSC','SQL注入對策：<br />於SQL內發現UNION構文時的處理方式<br />無害化方式：將UNION自動改為uni-on<br />(建議利用無害化方式)');
define('_MI_PROTECTOR_ID_INTVAL','ID變數強制變換');
define('_MI_PROTECTOR_ID_INTVALDSC','注意！這個選項如果開啟可能會導致有部分模組無法正常運作');
define('_MI_PROTECTOR_FILE_DOTDOT','可疑檔案指定的禁止');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','由檔案可以判斷的文字列裡將排除".."的形式種類。');

define('_MI_PROTECTOR_DOS_EXPIRE','DoS的監視時間 (秒)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','DoS重複更新頻率追蹤監視的時間設定');

define('_MI_PROTECTOR_DOS_F5COUNT','F5(重新整理)方式點擊認可安全次數');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','在DoS攻擊的防禦上<br />如果受到所設定的時間內於這個次數以上來自相同url時將都會被認定為攻擊行為。');
define('_MI_PROTECTOR_DOS_F5ACTION','針對利用F5的對策');

define('_MI_PROTECTOR_DOS_CRCOUNT','對於Crawler的不良計數');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','含有不良Crawler（例如收及郵件位址）的對策<br />根據上面設定的監視時間以內，在這個次數以上於網站內活動時都視為含有不良之Crawler');
define('_MI_PROTECTOR_DOS_CRACTION','針對不良Crawler的對策');

define('_MI_PROTECTOR_DOS_CRSAFE','不拒絕的 User-Agent');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','無條件許的Agent名，以正規perl的方式輸入。<br />例如： /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','無 (僅擷取log)');
define('_MI_PROTECTOR_OPT_SAN','無害化');
define('_MI_PROTECTOR_OPT_EXIT','強制終止');
define('_MI_PROTECTOR_OPT_BIP','登記為禁止IP');

define('_MI_PROTECTOR_DOSOPT_NONE','無 (只擷取log)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep');
define('_MI_PROTECTOR_DOSOPT_EXIT','exit');
define('_MI_PROTECTOR_DOSOPT_BIP','禁止IP自動登載');
define('_MI_PROTECTOR_DOSOPT_HTA','在.htaccess裡登記DENY(目前為測試性質)');

define('_MI_PROTECTOR_BIP_EXCEPT','禁止IP登記的保護群組');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','在這裡所選定的群組將不會被登記到IP禁止，不過如果是未登入狀態之下，這個保護就是多餘的了。');
define('_MI_PROTECTOR_PATCH2092','Xoops2.0.9.2存在的漏洞修補');
define('_MI_PROTECTOR_PASSWD_BIP','救援密碼');
define('_MI_PROTECTOR_PASSWD_BIPDSC','假如不知原因的您自己也被登記到ip禁止名單內時的緊急對策方式。<br />到時只要連結到 XOOPS_URL/modules/protector/admin/rescue.php 輸入這裡所設之密碼即可。<br />如果在此不設置密碼將無法啟動救援機制，還請特別注意！');

?>