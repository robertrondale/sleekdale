<?php

$pt = Sleek\Utils\get_current_post_type();
$pt = $pt === 'page' ? 'post' : $pt; # In case this module is used on a page - show the post categories

# Grab all child terms
$terms = false;

if ($tax = sleek_get_cpt_category($pt)) {
    $terms = get_terms([
        'taxonomy' => $tax,
        'parent' => is_tax() ? get_queried_object()->term_id : 0,
        'hide_empty' => true
    ]);
}

if (empty($terms)) {
    return;
}
?>

<div class="section-blog-listing-header">
    <div class="filter js-filter-group">
        <div class="filter-item">
            <button type="button" class="button button--inherit-color button--inherit-color-active js-filter-item" data-name="tag" data-value=""><?= sleek_sitewide('blog_listing_translation', 'all_categories', 'All categories') ?></button>
        </div>
        <?php foreach ($terms as $term) : ?>
            <div class="filter-item">
                <button type="button" class="button button--inherit-color js-filter-item" data-name="tag" data-value="<?php echo $term->slug ?>"><?php echo $term->name ?></button>
            </div>
        <?php endforeach ?>
    </div>
</div>