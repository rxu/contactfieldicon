<?php
/**
 *
 * Adds an option of assigning FontAwesome icon to contact profile fields. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, rxu, https://ww.phpbbguru.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace rxu\contactfieldicon\tests\functional;

/**
 * @group functional
 */
class controller_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('rxu/contactfieldicon');
	}

	public function test_acp()
	{
		$this->login();
		$this->admin_login();

		$this->add_lang(['acp/profile']);
		$this->add_lang_ext('rxu/contactfieldicon', ['info_acp_contactfieldicon']);

		$crawler = self::request('GET', "adm/index.php?sid={$this->sid}&i=acp_profile&mode=profile&action=edit&field_id=11");

		$this->assertContainsLang('CONTACT_FIELD_ICON', $crawler->filter('label[for="contact_field_icon"]')->text(), '1');
		$this->assertContainsLang('CONTACT_FIELD_ICON_NAME', $crawler->filter('input[name="contact_field_icon"]')->attr('placeholder'), '2');
		$this->assertContains('icon fa-fw', $crawler->filter('i[name="contact_field_icon_demo"]')->attr('class'), '3');
		$this->assertContainsLang('CONTACT_FIELD_ICON_COLOR', $crawler->filter('input[name="contact_field_icon_bgcolor"]')->attr('placeholder'), '4');

		$form = $crawler->selectButton('Save')->form();
		$values = $form->getValues();

		// Set FontAwesome icon and its color
		$values['contact_field_icon'] = 'youtube';
		$values['contact_field_icon_bgcolor'] = 'f10313';

		$form->setValues($values);
		$crawler = self::submit($form);
		$this->assertContainsLang('CHANGED_PROFILE_FIELD', $crawler->filter('.successbox')->text());

		$crawler = self::request('GET', "adm/index.php?sid={$this->sid}&i=acp_profile&mode=profile&action=edit&field_id=11");
		$this->assertContains('youtube', $crawler->filter('input[name="contact_field_icon"]')->attr('value'));
		$this->assertContains('icon fa-fw fa-youtube', $crawler->filter('i[name="contact_field_icon_demo"]')->attr('class'));
		$this->assertContains('color: #f10313', $crawler->filter('i[name="contact_field_icon_demo"]')->attr('style'));
		$this->assertContains('f10313', $crawler->filter('input[name="contact_field_icon_bgcolor"]')->attr('value'));
	}
}
