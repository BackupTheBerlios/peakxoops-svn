<?php
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MI_LOADED' ) ) {





// Appended by Xoops Language Checker -GIJOE- in 2006-05-26 06:00:52
define('_ALBM_MYALBUM_ADMENU_MYTPLSADMIN','Templates');

// Appended by Xoops Language Checker -GIJOE- in 2004-10-04 16:06:32
define('_ALBM_CFG_DEFAULTORDER','預設分類的相片展示順序');

// Appended by Xoops Language Checker -GIJOE- in 2004-06-24 17:58:58
define('_ALBM_CFG_USESITEIMG','使用 [siteimg] 在圖案管理員的整合');
define('_ALBM_CFG_DESCUSESITEIMG','圖案管理員的整合中以 [siteimg] 取代 [img]。<br />您必須 hack module.textsanitizer.php 或啟用每一個模組的 [siteimg] 標籤。');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-19 13:56:05
define('_ALBM_CFG_MIDDLEPIXEL','單張展示相片的最大尺寸');
define('_ALBM_CFG_DESCMIDDLEPIXEL','指定 (寬)x(高)<br />例如：480x480');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:55
define('_ALBM_CFG_DESCPERPAGE','輸入選項數字並以 \'|\' 來分隔。(例如： 10|20|50|100)');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-05 15:14:38
define('_ALBM_CFG_ALLOWNOIMAGE','允許沒有相片的評論');
define('_ALBM_CFG_ALLOWEDEXTS','允許上傳的副檔名');
define('_ALBM_CFG_DESCALLOWEDEXTS','輸入副檔名並以 \'|\' 分隔。(例如：\'jpg|jpeg|gif|png\')<br />字元必須全部是小寫，不要插入句號(.)或空白鍵。');
define('_ALBM_CFG_ALLOWEDMIME','允許上傳的 MIME 類型');
define('_ALBM_CFG_DESCALLOWEDMIME','輸入 MIME 類型並以 \'|\' 分隔。(例如：\'image/gif|image/jpeg|image/png\')<br />在這裡空白時，代表您想 MIME 類型檢查。');

define( 'MYALBUM_MI_LOADED' , 1 ) ;

// The name of this module
define("_ALBM_MYALBUM_NAME","電子相簿");

// A brief description of this module
define("_ALBM_MYALBUM_DESC","建立相片簿以便用戶可以 搜尋/發布/評論 分享各種相片，xboos 中文化。");

// Names of blocks for this module (Not all module has blocks)
define("_ALBM_BNAME_RECENT","最新相片");
define("_ALBM_BNAME_HITS","熱門相片");
define("_ALBM_BNAME_RANDOM","電子相簿");

// Config Items
define( "_ALBM_CFG_PHOTOSPATH" , "相片存放的路徑" ) ;
define( "_ALBM_CFG_DESCPHOTOSPATH" , "路徑應該存在安裝到 XOOPS 系統的目錄裡。<br />(路徑名稱應該以 '/'開始，而且不可以 '/' 結尾。)<br />而存放相片的目錄權限屬性在 UNIX 系統設為 777 或 707 。" ) ;
define( "_ALBM_CFG_THUMBSPATH" , "縮圖存放的路徑" ) ;
define( "_ALBM_CFG_DESCTHUMBSPATH" , "路徑應該存在安裝到 XOOPS 系統的目錄裡。<br />(路徑名稱應該以 '/'開始，而且不可以 '/' 結尾。)<br />而存放相片的目錄權限屬性在 UNIX 系統設為 777 或 707 。" ) ;
define( "_ALBM_CFG_USEIMAGICK" , "使用 ImageMagick 來建立縮圖：" ) ;
define( "_ALBM_CFG_DESCIMAGICK" , "選(否)表示使用 GD 。(將無法變更與旋轉相片)<br />所以請盡可能使用 ImageMagick 。" ) ;
define( "_ALBM_CFG_IMAGICKPATH" , "ImageMagick 的路徑：" ) ;
define( "_ALBM_CFG_DESCIMAGICKPATH" , "'convert' 的完整路徑。<br />(路徑名稱請勿以 '/' 結尾。)<br />這個設定只有在使用 ImageMagick 是有意義的。" ) ;
define( "_ALBM_CFG_POPULAR" , "點閱超過幾次才能成為熱門相片：" ) ;
define( "_ALBM_CFG_NEWDAYS" , "標示為'新'&'更新'圖標的間隔日期" ) ;
define( "_ALBM_CFG_NEWPHOTOS" , "首頁展示新進相片的數量：" ) ;
define( "_ALBM_CFG_PERPAGE" , "每頁展示幾張相片：" ) ;
define( "_ALBM_CFG_MAKETHUMB" , "建立縮圖：" ) ;
define( "_ALBM_CFG_THUMBWIDTH" , "縮圖寬度：" ) ;
define( "_ALBM_CFG_DESCMAKETHUMB" , "當您將 '否' 改為 '是'，您最好重新執行 '重建縮圖' 。" ) ;
define( "_ALBM_CFG_WIDTH" , "相片最大寬度：" ) ;
define( "_ALBM_CFG_DESCWIDTH" , "如果您使用 ImageMagick ，則代表寬度大小將會重新設定。<br />如果不是使用 ImageMagick，則代表這是寬度限制。" ) ;
define( "_ALBM_CFG_HEIGHT" , "相片最大高度：" ) ;
define( "_ALBM_CFG_DESCHEIGHT" , "如果您使用 ImageMagick ，則代表高度大小將會重新設定。<br />如果不是使用 ImageMagick ，則代表這是高度限制。" ) ;
define( "_ALBM_CFG_FSIZE" , "最大檔案大小：" ) ;
define( "_ALBM_CFG_DESCFSIZE" , "限制上傳相片檔案之大小 (byte)。<br />1048576 byte = 1 MB" ) ;
define( "_ALBM_CFG_NEEDADMIT" , "所有新相片需經審核後才允許發布：" ) ;
define( "_ALBM_CFG_ADDPOSTS" , "當會員發布一張照片後,會員發表數所要添加數為：" ) ;
define( "_ALBM_CFG_DESCADDPOSTS" , "一般設為：0 或 1 （低於0代表0）" ) ;

