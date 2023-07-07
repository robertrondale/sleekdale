<?php
# Description: Add a menu to the page.

namespace Sleek\Modules;

use Inc\Classes\Navigation;

class Menu extends Module
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
				'name' => 'menu',
				'label' => __('Menu', 'sleek_admin'),
				'type' => 'taxonomy',
				'taxonomy' => 'nav_menu',
				'field_type' => 'select',
				'instructions' => '<em>Select which menu from <a href="' . get_admin_url(null, 'nav-menus.php') . '">Appearances > Menus</a> to display</em>'
			]
		];
	}

	public function data()
	{
		$menus = Navigation::getMenu($this->get_field('menu'));

		return [
			'has_content' => !empty($this->get_field('title')) || !empty($menus),
			'menu_items' => $menus
		];
	}
}
