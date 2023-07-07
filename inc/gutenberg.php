<?php
# Disable CSS
add_action('wp_enqueue_scripts', function () {
	wp_dequeue_style('wp-block-library');
});

# Disable custom colors
add_theme_support('disable-custom-colors'); # NOTE: This doesn't seem to work??
add_theme_support('editor-color-palette', []); # This clears the colors at least, but the "Color"-dropdown remains (also it doesn't affect the table colors for some reason...)

# Disable patterns
remove_theme_support('core-block-patterns');

# Only allow certain blocks
add_filter('allowed_block_types', function ($blocks) {
	return [
		# Common
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/gallery',
		'core/list',
		'core/quote',
	#	'core/audio',
	#	'core/cover',
	#	'core/file',
		'core/video',

		# Formatting
		'core/code',
	#	'core/freeform',
	#	'core/html',
	#	'core/preformatted',
	#	'core/pullquote',
		'core/table',
	#	'core/verse',

		# Layout
		'core/buttons',
	#	'core/columns',
	#	'core/nextpage',
	#	'core/separator',
	#	'core/spacer',
	#	'core/media-text',

		# Widgets
		'core/shortcode',
	#	'core/archives',
	#	'core/calendar',
	#	'core/categories',
	#	'core/latest-comments',
	#	'core/latest-posts',
	#	'core/rss',
	#	'core/search',
	#	'core/social-icons',
	#	'core/tag-cloud',

		# Embeds
		'core/embed',
		'core-embed/twitter',
		'core-embed/youtube',
		'core-embed/facebook',
		'core-embed/instagram',
		'core-embed/wordpress',
		'core-embed/soundcloud',
		'core-embed/spotify',
		'core-embed/flickr',
		'core-embed/vimeo',
		'core-embed/animoto',
		'core-embed/cloudup',
		'core-embed/collegehumor',
		'core-embed/dailymotion',
		'core-embed/funnyordie',
		'core-embed/hulu',
		'core-embed/imgur',
		'core-embed/issuu',
		'core-embed/kickstarter',
		'core-embed/meetup-com',
		'core-embed/mixcloud',
		'core-embed/photobucket',
		'core-embed/polldaddy',
		'core-embed/reddit',
		'core-embed/reverbnation',
		'core-embed/screencast',
		'core-embed/scribd',
		'core-embed/slideshare',
		'core-embed/smugmug',
		'core-embed/speaker',
		'core-embed/ted',
		'core-embed/tumblr',
		'core-embed/videopress',
		'core-embed/wordpress-tv',

		# Our own (NOTE: So annoying we have to add these manually here...)
		// 'acf/featured-post',
		// 'acf/featured-employee'
	];
});

# Exclude certain blocks instead of specifying all allowed (NOTE: Could really use disallowed_block_types here...)
// add_action('admin_init', function () {
// 	add_filter('allowed_block_types', function ($blocks) {
// 		$unsupported = [
// 			'core/audio',
// 			'core/cover',
// 			'core/file',
// 			'core/freeform',
// 			'core/html',
// 			'core/preformatted',
// 			'core/pullquote',
// 			'core/verse',
// 			'core/columns',
// 			'core/nextpage',
// 			'core/separator',
// 			'core/spacer',
// 			'core/media-text',
// 			'core/archives',
// 			'core/calendar',
// 			'core/categories',
// 			'core/latest-comments',
// 			'core/latest-posts',
// 			'core/rss',
// 			'core/search',
// 			'core/social-icons',
// 			'core/tag-cloud',
// 		];
//
// 		$all = array_values(array_map(function ($block) {
// 			return $block->name;
// 		}, \WP_Block_Type_Registry::get_instance()->get_all_registered()));
//
// 		\Sleek\Utils\console_log($all);
// 		\Sleek\Utils\console_log($unsupported);
// 		\Sleek\Utils\console_log(array_values(array_diff($all, $unsupported)));
//
// 		return array_values(array_diff($all, $unsupported));
// 	});
// }, 999);
