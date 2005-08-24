<?php /* Brazilian Portuguese Translation by Marcelo Yuji Himoro <http://yuji.ws> */

// index.php

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define('_AM_ADV_USETRANSSID','Your Session ID will be diplayed in anchor tags etc.<br />For preventing from session hi-jacking, add a line into .htaccess in XOOPS_ROOT_PATH.<br /><b>php_flag session.use_trans_sid off</b>');

define("_AM_TH_DATETIME","Data");
define("_AM_TH_USER","Usu�rio");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Tipo");
define("_AM_TH_DESCRIPTION","Detalhes");

define("_AM_TH_BADIPS","Lista de IPs banidos");
define("_AM_TH_ENABLEIPBANS","Ativar banimento por IP?");

define("_AM_LABEL_REMOVE","");
define("_AM_BUTTON_REMOVE","Apagar");
define("_AM_JS_REMOVECONFIRM","Voc� tem certeza de que deseja apagar os itens selecionados?");
define("_AM_MSG_PRUPDATED","As configura��es foram atualizadas com sucesso.");
define("_AM_MSG_REMOVED","Os itens selecionados foram apagados com sucesso.");


// prefix_manager.php
define("_AM_H3_PREFIXMAN","Gerenciador de PREFIX");
define("_AM_MSG_DBUPDATED","O banco de dados foi atualizado com sucesso.");
define("_AM_CONFIRM_DELETE","Tem certeza de que deseja apagar todas as tabelas?");
define("_AM_TXT_HOWTOCHANGEDB","Ao mudar o prefix, voc� deve alterar o seguinte conte�do em %s/mainfile.php.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');");


// advisory.php
define("_AM_ADV_NOTSECURE","INSEGURO");

define("_AM_ADV_REGISTERGLOBALS","Esta configura��o permite uma variedade de ataques por inje��o.<br />Se seu servidor suportar .htaccess, crie ou edite-o no diret�rio em que o XOOPS estiver instalado.");
define("_AM_ADV_ALLOWURLFOPEN","Esta configura��o permite que atacantes executem scripts remotamente � vontade.<br />Para alterar esta op��o, � necess�rio ter permiss�o de administrador do servidor.<br />Se for um administrador do servidor, edite o php.ini e o httpd.conf.<br /><b>Exemplo de httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Caso contr�rio, contate o suporte de seu host.");
define("_AM_ADV_DBPREFIX","O prefixo do seu banco de dados � o padr�o (\"xoops\"), o que o faz vulner�vel � SQL injection.<br />N�o se esque�a de ativar \"Sanitiza��o em caso de detec��o de coment�rios isolados\" e as prote��es contra SQL injection.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Ir para o Gerenciador de PREFIX");
define("_AM_ADV_MAINUNPATCHED","Edite seu mainfile.php como indicado no README.");
define("_AM_ADV_RESCUEPASSWORD","Senha de restaura��o");
define("_AM_ADV_RESCUEPASSWORDUNSET","INDEFINIDA");
define("_AM_ADV_RESCUEPASSWORDSHORT","Utilize senhas maiores ou iguais � 6 caracteres.");

define("_AM_ADV_SUBTITLECHECK","Teste de funcionamento do Protector");
define("_AM_ADV_AT1STSETPASSWORD","Devido � possibilidade de voc� mesmo ser adicionado � lista de IPs banidos, � fundamental definir uma senha de restaura��o.");
define("_AM_ADV_CHECKCONTAMI","Contamina��es por vari�vel");
define("_AM_ADV_CHECKISOCOM","Coment�rios isolados");
?>