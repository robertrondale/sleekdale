<?php get_header() ?>

<main>

	<?php get_template_part('modules/archive', (Sleek\Utils\get_current_post_type() ?? 'post')) ?>
	<?php Sleek\Modules\render_flexible('flexible_modules', (Sleek\Utils\get_current_post_type() ?? 'post') . '_settings') ?>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
