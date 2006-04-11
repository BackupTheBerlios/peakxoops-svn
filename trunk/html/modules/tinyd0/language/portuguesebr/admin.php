<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'TINYCONTENT_AM_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2006-04-11 11:14:42
define('_TC_UPDATE_WRAP_CONTENTS','Update wrapped contents for searching');

define( 'TINYCONTENT_AM_LOADED' , 1 ) ;

//Admin Page Titles
define("_TC_ADMINTITLE","Tiny Content");

// SPAW
define('_TC_SPAWLANG','en') ;

//Table Titles
define("_TC_ADDCONTENT","Inserir novo Conte�do");
define("_TC_EDITCONTENT","Editar Conte�do");
define("_TC_ADDLINK","Adicionar P�gina Pronta (formato HTML por ex.)");
define("_TC_EDITLINK","Modificar P�gina Pronta");
define("_TC_ULFILE","Enviar Arquivo");
define("_TC_SFILE","Procurar");
define("_TC_DELFILE","Excluir Arquivo");

//Table Data
define("_TC_HOMEPAGE","In�cio");
define("_TC_LINKNAME","Link do T�tulo");
define("_TC_STORYID","ID");
define("_TC_VISIBLE","V�sivel");
define("_TC_TH_VISIBLE","Vis");
define("_TC_ENABLECOM","Habilitar Coment�rios");
define("_TC_TH_ENABLECOM","Com");
define("_TC_HTML_HEADER","HTML header");
define("_TC_CONTENT","Conte�do");
define("_TC_YES","Sim");
define("_TC_NO","N�o");
define("_TC_URL","Selecionar arquivo");
define("_TC_UPLOAD","Enviar");
define("_TC_DISABLEBREAKS","Desabilitar convers�o LineBreak (Ativar somente se usar HTML)");
define("_TC_SUBMENU","Exibir em Submenu");
define("_TC_TH_SUBMENU","Sub");
define("_TC_DISP_YES","Exibir");
define("_TC_DISP_NO","Do Not Display");

define("_TC_CONTENT_TYPE","Tipo de P�gina");
define("_TC_TYPE_HTML","Conte�do HTML (bb code habilitar)"); // nohtml=0
define("_TC_TYPE_HTMLNOBB","Conte�do HTML (bb code desabilitar)"); // nohtml=2
define("_TC_TYPE_TEXTWITHBB","Conte�do do Texto (bb code habilitar)"); // nohtml=1
define("_TC_TYPE_TEXTNOBB","Conte�do do Texto (bb code desabilitar)"); // nohtml=3
define("_TC_TYPE_PHPHTML","C�digos PHP (bb code desabilitar)"); // nohtml=8
define("_TC_TYPE_PHPWITHBB","C�digos PHP (bb code habilitar)"); // nohtml=10
define("_TC_TYPE_PEARWIKI","PEAR Wiki (bb code desabilitar)"); // nohtml=16
define("_TC_TYPE_PEARWIKIWITHBB","PEAR Wiki (bb code habilitar)"); // nohtml=18
define("_TC_TYPE_PUKIWIKI","PukiWiki (bb code desabilitar)"); // nohtml=32 (resv)
define("_TC_TYPE_PUKIWIKIWITHBB","PukiWiki (bb code habilitar)"); // nohtml=34 (resv)

define("_TC_CHECKED_ITEMS_ARE","Registros conferidos:");
define("_TC_BUTTON_MOVETO","Exportar (Mover)");

define("_TC_LASTMODIFIED","�ltima Modifica��o");
define("_TC_DONTUPDATELASTMODIFIED","N�o realizar atualiza��o autom�tica");
define("_TC_CREATED","Feito por");
define("_TC_SAVEAS","Salvar como");

define("_TC_LINKID","Prioridade");
define("_TC_CONTENTTYPE","Tipo");
define("_TC_ACTION","A��o");
define("_TC_EDIT","Editar");
define("_TC_DELETE","Excluir");
define("_TC_ELINK","Modificar");
define("_TC_DELLINK","Cortar");

define("_TC_WRAPROOT","Base do arquivo pronto");
define("_TC_FMT_WRAPROOTTC","Mesmo como m�dulo de TinyContent<br /> (%s) <br />");
define("_TC_FMT_WRAPROOTPAGE","Mesmo como p�gina pronta.<br /> (%s) <br /> usa mod_rewrite se puder.<br />");
define("_TC_FMT_WRAPBYREWRITE","use mod_rewrite (experimental)<br / > transfira o HTML e outros em %s <br /> n�o esque�a de mod_rewrite em <br />");
define("_TC_FMT_WRAPCHANGESRCHREF","reescreva atributos de html (experimental)<br /> esta op��o reescreve liga��es relativas a liga��es absolutas.<br /> Isto reconhece qualquer tipo de comando provavelmente como fonte de HTML <br />");

define("_TC_DISABLECOM","Desabilitar coment�rios");
define("_TC_DBUPDATED","Banco de dados atualizado com sucesso!");
define("_TC_ERRORINSERT","Erro na atualiza��o do Banco de Dados!");
define("_TC_RUSUREDEL","Voc� tem certeza que quer excluit este conte�do? <br /> ser�o removidos todos os coment�rios junto com o conte�do");
define("_TC_RUSUREDELF","Voc� tem certeza que deseja excluir este arquivo?");
define("_TC_UPLOADED","Arquivo atualizado com Sucesso!");
define("_TC_FDELETED","Arquivo Exclu�do com Sucesso!");
define("_TC_ERROREXIST","Erro. O mesmo arquivo j� existe");
define("_TC_ERRORUPL","Erro no envio do arquivo! (tente outra vez!)");
define("_TC_FMT_WRAPPATHPERMOFF","<span style='font-size:xx-small;'>O diret�rio por conte�do (%s) n�o � permitido ser escrito para atrav�s de httpd. <br />Se voc� gostaria de transferir ou apagar arquivos por HTTP, mude a permiss�o de escritura em<br /> recomenda-se transferir ou s� apagar arquivos por ftp para seguran�a</span>");
define("_TC_FMT_WRAPPATHPERMON","<span style='font-size:xx-small;'>Recomenda-se que n�o transfira por HTTP. Tente transferir os arquivos por FTP.</span>" ) ;

define("_TC_ALTER_TABLE","Alterar Tabela");

define("_TC_JS_CONFIRMDISCARD","Descartar Mudan�as. OK?");

}

?>
