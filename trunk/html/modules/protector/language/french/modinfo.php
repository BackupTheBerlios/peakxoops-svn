<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */
// Module Info

// The name of this module

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Module pour prot&eacute;ger XOOPS contre des attaques mal intentionn&eacute;es, sp&eacute;cialement les attaques comme DoS, SQL Injection et plusieurs autres infections.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Pour utiliser ce bloc correctement, Vous devez le mettre comme premier bloc &agrave; gauche et l'afficher sur toutes les pages.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Centre de protection");
define("_MI_PROTECTOR_ADVISORY","Manuel de s&eacute;curit&eacute;");
define("_MI_PROTECTOR_PREFIXMANAGER","Gestionnaire de Pr&eacute;fixe");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','D&eacute;sactivation Temporaire ;');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Toutes les protections sont provisoirement neutralis&eacute;es<br />Ne pas oublier de remettre &agrave; off apr&egrave;s r&eacute;paration des probl&egrave;mes');
define('_MI_PROTECTOR_RELIABLE_IPS','IP fiables');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','Mettre des IP fiables s&eacute;par&eacute;es par |.<br /> ^ correspond au d&eacute;but de la cha&icirc;ne, $ correspond &agrave; la fin.');
define('_MI_PROTECTOR_LOG_LEVEL','Niveau de Log');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','Aucun Log');
define('_MI_PROTECTOR_LOGLEVEL15','Log L&eacute;ger');
define('_MI_PROTECTOR_LOGLEVEL63','Log Moyen');
define('_MI_PROTECTOR_LOGLEVEL255','Log Complet');

define("_MI_PROTECTOR_HIJACK_TOPBIT","Nbre de Bits de la Protection de la sesssion IP");
define("_MI_PROTECTOR_HIJACK_TOPBITDSC","Anti Session Hi-Jacking:<br />Par d&eacute;faut 32bits (tous les bits sont prot&eacute;g&eacute;s).<br />Quand votre adresse IP n'est pas fixe, fixer la rang&eacute;e d'adresses IP par le nombre de bits.<br />i.e. si votre adresse IP peut &eacute;voluer dans la rang&eacute;e  192.168.0.0 &agrave; 192.168.0.255, indiquez 24(bits) ici");
define("_MI_PROTECTOR_HIJACK_DENYGP","Groupes non autoris&eacute;s &agrave; modifier leur adresse IP au cours d'une session");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Anti d&eacute;tournement de session :<br />Choisissez le(s) groupe(s) pour qui il est interdit de modifier l'adresse IP au cours d'une session. <br />(Je recommande d'activer cette fonctionnalit&eacute; pour l'administrateur.)");
define('_MI_PROTECTOR_SAN_NULLBYTE','Sanitiser les bits nuls');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Le caract&egrave;re de terminaison "\\0" est employ&eacute; souvent dans des attaques malveillantes. <br />Un caract&egrave;re null sera remplac&eacute; par un espace.<br />(fortement recommand&eacute; &agrave; oui)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Ejecter si des bytes nuls sont trouv&eacute;s ');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Le caract&egrave;re de terminaison "\\0" est employ&eacute; souvent dans des attaques malveillantes. <br />(fortement recommand&eacute; &agrave; oui)');
define("_MI_PROTECTOR_DIE_BADEXT","Ejecter en cas d'upload avec extensions interdites");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Lors d'uploads avec des extensions interdites, comme .php, vous serez eject&eacute;.<br /> Mettez à OFF si vous attachez souvent des fichiers .php, comme par exemple dans B-Wiki ou PukiWikiMod.");
define('_MI_PROTECTOR_CONTAMI_ACTION','Action si une contamination est d&eacute;tect&eacute;e ');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','S&eacute;lectionner l\'action &agrave; effectuer en cas de tentative de contamination des variables globales syst&egrave;me XOOPS. <br />(option recommand&eacute;e : page blanche)');
define('_MI_PROTECTOR_ISOCOM_ACTION','Action si un commentaire isol&eacute; est d&eacute;tect&eacute; ');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti injection de SQL :<br />S&eacute;lectionner l\'action &agrave; effectuer quand "/*" est trouv&eacute;.<br />"Sanitiser" signifit ajouter d\'autres "*/" &agrave; la suite.<br />(option recommand&eacute;e :"Sanitiser")');
define('_MI_PROTECTOR_UNION_ACTION','Action si une UNION est d&eacute;tect&eacute;e ');
define('_MI_PROTECTOR_UNION_ACTIONDSC',' = Anti injection de SQL<br />S&eacute;lectionner l\'action &agrave; effectuer quand il y a syntaxe d\'UNION de SQL. <br />"Sanitiser" signifit Changer "union" en "uni-on".<br />(option recommand&eacute;e :"Sanitiser)"');
define("_MI_PROTECTOR_ID_INTVAL","Transformation forc&eacute;e en nombre entier (intval) de variables comme ID");
define("_MI_PROTECTOR_ID_INTVALDSC","Tous les appels '*id' seront trait&eacute;s comme un nombre entier. Cette option vous prot&egrave;gera contre certaines attaques XSS et injections SQL.<br /> Je recommande d'activer cette option, cependant celle-ci peut perturber le fonctionnement de certains modules.");
define('_MI_PROTECTOR_FILE_DOTDOT','Protection contre la travers&eacute;e de R&eacute;pertoires');
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Elimination de « .. » de toutes les demandes qui ressemblent &agrave; une tentative d'acc&egrave;s par travers&eacute;e de r&eacute;pertoires");

