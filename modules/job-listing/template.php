<section class="section section-job-listing has-filter section--padding section--fullWidth bg--off-white js-listing" data-type="<?= $post_type ?>" data-termid="<?= $tag ?? '' ?>" data-company="<?= $company ?? '' ?>">

	<?php if ($include_filter ?? false) : ?>
		<?php Sleek\Modules\render('archive-filter-job'); ?>
	<?php endif ?>

	<?php if ($wp_query->posts ?? false) : ?>
		<div class=" job-listing-wrapper js-list-wrapper">
			<?php foreach ($wp_query->posts as $post) : ?>
				<?php get_template_part('modules/post', get_post_type($post), ['postID' => $post->ID]) ?>
			<?php endforeach ?>
		</div>
	<?php endif ?>

	<?php if ($jobCountText = sleek_sitewide('job_listing_translation', 'job_count_text')) : ?>
		<div class="job-listing-count">
			<small class="js-list-total-count">
				<?= sleek_render_shortcode($jobCountText, ['current_jobs' => $wp_query->post_count, 'total_jobs' => $wp_query->found_posts]) ?>
			</small>
		</div>
	<?php endif ?>

	<?php if ($wp_query->max_num_pages > 1) : ?>
		<div class="job-listing-loadmore">
			<button class="button button--primary js-load-more" data-page="1">
				<span><?= sleek_sitewide('general_translation', 'load_more', 'Load more') ?></span>
				<span class="spinner-border" role="status" aria-hidden="true"></span>
			</button>
		</div>
	<?php endif ?>
</section>