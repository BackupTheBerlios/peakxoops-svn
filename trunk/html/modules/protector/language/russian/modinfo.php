<?php
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","������ XOOPS");

// A brief description of this module
define("_MI_PROTECTOR_DESC","���� ������ �������� ��� ���� �� ���� XOOPS �� ���������� ���� ����, ����� ���: DoS, SQL Injection � ����� ����������.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","This block should be put in top of left blocks and should be displayed against 'all pages'.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","�������");
define("_MI_PROTECTOR_ADVISORY","���������");
define("_MI_PROTECTOR_PREFIXMANAGER","���������� ��������� ��");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','�������� ��������');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','��� ������� ������ �������� ���������.<br />�� �������� �������� �� ����� ���������� ����� ������� � �������������.');
define('_MI_PROTECTOR_RELIABLE_IPS','���������� ������');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','���������� ����� ��� ������ ��� ������� �������� ������������ �� ����������. ���������� ������ ����� ������ "|". "^" ������������� ������ ������, "$" ������������� ����� ������.');
define('_MI_PROTECTOR_LOG_LEVEL','������ �������');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','������ ��������');
define('_MI_PROTECTOR_LOGLEVEL15','������� �������');
define('_MI_PROTECTOR_LOGLEVEL63','������� �������');
define('_MI_PROTECTOR_LOGLEVEL255','��� �������');

define('_MI_PROTECTOR_HIJACK_TOPBIT','Protected IP bits for the session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (All bits are protected)<br />When your IP is not stable, set the IP range by number of the bits.<br />(eg) If your IP can move in the range of 192.168.0.0-192.168.0.255, set 24(bit) here');
define('_MI_PROTECTOR_HIJACK_DENYGP','������ ��� ������� ��������� ������ � ������ ����� ������ ���������');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','������� � ������������ ������:<br />
	�������� ������ ��� ������� ����� � �������� ����� ������ ���������.<br />
	(������������� ������ �������� � ������ ����� ������ ��������������� �����.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','�������� ������ � ������� �����');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','
	����������� ������ "\\0" ����� ������������ � ��������� ����� ����.<br />
	���� ������ ����� ������� �� ������.<br />(������������� ������ �������� ������ ���������)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Exit if null bytes are found');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','The terminating character "\\0" is often used in malicious attacks.<br />(highly recommended as On)');
