<?php
# Description: Services Section

namespace Sleek\Modules;

class Services extends Module {
	public function fields () {
		return [
			[
				'name' => 'items',
				'label' => __('Items', 'sleek'),
				'type' => 'repeater',
				'instructions' => 'Add up to 3 items to display in this section.',
				'max' => 3,
				'layout' => 'row',
				'sub_fields' => [
					[	
						'key' => '{acf_key}_services_option',
						'name' => 'title_option',
						'label' => __('Title Option', 'sleek'),
						'type' => 'radio',
						'choices' => [
							'title' => 'Title',
							'link' => 'Link'
						],
						'layout' => 'horizontal',
						'return_format' => 'id',
						'default_value' => 'title'
					],
					[
						'name' => 'title',
						'label' => __('Title', 'sleek'),
						'required'		=> true,
						'type' => 'text',
						'conditional_logic' => [
							[
								[
									'field' => '{acf_key}_services_option',
									'operator' => '==',
									'value' => 'title'
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
									'field' => '{acf_key}_services_option',
									'operator' => '==',
									'value' => 'Link'
								]
							]
						]
					],
					[
						'name' => 'image',
						'label' => __('Icon', 'sleek'),
						'type' => 'image',
						'return_format' => 'ID',
						'preview_size' => 'thumbnail',
						'required'		=> true,
						// 'instructions' => 'Recommended sizes: <br><strong>Landscape - </strong>750 x 498px<br/><strong>Portrait - </strong>750 x 995px'
					],
					[
						'name' => 'service_links',
						'label' => __('Service Links', 'sleek'),
						'type' => 'repeater',
						'layout' => 'row',
						'max'	=> 3,
						'sub_fields' => [
							[
								'name' => 'link',
								'label' => __('Link', 'sleek'),
								'type' => 'link',
								'return_format' => 'array'
							],
						]
					],
					
				],
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