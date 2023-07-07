<?php
# Description: Hero Section

namespace Sleek\Modules;

use Inc\Classes\VideoHelper;

class Hero extends Module
{

	public function fields()
	{
		return [
			# Content
			[
				'key'	=> '{acf_key}_h_content_tab',
				'label' => __('Content', 'sleek'),
				'type' => 'tab',
				'placement' => 'top'
			],
			[
				'name' => 'title',
				'label' => __('Title', 'sleek'),
				'type' => 'textarea',
				'rows' => 2,
				'new_lines' => 'br',
			],
			[
				'name' => 'preamble',
				'label' => __('Preamble', 'sleek'),
				'type' => 'textarea',
				'rows' => 3,
				'new_lines' => 'br',
			],
			[
				'name' => 'link',
				'label' => __('CTA', 'sleek'),
				'type' => 'link',
				'return_format' => 'array'
			],
			[
				'name' => 'text_color',
				'label' => __('Text Color', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'text--black' => 'Black',
					'text--light-green' => 'Light Green',
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'text--light-green'
			],
			[
				'name' => 'cta_color',
				'label' => __('CTA Color', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'button--primary' => 'Black',
					'button--quarternary' => 'Light Green',
					'button--tersiary' => 'Pink',
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'button--quarternary'
			],
			# Content

			# Media
			[
				'key'	=> '{acf_key}_h_media_tab',
				'label' => __('Media', 'sleek'),
				'type' => 'tab',
				'placement' => 'top'
			],
			[
				'name' => 'image',
				'label' => __('Image (Desktop)', 'sleek'),
				'type' => 'image',
				'instructions' => 'Recommended size: 1920 x 1065px',
				'return_format' => 'ID',
				'preview_size' => 'thumbnail',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'image_mobile',
				'label' => __('Image (Mobile)', 'sleek'),
				'type' => 'image',
				'instructions' => 'Recommended size: 750 x 1500px',
				'return_format' => 'ID',
				'preview_size' => 'thumbnail',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'video',
				'label' => __('Video (Desktop)', 'sleek'),
				'type' => 'url',
				'instructions' => 'This only supports Vimeo PRO video or any direct video links only.',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'video_mobile',
				'label' => __('Video (Mobile)', 'sleek'),
				'type' => 'url',
				'instructions' => 'This only supports Vimeo PRO video or any direct video links only.',
				'wrapper' => ['width' => 50]
			],
			[
				'name' => 'is_autoplay',
				'label' => __('Is Autoplay?', 'sleek'),
				'type' => 'true_false',
				'instructions' => 'Enable this to automatically play the video on page load.'
			],			
			# Content

			# Anchor
			[
				'key'	=> '{acf_key}_h_extra_tab',
				'label' => __('Extras', 'sleek'),
				'type' => 'tab',
				'placement' => 'top'
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
		$hasImages = !empty(array_filter($images));

		return [
			'has_content' => !empty($this->get_field('title')) || !empty($this->get_field('preamble')) || !empty($this->get_field('link')),
			'images' => $images,
			'video_tag' => $this->getVideos($hasImages)
		];
	}


	public function getImages()
	{
		$desktopImageId = $this->get_field('image');
		$mobileImageId = $this->get_field('image_mobile');
		$desktop = $mobile = '';
		$imgAttr = [
			'class'=>'hero-image laptop-only',
			'data-view' => 'desktop'
		];

		$imgAttrMobile = [
			'class'=>'hero-image touch-device-only',
			'data-view' => 'mobile'
		];

		if ($desktopImageId) {
			# Get desktop image
			$desktop = wp_get_attachment_image($desktopImageId, 'hero_desktop_large', false, $imgAttr);

			# Generate mobile version of desktop image; will be use as default if there's no mobile image added
			$mobile = wp_get_attachment_image($desktopImageId, 'hero_mobile_large', false, $imgAttrMobile);
		}

		if ($mobileImageId) {
			# Get mobile image
			$mobile = wp_get_attachment_image($mobileImageId, 'hero_mobile_large', false, $imgAttrMobile);
		}

		return compact('desktop', 'mobile');
	}

	public function isVideoSupported($video_url)
	{
		if (empty($video_url)) return false;

		// Determine video provider through URL
		if (strpos($video_url, "youtube") !== false || strpos($video_url, "youtu.be") !== false) {
			$source = "youtube";
		} elseif (strpos($video_url, "vimeo") !== false) {
			$source = "vimeo";

			if (strpos($video_url, "external") !== false) {
				$source = "vimeo-external";
			}
		} elseif (strpos($video_url, ".mp4") !== false) {
			$source = "mp4";
		} else {
			throw new \Exception("Cannot get video source from URL.");
		}

		$supported_video = ["vimeo-external", "mp4"];

		return in_array($source, $supported_video);
	}

	private function getVideos($hasImages)
	{
		$videoDesktop = $this->get_field('video');
		$videoMobile = $this->get_field('video_mobile');
		$isAutoplay = $this->get_field('is_autoplay');
		$isAutoplayMobile = $this->get_field('is_autoplay');

		$videoAttr = ['data-showonmobile="true"'];

		if ($hasImages) {
			$videoAttr[] =  'style="z-index:-1"';
		}

		// Additional data for multiple videos
		$has_mobile_vid = !empty($videoMobile) && $this->isVideoSupported($videoMobile);

		if ($has_mobile_vid) {
			$videoAttr[] = 'data-desktop=\'' . htmlspecialchars(json_encode(['src' => $videoDesktop, 'autoplay' => $isAutoplay]) . '\'');
			$videoAttr[] = 'data-mobile=\'' . htmlspecialchars(json_encode(['src' => $videoMobile, 'autoplay' => $isAutoplayMobile]) . '\'');
			$videoAttr[] = 'data-multiple="true"';
		}

		$videoTag = null;
		if (!empty($videoDesktop) && $this->isVideoSupported($videoDesktop)) {
			$videoTag = VideoHelper::get_video_tag(
				$videoDesktop,
				true,
				false,
				$isAutoplay,
				$isAutoplay,
				$isAutoplay ? true : false,
				'hero-iframe-video is-yt js-video-iframe',
				$videoAttr
			);
		}

		return $videoTag;
	}
}
