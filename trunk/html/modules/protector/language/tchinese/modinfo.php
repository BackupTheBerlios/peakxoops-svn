<?php// �c�餤��ơGhttp://www.cyai.net/ UTF-8���媩�Ш쥻�����U��



// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_MI_PROTECTOR_HIJACK_TOPBIT','Protected IP bits for the session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (All bits are protected)<br />When your IP is not stable, set the IP range by number of the bits.<br />(eg) If your IP can move in the range of 192.168.0.0-192.168.0.255, set 24(bit) here');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:20
define('_MI_PROTECTOR_DISABLES','Disable dangerous features in XOOPS');

// The name of this moduledefine("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","�o�ҲիO�@�A������������(DoS attack)�������A<br />�D�n�HDoS,SQL Injection���ܼƷP�V�����@<br />�n���Ī��Q�Φ��Ҳթ�m�b�|�X�{�����W��϶��A�ƧǧǸ������u���A�çO�ѰO�n�}��X�Ȧ�Ū�����϶��v�O�C");

// Names of blocks for this module (Not all module has blocks)
// define("_MI_PROTECTOR_BNAME1","Protector");
// define("_MI_PROTECTOR_BDESC1","�n���Ī��Q�Φ��Ҳթ�m�b�|�X�{�����W��϶��A�ƧǧǸ������u�� (0)");

// Menu
define("_MI_PROTECTOR_ADMININDEX","���@����");
define('_MI_PROTECTOR_ADVISORY','�w�������p���@');
define('_MI_PROTECTOR_PREFIXMANAGER','���e�m�޲z');

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','�{�ɤ��_���m');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','���F�ܧ󥲶��N���m�Ȯɰ���<br />�@�����D�ѨM��Ф��n�ѰO�Ѱ������ءA�H�K�������@���ġC');
define('_MI_PROTECTOR_RELIABLE_IPS','�i�H�Ϊ�IP');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','����DoS�����˴���IP�s�աA�H | �ӰϹj���PIP�C ^ �N��_�Y�A $ �N�����C');
define('_MI_PROTECTOR_LOG_LEVEL','��������');
define('_MI_PROTECTOR_LOG_LEVELDSC','��ܭn�O�d����(LOG)�����šA<br />����������θ��C���ť����`�N��Ʈw�Q�{�ɶ�Ӧh��ƦӲ��͸�Ʈw������D�C');
define('_MI_PROTECTOR_LOGLEVEL0','����������');
define('_MI_PROTECTOR_LOGLEVEL15','�ȵ����M�I�ʰ�������');
define('_MI_PROTECTOR_LOGLEVEL63','���������L�M�I�ʪ����@����');
define('_MI_PROTECTOR_LOGLEVEL255','��������');
define('_MI_PROTECTOR_HIJACK_DENYGP','IP�ܰʸT��s��');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','����session�Q�T���ﵦ�G<br />�T��Psession�����PIP���^���s�ի��w<br />�]��ĳ��޲z�s�ն}�Ҧ����^');
define('_MI_PROTECTOR_SAN_NULLBYTE','�H�ťմ��N�L�Ĥ��r��');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','��r�ꪺ�c�N���� "\0" <br />�N�����`�L�Ī��r���۰ʥH�ťըӴ��N<br />(��ĳ�}�Ҧ�����)');
define('_MI_PROTECTOR_DIE_NULLBYTE','�o�{�L�Ĥ�r�C�ɱj��פ�');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','�D���r�ꪺ�c�N���� "\0" �ɱj��פ�<br />(��ĳ�}�Ҧ�����)');
define('_MI_PROTECTOR_DIE_BADEXT','�j��פ�i�H��檺�ɮפW��');
define('_MI_PROTECTOR_DIE_BADEXTDSC','���ɦW��PHP�����ɮץi�H�b���A���W��������W���ɮ׮ɱj��פ�C<br />�p�G������������ B-Wiki �άO PukiWikiMod ���|�ɱ`�ϥΨ�PHP�ɮת��[�ɡA�г]�w��OFF');
define('_MI_PROTECTOR_CONTAMI_ACTION','�o�{�ܼƦìV�ɪ��B�z');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','���o�{��gXOOPS����t�ήɪ��B�z�覡<br />(�w�]�Ȭ��j��פ�)');
define('_MI_PROTECTOR_ISOCOM_ACTION','�o�{�t��comment�����ɪ��B�z');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','SQL�`�J�ﵦ�G<br />��o�{�t�� "/*" �ɪ��B�z�覡<br />�L�`�Ƥ覡�G�̫��۰ʥ[�W "*/" �ﵦ<br />(��ĳ�Q�εL�`�Ƥ覡)');
define('_MI_PROTECTOR_UNION_ACTION','�o�{ UNION ���B�z�覡');
define('_MI_PROTECTOR_UNION_ACTIONDSC','SQL�`�J�ﵦ�G<br />��SQL���o�{UNION�c��ɪ��B�z�覡<br />�L�`�Ƥ覡�G�NUNION�۰ʧאּuni-on<br />(��ĳ�Q�εL�`�Ƥ覡)');
define('_MI_PROTECTOR_ID_INTVAL','ID�ܼƱj���ܴ�');
define('_MI_PROTECTOR_ID_INTVALDSC','�`�N�I�o�ӿﶵ�p�G�}�ҥi��|�ɭP�������ҲյL�k���`�B�@');
define('_MI_PROTECTOR_FILE_DOTDOT','�i���ɮ׫��w���T��');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','���ɮץi�H�P�_����r�C�̱N�ư�".."���Φ������C');

define('_MI_PROTECTOR_BF_COUNT','�ɤO�ѱK�ﵦ');
define('_MI_PROTECTOR_BF_COUNTDSC','Brute Force Attack�O�@�اQ�ΩҦ��r��ѱK���覡�C�b10���������p�G�W�L�o�̩ҳ]�w�����Ƶn�J���Ѫ��ܡA�N�|�۰ʧ��IP�n�O��T��IP�椺�C');
define('_MI_PROTECTOR_DOS_SKIPMODS','�Ѱ�DoS�ʵ����Ҳ�');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','�i�H�]�w���Q�n�Q�ʵ����ҲաA�H�ӼҲո�Ƨ��W�ٳ]�w�A�Q�� | �ӰϹj�A�o�Ӷ��جO���F����Ҧp��ѼҲդ����A�e���Q�~�������Ҳըϥ�');

