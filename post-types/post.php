<?php

namespace Sleek\PostTypes;

class Post extends PostType
{
	public function init()
	{
		# Set posts per page count set in archive settings
		add_action('pre_get_posts', function ($query) {
			if (!is_admin() and $query->is_main_query()) {
				if ($query->is_category() || $query->is_home) {
					$postPerPage = get_field('posts_per_page', 'post_settings') ?? 10 ?: 10;
					$query->set('posts_per_page', $postPerPage);

					# TODO: show sticky post at the top of the listing
					$query->set('ignore_sticky_posts', true);
				}
			}
		});

		########
		# Add Post per page field
		add_action('sleek/post_types/archive_fields', function ($fields, $post_type) {
			if ($post_type !== 'post') {
				return $fields;
			}

			$toAppendBetween = [[
				'label' => __('Image (Mobile)', 'sleek_admin'),
				'name' => 'image_mobile',
				'type' => 'image',
				'return_format' => 'id',
			]];
		
			$newFields = sleek_array_insert($fields, 2, $toAppendBetween);
		
			$toAppendAfter = [
				[
					'label' => __('Posts per page', 'sleek_admin'),
					'name' => 'posts_per_page',
					'type' => 'number',
					'default_value' => 12
				],
				[
					'name' => 'no_items_available',
					'label' => __('No items available', 'sleek_admin'),
					'type' => 'textarea',
					'rows' => 4,
					'new_lines' => 'br',
					'default_value' => 'Sorry, nothing was found here.'
				] 				
			];
		
			return sleek_array_insert($newFields, count($newFields), $toAppendAfter);
		}, 10, 2);
	}

	public function config()
	{
		# Rename "Post"
		return [
			'labels' => [
				'name' => __('Blogs', 'sleek'),
				'singular_name' => __('Blog', 'sleek'),
			],
		];
	}

	public function fields () {
		return [
			[
				'name' => 'image',
				'label' => __('Top Image', 'sleek'),
				'type' => 'image',
				'return_format' => 'id',
				'preview_size'	=> 'thumbnail',
				'instructions' => '<em>This will go at the top of the blog right after the title and preamble.</em>'
			],         
		];
	}

	# Non flexible archive modules
	public function sticky_archive_modules()
	{
		#	return ['featured-posts'];
	}

	# Flexible archive modules
	public function flexible_archive_modules()
	{
		return ['hero', 'text-image', 'text-image-animated', 'usp', 'text-editor', 'article-promo', 'logos', 'text-hero', 'team', 'contact-promo', 'anchor-links', 'expertise', 'services'];
	}
}
