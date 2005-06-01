<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format
define("_MI_DEFAULT_DTFMT_SHORT","j M ah:i");

// The name of this module
define("_MI_HEADLINES_NAME","Manchetes");

// A brief description of this module
define("_MI_HEADLINES_DESC","Exibe um RSS/XML Newsfeed de outros sites");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Manchetes");
define("_MI_HEADLINES_BNAME_MIXED","Manchetes Recentes");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Listar Manchetes");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocos/Grupos");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Visualiza��o padr�o");
define("_MI_HEADLINES_INDEX_VIEWMODED","Seleciona o tipo de visualiza��o como a p�gina principal do m�dulo");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Mixado & Novas primeiro");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classico");
define("_MI_HEADLINES_MIXED_MAXITEM","M�ximo de itens");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Especifica o m�ximo de registros de RSS/ATOMs nas visualiza��es recentes (itens)");
define("_MI_HEADLINES_MIXED_MAXLEN","Tamanho m�ximo");
define("_MI_HEADLINES_MIXED_MAXLEND", "Especifica a quantidade m�xima de caracteres do t�tulo nas visualiza��es recentes (byte)");
define("_MI_HEADLINES_PROXY_HOST","Host Proxy");
define("_MI_HEADLINES_PROXY_HOSTD","Se voc� pega RSS/ATOM via servidor proxy, configure o nome do host ou IP aqui<br />Sen�o, deixe em branco.");
define("_MI_HEADLINES_PROXY_PORT","Porta Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Se voc� pega RSS/ATOM via a servidor proxy, configure o n�mero da porta") ;
define("_MI_HEADLINES_PROXY_USER","Usu�rio Proxy");
define("_MI_HEADLINES_PROXY_USERD","Se o seu servidor proxy precisa autenti��o B�SICA, configure o nome de usu�rio<br />Sen�o, deixe em branco.") ;
define("_MI_HEADLINES_PROXY_PASS","Senha Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Se o seu servidor proxy precisa autenti��o B�SICA, configure a senha<br />Sen�o, deixe em branco.") ;
define("_MI_HEADLINES_SHORTDTFMT","Formato curto de data&hora");
define("_MI_HEADLINES_SHORTDTFMTD","Descreva-a como o primeiro parametro da fun��o <i>date()</i> do PHP .<br /><a href='http://jp.php.net/date' target='_blank'>Refer�ncia ao manual de PHP</a>") ;
define("_MI_HEADLINES_MIXPICKUP","N�o colocar um item como recente se a quantidade de <i>feeds</i> for superior ao m�ximo de itens");
define("_MI_HEADLINES_MIXPICKUPD","Escolhendo <b>N�o</b>, as configura��es para 'M�ximo de itens' para cada <i>feeds</i> ser�o ignoradas.");

}

?>