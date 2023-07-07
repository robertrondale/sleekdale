<?php get_header() ?>

<main>
	<?php $page = get_field('settings_404_page', 'site_settings'); ?>
	<?php if (isset($page) && !empty($page)) : ?>
		<?php Sleek\Modules\render_flexible('flexible_modules', $page) ?>
	<?php endif ?>
</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
