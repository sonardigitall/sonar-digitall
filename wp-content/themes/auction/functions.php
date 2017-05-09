<?php
/**
 * Loads the child theme textdomain.
 */
function auction__child_theme_setup() {
    load_child_theme_textdomain( 'auction');
}
add_action( 'after_setup_theme', 'auction__child_theme_setup' );

function auction_child_enqueue_styles() {
    $parent_style = 'auction-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'auction-style',get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'auction_child_enqueue_styles',99);
