<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3pipes' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","D3 PIPES");

// A brief description of this module
define($constpref."_DESC","RSS���Υ��󥸥���������ͳ���ߤ˰�������Υ⥸�塼��");

// admin menus
define($constpref.'_ADMENU_PIPE','�ѥ��״���') ;
define($constpref.'_ADMENU_CACHE','����å������') ;
define($constpref.'_ADMENU_CLIPPING','�ڤ�ȴ������') ;
define($constpref.'_ADMENU_JOINT','���祤��Ƚ������') ;
define($constpref.'_ADMENU_JOINTCLASS','���祤��ȥ��饹�������') ;
define($constpref.'_ADMENU_MYTPLSADMIN','�ƥ�ץ졼�ȴ���') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','�֥�å�����/������������') ;
define($constpref.'_ADMENU_MYPREFERENCES','��������') ;

// blocks
define($constpref.'_BNAME_ASYNC','��Ʊ���ѥ��װ����֥�å�') ;

// configs
define($constpref.'_INDEXTOTAL','�⥸�塼��ȥåפ�ɽ������ǿ��إåɥ饤������');
define($constpref.'_INDEXEACH','�⥸�塼��ȥåפ�ɽ������ǿ��إåɥ饤��ˣ��ѥ��פ������ĥ�äƤ�������');
define($constpref.'_ENTRIESAPIPE','�ѥ��׸���ɽ����RSS/ATOM��ɽ�����륨��ȥ��');
define($constpref.'_ARCB_FETCHED','�ڤ�ȴ����ư������������ʼ������١�����');
define($constpref.'_ARCB_FETCHEDDSC','����ȥ���ڤ�ȴ���Ȥ�����¸���������鲿���Ǻ�����뤫����ꤷ�ޤ�����ư������ʤ�����0����ꤷ�ޤ����ޤ��������Ȥ�ϥ��饤��°�����Ĥ��������ȤϺ������ޤ��󡣤����ƺ����������ڤ�ȴ��������������Ū�˺�����Ƥ���������');
define($constpref.'_INTERNALENC','�������󥳡��ǥ���');
define($constpref.'_CSS_URI','�⥸�塼����CSS��URI');
define($constpref.'_CSS_URIDSC','���Υ⥸�塼�����Ѥ�CSS�ե������URI�����Хѥ��ޤ������Хѥ��ǻ��ꤷ�ޤ����ǥե���Ȥ�{mod_url}/index.php?page=main_css�Ǥ���');
define($constpref.'_IMAGES_DIR','���᡼���ե�����ǥ��쥯�ȥ�');
define($constpref.'_IMAGES_DIRDSC','���Υ⥸�塼���ѤΥ��᡼������Ǽ���줿�ǥ��쥯�ȥ��⥸�塼��ǥ��쥯�ȥ꤫������Хѥ��ǻ��ꤷ�ޤ����ǥե���Ȥ�images�Ǥ���');
define($constpref.'_COM_DIRNAME','���������礹��d3forum��dirname');
define($constpref.'_COM_FORUM_ID','���������礹��ե��������ֹ�');

}


?>