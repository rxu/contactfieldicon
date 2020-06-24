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

namespace rxu\contactfieldicon;

/**
 * Adds an option of assigning FontAwesome icon to contact profile fields Extension base
 *
 * It is recommended to remove this file from
 * an extension if it is not going to be used.
 */
class ext extends \phpbb\extension\base
{
	/**
	* Check whether or not the extension can be enabled.
	* The current phpBB version should meet or exceed
	* the minimum version required by this extension:
	*
	* Requires phpBB 3.2.10 or 3.3.1 due to new template events
	* required in the acp_profile.html and viewtopic_body.html.
	*
	* @return bool
	* @access public
	*/
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.2.10-RC1', '>=') &&
			phpbb_version_compare(PHPBB_VERSION, '4.0.0-dev', '<');
	}
}
