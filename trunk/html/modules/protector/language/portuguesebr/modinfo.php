<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","M�dulo para prote��o do XOOPS contra ataques mal-intencionados, em especial: ataques DoS, SQL Injection e contamina��es por vari�vel.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","Para usar este bloco corretamente, voc� deve coloc�-lo no topo dos blocos esquerdos (weight de menor valor) em todas as p�ginas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de prote��o");
define("_MI_PROTECTOR_ADVISORY","Guia de seguran�a");
define("_MI_PROTECTOR_PREFIXMANAGER","Gerenciador de PREFIX");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrup��o tempor�ria de funcionamento");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporariamente o funcionamento de todas as prote��es.<br />Ap�s resolver os problemas, n�o se esque�a de desativ�-la.");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs confi�veis");
define("_MI_PROTECTOR_RELIABLE_IPSDSC","Indique os endere�os IP que n�o passar�o por examina��o para ataques DoS, separados por |. ^ para o in�cio, e  $ para o final do string.");
define("_MI_PROTECTOR_LOG_LEVEL","N�vel de logging");
define("_MI_PROTECTOR_LOG_LEVELDSC","");

define("_MI_PROTECTOR_LOGLEVEL0","N�o gerar log");
define("_MI_PROTECTOR_LOGLEVEL15","Gerar log apenas de elementos de alto risco");
define("_MI_PROTECTOR_LOGLEVEL63","N�o gerar log de elementos de baixo risco");
define("_MI_PROTECTOR_LOGLEVEL255","Gerar log de todos os elementos");

define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos proibidos de mudan�a de IP");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Preven��o � session hijack:<br />Escolha os grupos cujos usu�rios proibidos de altera��o de endere�o IP durante uma sess�o.<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_SAN_NULLBYTE","Substitui��o de caracteres nulos por espa�os");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","O caracter \"\\0\" fatal � usado freq�entemente em ataques maliciosos.<br />Sempre que detectado, ele ser� substitu�do por um espa�o.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encerramento for�ado de sess�o em caso de detec��o de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","O caracter \"\\0\" fatal � usado freq�entemente em ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encerramento for�ado de sess�o em caso de uploads com extens�es proibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Caso houver uploads de arquivos com extens�es como .php ou outros arquivos execut�veis no servidor, a sess�o ser� apagada.<br />(N�o recomendado se voc� for usu�rio de B-Wiki ou PukiWikiMod e anexar c�digos-fonte em PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Solu��o em caso de detec��o de contamina��es por vari�vel");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Escolha o tipo de solu��o quando uma tentativa de altera��o das globais de sistema do XOOPS for detectada.<br />(Padr�o: \"Encerramento for�ado de sess�o\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Solu��o em caso de detec��o de coment�rios isolados");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Preven��o � SQL injection:<br />Escolha o tipo de solu��o quando um coment�rio isolado /* for detectado sem seu par */.<br />Processo de sanitiza��o: */ � inserido no final.<br />(Recomendado: \"Sanitiza��o\")");
define("_MI_PROTECTOR_UNION_ACTION","Solu��o em caso de detec��o de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Preven��o � SQL injection:<br />Escolha o tipo de solu��o quando uma sintaxe UNION do SQL for detectada.<br />Processo de sanitiza��o: UNION � alterado para uni-on.<br />(Recomendado: \"Sanitiza��o\")");
define("_MI_PROTECTOR_ID_INTVAL","Convers�o for�ada de vari�vel ID");
define("_MI_PROTECTOR_ID_INTVALDSC","For�a valores num�ricos �s vari�veis com nomes terminados em \"id\". � eficaz, principalmente, com m�dulos derivados do myLinks. Protege tamb�m de alguns XSS e SQL injection. Entretanto, pode entrar em conflito com alguns m�dulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Proibi��o de DirectoryTraversal");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Numa tentativa de DirectoryTraversal, o pedido � analisado, e a pattern \"..\" � removida.");

define("_MI_PROTECTOR_BF_COUNT","Preven��o � Brute Force");
define("_MI_PROTECTOR_BF_COUNTDSC","Contra round-robin. Se, dentro de 10 minutos, o n� de tentativas de login incorreto definido nesta op��o for excedido, o IP ser� banido.");

define("_MI_PROTECTOR_DOS_SKIPMODS","M�dulos exclu�dos de observa��o de alvo de DoS");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Defina os m�dulos que quiser excluir, separados por |. Ative para m�dulos de chat e similares.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tempo de observa��o para ataques DoS (em segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tempo de observa��o para acompanhar a freq��ncia dos acessos de DoS e crawlers maliciosos.");

define("_MI_PROTECTOR_DOS_F5COUNT","N� de vezes para ser reconhecido como ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defesa contra ataques DoS:<br />Se houver muitos acessos � uma mesma URL dentro do tempo de observa��o definido acima e do n� de vezes definidas nesta op��o, ser� reconhecido como um ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","N� de vezes para ser reconhecido como um crawler malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Preven��o � crawlers maliciosos (como bots ca�adores de e-mails):<br />Se forem realizadas buscas dentro do site dentro do tempo de observa��o definido acima e do n� de vezes definidas nesta op��o, ser� reconhecido como um crawler malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Solu��o para crawlers maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Descreva incondicionalmente o nome dos prov�veis crawlers com uma perl regex pattern.<br />Ex.: /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nenhuma (apenas gerar log)");
define("_MI_PROTECTOR_OPT_SAN","Sanitiza��o");
define("_MI_PROTECTOR_OPT_EXIT","Encerramento for�ado de sess�o");
define("_MI_PROTECTOR_OPT_BIP","Banimento por IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nenhuma (apenas gerar log)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Adicionar � lista de IPs banidos");
define("_MI_PROTECTOR_DOSOPT_HTA","Registrar DENY atrav�s de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos livres de banimento por IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Mesmo quando a condi��o for satisfeita, os usu�rios dos grupos indicados nesta op��o n�o ser�o adicionados � lista de IPs banidos. Entretanto, se estes usu�rios n�o fizerem login, o efeito desta op��o ser� anulado. TENHA CUIDADO!<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_DISABLES","Desativar op��es inseguras");
define("_MI_PROTECTOR_PASSWD_BIP","Senha de restaura��o");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta � a forma de restaura��o se, por alguma raz�o, voc� mesmo for adicionado � lista de IPs banidos do XOOPS.<br />Acesse XOOPS_URL/modules/protector/admin/rescue.php, e insira a senha definida aqui.<br />Caso nenhuma senha seja definida nesta op��o, o efeito dela ser� anulado. TENHA CUIDADO!<br />Esta senha ser� armazenada sem encripta��o, algu�m pode acabar tendo acesso � ela. Por isso, nunca utilize senhas importantes.");
?>