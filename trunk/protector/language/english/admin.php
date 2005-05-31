<?php

// index.php
define("_AM_TH_DATETIME","Time");
define("_AM_TH_USER","User");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Type");
define("_AM_TH_DESCRIPTION","Description");

define( "_AM_TH_BADIPS" , "Bad IPs" ) ;
define( "_AM_TH_ENABLEIPBANS" , "Enable IP bans?" ) ;

define( "_AM_LABEL_REMOVE" , "Remove the records checked:" ) ;
define( "_AM_BUTTON_REMOVE" , "Remove!" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Remove OK?" ) ;
define( "_AM_MSG_PRUPDATED" , "Preferences Updated Successfully!" ) ;
define( "_AM_MSG_REMOVED" , "Records are removed" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Prefix Manager" ) ;
define( "_AM_MSG_DBUPDATED" , "Database Updated Successfully!" ) ;
define( "_AM_CONFIRM_DELETE" , "All data will be dropped. OK?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "If you want to change prefix,<br /> edit %s/mainfile.php manually.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Not secure");

define("_AM_ADV_REGISTERGLOBALS","This setting invites a variety of injecting attacks.<br />If you can put .htaccess, edit or create...");
define("_AM_ADV_ALLOWURLFOPEN","This setting allows attackers to execute arbitrary scripts on remote servers.<br />Only administrator can change this option.<br />If you are an admin, edit php.ini or httpd.conf.<br /><b>Sample of httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Else, claim it to your administrators.");
define("_AM_ADV_DBPREFIX","This setting invites 'SQL Injections'.<br />Don't forget turning 'Force sanitizing *' on in this module's preferences.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Go to prefix manager");
define("_AM_ADV_MAINUNPATCHED","You should edit your mainfile.php like written in README.");
define("_AM_ADV_RESCUEPASSWORD","Password for rescue");
define("_AM_ADV_RESCUEPASSWORDUNSET","Unset");
define("_AM_ADV_RESCUEPASSWORDSHORT","Too short (min 6 charactors)");

define("_AM_ADV_SUBTITLECHECK","Check if Protector works well");
define("_AM_ADV_AT1STSETPASSWORD","At first, you have to set a password for rescue");
define("_AM_ADV_CHECKCONTAMI","Contaminations");
define("_AM_ADV_CHECKISOCOM","Isolated Comments");



?>