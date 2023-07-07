<?php

########
# Make ponty jobs visible
add_filter('register_post_type_args', function ($args, $postType) {
    if (!defined('PNTY_PTNAME') || !defined('PNTY_PTNAME_SHOWCASE')) {
        return $args;
    }

    if ($postType === PNTY_PTNAME || $postType === PNTY_PTNAME_SHOWCASE) {
        $args['public'] = true;
        $args['show_ui'] = true;
        $args['publicly_queryable'] = true;
        $args['supports'] = array('title', 'thumbnail', 'editor');
    }

    return $args;
}, 10, 2);

########
# Register flexible modules in pnty_job and pnty_job_showcase CPT
add_action('init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    # List of post type to add the field
    $postTypes = ['pnty_job'];

    # List of modules to display in the Post tyoe archive
    $flexibleModules = ['hero', 'text-image', 'text-image-animated', 'usp', 'text-editor', 'article-promo', 'logos', 'text-hero', 'team', 'contact-promo',  'job-listing', 'anchor-links', 'expertise', 'services', 'newsletter'];

    foreach ($postTypes as $postType) {
        $groupKey = $postType . '_settings_flexible_modules';

        $flexibleFields[] = [
            'key' => $groupKey,
            'name' => 'flexible_modules',
            'button_label' => __('Add a module', 'sleek_admin'),
            'type' => 'flexible_content',
            'layouts' => \Sleek\Acf\generate_keys(\Sleek\Modules\get_module_fields($flexibleModules, 'flexible'), $groupKey)
        ];

        # Create the group
        $fieldGroup = [
            'key' => 'group_' . $groupKey,
            'title' => __('Modules', 'sleek_admin'),
            'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => $postType . '_settings']]],
            'fields' => $flexibleFields
        ];

        # Register field group
        acf_add_local_field_group($fieldGroup);
    }
}, 99);

########
# Add Image mobile field in pnty archive settings
add_action('sleek/post_types/archive_fields', function ($fields, $post_type) {
    if (in_array($post_type, ['pnty_job', 'pnty_job_showcase']) === false) {
        return $fields;
    }

    $toAppendBetween = [[
        'label' => __('Image (Mobile)', 'sleek_admin'),
        'name' => 'image_mobile',
        'type' => 'image',
        'return_format' => 'id',
    ]];

    $newFields = sleek_array_insert($fields, 2, $toAppendBetween);

    $toAppendAfter = [
        [
            'label' => __('Posts per page', 'sleek_admin'),
            'name' => 'posts_per_page',
            'type' => 'number',
            'default_value' => 10
        ],
        [
            'name' => 'no_items_available',
            'label' => __('No items available', 'sleek_admin'),
            'type' => 'textarea',
            'rows' => 4,
            'new_lines' => 'br',
            'default_value' => 'Sorry, nothing was found here.'
        ]
    ];

    return sleek_array_insert($newFields, count($newFields), $toAppendAfter);
}, 10, 2);

########
# Set posts per page count set in archive settings
add_action('pre_get_posts', function ($query) {
    if (!is_admin() and $query->is_main_query()) {
        $pt = Sleek\Utils\get_current_post_type();

        # Set product posts per page based on archive settings
        if (in_array($pt, ['pnty_job', 'pnty_job_showcase']) !== false && sleek_is_post_type_listing($pt)) {
            $postPerPage = get_field('posts_per_page', $pt . '_settings') ?? 10 ?: 10;
            $query->set('posts_per_page', $postPerPage);
        }
    }
});
