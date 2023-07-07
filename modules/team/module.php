<?php
# Description: Team Section

namespace Sleek\Modules;

class Team extends Module {
	public function fields () {
		return [
			[
				'name' => 'title',
				'label' => __('Title', 'sleek'),
				'type' => 'text',
			],
			[
				'key'=> '{acf_key}_team_employees',
				'label'=> 'Employees',
				'name'=> 'employees',
				'type'=> 'relationship',
				'instructions'=> '',
				'required'=> 1,
				'conditional_logic'=> 0,
				'post_type'=> [
					'employee'
				],
				'filters' => [
					'search'
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
		$emp_details = $this->getEmployees();
		return [
			'employee_details' => $emp_details
		];
	}

	public function getEmployees()
	{
		$employees = $this->get_field('employees');
		$emp_details = [];
		if ( isset($employees) && !empty($employees) ) {
			foreach ($employees as $emp) {
				if ( isset($emp->ID) && !empty($emp->ID) ) {
				$positionTax 			= get_the_terms($emp->ID,'employee_position');
				$positionName 			= '';
				if ($positionTax && ! is_wp_error( $positionTax )){
					foreach ($positionTax as $value) {
						$positionName = $value->name;
					}
				}
				$temp_emp['image'] 		= get_the_post_thumbnail_url( $emp->ID );
				$temp_emp['name']  		= get_the_title($emp->ID);
				$temp_emp['position'] 	= $positionName;
				$temp_emp['email'] 		= get_post_field('email', $emp->ID);
				$temp_emp['phone'] 		= get_post_field('phone', $emp->ID);
				$temp_emp['url'] 		= get_post_field('url', $emp->ID);
				$emp_details[] 			= $temp_emp;
				}
			}
		}

		return $emp_details;
	}
}