<?php
# Description: Display icons or statistic.

namespace Sleek\Modules;

class USP extends Module {
	public function fields () {
		return [
			[
				'key'	=> '{acf_key}_usp_settings_tab',
				'label' => 'Settings',
				'type' => 'tab',
				'placement' => 'top'
			],
			[
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'text',

			],
			[
				'name' => 'bg_color',
				'label' => __('Background Color', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'bg--pink' => 'Pink',
					'bg--off-white' => 'White',
					'bg--dark-teal'	=> 'Dark Teal',
				],
				'layout' => 'horizontal',
				"return_format" => "id",
				'default_value' => 'bg--pink'
			],
			[
				'key'	=> '{acf_key}_content_tab',
				'label' => 'Content',
				'type' => 'tab',
				'placement' => 'top'
			],
			[
				'key' => '{acf_key}_usp_content_view',
				'name' => 'content_view',
				'label' => __('Content View', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'statistic' => 'Statistic',
					'icon' => 'Icon'
				],
				'layout' => 'horizontal',
				"return_format" => "id",
				'default_value' => 'statistic'
			],
			[	
				'name' => 'content',
				'label' => __('Content', 'sleek'),
				'type' => 'repeater',
				'min' => 1,
				'layout' => 'row',
				'sub_fields' => [
					//for statistic
					[
						'name' => 'number',
						'label' => __('Number', 'sleek_admin'),
						'type' => 'text',
						"conditional_logic" => [
							[
								[
									"field" => "{acf_key}_usp_content_view",
									"operator" => "==",
									"value" => "statistic"
								]
							]
						],
					],
					[
						'name' => 'number_title',
						'label' => __('Number Title', 'sleek_admin'),
						'type' => 'text',
						"conditional_logic" => [
							[
								[
									"field" => "{acf_key}_usp_content_view",
									"operator" => "==",
									"value" => "statistic"
								]
							]
						]
					],

					//for icon
					[
						'name' => 'image',
						'label' => __('Icon', 'sleek'),
						'type' => 'image',
						'return_format' => 'id',
						"conditional_logic" => [
							[
								[
									"field" => "{acf_key}_usp_content_view",
									"operator" => "==",
									"value" => "icon"
								]
							]
                    	],
					],
					[
						'name' => 'title',
						'label' => __('Title', 'sleek_admin'),
						'type' => 'text',
					],
					[
						'name' => 'text',
						'label' => __('Text', 'sleek_admin'),
						'type' => 'text',
					],
				]
			],
			[
				'key'	=> '{acf_key}_usp_extra_tab',
				'label' => 'Extra',
				'type' => 'tab',
				'placement' => 'top'
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
