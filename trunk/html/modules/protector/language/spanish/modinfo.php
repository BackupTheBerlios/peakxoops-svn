<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> and Mel Bezos <http://www.bezoops.net> */
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","M&oacute;dulo para proteger XOOPS de ataques malintencionados, como ataques de denegaci&oacute;n de servicio (DoS), inyecci&oacute;n de SQL y contaminaciones de variables.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector"); //Ya no se usa
//define("_MI_PROTECTOR_BDESC1","Para que este m&oacute;dulo funcione correctamente, debe ponerlo el primero en el orden de los bloques de la izquierda (peso u orden de menor valor) en todas las p&aacute;ginas."); //Ya no se usa

// Menu
define("_MI_PROTECTOR_ADMININDEX","Bloqueo de ataques");
define("_MI_PROTECTOR_ADVISORY","Gu&iacute;a de seguridad");
define("_MI_PROTECTOR_PREFIXMANAGER","Gestor de prefijos");

// Configs
define("_MI_PROTECTOR_GLOBAL_DISBL","Interrupci&oacute;n temporal de protecciones.");
define("_MI_PROTECTOR_GLOBAL_DISBLDSC","Suspende temporalmente el funcionamiento de todas las protecciones.<br />Tras haber solucionado los problemas, no se olvide de volver a desactivarla, marcando [No]");
define("_MI_PROTECTOR_RELIABLE_IPS","IPs de confianza");

define("_MI_PROTECTOR_RELIABLE_IPSDSC","Direcciones IP (separados por |) que <b>no</b> ser&aacute;n examinadas cuando ocurra un ataque DoS, .<br />Comod&iacute;n \"incluye esta cadena\" <b>^</b> se pone al inicio y <b>$</b> al final (el resultado es el mismo). Ej: ^192.168. &oacute; 127.0.0.$'");
define("_MI_PROTECTOR_LOG_LEVEL","Datos a grabar en registro de eventos (log)<br />situado en <a href='index.php#logprot'>[Bloqueo de Ataques]</a>, en el listado inferior");
define("_MI_PROTECTOR_LOG_LEVELDSC","Datos a grabar para el registro de eventos, visible en <a href='index.php#logprot'>[Bloqueo de Ataques]</a>, en el listado inferior");

define("_MI_PROTECTOR_LOGLEVEL0","No generar log");
define("_MI_PROTECTOR_LOGLEVEL15","Solo Incluir elementos de alto riesgo");
define("_MI_PROTECTOR_LOGLEVEL63","Solo Excluir elementos de bajo riesgo");
define("_MI_PROTECTOR_LOGLEVEL255","Todos los elementos");

define("_MI_PROTECTOR_HIJACK_TOPBIT","N&ordm; de bits de IP a proteger en sesiones");
define("_MI_PROTECTOR_HIJACK_TOPBITDSC","Bits de direcci&oacute;n IP para proteger de Robo de Sesi&oacute;n:<br />Por defecto: 32 (bits), todo el rango de octetos protegido.");

define("_MI_PROTECTOR_HIJACK_DENYGP","Grupos prevenir cambio de IP durante una sesi&oacute;n");
define("_MI_PROTECTOR_HIJACK_DENYGPDSC","Prevenci&oacute;n de robo de sesi&oacute;n (session hijacking):<br />Seleccione los grupos cuyos usuarios se bloquear&aacute;n (banear&aacute;n) si durante una sesi&oacute;n cambia su direcci&oacute;n IP. <br />* Recomendado: [Administradores]");

define("_MI_PROTECTOR_SAN_NULLBYTE","Sanear car&aacute;cteres nulos");
define("_MI_PROTECTOR_SAN_NULLBYTEDSC","Usar el car&aacute;cter nulo \"\\0\" incluido en una Url, se usa con frecuencia en ataques malintencionados.<br />Siempre que se detecte, se sustituir&aacute; por un espacio.<br />* Muy Recomendado: [Si]");

define("_MI_PROTECTOR_DIE_NULLBYTE","Cerrar la sesi&oacute;n al detectar caracteres nulos");
define("_MI_PROTECTOR_DIE_NULLBYTEDSC","Cierre forzado de la sesi&oacute;n del usuario en caso de detecci&oacute;n de caracteres nulos \"\\0\" es peligroso ante ataques malintencionados.<br /><br />Activando esta opci&oacute;n, se cierra la sesi&oacute;n del usuario que lo haya intentado enviar, provocando que salga como registrado (logout)<br />* Recomendado: [Si]");
define("_MI_PROTECTOR_DIE_BADEXT","Cierre forzado de sesi&oacute;n en caso de subidas (upload) al servidor de ficheros con extensiones prohibidas");

