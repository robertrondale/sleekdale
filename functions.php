<?php
########
# Vendor
require __DIR__ . '/vendor/autoload.php';

###################
# Load translations
load_theme_textdomain('sleek', get_template_directory() . '/dist/lang/');
load_theme_textdomain('sleek_admin', get_template_directory() . '/dist/lang/admin/');

################
# Sleek settings
// add_theme_support('sleek/classic_editor');
add_theme_support('sleek/jquery_cdn');
// add_theme_support('sleek/disable_jquery');
add_theme_support('sleek/disable_404_guessing');
# add_theme_support('sleek/nice_email_from'); NOTE: This overrides whatever from is set in CF7 so don't use probably
add_theme_support('sleek/disable_theme_editor');
# add_theme_support('sleek/get_terms_post_type_arg');
add_theme_support('sleek/acf/hide_admin');
# add_theme_support('sleek/acf/fields/redirect_url');
add_theme_support('sleek/archive_filter');
add_theme_support('sleek/cleanup/comment_form_placeholders');
add_theme_support('sleek/cleanup/disable_comments');
# add_theme_support('sleek/gallery/slideshow'); # Convert galleries to slideshows
add_theme_support('sleek/oembed/responsive_video'); # Adds div.video around embeds
# add_theme_support('sleek/oembed/data_src'); # Replaces src attributes with data-src - use together with sleek-ui/vide-embed
// add_theme_support('sleek/login/styling');
# add_theme_support('sleek/login/require_login');
# add_theme_support('sleek/modules/module_preview'); # NOTE: Alpha
# add_theme_support('sleek/modules/inline_edit'); # NOTE: Alpha
add_theme_support('sleek/modules/add_new_module_preview');
add_theme_support('sleek/modules/module_icons');
# add_theme_support('sleek/modules/global_modules');
add_theme_support('sleek/notices/outdated_browser_warning');
add_theme_support('sleek/notices/cookie_consent');
add_theme_support('sleek/tinymce/disable_colors');
add_theme_support('sleek/tinymce/clean_paste');

#############
# Image sizes
Sleek\ImageSizes\register(1920, 1080, ['center', 'center'], [
	// 'original' => ['width' => 1920, 'height' => 9999, 'crop' => false],
	// 'portrait' => ['width' => 1080, 'height' => 1920, 'crop' => ['center', 'top']],
	'square' => ['width' => 1080, 'height' => 1080],
	'fifty_image' => ['width' => 960, 'height' => 960],
	'article_promo_portrait' => ['width' => 750, 'height' => 995],
	'article_promo_landscape' => ['width' => 750, 'height' => 498],
	'hero_desktop' => ['width' => 1920, 'height' => 1065],
	'hero_mobile' => ['width' => 750, 'height' => 1500],
	'text_hero_dekstop' => ['width' => 1920, 'height' => 1050],
	'text_hero_mobile' => ['width' => 750, 'height' => 1200],
]


);

#######
# Menus
register_nav_menus([
	'header_menu' => __('Header menu', 'sleek_admin'),
	'additional_header_menu' => __('Additional header menu (Display on hamburger menu)', 'sleek_admin')
]);

################
# Sleek settings
/* add_action('admin_init', function () {
	Sleek\Settings\add_setting('hubspot_portal_id', 'text', __('Hubspot Portal ID', 'sleek'));
	Sleek\Settings\add_setting('hubspot_api_key', 'text', __('Hubspot API Key', 'sleek'));
});

# ... use them
add_action('wp_head', function () {
	if ($portalId = Sleek\Settings\get_setting('hubspot_portal_id')) {
		echo '<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/' . $portalId . '.js"></script>';
	}
}); */

############
# ACF fields
add_action('acf/init', function () {
	# Site Settings Page
/*	acf_add_options_page([
		'page_title' => __('Site Settings', 'sleek'),
		'menu_slug' => 'site_settings',
		'post_id' => 'site_settings'
	]); */

	# Site Setting Fields
/*	acf_add_local_field_group([
		'key' => 'site_settings',
		'title' => __('Site Settings', 'sleek'),
		'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'site_settings']]],
		'menu_order' => 0,
		'fields' => [
			[
				'key' => 'site_settings_message',
				'name' => 'message',
				'type' => 'message',
				'label' => __('Nothing here', 'sleek'),
				'message' => __('Nothing here yet.', 'sleek')
			]
		]
	]); */

	# Sidebar Modules
/*	acf_add_local_field_group([
		'key' => 'group_sidebar_modules',
		'title' => __('Sidebar Modules', 'sleek'),
		'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'site_settings']]],
		'menu_order' => 1,
		'fields' => [
			[
				'key' => 'sidebar_modules',
				'name' => 'sidebar_modules',
				'type' => 'flexible_content',
				'label' => __('Sidebar Modules', 'sleek'),
				'button_label' => __('Add a module', 'sleek'),
				'layouts' => Sleek\Acf\generate_keys(
					Sleek\Modules\get_module_fields([
						'text-block' # Add more modules as needed
					], 'flexible'),
					'sidebar_modules'
				)
			]
		]
	]); */

	# Make site settings translatable
	/*	add_filter('acf/validate_post_id', function ($postId) {
		if ($postId == 'site_settings') {
			$dl = acf_get_setting('default_language');
			$cl = acf_get_setting('current_language');

			if ($cl and $cl !== $dl) {
				$postId .= '_' . $cl;
			}
		}

		return $postId;
	}); */
});

##################################
# Add common fields to all modules
 add_filter('sleek/modules/fields', function ($fields, $module) {
	if (empty($fields)) {
		return $fields;
	} 
	
	$newFields = [];

	foreach ($fields as $key => $field) {
		$field['translations'] = 'ignore';
		$newFields[$key] = $field;
	}

	return $newFields;
}, 10, 2);


add_action('wp_enqueue_scripts', function () {
	wp_localize_script(
		'sleek',
		'sitewide_object',
		array(
			'assets' => get_stylesheet_directory_uri() . '/dist/assets',
		)
	);
}, 100);

#####
# Inc
require __DIR__ . '/inc/ponty.php';
require __DIR__ . '/inc/gutenberg.php';
require __DIR__ . '/inc/global-settings.php';
require __DIR__ . '/inc/site-settings.php';

#####
# Utils
require __DIR__ . '/inc/utils/common.php';
require __DIR__ . '/inc/utils/ponty.php';
require __DIR__ . '/inc/utils/post.php';

#####
# Custom Filters
require __DIR__ . '/inc/custom-filters/tinymce.php';
require __DIR__ . '/inc/custom-filters/attachment.php';

#####
# ACF
require __DIR__ . '/inc/menu-fields.php';

#####
# Classes
require __DIR__ . '/inc/classes/Navigation.php';
require __DIR__ . '/inc/classes/Rest.php';
require __DIR__ . '/inc/classes/VideoHelper.php';
require __DIR__ . '/inc/classes/MailChimp.php';