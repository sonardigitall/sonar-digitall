<?php
/**
 * The main template for implementing Theme/Customzer Options
 *
 * @package Catch Themes
 * @subpackage Lucida Pro
 * @since Lucida 1.0
 */


/**
 * Implements Lucida theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Lucida 1.0
 */
function lucida_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = lucida_get_theme_options();

	$defaults = lucida_get_default_theme_options();

	//Custom Controls
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/custom-controls.php';

	// Move title_tagline (added to Site Title and Tagline section in Theme Customizer)
	$wp_customize->add_setting( 'lucida_theme_options[move_title_tagline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'lucida_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'lucida_theme_options[move_title_tagline]', array(
		'label'    => esc_html__( 'Check to move Site Title and Tagline before logo', 'lucida' ),
		'priority' => 103,
		'section'  => 'title_tagline',
		'settings' => 'lucida_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );
	// Custom Logo End

	// Header Options (added to Header section in Theme Customizer)
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/header-options.php';

	$wp_customize->add_setting( 'lucida_theme_options[color_scheme]', array(
		'capability' 		=> 'edit_theme_options',
		'default'    		=> $defaults['color_scheme'],
		'sanitize_callback' => 'lucida_sanitize_select',
	) );

	$wp_customize->add_control( 'lucida_theme_options[color_scheme]', array(
		'choices'  => lucida_color_schemes(),
		'label'    => esc_html__( 'Color Scheme', 'lucida' ),
		'priority' => 1,
		'section'  => 'colors',
		'settings' => 'lucida_theme_options[color_scheme]',
		'type'     => 'radio',
	) );

	//Theme Options
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/theme-options.php';

	//Header Highlight Content
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/header-highlight-content.php';

	//Featured Content Setting
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/featured-content.php';

	//Featured Slider
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/featured-slider.php';

	//News Ticker
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/news-ticker.php';

	//Social Links
	require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/social-icons.php';

	// Reset all settings to default
	$wp_customize->add_section( 'lucida_reset_all_settings', array(
		'description'	=> esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'lucida' ),
		'priority' 		=> 900,
		'title'    		=> esc_html__( 'Reset all settings', 'lucida' ),
	) );

	$wp_customize->add_setting( 'lucida_theme_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'lucida_sanitize_checkbox',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'lucida_theme_options[reset_all_settings]', array(
		'label'    => esc_html__( 'Check to reset all settings to default', 'lucida' ),
		'section'  => 'lucida_reset_all_settings',
		'settings' => 'lucida_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end


	//Important Links
		$wp_customize->add_section( 'important_links', array(
			'priority' 		=> 999,
			'title'   	 	=> esc_html__( 'Important Links', 'lucida' ),
		) );

		/**
		 * Has dummy Sanitizaition function as it contains no value to be sanitized
		 */
		$wp_customize->add_setting( 'important_links', array(
			'sanitize_callback'	=> 'lucida_sanitize_important_link',
		) );

		$wp_customize->add_control( new lucida_Important_Links( $wp_customize, 'important_links', array(
	        'label'   	=> esc_html__( 'Important Links', 'lucida' ),
	         'section'  	=> 'important_links',
	        'settings' 	=> 'important_links',
	        'type'     	=> 'important_links',
	    ) ) );
	    //Important Links End
}
add_action( 'customize_register', 'lucida_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for Lucida.
 * And flushes out all transient data on preview
 *
 * @since Lucida 1.0
 */
function lucida_customize_preview() {
	wp_enqueue_script( 'lucida_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients
	lucida_flush_transients();
}
add_action( 'customize_preview_init', 'lucida_customize_preview' );


/**
 * Custom scripts and styles on customize.php for Lucida.
 *
 * @since Lucida Pro 1.0
 */
function lucida_customize_scripts() {
	wp_enqueue_script( 'lucida_customizer_custom', get_template_directory_uri() . '/js/customizer-custom-scripts.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$lucida_data = array(
		'lucida_color_list' => lucida_color_list(),
		'reset_message'             => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'lucida' )
	);

	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'lucida_customizer_custom', 'lucida_data', $lucida_data );
}
add_action( 'customize_controls_enqueue_scripts', 'lucida_customize_scripts');


/**
 * Returns list of color keys of array with default values for each color scheme as index
 *
 * @since Lucida Pro 1.0
 */
function lucida_color_list() {
	// Get default color scheme values
	$default 		= lucida_get_default_theme_options();
	// Get default dark color scheme valies
	$default_dark 	= lucida_default_dark_color_options();

	$color_list['background_color']['light'] = $default['background_color'];
	$color_list['background_color']['dark']  = $default_dark['background_color'];

	$color_list['header_textcolor']['light'] = $default['header_textcolor'];
	$color_list['header_textcolor']['dark']  = $default_dark['header_textcolor'];

	return $color_list;
}


/**
 * Function to reset date with respect to condition
 *
 * @since Lucida Pro 1.0
 *
 */
function lucida_reset_data() {
	$options  = lucida_get_theme_options();
    if ( $options['reset_all_settings'] ) {
    	remove_theme_mods();

        // Flush out all transients	on reset
        lucida_flush_transients();

        return;
    }
}
add_action( 'customize_save_after', 'lucida_reset_data' );

//Active callbacks for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/active-callbacks.php';

//Sanitize functions for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/sanitize-functions.php';

// Add Upgrade to Pro Button.
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/upgrade-button/class-customize.php';