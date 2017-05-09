<?php
/**
* The template for adding Featured Slider Options in Customizer
*
* @package Catch Themes
* @subpackage Lucida
* @since Lucida 0.1
*/

$wp_customize->add_section( 'lucida_featured_slider', array(
	'priority'      => 500,
	'title'			=> esc_html__( 'Featured Slider', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_option'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_option]', array(
	'choices'   => lucida_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Slider on', 'lucida' ),
	'priority'	=> '2',
	'section'  	=> 'lucida_featured_slider',
	'settings' 	=> 'lucida_theme_options[featured_slider_option]',
	'type'    	=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_transition_effect]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_transition_effect'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_transition_effect]' , array(
	'active_callback' => 'lucida_is_slider_active',
	'choices'         => lucida_featured_slider_transition_effects(),
	'label'           => esc_html__( 'Transition Effect', 'lucida' ),
	'priority'        => '3',
	'section'         => 'lucida_featured_slider',
	'settings'        => 'lucida_theme_options[featured_slider_transition_effect]',
	'type'            => 'select',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_transition_delay]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_transition_delay'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_transition_delay]' , array(
	'active_callback'	=> 'lucida_is_slider_active',
	'description'	=> esc_html__( 'seconds(s)', 'lucida' ),
	'input_attrs' => array(
    	'style' => 'width: 40px;'
	),
	'label'    		=> esc_html__( 'Transition Delay', 'lucida' ),
	'priority'		=> '4',
	'section'  		=> 'lucida_featured_slider',
	'settings' 		=> 'lucida_theme_options[featured_slider_transition_delay]',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_transition_length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_transition_length'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_transition_length]' , array(
	'active_callback'	=> 'lucida_is_slider_active',
	'description'	=> esc_html__( 'seconds(s)', 'lucida' ),
	'input_attrs' => array(
    	'style' => 'width: 40px;'
	),
	'label'    		=> esc_html__( 'Transition Length', 'lucida' ),
	'priority'		=> '5',
	'section'  		=> 'lucida_featured_slider',
	'settings' 		=> 'lucida_theme_options[featured_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_image_loader]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_image_loader'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_image_loader]', array(
	'active_callback' => 'lucida_is_slider_active',
	'choices'         => lucida_featured_slider_image_loader(),
	'label'           => esc_html__( 'Image Loader', 'lucida' ),
	'priority'        => '6',
	'section'         => 'lucida_featured_slider',
	'settings'        => 'lucida_theme_options[featured_slider_image_loader]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_type'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_type]', array(
	'active_callback' => 'lucida_is_slider_active',
	'choices'         => lucida_featured_slider_types(),
	'label'           => esc_html__( 'Select Slider Type', 'lucida' ),
	'priority'        => '7',
	'section'         => 'lucida_featured_slider',
	'settings'        => 'lucida_theme_options[featured_slider_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_number'],
	'sanitize_callback'	=> 'lucida_sanitize_number_range',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_number]' , array(
		'active_callback' => 'lucida_is_demo_slider_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'lucida' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
			'max'   => 20,
			'step'  => 1,
		),
		'label'           => esc_html__( 'No of Slides', 'lucida' ),
		'priority'        => '8',
		'section'         => 'lucida_featured_slider',
		'settings'        => 'lucida_theme_options[featured_slider_number]',
		'type'            => 'number',
		'transport'       => 'postMessage'
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_slider_content_show]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_slider_content_show'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_slider_content_show]', array(
	'active_callback' => 'lucida_is_demo_slider_inactive',
	'choices'         => lucida_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'lucida' ),
	'section'         => 'lucida_featured_slider',
	'settings'        => 'lucida_theme_options[featured_slider_content_show]',
	'type'            => 'select',
) );

//loop for featured page sliders
for ( $i=1; $i <= $options['featured_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'lucida_theme_options[featured_slider_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'lucida_sanitize_page',
	) );

	$wp_customize->add_control( 'lucida_theme_options[featured_slider_page_'. $i .']', array(
		'active_callback' => 'lucida_is_page_slider_active',
		'label'           => esc_html__( 'Featured Page', 'lucida' ) . ' # ' . $i ,
		'priority'        => '11' . $i,
		'section'         => 'lucida_featured_slider',
		'settings'        => 'lucida_theme_options[featured_slider_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}