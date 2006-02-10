[xlang:es]
( Spanish Translation by Marcelo Yuji Himoro <http://yuji.ws> and Mel Bezos <http://www.bezoops.net> )

= RESUMEN =Xoops Protector es un m�dulo para defender XOOPS2 frente a diversos y malintencionados ataques.

Este m�dulo le protege de varios tipos de ataques, como son:

- DoS - Denegaci�n de Servicio [7]
- Bad Crawlers - Robots rastreadores que buscan en las p�ginas, eMails... [2]
- SQL Injection - Inyecci�n SQL [2,3,5,8]
- XSS - Ataque de sitio cruzado (Solo un poco...) [2,4,9]
- System globals pollution - Contaminaci�n de variables globales del sistema. [1,3,5,8]
- Session hi-jacking - Robo de sesi�n [2,4,5]
- Null-bytes - Bytes nulos. [1,8]
- Wrong file path specifications - Error en las especificaciones de ficheros. [1]
- Algunos tipos de CSRF (Falsificaci�n peticiones sitio cruzado) (fatal in XOOPS <= 2.0.9.2) [2,4,9]
- Brute Force - Fuerza Bruta. [5]

Entre corchetes, Peligros de ataque con �xito.
Aunque el alcance depende de la habilidad del atacante, las protecciones del Sitio y las de la Aplicaci�n:

[1] Obtenci�n de informaci�n para preparar ataque. Rutas, ingenier�a inversa,...
[2] Robo de informaci�n confidencial (usuarios, emails, tarjetas,...)
[3] Control sobre la Base de datos, incluido su borrado total (inhabilitaci�n del Sitio, hasta reponer con copia de seguridad)
[4] Robo de sesiones de otros usuarios para suplantaci�n.
[5] Obtenci�n de claves de entrada.
[6] Escalada de privilegios. Puede manipular el Sitio.
    Si existe programa de acceso a ficheros por administrador, borrado de todos los ficheros de la Aplicaci�n.
[7] Impide acceso de usuarios leg�timos. Bloqueo total de acceso al sitio.
[8] Control completo del Sitio, de las Aplicaciones y de las Bases de datos. Puede obtener lo que quiera o destruirlo.
[9] Introducci�n de troyanos u otros programas en ordenadores de otras personas que acceden al sitio.

Xoops Protector defiende su XOOPS de TODO este tipo de ataques y los graba en un Base de registros de eventos (log).

Por supuesto, no se pueden prevenir todas las vulnerabilidades.
No seas demasiado confiado...

Sin embargo, es altamente recomendable instalar este m�dulo en todos tus sitios con XOOPS, en cualquiera de sus versiones, 2,0.x � 2.2.x

= RELACION con to AntiDoS-P =

El antecesor de Xoops Protector era AntiDoS-P.
Dado que todas las funciones de AntiDoS-P se han implementado en Xoops Protector, mejor si desinstalas AntiDoS-P.

= USO =

Por favor, inst�lalo como haces usualmente con cualquier m�dulo.
Despu�s de que Xoops Protector est� instalado, edite su fichero mainfile.php de esta manera.

-[ ANTES ]-------------------------------------------------------------------

define('XOOPS_GROUP_ADMIN', '1');
define('XOOPS_GROUP_USERS', '2');
define('XOOPS_GROUP_ANONYMOUS', '3');

if (!isset($xoopsOption['nocommon'])) {
        include XOOPS_ROOT_PATH."/include/common.php";
}


----------\
-[ DESPU�S ]-----------------------------------------------------------------

define('XOOPS_GROUP_ADMIN', '1');
define('XOOPS_GROUP_USERS', '2');
define('XOOPS_GROUP_ANONYMOUS', '3');

include( XOOPS_ROOT_PATH . '/modules/protector/include/precheck.inc.php' );
if (!isset($xoopsOption['nocommon']) && XOOPS_ROOT_PATH != '' ) {
        include XOOPS_ROOT_PATH."/include/common.php";
}
include( XOOPS_ROOT_PATH . '/modules/protector/include/postcheck.inc.php' );

------------------------------------------------------------------------------


Si la parte de ANTES es diferente en su mainfile.php, no importa.
Son necesarios ambos pre-check y post-check.

Cuando todo est� instalado, debe comprobar si su direcci�n IP est� incluida en:
"Lista de IPs bloqueadas (baneadas)".

Si por desgracia, es Administrador y ha sido bloqueada su IP debido a inesperados errores, acceda ahora, sin salir de la sesi�n, a introducir la clave (password) en "Preferencias de XoopsProtector", en "Contrase�a de restauraci�n de IP bloqueda".

Despu�s, o cada vez que lo necesite, para desbloquear la IP, acceda directamente a la direcci�n Url:
http://(su xoops)/modules/protector/admin/rescue.php

Se ha agregado la opci�n "DENY by .htaccess" en la versi�n 2.34.
Si intenta instalar esta opci�n, establezca permiso de escritura al fichero "suXoops/.htaccess" si ya existe.
Antes de instalarlo, debe de compensar los riesgos de seguridad que conlleva que tenga permiso de escritura .htaccess.

= GRACIAS A =

- Kikuchi &nbsp;(Traditional Chinese language files)
- Marcelo Yuji Himoro (Brazilian Portuguese and Spanish language files)
- HMN (French language files)
- Defkon1 (Italian language files)
- Dirk Louwers (Dutch language files)
- Rene (German language files)
- kokko (Finnish language files)
- Tomasz (Polski language files)
- Sergey (Russian language files)

Moreover, I thank to JM2 and minahito -zx team- about having taught me kindly.
You are very great programmers!

p.s.

If you've created or modified language files for this module, contact to me.
I will register it in Protector archive.

[/xlang:es]