<?php

/**
 *
 * Post helper related functions
 *
 */

function sleek_get_posts($post_type = 'post', $additionalArgs = [])
{
    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    if (sizeof($additionalArgs) > 0) {
        $args = array_merge($args, $additionalArgs);
    }

    $query = new \WP_Query($args);

    if (empty($query->posts)) {
        return false;
    };

    return $query->posts;
}

function sleek_get_post_main_category($postID, $taxonomy, $return = 'object')
{
    if (!$postID && !$taxonomy) {
        return null;
    }

    $categories = wp_get_post_terms($postID, $taxonomy);

    if (!$categories) {
        return null;
    }

    $category = $categories[0];

    foreach ($categories as $item) {
        if ($item->parent !== 0) {
            $category = $item;
        }
    }

    return $return === 'object' ? $category : ($category->$return ?? '');
}

function sleek_get_cpt_category($pt = 'post')
{
    if ($taxonomies = get_object_taxonomies($pt)) {
        $taxonomies = array_values(array_filter($taxonomies, function ($tax) {
            return ($tax === 'category')
                or ($tax === 'employee_group')
                or ($tax === 'employee_position')
                or (substr($tax, -9) === '_category')
                or (substr($tax, -4) === '_tag');
        }));

        if ($taxonomies) {
            return $taxonomies[0];
        }
    }

    return null;
}

function sleek_get_cpt_tag_names($postID)
{
    $pt = get_post_type($postID);
    $taxonomy = sleek_get_cpt_category($pt);
    $tags = wp_list_pluck(wp_get_post_terms($postID, $taxonomy), 'name') ?? [];

    return implode(', ', $tags);
}
