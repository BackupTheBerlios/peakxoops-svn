<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format


// Appended by Xoops Language Checker -GIJOE- in 2006-02-03 16:31:40
define('_MI_HEADLINES_ADMENU_MYTPLSADMIN','Templates');

// Appended by Xoops Language Checker -GIJOE- in 2005-12-30 06:53:29
define('_MI_HEADLINES_BDESC','Shows headline news via RSS/ATOM in separate cells');
define('_MI_HEADLINES_BDESC_MIXED','Shows headline news via RSS/ATOM in an aggregated view');

define('_MI_DEFAULT_DTFMT_SHORT', 'j M ah:i');

// The name of this module
define('_MI_HEADLINES_NAME', 'Titulares');

// A brief description of this module
define('_MI_HEADLINES_DESC', 'Muestra Noticias en RSS/XML de otros sitios web');

// Names of blocks for this module (Not all module has blocks)
define('_MI_HEADLINES_BNAME', 'Titulares');
define('_MI_HEADLINES_BNAME_MIXED', 'Titulares Recentes');

// Names of admin menu items
define('_MI_HEADLINES_ADMENU1', 'Listar Titulares');
define('_MI_HEADLINES_ADMENU_MYBLOCKSADMIN', 'Bloques/Grupos');

// Configs
define('_MI_HEADLINES_INDEX_VIEWMODE', 'Vista Predeterminada');
define('_MI_HEADLINES_INDEX_VIEWMODED', 'Seleccione un tipo de vista para la página principal del módulo');
define('_MI_HEADLINES_INDEX_VIEWMODE_MIXED', 'Mezclados y Nuevos arriba');
define('_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC', 'Clásico');
define('_MI_HEADLINES_MIXED_MAXITEM', 'Elementos Máx');
define('_MI_HEADLINES_MIXED_MAXITEMD', 'Especificar número máx. en la vista de titulares RSS/RDFs recientes (elementos)');
define('_MI_HEADLINES_MIXED_MAXLEN', 'Tamaño Máx');
define('_MI_HEADLINES_MIXED_MAXLEND', 'Especificar el número máx. de caracteres de los titulares recientes (byte)');
define('_MI_HEADLINES_PROXY_HOST', 'Host Proxy');
define('_MI_HEADLINES_PROXY_HOSTD', 'Si obtiene los RSS/RDF mediante un servidor proxy, ponga el nombre del host o la IP aquí<br />Si no, déjelo en blanco.');
define('_MI_HEADLINES_PROXY_PORT', 'Puerto Proxy');
define('_MI_HEADLINES_PROXY_PORTD', 'Si obtiene los RSS/RDF mediante un servidor proxy, ponga el número de puerto aquí');
define('_MI_HEADLINES_PROXY_USER', 'Usuario Proxy');
define('_MI_HEADLINES_PROXY_USERD', 'Si su servidor proxy necesita autenticación BÁSICA, ponga el nombre del usuario<br />Si no, déjelo en blanco');
define('_MI_HEADLINES_PROXY_PASS', 'Password Proxy');
define('_MI_HEADLINES_PROXY_PASSD', 'Si su servidor proxy necesita autenticación BÁSICA, ponga el password<br />Si no, déjelo en blanco');
define('_MI_HEADLINES_SHORTDTFMT', 'Formato corto de fecha y hora');
define('_MI_HEADLINES_SHORTDTFMTD', 'Descríbalo como el primer formato de la función date() de PHP.<br /><a href="http://jp.php.net/date">Véase el manual PHP</a>');
define('_MI_HEADLINES_MIXPICKUP', 'No elija un elemento como reciente si su feed tiene un número superior al máximo de elementos');
define('_MI_HEADLINES_MIXPICKUPD', 'Si fija esto en NO, la configuración \'Elementos Máx\' de cada feed será ignorada.');


}

?>
