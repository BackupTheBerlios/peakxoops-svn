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
define( $constpref.'_ADMENU_CONTENTSADMIN' , '����ƥ�İ�����' ) ;
define( $constpref.'_ADMENU_CATEGORYACCESS' , '���ƥ��꡼������������' ) ;
define( $constpref.'_ADMENU_IMPORT' , '����ݡ���/Ʊ��' ) ;

// configurations
define($constpref.'_TOP_MESSAGE','�⥸�塼��ȥåפΥ�å�����');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_MENUINMODULETOP','�⥸�塼��ȥåפǤϼ�ư������˥塼��ɽ������');
define($constpref.'_LISTASINDEX','���ƥ��꡼�ȥåפǥꥹ�Ȥ�ɽ������');
define($constpref.'_LISTASINDEXDSC','�֤Ϥ��פξ�硢���ƥ��꡼�ȥåפǤϥ��֥��ƥ��꡼��ľ���Υ���ƥ�Ĥ��ꥹ�ȼ���ɽ������ޤ����֤������פξ�硢���Υ��ƥ��꡼��ǺǤ�ɽ��ͥ���٤ι⤤����ƥ�Ĥ�ɽ������ޤ���');
define($constpref.'_SHOW_BREADCRUMBS','�ѥ󤯤���ɽ������');
define($constpref.'_SHOW_PAGENAVI','�ڡ����ʥӥ���������ɽ������');
define($constpref.'_SHOW_PRINTICON','�������̤ؤΥ�󥯤�ɽ������');
define($constpref.'_SHOW_TELLAFRIEND','ͧã�˾Ҳ𤹤��󥯤�ɽ������');
define($constpref.'_USE_TAFMODULE','tellafriend�⥸�塼������Ѥ���');
define($constpref.'_FILTERS','�ǥե���ȥե��륿�����å�');
define($constpref.'_FILTERSDSC','�ե��륿��̾��|�Ƕ��ڤä����Ϥ��ޤ�');
define($constpref.'_FILTERSDEFAULT','htmlspecialchars|smiley|xcode|nl2br');
define($constpref.'_USE_VOTE','��ɼ��ǽ�����Ѥ���');
define($constpref.'_GUESTVOTE_IVL','��������ɼ�λ�������');
define($constpref.'_GUESTVOTE_IVLDSC','Ʊ���IP����ϡ����λ��֡��ÿ��������ɼ���뤳�Ȥ��Ǥ��ޤ���');
define($constpref.'_HTMLHEADER','����ƥ�Ķ���HTML�إå�');
define($constpref.'_CSS_URI','�⥸�塼����CSS��URI');
define($constpref.'_CSS_URIDSC','���Υ⥸�塼�����Ѥ�CSS�ե������URI�����Хѥ��ޤ������Хѥ��ǻ��ꤷ�ޤ����ǥե���Ȥ�index.css�Ǥ���');
define($constpref.'_IMAGES_DIR','���᡼���ե�����ǥ��쥯�ȥ�');
define($constpref.'_IMAGES_DIRDSC','���Υ⥸�塼���ѤΥ��᡼������Ǽ���줿�ǥ��쥯�ȥ��⥸�塼��ǥ��쥯�ȥ꤫������Хѥ��ǻ��ꤷ�ޤ����ǥե���Ȥ�images�Ǥ���');
define($constpref.'_BODY_EDITOR','��ʸ�Խ����ǥ���');
define($constpref.'_COM_DIRNAME','���������礹��d3forum��dirname');
define($constpref.'_COM_FORUM_ID','���������礹��ե��������ֹ�');

// blocks
define($constpref.'_BNAME_MENU','��˥塼');
define($constpref.'_BNAME_CONTENT','����ƥ������');
define($constpref.'_BNAME_LIST','����ƥ�İ���');

// Notify Categories
define($constpref.'_NOTCAT_GLOBAL', '�⥸�塼������');
define($constpref.'_NOTCAT_GLOBALDSC', '����pico�⥸�塼�����Τˤ��������Υ��ץ����');

// Each Notifications
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENT', '��ǧ�Ԥ�');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTCAP', '����ƥ�Ĥο�����Ͽ���ѹ��ʤɤǡ���ǧ��ɬ�פ���Ƥ����ä��������Τ���ʥ�ǥ졼���ʳ��ˤ����Τ���ޤ����');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTSBJ', '[{X_SITENAME}] {X_MODULE}: ��ǧ�Ԥ�');

}


?>