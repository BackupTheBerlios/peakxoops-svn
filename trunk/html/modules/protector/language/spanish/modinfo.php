<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Módulo para proteger el XOOPS de ataques intencionados, en especial: ataques de denegación de servicio (DoS), inyección de SQL y contaminaciones por variable.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","Para utilizar este bloque correctamente, usted debe ponerlo en el tope de los bloques izquierdos (carga de menor valor) en todas las páginas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de protección");
define("_MI_PROTECTOR_ADVISORY","Guía de seguridad");
define("_MI_PROTECTOR_PREFIXMANAGER","Gestor de prefijos");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrupción temporaria de funcionamiento");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporalmente el funcionamiento de todas las protecciones.<br />Tras haber solucionado los problemas, no se olvide de desactivarla.");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs fiables");
define("_MI_PROTECTOR_RELIABLE_IPSDSC","Indica las direcciones de IP que no serán examinadas por ataque DoS, separados por |. ^ para prefijo, y $ para sufijo del string.");
define("_MI_PROTECTOR_LOG_LEVEL","Nivel de logging");
define("_MI_PROTECTOR_LOG_LEVELDSC","");

define("_MI_PROTECTOR_LOGLEVEL0","No generar log");
define("_MI_PROTECTOR_LOGLEVEL15","Generar log de elementos de alto riesgo apenas");
define("_MI_PROTECTOR_LOGLEVEL63","No generar log de elementos de bajo riesgo");
define("_MI_PROTECTOR_LOGLEVEL255","Generar log de todos los elementos");

define("_MI_PROTECTOR_HIJACK_TOPBIT","Protección de IP bits contra renovación de sesión");
define("_MI_PROTECTOR_HIJACK_TOPBITDSC","Prevención de robo de sesión (session hijacking):<br />Por defecto es 32(bit) y protege de todos los bits.<br />Si usted usa Proxy o su dirección IP cambia a cada acceso, define el intervalo de bits más largo posible a invariación.<br />Ex.: Cuando haya posibilidad de variacón dentro de 192.168.0.0~192.168.0.255, definir esta opción como 24(bit).");
define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos prohibidos de cambio de IP");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevención de robo de sesión (session hijacking):<br />Seleccione los grupos cuyos usuarios se banearán si durante una sesión se les cambie la dirección IP.<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_SAN_NULLBYTE","Sustituir caracteres nulos por espacios");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","El carácter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />Siempre que detectado, se sustituirá por un espacio.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encierre forzado de sesión en caso de detección de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","El carácter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encierre forzado de sesión en caso de subidas con extensiones prohibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Siempre que se hagan subidas con extensiones como .php u otros archivos ejecutables en el servidor, se borrará la sesión. (No recomendado si usted es un usuario de B-Wiki o PukiWikiMod y adjunta códigos-fuente PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Solución en caso de detección de contaminaciones por variable");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Seleccione el tipo de solución cuando se detecte un intento de alteración de las globales de sistema de XOOPS.<br />(Defecto: \"Encierre forzado\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Solución en caso de detección de comentarios asolados");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevención de inyección de SQL:<br />Seleccione el tipo de solución cuando se detecte un comentario asolado /* sin su par */.<br />Proceso de limpieza: se inserta un */ al final.<br />(Recomendado: \"Limpieza\")");
define("_MI_PROTECTOR_UNION_ACTION","Solución en caso de detección de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevención de inyección de SQL:<br />Seleccione el tipo de solución cuando se detecte una sintaxis UNION de SQL.<br />Proceso de limpieza: se cambia UNION a uni-on.<br />(Recomendado: \"Limpieza\")");
define("_MI_PROTECTOR_ID_INTVAL","Transformación forzada de variable ID");
define("_MI_PROTECTOR_ID_INTVALDSC","Fuerza valores numéricos en variables de nombre terminado en \"id\". Es eficaz especialmente con módulos derivados de myLinks. Protege también de algunos sitios de scripting cruzado (XSS) e inyección de SQL. Entretanto, puede conflictar con algunos módulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Proihibición de DirectoryTraversal");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","En un intento de DirectoryTraversal, se analizará el pedido, y se removerá la pattern \"..\".");

define("_MI_PROTECTOR_BF_COUNT","Prevención a Brute Force");
define("_MI_PROTECTOR_BF_COUNTDSC","Contra round-robin. Si, dentro de 10 minutos, se sobrepase el nº de intentos de ingreso incorrecto definido en esta opción, se baneará la IP.");

define("_MI_PROTECTOR_DOS_SKIPMODS","Módulos omitidos de espía de alvo de DoS");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Defina los módulos que quieras omitir, separados por |. Activala para módulos de charla y similares.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tiempo de espía de ataques de denegación de servicio (DoS) (en segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tiempo de espía al acompañar la frecuencia de accesos de denegación de servicio (DoS) y robots indexadores maliciosos.");

define("_MI_PROTECTOR_DOS_F5COUNT","Nº de veces para que se reconozca un ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defensa contra ataques de denegación de servicio (DoS):<br />Cuando hayan muchos accesos a una única URL dentro del tiempo de espía arriba definido y el nº de veces definidas en esta opción, se reconocerá como un ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","Nº de veces para que se reconozca un robot indexador malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Prevención de robots indexadores maliciosos (como bots cazadores de correos):<br />Cuando se realicen búsquedas internas dentro del tiempo de espía arriba definido y el nº de veces definidas en esta opción, se reconocerá como robot indexador malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Solución para robots indexadores maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Describe incondicionalmente los nombres de los robots indexadores más frecuentes con una perl regex pattern.<br />Ej.: /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nada (generar log apenas)");
define("_MI_PROTECTOR_OPT_SAN","Limpieza");
define("_MI_PROTECTOR_OPT_EXIT","Encierre forzado de sesión");
define("_MI_PROTECTOR_OPT_BIP","Baneamiento por IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nada (generar log apenas)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Baneamiento por IP");
define("_MI_PROTECTOR_DOSOPT_HTA","Registro DENY a través de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos libres de baneamiento por IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Aunque se satisfaga la condición, los grupos de usuarios indicados en esta opción no serán agregadas a las IPs baneadas. Entretanto, si estos usuarios no se identifican, se anulará el efecto de esta opción. (Recomendado para Administradores)");
define("_MI_PROTECTOR_DISABLES","Desactivar opciones inseguras");
define("_MI_PROTECTOR_PASSWD_BIP","Contraseña de restauración");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta es la forma de restauración si, por alguna razón, se le agregue a las IPs baneadas de XOOPS.<br />Accede a XOOPS_URL/modules/protector/admin/rescue.php, e inserta la contraseña aquí definida.<br />Si usted no la define, se anulará el efecto de esta opción. ¡TEN CUIDADO!<br />Esta contraseña será guardada es, por lo que puede que alguien tenga acceso a ella. Así que nunca utilice contraseñas importantes.");
?>