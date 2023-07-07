<?php

/**
 *
 * Ponty related helpers
 *
 */

function pnty_get_job_contact($postID)
{
    $employee = [];

    if (empty($postID)) {
        return $employee;
    }

    $email = get_post_meta($postID, '_pnty_email', true);

    if (empty($email)) {
        return $employee;
    }

    $args = array(
        'meta_query' => array(
            array(
                'key' => 'email',
                'value' => $email,
                'compare' => '=='
            )
        )
    );

    return sleek_get_posts('employee', $args)[0] ?? [];
}

function pnty_get_distinct_post_meta($post_type, $meta_key)
{
    global $wpdb;

    $query = "
    SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
    LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
    WHERE p.post_status = 'publish'
    AND pm.meta_key = '{$meta_key}'
    AND pm.meta_value != ''";

    if (!empty($post_type)) {
        $cond = $wpdb->prepare(' AND p.post_type = %s', $post_type);
        $query .= $cond;
    }

    $query .= ' ORDER BY pm.meta_value ASC';

    return $wpdb->get_col($query);
}
