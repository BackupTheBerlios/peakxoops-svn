<?php
// $Id: modinfo.php,v 1.2 2004/12/20 04:23:18 gij Exp $
// Module Info

// The name of this module
define("_MI_XHNEWBB_NAME","Forum");

// A brief description of this module
define("_MI_XHNEWBB_DESC","Forums module for XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","Topics");
define("_MI_XHNEWBB_BDESC1","This block can be used for multi-purpose. Of course, you can put it multiplly.");

// Names of admin menu items
define("_MI_XHNEWBB_ADMENU1","Add Forum");
define("_MI_XHNEWBB_ADMENU2","Edit Forum");
define("_MI_XHNEWBB_ADMENU3","Edit Priv. Forum");
define("_MI_XHNEWBB_ADMENU4","Sync forums/topics");
define("_MI_XHNEWBB_ADMENU5","Add Category");
define("_MI_XHNEWBB_ADMENU6","Edit Category");
define("_MI_XHNEWBB_ADMENU7","Delete Category");
define("_MI_XHNEWBB_ADMENU8","Re-order Category");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","Blocks&Groups");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', 'Thread');
define ('_MI_XHNEWBB_THREAD_NOTIFYDSC', 'Notification options that apply to the current thread.');

define ('_MI_XHNEWBB_FORUM_NOTIFY', 'Forum');
define ('_MI_XHNEWBB_FORUM_NOTIFYDSC', 'Notification options that apply to the current forum.');

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', 'Global');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', 'Global forum notification options.');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', 'New Post');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', 'Notify me of new posts in the current thread.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC', 'Receive notification when a new message is posted to the current thread.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post in thread');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', 'New Thread');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', 'Notify me of new topics in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC', 'Receive notification when a new thread is started in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New thread in forum');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', 'New Forum');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP', 'Notify me when a new forum is created.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC', 'Receive notification when a new forum is created.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New forum');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', 'New Post');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', 'Notify me of any new posts.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', 'Receive notification when any new message is posted.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', 'New Post');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', 'Notify me of any new posts in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', 'Receive notification when any new message is posted in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post in forum');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', 'New Post (Full Text)');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Notify me of any new posts (include full text in message).');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Receive full text notification when any new message is posted.');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post (full text)');

?>
