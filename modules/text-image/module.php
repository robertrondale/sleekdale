<?php
# Description: Text Image Section

namespace Sleek\Modules;

class TextImage extends Module {
	public function fields () {
		return [
			[
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'text',
			],
			[
				'name' => 'is_text_first',
				'label' => __('Is text first?', 'sleek'),
				'type' => 'true_false',
				"instructions" => "<em>Enable to display text first.</em>",
				'layout' => 'horizontal',
				'wrapper' => ['width' => 50]
			],
			// Uncomment if needed bgcolor
			// [
			// 	'name' => 'bg_color',
			// 	'label' => __('Background Color', 'sleek'),
			// 	'type' => 'radio',
			// 	'wrapper'=> ['width'=>50],
			// 	'choices' => [
			// 		'bg--pink' => 'Pink',
			// 		'bg--off-white' => 'White'
			// 	],
			// 	'layout' => 'horizontal',
			// 	"return_format" => "id",
			// 	'default_value' => 'bg--pink'
			// ],
			[
				'name' => 'hide_arrow',
				'label' => __('Hide Arrow?', 'sleek'),
				'type' => 'true_false',
				'instructions' => 'By enabling this will hide the arrow',
				'wrapper'=> ['width'=>50],
			],
			[
				'name' => 'text',
				'label' => __('Content', 'sleek_admin'),
				'type' => 'textarea',

			],
			[
				'name' => 'image',
				'label' => __('Image', 'sleek'),
				'type' => 'image',
				'return_format' => 'id',
				'preview_size'	=> 'thumbnail',
				'required'		=> 1,
				"instructions" => "<em>Recommended size: 960 x 960px.</em>",
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