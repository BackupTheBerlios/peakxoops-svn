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

define('_AM_DBUPDATED','��Base de Datos Actualizada Correctamente!');
define('_AM_HEADLINES','Configuraci�� de los Titulares (No.%s)');
define('_AM_HLMAIN','Titular Principal');
define('_AM_SITENAME','Nombre del Sitio');
define('_AM_URL','URL');
define('_AM_TITLEPATTERN','Extraer con texto de t��ulo<br /><span style="font-weight:normal;">escriva aqu� una expresi�� regular de perl ej.) /dolar/</span>');
define('_AM_LINKPATTERN','Extraer con texto de enlace<br /><span style="font-weight:normal;">escriva aqu� uma expresi�� regular de perl ej.) /negocios/</span>');
define('_AM_ORDER', 'Orden');
define('_AM_ENCODING', 'Codificaci�� RSS');
define('_AM_CACHETIME', 'Tiempo de Cache');
define('_AM_TIMEOUT', 'Time-out when fetching');
define('_AM_ALLOWHTML', 'Allow to display HTML inside XML<br /><span style="font-weight:normal;">You should not allow HTML to a RSS/ATOM which is generated from posts by visitors of the site.</span>');
define('_AM_MAINSETT', 'Configuraciones de P��ina Principal');
define('_AM_BLOCKSETT', 'Configuraciones de Bloque');
define('_AM_DISPLAY', 'Mostrar en p��ina principal');
define('_AM_DISPIMG', 'Mostrar im��em');
define('_AM_DISPFULL', 'Exibir descripci�� y fecha de publucaci�� tambi��');
define('_AM_DISPMAX', 'M�� elementos a mostrar');
define('_AM_ASBLOCK', 'Mostrar en bloque');
define('_AM_ADDHEADL','A��dir Titular');
define('_AM_URLEDFXML','URL del RSS/ATOM');
define('_AM_SYNDICATIONTYPE','Type of the feed');
define('_AM_SYNDICATIONTYPE_AUTO','Auto');
define('_AM_SAVEAS','Save As');
define('_AM_UPDATE','Update & Refetch');
define('_AM_EDITHEADL','Editar Titular');
define('_AM_WANTDEL','Est� seguro que desea borrar el titular para %s?');
define('_AM_INVALIDID', 'ID Inv��ido');
define('_AM_OBJECTNG', 'Objeto no existe');
define('_AM_FAILUPDATE', 'Fallo al guardar informaci�� en la base de datos para el titular %s');
define('_AM_FAILDELETE', 'Fallo al borrar informaci�� de la base de datos para el titular %s');

}

?>