define("_MI_PROTECTOR_DIE_BADEXTDSC","Si se suben ficheros ejecutables al servidor, con extensiones php, phtml, phtm, php3, php4, cgi, pl, o asp, se cerrar&aacute; la sesi&oacute;n de ese usuario (saldr&aacute; como registrado o logout).<br />* No recomendado si hay instalados m&oacute;dulos B-Wiki o PukiWikiMod y se adjuntan ficheros con c&oacute;digo fuente PHP.");
define("_MI_PROTECTOR_CONTAMI_ACTION","Detecci&oacute;n de contaminaci&oacute;n de variables. El atacante intenta modificar una variable de Xoops (no de php)");
define("_MI_PROTECTOR_CONTAMI_ACTIONDS","Tipo de acci&oacute;n cuando se detecte un intento de alteraci&oacute;n de las variables globales de sistema de XOOPS.<br />* Por defecto: [Cierre forzado]");

define("_MI_PROTECTOR_ISOCOM_ACTION","Detecci&oacute;n de comentario php solitario");
define("_MI_PROTECTOR_ISOCOM_ACTIONDSC","Prevenci&oacute;n de inyecci&oacute;n de SQL:<br />Seleccione el tipo de soluci&oacute;n cuando se detecte un comentario php /* sin su pareja de cierre *\.<br />M&eacute;todo Sanear: se inserta un *\ justo despu&eacute;s.<br />Recomendado: [Sanear]");

define("_MI_PROTECTOR_UNION_ACTION","Detecci&oacute;n de instrucci&oacute;n SQL \"UNION\"");
define("_MI_PROTECTOR_UNION_ACTIONDSC","Prevenci&oacute;n de inyecci&oacute;n de SQL:<br />Seleccione el tipo de soluci&oacute;n cuando se detecte una sintaxis UNION de SQL.<br />M&eacute;todo Sanear: se cambia UNION a uni-on.<br />* Recomendado: [Sanear]");

define("_MI_PROTECTOR_ID_INTVAL","Transformar valor de variable ID en n&uacute;mero entero");
define("_MI_PROTECTOR_ID_INTVALDSC","Cambia los valores num&eacute;ricos en variables de nombre terminado en \"id\" por n&uacute;meros enteros, osea, sin decimales ni sus comas o puntos. Eficaz especialmente para m&oacute;dulos de enlaces como mylinks. Protege de ataque cruzado (XSS) e inyecci&oacute;n de SQL. Sin embargo, puede ser incompatible con otros m&oacute;dulos que necesitan trabajar con esos decimales.");

define("_MI_PROTECTOR_FILE_DOTDOT","Protecci&oacute;n de saltos de Directorio");
define("_MI_PROTECTOR_FILE_DOTDOTDSC","Elimina \"..\" de todas las peticiones que parezca que solicitan un cambio de directorio. Puede llegar al root. Los usa un atacante para acceder ficheros que est&aacute;n situados en otro directorio y a los que no se puede acceder directamente escribiendo esa ruta.");

define("_MI_PROTECTOR_BF_COUNT","Anti Fuerza Bruta");
define("_MI_PROTECTOR_BF_COUNTDSC","N&uacute;mero de intentos de entrar/login un usuario an&oacute;nimo durante 10 minutos. Si no lo consigue en ese tiempo, su IP ser&aacute; bloqueada (baneada).");

define("_MI_PROTECTOR_DOS_SKIPMODS","Modules excluidos de prevenci&oacute;n de DoS y Robots indexadores malintencionados");
define("_MI_PROTECTOR_DOS_SKIPMODSDSC","Directorios de los m&oacute;dulos, separados con el car&aacute;cter | (teclado Alt Gr.+1). En esta opci&oacute;n es conveniente incluir los m&oacute;dulos de chat, etc.");

define("_MI_PROTECTOR_DOS_EXPIRE","Maximo tiempo de espera para actuar (en segundos)");
define("_MI_PROTECTOR_DOS_EXPIREDSC","Tiempo de espera para tomar medidas cuando se agoten los contadores de N&ordm; de recargas de F5 y de intentos de robots indexadores malintencionados (mas abajo).");

