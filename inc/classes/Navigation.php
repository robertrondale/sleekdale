<?php

namespace Inc\Classes;

/**
 * 
 * All navigation related code goes here
 * 
 **/

class Navigation
{
    public static function getMenuId($menuName)
    {
        if (empty($menuName) || !isset(get_nav_menu_locations()[$menuName])) {
            return null;
        }

        return wp_get_nav_menu_object(get_nav_menu_locations()[$menuName]);
    }

    public static function getMenu($menuId)
    {
        if (empty($menuId)) {
            return [];
        }

        $menu = wp_get_nav_menu_items($menuId);

        return self::groupMenus($menu);
    }

    // Group menu object by parent menu
    private static function groupMenus($menu)
    {
        $new_menu = array();

        if (empty($menu)) {
            return $new_menu;
        }

        foreach ($menu as $menuItem) {
            $menuItem->isLink = $menuItem->url !== '#';
            $menuItem->target = get_field('open_in_new_tab', $menuItem->ID) ? '_blank' : '';

            // Group by parent menu
            if ($menuItem->menu_item_parent === '0') {
                $new_menu[$menuItem->ID] = $menuItem;
                $new_menu[$menuItem->ID]->children = array();
            } else {
                if (!isset($new_menu[$menuItem->menu_item_parent])) {
                    continue;
                }

                $new_menu[$menuItem->menu_item_parent]->children[] = $menuItem;
            }
        }

        return $new_menu;
    }
}
