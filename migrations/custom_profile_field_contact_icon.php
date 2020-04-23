<?php
/**
 *
 * Adds an option of assigning FontAwesome icon to contact profile fields. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, rxu, https://www.phpbbguru.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace rxu\contactfieldicon\migrations;

class custom_profile_field_contact_icon extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'profile_fields', 'field_icon');
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330',];
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> [
				$this->table_prefix . 'profile_fields'	=> [
					'contact_field_icon'	=> array('VCHAR:255', json_encode(['name' => '', 'color' => ''])),
				],
			],
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'profile_fields'	=> array(
					'contact_field_icon',
				),
			),
		);
	}
}
