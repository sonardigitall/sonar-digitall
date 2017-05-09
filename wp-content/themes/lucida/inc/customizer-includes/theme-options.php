<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Catch Themes
* @subpackage Lucida
* @since Lucida 0.1
*/

$wp_customize->add_panel( 'lucida_theme_options', array(
    'description'    => esc_html__( 'Basic theme Options', 'lucida' ),
    'capability'     => 'edit_theme_options',
    'priority'       => 200,
    'title'    		 => esc_html__( 'Theme Options', 'lucida' ),
) );

// Breadcrumb Option
$wp_customize->add_section( 'lucida_breadcumb_options', array(
	'description'	=> esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'lucida' ),
	'panel'			=> 'lucida_theme_options',
	'title'    		=> esc_html__( 'Breadcrumb Options', 'lucida' ),
	'priority' 		=> 201,
) );

$wp_customize->add_setting( 'lucida_theme_options[breadcumb_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['breadcumb_option'],
	'sanitize_callback' => 'lucida_sanitize_checkbox'
) );

$wp_customize->add_control( 'lucida_theme_options[breadcumb_option]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb', 'lucida' ),
	'section'  => 'lucida_breadcumb_options',
	'settings' => 'lucida_theme_options[breadcumb_option]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'lucida_theme_options[breadcumb_on_homepage]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['breadcumb_on_homepage'],
	'sanitize_callback' => 'lucida_sanitize_checkbox'
) );

$wp_customize->add_control( 'lucida_theme_options[breadcumb_on_homepage]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb on Homepage', 'lucida' ),
	'section'  => 'lucida_breadcumb_options',
	'settings' => 'lucida_theme_options[breadcumb_on_homepage]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'lucida_theme_options[breadcumb_seperator]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['breadcumb_seperator'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'lucida_theme_options[breadcumb_seperator]', array(
	'input_attrs' => array(
    		'style' => 'width: 40px;'
		),
	'label'    	=> esc_html__( 'Separator between Breadcrumbs', 'lucida' ),
	'section' 	=> 'lucida_breadcumb_options',
	'settings' 	=> 'lucida_theme_options[breadcumb_seperator]',
	'type'     	=> 'text'
	)
);
// Breadcrumb Option End

/**
 *  Remove Custom CSS option from WordPress 4.7 onwards
 *  //@remove Remove if block and custom_css when WordPress 5.0 is released
 */
if ( !function_exists( 'wp_update_custom_css_post' ) ) {
	// Custom CSS Option
	$wp_customize->add_section( 'lucida_custom_css', array(
		'description'	=> esc_html__( 'Custom/Inline CSS', 'lucida'),
		'panel'  		=> 'lucida_theme_options',
		'priority' 		=> 203,
		'title'    		=> esc_html__( 'Custom CSS Options', 'lucida' ),
	) );

	$wp_customize->add_setting( 'lucida_theme_options[custom_css]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['custom_css'],
		'sanitize_callback' => 'lucida_sanitize_custom_css',
	) );

	$wp_customize->add_control( 'lucida_theme_options[custom_css]', array(
			'label'		=> esc_html__( 'Enter Custom CSS', 'lucida' ),
	        'priority'	=> 1,
			'section'   => 'lucida_custom_css',
	        'settings'  => 'lucida_theme_options[custom_css]',
			'type'		=> 'textarea',
	) );
	// Custom CSS End
}

