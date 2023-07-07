<?php
add_action('acf/init', function () {

	# Site Settings Page
	acf_add_options_page([
		'page_title' => __('Site Settings', 'sleek'),
		'menu_slug' => 'site_settings',
		'post_id' => 'site_settings'
	]);

	# Settings
	acf_add_local_field_group([
		'key' => 'group_site_settings',
		'title' => __('Site Settings', 'sleek'),
		'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'site_settings']]],
		'menu_order' => 1,
		'style' => 'seamless',
		'fields' => [
			#Translations
			[
				'key' => 'ss_translations',
				'type' => 'tab',
				'label' => __('Translations', 'sleek_admin'),
			],
			[
				'key' => 'ss_translations_general',
				'name' => 'general_translation',
				'label' => __('General', 'sleek_admin'),
				'type' => 'group',
				'layout' => 'row',
				'sub_fields' => [
					[
						'key' => 'ss_translations_general_load_more',
						'name' => 'load_more',
						'label' => __('Load more', 'sleek_admin'),
						'type' => 'text',
						'default_value' => 'Load more'
					],
				],
			],	
			[
				'key' => 'ss_translations_blog_listing',
				'name' => 'blog_listing_translation',
				'label' => __('Blog Listing', 'sleek_admin'),
				'type' => 'group',
				'layout' => 'row',
				'sub_fields' => [
					[
						'key' => 'ss_translations_blog_listing_all_categories',
						'label' => __('All categories', 'sleek_admin'),
						'name' => 'all_categories',
						'type' => 'text',
						'default_value' => 'All categories'
					]
				],
			],					
			[
				'key' => 'ss_translations_job_listing',
				'name' => 'job_listing_translation',
				'label' => __('Job Listing', 'sleek_admin'),
				'type' => 'group',
				'layout' => 'row',
				'sub_fields' => [
					[
						'key' => 'ss_translations_job_listing_all_categories',
						'label' => __('All categories', 'sleek_admin'),
						'name' => 'all_categories',
						'type' => 'text',
						'default_value' => 'All categories'
					],  
					[
						'key' => 'ss_translations_job_listing_all_locations',
						'label' => __('All locations', 'sleek_admin'),
						'name' => 'all_locations',
						'type' => 'text',
						'default_value' => 'All locations'
					],   
					[
						'key' => 'ss_translations_job_listing_job_count',
						'label' => __('Job count text', 'sleek_admin'),
						'name' => 'job_count_text',
						'type' => 'text',
						'default_value' => 'Showing [current_jobs] of [total_jobs] job posts',
						'instructions' => 'You can use <strong><em>[current_jobs]</em></strong> and <strong><em>[total_jobs]</em></strong> shortcodes to display the current job count displayed and the total nunmber of jobs available.'
					], 
				],
			],						
			[
				'key' => 'ss_translations_selected_job',
				'name' => 'selected_job_translation',
				'label' => __('Selected Job', 'sleek_admin'),
				'type' => 'group',
				'layout' => 'row',
				'sub_fields' => [
					[
						'key' => 'ss_translations_selected_job_open',
						'name' => 'open_for_application',
						'label' => __('Open for application', 'sleek_admin'),
						'type' => 'text',
						'default_value' => 'This job is open for applications'
					],
				],
			],

			# Footer
			[
				'key' => 'ss_footer_modules_tab',
				'label' => __('Footer', 'sleek'),
				'type' => 'tab',
			],
			[
				'key' => 'ss_footer_message',
				'label' => '',
				'type' => 'message',
				'message' => '<em>The following links are where you can update other footer content</em>
				<ul>
					<li><strong>Awards images</strong> - <a href="' . get_admin_url(null, 'admin.php?page=global_settings') . '">Global Settings > General > Awards Gallery</a></li>
					<li><strong>Copyright</strong> - <a href="' . get_admin_url(null, 'admin.php?page=global_settings') . '">Global Settings > General > Copyright</a></li>
				</ul>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			],
			[
				'key' => 'ss_footer_bottom_cta',
				'name' => 'footer_bottom_cta',
				'label' => __('Contacts CTA', 'sleek_admin'),
				'type' => 'link',
				'return_value' => 'array',
				'instructions' => '<em>This CTA is displayed at the bottom of the Site Contacts module.</em>'
			],
			[
				'key' => 'footer_columns',
				'name' => 'footer_columns',
				'type' => 'flexible_content',
				'label' => __('Footer Columns', 'sleek'),
				'button_label' => __('Add a column', 'sleek'),
				'max' => 4,
				'layouts' => Sleek\Acf\generate_keys(
					Sleek\Modules\get_module_fields([
						'menu', 'site-offices', 'site-contacts',
					], 'flexible'),
					'footer_modules'
				)
			],
			[
				'key' => 'ss_footer_bottom_links',
				'name' => 'footer_bottom_links',
				'label' => __('Footer bottom links', 'sleek_admin'),
				'type' => 'repeater',
				'layout' => 'table',
				'max' => 2,
				'sub_fields' => [
					[
						'key' => 'ss_footer_bottom_links_link',
						'name' => 'link',
						'label' => __('Link', 'sleek_admin'),
						'type' => 'link',
						'required' => true
					]
				]
			],
			# Footer

			# Cookie consent
			[
				'key' => 'ss_cookie_consent_tab',
				'label' => __('Cookie Consent', 'sleek'),
				'type' => 'tab'
			],
			[
				'key' => 'ss_cookie_consent',
				'name' => 'cookie_consent',
				'type' => 'wysiwyg',
				'label' => __('Cookie Consent', 'sleek'),
				'toolbar' => 'simple',
				'media_upload' => false
			],
			[
				'key' => 'ss_cookie_consent_button',
				'name' => 'cookie_btn_text',
				'type' => 'text',
				'label' => __('Cookie button text', 'sleek'),
				'default_value' => __('OK! I accept', 'sleek'),
			],
			
			#Page Section Settings
			[
				'key' => 'ss_page_section_settings_tab',
				'label' => __('Page Section Settings', 'sleek'),
				'type' => 'tab'
			],
			[
				'key' => 'ss_page_section_settings',
				'label' => __('404 Page', 'sleek'),
				'name' => 'settings_404_page',
				'type' => 'post_object',
				'instructions' => 'The sections of the selected page will be shown in 404 page.',
				'post_type' => ['page'],
				'allow_null' => true,
				'return_format' => 'id',
			],

			#Newsletter
			[
				'key' => 'ss_newsletter_tab',
				'label' => __('Newsletter', 'sleek'),
				'type' => 'tab'
			],
			[
				'key' => 'ss_newsletter_content',
				'name' => 'nl_content',
				'label' => __('Newsletter Content', 'sleek_admin'),
				'type' => 'group',
				'layout' => 'row',
				'sub_fields' => [
					[
						'key' => 'ss_newsletter_title',
						'label' => __('Title', 'sleek_admin'),
						'name' => 'nl_title',
						'type' => 'text',
					],
					[
						'key' => 'ss_newsletter_terms',
						'label' => __('Accept Terms', 'sleek_admin'),
						'name' => 'accept_terms',
						'type' => 'text',
					],
					[
						'key' => 'ss_newsletter_btn',
						'label' => __('Button Title', 'sleek_admin'),
						'name' => 'btn_title',
						'type' => 'text',
					],
					[
						'key' => 'ss_newsletter_success',
						'name' => 'nl_success_message',
						'type' => 'text',
						'label' => __('Success Message', 'sleek'),
						'default_value' => __('Success', 'sleek'),
					],
					[
						'key' => 'ss_newsletter_error',
						'name' => 'nl_error_message',
						'type' => 'text',
						'label' => __('Error Message', 'sleek'),
						'default_value' => __('Error', 'sleek'),
					],
					[
						'key' => 'ss_newsletter_error_name',
						'name' => 'nl_error_message_name',
						'type' => 'text',
						'label' => __('Error Message Name', 'sleek'),
						'default_value' => __('Error Name', 'sleek'),
					],
					[
						'key' => 'ss_newsletter_error_email',
						'name' => 'nl_error_message_email',
						'type' => 'text',
						'label' => __('Error Message Email', 'sleek'),
						'default_value' => __('Error Email', 'sleek'),
					],
					[
						'key' => 'ss_newsletter_error_terms',
						'name' => 'nl_error_message_terms',
						'type' => 'text',
						'label' => __('Error Message Term', 'sleek'),
						'default_value' => __('Error Terms', 'sleek'),
					],
				],
			],
			
			#Mailchimp
			[
				'key' => 'ss_mailchimp_tab',
				'label' => __('Mailchimp', 'sleek'),
				'type' => 'tab'
			],
			[
				'key' => 'ss_mailchimp_title',
				'label' => __('Email list ID', 'sleek_admin'),
				'name' => 'mc_email_list_id',
				'type' => 'text',
			],
		]
	]);


	# Make site settings translatable
	add_filter('acf/validate_post_id', function ($postId) {
		if ($postId == 'site_settings') {
			$dl = acf_get_setting('default_language');
			$cl = acf_get_setting('current_language');

			if ($cl and $cl !== $dl) {
				$postId .= '_' . $cl;
			}
		}

		return $postId;
	});
});

########
# Cookie Consent
add_filter('sleek/notices/cookie_consent', function ($consent) {
	$text = get_field('cookie_consent', 'site_settings');
	$btn = get_field('cookie_btn_text', 'site_settings');

	$html = <<<HTML
	<div class="cookie-bar bg--light-blue">
		<div class="small">$text</div>
		<a class="button button--primary close">$btn</a>
	</div>
HTML;

	# Remove new line in the markup to avoid breaking the rendering of cookie consent 
	return str_replace(array("\n", "\r"), '', $html);
});
