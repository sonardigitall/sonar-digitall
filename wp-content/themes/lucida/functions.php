<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core lucida-core and provides some helper functions using lucida-custon-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */

//define theme version
if ( !defined( 'LUCIDA_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();

	define ( 'LUCIDA_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require trailingslashit( get_template_directory() ) . 'inc/core.php';