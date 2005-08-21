<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Módulo para proteção do XOOPS contra ataques mal-intencionados, em especial: ataques DoS, SQL Injection e contaminações por variável.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","Para usar este bloco corretamente, você deve colocá-lo no topo dos blocos esquerdos (weight de menor valor) em todas as páginas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de proteção");
define("_MI_PROTECTOR_ADVISORY","Guia de segurança");
define("_MI_PROTECTOR_PREFIXMANAGER","Gerenciador de PREFIX");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrupção temporária de funcionamento");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporariamente o funcionamento de todas as proteções.<br />Após resolver os problemas, não se esqueça de desativá-la.");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs confiáveis");
define("_MI_PROTECTOR_RELIABLE_IPSDSC","Indique os endereços IP que não passarão por examinação para ataques DoS, separados por |. ^ para o início, e  $ para o final do string.");
define("_MI_PROTECTOR_LOG_LEVEL","Nível de logging");
define("_MI_PROTECTOR_LOG_LEVELDSC","");

define("_MI_PROTECTOR_LOGLEVEL0","Não gerar log");
define("_MI_PROTECTOR_LOGLEVEL15","Gerar log apenas de elementos de alto risco");
define("_MI_PROTECTOR_LOGLEVEL63","Não gerar log de elementos de baixo risco");
define("_MI_PROTECTOR_LOGLEVEL255","Gerar log de todos os elementos");

define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos proibidos de mudança de IP");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevenção à session hijack:<br />Escolha os grupos cujos usuários proibidos de alteração de endereço IP durante uma sessão.<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_SAN_NULLBYTE","Substituição de caracteres nulos por espaços");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","O caracter \"\\0\" fatal é usado freqüentemente em ataques maliciosos.<br />Sempre que detectado, ele será substituído por um espaço.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encerramento forçado de sessão em caso de detecção de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","O caracter \"\\0\" fatal é usado freqüentemente em ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encerramento forçado de sessão em caso de uploads com extensões proibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Caso houver uploads de arquivos com extensões como .php ou outros arquivos executáveis no servidor, a sessão será apagada.<br />(Não recomendado se você for usuário de B-Wiki ou PukiWikiMod e anexar códigos-fonte em PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Solução em caso de detecção de contaminações por variável");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Escolha o tipo de solução quando uma tentativa de alteração das globais de sistema do XOOPS for detectada.<br />(Padrão: \"Encerramento forçado de sessão\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Solução em caso de detecção de comentários isolados");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevenção à SQL injection:<br />Escolha o tipo de solução quando um comentário isolado /* for detectado sem seu par */.<br />Processo de sanitização: */ é inserido no final.<br />(Recomendado: \"Sanitização\")");
define("_MI_PROTECTOR_UNION_ACTION","Solução em caso de detecção de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevenção à SQL injection:<br />Escolha o tipo de solução quando uma sintaxe UNION do SQL for detectada.<br />Processo de sanitização: UNION é alterado para uni-on.<br />(Recomendado: \"Sanitização\")");
define("_MI_PROTECTOR_ID_INTVAL","Conversão forçada de variável ID");
define("_MI_PROTECTOR_ID_INTVALDSC","Força valores numéricos às variáveis com nomes terminados em \"id\". É eficaz, principalmente, com módulos derivados do myLinks. Protege também de alguns XSS e SQL injection. Entretanto, pode entrar em conflito com alguns módulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Proibição de DirectoryTraversal");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Numa tentativa de DirectoryTraversal, o pedido é analisado, e a pattern \"..\" é removida.");

define("_MI_PROTECTOR_BF_COUNT","Prevenção à Brute Force");
define("_MI_PROTECTOR_BF_COUNTDSC","Contra round-robin. Se, dentro de 10 minutos, o nº de tentativas de login incorreto definido nesta opção for excedido, o IP será banido.");

define("_MI_PROTECTOR_DOS_SKIPMODS","Módulos excluídos de observação de alvo de DoS");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Defina os módulos que quiser excluir, separados por |. Ative para módulos de chat e similares.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tempo de observação para ataques DoS (em segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tempo de observação para acompanhar a freqüência dos acessos de DoS e crawlers maliciosos.");

define("_MI_PROTECTOR_DOS_F5COUNT","Nº de vezes para ser reconhecido como ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defesa contra ataques DoS:<br />Se houver muitos acessos à uma mesma URL dentro do tempo de observação definido acima e do nº de vezes definidas nesta opção, será reconhecido como um ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","Nº de vezes para ser reconhecido como um crawler malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Prevenção à crawlers maliciosos (como bots caçadores de e-mails):<br />Se forem realizadas buscas dentro do site dentro do tempo de observação definido acima e do nº de vezes definidas nesta opção, será reconhecido como um crawler malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Solução para crawlers maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Descreva incondicionalmente o nome dos prováveis crawlers com uma perl regex pattern.<br />Ex.: /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nenhuma (apenas gerar log)");
define("_MI_PROTECTOR_OPT_SAN","Sanitização");
define("_MI_PROTECTOR_OPT_EXIT","Encerramento forçado de sessão");
define("_MI_PROTECTOR_OPT_BIP","Banimento por IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nenhuma (apenas gerar log)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Adicionar à lista de IPs banidos");
define("_MI_PROTECTOR_DOSOPT_HTA","Registrar DENY através de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos livres de banimento por IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Mesmo quando a condição for satisfeita, os usuários dos grupos indicados nesta opção não serão adicionados à lista de IPs banidos. Entretanto, se estes usuários não fizerem login, o efeito desta opção será anulado. TENHA CUIDADO!<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_DISABLES","Desativar opções inseguras");
define("_MI_PROTECTOR_PASSWD_BIP","Senha de restauração");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta é a forma de restauração se, por alguma razão, você mesmo for adicionado à lista de IPs banidos do XOOPS.<br />Acesse XOOPS_URL/modules/protector/admin/rescue.php, e insira a senha definida aqui.<br />Caso nenhuma senha seja definida nesta opção, o efeito dela será anulado. TENHA CUIDADO!<br />Esta senha será armazenada sem encriptação, alguém pode acabar tendo acesso à ela. Por isso, nunca utilize senhas importantes.");
?>