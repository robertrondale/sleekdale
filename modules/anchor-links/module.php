<?php
# Description: Anchor Links Section

namespace Sleek\Modules;

class AnchorLinks extends Module {
	public function fields () {
		return [
			[
				'name' => 'items',
				'label' => __('Items', 'sleek'),
				'type' => 'repeater',
				// 'instructions' => 'Add up to 3 items to display in this section.',
				// 'max' => 3,
				'layout' => 'row',
				'sub_fields' => [
					[	
						'key' => '{acf_key}_anchor_links_option',
						'name' => 'links_option',
						'label' => __('Links Option', 'sleek'),
						'type' => 'radio',
						'choices' => [
							'anchor' => 'Anchor',
							'links' => 'Links'
						],
						'layout' => 'horizontal',
						'return_format' => 'id',
						'default_value' => 'anchor'
					],
					[
						'name' => 'anchor_title',
						'label' => __('Anchor Title', 'sleek'),
						// 'required'		=> true,
						'type' => 'text',
						'conditional_logic' => [
							[
								[
									'field' => '{acf_key}_anchor_links_option',
									'operator' => '==',
									'value' => 'anchor'
								]
							]
						],
					],
					[
						'name' => 'anchor_id',
						'label' => __('Anchor ID', 'sleek'),
						'instructions' => '<em>This is the target part of the page to scroll when clicked. This will only work if the ID is available on the same page. The ID must have a unique name on the page, avoid generic words like "content", "main", "nav" and try to be more specific e.g. "beyondSectionTeam".</em>',
						'type' => 'text',
						'conditional_logic' => [
							[
								[
									'field' => '{acf_key}_anchor_links_option',
									'operator' => '==',
									'value' => 'anchor'
								]
							]
						],
					],
					[
						'name' => 'link',
						'label' => __('Link', 'sleek'),
						'type' => 'link',
						'return_format' => 'array',
						'conditional_logic' => [
							[
								[
									'field' => '{acf_key}_anchor_links_option',
									'operator' => '==',
									'value' => 'links'
								]
							]
						],
					],
				],
			]

		];
	}
}