<?php
# Description: Text Hero Section

namespace Sleek\Modules;

class TextHero extends Module {
	public function fields () {
		return [
			[
			'name' => 'title',
			'label' => __('Title', 'sleek_admin'),
			'type' => 'text',
			'wrapper' => ['width' => 50]
			],
			[
				'name' => 'preamble',
				'label' => __('Preamble', 'sleek_admin'),
				'type' => 'textarea',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'image',
				'label' => __('Image (Desktop)', 'sleek'),
				'type' => 'image',
				'instructions' => 'Recommended size: 1920 x 1050px',
				'return_format' => 'ID',
				'preview_size' => 'thumbnail',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'image_mobile',
				'label' => __('Image (Mobile)', 'sleek'),
				'type' => 'image',
				'instructions' => 'Recommended size: 750 x 1200px',
				'return_format' => 'ID',
				'preview_size' => 'thumbnail',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'link',
				'label' => __('CTA', 'sleek_admin'),
				'type' => 'link',
				'return_format' => 'array'

			],
			[
				'name' => 'anchor_id',
				'label' => __('Anchor ID', 'sleek'),
				'instructions' => '<em>This is the target part of the page to scroll when clicked. This will only work if the ID is available on the same page. The ID must have a unique name on the page, avoid generic words like "content", "main", "nav" and try to be more specific e.g. "beyondSectionTeam".</em>',
				'type' => 'text',
			],

		];
	}
	public function data()
	{
		$images = $this->getImages();
		$hasImages = !empty(array_filter($images)) ? 'has-bg-image' : 'bg--dark-teal';

		return [
			'has_content' => !empty($this->get_field('title')) || !empty($this->get_field('preamble')) || !empty($this->get_field('link')),
			'images' => $images,
			'hero_class' => $hasImages
		];
	}


	public function getImages()
	{
		$desktopImageId = $this->get_field('image');
		$mobileImageId = $this->get_field('image_mobile');
		$desktop = $mobile = '';

		if ($desktopImageId) {
			# Get desktop image
			$desktop = wp_get_attachment_image_url($desktopImageId, 'text_hero_dekstop_large', false);

			# Generate mobile version of desktop image; will be use as default if there's no mobile image added
			$mobile = wp_get_attachment_image_url($desktopImageId, 'text_hero_mobile_large', false);
		}

		if ($mobileImageId) {
			# Get mobile image
			$mobile = wp_get_attachment_image_url($mobileImageId, 'text_hero_mobile_large', false);
		}

		return compact('desktop', 'mobile');
	}
}