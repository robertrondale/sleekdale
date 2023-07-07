<?php
# Description: Text Image Animated Section

namespace Sleek\Modules;

class TextImageAnimated extends Module {
	public function fields () {
		return [
			[
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'text',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'is_text_first',
				'label' => __('Is text first?', 'sleek'),
				'type' => 'true_false',
				'instructions' => '<em>Enable to display text first.</em>',
				'wrapper' => ['width' => 50],
				'layout' => 'horizontal',
			],
			// Uncomment if needed bgcolor
			[
				'name' => 'bg_color',
				'label' => __('Background Color', 'sleek'),
				'type' => 'radio',
				'wrapper'=> ['width'=>50],
				'choices' => [
					'bg--dark-teal'	=> 'Dark Teal',
					'bg--pink' => 'Pink'
				],
				'layout' => 'horizontal',
				"return_format" => "id",
				'default_value' => 'bg--dark-teal'
			],
			[
				'name' => 'text',
				'label' => __('Content', 'sleek_admin'),
				'type' => 'textarea',

			],
			[
				'name' => 'link',
				'label' => __('Link', 'sleek_admin'),
				'type' => 'link',

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