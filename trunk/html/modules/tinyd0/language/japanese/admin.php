<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_AM_LOADED' ) ) {

define( 'TINYCONTENT_AM_LOADED' , 1 ) ;

//Admin Page Titles
define("_TC_ADMINTITLE","Tiny Content");

// SPAW
define('_TC_SPAWLANG','jp') ;

//Table Titles
define("_TC_ADDCONTENT","��������ƥ�Ĥ��ɲ�");
define("_TC_EDITCONTENT","����ƥ�Ĥ��Խ�");
define("_TC_ADDLINK","�ڡ�����åפ��ɲ�");
define("_TC_EDITLINK","�ڡ�����åפ��ѹ�");
define("_TC_ULFILE","�ե�����Υ��åץ���");
define("_TC_SFILE","������ե����������");
define("_TC_DELFILE","�ե�����κ��");
define("_TC_UPDATE_WRAP_CONTENTS","�ڡ�����å׸�����ι���");

//Table Data
define("_TC_HOMEPAGE","HP");
define("_TC_LINKNAME","�����ȥ�");
define("_TC_STORYID","ID");
define("_TC_VISIBLE","ɽ������Ĥ���");
define("_TC_TH_VISIBLE","ɽ��");
define("_TC_ENABLECOM","�����Ȳ�ǽ");
define("_TC_TH_ENABLECOM","Com");
define("_TC_HTML_HEADER","HTML�إå�");
define("_TC_CONTENT","����ƥ��");
define("_TC_YES","YES");
define("_TC_NO","NO");
define("_TC_URL","�ե����������");
define("_TC_UPLOAD","���åץ���");
define("_TC_DISABLEBREAKS","���Ԥ��br����Ѵ����ʤ�");
define("_TC_SUBMENU","���֥�˥塼��ɽ������");
define("_TC_TH_SUBMENU","Sub");
define("_TC_DISP_YES","ɽ������");
define("_TC_DISP_NO","ɽ�����ʤ�");

define("_TC_CONTENT_TYPE","����ƥ�ĥ�����");
define("_TC_TYPE_HTML","HTML����ƥ�� (bb codeͭ��)"); // nohtml=0
define("_TC_TYPE_HTMLNOBB","HTML����ƥ�� (bb code̵��)"); // nohtml=2
define("_TC_TYPE_TEXTWITHBB","�ƥ����ȥ���ƥ�� (bb codeͭ��)"); // nohtml=1
define("_TC_TYPE_TEXTNOBB","�ƥ����ȥ���ƥ�� (bb code̵��)"); // nohtml=3
define("_TC_TYPE_PHPHTML","PHP������ (bb code̵��)"); // nohtml=8
define("_TC_TYPE_PHPWITHBB","PHP������ (bb codeͭ��)"); // nohtml=10
define("_TC_TYPE_PEARWIKI","PEAR Wiki (bb code̵��)"); // nohtml=16
define("_TC_TYPE_PEARWIKIWITHBB","PEAR Wiki (bb codeͭ��)"); // nohtml=18
define("_TC_TYPE_PUKIWIKI","PukiWiki (bb code̵��)"); // nohtml=32
define("_TC_TYPE_PUKIWIKIWITHBB","PukiWiki (bb codeͭ��)"); // nohtml=34 �ġĤʡ���ơ���Ω����PukiWiki�����������ä����ɤ��ʤ���

define("_TC_CHECKED_ITEMS_ARE","��ü�������å����줿������:");
define("_TC_BUTTON_MOVETO","��ư");

define("_TC_LASTMODIFIED","�ǽ���������");
define("_TC_DONTUPDATELASTMODIFIED","��ư�������ʤ�");
define("_TC_CREATED","��������");
define("_TC_SAVEAS","�̥쥳���ɤȤ�����¸");

