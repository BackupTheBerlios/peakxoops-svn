<?php
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","���դ��빶�⤫��XOOPS���뤿��Υ⥸�塼��<br />DoS,SQL Injection,�ѿ������Ȥ��ä���������ɤ��ޤ���");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","���Υ֥�å������Ū�����Ѥ��뤿��ˤϡ����٤ƤΥڡ����Ǻ������ɤ�ɽ������褦�ˤ���ɽ��ͥ���̤���ֹ⤯���¤ӽ�ο�����Ǿ��ˤ��ޤ�");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Protect Center");
define("_MI_PROTECTOR_ADVISORY","�������ƥ�������");
define("_MI_PROTECTOR_PREFIXMANAGER","PREFIX �ޥ͡�����");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','ư��ΰ��Ū����');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','�������ɸ�ư�����Ū��̵�������ޤ���<br />���꤬��褵�줿��̵�����������뤳�Ȥ�˺��ʤ�');
define('_MI_PROTECTOR_RELIABLE_IPS','���ѤǤ���IP');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','DoS���ι��⸡�Τ�Ԥ�ʤ���IP���ɥ쥹��| �Ƕ��ڤäƵ��Ҥ��ޤ���^����Ƭ��$��������ɽ���ޤ���');
define('_MI_PROTECTOR_LOG_LEVEL','����٥�');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','�����ϰ��ڤʤ�');
define('_MI_PROTECTOR_LOGLEVEL15','�����ι⤤��Τ���������');
define('_MI_PROTECTOR_LOGLEVEL63','�������㤤��Τϥ����ʤ�');
define('_MI_PROTECTOR_LOGLEVEL255','������Υ��󥰤�ͭ���Ȥ���');

define('_MI_PROTECTOR_HIJACK_DENYGP','IP��ư��ػߤ��륰�롼��');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','���å����ϥ�����å��к���<br />���å������˰ۤʤ�IP���ɥ쥹����Υ���������ػߤ��륰�롼�פ���ꤷ�ޤ�<br />�ʴ����ԤˤĤ���ON�ˤ��뤳�Ȥ򤪴��ᤷ�ޤ���');
define('_MI_PROTECTOR_SAN_NULLBYTE','�̥�ʸ����򥹥ڡ������ѹ�����');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','ʸ����λ����饯�����Ǥ��� "\\0" �ϡ����դ��빶������Ѥ���ޤ���<br />����򸫤Ĥ��������ǥ��ڡ����˽񤭴����ޤ�<br />��ON��������Ǥ���');
define('_MI_PROTECTOR_DIE_NULLBYTE','�̥�ʸ����򸫤Ĥ��������Ǥζ�����λ');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','ʸ����λ����饯�����Ǥ��� "\\0" �ϡ����դ��빶������Ѥ���ޤ���<br />��ON��������Ǥ���');
define('_MI_PROTECTOR_DIE_BADEXT','�¹Բ�ǽ�ե����륢�åץ��ɤˤ�붯����λ');
define('_MI_PROTECTOR_DIE_BADEXTDSC','��ĥ�Ҥ�.php�ʤɡ������о�Ǽ¹Բ�ǽ�Ȥʤꤨ��ե����뤬���åץ��ɤ��줿���˶�����λ���ޤ���<br />B-Wiki��PukiWikiMod�򤪻Ȥ��ǡ����ˤ�PHP�������ե������ź�դ������ϡ�OFF�ˤ��Ʋ�����');
define('_MI_PROTECTOR_CONTAMI_ACTION','�ѿ����������Ĥ��ä����ν���');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','XOOPS�Υ����ƥ॰���Х���񤭤��褦�Ȥ��빶��򸫤Ĥ������ν��������򤷤ޤ���<br />�ʽ���ͤϡֶ�����λ�ס�');
define('_MI_PROTECTOR_ISOCOM_ACTION','��Ω�����Ȥ����Ĥ��ä����ν���');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','SQL���󥸥���������к���<br />�ڥ��ˤʤ�*/�Τʤ�/*�򸫤Ĥ������ν�������ޤ���<br />̵������ˡ���Ǹ�� */ ��Ĥ��ޤ�<br />��̵�����פ�������Ǥ�');
define('_MI_PROTECTOR_UNION_ACTION','UNION�����Ĥ��ä����ν���');
define('_MI_PROTECTOR_UNION_ACTIONDSC','SQL���󥸥���������к���<br />SQL��UNION��ʸ�򸡽Ф������ν�������ޤ���<br />̵������ˡ��UNION �� uni-on �Ȥ��ޤ�<br />��̵�����פ�������Ǥ�');
define('_MI_PROTECTOR_ID_INTVAL','ID���ѿ��ζ����Ѵ�');
define('_MI_PROTECTOR_ID_INTVALDSC','�ѿ�̾��id�ǽ�����Τ򡢿������ȶ���ǧ�������ޤ���myLinks�����⥸�塼����ä�ͭ���ǡ�XSS�ʤɤ��ɤ��ޤ����������Υ⥸�塼���ư�����ɤθ����Ȥʤ��ǽ��������ޤ���');
define('_MI_PROTECTOR_FILE_DOTDOT','DirectoryTraversal�ζػ�');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','DirectoryTraversal���ߤƤ����Ƚ�Ǥ��줿�ꥯ������ʸ���󤫤顢".." �Ȥ����ѥ������������ޤ�');

