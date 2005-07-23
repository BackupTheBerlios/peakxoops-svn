<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","M�dulo para proteger el XOOPS de ataques intencionados, en especial: ataques de denegaci�n de servicio (DoS), inyecci�n de SQL y contaminaciones por variable.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","Para utilizar este bloque correctamente, usted debe ponerlo en el tope de los bloques izquierdos (carga de menor valor) en todas las p�ginas.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Central de protecci�n");
define("_MI_PROTECTOR_ADVISORY","Gu�a de seguridad");
define("_MI_PROTECTOR_PREFIXMANAGER","Gestor de prefijos");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrupci�n temporaria de funcionamiento");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporalmente el funcionamiento de todas las protecciones.<br />Tras haber solucionado los problemas, no se olvide de desactivarla.");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs fiables");
define("_MI_PROTECTOR_RELIABLE_IPSDSC","Indica las direcciones de IP que no ser�n examinadas por ataque DoS, separados por |. ^ para prefijo, y $ para sufijo del string.");
define("_MI_PROTECTOR_LOG_LEVEL","Nivel de logging");
define("_MI_PROTECTOR_LOG_LEVELDSC","");

define("_MI_PROTECTOR_LOGLEVEL0","No generar log");
define("_MI_PROTECTOR_LOGLEVEL15","Generar log de elementos de alto riesgo apenas");
define("_MI_PROTECTOR_LOGLEVEL63","No generar log de elementos de bajo riesgo");
define("_MI_PROTECTOR_LOGLEVEL255","Generar log de todos los elementos");

define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos prohibidos de cambio de IP");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevenci�n de robo de sesi�n (session hijacking):<br />Seleccione los grupos cuyos usuarios se banear�n si durante una sesi�n se les cambie la direcci�n IP.<br />(Recomendado: \"Administradores\")");
define("_MI_PROTECTOR_SAN_NULLBYTE","Sustituir caracteres nulos por espacios");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","El car�cter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />Siempre que detectado, se sustituir� por un espacio.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_NULLBYTE","Encierre forzado de sesi�n en caso de detecci�n de caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","El car�cter \"\\0\" fatal es usado con frecuencia en ataques maliciosos.<br />(Recomendado)");
define("_MI_PROTECTOR_DIE_BADEXT","Encierre forzado de sesi�n en caso de subidas con extensiones prohibidas");
define("_MI_PROTECTOR_DIE_BADEXTDSC","Siempre que se hagan subidas con extensiones como .php u otros archivos ejecutables en el servidor, se borrar� la sesi�n. (No recomendado si usted es un usuario de B-Wiki o PukiWikiMod y adjunta c�digos-fuente PHP.)");
define("_MI_PROTECTOR_CONTAMI_ACTION","Soluci�n en caso de detecci�n de contaminaciones por variable");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Seleccione el tipo de soluci�n cuando se detecte un intento de alteraci�n de las globales de sistema de XOOPS.<br />(Defecto: \"Encierre forzado\")");
define("_MI_PROTECTOR_ISOCOM_ACTION","Soluci�n en caso de detecci�n de comentarios asolados");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevenci�n de inyecci�n de SQL:<br />Seleccione el tipo de soluci�n cuando se detecte un comentario asolado /* sin su par */.<br />Proceso de limpieza: se inserta un */ al final.<br />(Recomendado: \"Limpieza\")");
define("_MI_PROTECTOR_UNION_ACTION","Soluci�n en caso de detecci�n de UNION");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevenci�n de inyecci�n de SQL:<br />Seleccione el tipo de soluci�n cuando se detecte una sintaxis UNION de SQL.<br />Proceso de limpieza: se cambia UNION a uni-on.<br />(Recomendado: \"Limpieza\")");
define("_MI_PROTECTOR_ID_INTVAL","Transformaci�n forzada de variable ID");
define("_MI_PROTECTOR_ID_INTVALDSC","Fuerza valores num�ricos en variables de nombre terminado en \"id\". Es eficaz especialmente con m�dulos derivados de myLinks. Protege tambi�n de algunos sitios de scripting cruzado (XSS) e inyecci�n de SQL. Entretanto, puede conflictar con algunos m�dulos.");
define("_MI_PROTECTOR_FILE_DOTDOT","Proihibici�n de DirectoryTraversal");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","En un intento de DirectoryTraversal, se analizar� el pedido, y se remover� la pattern \"..\".");