// Excerpt Options
$wp_customize->add_section( 'lucida_excerpt_options', array(
	'panel'  	=> 'lucida_theme_options',
	'priority' 	=> 204,
	'title'    	=> esc_html__( 'Excerpt Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[excerpt_length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['excerpt_length'],
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'lucida_theme_options[excerpt_length]', array(
	'description' => __('Excerpt length. Default is 30 words', 'lucida'),
	'input_attrs' => array(
        'min'   => 10,
        'max'   => 200,
        'step'  => 5,
        'style' => 'width: 60px;'
        ),
    'label'    => esc_html__( 'Excerpt Length (words)', 'lucida' ),
	'section'  => 'lucida_excerpt_options',
	'settings' => 'lucida_theme_options[excerpt_length]',
	'type'	   => 'number',
	)
);

$wp_customize->add_setting( 'lucida_theme_options[excerpt_more_text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['excerpt_more_text'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'lucida_theme_options[excerpt_more_text]', array(
	'label'    => esc_html__( 'Read More Text', 'lucida' ),
	'section'  => 'lucida_excerpt_options',
	'settings' => 'lucida_theme_options[excerpt_more_text]',
	'type'	   => 'text',
) );
// Excerpt Options End

// Header Top
$wp_customize->add_section( 'lucida_header_top', array(
	'panel'			=> 'lucida_theme_options',
	'description'	=> esc_html__( 'Header Top Options', 'lucida' ),
	'priority' 		=> 208.5,
	'title'    		=> esc_html__( 'Header Top Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[disable_date]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['disable_date'],
	'sanitize_callback' => 'lucida_sanitize_checkbox',
) );

$wp_customize->add_control( 'lucida_theme_options[disable_date]', array(
	'label'    => esc_html__( 'Check to disable date', 'lucida' ),
	'section'  => 'lucida_header_top',
	'settings' => 'lucida_theme_options[disable_date]',
	'type'	   => 'checkbox',
) );

$wp_customize->add_setting( 'lucida_theme_options[disable_social_icons]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['disable_social_icons'],
	'sanitize_callback' => 'lucida_sanitize_checkbox',
) );

$wp_customize->add_control( 'lucida_theme_options[disable_social_icons]', array(
	'label'    			=> esc_html__( 'Check to disable social icons', 'lucida' ),
	'section'  			=> 'lucida_header_top',
	'settings' 			=> 'lucida_theme_options[disable_social_icons]',
	'type'	   			=> 'checkbox',
) );
// Header Top End

//Homepage / Frontpage Options
$wp_customize->add_section( 'lucida_homepage_options', array(
	'description'	=> esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'lucida' ),
	'panel'			=> 'lucida_theme_options',
	'priority' 		=> 209,
	'title'   	 	=> esc_html__( 'Homepage / Frontpage Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[front_page_category]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['front_page_category'],
	'sanitize_callback'	=> 'lucida_sanitize_category_list',
) );

$wp_customize->add_control( new lucida_customize_dropdown_categories_control( $wp_customize, 'lucida_theme_options[front_page_category]', array(
    'label'   	=> esc_html__( 'Select Categories', 'lucida' ),
    'name'	 	=> 'lucida_theme_options[front_page_category]',
	'priority'	=> '6',
    'section'  	=> 'lucida_homepage_options',
    'settings' 	=> 'lucida_theme_options[front_page_category]',
    'type'     	=> 'dropdown-categories',
) ) );
//Homepage / Frontpage Settings End
//

// Layout Options
$wp_customize->add_section( 'lucida_layout', array(
	'capability'=> 'edit_theme_options',
	'panel'		=> 'lucida_theme_options',
	'priority'	=> 211,
	'title'		=> esc_html__( 'Layout Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[theme_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['theme_layout'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[theme_layout]', array(
	'choices'	=> lucida_layouts(),
	'label'		=> esc_html__( 'Default Layout', 'lucida' ),
	'section'	=> 'lucida_layout',
	'settings'   => 'lucida_theme_options[theme_layout]',
	'type'		=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[content_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['content_layout'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[content_layout]', array(
	'choices'   => lucida_get_archive_content_layout(),
	'label'		=> esc_html__( 'Archive Content Layout', 'lucida' ),
	'section'   => 'lucida_layout',
	'settings'  => 'lucida_theme_options[content_layout]',
	'type'      => 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[single_post_image_layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['single_post_image_layout'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[single_post_image_layout]', array(
		'label'		=> esc_html__( 'Single Page/Post Image Layout ', 'lucida' ),
		'section'   => 'lucida_layout',
        'settings'  => 'lucida_theme_options[single_post_image_layout]',
        'type'	  	=> 'select',
		'choices'  	=> lucida_image_sizes_options(),
) );
	// Layout Options End

// Pagination Options
$pagination_type	= $options['pagination_type'];

$nav_desc = sprintf(
	wp_kses(
		__( '<a target="_blank" href="%1$s">WP-PageNavi Plugin</a> is recommended for Numeric Option(But will work without it).<br/>Infinite Scroll Options requires <a target="_blank" href="%2$s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'lucida' ),
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br'=> array()
		)
	),
	esc_url( 'https://wordpress.org/plugins/wp-pagenavi' ),
	esc_url( 'https://wordpress.org/plugins/jetpack/' )
);

/**
* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
*/
if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) ) {
	if ( ! (class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
		$nav_desc = sprintf(
			wp_kses(
				__( 'Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'lucida' ),
				array(
					'a' => array(
						'href' => array(),
						'target' => array()
					)
				)
			),
			esc_url( 'https://wordpress.org/plugins/jetpack/' )
		);
	}
	else {
		$nav_desc = '';
	}
}

$wp_customize->add_section( 'lucida_pagination_options', array(
	'description'	=> $nav_desc,
	'panel'  		=> 'lucida_theme_options',
	'priority'		=> 212,
	'title'    		=> esc_html__( 'Pagination Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[pagination_type]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['pagination_type'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_control( 'lucida_theme_options[pagination_type]', array(
	'choices'  => lucida_get_pagination_types(),
	'label'    => esc_html__( 'Pagination type', 'lucida' ),
	'section'  => 'lucida_pagination_options',
	'settings' => 'lucida_theme_options[pagination_type]',
	'type'	   => 'select',
) );
// Pagination Options End

//Promotion Headline Options
$wp_customize->add_section( 'lucida_promotion_headline_options', array(
	'description'	=> esc_html__( 'To disable the fields, simply leave them empty.', 'lucida' ),
	'panel'			=> 'lucida_theme_options',
	'priority' 		=> 213,
	'title'   	 	=> esc_html__( 'Promotion Headline Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_headline_option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['promotion_headline_option'],
	'sanitize_callback' => 'lucida_sanitize_select',
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_headline_option]', array(
	'choices'  	=> lucida_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Promotion Headline on', 'lucida' ),
	'priority'	=> '0.5',
	'section'  	=> 'lucida_promotion_headline_options',
	'settings' 	=> 'lucida_theme_options[promotion_headline_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_headline]', array(
	'capability'		=> 'edit_theme_options',
	'default' 			=> $defaults['promotion_headline'],
	'sanitize_callback'	=> 'wp_kses_post'
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_headline]', array(
	'description'	=> esc_html__( 'Appropriate Words: 10', 'lucida' ),
	'label'    	=> esc_html__( 'Promotion Headline Text', 'lucida' ),
	'priority'	=> '1',
	'section' 	=> 'lucida_promotion_headline_options',
	'settings'	=> 'lucida_theme_options[promotion_headline]',
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_subheadline]', array(
	'capability'		=> 'edit_theme_options',
	'default' 			=> $defaults['promotion_subheadline'],
	'sanitize_callback'	=> 'wp_kses_post'
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_subheadline]', array(
	'description'	=> esc_html__( 'Appropriate Words: 15', 'lucida' ),
	'label'    	=> esc_html__( 'Promotion Subheadline Text', 'lucida' ),
	'priority'	=> '2',
	'section' 	=> 'lucida_promotion_headline_options',
	'settings'	=> 'lucida_theme_options[promotion_subheadline]',
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_headline_button]', array(
	'capability'		=> 'edit_theme_options',
	'default' 			=> $defaults['promotion_headline_button'],
	'sanitize_callback'	=> 'sanitize_text_field'
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_headline_button]', array(
	'description'	=> esc_html__( 'Appropriate Words: 3', 'lucida' ),
	'label'    	=> esc_html__( 'Promotion Headline Button Text ', 'lucida' ),
	'priority'	=> '3',
	'section' 	=> 'lucida_promotion_headline_options',
	'settings'	=> 'lucida_theme_options[promotion_headline_button]',
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_headline_url]', array(
	'capability'		=> 'edit_theme_options',
	'default' 			=> $defaults['promotion_headline_url'],
	'sanitize_callback'	=> 'esc_url_raw'
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_headline_url]', array(
	'label'    	=> esc_html__( 'Promotion Headline Link', 'lucida' ),
	'priority'	=> '4',
	'section' 	=> 'lucida_promotion_headline_options',
	'settings'	=> 'lucida_theme_options[promotion_headline_url]',
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_headline_target]', array(
	'capability'		=> 'edit_theme_options',
	'default' 			=> $defaults['promotion_headline_target'],
	'sanitize_callback' => 'lucida_sanitize_checkbox',
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_headline_target]', array(
	'label'    	=> esc_html__( 'Check to Open Link in New Window/Tab', 'lucida' ),
	'priority'	=> '5',
	'section'  	=> 'lucida_promotion_headline_options',
	'settings' 	=> 'lucida_theme_options[promotion_headline_target]',
	'type'     	=> 'checkbox',
) );

