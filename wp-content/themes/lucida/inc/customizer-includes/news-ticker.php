<?php
/**
* The template for adding News Ticker Settings in Customizer
*
* @package Catch Themes
* @subpackage Lucida
* @since Lucida 0.1
*/
// News Ticker Options

$wp_customize->add_section( 'lucida_news_ticker_settings', array(
	'priority' => 400,
	'title'    => esc_html__( 'News Ticker', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[news_ticker_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_option'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[news_ticker_option]', array(
	'choices'  	=> lucida_featured_section_options(),
	'label'    	=> esc_html__( 'Enable News Ticker on', 'lucida' ),
	'priority'	=> '1',
	'section'  	=> 'lucida_news_ticker_settings',
	'settings' 	=> 'lucida_theme_options[news_ticker_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[news_ticker_position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_position'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[news_ticker_position]', array(
	'active_callback' => 'lucida_is_news_ticker_active',
	'choices'         => lucida_news_ticker_positions(),
	'label'           => esc_html__( 'News Ticker Position', 'lucida' ),
	'priority'        => '3',
	'section'         => 'lucida_news_ticker_settings',
	'settings'        => 'lucida_theme_options[news_ticker_position]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[news_ticker_transition_effect]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_transition_effect'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[news_ticker_transition_effect]' , array(
	'active_callback' => 'lucida_is_news_ticker_active',
	'choices'         => lucida_featured_slider_transition_effects(),
	'label'           => esc_html__( 'Transition Effect', 'lucida' ),
	'priority'        => '4',
	'section'         => 'lucida_news_ticker_settings',
	'settings'        => 'lucida_theme_options[news_ticker_transition_effect]',
	'type'            => 'select',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[news_ticker_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_type'],
	'sanitize_callback'	=> 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[news_ticker_type]', array(
	'active_callback'	=> 'lucida_is_news_ticker_active',
	'choices'  	=> lucida_news_ticker_types(),
	'label'    	=> esc_html__( 'Select Ticker Type', 'lucida' ),
	'priority'	=> '3',
	'section'  	=> 'lucida_news_ticker_settings',
	'settings' 	=> 'lucida_theme_options[news_ticker_type]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[news_ticker_label]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_label'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'lucida_theme_options[news_ticker_label]' , array(
	'active_callback'	=> 'lucida_is_demo_news_ticker_inactive',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Headline', 'lucida' ),
	'label'    		=> esc_html__( 'News Ticker Label', 'lucida' ),
	'priority'		=> '4',
	'section'  		=> 'lucida_news_ticker_settings',
	'settings' 		=> 'lucida_theme_options[news_ticker_label]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[news_ticker_number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['news_ticker_number'],
	'sanitize_callback'	=> 'lucida_sanitize_number_range',
) );

$wp_customize->add_control( 'lucida_theme_options[news_ticker_number]' , array(
	'active_callback'	=> 'lucida_is_demo_news_ticker_inactive',
	'description'	=> esc_html__( 'Save and refresh the page if No. of News Ticker is changed (Max no of News Ticker is 20)', 'lucida' ),
	'input_attrs' 	=> array(
        'style' => 'width: 45px;',
        'min'   => 0,
        'max'   => 20,
        'step'  => 1,
    	),
	'label'    		=> esc_html__( 'No of News Ticker', 'lucida' ),
	'priority'		=> '6',
	'section'  		=> 'lucida_news_ticker_settings',
	'settings' 		=> 'lucida_theme_options[news_ticker_number]',
	'type'	   		=> 'number',
	'transport'		=> 'postMessage'
	)
);

for ( $i=1; $i <=  $options['news_ticker_number'] ; $i++ ) {
	$wp_customize->add_setting( 'lucida_theme_options[news_ticker_page_'. $i .']', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'lucida_sanitize_page',
	) );

	$wp_customize->add_control( 'lucida_news_ticker_page_'. $i .'', array(
		'active_callback' => 'lucida_is_page_news_ticker_active',
		'label'           => esc_html__( 'Page', 'lucida' ) . ' ' . $i ,
		'section'         => 'lucida_news_ticker_settings',
		'settings'        => 'lucida_theme_options[news_ticker_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}
// News Ticker Setting End