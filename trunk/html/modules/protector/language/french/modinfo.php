<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */
// Module Info

// The name of this module





// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:21
define('_MI_PROTECTOR_DISABLES','Disable dangerous features in XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:34
define('_MI_PROTECTOR_RELIABLE_IPS','Reliable IPs');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','set IPs you can rely separated with | . ^ matches the head of string, $ matches the tail of string.');
define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define('_MI_PROTECTOR_BF_COUNTDSC','Set count you allow guest try to login within 10 minutes. If someone fails to login more than this number, her/his IP will be banned.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','set the dirnames of the modules separated with |. This option will be useful with chatting module etc.');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-31 12:07:31
define('_MI_PROTECTOR_PREFIXMANAGER','Prefix Manager');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-05 07:09:09
define('_MI_PROTECTOR_GLOBAL_DISBL','Temporairement d�sactiv�');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Toutes les protections sont provisoirement neutralis�es<br />Ne pas oublier de remettre � off apr�s r�paration des probl�mes');
define('_MI_PROTECTOR_LOG_LEVEL','Niveau de log');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','non');
define('_MI_PROTECTOR_LOGLEVEL15','L�ger');
define('_MI_PROTECTOR_LOGLEVEL63','leger');
define('_MI_PROTECTOR_LOGLEVEL255','Complet');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-18 18:41:12
define('_MI_PROTECTOR_DOSOPT_HTA','DENY par .htaccess(Exp�rimental)');

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Module pour prot�ger XOOPS contre des attaques mal intentionn�s, sp�cialement les attaques comme DoS, SQL Injection et plusieurs autres infections.<br/>Pour utiliser ce bloc correctement, vous devez le mettre dans la limite des blocs gauches dans toutes les pages.<br/>Vous ne devez pas oubliez de ne pas donner l'autorisation d'acc�s � ce bloc au groupe d'Utilisateurs Anonymes.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Pour utiliser ce bloquer correctement, Vous devez le mettre dans la limite des blocs gauches dans toutes les pages.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Centre de protection");
define("_MI_PROTECTOR_ADVISORY","Manuel de s�curit�");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Administration des blocs/groupes");

// Configs
define('_MI_PROTECTOR_HIJACK_DENYGP','IP rejet� de groupes naviguant en session ');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti d�tournement de session :<br />Choisissez le(s) groupe(s) qui est(sont) rejet�(s) pour naviguer avec leur IP en session. <br />(Je recommande l\'administrateur � oui .)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Sanitizing null-bytes');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Le caract�re de terminaison "\\0" est employ� souvent dans des attaques malveillantes. <br />(fortement recommand� � oui)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Sortez si des bytes nuls sont trouv�s ');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Le caract�re de terminaison "\\0" est employ� souvent dans des attaques malveillantes. <br />(fortement recommand� � oui)');
define("_MI_PROTECTOR_DIE_BADEXT","Fermeture de session en cas d'upload avec extensions interdites");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Quand on fera des uploads avec des extensions interdites, comme .php, on effacera la session. (Non recommand� si assistants archives.php � travers B-Wiki ou PukiWikiMod fr�quentement.)");
define('_MI_PROTECTOR_CONTAMI_ACTION','Action si une contamination est trouv�e ');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Choisissez l\'action quand quelqu\'un essaye de contaminer des variables globales du syst�me dans XOOPS. <br />(option recommend�e est �cran vide)');
define('_MI_PROTECTOR_ISOCOM_ACTION','L\'action de commentaires isol�s est trouv�e ');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti injection de SQL :<br />S�lectionner l\'action quand "/*" est trouv�.<br />"Sanitizing" avec d\'autres "*/" � la suite.<br />(option recommend� est "Sanitizing")');
define('_MI_PROTECTOR_UNION_ACTION','Action si une UNION est trouv�e ');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti injection de SQL :<br />Choisissez l\'action quand il y a syntaxe d\'UNION de SQL. <br />"Sanitizing" en changeant "union" en "uni-on".<br />(option recommend�e est "Sanitizing)"');
define("_MI_PROTECTOR_ID_INTVAL","Transformation forc�e (intval) de variables ID");
define("_MI_PROTECTOR_ID_INTVALDSC","La valeur de variable doit toujours �tre un nombre. Efficace sp�cialement avec des modules d�riv�s de myLinks, il prot�ge aussi contre certains XSS et SQL injection. De temps en temps, il peut y avoir des conflicts avec quelques modules.");
define('_MI_PROTECTOR_FILE_DOTDOT','Patcher les fichier avec sp�cifications douteuses');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Elimination de � .. � de toutes les demandes de fichiers ');

define("_MI_PROTECTOR_DOS_EXPIRE","Temps de r�action aux attaques DoS (secondes)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Quantit� de temps pour v�rifier la fr�quence d'acc�s de crawlers qui ex�cutent DoS et pollutions.");

define('_MI_PROTECTOR_DOS_F5COUNT','Nombre de fois pour qu \'il soit reconnu comme attaque F5 ');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','D�fense contre des attaques DoS :<br/>Dans le temps de surveillance d�fini plus haut et le nombre de fois ici d�fini, quand il y aura beaucoup d\'acc�s � une seule URL, sera reconnus comme une attaque.');
define('_MI_PROTECTOR_DOS_F5ACTION','Mesures contre des attaques F5');

define('_MI_PROTECTOR_DOS_CRCOUNT','Nombre de fois pour qu\'un crawler soit reconnu comme malicieux');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','D�fense contre des crawlers malicieux (comme bots chasseurs d\'e-mails):<br/>Dans le temps de surveillance d�fini en haut et le nombre de fois d�fini ici, quand ils seront �tablis, il sera reconnu comme crawler malicieux.');
define('_MI_PROTECTOR_DOS_CRACTION','Mesures contre des crawlers malicieux');

define('_MI_PROTECTOR_DOS_CRSAFE','User-Agent autoris�s');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Il est inconditionnel, ce pourquoi vous devez inscrire les noms des crawlers fr�quents autoris�s<br />Ex.:) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_OPT_NONE','Non (seulement dans le log)');
define('_MI_PROTECTOR_OPT_SAN','Sanitizing');
define('_MI_PROTECTOR_OPT_EXIT','�cran vide');
define('_MI_PROTECTOR_OPT_BIP','Bannir l\'IP');

define('_MI_PROTECTOR_DOSOPT_NONE','Non (seulement dans le log)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Ne rien faire');
define('_MI_PROTECTOR_DOSOPT_EXIT','Fermer');
define('_MI_PROTECTOR_DOSOPT_BIP','Bannir l\'ip');

define("_MI_PROTECTOR_BIP_EXCEPT","Groupes dont l'ip ne sera jamais bannis");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Les membres des goupes s�lectionn�s ne seront jamais bannis, sauf si ils surfs annonymements(selection du groupe administrateur recommand�)");
define('_MI_PROTECTOR_PATCH2092','Patch sp�cifique pour Xoops <= 2.0.9.2');
define('_MI_PROTECTOR_PASSWD_BIP','Mot de passe de secours (d�sactiver un bannissement)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Si pour une raison ou une autre votre IP est bannie.<br />Acc�der au site XOOPS_URL/modules/protector/admin/rescue.php, et entrez le mot de passe d�fini ici.<br />N\'oubliez pas de d�finir un mot de passe, car le script d\'annulation de bannissement ne fonctionnerait pas');
?>