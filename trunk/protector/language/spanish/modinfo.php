<?php /* Spanish Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Módulo para proteger a su XOOPS contra ataques mal intencionados, en especial ataques como DoS, SQL Injection y varios tipos de contaminaciones.<br />Para utilizar este bloque correctamente, ud. debe ponerlo en el tope de los bloques izquierdos (weight de menor valor) en todas las páginas.<br />No se olvide de dar los permiso de acceso a este bloque al grupo de Anónimos.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","Para usar este bloco correctamente, ud. debe ponerlo en el tope de los bloques izquierdos (weight de menor valor) en todas las páginas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de protección");
define("_MI_PROTECTOR_ADVISORY","Guía de seguridad");
define("_MI_PROTECTOR_PREFIXMANAGER","Gerenciador de PREFIX");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','Interrupción temporaria de funcionamiento');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Se suspenderá el funcionamiento de todas las protecciones.<br />Trás solucionar los problemas, no te olvides de desactivarla.');
define('_MI_PROTECTOR_LOG_LEVEL','Nivel de logging');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','No generar log');
define('_MI_PROTECTOR_LOGLEVEL15','Hacer log solamente de elementos de alto peligro');
define('_MI_PROTECTOR_LOGLEVEL63','No hacer log de elementos de bajo peligro');
define('_MI_PROTECTOR_LOGLEVEL255','Activar logging de todo');

define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos cuyas IPs serán baneados por cambio de dirección");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevención contra session hi-jacking:<br />Elige los grupos cuya IP se baneará si durante una sesión su dirección cambiar.<br />(Recomendado: Administradores)");
define("_MI_PROTECTOR_SAN_NULLBYTE","Sustituir caracteres nulos por espacio");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","El caracter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />Siempre que detectado, se sustituirá por un espacio.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encierre forzado de sesión en caso de detección de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","El caracter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encierre forzado de sesión en caso de subidas con extensiónes prohibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Cuando se hagan subidas con extensiones prohibidas, como .php, se borrará la sesión. (No recomendado si usas B-Wiki o PukiWikiMod y adjuntas codigos-fuente PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Medida en caso de detección de ataque por contaminación");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Elige como reaccionar cuando se detecte un intento de cambio de las globales de sistema de XOOPS.<br />(Padrão: \"Encierre forzado\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Medida en caso de detección de comentário isolado");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevención contra SQL injection:<br />Elige como reaccionar cuando se detecte un comentario isolado /* sin su par */.<br />Proceso de sanitización: se insere un */ al final.<br />(Recomendado: \"Sanitización\")");
define("_MI_PROTECTOR_UNION_ACTION","Medida en caso de detección de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevención contra SQL injection:<br />Elige como reaccionar cuando se detecte una sintaxis UNION de SQL.<br />Proceso de sanitización: UNION se convertirá en uni-on.<br />(Recomendado: \"Sanitización\")");
define("_MI_PROTECTOR_ID_INTVAL","Transformación forzada (intval) de variable ID");
define("_MI_PROTECTOR_ID_INTVALDSC","El valor de variable id debe ser siempre un número. Eficaz especialmente con módulos derivados de myLinks, protege también contra algunos XSS y SQL injection. Entretanto, puede conflictar con algunos módulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Corregir wrapping sospechosos");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Cuando se pida un archivo (a traves de wrap), se removerán los \"..\".");

define("_MI_PROTECTOR_DOS_EXPIRE","Tiempo de espia de ataques DoS (en segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Cantidad de tiempo de espia para acompañar la frecuencia de accesos de crawlers que ejecuten DoS y contaminaciones.");

define("_MI_PROTECTOR_DOS_F5COUNT","Nº de veces para que se reconozca como ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defensa contra ataques DoS:<br />Dentro del tiempo de espia definido arriba y el nº de veces aquí definido, cuando hayan muchos accesos a una única URL, se reconocerá como un ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","Nº de veces para que se reconozca a un crawler como malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Defensa contra crawlers maliciosos (como bots cazadores de e-mails):<br />Dentro del tiempo de espia definido arriba e do nº de veces aquí definido, cuando se hagan buscas dentro del sítio, se reconocerá como crawler malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Medidas contra crawlers maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Es incondicional, por lo que debes inserir los nombres de los crawlers frecuentes con una perl regex pattern.<br />Ex.:) /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nada (sólo generar log)");
define("_MI_PROTECTOR_OPT_SAN","Sanitización");
define("_MI_PROTECTOR_OPT_EXIT","Encierre forzado");
define("_MI_PROTECTOR_OPT_BIP","Banear la IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nada (sólo generar log)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Agregar como IP baneado");
define('_MI_PROTECTOR_DOSOPT_HTA','DENY by .htaccess (experimental)');

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos cuyas IPs no deben ser baneados");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Cuando se satisfaza la condición, los grupos de usuários seleccionados aquí no serán baneados. Entretanto, si estos usuários no se identifican, esta opción no tiene ningún efecto. (Recomendado para Administradores)");
define("_MI_PROTECTOR_PATCH2092","Patches contra vulnerabilidades en XOOPS <= 2.0.9.2");
define("_MI_PROTECTOR_PASSWD_BIP","Contraseña de reparo");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta es la forma de reparo, si por alguna razón, se le ha baneado la IP en XOOPS.<br />Acceda a XOOPS_URL/modules/protector/admin/rescue.php, y inserta la contraseña definida aquí.<br />Si no ud. define ninguna, el efecto de esta opción se anulará. Así que, ¡ten cuidado!");
?>