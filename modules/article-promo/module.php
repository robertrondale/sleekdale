<?php
# Description: Display articles.

namespace Sleek\Modules;

class ArticlePromo extends Module
{
	public function fields()
	{
		return [
			# Settings
			[
				'key'	=> '{acf_key}_ap_settings_tab',
				'label' => __('Settings & Header', 'sleek'),
				'type' => 'tab',
				'placement' => 'top'
			],
			[
				'name' => 'title',
				'label' => __('Title', 'sleek'),
				'type' => 'text',
			],
			[
				'name' => 'preamble',
				'label' => __('Preamble', 'sleek'),
				'type' => 'textarea',
				'rows' => 4,
				'new_lines' => 'br',
			],
			[
				'name' => 'bg_color',
				'label' => __('Background Color', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'bg--dark-teal' => 'Dark Teal',
					'bg--off-white' => 'White'
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'bg--dark-teal'
			],
			[
				'name' => 'layout',
				'label' => __('Layout', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'listing' => 'Listing',
					'slider' => 'Slider'
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'slider'
			],
			[
				'name' => 'image_ratio',
				'label' => __('Image Ratio', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'landscape' => 'Landscape',
					'portrait' => 'Portrait',
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'portrait'
			],
			# Settings

			# Content
			[
				'key'	=> '{acf_key}_ap_content_tab',
				'label' => __('Content', 'sleek'),
				'type' => 'tab',
				'placement' => 'top'
			],
			[
				'key'	=> '{acf_key}_ap_section_displays',
				'name' => 'section_displays',
				'label' => __('Section displays', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'category' => 'Articles from a category',
					'handpicked' => 'Handpicked articles',
					'custom_promo' => 'Custom Promo'
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'category'
			],
			[
				'name' => 'handpicked',
				'label' => __('Select Articles', 'sleek_admin'),
				'type' => 'relationship',
				'conditional_logic' => [
					[
						[
							'field' => '{acf_key}_ap_section_displays',
							'operator' => '==',
							'value' => 'handpicked'
						]
					]
				],
				'post_type' => [
					'post'
				],
				'filters' => [
					'search',
				],
				'return_format' => 'id',
			],
			[
				'name' => 'category',
				'label' => __('Category', 'sleek'),
				'type' => 'taxonomy',
				'conditional_logic' => [
					[
						[
							'field' => '{acf_key}_ap_section_displays',
							'operator' => '==',
							'value' => 'category'
						]
					]
				],
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 1,
				'return_format' => 'id',
			],
			[
				'name' => 'sort_type',
				'label' => __('Sort type', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'latest' => 'Latest',
					'random' => 'Random'
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'latest',
				'conditional_logic' => [
					[
						[
							'field' => '{acf_key}_ap_section_displays',
							'operator' => '==',
							'value' => 'category'
						]
					]
				],
			],
			[
				'name' => 'custom_promo',
				'label' => __('Items', 'sleek'),
				'type' => 'repeater',
				'instructions' => 'Add up to 3 items to display in this section.',
				'max' => 3,
				'layout' => 'row',
				'sub_fields' => [
					[
						'name' => 'post',
						'label' => __('Article', 'sleek'),
						'type' => 'post_object',
						'instructions' => 'If the fields below do not have values, the card will display data from the selected Article',
						'post_type' => [
							'post',
						],
						'allow_null' => 1,
						'return_format' => 'ID',
						'ui' => 1
					],
					[
						'name' => 'pre_header',
						'label' => __('Pre-header', 'sleek'),
						'type' => 'text',
					],
					[
						'name' => 'title',
						'label' => __('Title', 'sleek'),
						'type' => 'text',
					],
					[
						'name' => 'link',
						'label' => __('Link', 'sleek'),
						'type' => 'link',
						'return_format' => 'array'
					],
					[
						'name' => 'image',
						'label' => __('Image', 'sleek'),
						'type' => 'image',
						'return_format' => 'ID',
						'preview_size' => 'thumbnail',
						'instructions' => 'Recommended sizes: <br><strong>Landscape - </strong>750 x 498px<br/><strong>Portrait - </strong>750 x 995px'
					]
				],
				'conditional_logic' => [
					[
						[
							'field' => '{acf_key}_ap_section_displays',
							'operator' => '==',
							'value' => 'custom_promo'
						]
					]
				],
			],
			[
				'name' => 'count',
				'label' => __('Number of articles to display', 'sleek'),
				'type' => 'number',
				'instructions' => 'If no value, the section will display all articles.',
				'conditional_logic' => [
					[
						[
							'field' => '{acf_key}_ap_section_displays',
							'operator' => '==',
							'value' => 'category'
						]
					]
				],
			]
			# Content
		];
	}

	public function data()
	{
		$articles = $this->getArticles();
		return [
			'articles' => $articles
		];
	}

	public function getArticles()
	{
		$articles = [];
		$imageSize = $this->get_field('image_ratio') === 'landscape' ? 'article_promo_landscape_medium_large' : 'article_promo_portrait_medium_large';

		switch ($this->get_field('section_displays')) {
			case 'handpicked':
				# get handpicked articles from module
				$articleIds = $this->get_field('handpicked');

				# format data so that each id will be assigned to post
				$tempData = array_map(function ($id) {
					return ['post' => $id];
				}, $articleIds);

				# get post module data
				$articles = $this->getPromoData($tempData, $imageSize);
				break;

			case 'category':
				$args = ['fields' => 'ids'];

				# category
				if ($category = $this->get_field('category')) {
					$args['tax_query'] = [[
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $category,
					]];
				}

				# sort
				if ('random' == $this->get_field('sort_type')) {
					$args['orderby'] = 'rand';
				}

				# count limit
				if ($count = $this->get_field('count')) {
					$args['posts_per_page'] = $count;
				}

				#Exclude post id for blog
				$exclude = $this->get_field('exclude');
				if(isset($exclude) && !empty($exclude)){
					$args['post__not_in'] =  [$exclude];
				}

				# get post based on criteria set on the section
				$articleIds = sleek_get_posts('post', $args);
				
				if (empty($articleIds)){
					return [];
				} else {
					# format data so that each id will be assigned to post
					$tempData = array_map(function ($id) {
						return ['post' => $id];
					}, $articleIds);

					# get post module data
					$articles = $this->getPromoData($tempData, $imageSize);
					break;
				}

			default:
				# get post module data
				$articles = $this->getPromoData($this->get_field('custom_promo'), $imageSize);
				break;
		}

		return $articles;
	}

	private function getPromoData($data, $imageSize = 'article_promo_portrait_large')
	{
		$items = [];

		if (empty($data)) {
			return $items;
		}

		$imageAttr = ['class' => 'lazy'];

		foreach ($data as $item) {
			$item = (object) $item;

			$postImage = null;
			$postTitle = null;
			$postPreHeader = null;
			$postLink = (object)[
				'url' => null,
				'title' => '',
				'target' => '',
			];

			# get post data
			if ($item->post) {
				$img = get_post_field('image', $item->post);
				$postImage = has_post_thumbnail($item->post) ? get_the_post_thumbnail($item->post, $imageSize, false, $imageAttr) : wp_get_attachment_image($img, $imageSize, false, $imageAttr);
				$postTitle = get_the_title($item->post);
				$postLink->url = get_permalink($item->post);
				$postPreHeader = sleek_get_post_main_category($item->post, 'category', 'name');
			}

			$itemLink = !empty($item->link ?? '') ? (object) $item->link : $postLink;

			# override post data with section data
			$newItem = [
				'pre_header' => !empty($item->pre_header ?? '') ? $item->pre_header : $postPreHeader,
				'image' 	 => !empty($item->image ?? '') ? wp_get_attachment_image($item->image, $imageSize, false, $imageAttr) : $postImage,
				'title' 	 => !empty($item->title ?? '') ? $item->title : $postTitle,
				'link' 		 => $itemLink,
			];

			if (empty(array_filter($newItem))) {
				continue;
			}

			array_push($items, (object) $newItem);
		}

		return $items;
	}
}
