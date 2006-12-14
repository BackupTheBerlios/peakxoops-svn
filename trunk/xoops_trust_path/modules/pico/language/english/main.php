<?php

define('_MD_PICO_TOP','TOP');
define('_MD_PICO_CREATED','Created');
define('_MD_PICO_MODIFIED','Modified');
define('_MD_PICO_VIEWED','Views');
define('_MD_PICO_NEXT','Next');
define('_MD_PICO_PREV','Prev');
define('_MD_PICO_CATEGORYINDEX','top of the category');

define('_MD_PICO_CATEGORY','Category');
define('_MD_PICO_CATEGORIES','Categories');
define('_MD_PICO_SUBCATEGORY','Subcategory');
define('_MD_PICO_SUBCATEGORIES','Subcategories');
define('_MD_PICO_CONTENT','Content');
define('_MD_PICO_CONTENTS','Contents');

define('_MD_PICO_LINK_MAKECATEGORY','Make a category');
define('_MD_PICO_LINK_MAKESUBCATEGORY','Make a subcategory');
define('_MD_PICO_LINK_MAKECONTENT','Make a content');
define('_MD_PICO_LINK_EDITCATEGORY','Edit the category');
define('_MD_PICO_LINK_EDITCONTENT','Edit the content');

define('_MD_PICO_LINK_PRINTERFRIENDLY','Printer friendly');
define('_MD_PICO_LINK_TELLAFRIEND','Tell a friend');
define('_MD_PICO_FMT_TELLAFRIENDSUBJECT','Article found in %s');
define('_MD_PICO_FMT_TELLAFRIENDBODY',"I've just found an interestiong article\nSubject:%s");

define('_MD_PICO_ERR_SQL','SQL Error Occurred in: ');
define('_MD_PICO_ERR_PIDLOOP','parent/child loop error');

define('_MD_PICO_MSG_UPDATED','Updated successfully');

define('_MD_PICO_ERR_READCATEGORY','You cannot access the specified category');
define('_MD_PICO_ERR_CREATECATEGORY','You cannot create a category');
define('_MD_PICO_ERR_CATEGORYMANAGEMENT','You are not a manager of the category');
define('_MD_PICO_ERR_READCONTENT','You cannot access the specified content');
define('_MD_PICO_ERR_CREATECONTENT','You cannot create a content');
define('_MD_PICO_ERR_EDITCONTENT','You cannot edit the content');
define('_MD_PICO_ERR_DELETECONTENT','You cannot delete the content');
define('_MD_PICO_ERR_PERMREADFULL','You cannot read full of the contents');
define('_MD_PICO_ERR_LOGINTOREADFULL','Log in as a member to read the contents entirely');

define('_MD_PICO_MSG_CATEGORYMADE','A category is created successfully');
define('_MD_PICO_MSG_CATEGORYUPDATED','The category is modified successfully');
define('_MD_PICO_MSG_CATEGORYDELETED','The category is deleted successfully');
define('_MD_PICO_MSG_CONTENTMADE','A content has been created successfully');
define('_MD_PICO_MSG_CONTENTUPDATED','The content has been modified successfully');
define('_MD_PICO_MSG_CONTENTDELETED','The content has been deleted successfully');

define('_MD_PICO_CATEGORYMANAGER','Category manager');
define('_MD_PICO_CONTENTMANAGER','Content manager');
define('_MD_PICO_TH_SUBJECT','Subject');
define('_MD_PICO_TH_HTMLHEADER','HTML headers');
define('_MD_PICO_TH_BODY','body');
define('_MD_PICO_TH_FILTERS','filters');
define('_MD_PICO_TH_WEIGHT','weight');
define('_MD_PICO_TH_USECACHE','use cache');
define('_MD_PICO_NOTE_USECACHEDSC','Disable it for dynamic contents. Enable it for searchable');
define('_MD_PICO_TH_VISIBLE','Visible');
define('_MD_PICO_TH_CATEGORYTITLE','Title');
define('_MD_PICO_TH_CATEGORYDESC','Description');
define('_MD_PICO_TH_CATEGORYPARENT','Parent');
define('_MD_PICO_TH_CATEGORYWEIGHT','Weight');
define('_MD_PICO_TH_CATEGORYOPTIONS','Options');
define('_MD_PICO_SUBCATEGORY_COUNT','Number of subcategories');
define('_MD_PICO_MSG_CONFIRMDELETECATEGORY','All contents in the category will be removed. Are you OK?');
define('_MD_PICO_MSG_CONFIRMDELETECONTENT','Are you OK?');
define('_MD_PICO_MSG_GOTOPREFERENCE4EDITTOP','The TOP category is the special. You can change the settings of the TOP in module preferences.');
define('_MD_PICO_LABEL_HTMLHEADERONOFF','display the textarea');
define('_MD_PICO_LABEL_INPUTHELPER','Input Helper ON/OFF');


// filters
define('_MD_PICO_FILTERS_EVALTITLE','php code');
define('_MD_PICO_FILTERS_EVALDESC','It will be the parameter of eval() function');
define('_MD_PICO_FILTERS_EVALINITWEIGHT',0);
define('_MD_PICO_FILTERS_HTMLSPECIALCHARSTITLE','HTML special character escape');
define('_MD_PICO_FILTERS_HTMLSPECIALCHARSDESC','If you want to use BBCode etc. also, set it the first place.');
define('_MD_PICO_FILTERS_HTMLSPECIALCHARSINITWEIGHT',5);
define('_MD_PICO_FILTERS_TEXTWIKITITLE','PEAR TextWiki');
define('_MD_PICO_FILTERS_TEXTWIKIDESC','Rendered by TextWiki rule');
define('_MD_PICO_FILTERS_TEXTWIKIINITWEIGHT',15);
define('_MD_PICO_FILTERS_XOOPSTPLTITLE','Smarty(XoopsTpl)');
define('_MD_PICO_FILTERS_XOOPSTPLDESC','Rendered as a Smarty template');
define('_MD_PICO_FILTERS_XOOPSTPLINITWEIGHT',0);
define('_MD_PICO_FILTERS_NL2BRTITLE','Auto new line');
define('_MD_PICO_FILTERS_NL2BRDESC','LF will be replaced into &lt;br /&gt;');
define('_MD_PICO_FILTERS_NL2BRINITWEIGHT',30);
define('_MD_PICO_FILTERS_SMILEYTITLE','Smiley');
define('_MD_PICO_FILTERS_SMILEYDESC',':-) :-D etc.');
define('_MD_PICO_FILTERS_SMILEYINITWEIGHT',30);
define('_MD_PICO_FILTERS_XCODETITLE','BBCode');
define('_MD_PICO_FILTERS_XCODEDESC','Auto link and BBCode will be enabled');
define('_MD_PICO_FILTERS_XCODEINITWEIGHT',30);


// permissions
define('_MD_PICO_PERMS_CAN_READ','READ');
define('_MD_PICO_PERMS_CAN_READFULL','READ FULL');
define('_MD_PICO_PERMS_CAN_POST','POST');
define('_MD_PICO_PERMS_CAN_EDIT','EDIT');
define('_MD_PICO_PERMS_CAN_DELETE','DELETE');
define('_MD_PICO_PERMS_POST_AUTO_APPROVED','AUTO APPROVED');
define('_MD_PICO_PERMS_IS_MODERATOR','MODERATE');
define('_MD_PICO_PERMS_CAN_MAKESUBCATEGORY','MAKE SUBCATEGORY');

?>