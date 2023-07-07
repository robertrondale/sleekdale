<?php

$pt = get_post_type();
$postID = $post->ID;
$company = get_post_meta($postID, '_pnty_organization_name', true);
$location = get_post_meta($postID, '_pnty_location', true);
$applyBtn = get_post_meta($postID, '_pnty_apply_btn', true);
$tags = sleek_get_cpt_tag_names($postID);
$bgDesktop = get_the_post_thumbnail_url($postID, 'hero_desktop_large');
$bgMobile = get_the_post_thumbnail_url($postID, 'hero_mobile_large');
$employee = pnty_get_job_contact($postID);
?>


<section class="job-post-banner js-bg-switch bg--dark-teal" data-bg-desktop="<?= $bgDesktop ?>"
	data-bg-mobile="<?= $bgMobile ?>">
	<div class="job-post-wrapper">
		<?php if ($company ?? false) : ?>
		<div class="h4 job-post-company"><?= $company ?></div>
		<?php endif ?>

		<h1 class="h1 job-post-title"><?= get_the_title() ?></h1>

		<?php if (!empty($tags) || !empty($location)) : ?>
		<div class="job-post-tags">
			<?php if ($tags) : ?>
			<div class="job-post-tags-item"><?= $tags ?></div>
			<?php endif ?>

			<?php if ($location) : ?>
			<div class="job-post-tags-item"><?= $location ?></div>
			<?php endif ?>
		</div>
		<?php endif ?>

		<?php if ($excerpt = get_the_excerpt()) : ?>
		<p class="preamble job-post-description"><?= $excerpt ?></p>
		<?php endif ?>
	</div>
</section>

<?php if ($pt === 'pnty_job') : ?>
<section class="job-post-contact bg--dark-teal">
	<div class="job-post-contact-wrapper">
		<?php if ($employee) : ?>
		<div class="job-post-contact-profile">
			<?php if ($profileImage = get_the_post_thumbnail_url($employee->ID, 'square_thumbnail')) : ?>
			<figure class="job-post-contact-image ratio--1-1">
				<img class="js-lazy" data-src="<?= $profileImage ?>" alt="Profile">
			</figure>
			<?php endif ?>
			<div>
				<p class="preamble job-post-contact-name"><?= $employee->post_title ?></p>

				<?php if ($position = sleek_get_post_main_category($employee->ID, 'employee_position', 'name')) : ?>
				<div class="small job-post-contact-position"><?= $position ?></div>
				<?php endif ?>

				<ul class="job-post-contact-links list-unstyled">
					<?php if ($email = get_field('email', $employee->ID)) : ?>
					<li class="job-post-contact-links-item">
						<a class="job-post-contact-link" href="mailto:<?= $email ?>">
							<img class="job-post-contact-contact-icon"
								src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/email.svg"
								alt="Email">
							<div class="job-post-contact-mail"> <?= $email ?></div>
						</a>
					</li>
					<?php endif ?>
					<?php if ($phone = get_field('phone', $employee->ID)) : ?>
					<li class="job-post-contact-links-item">
						<a class="job-post-contact-link" href="tel:<?= $phone ?>">
							<img class="job-post-contact-contact-icon"
								src="<?php echo get_template_directory_uri(); ?>/dist/assets/icons/phone.svg"
								alt="Telephone">
							<div class="job-post-contact-tel"><?= $phone ?></div>
						</a>
					</li>
					<?php endif ?>
				</ul>
			</div>
		</div>
		<?php endif ?>

		<?php if ($applyBtn) : ?>
		<div class="job-post-contact-apply">
			<?= $applyBtn ?>
			<?php if ($openForApplication = sleek_sitewide('selected_job_translation', 'open_for_application')) : ?>
			<div class="small"><?= $openForApplication ?></div>
			<?php endif ?>
		</div>
		<?php endif ?>
	</div>
</section>
<?php endif ?>

<div class="job-post-details bg--off-white">
	<?php Sleek\Modules\render('text-editor', [
        'bg_color' => 'bg--off-white',
        'title' => get_the_content()
    ]); ?>

	<?php if ($pt === 'pnty_job') : ?>
	<div class="job-post-apply">
		<?= $applyBtn ?>
	</div>
	<?php endif ?>
</div>