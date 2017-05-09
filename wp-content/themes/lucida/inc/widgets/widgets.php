<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */

/**
 * Register widgetized area
 *
 * @since Lucida 0.1
 */
function lucida_widgets_init() {
	//Primary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'lucida' ),
		'id'            => 'primary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the primary sidebar if you are using a two or three column site layout option.', 'lucida' ),
	) );

	//Secondary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'lucida' ),
		'id'            => 'secondary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the secondary sidebar if you are using a three column site layout option.', 'lucida' ),
	) );

	$footer_sidebar_no = 3; //Number of footer sidebars

	for( $i=1; $i <= $footer_sidebar_no; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Area %d', 'lucida' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'description'	=> sprintf( esc_html__( 'Footer %d widget area.', 'lucida' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'lucida_widgets_init' );

/**
 * Loads up Necessary JS Scripts for widgets
 *
 * @since Lucida 0.1
 */
function lucida_widgets_scripts( $hook) {
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_style( 'lucida-widgets-styles', get_template_directory_uri() . '/css/widgets.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'lucida_widgets_scripts' );

// Load Featured Posts
include get_template_directory() . '/inc/widgets/featured-posts.php';

// Load Instagram Widget
include get_template_directory() . '/inc/widgets/instagram.php';

// Load Social Icon Widget
include get_template_directory() . '/inc/widgets/social-icons.php';