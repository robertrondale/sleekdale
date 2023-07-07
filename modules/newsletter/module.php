<?php
# Description: Display Newsletter

namespace Sleek\Modules;

class Newsletter extends Module {
	public function fields () {
		return [
			[
				'key'	=> 'nl_override_settings',
				'name' => 'override_nl',
				'label' => __('Override sitewide content', 'sleek'),
				'type' => 'true_false',
				'instructions' => '<em>Enable to display this content instead of the default Newsletter content from Site Settings.</em>',
				'layout' => 'horizontal',
			],

			[
				'name' => 'title',
				'label' => __('Title', 'sleek_admin'),
				'type' => 'text',
				'conditional_logic' => [
					[[
						'field' => 'nl_override_settings',
						'operator' => '==',
						'value' => '1'
					]]
				]   
			],
		];
	}

	public function data()
	{
		$nl_data = $this->getNewsletterData();
		return [
			'newsletter_data' => $nl_data
		];
	}

	public function getNewsletterData()
	{
		$newsletter_data = [];

		$overrideNl = $this->get_field('override_nl');
		$ss_nl_data = get_field('nl_content', 'site_settings');

		if ($overrideNl) {
			$newsletter_data['title'] = $this->get_field('title');
		} else {
			$newsletter_data['title'] = $ss_nl_data['nl_title'] ?? '';
		}

		$newsletter_data['accept_terms'] 		= !empty($ss_nl_data['accept_terms']) ? $ss_nl_data['accept_terms'] : 'I agree to the Privacy Policy, read more here.';
		$newsletter_data['btn_title'] 			= !empty($ss_nl_data['btn_title']) ? $ss_nl_data['btn_title'] : 'SIGN ME UP';
		$newsletter_data['success'] 			= !empty($ss_nl_data['nl_success_message']) ? $ss_nl_data['nl_success_message'] :'Success';
		$newsletter_data['error'] 				= !empty($ss_nl_data['nl_error_message']) ? $ss_nl_data['nl_error_message'] : 'Error needs to be corrected';
		$newsletter_data['error_name'] 			= !empty($ss_nl_data['nl_error_message_name']) ? $ss_nl_data['nl_error_message_name'] : 'Error Name needs to be corrected';
		$newsletter_data['error_email'] 		= !empty($ss_nl_data['nl_error_message_email']) ? $ss_nl_data['nl_error_message_email'] : 'Error Email needs to be corrected';
		$newsletter_data['error_terms'] 		= !empty($ss_nl_data['nl_error_message_terms']) ? $ss_nl_data['nl_error_message_terms'] : 'Error Terms needs to be corrected';

		return $newsletter_data;
 	}

}