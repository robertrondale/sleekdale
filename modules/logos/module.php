<?php
# Description: Display logo/s.

namespace Sleek\Modules;

class Logos extends Module {
	public function fields () {
		return [
			[
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'text',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'bg_color',
				'label' => __('Background Color', 'sleek'),
				'type' => 'radio',
				'wrapper' => ['width' => 50],
				'choices' => [
					'bg--pink' => 'Pink',
					'bg--off-white' => 'White'
				],
				'layout' => 'horizontal',
				"return_format" => "id",
				'default_value' => 'bg--pink'
			],
			[
				'name' => 'description',
				'label' => __('Description', 'sleek_admin'),
				'type' => 'textarea',
				'rows' => 4,
                'new_lines' => 'br'
			],
			[
				'name' => 'logos',
				'label' => __('Logos', 'sleek'),
				'type' => 'gallery',
				'return_format' => 'id'
			],
			[
				'name' => 'anchor_id',
				'label' => __('Anchor ID', 'sleek'),
				'instructions' => '<em>This is the target part of the page to scroll when clicked. This will only work if the ID is available on the same page. The ID must have a unique name on the page, avoid generic words like "content", "main", "nav" and try to be more specific e.g. "beyondSectionTeam".</em>',
				'type' => 'text',
			],
		];
	}
}