<?php /* Spanish Translation by Marcelo Yuji Himoro <www.yuji.eu.org> */

// index.php
define("_AM_TH_DATETIME","Data");
define("_AM_TH_USER","Usu�rio");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","AGENT");
define("_AM_TH_TYPE","Tipo");
define("_AM_TH_DESCRIPTION","Descripci�n");

define( "_AM_TH_BADIPS","Lista de IPs baneados");
define( "_AM_TH_ENABLEIPBANS","Activar baneamiento por IP?");

define("_AM_LABEL_REMOVE","");
define("_AM_BUTTON_REMOVE","Borrar");
define("_AM_JS_REMOVECONFIRM","�Est� seguro de qu� desea borrar los �tenes seleccionados?");
define( "_AM_MSG_PRUPDATED","Las configuraciones se han actualizado correctamente.");
define("_AM_MSG_REMOVED","Los �tenes seleccionados se han borrado correctamente.");


// prefix_manager.php
define("_AM_H3_PREFIXMAN","Gerenciador de PREFIX");
define("_AM_MSG_DBUPDATED","La base de dados se ha actualizado correctamente.");
define("_AM_CONFIRM_DELETE","�Est� seguro de qu� desea borrar todas las tablas?");
define("_AM_TXT_HOWTOCHANGEDB","Cuando ud. cambie el prefix, modifica el contenido abajo en tu %s/mainfile.php.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');");


// advisory.php
define("_AM_ADV_NOTSECURE","INSEGURO");

define("_AM_ADV_REGISTERGLOBALS","Esta configuraci�n permite una variedad de ataques por injecci�n.<br />Si su servidor soporta .htaccess, crea o modifica el .htaccess en la carpeta en donde se encuentra instalado el XOOPS.");
define("_AM_ADV_ALLOWURLFOPEN","Esta configuraci�n permite que atacantes ejecuten scripts remotamente a ganas.<br />Para modificar esta opci�n, ud. debe tener permiso de administrador del servidor.<br /> Si ud. es un administrador del servidor, modifica el php.ini o httpd.conf.<br /><b>Ejemplo de httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Si no, contacta el soporte de tu host.");
define("_AM_ADV_DBPREFIX","El prefix de tu base de datos es \"xoops\", lo que la hace vulnerable a SQL injection.<br />No se olvide de activar \"Sanitizaci�n forzada en caso de detecci�n de comentario asolado\" y las protecciones contra SQL injection en las preferencias de este m�dulo.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Ir al Gerenciador de PREFIX");
define("_AM_ADV_MAINUNPATCHED","Cuando llamado desde mainfile.php, la protecci�n proporcionada por Xoops Protector es intensificada.<br />Lee el README y edita tu mainfile.php tal como indicado.");
define("_AM_ADV_RESCUEPASSWORD","Contrase�a de reparo");
define("_AM_ADV_RESCUEPASSWORDUNSET","Indefinida.");
define("_AM_ADV_RESCUEPASSWORDSHORT","Utilice contrase�as mayores o iguales que 6 caracteres.");

define("_AM_ADV_SUBTITLECHECK","Chequeo de las acciones de Protector");
define("_AM_ADV_AT1STSETPASSWORD","Por haber la posibilidade de que se le banee la IP, ud. debe definir primeramente una constrase�a de reparo.");
define("_AM_ADV_CHECKCONTAMI","Ataques por contaminaci�n");
define("_AM_ADV_CHECKISOCOM","Comentarios isolados");
?>