<?php

// index.php
define("_AM_TH_DATETIME","�����");
define("_AM_TH_USER","������������");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","User-Agent");
define("_AM_TH_TYPE","���");
define("_AM_TH_DESCRIPTION","��������");

define( "_AM_TH_BADIPS" , "����������� IP" ) ;
define( "_AM_TH_ENABLEIPBANS" , "�������� �������� ����� �� IP?" ) ;

define( "_AM_LABEL_REMOVE" , "������� ��������� ������:" ) ;
define( "_AM_BUTTON_REMOVE" , "�������" ) ;
define( "_AM_JS_REMOVECONFIRM" , "�������?" ) ;
define( "_AM_MSG_PRUPDATED" , "��������� ������� ���������!" ) ;
define( "_AM_MSG_REMOVED" , "������ �������" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "���������� ��������� ������" ) ;
define( "_AM_MSG_DBUPDATED" , "���� ������ ������� ���������!" ) ;
define( "_AM_CONFIRM_DELETE" , "��� ������ ����� ����������. ����������?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "���� �� ������ �������� ������ ������, �������������� ��� ���������������� ���� %s/mainfile.php ������� ����� ��������� � ������ �������� ����.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","���� �� �������");

define("_AM_ADV_REGISTERGLOBALS","������� ������������ ��������� ��������� ����� ������ ���� � ���������� �������� ����������.<br />���� �� ������ ������ � ����� .htaccess �������� ��� ��� �������������� ���� ���� ������� � ���� ������ �������� ����.");
define("_AM_ADV_ALLOWURLFOPEN","������� ������������ ��������� ��������� ��������� ������������ ������� �� ��������� �������.<br />������ ������������� ������� ����� �������� ��� �����.<br />���� �� ��������� ��������������� �������������� ���� php.ini ��� httpd.conf.<br /><b>������ ��� httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />��� ��������� �� ���� ������ ��������������.");
define("_AM_ADV_USETRANSSID","ID ����� ������ ������������ � ����� ������ � ��.<br />
	�� ��������� ������������� ID ����� ������ �������� ������ �������� ��������� ������ � ��� ���� .htaccess ������������ � ��������: '".XOOPS_ROOT_PATH."'.<br /><b>php_flag session.use_trans_sid off</b>");
define("_AM_ADV_DBPREFIX","������� �������� �������� ������ �� ��������� ��������� ����� �.�. 'SQL Injecting' ����.<br />�� �������� �������� '�������������� ������� ���������� *' � ���������������� ������� ����� ������.");
define("_AM_ADV_LINK_TO_PREFIXMAN","������� � ������� ���������� ���������� ��.");
define("_AM_ADV_MAINUNPATCHED","�� ������ ��������������� ��� ���� mainfile.php ���, ��� ��� ������� � README.");
define("_AM_ADV_RESCUEPASSWORD","������ ��� ������ ���� � ������ IP");
define("_AM_ADV_RESCUEPASSWORDUNSET","�� ����������");
define("_AM_ADV_RESCUEPASSWORDSHORT","������� �������� (����������� ����� 6 ��������)");

define("_AM_ADV_SUBTITLECHECK","�������� �����������������");
define("_AM_ADV_AT1STSETPASSWORD","���������� ��� ��������� ������ ����� ���������.");
define("_AM_ADV_CHECKCONTAMI","����� ����������");
define("_AM_ADV_CHECKISOCOM","������������ �����������");



?>