<?php
# Description: Display contact.

namespace Sleek\Modules;

class ContactPromo extends Module
{
	public function fields()
	{
		return [
			[
				'name' => 'title',
				'label' => __('Title', 'sleek'),
				'type' => 'text',
			],
			[
				'name' => 'preamble',
				'label' => __('Preamble', 'sleek'),
				'type' => 'text',
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
				'key'=> '{acf_key}_cp_employee',
				'label'=> 'Employee',
				'name'=> 'employee',
				'type'=> 'post_object',
				'instructions'=> '',
				'required'=> 1,
				'conditional_logic'=> 0,
				'post_type'=> [
					'employee'
				],
				'taxonomy'=> '',
				'allow_null'=> 0,
				'multiple'=> 0,
				'return_format'=> 'object',
				'ui'=> 1
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
		$emp_details = $this->getEmployee();
		return [
			'employee_details' => $emp_details
		];
	}

	public function getEmployee()
	{
		$employee = $this->get_field('employee');
		$emp_details = [];
		if ( isset($employee) && !empty($employee) ) {
			if ( isset($employee->ID) && !empty($employee->ID) ){
				$emp_details['image'] = get_the_post_thumbnail( $employee->ID );
				$emp_details['email'] = get_post_field('email', $employee->ID);
				$emp_details['phone'] = get_post_field('phone', $employee->ID);
			}
		}

		return $emp_details;
	}
}
