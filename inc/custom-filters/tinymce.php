<?php
// Register Format dropdown
// add_filter('mce_buttons', function($buttons){
// 	$remove_buttons = array(
//         'alignleft',
//         'aligncenter',
//         'alignright',
//         'dfw', // distraction free writing mode
//         'wp_adv', // kitchen sink toggle (if removed, kitchen sink will always display)
//     );
//     foreach ( $buttons as $button_key => $button_value ) {
//         if ( in_array( $button_value, $remove_buttons ) ) {
//             unset( $buttons[ $button_key ] );
//         }
//     }
//     return $buttons;
// },20);

// add_filter('mce_buttons_2', function ($buttons) {
// 	array_unshift($buttons, 'styleselect');
// 	return $buttons;
// },20);

// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', function($init_array) {
    // Add style format

    $init_array['style_formats_merge'] = false;

	$new_style_formats = apply_filters('sleek/tinymce/formats',array(
		array(
			'title' => 'Preamble',
			'block' => 'p',
			'classes' => 'preamble',
			'wrapper' => false,
		),
		array(
			'title' => 'Small',
			'block' => 'small',
			'classes' => 'small',
			'wrapper' => false,
		),		
	));

	$init_array['style_formats'] = json_encode($new_style_formats);
	
    // Update preamble format style in admin
    $styles = 'p.preamble { font-weight: 400; font-size: 14px; line-height: 1.78571; }';
    if ( isset( $init_array['content_style'] ) ) {
        $init_array['content_style'] .= ' ' . $styles . ' ';
    } else {
        $init_array['content_style'] = $styles . ' ';
	}
	
	// Removed h6 on headings list
	$init_array['block_formats'] = "Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5";

	return $init_array;
},20);
