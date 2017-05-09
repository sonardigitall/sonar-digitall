<?php
/**
* The template for Social Links in Customizer
*
* @package Catch Themes
* @subpackage Lucida
* @since Lucida 0.1
*/

// Social Icons
$wp_customize->add_section( 'lucida_social_links', array(
	'priority'       => 700,
	'title'   	 	=> esc_html__( 'Social Links', 'lucida' ),
) );

$lucida_social_icons 	=	lucida_get_social_icons_list();

foreach ( $lucida_social_icons as $key => $value ){
	if ( 'skype_link' == $key ){
		$wp_customize->add_setting( 'lucida_theme_options['. $key .']', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback' => 'esc_attr',
			) );

		$wp_customize->add_control( 'lucida_theme_options['. $key .']', array(
			'description'	=> esc_html__( 'Skype link can be of formats:<br>callto://+{number}<br> skype:{username}?{action}. More Information in readme file', 'lucida' ),
			'label'    		=> $value['label'],
			'section'  		=> 'lucida_social_links',
			'settings' 		=> 'lucida_theme_options['. $key .']',
			'type'	   		=> 'url',
		) );
	}
	else {
		if ( 'email_link' == $key ){
			$wp_customize->add_setting( 'lucida_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_email',
				) );
		}
		elseif ( 'handset_link' == $key || 'phone_link' == $key ){
			$wp_customize->add_setting( 'lucida_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'sanitize_text_field',
				) );
		}
		else {
			$wp_customize->add_setting( 'lucida_theme_options['. $key .']', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'esc_url_raw',
				) );
		}

		$wp_customize->add_control( 'lucida_theme_options['. $key .']', array(
			'label'    => $value['label'],
			'section'  => 'lucida_social_links',
			'settings' => 'lucida_theme_options['. $key .']',
			'type'	   => 'url',
		) );
	}
}