define('_MI_PROTECTOR_BF_COUNT','Anti Brute Force');
define("_MI_PROTECTOR_BF_COUNTDSC","D&eacute;finit le nombre de tentatives de connexion autoris&eacute;es pour un invit&eacute; dans un intervale de 10 minutes. Si quelqu'un &eacute;choue dans sa tentative au del&agrave; de ce nombre, son adresse IP sera bannie.");

define('_MI_PROTECTOR_DOS_SKIPMODS','Modules &agrave; exclure du contr&ocirc;le DoS (F5)/Crawler');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','Mettre les noms des r&eacute;pertoires des modules s&eacute;par&eacute;s par |. Cette option sera utile avec les modules de chat par exemple.');

define("_MI_PROTECTOR_DOS_EXPIRE","D&eacute;lai, en secondes, de r&eacute;action aux rechargements fr&eacute;quents de page (attaque 'touche F5')");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Dur&eacute;e admise en sec. pour les tentatives par rechargement de page (attaque 'touche F5') et les aspirateurs.");
define("_MI_PROTECTOR_DOS_F5COUNT","Nombre autoris&eacute; de tentatives F5 ");
define('_MI_PROTECTOR_DOS_F5COUNTDSC','D&eacute;fense contre des attaques DoS :<br/>Cette valeur d&eacute;termine le nombre de rechargement au del&agrave; duquel la connexion est consid&eacute;r&eacute;e comme une attaque malicieuse.');
define('_MI_PROTECTOR_DOS_F5ACTION','Action si une attaque F5 est d&eacute;tect&eacute;e');

define('_MI_PROTECTOR_DOS_CRCOUNT','Nombre de fois pour qu\'un crawler soit reconnu comme malicieux');
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","D&eacute;fense contre des crawlers-aspirateurs malicieux (comme bots chasseurs d'e-mails):<br/>La valeur d&eacute;termine le nombre d'acc&egrave;s au del&agrave; duquel le crawler est consid&eacute;r&eacute; comme malicieux.");
define('_MI_PROTECTOR_DOS_CRACTION','Action si des crawlers malicieux sont d&eacute;tect&eacute;s');

define('_MI_PROTECTOR_DOS_CRSAFE','User-Agent autoris&eacute;s');
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Regex Perl pour les User-Agents.<br /> Si il coincide, le crawler n'est plus consid&eacute;r&eacute; comme un aspirateur.<br/> Ex.: msnbot|Googlebot|Yahoo! Slurp");

define('_MI_PROTECTOR_OPT_NONE','Non (seulement dans le log)');
define('_MI_PROTECTOR_OPT_SAN','Sanitiser');
define('_MI_PROTECTOR_OPT_EXIT','&eacute;cran vide');
define('_MI_PROTECTOR_OPT_BIP','Bannir l\'IP');

define('_MI_PROTECTOR_DOSOPT_NONE','Non (seulement tracer dans le log)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Ne rien faire');
define('_MI_PROTECTOR_DOSOPT_EXIT','Page Blanche');
define('_MI_PROTECTOR_DOSOPT_BIP','Bannir l\'ip');
define('_MI_PROTECTOR_DOSOPT_HTA','DENY par .htaccess (Exp&eacute;rimental)');

define("_MI_PROTECTOR_BIP_EXCEPT","Groupes dont l'ip ne sera jamais bannie");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Les membres des groupes s&eacute;lectionn&eacute;s ne seront jamais bannis.<br />(Je recommande d'activer Admin/Webmasters)");
define('_MI_PROTECTOR_DISABLES','Neutralisez les fonctionnalit&eacute;s dangereuses de XOOPS');
define("_MI_PROTECTOR_PASSWD_BIP","Mot de passe de secours (d&eacute;sactiver le bannissement d'IP)");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Si pour une raison ou une autre votre IP est bannie.<br />Acc&eacute;der au site XOOPS_URL/modules/protector/admin/rescue.php, et entrez le mot de passe d&eacute;fini ici.<br />N'oubliez pas de d&eacute;finir un mot de passe avant d'&ecirc;tre banni<br />Si cette option n'est pas renseign&eacute;e,le script d&eacute;sactivant les adresses IP ne fonctionnera jamais.");

?>