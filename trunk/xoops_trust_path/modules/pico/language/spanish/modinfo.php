<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'pico' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2007-03-06 04:56:32
define($constpref.'_FILTERSF','Forced filters');
define($constpref.'_FILTERSFDSC','input filter names separated with ,(comma). filter:LAST means the filter is passed in the last phase. The other filters are passed in the first phase.');
define($constpref.'_FILTERSP','Prohibited filters');
define($constpref.'_FILTERSPDSC','input filter names separated with ,(comma).');

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","pico");

// A brief description of this module
define($constpref."_DESC","M�dulo para contenido est�tico");

// admin menus
define( $constpref.'_ADMENU_CONTENTSADMIN' , 'Lista de contenidos' ) ;
define( $constpref.'_ADMENU_CATEGORYACCESS' , 'Permisos de Categor�as' ) ;
define( $constpref.'_ADMENU_IMPORT' , 'Importar/Sincronizar' ) ;

// configurations
define($constpref.'_USE_WRAPSMODE','Habilitar modo de arropado');
define($constpref.'_WRAPSAUTOREGIST','Habilitar el auto-registro de archivos HTML arropados en la base de datos como contenido');
define($constpref.'_TOP_MESSAGE','Descripci�n de categor�a PRINCIPAL');
define($constpref.'_TOP_MESSAGEDEFAULT','');
define($constpref.'_MENUINMODULETOP','Mostrar men� (�ndice) en la parte superior de este m�dulo');
define($constpref.'_LISTASINDEX',"Mostrar �ndice de contenidos en la parte superior de la categor�a");
define($constpref.'_LISTASINDEXDSC','S� significa que la lista autom�tica es mostrada en la parte superior de la categor�a. NO significa que un contenido con la prioridad m�s alta es mostrado en lugar de la lista autom�tica');
define($constpref.'_SHOW_BREADCRUMBS','Mostrar breadcrumbs');
define($constpref.'_SHOW_PAGENAVI','Mostrar navegaci�n de p�gina');
define($constpref.'_SHOW_PRINTICON','Mostrar icono de versi�n para imprimir');
define($constpref.'_SHOW_TELLAFRIEND','Mostrar icono de avisa a un amigo');
define($constpref.'_USE_TAFMODULE','Emplear m�dulo "avisa a un amigo"');
define($constpref.'_FILTERS','Juego de filtros default');
define($constpref.'_FILTERSDSC','Ingresar nombres filtro separados con | (barra vertical)');
define($constpref.'_FILTERSDEFAULT','htmlspecialchars|smiley|xcode|nl2br');
define($constpref.'_USE_VOTE','Emplear funci�n de VOTAR');
define($constpref.'_GUESTVOTE_IVL','Votos de an�nimos');
define($constpref.'_GUESTVOTE_IVLDSC','Fijar en cero (0) para deshabilitar votos de an�nimos. Otro n�mero significa tiempo en segundos para permitir un segundo voto del mismo n�mero IP.');
define($constpref.'_HTMLHEADER','Encabezado HTML com�n');
define($constpref.'_CSS_URI','URI del archivo CSS de este m�dulo');
define($constpref.'_CSS_URIDSC','Puede emplearse ruta relativa o absoluta. default: {mod_url}/index.css');
define($constpref.'_IMAGES_DIR','Directorio para archivo de im�genes');
define($constpref.'_IMAGES_DIRDSC','La ruta relativa debe ser fijada en el directorio del m�dulo. Default: images');
define($constpref.'_BODY_EDITOR','Editor de texto');
define($constpref.'_COM_DIRNAME','Integraci�n de comentario: dirname de d3forum');
define($constpref.'_COM_FORUM_ID','Integraci�n de comentario: ID de foro');

// blocks
define($constpref.'_BNAME_MENU','Men�');
define($constpref.'_BNAME_CONTENT','Contenido');
define($constpref.'_BNAME_LIST','Lista');

// Notify Categories
define($constpref.'_NOTCAT_GLOBAL', 'Global');
define($constpref.'_NOTCAT_GLOBALDSC', 'Notificaciones para este m�dulo');

// Each Notifications
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENT', 'En espera');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTCAP', 'Notificar si nuevos env�os o modificaciones est�n en espera de aprobaci�n (s�lo notificar a administradores o moderadores)');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCONTENTSBJ', '[{X_SITENAME}] {X_MODULE}: en espera');

}


?>