define('_MI_PROTECTOR_BF_COUNT','Brute Force�к�');
define('_MI_PROTECTOR_BF_COUNTDSC','�ѥ��������������й����ޤ���10ʬ���桢�����ǻ��ꤷ������ʾ塢������˼��Ԥ���ȡ�����IP����ݤ��ޤ���');

define('_MI_PROTECTOR_DOS_SKIPMODS','DoS�ƻ���оݤ��鳰���⥸�塼��');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','���������⥸�塼���dirname��|�Ƕ��ڤä����Ϥ��Ƥ�������������åȷϥ⥸�塼��ʤɤ�ͭ���Ǥ�');

define('_MI_PROTECTOR_DOS_EXPIRE','DoS���δƻ���� (��)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','DoS�䰭�դ��륯���顼�Υ����������٤��ɤ�����δƻ�ñ�̻���');

define('_MI_PROTECTOR_DOS_F5COUNT','F5�����å��ȸ��ʤ����');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','DoS������ɸ�<br />������ꤷ���ƻ������ˡ����β���ʾ塢Ʊ��URI�ؤΥ������������ä��顢���⤵�줿�ȸ��ʤ��ޤ�');
define('_MI_PROTECTOR_DOS_F5ACTION','F5�����å��ؤ��н�');

define('_MI_PROTECTOR_DOS_CRCOUNT','���դ��륯���顼�ȸ��ʤ����');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','���դ��륯���顼�ʥᥢ�ɼ����ܥå����ˤؤ��к�<br />������ꤷ���ƻ������ˡ����β���ʾ塢��������򤵤��ä��顢���դ��륯���顼�ȸ��ʤ��ޤ�');
define('_MI_PROTECTOR_DOS_CRACTION','���դ��륯���顼�ؤ��н�');

define('_MI_PROTECTOR_DOS_CRSAFE','���ݤ��ʤ� User-Agent');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','̵���ǥ�������Ĥ��륨���������̾��perl������ɽ���ǵ��Ҥ��ޤ�<br />��) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','�ʤ� (���Τ߼��)');
define('_MI_PROTECTOR_OPT_SAN','̵����');
define('_MI_PROTECTOR_OPT_EXIT','������λ');
define('_MI_PROTECTOR_OPT_BIP','����IP��Ͽ');

define('_MI_PROTECTOR_DOSOPT_NONE','�ʤ� (���Τ߼��)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep(��侩)');
define('_MI_PROTECTOR_DOSOPT_EXIT','exit');
define('_MI_PROTECTOR_DOSOPT_BIP','����IP�ꥹ�Ȥ˺ܤ���');
define('_MI_PROTECTOR_DOSOPT_HTA','.htaccess��DENY��Ͽ(�Ū����)');

define('_MI_PROTECTOR_BIP_EXCEPT','����IP��Ͽ���ݸ�롼��');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','�����ǻ��ꤵ�줿�桼��������Υ��������ϡ������������Ƥ��ޤäƤ⡢����IP�Ȥ�����Ͽ����ޤ��󡣤����������Υ桼�����������󤷤Ƥ��ʤ��Ȱ�̣������ޤ���Τǡ�����ղ�������');
define('_MI_PROTECTOR_PATCH2092','Xoops 2.0.9.2�ʲ���¸�ߤ����ؤΥѥå�');
define('_MI_PROTECTOR_PASSWD_BIP','�쥹���塼�ѥ����');
define('_MI_PROTECTOR_PASSWD_BIPDSC','�⤷�����餫����ͳ�ǡ����ʤ����Ȥ�XOOPS��IP���ݤ���Ƥ��ޤä����εߺѼ��ʤ��󶡤��ޤ���<br /> XOOPS_URL/modules/protector/admin/rescue.php �˥����������ơ������ǻ��ꤷ���ѥ���ɤ����Ϥ��Ʋ�������<br />�����ǥѥ���ɤ����ꤵ��Ƥ��ʤ��ȡ��쥹���塼��ǽ���Τ�̵���ˤʤ�ޤ��ΤǤ���ղ�������<br />���Υѥ���ɤ�ʿʸ����¸����ޤ��Τǡ�����������Ƥ��ɤ��褦�����ʤ��ν��פʥѥ���ɤ�Ʊ��ˤϤ��ʤ��ǲ�������');

?>
