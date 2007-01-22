<?php

@include_once dirname(__FILE__).'/constants.php' ;
if( ! defined( '_MD_PICO_WRAPBASE' ) ) require_once dirname(__FILE__).'/constants.dist.php' ;
require_once dirname(__FILE__).'/main_functions.php' ;
require_once dirname(__FILE__).'/common_functions.php' ;
require_once dirname(dirname(__FILE__)).'/class/pico.textsanitizer.php' ;
$myts =& PicoTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

// GET $uid
$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
$isadmin = $uid > 0 ? $xoopsUser->isAdmin() : false ;

// get this user's permissions as perm array
$category_permissions = pico_get_category_permissions_of_current_user( $mydirname ) ;
$whr_read4cat = 'c.`cat_id` IN (' . implode( "," , array_keys( $category_permissions ) ) . ')' ;
$whr_read4content = 'o.`cat_id` IN (' . implode( "," , array_keys( $category_permissions ) ) . ')' ;

// add XOOPS_TRUST_PATH/PEAR/ into include_path
if( ! defined( 'PATH_SEPARATOR' ) ) define( 'PATH_SEPARATOR' , DIRECTORY_SEPARATOR == '/' ? ':' : ';' ) ;
ini_set( 'include_path' , ini_get('include_path') . PATH_SEPARATOR . XOOPS_TRUST_PATH . '/PEAR' ) ;

?>