define('_MI_PROTECTOR_DOS_EXPIRE','DoS���ʵ��ɶ� (��)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','DoS���Ƨ�s�W�v�l�ܺʵ����ɶ��]�w');

define('_MI_PROTECTOR_DOS_F5COUNT','F5(���s��z)�覡�I���{�i�w������');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','�bDoS���������m�W<br />�p�G����ҳ]�w���ɶ�����o�Ӧ��ƥH�W�Ӧ۬ۦPurl�ɱN���|�Q�{�w�������欰�C');
define('_MI_PROTECTOR_DOS_F5ACTION','�w��Q��F5���ﵦ');

define('_MI_PROTECTOR_DOS_CRCOUNT','���Crawler�����}�p��');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','�t�����}Crawler�]�Ҧp���ζl���}�^���ﵦ<br />�ھڤW���]�w���ʵ��ɶ��H���A�b�o�Ӧ��ƥH�W����������ʮɳ������t�����}��Crawler');
define('_MI_PROTECTOR_DOS_CRACTION','�w�藍�}Crawler���ﵦ');

define('_MI_PROTECTOR_DOS_CRSAFE','���ڵ��� User-Agent');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','�L����\��Agent�W�A�H���Wperl���覡��J�C<br />�Ҧp�G /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','�L (���^��log)');
define('_MI_PROTECTOR_OPT_SAN','�L�`��');
define('_MI_PROTECTOR_OPT_EXIT','�j��פ�');
define('_MI_PROTECTOR_OPT_BIP','�n�O���T��IP');

define('_MI_PROTECTOR_DOSOPT_NONE','�L (�u�^��log)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Sleep');
define('_MI_PROTECTOR_DOSOPT_EXIT','exit');
define('_MI_PROTECTOR_DOSOPT_BIP','�T��IP�۰ʵn��');
define('_MI_PROTECTOR_DOSOPT_HTA','�b.htaccess�̵n�ODENY(�ثe�����թʽ�)');

define('_MI_PROTECTOR_BIP_EXCEPT','�T��IP�n�O���O�@�s��');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','�b�o�̩ҿ�w���s�ձN���|�Q�n�O��IP�T��A���L�p�G�O���n�J���A���U�A�o�ӫO�@�N�O�h�l���F�C');
define('_MI_PROTECTOR_PATCH2092','Xoops2.0.9.2�s�b���|�}�׸�');
define('_MI_PROTECTOR_PASSWD_BIP','�ϴ��K�X');
define('_MI_PROTECTOR_PASSWD_BIPDSC','���p������]���z�ۤv�]�Q�n�O��ip�T��W�椺�ɪ����ﵦ�覡�C<br />��ɥu�n�s���� XOOPS_URL/modules/protector/admin/rescue.php ��J�o�̩ҳ]���K�X�Y�i�C<br />�p�G�b�����]�m�K�X�N�L�k�Ұʱϴ�����A�ٽЯS�O�`�N�I');

?>