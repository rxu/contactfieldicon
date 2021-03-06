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

	'CONTACT_FIELD_ICON'			=> 'Contact field icon',
	'CONTACT_FIELD_ICON_EXPLAIN'	=> 'Enter the name of a FontAwesome (versions 4 or 5) icon to use with the contact field while displaying in the mini-profile on the topic screen. Leave this field blank to use phpBB default contact image icon.<br>You can also choose the icon color from color picker or set it directly using a hex code (e.g: ffff80). Leave this field blank to use the default color.',

	'CONTACT_FIELD_ICON_COLOR'		=> 'Icon color',
	'CONTACT_FIELD_ICON_NAME'		=> 'Icon name',
]);
