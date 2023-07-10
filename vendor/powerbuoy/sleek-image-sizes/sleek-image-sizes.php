<?php
namespace Sleek\ImageSizes;

function get_image_sizes ($width, $height) {
	$sizes = [];

	# Both are 9999
	if ($width === 9999 and $height === 9999) {
		$sizes['width25'] = $width;
		$sizes['width50'] = $width;
		$sizes['width75'] = $width;
		$sizes['width100'] = $width;

		$sizes['height25'] = $height;
		$sizes['height50'] = $height;
		$sizes['height75'] = $height;
		$sizes['height100'] = $height;
	}
	# Only width is 9999
	elseif ($width === 9999) {
		$sizes['width25'] = $width;
		$sizes['width50'] = $width;
		$sizes['width75'] = $width;
		$sizes['width100'] = $width;

		$sizes['height25'] = $height * .25;
		$sizes['height50'] = $height * .5;
		$sizes['height75'] = $height * .75;
		$sizes['height100'] = $height;
	}
	# Only height is 9999
	elseif ($height === 9999) {
		$sizes['width25'] = $width * .25;
		$sizes['width50'] = $width * .5;
		$sizes['width75'] = $width * .75;
		$sizes['width100'] = $width;

		$sizes['height25'] = $height;
		$sizes['height50'] = $height;
		$sizes['height75'] = $height;
		$sizes['height100'] = $height;
	}
	# None are 9999
	else {
		$aspectRatio = $width / $height;

		$sizes['width25'] = $width * .25;
		$sizes['width50'] = $width * .5;
		$sizes['width75'] = $width * .75;
		$sizes['width100'] = $width;

		$sizes['height25'] = $sizes['width25'] / $aspectRatio;
		$sizes['height50'] = $sizes['width50'] / $aspectRatio;
		$sizes['height75'] = $sizes['width75'] / $aspectRatio;
		$sizes['height100'] = $height;
	}

	return $sizes;
}

function register ($width, $height, $crop = ['center', 'center'], $additionalSizes = false) {
	$sizes = get_image_sizes($width, $height);

	# Override WP's built-in sizes
	update_option('thumbnail_size_w', $sizes['width25']);
	update_option('thumbnail_size_h', $sizes['height25']);
	update_option('thumbnail_crop', 1);

	update_option('medium_size_w', $sizes['width50']);
	update_option('medium_size_h', $sizes['height50']);
	update_option('medium_crop', 1);

	update_option('medium_large_size_w', $sizes['width75']);
	update_option('medium_large_size_h', $sizes['height75']);
	update_option('medium_large_crop', 1);

	update_option('large_size_w', $sizes['width100']);
	update_option('large_size_h', $sizes['height100']);
	update_option('large_crop', 1);

	# Now set the sizes again so we can specify our own crop (note that if you only use this (and remove the above) users can still change the size in the admin)
	add_image_size('thumbnail', $sizes['width25'], $sizes['height25'], $crop);
	add_image_size('medium', $sizes['width50'], $sizes['height50'], $crop);
	add_image_size('medium_large', $sizes['width75'], $sizes['height75'], $crop);
	add_image_size('large', $sizes['width100'], $sizes['height100'], $crop);

	# Add additional sizes
	if ($additionalSizes) {
		foreach ($additionalSizes as $size => $config) {
			$sizes = get_image_sizes($config['width'], $config['height']);
			$crop = isset($config['crop']) ? $config['crop'] : $crop;

			# Add all 4 size variants for srcset
			add_image_size($size . '_thumbnail', $sizes['width25'], $sizes['height25'], $crop);
			add_image_size($size . '_medium', $sizes['width50'], $sizes['height50'], $crop);
			add_image_size($size . '_medium_large', $sizes['width75'], $sizes['height75'], $crop);
			add_image_size($size . '_large', $sizes['width100'], $sizes['height100'], $crop);
		}

		# Also add our own sizes to the image-size dropdown in the admin
		add_filter('image_size_names_choose', function ($sizes) use ($additionalSizes) {
			$newSizes = [];

			foreach ($additionalSizes as $size => $config) {
				$newSizes[$size . '_thumbnail'] = __(ucfirst(str_replace('_', ' ', $size)), 'sleek') . ' (' . __('Thumbnail') . ')';
				$newSizes[$size . '_medium'] = __(ucfirst(str_replace('_', ' ', $size)), 'sleek') . ' (' . __('Medium') . ')';
				$newSizes[$size . '_medium_large'] = __(ucfirst(str_replace('_', ' ', $size)), 'sleek') . ' (' . __('Medium large') . ')';
				$newSizes[$size . '_large'] = __(ucfirst(str_replace('_', ' ', $size)), 'sleek') . ' (' . __('Large') . ')';
			}

			return array_merge($sizes, $newSizes);
		});
	}
}