define("_MI_PROTECTOR_DOS_F5COUNT","N&ordm; de veces para ser considerado un ataque F5");
define("_MI_PROTECTOR_DOS_F5COUNTDSC","Defensa contra ataques de denegaci&oacute;n de servicio (DoS):<br />N&ordm; de intentos de recargar la p&aacute;gina (dejan pulsada la tecla F5) procedentes de la misma URL, para que sea considerado un ataque malintencionado, dentro del tiempo de espera arriba definido.");
define("_MI_PROTECTOR_DOS_F5ACTION","Medidas contra ataques F5");

define("_MI_PROTECTOR_DOS_CRCOUNT","N&ordm; de veces para ser considerado un robot indexador malintencionado");
define("_MI_PROTECTOR_DOS_CRCOUNTDSC","Prevenci&oacute;n de buscadores con robots indexadores malintencionados :<br />N&ordm; de intentos de b&uacute;squedas internas por parte del robot, dentro del tiempo de espera arriba definido.");
define("_MI_PROTECTOR_DOS_CRACTION","Medidas contra robots indexadores malintencionados");

define("_MI_PROTECTOR_DOS_CRSAFE","Buscadores permitidos");
define("_MI_PROTECTOR_DOS_CRSAFEDSC","Nombres de sitios con permiso para que sus robots buscadores indexen esta web.<br />Evita que buscadores malintencionados te agregen a su lista.<br />(Admite operadores Perl-Regex).<br />Ej.: /(Msnbot|Googlebot|Yahoo! Slurp|Teoma|Lycos_Spider|Inktomi Slurp)/i");
/*
// Lista completa http://www.pgts.com.au/pgtsj/pgtsj0208d.html
// Msn: msnbot
// Google: googlebot
// Yahoo: Slurp
// Asj Jeeves: Teoma
// Inktomi: Inktomi slurp
// Lycos: Lycos_Spider
// Altavista: Usa el de yahoo
// HotBot: Usa el de Inktomi
*/

define("_MI_PROTECTOR_OPT_NONE","Nada");
define("_MI_PROTECTOR_OPT_SAN","Sanear");
define("_MI_PROTECTOR_OPT_EXIT","Cierre forzado de sesi&oacute;n");
define("_MI_PROTECTOR_OPT_BIP","Bloqueo (baneamiento) de IP");

define("_MI_PROTECTOR_DOSOPT_NONE","Nada");
define("_MI_PROTECTOR_DOSOPT_SLEEP","Esperar");
define("_MI_PROTECTOR_DOSOPT_EXIT","Salir y pantalla en blanco");
define("_MI_PROTECTOR_DOSOPT_BIP","Bloquear (banear) esa IP");
define("_MI_PROTECTOR_DOSOPT_HTA","Registro DENY a trav&eacute;s de .htaccess (experimental)");

define("_MI_PROTECTOR_BIP_EXCEPT","Grupos excluidos de bloqueo (baneamiento) de IP");
define("_MI_PROTECTOR_BIP_EXCEPTDSC","Aunque haya condiciones que permitan activar el bloqueo (baneamiento) de una IP, los pertenecientes a estos grupos no ser&aacute;n agregados. Para que tenga efecto, han de entrar (login) en xoops como tales.<br />* Recomendado: [Administradores]");
define("_MI_PROTECTOR_DISABLES","Parches contra vulnerabilidades de XOOPS &#8804; 2.0.9.2");
define("_MI_PROTECTOR_PASSWD_BIP","<a name='clave'></a>Contrase&ntilde;a de restauraci&oacute;n de IP bloqueda");
define("_MI_PROTECTOR_PASSWD_BIPDSC","Utilice &iexcl;ya! esta opci&oacute;n, antes de que ocurran errores y se le agregue a usted a las IPs bloqueadas (baneadas) de su propio sitio.<br />Si ha sucedido, acceda a XOOPS_URL/modules/protector/admin/rescue.php, y escriba esta contrase&ntilde;a.<br />Si no la define, esta opci&oacute;n de restauraci&oacute;n no podr&aacute; realizarse.<br />&iexcl;Tenga cuidado! donde guarda una copia de esta contrase&ntilde;a, para que no sea accesible a otros. Tampoco repita contrase&ntilde;as de otros sitios importantes.");
?>