<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws>  and Mel Bezos <http://www.bezoops.net>*/

// index.php
define("_AM_TH_DATETIME","<a name='logprot'></a>Fecha del ataque");
define("_AM_TH_USER","Usuario");
define("_AM_TH_IP","Direcci&oacute;n IP");
define("_AM_TH_AGENT","Emisor del ataque (User Agent)");
define("_AM_TH_TYPE","Tipo");
define("_AM_TH_DESCRIPTION","Detalles");

define("_AM_TH_BADIPS","Lista de IPs bloqueadas (baneadas)");
define("_AM_TH_ENABLEIPBANS","Activar bloqueo (baneamiento) de IPs?");

define("_AM_LABEL_REMOVE","Elementos marcados:&nbsp;&nbsp;");
define("_AM_BUTTON_REMOVE","&nbsp;Borrarlos&nbsp;&raquo;&raquo;&nbsp;");
define("_AM_JS_REMOVECONFIRM","&iquest;Est&aacute; seguro de que desea BORRAR los elementos seleccionados?");
define("_AM_MSG_PRUPDATED","La configuraci&oacute;n se han actualizado correctamente.");
define("_AM_MSG_REMOVED","Los elementos seleccionados se han borrado correctamente.");


// prefix_manager.php
define("_AM_H3_PREFIXMAN","Gestor de prefijos tablas de la Base de datos");
define("_AM_MSG_DBUPDATED","La base de dados se ha actualizado Correctamente.");
define("_AM_CONFIRM_DELETE","&iquest;Est&aacute; seguro de que desea borrar todas las tablas?");
define("_AM_TXT_HOWTOCHANGEDB","Si se ha cambiado el prefijo, es NECESARIO modificar el contenido abajo indicado en su %s/mainfile.php.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');");

// advisory.php
define("_AM_ADV_NOTSECURE","INSEGURO");

define("_AM_ADV_REGISTERGLOBALS","Esta configuraci&oacute;n permite ataques de inyecci&oacute;n<br />Si su servidor lo soporta, agrege o edite un fichero .htaccess o php.ini en el directorio raiz de su Xoops, incluyendo esta l&iacute;nea:");

define("_AM_ADV_ALLOWURLFOPEN","Esta configuraci&oacute;n permite que ejecuten scripts (peque&ntilde;os programas) ajenos en su servidor de alojamiento, sin su conocimiemto.<br />Si tiene acceso (solo administradores del alojamiento), modifique el httpd.conf. O si su servidor lo soporta, agrege o edite un fichero .htaccess o php.ini en el directorio raiz de su Xoops:<br />&nbsp;&nbsp;* Ejemplo de httpd.conf, incluya esta l&iacute;nea:<br />&nbsp;&nbsp;&nbsp;&nbsp;<b>php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b>");

// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:38
define("_AM_ADV_USETRANSSID","Esta configuraci&oacute;n permite el Robo de sesi&oacute;n. Su ID de sesi&oacute;n es visible en etiquetas (tags) como &lt;a&gt;,&lt;form&gt;, etc.<br />Si su servidor lo soporta, agrege o edite un fichero .htaccess o php.ini en el directorio raiz de su Xoops, incluyendo esta l&iacute;nea<br />&nbsp; * Ejemplo de ".XOOPS_URL."/.htaccess:<br />&nbsp;&nbsp;&nbsp; <b>php_flag&nbsp; session.use_trans_sid&nbsp; off</b>");

define("_AM_ADV_DBPREFIX","El prefijo de las tablas de su base de datos es la usada por defecto, \"xoops\", y esto la hace vulnerable de ataques de inyecci&oacute;n de SQL, puesto que un atacante sabe que la tabla de usuarios, p. ej, se llama \"xoops_users\". Pero al cambiarle el prefijo, ya no sabe su nombre.<br />No se olvide de activar \"Sanear\" en los casos de [Detecci&oacute;n de comentario php solitario] y  de [Detecci&oacute;n de instrucci&oacute;n SQL \"UNION\"].");
define("_AM_ADV_LINK_TO_PREFIXMAN","Ir al Gestor de prefijos -&raquo;&raquo;");
define("_AM_ADV_MAINUNPATCHED","Edite su mainfile.php tal como se indica en el archivo <a href='../READMEes.html' target='_blank'>READMEes</a>");
define("_AM_ADV_RESCUEPASSWORD","Contrase&ntilde;a de Restauraci&oacute;n");
define("_AM_ADV_RESCUEPASSWORDUNSET","SIN DEFINIR");
define("_AM_ADV_RESCUEPASSWORDSHORT","Use contrase&ntilde;as con 6 o mas car&aacute;cteres.");

define("_AM_ADV_SUBTITLECHECK","Verificaci&oacute;n del funcionamiento de <b>Protector</b><span style='font-size:11px;'> - <a href='../READMEes.html' target='_blank'>(Leer archivo READMEes)</a><br />- En <a href='index.php#logprot'>[Bloqueo de Ataques]</a>, desactivar antes Bloqueo de IP. Despu&eacute;s Pulsar sobre los enlaces de aqu&iacute; abajo.<br />- Si Protector funciona, han de aparecer resultados en Registro log en listado inferior de [Bloqueo de Ataques]. Despu&eacute;s, volver a activar Bloqueo de IP.</span>");
define("_AM_ADV_AT1STSETPASSWORD","Existe la posibilidad de que a usted mismo se le agregue a la lista de IPs bloqueados (baneados). Es conveniente que defina una contrase&ntilde;a de restauraci&oacute;n antes de que eso ocurra.");
define("_AM_ADV_CHECKCONTAMI","Contaminaci&oacute;n de variables. (Intento de modificar una variable de Xoops desde direcci&oacute;n URL)");
define("_AM_ADV_CHECKISOCOM","Etiqueta comentario php /* solitaria (sin su pareja de cierre */)");
?>