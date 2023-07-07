<?php

add_action('acf/init', function () {

    # Global Settings Page
    acf_add_options_page([
        'page_title' => __('Global Settings', 'sleek'),
        'menu_slug' => 'global_settings',
        'post_id' => 'global_settings'
    ]);

    # Settings
    acf_add_local_field_group([
        'key' => 'group_global_settings',
        'title' => __('Global Settings', 'sleek'),
        'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'global_settings']]],
        'menu_order' => 1,
        'style' => 'seamless',
        'fields' => [
            # General Info
            [
                'key' => 'gs_general_info',
                'type' => 'tab',
                'label' => __('General', 'sleek_admin'),
            ],
            [
                'key' => 'gs_general_info_offices',
                'name' => 'general_info_offices',
                'label' => __('Offices', 'sleek_admin'),
                'type' => 'repeater',
                'layout' => 'table',
                'max' => 2,
                'sub_fields' => [
                    [
                        'key' => 'gs_general_info_offices_title',
                        'name' => 'title',
                        'label' => __('Title', 'sleek_admin'),
                        'type' => 'text',
                    ],                    
                    [
                        'key' => 'gs_general_info_offices_text',
                        'name' => 'text',
                        'label' => __('Text', 'sleek_admin'),
                        'type' => 'textarea',
                        'rows' => 3,
                        'new_lines' => 'br',
                    ],
                    [
                        'key' => 'gs_general_info_offices_link',
                        'name' => 'map_link',
                        'label' => __('Google map link', 'sleek_admin'),
                        'type' => 'url',
                    ]
                ]
            ],
            [
                'key' => 'gs_general_info_contacts',
                'name' => 'general_info_contacts',
                'label' => __('Contacts', 'sleek_admin'),
                'type' => 'repeater',
                'layout' => 'row',
                'max' => 10,
                'sub_fields' => [
                    [
                        'key' => 'gs_general_info_contacts_type',
                        'name' => 'type',
                        'label' => __('Type', 'sleek_admin'),
                        'type' => 'select',
                        'choices' => [
                            'email' => __('Email', 'sleek_admin'),
                            'phone' => __('Phone', 'sleek_admin'),
                            'text' => __('Text', 'sleek_admin'),
                        ],  
                        'default_value' => 'email'                      
                    ],    
                    [
                        'key' => 'gs_general_info_contacts_phone',
                        'name' => 'phone',
                        'label' => __('Phone', 'sleek_admin'),
                        'type' => 'text',
                        'conditional_logic' => [
                            [[
                                'field' => 'gs_general_info_contacts_type',
                                'operator' => '==',
                                'value' => 'phone'
                            ]]
                        ]                        
                    ],                                    
                    [
                        'key' => 'gs_general_info_contacts_text',
                        'name' => 'text',
                        'label' => __('Text', 'sleek_admin'),
                        'type' => 'text',
                        'conditional_logic' => [
                            [[
                                'field' => 'gs_general_info_contacts_type',
                                'operator' => '==',
                                'value' => 'text'
                            ]]
                        ]                        
                    ],
                    [
                        'key' => 'gs_general_info_contacts_email',
                        'name' => 'email',
                        'label' => __('E-mail', 'sleek_admin'),
                        'type' => 'email',
                        'conditional_logic' => [
                            [[
                                'field' => 'gs_general_info_contacts_type',
                                'operator' => '==',
                                'value' => 'email'
                            ]]
                        ]                        
                    ],                    
                ]
            ],            
            [
                'key' => 'gs_general_info_awards',
                'name' => 'general_info_awards',
                'label' => __('Awards gallery', 'sleek_admin'),
                'type' => 'gallery',
                'return_format' => 'ID',
                'instructions' => '<em>Can add up to 4 images.</em>',
                'min' => 0,
                'max' => 4,
            ],
            [
                'key' => 'gs_general_info_copyright',
                'name' => 'general_info_copyright',
                'label' => __('Copyright', 'sleek_admin'),
                'type' => 'text',
                'default_value' => '© Beyond Retail 2022',
            ],
            [
                'key' => 'gs_general_info_mailchimp',
                'name' => 'general_info_mailchimp',
                'label' => __('Mailchimp API Key', 'sleek_admin'),
                'type' => 'text',
            ],
            # General Info

            # Scripts
            [
                'key' => 'gs_scripts_page_tab',
                'label' => __('Scripts', 'sleek'),
                'type' => 'tab',
            ],
            [
                'key' => 'gs_scripts_header',
                'name' => 'scripts_header',
                'label' => __('Header scripts', 'sleek'),
                'type' => 'textarea',
                'instructions' => '<em>Add scripts like Google analytics, trustpilot, etc. Only use trusted scripts as other harmful scripts can cause issues for this site and/or for the user.</em>'
            ],
            [
                'key' => 'gs_scripts_footer',
                'name' => 'scripts_footer',
                'label' => __('Footer scripts', 'sleek'),
                'type' => 'textarea',
                'instructions' => '<em>Only use trusted scripts as other harmful scripts can cause issues for this site and\/or for the user.</em>'
            ],
        ]
    ]);
});

########
# Header
add_action('wp_head', function () {
    if ($code = get_field('scripts_header', 'global_settings')) {
        echo $code;
    }
});

########
# Footer
add_action('wp_footer', function () {
    if ($code = get_field('scripts_footer', 'global_settings')) {
        echo $code;
    }
});
