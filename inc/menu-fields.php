<?php

########
# Menu Item
########

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_menu_item',
        'title' => __('Menu Item', 'sleek'),
        'location' => [[['param' => 'nav_menu_item', 'operator' => '==', 'value' => 'all']]],
        'menu_order' => 1,
        'style' => 'seamless',
        'fields' => [
            [
                'key' => 'group_menu_item_new_tab',
                'name' => 'open_in_new_tab',
                'label' => __('Open in new tab?', 'sleek_admin'),
                'type' => 'true_false',
            ],
        ]
    ]);
});
