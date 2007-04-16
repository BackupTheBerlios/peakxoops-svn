<?php

require_once dirname(__FILE__).'/main_functions.php' ;
require_once dirname(__FILE__).'/common_functions.php' ;

$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;

// init xoops_breadcrumbs
$xoops_breadcrumbs[0] = array( 'url' => XOOPS_URL.'/modules/'.$mydirname.'/index.php' , 'name' => $xoopsModule->getVar( 'name' ) ) ;

?>