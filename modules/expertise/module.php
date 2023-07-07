<?php
# Description: Display Expertise.

namespace Sleek\Modules;

class Expertise extends Module
{
	public function fields()
	{
		return [
					[
						'name' => 'items',
						'label' => __('Items', 'sleek'),
						'type' => 'repeater',
						'instructions' => 'Add up to 6 items to display in this section.',
						'max' => 6,
						'layout' => 'row',
						'sub_fields' => [
							[
								'name' => 'title',
								'label' => __('Title', 'sleek'),
								'type' => 'text',
							],
							[
								'name' => 'preamble',
								'label' => __('Preamble', 'sleek'),
								'type' => 'text',
							],
							[
								'name' => 'details_content',
								'label' => __('Details Content', 'sleek'),
								'type' => 'repeater',
								'layout' => 'row',
								'sub_fields' => [
									[
										'name' => 'title',
										'label' => __('Title', 'sleek'),
										'type' => 'text',
									],
									[
										'name' => 'details_list',
										'label' => __('Details List', 'sleek'),
										'type' => 'repeater',
										'layout' => 'row',
										'sub_fields' => 
										[
											[
												'name' => 'text',
												'label' => __('Text', 'sleek'),
												'type' => 'text',
											],
										]
									]
								]
							],
							[
								'name' => 'image',
								'label' => __('icon', 'sleek'),
								'type' => 'image',
								'return_format' => 'ID',
								'preview_size' => 'thumbnail',
								'required'		=> true,
								// 'instructions' => 'Recommended sizes: <br><strong>Landscape - </strong>750 x 498px<br/><strong>Portrait - </strong>750 x 995px'
							],
							[
								'name' => 'link',
								'label' => __('Link', 'sleek'),
								'type' => 'link',
								'return_format' => 'array'
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
