<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format

// Appended by Xoops Language Checker -GIJOE- in 2005-08-09 17:42:02
define('_MI_HEADLINES_BDESC','Shows headline news via RSS/ATOM in separate cells');
define('_MI_HEADLINES_BDESC_MIXED','Shows headline news via RSS/ATOM in an aggregated view');

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
define("_MI_HEADLINES_INDEX_VIEWMODE","Visualizaîåo padråÐ");
define("_MI_HEADLINES_INDEX_VIEWMODED","Seleciona o tipo de visualizaîåo como a páÈina principal do m…Åulo");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Mixado & Novas primeiro");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classico");
define("_MI_HEADLINES_MIXED_MAXITEM","MáÙimo de itens");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Especifica o máÙimo de registros de RSS/ATOMs nas visualizaî÷es recentes (itens)");
define("_MI_HEADLINES_MIXED_MAXLEN","Tamanho máÙimo");
define("_MI_HEADLINES_MIXED_MAXLEND", "Especifica a quantidade máÙima de caracteres do tùÕulo nas visualizaî÷es recentes (byte)");
define("_MI_HEADLINES_PROXY_HOST","Host Proxy");
define("_MI_HEADLINES_PROXY_HOSTD","Se você pega RSS/ATOM via servidor proxy, configure o nome do host ou IP aqui<br />SenåÐ, deixe em branco.");
define("_MI_HEADLINES_PROXY_PORT","Porta Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Se você pega RSS/ATOM via a servidor proxy, configure o n“Îero da porta") ;
define("_MI_HEADLINES_PROXY_USER","UsuáÓio Proxy");
define("_MI_HEADLINES_PROXY_USERD","Se o seu servidor proxy precisa autentiîåo BŽÁSICA, configure o nome de usuáÓio<br />SenåÐ, deixe em branco.") ;
define("_MI_HEADLINES_PROXY_PASS","Senha Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Se o seu servidor proxy precisa autentiîåo BŽÁSICA, configure a senha<br />SenåÐ, deixe em branco.") ;
define("_MI_HEADLINES_SHORTDTFMT","Formato curto de data&hora");
define("_MI_HEADLINES_SHORTDTFMTD","Descreva-a como o primeiro parametro da funîåo <i>date()</i> do PHP .<br /><a href='http://jp.php.net/date' target='_blank'>ReferóÏcia ao manual de PHP</a>") ;
define("_MI_HEADLINES_MIXPICKUP","NåÐ colocar um item como recente se a quantidade de <i>feeds</i> for superior ao máÙimo de itens");
define("_MI_HEADLINES_MIXPICKUPD","Escolhendo <b>NåÐ</b>, as configuraî÷es para 'MáÙimo de itens' para cada <i>feeds</i> seråÐ ignoradas.");

}

?>