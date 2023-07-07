<?php

global $wp_query;

# Get current post type
$pt = Sleek\Utils\get_current_post_type();

# Header
Sleek\Modules\render('archive-header');
?>

<section class="section section--padding section--fullWidth section-blog-listing bg--dark-teal js-listing" data-type="<?= $pt ?>">
	<?php Sleek\Modules\render('archive-filter'); ?>
	<div class="section-blog-listing-body">
		<div class="articles articles--portrait articles--listing js-list-wrapper">
			<?php while (have_posts()) : the_post() ?>
				<?php get_template_part('modules/post', get_post_type()) ?>
			<?php endwhile ?>
		</div>
	</div>
	<?php if ($wp_query->max_num_pages > 1) : ?>
		<div class="section-blog-listing-footer">
			<button type="button" class="button button--inherit-color js-load-more" data-page="1">
				<span><?= sleek_sitewide('general_translation', 'load_more', 'Load more') ?></span>
				<span class="spinner-border" role="status" aria-hidden="true"></span>
			</button>
		</div>
	<?php endif ?>
</section>