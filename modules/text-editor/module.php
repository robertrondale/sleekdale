<?php
# Description: Text Editor Section

namespace Sleek\Modules;

class TextEditor extends Module {
	public function fields () {
		return [
			[
				'key'	=> '{acf_key}_text_title',
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'wysiwyg',
				"tabs"=> "all",
            	"toolbar"=> "full",
				'media_upload' => 1,
			],
			[
				'name' => 'bg_color',
				'label' => __('Background Color', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'bg--dark-teal'	=> 'Dark Teal',
					'bg--pink' => 'Pink',
					'bg--off-white' => 'White'
				],
				'layout' => 'horizontal',
				"return_format" => "id",
				'default_value' => 'bg--dark-teal'
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