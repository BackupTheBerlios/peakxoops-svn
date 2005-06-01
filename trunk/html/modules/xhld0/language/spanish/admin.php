<?php
// $Id: admin.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
//%%%%%%        Admin Module Name  Headlines         %%%%%

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_AM_DBUPDATED' ) ) {

// list of encodings allowed   (name):(title)|(name):(title)|...

// Appended by Xoops Language Checker -GIJOE- in 2005-02-11 11:02:39
define('_AM_TITLEEXCLUDE','Exclude with title string<br /><span style="font-weight:normal;">(perl regex) Normally left blank</span>');
define('_AM_LINKEXCLUDE','Exclude with link string<br /><span style="font-weight:normal;">(perl regex) Normally left blank</span>');

define('_AM_ENCODINGS','utf-8:UTF-8|iso-8859-1:ISO-8859-1|us-ascii:US-ASCII') ;
define('_AM_ENCODING_AUTO','auto detection') ;

define('_AM_DBUPDATED','¿Base de Datos Actualizada Correctamente!');
define('_AM_HEADLINES','Configuración de los Titulares (No.%s)');
define('_AM_HLMAIN','Titular Principal');
define('_AM_SITENAME','Nombre del Sitio');
define('_AM_URL','URL');
define('_AM_TITLEPATTERN','Extraer con texto de título<br /><span style="font-weight:normal;">escriva aquí una expresión regular de perl ej.) /dolar/</span>');
define('_AM_LINKPATTERN','Extraer con texto de enlace<br /><span style="font-weight:normal;">escriva aquí uma expresión regular de perl ej.) /negocios/</span>');
define('_AM_ORDER', 'Orden');
define('_AM_ENCODING', 'Codificación RSS');
define('_AM_CACHETIME', 'Tiempo de Cache');
define('_AM_TIMEOUT', 'Time-out when fetching');
define('_AM_ALLOWHTML', 'Allow to display HTML inside XML<br /><span style="font-weight:normal;">You should not allow HTML to a RSS/ATOM which is generated from posts by visitors of the site.</span>');
define('_AM_MAINSETT', 'Configuraciones de Página Principal');
define('_AM_BLOCKSETT', 'Configuraciones de Bloque');
define('_AM_DISPLAY', 'Mostrar en página principal');
define('_AM_DISPIMG', 'Mostrar imágem');
define('_AM_DISPFULL', 'Exibir descripción y fecha de publucación también');
define('_AM_DISPMAX', 'Máx elementos a mostrar');
define('_AM_ASBLOCK', 'Mostrar en bloque');
define('_AM_ADDHEADL','Añadir Titular');
define('_AM_URLEDFXML','URL del RSS/ATOM');
define('_AM_SYNDICATIONTYPE','Type of the feed');
define('_AM_SYNDICATIONTYPE_AUTO','Auto');
define('_AM_SAVEAS','Save As');
define('_AM_UPDATE','Update & Refetch');
define('_AM_EDITHEADL','Editar Titular');
define('_AM_WANTDEL','Está seguro que desea borrar el titular para %s?');
define('_AM_INVALIDID', 'ID Inválido');
define('_AM_OBJECTNG', 'Objeto no existe');
define('_AM_FAILUPDATE', 'Fallo al guardar información en la base de datos para el titular %s');
define('_AM_FAILDELETE', 'Fallo al borrar información de la base de datos para el titular %s');

}

?>