define("_MI_PROTECTOR_BF_COUNT","Prevenci�n a Brute Force");
define("_MI_PROTECTOR_BF_COUNTDSC","Contra round-robin. Si, dentro de 10 minutos, se sobrepase el n� de intentos de ingreso incorrecto definido en esta opci�n, se banear� la IP.");

define("_MI_PROTECTOR_DOS_SKIPMODS","M�dulos omitidos de esp�a de alvo de DoS");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Defina los m�dulos que quieras omitir, separados por |. Activala para m�dulos de charla y similares.");

define("_MI_PROTECTOR_DOS_EXPIRE","Tiempo de esp�a de ataques de denegaci�n de servicio (DoS) (en segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tiempo de esp�a al acompa�ar la frecuencia de accesos de denegaci�n de servicio (DoS) y robots indexadores maliciosos.");

define("_MI_PROTECTOR_DOS_F5COUNT","N� de veces para que se reconozca un ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defensa contra ataques de denegaci�n de servicio (DoS):<br />Cuando hayan muchos accesos a una �nica URL dentro del tiempo de esp�a arriba definido y el n� de veces definidas en esta opci�n, se reconocer� como un ataque.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","N� de veces para que se reconozca un robot indexador malicioso");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Prevenci�n de robots indexadores maliciosos (como bots cazadores de correos):<br />Cuando se realicen b�squedas internas dentro del tiempo de esp�a arriba definido y el n� de veces definidas en esta opci�n, se reconocer� como robot indexador malicioso.");
define("_MI_PROTECTOR_DOS_CRACTION","Soluci�n para robots indexadores maliciosos");

define("_MI_PROTECTOR_DOS_CRSAFE","User-Agent permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Describe incondicionalmente los nombres de los robots indexadores m�s frecuentes con una perl regex pattern.<br />Ej.: /(msnbot|Googlebot|Yahoo! Slurp)/i");

define("_MI_PROTECTOR_OPT_NONE","Nada (generar log apenas)");
define("_MI_PROTECTOR_OPT_SAN","Limpieza");
define("_MI_PROTECTOR_OPT_EXIT","Encierre forzado de sesi�n");
define("_MI_PROTECTOR_OPT_BIP","Baneamiento por IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nada (generar log apenas)");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Sleep");
define("_MI_PROTECTOR_DOSOPT_EXIT","exit");
define("_MI_PROTECTOR_DOSOPT_BIP","Baneamiento por IP");
define("_MI_PROTECTOR_DOSOPT_HTA","Registro DENY a trav�s de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos libres de baneamiento por IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Aunque se satisfaga la condici�n, los grupos de usuarios indicados en esta opci�n no ser�n agregadas a las IPs baneadas. Entretanto, si estos usuarios no se identifican, se anular� el efecto de esta opci�n. (Recomendado para Administradores)");
define("_MI_PROTECTOR_PATCH2092","Parches contra vulnerabilidades de XOOPS &#8804; 2.0.9.2");
define("_MI_PROTECTOR_PASSWD_BIP","Contrase�a de restauraci�n");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Esta es la forma de restauraci�n si, por alguna raz�n, se le agregue a las IPs baneadas de XOOPS.<br />Accede a XOOPS_URL/modules/protector/admin/rescue.php, e inserta la contrase�a aqu� definida.<br />Si usted no la define, se anular� el efecto de esta opci�n. �TEN CUIDADO!<br />Esta contrase�a ser� guardada es, por lo que puede que alguien tenga acceso a ella. As� que nunca utilice contrase�as importantes.");
?>