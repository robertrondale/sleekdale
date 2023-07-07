<?php
# Description: Add site contact information

namespace Sleek\Modules;

class SiteContacts extends Module
{
	public function fields()
	{
		return [
			[
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'text'
			],			
			[
				'key' => 'site_contacts_message',
				'label' => '',
				'type' => 'message',
				'message' => '<em>This module will display the site contact information added <a href="' . get_admin_url(null, 'admin.php?page=global_settings') . '">here</a> (see General).</em>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			],		
		];
	}

	public function data()
	{
		$contacts = $this->getContacts();

		return [
			'has_content' => !empty($this->get_field('title')) || !empty($contacts),
			'contacts' => $contacts,
			'link' => get_field('footer_bottom_cta', 'site_settings')
		];
	}

	public function getContacts()
	{
		if (empty($tempContacts = get_field('general_info_contacts', 'global_settings'))) {
			return [];
		}

		$contacts = [];

		foreach ($tempContacts as $contact) {
			$type = $contact['type'];
			$value = $contact[$type];
			$link = '';

			switch ($type) {
				case 'phone':
					$link = "tel:$value";
					break;

				case 'email':
					$link = "mailto:$value";
					break;
			}

			$contacts[] = [
				'text' => $value,
				'link' => $link,
				'type' => $type
			];
		}

		return $contacts;
	}
}