define('_MI_PROTECTOR_DIE_BADEXT','�������� ���������� ��� �������� �������� �����');
define('_MI_PROTECTOR_DIE_BADEXTDSC','
	� ������ ����� ���-���� ���������� ��������� �� ���� ���� ������� ������� ���������� (�������� .php) - �������� �������� ����� ��������. ���� ��� ����� ���������� ��������� ����� ����� (�������� ��� ������� B-Wiki ��� PukiWikiMod) - ��������� ������ ��������.');
define('_MI_PROTECTOR_CONTAMI_ACTION','�������� ��� ����������� "�������" ����������');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','
	�������� �������� ����������� � ������ ����� ���-���� �������� �������� ������ ������� "�������" ��������� ���������� XOOPS. (�������������: ������ �����)');
define('_MI_PROTECTOR_ISOCOM_ACTION','�������� ��� ����������� �������������� �����������.');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','
	�������� �������� ����������� ��� ����������� ������ "/*" ��� ������������.<br />"�������" ������������� ���������� ������������ �������� "*/".<br />(�������������: ��������)');
define('_MI_PROTECTOR_UNION_ACTION','�������� ��� ����������� ��������� ����� UNION');
define('_MI_PROTECTOR_UNION_ACTIONDSC','
	�������� �������� ����������� ��� ����������� ��������� ����� UNION. "�������" ������������ ��������� ���� ��������� ������� ����� "UNI-ON". (�������������: ��������)');
define('_MI_PROTECTOR_ID_INTVAL','�������������� �������������� ������������ ���������� (�������� id).');
define('_MI_PROTECTOR_ID_INTVALDSC','
	��� ������� ����: "*id" ����� ���������� ��� ����� �����.<br />���� �������� �������� ��� �� ��������� ����� XSS � SQL Injections ����.<br />
	������������� �������� ���� �������� � ��������� ������ ��� ������������� ������� � ������������� �����-���� �������.');
define('_MI_PROTECTOR_FILE_DOTDOT','������ �� Directroy Traversals');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','������� ��� ��������� ������������������ ".." �� ���� �������� ���������� ��� Directory Traversals');

define('_MI_PROTECTOR_BF_COUNT','������ �� ������� ������');
define('_MI_PROTECTOR_BF_COUNTDSC','���������� ������������ ���������� ������� ����� ������������ �� 10 �����. � ������ ���� ���-���� ���������� ������������ ������� ��� ������� ���������� ��� - ��� ����� ����� ������� � ������ ������.');

define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','������� ����� ��������� ����������� �������� "|" ��� ������� � ������� ����� ��������� DoS/Crawler ������. ���� �������� � ��������� ������ �������� � ������� ���� � ������ ������� ��� ������� ������ ��������� � ���������� ������� �������� ������.');

define('_MI_PROTECTOR_DOS_EXPIRE','����� �������� ��� ����������� ������� �������� (���)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','������ �������� ��������� ����� �������� �� ��������� �������� �������� �������� ("����� F5" � ������ ������������� ������)');

define('_MI_PROTECTOR_DOS_F5COUNT','������� ��� "����� F5"');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','�������� �� DoS ����.<br />
	��� �������� ��������� ���������� �������� �������� ���������� �������� �� ������������ ����� ����� �������� ������������ ��� �������������� �����.');
define('_MI_PROTECTOR_DOS_F5ACTION','�������� ��� ����������� ������� ���������� �������');

define('_MI_PROTECTOR_DOS_CRCOUNT','������� ��� �������');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','������������� ������� �������� ������� �������� ��������� ������. �������� �������� ������ ���������� �������� ���������� �������� �� ������������ ����� ����� �������� ������������ ��� ��������� "������������" �������');
define('_MI_PROTECTOR_DOS_CRACTION','�������� ��� ����������� "������" �������.');

define('_MI_PROTECTOR_DOS_CRSAFE','������ ������������ (User-Agent) �� ������������ ��� "������"');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','���������� ��������� perl ��� ���� ������ ������������ (User-Agent).<br />� ������ ���������� ������ ���������� � �������� ���������� - ����� ������� �� ������������ ��� "������".<br />������: /(msnbot|Googlebot|Yandex|Yahoo! Slurp|StackRambler)/i');

define('_MI_PROTECTOR_OPT_NONE','������ (������ ������ � �������)');
define('_MI_PROTECTOR_OPT_SAN','�������');
define('_MI_PROTECTOR_OPT_EXIT','������ �����');
define('_MI_PROTECTOR_OPT_BIP','�������� ����� � ������ ������');

define('_MI_PROTECTOR_DOSOPT_NONE','������ (������ ������ � �������)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','�������');
define('_MI_PROTECTOR_DOSOPT_EXIT','������ �����');
define('_MI_PROTECTOR_DOSOPT_BIP','�������� ����� � ������ ������');
define('_MI_PROTECTOR_DOSOPT_HTA','��������� ������ ��������� .htaccess (����������������)');

define('_MI_PROTECTOR_BIP_EXCEPT','����� ������������� ������� �� ���������� � ������ ������.');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','������������� ������ ��������� � ���� ������ ������ ��������������� �����.');
define('_MI_PROTECTOR_DISABLES','������������� ������������ ������� ������� XOOPS');
define('_MI_PROTECTOR_PASSWD_BIP','�������� ������ ��� �������� ������ ������ �� ������� ������');
define('_MI_PROTECTOR_PATCH2092', "��������� ������ XOOPS 2.0.9.2");
define('_MI_PROTECTOR_PASSWD_BIPDSC','
	� ������ ���� ��� ����� ����� �������� � ������ ������ - ������� �� �������� XOOPS_URL/modules/protector/admin/rescue.php � ������� �������� ����� ������.<br />�� �������� ���������� ������ �� ���� ��� ������ �������� ��-�� �����-������ ������. :-).<br />���� ������ �� ���������� - ������ ������ ����� ��������.');

?>