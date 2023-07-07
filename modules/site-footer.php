<footer class="footer section--fullWidth js-bg-switch"
	data-bg-desktop="<?php echo get_template_directory_uri(); ?>/dist/assets/img/footer-bg-desktop.jpg"
	data-bg-mobile="<?php echo get_template_directory_uri(); ?>/dist/assets/img/footer-bg-mobile.jpg">
	<div class="container-fluid no-gutter-grid">
		<div class="row">
			<?php Sleek\Modules\render_flexible('footer_columns', 'site_settings') ?>
			<div class="col-12 footer-logo">
				<a href="<?= home_url('/') ?>">
					<img class="js-lazy" data-src=" <?php echo get_template_directory_uri(); ?>/dist/assets/icons/footer-logo.svg"
						alt="<?= get_bloginfo('name') ?>">
				</a>
			</div>
		</div>
		<div class="footer-submenu row">
			<?php if ($bottomLinks = get_field('footer_bottom_links', 'site_settings')) : ?>
			<div class="footer-submenu-column">
				<ul class="footer-submenu-links list-unstyled">
					<?php foreach ($bottomLinks as $link) : ?>
					<li class="footer-link-item">
						<a class="small footer-link" href="<?= $link['link']['url'] ?>"
							target="<?= $link['link']['target'] ?>"><?= $link['link']['title'] ?></a>
					</li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php endif ?>
			<?php if ($awards = get_field('general_info_awards', 'global_settings')) : ?>
			<div class="footer-submenu-column footer-awards-column">
				<ul class="footer-awards list-unstyled">
					<?php foreach ($awards as $award) :?>
					<li class="footer-awards-item">
						<?= wp_get_attachment_image($award) ?>
					</li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php endif ?>
			<div class="footer-copyright footer-submenu-column">
				<small
					class="footer-copyright-text"><?= get_field('general_info_copyright', 'global_settings') ?? '' ?: '© Beyond Retail 2022' ?></small>
			</div>
		</div>
	</div>
</footer>