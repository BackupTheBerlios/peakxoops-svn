<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3pipes' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","D3 PIPES");

// A brief description of this module
define($constpref."_DESC","Módulo flexível de Sindicalização");

// admin menus
define($constpref.'_ADMENU_PIPE','Pipes') ;
define($constpref.'_ADMENU_CACHE','Cache') ;
define($constpref.'_ADMENU_CLIPPING','Clippings') ;
define($constpref.'_ADMENU_JOINT','Joint initials') ;
define($constpref.'_ADMENU_JOINTCLASS','Class initials') ;
define($constpref.'_ADMENU_MYLANGADMIN','Linguagens') ;
define($constpref.'_ADMENU_MYTPLSADMIN','Modelos') ;
define($constpref.'_ADMENU_MYBLOCKSADMIN','Blocos e Permissões') ;
define($constpref.'_ADMENU_MYPREFERENCES','Preferências') ;

// blocks
define($constpref.'_BNAME_ASYNC','Listar registros (Async)') ;
define($constpref.'_BNAME_SYNC','Listar registros (Sync)') ;

// configs
define($constpref.'_INDEXTOTAL','Total de registros no topo deste módulo');
define($constpref.'_INDEXEACH','Máximo de registros de um pipe no topo deste módulo');
define($constpref.'_INDEXKEEPPIPE','Mostrar acima do pipes quando possivel no topo deste módulo');
define($constpref.'_ENTRIESAPIPE','Entries a view de cada pipes');
define($constpref.'_ENTRIESAPAGE','Entries a page na lista de clipping');
define($constpref.'_ENTRIESARSS','Entries a RSS/Atom');
define($constpref.'_ENTRIESSMAP','Registros do sitemap xml para google etc');
define($constpref.'_ARCB_FETCHED','Auto expiração por fetched tempo (dias)');
define($constpref.'_ARCB_FETCHEDDSC','Especificar os dias que os clippings deverão ser removidos. 0 significa disabilitar auto-expiração. Os clippings com comentários e destacados nunca serão removidos.');
define($constpref.'_INTERNALENC','Codificação interna');
define($constpref.'_FETCHCACHELT','Fech tempo do cache (seg)');
define($constpref.'_REDIRECTWARN','Alertar se a URI rss/atom será redirecionada');
define($constpref.'_SNP_MAXREDIRS','Máximo redirecionamentos para Snoopy');
define($constpref.'_SNP_MAXREDIRSDSC','Depois de construir pipes com sucesso, configures esta opção como 0');
define($constpref.'_SNP_PROXYHOST','Nome do host do servidor proxy');
define($constpref.'_SNP_PROXYHOSTDSC','especificar isso por FQDN. Normalmente, deixe em branco aqui');
define($constpref.'_SNP_PROXYPORT','Porta do servidor proxy');
define($constpref.'_SNP_PROXYUSER','Nome de usuário para o servidor proxy');
define($constpref.'_SNP_PROXYPASS','Senha para o servidor proxy');
define($constpref.'_SNP_CURLPATH','curl percurso (padrão: /usr/bin/curl)');
define($constpref.'_TIDY_PATH','tidy percurso (padrão: /usr/bin/tidy)');
define($constpref.'_XSLTPROC_PATH','xsltproc percurso (padrão: /usr/bin/xsltproc)');
define($constpref.'_UPING_SERVERS','Atualizar servidores Ping');
define($constpref.'_UPING_SERVERSDSC','Escreva um RPC end point começando com "http://" uma linha.<br />Se você precisar enviar um Ping longo, adicione " E" depois da URI.');
define($constpref.'_UPING_SERVERSDEF',"http://blogsearch.google.com/ping/RPC2 E\nhttp://rpc.weblogs.com/RPC2 E\nhttp://ping.blo.gs/ E");
define($constpref.'_CSS_URI','CSS URI');
define($constpref.'_CSS_URIDSC','percurso relativo ou absoluto pode ser configurado. padrão: {mod_url}/index.css');
define($constpref.'_IMAGES_DIR','Diretório para os arquivos de imagem');
define($constpref.'_IMAGES_DIRDSC','o percurso relativo deve ser configurado no diretório do módulo. padrão: images');
define($constpref.'_COM_DIRNAME','Integração dos comentários: nome do diretório do d3forum');
define($constpref.'_COM_FORUM_ID','Integração dos comentários: ID do fórum');
define($constpref.'_COM_VIEW','Vizualiação da integração dos comentários');
define($constpref.'_COM_ORDER','Ordem da integração dos comentários');
define($constpref.'_COM_POSTSNUM','Máximo de posts mostrados na Integração dos comentários');

}


?>
