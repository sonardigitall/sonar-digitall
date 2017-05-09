<?php
/**
* The template for adding Header Highlight Content in Customizer
*
* @package Catch Themes
* @subpackage Lucida
* @since Lucida 0.1
*/

$wp_customize->add_section( 'lucida_header_highlight_content', array(
	'priority' => 400,
	'title'    => esc_html__( 'Header Highlight Content', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['header_highlight_content_option'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_option]', array(
	'choices'  	=> lucida_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Header Highlight Content on', 'lucida' ),
	'priority'	=> '1',
	'section'  	=> 'lucida_header_highlight_content',
	'settings' 	=> 'lucida_theme_options[header_highlight_content_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['header_highlight_content_type'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_type]', array(
	'active_callback' => 'lucida_is_header_highlight_content_active',
	'choices'         => lucida_header_highlight_content_types(),
	'label'           => esc_html__( 'Select Content Type', 'lucida' ),
	'priority'        => '3',
	'section'         => 'lucida_header_highlight_content',
	'settings'        => 'lucida_theme_options[header_highlight_content_type]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_headline]', array(
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_headline]' , array(
	'active_callback'	=> 'lucida_is_header_highlight_content_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Headline', 'lucida' ),
	'label'    		=> esc_html__( 'Headline for Header Highlight Content', 'lucida' ),
	'priority'		=> '4',
	'section'  		=> 'lucida_header_highlight_content',
	'settings' 		=> 'lucida_theme_options[header_highlight_content_headline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_subheadline]', array(
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_subheadline]' , array(
	'active_callback'	=> 'lucida_is_header_highlight_content_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Sub-headline', 'lucida' ),
	'label'    		=> esc_html__( 'Sub-headline for Header Highlight Content', 'lucida' ),
	'priority'		=> '5',
	'section'  		=> 'lucida_header_highlight_content',
	'settings' 		=> 'lucida_theme_options[header_highlight_content_subheadline]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_show]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['header_highlight_content_show'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_show]', array(
	'active_callback' => 'lucida_is_demo_header_highlight_content_inactive',
	'choices'         => lucida_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'lucida' ),
	'section'         => 'lucida_header_highlight_content',
	'settings'        => 'lucida_theme_options[header_highlight_content_show]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['header_highlight_content_number'],
	'sanitize_callback'	=> 'lucida_sanitize_number_range',
	'transport'			=> 'postMessage'
) );

$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_number]' , array(
		'active_callback' => 'lucida_is_demo_header_highlight_content_inactive',
		'description'     => esc_html__( 'Save and refresh the page if No. of Header Highlight Content is changed (Max no of Header Highlight Content is 21)', 'lucida' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 1,
			'max'   => 21,
			'step'  => 1,
		),
		'label'           => esc_html__( 'No of Header Highlight Content', 'lucida' ),
		'priority'        => '6',
		'section'         => 'lucida_header_highlight_content',
		'settings'        => 'lucida_theme_options[header_highlight_content_number]',
		'type'            => 'number',
	)
);

//loop for content types
for ( $i=1; $i <=  $options['header_highlight_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'lucida_theme_options[header_highlight_content_page_'. $i .']', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback'	=> 'lucida_sanitize_page',
	) );

	$wp_customize->add_control( 'lucida_theme_options[header_highlight_content_page_'. $i .']', array(
		'active_callback' => 'lucida_is_header_highlight_page_content_active',
		'label'           => esc_html__( 'Page', 'lucida' ) . ' ' . $i ,
		'section'         => 'lucida_header_highlight_content',
		'settings'        => 'lucida_theme_options[header_highlight_content_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}