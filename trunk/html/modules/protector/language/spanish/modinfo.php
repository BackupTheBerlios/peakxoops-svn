<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","M��ulo para proteger el XOOPS de ataques intencionados, en especial: ataques de denegaci�� de servicio (DoS), inyecci�� de SQL y contaminaciones por variable.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","Para utilizar este bloque correctamente, usted debe ponerlo en el tope de los bloques izquierdos (carga de menor valor) en todas las p��inas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de protecci��");
define("_MI_PROTECTOR_ADVISORY","Gu�� de seguridad");
define("_MI_PROTECTOR_PREFIXMANAGER","Gestor de prefijos");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrupci�� temporaria de funcionamiento");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporalmente el funcionamiento de todas las protecciones.<br />Tras haber solucionado los problemas, no se olvide de desactivarla.");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs fiables");
define("_MI_PROTECTOR_RELIABLE_IPSDSC","Indica las direcciones de IP que no ser�� examinadas por ataque DoS, separados por |. ^ para prefijo, y $ para sufijo del string.");
define("_MI_PROTECTOR_LOG_LEVEL","Nivel de logging");
define("_MI_PROTECTOR_LOG_LEVELDSC","");

define("_MI_PROTECTOR_LOGLEVEL0","No generar log");
define("_MI_PROTECTOR_LOGLEVEL15","Generar log de elementos de alto riesgo apenas");
define("_MI_PROTECTOR_LOGLEVEL63","No generar log de elementos de bajo riesgo");
define("_MI_PROTECTOR_LOGLEVEL255","Generar log de todos los elementos");

define("_MI_PROTECTOR_HIJACK_TOPBIT","Protecci�� de IP bits contra renovaci�� de sesi��");
define("_MI_PROTECTOR_HIJACK_TOPBITDSC","Prevenci�� de robo de sesi�� (session hijacking):<br />Por defecto es 32(bit) y protege de todos los bits.<br />Si usted usa Proxy o su direcci�� IP cambia a cada acceso, define el intervalo de bits m�� largo posible a invariaci��.<br />Ex.: Cuando haya posibilidad de variac�� dentro de 192.168.0.0~192.168.0.255, definir esta opci�� como 24(bit).");
define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos prohibidos de cambio de IP");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevenci�� de robo de sesi�� (session hijacking):<br />Seleccione los grupos cuyos usuarios se banear�� si durante una sesi�� se les cambie la direcci�� IP.<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_SAN_NULLBYTE","Sustituir caracteres nulos por espacios");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","El car��ter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />Siempre que detectado, se sustituir� por un espacio.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encierre forzado de sesi�� en caso de detecci�� de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","El car��ter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encierre forzado de sesi�� en caso de subidas con extensiones prohibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Siempre que se hagan subidas con extensiones como .php u otros archivos ejecutables en el servidor, se borrar� la sesi��. (No recomendado si usted es un usuario de B-Wiki o PukiWikiMod y adjunta c��igos-fuente PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Soluci�� en caso de detecci�� de contaminaciones por variable");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Seleccione el tipo de soluci�� cuando se detecte un intento de alteraci�� de las globales de sistema de XOOPS.<br />(Defecto: \"Encierre forzado\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Soluci�� en caso de detecci�� de comentarios asolados");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevenci�� de inyecci�� de SQL:<br />Seleccione el tipo de soluci�� cuando se detecte un comentario asolado /* sin su par */.<br />Proceso de limpieza: se inserta un */ al final.<br />(Recomendado: \"Limpieza\")");
define("_MI_PROTECTOR_UNION_ACTION","Soluci�� en caso de detecci�� de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevenci�� de inyecci�� de SQL:<br />Seleccione el tipo de soluci�� cuando se detecte una sintaxis UNION de SQL.<br />Proceso de limpieza: se cambia UNION a uni-on.<br />(Recomendado: \"Limpieza\")");
define("_MI_PROTECTOR_ID_INTVAL","Transformaci�� forzada de variable ID");
define("_MI_PROTECTOR_ID_INTVALDSC","Fuerza valores num��icos en variables de nombre terminado en \"id\". Es eficaz especialmente con m��ulos derivados de myLinks. Protege tambi�� de algunos sitios de scripting cruzado (XSS) e inyecci�� de SQL. Entretanto, puede conflictar con algunos m��ulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Proihibici�� de DirectoryTraversal");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","En un intento de DirectoryTraversal, se analizar� el pedido, y se remover� la pattern \"..\".");

define("_MI_PROTECTOR_BF_COUNT","Prevenci�� a Brute Force");
define("_MI_PROTECTOR_BF_COUNTDSC","Contra round-robin. Si, dentro de 10 minutos, se sobrepase el n�� de intentos de ingreso incorrecto definido en esta opci��, se banear� la IP.");

define("_MI_PROTECTOR_DOS_SKIPMODS","M��ulos omitidos de esp�� de alvo de DoS");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Defina los m��ulos que quieras omitir, separados por |. Activala para m��ulos de charla y similares.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tiempo de esp�� de ataques de denegaci�� de servicio (DoS) (en segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tiempo de esp�� al acompa��r la frecuencia de accesos de denegaci�� de servicio (DoS) y robots indexadores maliciosos.");

define("_MI_PROTECTOR_DOS_F5COUNT","N�� de veces para que se reconozca un ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defensa contra ataques de denegaci�� de servicio (DoS):<br />Cuando hayan muchos accesos a una ��ica URL dentro del tiempo de esp�� arriba definido y el n�� de veces definidas en esta opci��, se reconocer� como un ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","N�� de veces para que se reconozca un robot indexador malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Prevenci�� de robots indexadores maliciosos (como bots cazadores de correos):<br />Cuando se realicen b��quedas internas dentro del tiempo de esp�� arriba definido y el n�� de veces definidas en esta opci��, se reconocer� como robot indexador malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Soluci�� para robots indexadores maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Describe incondicionalmente los nombres de los robots indexadores m�� frecuentes con una perl regex pattern.<br />Ej.: /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nada (generar log apenas)");
define("_MI_PROTECTOR_OPT_SAN","Limpieza");
define("_MI_PROTECTOR_OPT_EXIT","Encierre forzado de sesi��");
define("_MI_PROTECTOR_OPT_BIP","Baneamiento por IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nada (generar log apenas)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Baneamiento por IP");
define("_MI_PROTECTOR_DOSOPT_HTA","Registro DENY a trav�� de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos libres de baneamiento por IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Aunque se satisfaga la condici��, los grupos de usuarios indicados en esta opci�� no ser�� agregadas a las IPs baneadas. Entretanto, si estos usuarios no se identifican, se anular� el efecto de esta opci��. (Recomendado para Administradores)");
define("_MI_PROTECTOR_DISABLES","Desactivar opciones inseguras");
define("_MI_PROTECTOR_PASSWD_BIP","Contrase�� de restauraci��");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta es la forma de restauraci�� si, por alguna raz��, se le agregue a las IPs baneadas de XOOPS.<br />Accede a XOOPS_URL/modules/protector/admin/rescue.php, e inserta la contrase�� aqu� definida.<br />Si usted no la define, se anular� el efecto de esta opci��. ��TEN CUIDADO!<br />Esta contrase�� ser� guardada es, por lo que puede que alguien tenga acceso a ella. As� que nunca utilice contrase��s importantes.");
?>