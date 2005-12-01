<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","M…Åulo para proteîåo do XOOPS contra ataques mal-intencionados, em especial: ataques DoS, SQL Injection e contaminaî÷es por variá×el.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","Para usar este bloco corretamente, você deve colocá-lo no topo dos blocos esquerdos (weight de menor valor) em todas as páÈinas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de proteîåo");
define("_MI_PROTECTOR_ADVISORY","Guia de seguraníÂ");
define("_MI_PROTECTOR_PREFIXMANAGER","Gerenciador de PREFIX");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrupîåo temporáÓia de funcionamento");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporariamente o funcionamento de todas as proteî÷es.<br />Ap…Ô resolver os problemas, nåÐ se esqueíÂ de desativá-la.");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs confiá×eis");
define("_MI_PROTECTOR_RELIABLE_IPSDSC","Indique os endereíÐs IP que nåÐ passaråÐ por examinaîåo para ataques DoS, separados por |. ^ para o inùÄio, e  $ para o final do string.");
define("_MI_PROTECTOR_LOG_LEVEL","Nù×el de logging");
define("_MI_PROTECTOR_LOG_LEVELDSC","");

define("_MI_PROTECTOR_LOGLEVEL0","NåÐ gerar log");
define("_MI_PROTECTOR_LOGLEVEL15","Gerar log apenas de elementos de alto risco");
define("_MI_PROTECTOR_LOGLEVEL63","NåÐ gerar log de elementos de baixo risco");
define("_MI_PROTECTOR_LOGLEVEL255","Gerar log de todos os elementos");

define("_MI_PROTECTOR_HIJACK_TOPBIT","Proteîåo de IP bits contra renovaîåo de sessåÐ");
define("_MI_PROTECTOR_HIJACK_TOPBITDSC","Prevenîåo à session hijack:<br />O padråÐ é 32(bit) e protege de todos os bits.<br />Caso use Proxy ou seu endereíÐ IP mude a cada acesso, defina o intervalo de bits mais longo possù×el à invariaîåo.<br />Ex.: Se houver possibilidade de variaîåo dentro de 192.168.0.0~192.168.0.255, defina esta opîåo como 24(bit).");
define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos proibidos de mudaníÂ de IP");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevenîåo à session hijack:<br />Escolha os grupos cujos usuáÓios proibidos de alteraîåo de endereíÐ IP durante uma sessåÐ.<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_SAN_NULLBYTE","Substituiîåo de caracteres nulos por espaíÐs");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","O caracter \"\\0\" fatal é usado freq—Æntemente em ataques maliciosos.<br />Sempre que detectado, ele será substituùÅo por um espaíÐ.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encerramento foríÂdo de sessåÐ em caso de detecîåo de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","O caracter \"\\0\" fatal é usado freq—Æntemente em ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encerramento foríÂdo de sessåÐ em caso de uploads com extens‰Æs proibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Caso houver uploads de arquivos com extens‰Æs como .php ou outros arquivos executá×eis no servidor, a sessåÐ será apagada.<br />(NåÐ recomendado se você for usuáÓio de B-Wiki ou PukiWikiMod e anexar c…Åigos-fonte em PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Soluîåo em caso de detecîåo de contaminaî÷es por variá×el");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Escolha o tipo de soluîåo quando uma tentativa de alteraîåo das globais de sistema do XOOPS for detectada.<br />(PadråÐ: \"Encerramento foríÂdo de sessåÐ\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Soluîåo em caso de detecîåo de comentáÓios isolados");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevenîåo à SQL injection:<br />Escolha o tipo de soluîåo quando um comentáÓio isolado /* for detectado sem seu par */.<br />Processo de sanitizaîåo: */ é inserido no final.<br />(Recomendado: \"Sanitizaîåo\")");
define("_MI_PROTECTOR_UNION_ACTION","Soluîåo em caso de detecîåo de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevenîåo à SQL injection:<br />Escolha o tipo de soluîåo quando uma sintaxe UNION do SQL for detectada.<br />Processo de sanitizaîåo: UNION é alterado para uni-on.<br />(Recomendado: \"Sanitizaîåo\")");
define("_MI_PROTECTOR_ID_INTVAL","ConversåÐ foríÂda de variá×el ID");
define("_MI_PROTECTOR_ID_INTVALDSC","ForíÂ valores numñÓicos ßÔ variá×eis com nomes terminados em \"id\". ŽÉ eficaz, principalmente, com m…Åulos derivados do myLinks. Protege tambñÎ de alguns XSS e SQL injection. Entretanto, pode entrar em conflito com alguns m…Åulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Proibiîåo de DirectoryTraversal");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Numa tentativa de DirectoryTraversal, o pedido é analisado, e a pattern \"..\" é removida.");

define("_MI_PROTECTOR_BF_COUNT","Prevenîåo à Brute Force");
define("_MI_PROTECTOR_BF_COUNTDSC","Contra round-robin. Se, dentro de 10 minutos, o nŽº de tentativas de login incorreto definido nesta opîåo for excedido, o IP será banido.");

define("_MI_PROTECTOR_DOS_SKIPMODS","M…Åulos excluùÅos de observaîåo de alvo de DoS");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Defina os m…Åulos que quiser excluir, separados por |. Ative para m…Åulos de chat e similares.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tempo de observaîåo para ataques DoS (em segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tempo de observaîåo para acompanhar a freq˜ìncia dos acessos de DoS e crawlers maliciosos.");

define("_MI_PROTECTOR_DOS_F5COUNT","NŽº de vezes para ser reconhecido como ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defesa contra ataques DoS:<br />Se houver muitos acessos à uma mesma URL dentro do tempo de observaîåo definido acima e do nŽº de vezes definidas nesta opîåo, será reconhecido como um ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","NŽº de vezes para ser reconhecido como um crawler malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Prevenîåo à crawlers maliciosos (como bots caíÂdores de e-mails):<br />Se forem realizadas buscas dentro do site dentro do tempo de observaîåo definido acima e do nŽº de vezes definidas nesta opîåo, será reconhecido como um crawler malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Soluîåo para crawlers maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Descreva incondicionalmente o nome dos prová×eis crawlers com uma perl regex pattern.<br />Ex.: /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nenhuma (apenas gerar log)");
define("_MI_PROTECTOR_OPT_SAN","Sanitizaîåo");
define("_MI_PROTECTOR_OPT_EXIT","Encerramento foríÂdo de sessåÐ");
define("_MI_PROTECTOR_OPT_BIP","Banimento por IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nenhuma (apenas gerar log)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Adicionar à lista de IPs banidos");
define("_MI_PROTECTOR_DOSOPT_HTA","Registrar DENY atravñÔ de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos livres de banimento por IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Mesmo quando a condiîåo for satisfeita, os usuáÓios dos grupos indicados nesta opîåo nåÐ seråÐ adicionados à lista de IPs banidos. Entretanto, se estes usuáÓios nåÐ fizerem login, o efeito desta opîåo será anulado. TENHA CUIDADO!<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_DISABLES","Desativar opî÷es inseguras");
define("_MI_PROTECTOR_PASSWD_BIP","Senha de restauraîåo");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta é a forma de restauraîåo se, por alguma razåÐ, você mesmo for adicionado à lista de IPs banidos do XOOPS.<br />Acesse XOOPS_URL/modules/protector/admin/rescue.php, e insira a senha definida aqui.<br />Caso nenhuma senha seja definida nesta opîåo, o efeito dela será anulado. TENHA CUIDADO!<br />Esta senha será armazenada sem encriptaîåo, alguñÎ pode acabar tendo acesso à ela. Por isso, nunca utilize senhas importantes.");
?>