<?php

// index.php
define("_AM_TH_DATETIME","Время");
define("_AM_TH_USER","Пользователь");
define("_AM_TH_IP","IP");
define("_AM_TH_AGENT","User-Agent");
define("_AM_TH_TYPE","Тип");
define("_AM_TH_DESCRIPTION","Описание");

define( "_AM_TH_BADIPS" , "Запрещенные IP" ) ;
define( "_AM_TH_ENABLEIPBANS" , "Включить механизм банов по IP?" ) ;

define( "_AM_LABEL_REMOVE" , "Удалить отмеченые записи:" ) ;
define( "_AM_BUTTON_REMOVE" , "Удалить" ) ;
define( "_AM_JS_REMOVECONFIRM" , "Удаляем?" ) ;
define( "_AM_MSG_PRUPDATED" , "Настройки успешно обновлены!" ) ;
define( "_AM_MSG_REMOVED" , "Записи удалены" ) ;


// prefix_manager.php
define( "_AM_H3_PREFIXMAN" , "Управление префиксом таблиц" ) ;
define( "_AM_MSG_DBUPDATED" , "База данных успешно обновлена!" ) ;
define( "_AM_CONFIRM_DELETE" , "Все данные будут уничтожены. Продолжать?" ) ;
define( "_AM_TXT_HOWTOCHANGEDB" , "Если вы хотите изменить префик таблиц, отредактируйте ваш конфигурационный файл %s/mainfile.php вручную внеся изменения в строку указаную ниже.<br /><br />define('XOOPS_DB_PREFIX', '<b>%s</b>');" ) ;


// advisory.php
define("_AM_ADV_NOTSECURE","Тест НЕ пройден");

define("_AM_ADV_REGISTERGLOBALS","Текущая конфигурация позволяет проводить целый спектр атак с замещением значений переменных.<br />Если вы имеете доступ к файлу .htaccess создайте его или отредактируйте этот файл добавив к нему строку указаную ниже.");
define("_AM_ADV_ALLOWURLFOPEN","Текущая конфигурация позволяет атакующим выполнять произвольные скрипты на удаленных машинах.<br />Только администратор сервера может изменить эту опцию.<br />Если вы являетесь администратором отредактируйте файл php.ini или httpd.conf.<br /><b>Пример для httpd.conf:<br /> &nbsp; php_admin_flag &nbsp; allow_url_fopen &nbsp; off</b><br />Или попросите об этом Вашего администратора.");
define("_AM_ADV_USETRANSSID","ID вашей сессии отображается в тегах ссылок и др.<br />
	Во избежание использования ID вашей сессии третьими лицами добавьте следующую строку в ваш файл .htaccess расположеный в каталоге: '".XOOPS_ROOT_PATH."'.<br /><b>php_flag session.use_trans_sid off</b>");
define("_AM_ADV_DBPREFIX","Текущее значение префикса таблиц БД позволяет проводить класс т.н. 'SQL Injecting' атак.<br />Не забудьте включить 'Принудительную очистку переменных *' в конфигурационном разделе этого модуля.");
define("_AM_ADV_LINK_TO_PREFIXMAN","Перейти к разделу управления префиксами БД.");
define("_AM_ADV_MAINUNPATCHED","Вы должны отредактировать Ваш файл mainfile.php так, как это описано в README.");
define("_AM_ADV_RESCUEPASSWORD","Пароль для снятия бана с вашего IP");
define("_AM_ADV_RESCUEPASSWORDUNSET","Не установлен");
define("_AM_ADV_RESCUEPASSWORDSHORT","Слишком короткий (минимальная длина 6 символов)");

define("_AM_ADV_SUBTITLECHECK","Проверка работоспособности");
define("_AM_ADV_AT1STSETPASSWORD","Установите ваш резервный пароль перед проверкой.");
define("_AM_ADV_CHECKCONTAMI","Порча переменных");
define("_AM_ADV_CHECKISOCOM","Изолированые комментарии");



?>