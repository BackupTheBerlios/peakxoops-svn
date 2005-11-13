<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

//Russian translation and russian encoding adaptation by Vladislav "FractalizeR" Rastrusny. http://www.vrsi.ru

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format

// Appended by Xoops Language Checker -GIJOE- in 2005-08-09 17:42:00
define('_MI_HEADLINES_BDESC','Shows headline news via RSS/ATOM in separate cells');
define('_MI_HEADLINES_BDESC_MIXED','Shows headline news via RSS/ATOM in an aggregated view');

define("_MI_DEFAULT_DTFMT_SHORT","d-m-Y H:i");

// The name of this module
define("_MI_HEADLINES_NAME","Новостные заголовки");

// A brief description of this module
define("_MI_HEADLINES_DESC","Отображает новостные заголовки RSS/XML с других сайтов");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Новостные заголовки");
define("_MI_HEADLINES_BNAME_MIXED","Заголовки последних новостей");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Список новостных заголовков");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Блоки/Группы");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Вид по умолчанию");
define("_MI_HEADLINES_INDEX_VIEWMODED","Выберите тип отображения на верху модуля");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Смешанные и новые первыми");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Стандартный");
define("_MI_HEADLINES_MIXED_MAXITEM","Максимум элементов");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Задайте максимум элементов RSS/ATOMs для отображения");
define("_MI_HEADLINES_MIXED_MAXLEN","Максимальная длина");
define("_MI_HEADLINES_MIXED_MAXLEND", "Задайте максимальную длину наименования в символах");
define("_MI_HEADLINES_PROXY_HOST","Хост прокси");
define("_MI_HEADLINES_PROXY_HOSTD","Если вы получаете новостные заголовки RSS/ATOM через прокси-сервер, задайте здесь имя хоста или IP адрес<br />В противном случае, оставьте поле пустым.");
define("_MI_HEADLINES_PROXY_PORT","Порт прокси");
define("_MI_HEADLINES_PROXY_PORTD","Если вы получаете новостные заголовки RSS/ATOM через прокси-сервер, установите здесь номер порта.<br />В противном случае, оставьте поле пустым.") ;
define("_MI_HEADLINES_PROXY_USER","Логин прокси");
define("_MI_HEADLINES_PROXY_USERD","Если ваш прокси требует аутентификации, укажите здесь логин.<br />В противном случае, оставьте поле пустым.") ;
define("_MI_HEADLINES_PROXY_PASS","Пароль прокси");
define("_MI_HEADLINES_PROXY_PASSD","Если ваш прокси требует аутентификации, укажите здесь пароль.<br />В противном случае, оставьте поле пустым.") ;
define("_MI_HEADLINES_SHORTDTFMT","Краткий формат даты и времени");
define("_MI_HEADLINES_SHORTDTFMTD","Это первый параметр, передаваемые функции PHP().<br /><a href='http://ru.php.net/date'>Справка по синтаксису</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Не отмечать элемент как недавний, если он в нем больше заданного максимального количества элементов");
define("_MI_HEADLINES_MIXPICKUPD","Если вы установите эту настройку в Нет, установки 'Максимального количества' будут проигнорированы.");

}

?>