<?php
# Description: Job Listing Section

namespace Sleek\Modules;

class JobListing extends Module
{
	public function fields()
	{
		$companies = pnty_get_distinct_post_meta(null, '_pnty_organization_name');

		return [
			[
				'name' => 'post_type',
				'label' => __('Job type', 'sleek'),
				'type' => 'radio',
				'choices' => [
					'pnty_job' => 'Open Jobs',
					'pnty_job_showcase' => 'Terminated Jobs',
				],
				'layout' => 'horizontal',
				'return_format' => 'id',
				'default_value' => 'pnty_job'
			],
			[
				'name' => 'tag',
				'label' => __('Tag', 'sleek'),
				'type' => 'taxonomy',
				'taxonomy' => 'pnty_job_tag',
				'field_type' => 'select',
				'allow_null' => 1,
				'return_format' => 'id',
			],
			[
				'name' => 'company',
				'label' => __('Company', 'sleek'),
				'type' => 'select',
				'choices' => $companies,
				'return_format' => 'label',
				'allow_null' => 1,
				'default_value' => '',
				'ui' => 1,
				'ajax' => 1,
			],
		];
	}

	public function data()
	{
		return [
			'wp_query' => $this->getWPQueryData()
		];
	}

	public function getWPQueryData()
	{
		$post_type = $this->get_field('post_type');
		$count = get_field('posts_per_page', $post_type . '_settings') ?? 10 ?: 10;

		$args = array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => $count,
		);

		# tag
		if ($tag = $this->get_field('tag')) {
			$args['tax_query'] = [[
				'taxonomy' => 'pnty_job_tag',
				'field' => 'term_id',
				'terms' => $tag,
			]];
		}

        # company
        if ($company = $this->get_field('company')) {
            $args['meta_query'] = [[
                'key' => '_pnty_organization_name',
                'value' => $company,
                'compare' => '='
			]];
        }		

		return new \WP_Query($args);
	}
}