define("_TC_LINKID","ɽ����");
define("_TC_CONTENTTYPE","Type");
define("_TC_ACTION","���������");
define("_TC_EDIT","�Խ�");
define("_TC_DELETE","���");
define("_TC_ELINK","�ѹ�");
define("_TC_DELLINK","����");

define("_TC_WRAPROOT","�ڡ�����åפδ���");
define("_TC_FMT_WRAPROOTTC","TinyD�⥸�塼��ǥ��쥯�ȥ�<br /> (%s) <br />");
define("_TC_FMT_WRAPROOTPAGE","��åפ����ڡ�����Ʊ���ǥ��쥯�ȥ�<br /> (%s) <br />mod_rewrite���Ȥ��ʤ����Ϥ�����򤪻Ȥ�������<br />�֥�å��ˤϸ����Ƥ��ޤ���<br />");
define("_TC_FMT_WRAPBYREWRITE","mod_rewrite�ˤ��񤭴����ʼ¸����<br /> %s �˥��åפ��Ʋ�����<br />��������mod_rewrite��ͭ���ˤ���ɬ�פ�����ޤ�<br />�֥�å��ˤ��б����Ƥ��ޤ���<br />");
define("_TC_FMT_WRAPCHANGESRCHREF","HTML�����񤭴����ʥѥ������������<br /> ��åפ��줿HTML�ե���������Х�󥯤����Х�󥯤˽񤭴����ޤ�<br />HTML�����������ɤ˻���ʸ�Ϥϸ�ǧ�����Ƥ��ޤ����줬����ޤ�<br />");

define("_TC_DISABLECOM","�������Բ�");
define("_TC_DBUPDATED","�ǡ����١����򹹿����ޤ���");
define("_TC_ERRORINSERT","�ǡ����١����ι����˼��Ԥ��ޤ���");
define("_TC_RUSUREDEL","�����˥���ƥ�Ĥ������Ƥ�����Ǥ�����<br />���Υ���ƥ�ĤˤĤ���줿�����Ȥ⤹�٤ƾä��ޤ���");
define("_TC_RUSUREDELF","�����˥ե�����������Ƥ�����Ǥ�����");
define("_TC_UPLOADED","�ե�����Υ��åץ��ɤ���λ���ޤ���");
define("_TC_FDELETED","�ե���κ���������ޤ���");
define("_TC_ERROREXIST","Ʊ̾�Υե����뤬���뤿�ᥢ�åץ��ɽ���ޤ���");
define("_TC_ERRORUPL","�ե�����Υ��ԡ��˼��Ԥ��ޤ���");
define("_TC_FMT_WRAPPATHPERMOFF","<span style='font-size:xx-small;'>�ڡ�����å��ѥǥ��쥯�ȥ�(%s)�Ͻ���ػߤȤʤäƤޤ���<br />�ե�����Υ��åץ��ɤ����򤳤�����Ԥ��������ϡ��������Ĥ��Ʋ�������<br />��Unix�ξ��ϥѡ��ߥå�����777��707�ˤ��ޤ���<br />��������ϡ�����ػߤΤޤޤǡ��ڡ�����å��ѥǥ��쥯�ȥ��FTP�ǥե�����򥢥åץ��ɤ�����ˡ�Ǥ���</span>");
define("_TC_FMT_WRAPPATHPERMON","<span style='font-size:xx-small;'>���β��̤���ե�����Υ��åץ��ɤ�Ԥ���ˡ�Ϥ��ޤ�侩�Ǥ��ޤ��󡣲�ǽ�ʤ顢�ڡ�����å��ѥǥ��쥯�ȥ�(%s)�����ػ�(755)�Ȥ��ơ�FTP�ǥե�����򥢥åץ��ɤ��Ʋ�������</span>" ) ;

define("_TC_ALTER_TABLE","�ơ��֥빽¤����");

define("_TC_JS_CONFIRMDISCARD","�Խ����Ƥ��˴�����ޤ���������Ǥ�����");

}

?>