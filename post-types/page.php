<?php

namespace Sleek\PostTypes;

class Page extends PostType
{
	# init() runs once every page load
	public function init()
	{
	}

	# Sidebar/meta acf-fields for this post-type
	public function fields()
	{
		return [];
	}

	# Non flexible modules
	public function sticky_modules()
	{
		#	return ['hero'];
	}

	# Flexible modules
	public function flexible_modules()
	{
		return ['hero', 'text-image', 'text-image-animated', 'usp', 'text-editor', 'article-promo', 'logos', 'text-hero', 'team', 'contact-promo',  'job-listing', 'anchor-links', 'expertise', 'services', 'newsletter'];
	}
}
