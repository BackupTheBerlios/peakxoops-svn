<?php /* Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> */

// index.php
define("_AM_TH_DATETIME","Fecha");
define("_AM_TH_USER","Usuario");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Tipo");
define("_AM_TH_DESCRIPTION","Detalles");

define("_AM_TH_BADIPS","Lista de IPs baneados");
define("_AM_TH_ENABLEIPBANS","Activar baneamiento por IP?");

define("_AM_LABEL_REMOVE","");
define("_AM_BUTTON_REMOVE","Borrar");
define("_AM_JS_REMOVECONFIRM","Ž¿Está seguro de que desea borrar los itenes seleccionados?");
define("_AM_MSG_PRUPDATED","Las configuraciones se han actualizado correctamente.");
define("_AM_MSG_REMOVED","Los itenes seleccionados se han borrado correctamente.");


// prefix_manager.php
define("_AM_H3_PREFIXMAN","Gestor de prefijos");
define("_AM_MSG_DBUPDATED","La base de dados se ha actualizado correctamente.");
define("_AM_CONFIRM_DELETE","Ž¿Está seguro de que desea borrar todas las tablas?");
define("_AM_TXT_HOWTOCHANGEDB","Al cambiar el prefijo, usted debe modificar el contenido abajo indicado en %s/mainfile.php.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');");


// advisory.php
define("_AM_ADV_NOTSECURE","INSEGURO");

define("_AM_ADV_REGISTERGLOBALS","Esta configuraci…Ï permite una gama de ataques por inyecci…Ï.<br />Si su servidor soporta .htaccess, cree o modifùÒuelo en la carpeta en donde se encuentra instalado el XOOPS.");
define("_AM_ADV_ALLOWURLFOPEN","Esta configuraci…Ï permite que atacantes ejecuten scripts remotos libremente.<br />Para modificar esta opci…Ï, usted debe tener el permiso de administrador del servidor.<br />Si usted lo posee, modifique el php.ini o httpd.conf.<br /><b>Ejemplo de httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Si no, contacte el soporte de tu alojamiento web.");
define("_AM_ADV_USETRANSSID","Sus configuraciones estáÏ definidas para mostrar la ID de sesi…Ï en los enlaces.<br />Para protegerse contra robo de sesi…Ï (session hijack), cree o modifùÒue un .htaccess en la carpeta en donde se encuentra instalado el XOOPS.<br /><b>php_flag session.use_trans_sid off</b>");
define("_AM_ADV_DBPREFIX","El prefijo de tu base de datos es el defecto (\"xoops\"), lo que la hace vulnerable a inyecci…Ï de SQL.<br />No se olvide de activar \"Limpieza en caso de detecci…Ï de comentarios asolados\" y las protecciones a inyecci…Ï de SQL.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Ir al Gestor de prefijos");
define("_AM_ADV_MAINUNPATCHED","Edite su mainfile.php tal como indicado en el LEEME.");
define("_AM_ADV_RESCUEPASSWORD","ContraseÂ de restauraci…Ï");
define("_AM_ADV_RESCUEPASSWORDUNSET","INDEFINIDA");
define("_AM_ADV_RESCUEPASSWORDSHORT","Utilice contraseÂs iguales o superiores a 6 caracteres.");

define("_AM_ADV_SUBTITLECHECK","Verificaci…Ï de funcionamiento de Protector");
define("_AM_ADV_AT1STSETPASSWORD","Por haber la posibilidad de que se le agregue a la lista de IPs baneados, usted debe definir primeramente una contraseÂ de reparo.");
define("_AM_ADV_CHECKCONTAMI","Contaminaciones por variable");
define("_AM_ADV_CHECKISOCOM","Comentarios asolados");
?>