<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Módulo para proteger o XOOPS de ataques mal-intencionados, em especial, ataques como DoS, SQL Injection e vários tipos de contaminações.<br />Para usar este bloco corretamente, você deve colocá-lo no topo dos blocos esquerdos (weight de menor valor) em todas as páginas.<br />Não se esqueça de dar permissão de acesso à este bloco ao grupo de Anônimos.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Para usar este bloco corretamente, você deve colocá-lo no topo dos blocos esquerdos (posição de menor valor) em todas as páginas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Centro de proteção");
define("_MI_PROTECTOR_ADVISORY","Guia de segurança");
define("_MI_PROTECTOR_PREFIXMANAGER","Gerenciador de PREFIX");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','Interrupção temporária de funcionamento');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','O funcionamento de todas as proteções é suspenso temporariamente.<br />Após resolver os problemas, não se esqueça de desativá-la.');
define('_MI_PROTECTOR_LOG_LEVEL','Nível de logging');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','Não gerar log');
define('_MI_PROTECTOR_LOGLEVEL15','Fazer log apenas de elementos de alto risco');
define('_MI_PROTECTOR_LOGLEVEL63','Não fazer log de elementos de baixo risco');
define('_MI_PROTECTOR_LOGLEVEL255','Ativar logging de tudo');

define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos cujos IPs serão banidos por mudança de endereço");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevenção contra session hi-jacking:<br />Escolha os grupos cujo IP será banido se durante uma sessão o endereço mudar.<br />(Recomendado: Administradores)");
define("_MI_PROTECTOR_SAN_NULLBYTE","Trocar caracteres nulos por espaço");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","O caracter \"\\0\" fatal é usado freqüentemente em ataques maliciosos.<br />Sempre que detectado, ele será alterado por um espaço.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encerramento forçado de sessão em caso de detecção de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","O caracter \"\\0\" fatal é usado freqüentemente em ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encerramento forçado de sessão em caso de uploads com extensões não permitidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Quando uploads com extensões não permitidas, como .php, forem realizados, a sessão será apagada.<br />(Não recomendado se usa B-Wiki ou PukiWikiMod e anexa códigos-fonte em PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Medida em caso de detecção de ataque por contaminação");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Escolha o que fazer quando uma tentativa de alteração das globais de sistema do XOOPS for detectada.<br />(Padrão: \"Encerramento forçado\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Medida em caso de detecção de comentário isolado");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevenção contra SQL injection:<br />Escolha o que fazer quando um comentário isolado /* for detectado em seu par */.<br />Processo de sanitização: */ é inserido no final.<br />(Recomendado: \"Sanitização\")");
define("_MI_PROTECTOR_UNION_ACTION","Medida em caso de detecção de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevenção contra SQL injection:<br />Escolha o que fazer quando uma síntaxe UNION do SQL for detectada.<br />Processo de sanitização: UNION é alterado para uni-on.<br />(Recomendado: \"Sanitização\")");
define("_MI_PROTECTOR_ID_INTVAL","Conversão forçada (intval) de variável ID");
define("_MI_PROTECTOR_ID_INTVALDSC","O valor da variável id deve ser sempre um número. Eficaz especialmente com módulos derivados do myLinks, protege também de alguns XSS e SQL injection. Entretanto, pode entrar em conflito com alguns módulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Corrigir wrapping suspeitos");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Quando um arquivo é requisitado (através de wrap), os \"..\" são retirados.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tempo de observação de ataques DoS (em segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Quantidade de tempo de observação para acompanhar a freqüência dos acessos de crawlers que realizam DoS e contaminações.");

define("_MI_PROTECTOR_DOS_F5COUNT","Nº de vezes para ser reconhecido como ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defesa contra ataques DoS:<br />Dentro do tempo de observação definido acima e do nº de vezes definido aqui, se houverem muitos acessos à uma mesma URL, será reconhecido como um ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","Nº de vezes para um crawler ser reconhecido como malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Defesa contra crawlers maliciosos (como bots caçadores de e-mails):<br />Dentro do tempo de observação definido acima e do nº de vezes definido aqui, se forem realizadas buscas dentro do site, será reconhecido como um crawler malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Medidas contra crawlers maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Por ser incondicional, insira o nome dos prováveis crawlers com uma perl regex pattern.<br />Ex.:) /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nenhuma (apenas criar log)");
define("_MI_PROTECTOR_OPT_SAN","Sanitização");
define("_MI_PROTECTOR_OPT_EXIT","Encerramento forçado");
define("_MI_PROTECTOR_OPT_BIP","Banimento de IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nenhuma (apenas criar log)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Adicionar como IP banido");
define('_MI_PROTECTOR_DOSOPT_HTA','DENY através de .htaccess (experimental)');

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos cujos IPs não devem ser banidos");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Mesmo quando a condição for satisfeita, os grupos de usuários selecionados aqui não serão banidos. Entretanto, se estes usuários não fizerem login, esta opção não terá efeito algum. (Recomendado: Administradores)");
define("_MI_PROTECTOR_PATCH2092","Patches contra brechas no XOOPS <= 2.0.9.2");
define("_MI_PROTECTOR_PASSWD_BIP","Senha de restauração");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta é a forma de restauração se, por alguma razão, você mesmo for adicionado aos IPs banidos do XOOPS.<br />Acesse XOOPS_URL/modules/protector/admin/rescue.php, e insira a senha definida aqui.<br />Se nenhuma senha for definida nesta opção, o efeito desta opção será anulado. Tenha cuidado!");
?>