<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'protector' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Xoops Protector");

// A brief description of this module
define($constpref."_DESC","���դ��빶�⤫��XOOPS���뤿��Υ⥸�塼��<br />DoS,SQL Injection,�ѿ������Ȥ��ä���������ɤ��ޤ���");

// Menu
define($constpref."_ADMININDEX","Protect Center");
define($constpref."_ADVISORY","�������ƥ�������");
define($constpref."_PREFIXMANAGER","PREFIX �ޥ͡�����");

// Configs
define($constpref.'_GLOBAL_DISBL','ư��ΰ��Ū����');
define($constpref.'_GLOBAL_DISBLDSC','�������ɸ�ư�����Ū��̵�������ޤ���<br />���꤬��褵�줿��̵�����������뤳�Ȥ�˺��ʤ�');

define($constpref.'_RELIABLE_IPS','���ѤǤ���IP');
define($constpref.'_RELIABLE_IPSDSC','DoS���ι��⸡�Τ�Ԥ�ʤ���IP���ɥ쥹��| �Ƕ��ڤäƵ��Ҥ��ޤ���^����Ƭ��$��������ɽ���ޤ���');

define($constpref.'_LOG_LEVEL','������٥�');
define($constpref.'_LOG_LEVELDSC','');

define($constpref.'_LOGLEVEL0','�������ϰ��ڤʤ�');
define($constpref.'_LOGLEVEL15','�������ι⤤��Τ�����������');
define($constpref.'_LOGLEVEL63','���������㤤��Τϥ������ʤ�');
define($constpref.'_LOGLEVEL255','������Υ����󥰤�ͭ���Ȥ���');

define($constpref.'_HIJACK_TOPBIT','���å������³�����ݸ�ӥå�');
define($constpref.'_HIJACK_TOPBITDSC','���å����ϥ�����å��к���<br />�̾��32(bit)�ǡ����ӥåȤ��ݸ�ޤ���<br />Proxy�����Ѥʤɤǡ������������IP���ɥ쥹���Ѥ����ˤϡ���ư���ʤ���Ĺ�Υӥåȿ�����ꤷ�ޤ���<br />�㤨�С�192.168.0.0��192.168.0.255����ư�����ǽ���������硢�����ˤ�24(bit)�Ȼ��ꤷ�ޤ���');
define($constpref.'_HIJACK_DENYGP','IP��ư��ػߤ��륰�롼��');
define($constpref.'_HIJACK_DENYGPDSC','���å����ϥ�����å��к���<br />���å������˰ۤʤ�IP���ɥ쥹�ϰϡʾ�ˤƥӥåȿ�����ˤ���Υ���������ػߤ��륰�롼�פ���ꤷ�ޤ�<br />�ʴ����ԤˤĤ���ON�ˤ��뤳�Ȥ򤪴��ᤷ�ޤ���');
define($constpref.'_SAN_NULLBYTE','�̥�ʸ����򥹥ڡ������ѹ�����');
define($constpref.'_SAN_NULLBYTEDSC','ʸ����λ����饯�����Ǥ��� "\\0" �ϡ����դ��빶������Ѥ���ޤ���<br />����򸫤Ĥ��������ǥ��ڡ����˽񤭴����ޤ�<br />��ON��������Ǥ���');
define($constpref.'_DIE_NULLBYTE','�̥�ʸ����򸫤Ĥ��������Ǥζ�����λ');
define($constpref.'_DIE_NULLBYTEDSC','ʸ����λ����饯�����Ǥ��� "\\0" �ϡ����դ��빶������Ѥ���ޤ���<br />��ON��������Ǥ���');
define($constpref.'_DIE_BADEXT','�¹Բ�ǽ�ե����륢�åץ����ɤˤ�붯����λ');
define($constpref.'_DIE_BADEXTDSC','��ĥ�Ҥ�.php�ʤɡ������о�Ǽ¹Բ�ǽ�Ȥʤꤨ��ե����뤬���åץ����ɤ��줿���˶�����λ���ޤ���<br />B-Wiki��PukiWikiMod�򤪻Ȥ��ǡ����ˤ�PHP�������ե������ź�դ������ϡ�OFF�ˤ��Ʋ�����');
define($constpref.'_CONTAMI_ACTION','�ѿ����������Ĥ��ä����ν���');
define($constpref.'_CONTAMI_ACTIONDS','XOOPS�Υ����ƥ॰�����Х���񤭤��褦�Ȥ��빶��򸫤Ĥ������ν��������򤷤ޤ���<br />�ʽ���ͤϡֶ�����λ�ס�');
define($constpref.'_ISOCOM_ACTION','��Ω�����Ȥ����Ĥ��ä����ν���');
define($constpref.'_ISOCOM_ACTIONDSC','SQL���󥸥���������к���<br />�ڥ��ˤʤ�*/�Τʤ�/*�򸫤Ĥ������ν�������ޤ���<br />̵������ˡ���Ǹ�� */ ��Ĥ��ޤ�<br />��̵�����פ�������Ǥ�');
define($constpref.'_UNION_ACTION','UNION�����Ĥ��ä����ν���');
define($constpref.'_UNION_ACTIONDSC','SQL���󥸥���������к���<br />SQL��UNION��ʸ�򸡽Ф������ν�������ޤ���<br />̵������ˡ��UNION �� uni-on �Ȥ��ޤ�<br />��̵�����פ�������Ǥ�');
define($constpref.'_ID_INTVAL','ID���ѿ��ζ����Ѵ�');
define($constpref.'_ID_INTVALDSC','�ѿ�̾��id�ǽ�����Τ򡢿������ȶ���ǧ�������ޤ���myLinks�����⥸�塼����ä�ͭ���ǡ�XSS�ʤɤ��ɤ��ޤ����������Υ⥸�塼���ư�����ɤθ����Ȥʤ��ǽ��������ޤ���');
define($constpref.'_FILE_DOTDOT','DirectoryTraversal�ζػ�');
define($constpref.'_FILE_DOTDOTDSC','DirectoryTraversal���ߤƤ����Ƚ�Ǥ��줿�ꥯ������ʸ���󤫤顢".." �Ȥ����ѥ������������ޤ�');

