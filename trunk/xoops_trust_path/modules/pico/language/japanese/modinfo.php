<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","pico");

// A brief description of this module
define($constpref."_DESC","��Ū����ƥ�ĺ����⥸�塼��");

// admin menus
define( $constpref.'_ADMENU_CATEGORYACCESS' , '���ƥ��꡼������������' ) ;

// configurations
define($constpref.'_TOP_MESSAGE','�⥸�塼��ȥåפΥ�å�����');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_SHOW_LISTASINDEX','���ƥ��꡼�ȥåפǥꥹ�Ȥ�ɽ������');
define($constpref.'_SHOW_BREADCRUMBS','�ѥ󤯤���ɽ������');
define($constpref.'_SHOW_PAGENAVI','�ڡ����ʥӥ���������ɽ������');
define($constpref.'_SHOW_PRINTICON','�������̤ؤΥ�󥯤�ɽ������');
define($constpref.'_SHOW_TELLAFRIEND','ͧã�˾Ҳ𤹤��󥯤�ɽ������');
define($constpref.'_FILTERS','�ǥե���ȥե��륿�����å�');
define($constpref.'_FILTERSDSC','�ե��륿��̾��|�Ƕ��ڤä����Ϥ���');
define($constpref.'_FILTERSDEFAULT','');
define($constpref.'_USE_VOTE','��ɼ��ǽ�����Ѥ���');
define($constpref.'_GUESTVOTE_IVL','��������ɼ�λ�������');
define($constpref.'_GUESTVOTE_IVLDSC','Ʊ���IP����ϡ����λ��֡��ÿ��������ɼ���뤳�Ȥ��Ǥ��ʤ�');
define($constpref.'_HTMLHEADER','����ƥ�Ķ���HTML�إå�');
define($constpref.'_CSS_URI','�⥸�塼����CSS��URI');
define($constpref.'_CSS_URIDSC','���Υ⥸�塼�����Ѥ�CSS�ե������URI�����Хѥ��ޤ������Хѥ��ǻ��ꤷ�ޤ����ǥե���Ȥ�index.css�Ǥ���');
define($constpref.'_IMAGES_DIR','���᡼���ե�����ǥ��쥯�ȥ�');
define($constpref.'_IMAGES_DIRDSC','���Υ⥸�塼���ѤΥ��᡼������Ǽ���줿�ǥ��쥯�ȥ��⥸�塼��ǥ��쥯�ȥ꤫������Хѥ��ǻ��ꤷ�ޤ����ǥե���Ȥ�images�Ǥ���');
define($constpref.'_COM_DIRNAME','���������礹��d3forum��dirname');
define($constpref.'_COM_FORUM_ID','���������礹��ե��������ֹ�');



}


?>