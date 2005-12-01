<?php
// Module Info

// The name of this module
define("_MI_PROTECTOR_NAME","Сторож XOOPS");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Этот модуль защищает ваш сайт на базе XOOPS от различного вида атак, таких как: DoS, SQL Injection и порчи переменных.");

// Names of blocks for this module (Not all module has blocks)
//define("_MI_PROTECTOR_BNAME1","Protector");
//define("_MI_PROTECTOR_BDESC1","This block should be put in top of left blocks and should be displayed against 'all pages'.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Главная");
define("_MI_PROTECTOR_ADVISORY","Подсказки");
define("_MI_PROTECTOR_PREFIXMANAGER","Управление префиксом БД");

// Configs
define('_MI_PROTECTOR_GLOBAL_DISBL','Временно выключен');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Все системы защиты временно отключены.<br />Не забудьте включить их после разрешения ваших проблем с безопасностью.');
define('_MI_PROTECTOR_RELIABLE_IPS','Доверенные адреса');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','Установите адрса при заходе для которых проверки безопасности не проводятся. Разделяйте каждый адрес знаком "|". "^" соответствует началу строки, "$" соответствует концу строки.');
define('_MI_PROTECTOR_LOG_LEVEL','Журнал событий');
define('_MI_PROTECTOR_LOG_LEVELDSC','');

define('_MI_PROTECTOR_LOGLEVEL0','Журнал отключен');
define('_MI_PROTECTOR_LOGLEVEL15','Минимум событий');
define('_MI_PROTECTOR_LOGLEVEL63','Минимум событий');
define('_MI_PROTECTOR_LOGLEVEL255','Все события');

define('_MI_PROTECTOR_HIJACK_TOPBIT','Protected IP bits for the session');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Session Hi-Jacking:<br />Default 32(bit). (All bits are protected)<br />When your IP is not stable, set the IP range by number of the bits.<br />(eg) If your IP can move in the range of 192.168.0.0-192.168.0.255, set 24(bit) here');
define('_MI_PROTECTOR_HIJACK_DENYGP','Группы для которых изменение адреса в рамках одной сессии запрещено');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Борется с подстановкой сессий:<br />
	Выберите группы для которых адрес в пределах одной сессии постоянен.<br />
	(Рекомендуется всегда включать в список групп группу Администраторов сайта.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Вычищать символ с нулевым кодом');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','
	Заверщающий символ "\\0" часто используется в различных видах атак.<br />
	Этот символ будет заменен на пробел.<br />(рекомендуется всегда включать данную настройку)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Exit if null bytes are found');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','The terminating character "\\0" is often used in malicious attacks.<br />(highly recommended as On)');
