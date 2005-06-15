<?php
function b_waiting_catads(){
   $xoopsDB =& Database::getInstance();
   $block = array();

   $result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("catads_ads")." WHERE published ='0'");
   if ( $result ) {
       $block['adminlink'] = XOOPS_URL."/modules/catads/admin/index.php";
       list($block['pendingnum']) = $xoopsDB->fetchRow($result);
       $block['lang_linkname'] = _PI_WAITING_SUBMITTED ;
   }

   return $block;
}
?>