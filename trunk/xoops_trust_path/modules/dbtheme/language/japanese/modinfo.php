<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'dbtheme' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","DB theme");

// A brief description of this module
define($constpref."_DESC","�������̾�ǥơ��ޤ��Խ��Ǥ���褦�ˤ���⥸�塼��");

// admin menus
define($constpref.'_ADMENU_MYTPLSADMIN','�ƥ�ץ졼�ȴ���') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','�֥��å�����/������������') ;
define($constpref.'_ADMENU_MYPREFERENCES','��������') ;

// blocks
define($constpref.'_BNAME_THEMEHOOK','�ơ��ޥեå��֥��å�') ;

// configs
define($constpref.'_BASETHEME','�١����ơ���') ;
define($constpref.'_BASETHEMEDSC','�١����Ȥʤ�ơ��ޤ��ѹ�������ˤϡ������˥ơ��ޥǥ��쥯�ȥ�̾�����ꤷ����ˡ��⥸�塼�륢�åץǡ��Ȥ򤫤��Ƥ���������') ;
define($constpref.'_CSSCACHETIME','CSS�Υ֥饦������å������(sec)') ;

}


?>