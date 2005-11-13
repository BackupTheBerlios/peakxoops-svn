<?php
// $Id: admin.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
//%%%%%%        Admin Module Name  Headlines         %%%%%

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_AM_DBUPDATED' ) ) {

// list of encodings allowed   (name):(title)|(name):(title)|...
define('_AM_ENCODINGS','utf-8:UTF-8|iso-8859-1:ISO-8859-1|us-ascii:US-ASCII') ;
define('_AM_ENCODING_AUTO','auto detection') ;

define('_AM_DBUPDATED','Database Updated Successfully!');
define('_AM_HEADLINES','Headlines Configuration (No.%s)');
define('_AM_HLMAIN','Headline Main');
define('_AM_SITENAME','Site Name');
define('_AM_URL','URL');
define('_AM_TITLEPATTERN','Extract with title string<br /><span style="font-weight:normal;">write here a regular expression of perl eg) /doller/<br />Normally, left blank</span>');
define('_AM_TITLEEXCLUDE','Exclude with title string<br /><span style="font-weight:normal;">(perl regex) Normally left blank</span>');
define('_AM_LINKPATTERN','Extract with link string<br /><span style="font-weight:normal;">wirte her a regular expression of perl eg) /business/<br />Normally, left blank</span>');
define('_AM_LINKEXCLUDE','Exclude with link string<br /><span style="font-weight:normal;">(perl regex) Normally left blank</span>');
define('_AM_ORDER', 'Order');
define('_AM_ENCODING', 'Encoding');
define('_AM_CACHETIME', 'Fetch Cache');
define('_AM_TIMEOUT', 'Time-out when fetching');
define('_AM_ALLOWHTML', 'Allow to display HTML inside XML<br /><span style="font-weight:normal;">You should not allow HTML to a RSS/ATOM which is generated from posts by visitors of the site.</span>');
define('_AM_MAINSETT', 'Main Page Settings');
define('_AM_BLOCKSETT', 'Block Settings');
define('_AM_DISPIMG', 'Display image');
define('_AM_DISPFULL', 'Display descriptions and publish dates');
define('_AM_DISPMAX', 'Max items to display');
define('_AM_DISPLAY', 'main');
define('_AM_ASBLOCK', 'block');
define('_AM_ADDHEADL','Add Headline');
define('_AM_URLEDFXML','URI of RSS or ATOM');
define('_AM_SYNDICATIONTYPE','Type of the feed');
define('_AM_SYNDICATIONTYPE_AUTO','Auto');
define('_AM_SAVEAS','Save As');
define('_AM_UPDATE','Update & Refetch');
define('_AM_EDITHEADL','Edit Headline');
define('_AM_WANTDEL','Are you sure you want to delete headline for %s?');
define('_AM_INVALIDID', 'Invalid ID');
define('_AM_OBJECTNG', 'Object does not exist');
define('_AM_FAILUPDATE', 'Failed saving data to database for headline %s');
define('_AM_FAILDELETE', 'Failed deleting data from database for headline %s');

}

?>