$wp_customize->add_setting( 'lucida_theme_options[promotion_headline_left_width]', array(
	'capability'		=> 'edit_theme_options',
	'default' 			=> $defaults['promotion_headline_left_width'],
	'sanitize_callback'	=> 'lucida_sanitize_number_range'
) );

$wp_customize->add_control( 'lucida_theme_options[promotion_headline_left_width]', array(
'type'        	=> 'number',
'priority'   	=> '6',
'section'     	=> 'lucida_promotion_headline_options',
'label'    		=> esc_html__( 'Promotion Headline Left Section Width', 'lucida' ),
'description'	=> esc_html__( 'This is promotion headline left section width. Once this is adjusted, the width for promotion headline right section is set automatically. in %', 'lucida' ),
'input_attrs' => array(
    'min'   => 10,
    'max'   => 100,
    'style' => 'width: 50px;'
    ),
) );
// Promotion Headline Options End

// Scrollup
$wp_customize->add_section( 'lucida_scrollup', array(
	'panel'    => 'lucida_theme_options',
	'priority' => 215,
	'title'    => esc_html__( 'Scrollup Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[disable_scrollup]', array(
	'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['disable_scrollup'],
	'sanitize_callback' => 'lucida_sanitize_checkbox',
) );

$wp_customize->add_control( 'lucida_theme_options[disable_scrollup]', array(
	'label'		=> esc_html__( 'Check to disable Scroll Up', 'lucida' ),
	'section'   => 'lucida_scrollup',
    'settings'  => 'lucida_theme_options[disable_scrollup]',
	'type'		=> 'checkbox',
) );
// Scrollup End

// Search Options
$wp_customize->add_section( 'lucida_search_options', array(
	'description'=> esc_html__( 'Change default placeholder text in Search.', 'lucida'),
	'panel'  => 'lucida_theme_options',
	'priority' => 216,
	'title'    => esc_html__( 'Search Options', 'lucida' ),
) );

$wp_customize->add_setting( 'lucida_theme_options[search_text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['search_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'lucida_theme_options[search_text]', array(
	'label'		=> esc_html__( 'Default Display Text in Search', 'lucida' ),
	'section'   => 'lucida_search_options',
    'settings'  => 'lucida_theme_options[search_text]',
	'type'		=> 'text',
) );
// Search Options End