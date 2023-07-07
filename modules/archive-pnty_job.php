<?php

global $wp_query;

# Header
Sleek\Modules\render('archive-header');

# Listing
Sleek\Modules\render('job-listing', [
	'include_filter' => true,
	'post_type' => Sleek\Utils\get_current_post_type(),
	'wp_query' => $wp_query
]);
