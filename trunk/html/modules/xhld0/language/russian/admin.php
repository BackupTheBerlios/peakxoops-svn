<?php
// $Id: admin.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
//%%%%%%        Admin Module Name  Headlines         %%%%%

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_AM_DBUPDATED' ) ) {


//Russian translation and russian encoding adaptation by Vladislav "FractalizeR" Rastrusny. http://www.vrsi.ru

// list of encodings allowed   (name):(title)|(name):(title)|...

// Appended by Xoops Language Checker -GIJOE- in 2005-02-21 06:07:13
define('_AM_TITLEEXCLUDE','Exclude with title string<br /><span style="font-weight:normal;">(perl regex) Normally left blank</span>');
define('_AM_LINKEXCLUDE','Exclude with link string<br /><span style="font-weight:normal;">(perl regex) Normally left blank</span>');

define('_AM_ENCODINGS','utf-8:UTF-8|iso-8859-1:ISO-8859-1|us-ascii:US-ASCII|WINDOWS-1251:Windows-1251|KOI8-R:KOI8-R|KOI8-U:KOI8-U|KOI8-RU:KOI8-RU') ;
define('_AM_ENCODING_AUTO','Авто-определение') ;

define('_AM_DBUPDATED','База данных успешно обновлена!');
define('_AM_HEADLINES','Конфигурация заголовков новостей (№%s)');
define('_AM_HLMAIN','Главная');
define('_AM_SITENAME','Название сайта');
define('_AM_URL','URL');
define('_AM_TITLEPATTERN','Извлекать вместе со строкой названия <br /><span style="font-weight:normal;">укажите здесь обычное регулярное выражение perl. Например: /doller/<br />Обычно, оставляют пустой</span>');
define('_AM_LINKPATTERN','Извлекать вместе со строкой ссылки <br /><span style="font-weight:normal;">укажите здесь обычное регулярное выражение perl. Например: /business/<br />Обычно, оставляют пустой</span>');
define('_AM_ORDER', 'Порядок вывода');
define('_AM_ENCODING', 'Кодировка');
define('_AM_CACHETIME', 'Время кэша');
define('_AM_TIMEOUT', 'Время ожидания ответа сервера');
define('_AM_ALLOWHTML', 'Разрешить отображать HTML внутри XML<br /><span style="font-weight:normal;">Вы не должны включать эту опцию для RSS/ATOM заголовков, генерируемых из постов ваших посетителей из соображений безопасности.</span>');
define('_AM_MAINSETT', 'Настройки главной страницы');
define('_AM_BLOCKSETT', 'Настройки блока');
define('_AM_DISPIMG', 'Отображать картинку');
define('_AM_DISPFULL', 'Так же отображать описания и даты публикаций');
define('_AM_DISPMAX', 'Макс. количество элементов для отображения');
define('_AM_DISPLAY', 'Отображать на главной странице');
define('_AM_ASBLOCK', 'Отображать в блоке');
define('_AM_ADDHEADL','Добавить заголовок');
define('_AM_URLEDFXML','URI RSS или ATOM');
define('_AM_SYNDICATIONTYPE','Тип выборки');
define('_AM_SYNDICATIONTYPE_AUTO','Авто');
define('_AM_SAVEAS','Сохранить как');
define('_AM_UPDATE','Обновить');
define('_AM_EDITHEADL','Редактировать заголовок');
define('_AM_WANTDEL','Вы уверены, что хотите удалить заголовок для %s?');
define('_AM_INVALIDID', 'Неверный ID');
define('_AM_OBJECTNG', 'Объект не существует!');
define('_AM_FAILUPDATE', 'Невозможно сохранить данные в базу для заголовка %s');
define('_AM_FAILDELETE', 'Невозможно удалить данные из базы для заголовка %s');

}

?>
