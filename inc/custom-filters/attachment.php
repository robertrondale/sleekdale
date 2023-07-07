<?php

########
# Add data-src to Images with lazy load
add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment) {
    if (is_admin()) {
        return $attr;
    }

    $existingClasses = isset($attr['class']) ? explode(' ', $attr['class']) : [];

    # Unset lazy loading for image with no-lazy class
    if (in_array('no-lazy', $existingClasses)) {
        unset($attr['loading']);
    }

    if (!in_array('js-lazy', $existingClasses) && !in_array('no-lazy', $existingClasses)) {
        $existingClasses[] = 'js-lazy';
    }

    if (isset($attr['class']) && in_array('js-lazy', $existingClasses)) {
        $attr['data-src'] = isset($attr['src']) ? $attr['src'] : '';
        unset($attr['src']);

        $attr['data-srcset'] = isset($attr['srcset']) ? $attr['srcset'] : '';
        unset($attr['srcset']);
    }

    if (empty($attr['alt'])) {
        $attr['alt'] = sleek_get_image_alt($attachment->ID);
    }

    $attr['class'] = implode(' ', $existingClasses);

    return $attr;
}, 10, 2);
