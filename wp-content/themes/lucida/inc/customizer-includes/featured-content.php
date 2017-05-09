<?php
/**
* The template for adding Featured Content Settings in Customizer
*
* @package Catch Themes
* @subpackage Lucida
* @since Lucida 0.1
*/

$wp_customize->add_section( 'lucida_featured_content', array(
	'priority'      => 400,
	'title'			=> esc_html__( 'Featured Content', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_content_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_option'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_option]', array(
	'choices'  	=> lucida_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Featured Content on', 'lucida' ),
	'section'  	=> 'lucida_featured_content',
	'settings' 	=> 'lucida_theme_options[featured_content_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_content_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_layout'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_layout]', array(
	'active_callback' => 'lucida_is_featured_content_active',
	'choices'         => lucida_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Featured Content Layout', 'lucida' ),
	'section'         => 'lucida_featured_content',
	'settings'        => 'lucida_theme_options[featured_content_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_content_position]', array(
	'capability'        => 'edit_theme_options',
	'default'			=> $defaults['featured_content_position'],
	'sanitize_callback' => 'lucida_sanitize_checkbox'
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_position]', array(
	'active_callback' => 'lucida_is_featured_content_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'lucida' ),
	'section'         => 'lucida_featured_content',
	'settings'        => 'lucida_theme_options[featured_content_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_content_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_type'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_type]', array(
	'active_callback' => 'lucida_is_featured_content_active',
	'choices'         => lucida_featured_content_types(),
	'label'           => esc_html__( 'Select Content Type', 'lucida' ),
	'section'         => 'lucida_featured_content',
	'settings'        => 'lucida_theme_options[featured_content_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[featured_content_headline]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_headline'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_headline]' , array(
	'active_callback'	=> 'lucida_is_featured_content_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Headline', 'lucida' ),
	'label'    		=> esc_html__( 'Headline for Featured Content', 'lucida' ),
	'section'  		=> 'lucida_featured_content',
	'settings' 		=> 'lucida_theme_options[featured_content_headline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_content_subheadline]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_subheadline'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_subheadline]' , array(
	'active_callback'	=> 'lucida_is_featured_content_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Sub-headline', 'lucida' ),
	'label'    		=> esc_html__( 'Sub-headline for Featured Content', 'lucida' ),
	'section'  		=> 'lucida_featured_content',
	'settings' 		=> 'lucida_theme_options[featured_content_subheadline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_content_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_number'],
	'sanitize_callback'	=> 'lucida_sanitize_number_range',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_number]' , array(
		'active_callback' => 'lucida_is_featured_page_content_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'lucida' ),
		'input_attrs'     => array(
			'style' => 'width: 100px;',
			'min'   => 0,
			'max'   => 20,
			'step'  => 1,
		),
		'label'           => esc_html__( 'No of Featured Content', 'lucida' ),
		'section'         => 'lucida_featured_content',
		'settings'        => 'lucida_theme_options[featured_content_number]',
		'type'            => 'number',
		'transport'       => 'postMessage'
	)
);

$wp_customize->add_setting( 'lucida_theme_options[featured_content_show]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['featured_content_show'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[featured_content_show]', array(
	'active_callback' => 'lucida_is_featured_page_content_active',
	'choices'         => lucida_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'lucida' ),
	'section'         => 'lucida_featured_content',
	'settings'        => 'lucida_theme_options[featured_content_show]',
	'type'            => 'select',
) );

//loop for featured post content
for ( $i=1; $i <=  $options['featured_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'lucida_theme_options[featured_content_page_'. $i .']', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'lucida_sanitize_page',
	) );

	$wp_customize->add_control( 'lucida_featured_content_page_'. $i .'', array(
		'active_callback' => 'lucida_is_featured_page_content_active',
		'label'           => esc_html__( 'Featured Page', 'lucida' ) . ' ' . $i ,
		'section'         => 'lucida_featured_content',
		'settings'        => 'lucida_theme_options[featured_content_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}