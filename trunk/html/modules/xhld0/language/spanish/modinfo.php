<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format

// Appended by Xoops Language Checker -GIJOE- in 2005-08-09 17:42:01
define('_MI_HEADLINES_BDESC','Shows headline news via RSS/ATOM in separate cells');
define('_MI_HEADLINES_BDESC_MIXED','Shows headline news via RSS/ATOM in an aggregated view');

define("_MI_DEFAULT_DTFMT_SHORT","j M ah:i");

// The name of this module
define("_MI_HEADLINES_NAME","titulares");

// A brief description of this module
define("_MI_HEADLINES_DESC","Muestra Noticias en RSS/XML de otros sitios web");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Titualres");
define("_MI_HEADLINES_BNAME_MIXED","Titulares Recentes");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Listar titulares");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Bloques/Grupos");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Vista Predeterminada");
define("_MI_HEADLINES_INDEX_VIEWMODED","Seleccione un tipo de vista para el tope del m…Åulo");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Mezclados & MáÔ nuevos arriba");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","CláÔico");
define("_MI_HEADLINES_MIXED_MAXITEM","MáÙ elementos");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Especificar n“Îero máÙ. en la vista de titulares RSS/RDFs recientes (elementos)");
define("_MI_HEADLINES_MIXED_MAXLEN","TamaÐ MáÙ");
define("_MI_HEADLINES_MIXED_MAXLEND", "Especificar el n“Îero máÙ. de caracteres de los titulares recientes (byte)");
define("_MI_HEADLINES_PROXY_HOST","Host Proxy");
define("_MI_HEADLINES_PROXY_HOSTD","Si optiene los RSS/RDF mediante un servidor proxy, ponga el nombre del host o la IP aquí<br />Si no, dejar en blanco.");
define("_MI_HEADLINES_PROXY_PORT","Puerto Proxy");
define("_MI_HEADLINES_PROXY_PORTD","Si optiene los RSS/RDF mediante un servidor proxy, ponga el n“Îero de puerto aquí") ;
define("_MI_HEADLINES_PROXY_USER","Usuario Proxy");
define("_MI_HEADLINES_PROXY_USERD","Si su servidor proxy necesita autenticaci…Ï BŽÁSICA, ponga el nombre del usuario<br />Si no, dejar en blanco") ;
define("_MI_HEADLINES_PROXY_PASS","Password Proxy");
define("_MI_HEADLINES_PROXY_PASSD","Si su servidor proxy necesita autenticaci…Ï BŽÁSICA, ponga el password<br />Si no, dejar en blanco") ;
define("_MI_HEADLINES_SHORTDTFMT","Short format of date&time");
define("_MI_HEADLINES_SHORTDTFMTD","Describe it as the first parameter of PHP function date().<br /><a href='http://jp.php.net/date'>Refer to PHP manual</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Don't pick up an item as recent if its feeds is over-numbered than max items");
define("_MI_HEADLINES_MIXPICKUPD","If you set this No, 'Max items' of each feeds are ignored.");

}

?>
