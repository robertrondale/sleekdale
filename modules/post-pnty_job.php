<?php

$postID = isset($postID) ? $postID : get_the_ID();

if (empty(get_post_status($postID))) {
    return;
}
?>

<a href="<?= get_the_permalink($postID) ?>" class="job-listing-item">
    <div class="job-listing-left">
        <div class="job-listing-position h5"><?= get_the_title($postID) ?></div>
        <?php if ($company = get_post_meta($postID, '_pnty_organization_name', true)) : ?>
            <div class="job-listing-company h5"><?= $company ?></div>
        <?php endif ?>
    </div>
    <div class="job-listing-right">
        <?php if ($tags = sleek_get_cpt_tag_names($postID)) : ?>
            <p class="job-listing-type"><?= $tags ?></p>
        <?php endif ?>
        <?php if ($location = get_post_meta($postID, '_pnty_location', true)) : ?>
            <p class="job-listing-location"><?= $location ?></p>
        <?php endif ?>
    </div>
</a>