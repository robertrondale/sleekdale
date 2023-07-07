<?php
# Work out current post-type
$pt = Sleek\Utils\get_current_post_type();
$pt = $pt === 'page' ? 'post' : $pt; # In case this module is used on a page - show the post categories

# Grab all child terms
$terms = false;

if ($tax = sleek_get_cpt_category($pt)) {
    $terms = pnty_get_active_terms($pt);
}

# Ponty locations
$locations = pnty_get_distinct_post_meta($pt, '_pnty_location');

$currentId = null;
if (is_tax()) {
    $currentId = get_queried_object_id();
}

if (empty($locations) && empty($terms)) {
    return;
}
?>

<div class="job-listing-filter">
	<?php if ($terms) : ?>
	<div class="filter js-filter-group">
		<div class="filter-item">
			<button type="button"
				class="button button--small button--inherit-color <?= $currentId ? '' : 'button--inherit-color-active' ?> js-filter-item"
				data-name="tag"
				data-value=""><?= sleek_sitewide('job_listing_translation', 'all_categories', 'All categories') ?></button>
		</div>

		<?php foreach ($terms as $term) : ?>
		<div class="filter-item">
			<button type="button"
				class="button button--small button--inherit-color js-filter-item <?= $currentId == $term->term_id ? 'button--inherit-color-active' : '' ?>"
				data-name="tag" data-value="<?php echo $term->slug ?>"><?php echo $term->name ?></button>
		</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
	<?php if ($locations) : ?>
	<div class="filter js-filter-group">
		<div class="filter-item">
			<button type="button"
				class="button button--small button--inherit-color button--inherit-color-active js-filter-item"
				data-name="location"
				data-value=""><?= sleek_sitewide('job_listing_translation', 'all_locations', 'All locations') ?></button>
		</div>
		<?php foreach ($locations as $location) : ?>
		<div class="filter-item">
			<button type="button" class="button button--small button--inherit-color js-filter-item" data-name="location"
				data-value="<?= $location ?>"><?= $location ?></button>
		</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>