<?php

$pt = Sleek\Utils\get_current_post_type();
$queriedObject = '';

if ((is_archive() || is_home()) && function_exists('get_field')) {
    $queriedObject = $pt . '_settings';
} elseif (is_tax() && function_exists('get_field')) {
    $queriedObject = get_queried_object();
}

$image = get_field('image', $queriedObject);
$mobileImage = get_field('image_mobile', $queriedObject) ? get_field('image_mobile', $queriedObject) : $image;

Sleek\Modules\render('text-hero', [
    'title' => get_the_archive_title(),
    'preamble' => strip_tags(get_the_archive_description(), '<a><br><strong><em><span><ul><li>'),
    'image' => $image,
    'image_mobile' => $mobileImage,
    'link' => [],
]);
