<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */

// index.php
define("_AM_TH_DATETIME","Data");
define("_AM_TH_USER","Usuário");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Tipo");
define("_AM_TH_DESCRIPTION","Descrição");

define( "_AM_TH_BADIPS","Lista de IPs banidos");
define( "_AM_TH_ENABLEIPBANS","Ativar banimento por IP?");

define("_AM_LABEL_REMOVE","");
define("_AM_BUTTON_REMOVE","Apagar");
define("_AM_JS_REMOVECONFIRM","Você tem certeza de que deseja apagar os itens selecionados?");
define( "_AM_MSG_PRUPDATED","As configurações foram atualizadas com sucesso.");
define("_AM_MSG_REMOVED","Os itens selecionados foram apagados com sucesso.");


// prefix_manager.php
define("_AM_H3_PREFIXMAN","Gerenciador de PREFIX");
define("_AM_MSG_DBUPDATED","O banco de dados foi atualizado com sucesso.");
define("_AM_CONFIRM_DELETE","Tem certeza de que deseja apagar todas as tabelas?");
define("_AM_TXT_HOWTOCHANGEDB","Quando você mudar o prefix, altere o conteúdo abaixo em seu %s/mainfile.php.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');");


// advisory.php
define("_AM_ADV_NOTSECURE","INSEGURO");

define("_AM_ADV_REGISTERGLOBALS","Esta configuração permite uma variedade de ataques por injeção.<br />Se seu servidor suportar .htaccess, crie ou edite o .htaccess no diretório em que o XOOPS estiver instalado.");
define("_AM_ADV_ALLOWURLFOPEN","Esta configuração permite que atacantes executem scripts remotamente à vontade.<br />Para alterar esta opção, é necessário ter permissão de administrador do servidor.<br />Se você é um administrador do servidor, edite o php.ini ou httpd.conf.<br /><b>Exemplo de httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Caso contrário, contate o suporte de seu host.");
define("_AM_ADV_DBPREFIX","O prefixo do seu banco de dados é \"xoops\", o que o faz vulnerável à SQL injection.<br />Não se esqueça de ativar \"Sanitização forçada em caso de detecção de comentário isolado\" e as proteções contra SQL injection nas preferências deste módulo.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Ir para o Gerenciador de PREFIX");
define("_AM_ADV_MAINUNPATCHED","Quando chamado no mainfile.php, a proteção fornecida pelo Xoops Protector é aumentada.<br />Leia o README e edite seu mainfile.php como indicado.");
define("_AM_ADV_RESCUEPASSWORD","Senha de restauração");
define("_AM_ADV_RESCUEPASSWORDUNSET","Indefinida.");
define("_AM_ADV_RESCUEPASSWORDSHORT","Utilize senhas maiores ou iguais à 6 caracteres.");

define("_AM_ADV_SUBTITLECHECK","Checagem das ações do Protector");
define("_AM_ADV_AT1STSETPASSWORD","Por haver a possibilidade de você mesmo ser adicionado à lista de IPs banidos, primeiramente defina uma senha de restauração.");
define("_AM_ADV_CHECKCONTAMI","Ataques por contaminação");
define("_AM_ADV_CHECKISOCOM","Comentários isolados");
?>