define('_MI_PROTECTOR_DIE_BADEXT','Прервать выполнение при загрузке опасного файла');
define('_MI_PROTECTOR_DIE_BADEXTDSC','
	В случае когда кто-либо попытается загрузить на сайт файл имеющий опасное расширение (например .php) - загрузка страницы будет прервана. Если вам часто приходится загружать такие файлы (например для модулей B-Wiki или PukiWikiMod) - отключите данный параметр.');
define('_MI_PROTECTOR_CONTAMI_ACTION','Действие при обнаружении "грязных" переменных');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','
	Выберите действие выполняемое в случае когда кто-либо пытается передать вашему скрипту "грязные" системные переменные XOOPS. (Рекомендуется: пустой экран)');
define('_MI_PROTECTOR_ISOCOM_ACTION','Действие при обнаружении изолированного комментария.');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','
	Выберите действие выполняемое при обнаружении строки "/*" без экранировния.<br />"Очистка" подразумевает добавление экранирующих символов "*/".<br />(Рекомендуется: Очистить)');
define('_MI_PROTECTOR_UNION_ACTION','Действие при обнаружении ключевого слова UNION');
define('_MI_PROTECTOR_UNION_ACTIONDSC','
	Выберите действие выполняемое при обнаружении ключевого слова UNION. "Очистка" предполагает заменение всех вхождений данного слова "UNI-ON". (Рекомендуется: Очистить)');
define('_MI_PROTECTOR_ID_INTVAL','Принудительное преобразование целочисленых переменных (например id).');
define('_MI_PROTECTOR_ID_INTVALDSC','
	Все запросы вида: "*id" будут возвращены как целые числа.<br />Этот параметр защищает вас от некоторых видов XSS и SQL Injections атак.<br />
	Рекомендуется включить этот параметр и отключать только при возникновении проблем в использовании каких-либо модулей.');
define('_MI_PROTECTOR_FILE_DOTDOT','Защита от Directroy Traversals');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Удаляет все вхождения последовательности ".." из всех запросов выглядящих как Directory Traversals');

define('_MI_PROTECTOR_BF_COUNT','Защита от подбора пароля');
define('_MI_PROTECTOR_BF_COUNTDSC','Установите максимальное количество попыток входа пользователя за 10 минут. В случае если кто-либо попытается залогиниться большее чем указано количество раз - его адрес будет занесен в черный список.');

define('_MI_PROTECTOR_DOS_SKIPMODS','Modules out of DoS/Crawler checker');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','Введите имена каталогов разделенные символом "|" для модулей в которых можно отключить DoS/Crawler защиту. Этот параметр в частности широко применим в модулях чата и других модулях для которых частое обращение к стараницам модулей является нормой.');

define('_MI_PROTECTOR_DOS_EXPIRE','Время ожидания для определения высокой нагрузки (сек)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Данное значение указывает время ожидания до обнуления счетчика запросов страницы ("Атака F5" и Роботы перегружающие сервер)');

define('_MI_PROTECTOR_DOS_F5COUNT','Счетчик для "Атаки F5"');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Защищает от DoS атак.<br />
	Это значение указывает количество запросов страницы превышение которого за установленое ранее время ожидания распознается как преднамеренная атака.');
define('_MI_PROTECTOR_DOS_F5ACTION','Действие при обнаружении попытки перегрузки сервера');

define('_MI_PROTECTOR_DOS_CRCOUNT','Счетчик для Роботов');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Предупреждает высокую загрузку сервера роботами поисковых систем. Указаное значение задает количество запросов превышение которого за установленое ранее время ожидания распознается как посещение "Неправильным" Роботом');
define('_MI_PROTECTOR_DOS_CRACTION','Действие при обнаружении "Плохих" Роботов.');

define('_MI_PROTECTOR_DOS_CRSAFE','Агенты пользователя (User-Agent) не опознаваемые как "Плохие"');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Регулярное выражение perl для поля Агента Пользователя (User-Agent).<br />В случае совпадения агента посетителя с указаным выражением - Робот никогда не распознается как "Плохой".<br />Пример: /(msnbot|Googlebot|Yandex|Yahoo! Slurp|StackRambler)/i');

define('_MI_PROTECTOR_OPT_NONE','Ничего (только запись в журнале)');
define('_MI_PROTECTOR_OPT_SAN','Очистка');
define('_MI_PROTECTOR_OPT_EXIT','Пустой экран');
define('_MI_PROTECTOR_OPT_BIP','Добавить адрес в черный список');

define('_MI_PROTECTOR_DOSOPT_NONE','Ничего (только запись в журнале)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Заснуть');
define('_MI_PROTECTOR_DOSOPT_EXIT','Пустой экран');
define('_MI_PROTECTOR_DOSOPT_BIP','Добавить адрес в черный список');
define('_MI_PROTECTOR_DOSOPT_HTA','Запретить доступ используя .htaccess (экспериментально)');

define('_MI_PROTECTOR_BIP_EXCEPT','Групы пользователей никогда не попадающие в черный список.');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Рекомендуется всегда добавлять в этот список группу администраторов сайта.');
define('_MI_PROTECTOR_DISABLES','Дективировать потенциально опасные функции XOOPS');
define('_MI_PROTECTOR_PASSWD_BIP','Запасной пароль для удаления вашего адреса из черного списка');
define('_MI_PROTECTOR_PATCH2092', "Исправить ошибки XOOPS 2.0.9.2");
define('_MI_PROTECTOR_PASSWD_BIPDSC','
	В случае если ваш адрес будет добавлен в черный список - зайдите на страницу XOOPS_URL/modules/protector/admin/rescue.php и введите указаный здесь пароль.<br />Не забудьте установить пароль до того как будете забанены из-за какой-нибудь ошибки. :-).<br />Если пароль не установлен - черный список будет отключен.');

?>