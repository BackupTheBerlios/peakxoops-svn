<?php
/**
* Translation of dbtheme for Persian users
*
* @copyright	      http://www.impresscms.ir/ The Persian ImpressCMS Project 
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @package	      Translations
* @since		 0.35
* @author		stranger <pesian_stranger@users.sourceforge.net>
* @version		$Id$
*/
if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'dbtheme' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2007-05-12 05:01:31
define($constpref.'_ADMENU_MYLANGADMIN','زبان‌ها');

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","قالب در پایگاه داده");

// A brief description of this module
define($constpref."_DESC","ماژولی که به شما اجازه ویرایش قالب‌ها در قسمت مدیریتی را می دهد");

// admin menus
define($constpref.'_ADMENU_MYTPLSADMIN','الگو‌های قالب') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','بلوک‌ها/دسترسی‌ها') ;
define($constpref.'_ADMENU_MYPREFERENCES','ویژگی‌ها') ;

// blocks
define( $constpref.'_BNAME_THEMEHOOK' , 'بلوک گرفتار کردن قالب' ) ;

// configs
define($constpref.'_BASETHEME','ست قالب پایه') ;
define($constpref.'_BASETHEMEDSC','اگر می خواهید پایه‌ی ماژول را عوض کنید, این ماژول رو بعد از تغییرات بروز برسانید. (نام قالب را بر اساس شاخه تغییر دهید)') ;
define($constpref.'_CSSCACHETIME','ذخیره‌سازی استایل‌ها برای مرورگر شما (برحسب ثانیه)') ;


}


?>