define($constpref.'_BF_COUNT','Brute Force�к�');
define($constpref.'_BF_COUNTDSC','�ѥ��������������й����ޤ���10ʬ���桢�����ǻ��ꤷ������ʾ塢��������˼��Ԥ���ȡ�����IP����ݤ��ޤ���');

define($constpref.'_DOS_SKIPMODS','DoS�ƻ���оݤ��鳰���⥸�塼��');
define($constpref.'_DOS_SKIPMODSDSC','���������⥸�塼���dirname��|�Ƕ��ڤä����Ϥ��Ƥ�������������åȷϥ⥸�塼��ʤɤ�ͭ���Ǥ�');

define($constpref.'_DOS_EXPIRE','DoS���δƻ���� (��)');
define($constpref.'_DOS_EXPIREDSC','DoS�䰭�դ��륯�����顼�Υ����������٤��ɤ�����δƻ�ñ�̻���');

define($constpref.'_DOS_F5COUNT','F5�����å��ȸ��ʤ����');
define($constpref.'_DOS_F5COUNTDSC','DoS������ɸ�<br />������ꤷ���ƻ������ˡ����β���ʾ塢Ʊ��URI�ؤΥ������������ä��顢���⤵�줿�ȸ��ʤ��ޤ�');
define($constpref.'_DOS_F5ACTION','F5�����å��ؤ��н�');

define($constpref.'_DOS_CRCOUNT','���դ��륯�����顼�ȸ��ʤ����');
define($constpref.'_DOS_CRCOUNTDSC','���դ��륯�����顼�ʥᥢ�ɼ����ܥå����ˤؤ��к�<br />������ꤷ���ƻ������ˡ����β���ʾ塢��������򤵤��ä��顢���դ��륯�����顼�ȸ��ʤ��ޤ�');
define($constpref.'_DOS_CRACTION','���դ��륯�����顼�ؤ��н�');

define($constpref.'_DOS_CRSAFE','���ݤ��ʤ� User-Agent');
define($constpref.'_DOS_CRSAFEDSC','̵���ǥ���������Ĥ��륨���������̾��perl������ɽ���ǵ��Ҥ��ޤ�<br />��) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define($constpref.'_OPT_NONE','�ʤ� (�����Τ߼��)');
define($constpref.'_OPT_SAN','̵����');
define($constpref.'_OPT_EXIT','������λ');
define($constpref.'_OPT_BIP','����IP��Ͽ');

define($constpref.'_DOSOPT_NONE','�ʤ� (�����Τ߼��)');
define($constpref.'_DOSOPT_SLEEP','Sleep(��侩)');
define($constpref.'_DOSOPT_EXIT','exit');
define($constpref.'_DOSOPT_BIP','����IP�ꥹ�Ȥ˺ܤ���');
define($constpref.'_DOSOPT_HTA','.htaccess��DENY��Ͽ(�Ū����)');

define($constpref.'_BIP_EXCEPT','����IP��Ͽ���ݸ�롼��');
define($constpref.'_BIP_EXCEPTDSC','�����ǻ��ꤵ�줿�桼��������Υ��������ϡ������������Ƥ��ޤäƤ⡢����IP�Ȥ�����Ͽ����ޤ��󡣤����������Υ桼�������������󤷤Ƥ��ʤ��Ȱ�̣������ޤ���Τǡ������ղ�������');

define($constpref.'_DISABLES','�����ʵ�ǽ��̵����');

define($constpref.'_BIGUMBRELLA','���礭�ʻ���anti-XSS��ͭ���ˤ���');
define($constpref.'_BIGUMBRELLADSC','�����ͭ���ˤ���С����ʤ�¿���Υѥ������XSS�ȼ����򥭥�󥻥뤹�뤳�Ȥ��Ǥ���Ǥ��礦����������100%�ǤϤ���ޤ���');

define($constpref.'_SPAMURI4U','SPAM�к�:���̥桼���˵���URL��');
define($constpref.'_SPAMURI4UDSC','�����԰ʳ��ΰ��̥桼����������Ƥˡ����ο��ʾ��URL�����ä���SPAM�ȸ��ʤ��ޤ���0�ʤ�̵���µ��ĤǤ���');
define($constpref.'_SPAMURI4G','SPAM�к�:�����Ȥ˵���URL��');
define($constpref.'_SPAMURI4GDSC','�����Ȥ�������Ƥˡ����ο��ʾ��URL�����ä���SPAM�ȸ��ʤ��ޤ���0�ʤ�̵���µ��ĤǤ���');


}

?>