// Sub menu titles
define("_ALBM_TEXT_SMNAME1","上傳相片");
define("_ALBM_TEXT_SMNAME2","熱門相片");
define("_ALBM_TEXT_SMNAME3","優質相片");
define("_ALBM_TEXT_SMNAME4","我的相片");

// Names of admin menu items
define("_ALBM_MYALBUM_ADMENU2","編修/新增/刪除 相片分類");
define("_ALBM_MYALBUM_ADMENU1","相片管理/刪除");
define("_ALBM_MYALBUM_ADMENU0","審核上傳相片");
define("_ALBM_MYALBUM_ADMENU3","查核相片模組資料庫");
define("_ALBM_MYALBUM_ADMENU4","相片批次上傳");
define("_ALBM_MYALBUM_ADMENU5","重建縮圖");
define('_ALBM_MYALBUM_ADMENU_IMPORT','匯入相片');
define('_ALBM_MYALBUM_ADMENU_EXPORT','匯出相片');
define('_ALBM_MYALBUM_ADMENU_MYBLOCKSADMIN','區塊及群組管理');
define('_ALBM_MYALBUM_ADMENU_GPERM','全域權限');

// Appended by Xoops Language Checker -GIJOE- in 2003-10-21 17:48:33
define('_ALBM_CFG_DESCTHUMBWIDTH','縮圖的高度會依據寬度的設定值自動完成.');

// Appended by Xoops Language Checker -GIJOE- in 2003-11-27 10:43:20
define('_ALBM_CFG_IMAGINGPIPE','相片處理套件');
define('_ALBM_CFG_DESCIMAGINGPIPE','幾乎 PHP 環境能使用 GD ，但是 GD 的功能低於另外二個套件。<br />如果可以，您最好使用 ImageMagick 或者 NetPBM 。');
define('_ALBM_CFG_FORCEGD2','強制 GD2 轉換');
define('_ALBM_CFG_DESCFORCEGD2','即使 PHP 打包的 GD 版本是強制 GD2 (全彩) 轉換。<br />有些 PHP 設定使 GD2 建立縮圖失敗。<br />這個設定只有在使用 GD 是有意義的。');
define('_ALBM_CFG_NETPBMPATH','NetPBM 的路徑');
define('_ALBM_CFG_DESCNETPBMPATH','\'pnmscale\' 的完整路徑。<br />(路徑名稱請勿以 \'/\' 結尾。)<br />這個設定只有在使用 NetPBM 是有意義的。');
define('_ALBM_CFG_THUMBSIZE','縮圖的尺寸 (pixel)');
define('_ALBM_CFG_THUMBRULE','縮圖建立的計算規釗');
define('_ALBM_CFG_CATONSUBMENU','顯示主分類於次選單');
define('_ALBM_CFG_NAMEORUNAME','張貼者名字顯示');
define('_ALBM_CFG_DESCNAMEORUNAME','選擇「真實姓名」或「帳號」顯示');
define('_ALBM_OPT_USENAME','真實姓名');
define('_ALBM_OPT_USEUNAME','帳號');
define('_ALBUM_OPT_CALCFROMWIDTH','寬度:指定 ； 高度:自動');
define('_ALBUM_OPT_CALCFROMHEIGHT','寬度:自動 ； 高度:指定');
define('_ALBUM_OPT_CALCWHINSIDEBOX','長寬均在指定長度內');

// Appended by Xoops Language Checker -GIJOE- in 2003-12-03 16:33:03
define('_ALBM_BNAME_RECENT_P','新進相片縮圖');
define('_ALBM_BNAME_HITS_P','熱門相片縮圖');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:02
define('_ALBM_CFG_VIEWCATTYPE','分類中顯示相片的型式');
define('_ALBM_CFG_COLSOFTABLEVIEW','縮圖式顯示的欄位數');
define('_ALBM_OPT_VIEWLIST','詳列式顯示');
define('_ALBM_OPT_VIEWTABLE','縮圖式顯示');
define('_MI_MYALBUM_GLOBAL_NOTIFY','myAlbum-P 全域通知項目');
define('_MI_MYALBUM_GLOBAL_NOTIFYDSC','myAlbum-P 全域通知項目');
define('_MI_MYALBUM_CATEGORY_NOTIFY','myAlbum-P 相片分類通知項目');
define('_MI_MYALBUM_CATEGORY_NOTIFYDSC','審核目前相片分類的通知項目');
define('_MI_MYALBUM_PHOTO_NOTIFY','myAlbum-P 相片通知項目');
define('_MI_MYALBUM_PHOTO_NOTIFYDSC','審核目前相片的通知項目');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFY','新相片');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYCAP','有新相片張貼時通知我');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYDSC','有新相片張貼時收到通知');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: 自
動通知 : 新相片');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFY','新相片');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYCAP','有新相片張貼在目前的分類時通知我');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYDSC','有新相片張貼在目前的分類時收到通知');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: 自動通知 : 新相片');

}

?>
