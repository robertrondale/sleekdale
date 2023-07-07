<?php
namespace Sleek\PostTypes;

class Employee extends PostType {
	public function init () {
		# Enable translations of post type & tax
		add_filter('pll_get_post_types', function ($postTypes, $isSettings) {
			if ($isSettings) {
				$postTypes['employee'] = 'employee';
			}

			return $postTypes;
		}, 10, 2);

		add_filter('pll_get_taxonomies', function ($taxonomies, $isSettings) {
			if ($isSettings) {
				$taxonomies['employee_position'] = 'employee_position';
				$taxonomies['employee_group'] = 'employee_group';
			}

			return $taxonomies;
		}, 10, 2);
	}

	public function config () {
		return [
			'menu_icon' => 'dashicons-businesswoman',
			'public' => false,
			'show_ui' => true,
			'menu_position' => 40,
			'taxonomies' => ['employee_group', 'employee_position']
		];
	}

	public function fields () {
		return [
			[
				'name' => 'phone',
				'label' => __('Phone', 'sleek'),
				'type' => 'text'
			],
			[
				'name' => 'email',
				'label' => __('E-mail', 'sleek'),
				'type' => 'email'
            ],
			[
				'name' => 'url',
				'label' => __('Website', 'sleek'),
				'type' => 'url'
			],            
		];
	}
}
