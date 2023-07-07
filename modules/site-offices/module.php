<?php
# Description: Add site offices information on the page

namespace Sleek\Modules;

class SiteOffices extends Module
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
				'key' => 'site_offices_message',
				'label' => '',
				'type' => 'message',
				'message' => '<em>This module will display the offices information added <a href="' . get_admin_url(null, 'admin.php?page=global_settings') . '">here</a> (see General).</em>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			],
		];
	}

	public function data()
	{
		$offices = get_field('general_info_offices', 'global_settings');

		return [
			'has_content' => !empty($this->get_field('title')) || !empty($offices),
			'offices' => $offices
		];
	}
}
