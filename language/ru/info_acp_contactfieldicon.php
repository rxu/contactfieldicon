<?php
/**
 *
 * Adds an option of assigning FontAwesome icon to contact profile fields.
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, rxu, https://www.phpbbguru.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [

	'CONTACT_FIELD_ICON'			=> 'Значок поля контакта',
	'CONTACT_FIELD_ICON_EXPLAIN'	=> 'Введите название символа FontAwesome (версии 4 или 5) для использования в качестве значка контакта при отображении в минипрофилях сообщений. Оставьте пустым для использования значка phpBB по умолчанию.<br>Также можно выбрать цвет значка с помощью палитры или напрямую с использованием шестнадцатиричного представления (например: ffff80). Оставьте пустым для использования цвета по умолчанию.',

	'CONTACT_FIELD_ICON_COLOR'		=> 'Цвет',
	'CONTACT_FIELD_ICON_NAME'		=> 'Значок',
]);
