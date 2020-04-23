<?php
/**
 *
 * Adds an option of assigning FontAwesome icon to contact profile fields. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, rxu, https://ww.phpbbguru.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace rxu\contactfieldicon\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Adds an option of assigning FontAwesome icon to contact profile fields Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return array(
			'core.acp_profile_create_edit_init'					=> 'add_icon_data_to_acp',
			'core.acp_profile_create_edit_after'				=> 'add_icon_data_to_acp',
			'core.acp_profile_create_edit_save_before'			=> 'add_icon_data_to_acp',
			'core.generate_profile_fields_template_headlines'	=> 'add_icon_data_to_profilefields_manager',
			'core.generate_profile_fields_template_data'		=> 'add_icon_data_to_profilefields_manager',
			'core.viewtopic_post_row_after'						=> 'add_icon_data_to_viewtopic_profilefields',
		);
	}

	/** @var \phpbb\request\request_interface */
	protected $request;

	/* @var \phpbb\profilefields\manager */
	protected $cp;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\profilefields\manager	$cp			Profilefields manager object
	 * @param \phpbb\template\template		$template	Template object
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\profilefields\manager $cp, \phpbb\template\template $template)
	{
		$this->request = $request;
		$this->cp = $cp;
		$this->template = $template;
	}

	/**
	 * Adds contact field icon data to the various places in acp profile manager
	 *
	 * @param \phpbb\event\data	$event		Event object
	 * @param string			$eventname	Name of the event
	 */
	public function add_icon_data_to_acp($event, $eventname)
	{
		switch ($eventname)
		{
			case 'core.acp_profile_create_edit_init':
				$action = $event['action'];
				$field_row = $event['field_row'];
				$exclude = $event['exclude'];

				if ($action == 'create')
				{
					$field_row['contact_field_icon'] = json_encode(['name' => '', 'color' => '']);
				}

				$exclude[1][] = 'contact_field_icon';
				$icon = json_decode($field_row['contact_field_icon'], true);
				$icon_data = [
					'name' => $this->request->variable('contact_field_icon', $icon['name'] ?: ''),
					'color' => $this->request->variable('contact_field_icon_bgcolor', $icon['color'] ?: ''),
				];
				$this->cp->vars['contact_field_icon'] = json_encode($icon_data);
				$event['field_row'] = $field_row;
				$event['exclude'] = $exclude;
			break;

			case 'core.acp_profile_create_edit_after':
				if ($event['step'] == 1)
				{
					$icon_data = json_decode($this->cp->vars['contact_field_icon'], true);
					$this->template->assign_vars([
						'CONTACT_FIELD_ICON' 		=> $icon_data['name'],
						'CONTACT_FIELD_ICON_BGCOLOR'=> $icon_data['color'],
						'S_IN_ACP_CONTACTFIELDICON' => true,
					]);
				}
			break;

			case 'core.acp_profile_create_edit_save_before':
				$profile_fields = $event['profile_fields'];
				$profile_fields['contact_field_icon'] = $this->cp->vars['contact_field_icon'];
				$event['profile_fields'] = $profile_fields;
			break;
		}
	}

	/**
	 * Adds contact field icon data to the profilefields manager
	 *
	 * @param \phpbb\event\data	$event		Event object
	 * @param string			$eventname	Name of the event
	 */
	public function add_icon_data_to_profilefields_manager($event, $eventname)
	{
		switch ($eventname)
		{
			case 'core.generate_profile_fields_template_headlines':
				$tpl_fields = $event['tpl_fields'];
				$profile_cache = $event['profile_cache'];

				foreach ($tpl_fields as $i => $field_data)
				{
					$ident = $tpl_fields[$i]['PROFILE_FIELD_IDENT'];
					$tpl_fields[$i]['PROFILE_CONTACT_FIELD_ICON'] = $profile_cache[$ident]['contact_field_icon'];
				}
				$event['tpl_fields'] = $tpl_fields;
			break;

			case 'core.generate_profile_fields_template_data':
				$profile_row = $event['profile_row'];
				$tpl_fields = $event['tpl_fields'];

				foreach ($tpl_fields['blockrow'] as $i => $field_data)
				{
					$ident = $tpl_fields['blockrow'][$i]['PROFILE_FIELD_IDENT'];
					$tpl_fields['blockrow'][$i]['PROFILE_CONTACT_FIELD_ICON'] = $profile_row[$ident]['data']['contact_field_icon'];
					$tpl_fields['row']['PROFILE_' . strtoupper($ident) . '_ICON'] = $profile_row[$ident]['data']['contact_field_icon'];
				}
				$event['tpl_fields'] = $tpl_fields;
			break;
		}
	}

	/**
	 * Adds contact field icon data to the profilefields in viewtopic miniprofiles
	 *
	 * @param \phpbb\event\data	$event		Event object
	 */
	public function add_icon_data_to_viewtopic_profilefields($event)
	{
		$cp_row = $event['cp_row'];

		if (!empty($cp_row['blockrow']))
		{
			foreach ($cp_row['blockrow'] as $field_data)
			{
				if ($field_data['S_PROFILE_CONTACT'])
				{
					$icon_data = json_decode($field_data['PROFILE_CONTACT_FIELD_ICON'], true);
					$this->template->alter_block_array(
						'postrow.contact',
						[
							'ICON'			=> $icon_data['name'],
							'ICON_COLOR'	=> $icon_data['color'],
						],
						['ID'			=> $field_data['PROFILE_FIELD_IDENT']],
						'change'
					);
				}
			}
		}
	}
}
