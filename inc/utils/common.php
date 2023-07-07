<?php

/**
 *
 * General functions
 *
 */

if (!function_exists('pr')) {
    function pr($str = "", $str2 = "")
    {
        echo "<pre>";
        print_r($str2);
        print_r($str);
        echo "</pre>";
    }
}

if (!function_exists('pll_current_language')) {
    function pll_current_language () 
    {
        $language = 'en';

        return $language;
    }
}


if (!function_exists('sleek_sitewide')) {
    function sleek_sitewide($group, $field, $default = '')
    {
        $return = get_field($group, 'site_settings');

        if (!empty($default)) {
            return !empty($return[$field]) ? $return[$field] : $default;
        } else {
            return $return[$field] ?? '';
        }
    }
}

/**
 * Append an array in a specific index within an array.
 * 
 * @param $array array, $index int, $insert array
 * @return array
 */
function sleek_array_insert($array, $index, $insert)
{
    return array_merge(
        array_slice($array, 0, $index, true),
        $insert,
        array_slice($array, $index, count($array) - $index, true)
    );
}


/**
 * Replace shortcode from text.
 * This will replace the shortcode (array key) with the array value
 *
 * @param $replaces array, $template text
 * @return text
 */
function sleek_render_shortcode($template, $replaces)
{
    if (!$replaces && !$template) {
        return;
    }

    return preg_replace_callback('/\[(.+?)\]/', function ($matches) use ($replaces) {
        return isset($replaces[$matches[1]]) ? $replaces[$matches[1]] : '';
    }, $template);
}


function sleek_is_post_type_listing($post_type = 'post')
{
    $postTaxonomy = sleek_get_cpt_category($post_type);

    return is_post_type_archive($post_type) || is_tax($postTaxonomy);
}


function sleek_empty_listing_content($type)
{
    $text = get_field('no_items_available', $type . '_settings');

    if (empty($text)) {
        $text = 'Sorry, nothing was found here.';
    }

    return sprintf('<p class="text-center">%s</p>', $text);
}

/**
 * Gets the image alt text.
 * Default: Site title
 *
 * @return string
 */
function sleek_get_image_alt($imageID, $default = '')
{
    $alt = get_post_meta($imageID, '_wp_attachment_image_alt', true);
    $post = get_post($imageID);
    $str = "";

    if ($alt) {
        $str = $alt;
    } else if ($default) {
        $str = $default;
    } else if (!empty($post->post_title)) {
        $str = $post->post_title;
    } else {
        $str = get_bloginfo('name');
    }

    return $str;
}
