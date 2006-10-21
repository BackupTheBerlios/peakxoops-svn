<?php

require_once dirname(__FILE__).'/main_functions.php' ;
require_once dirname(__FILE__).'/common_functions.php' ;
require_once dirname(dirname(__FILE__)).'/class/d3forum.textsanitizer.php' ;
$myts =& D3forumTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

// GET $uid
$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
$isadmin = $uid > 0 ? $xoopsUser->isAdmin() : false ;

// icon meanings
$d3forum_icon_meanings = explode( '|' , $xoopsModuleConfig['icon_meanings'] ) ;

// get this user's permissions as perm array
$category_permissions = d3forum_get_category_permissions_of_current_user( $mydirname ) ;
$whr_read4cat = 'c.`cat_id` IN (' . implode( "," , array_keys( $category_permissions ) ) . ')' ;
$forum_permissions = d3forum_get_forum_permissions_of_current_user( $mydirname ) ;
$whr_read4forum = 'f.`forum_id` IN (' . implode( "," , array_keys( $forum_permissions ) ) . ')' ;

?>