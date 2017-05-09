<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( ! function_exists( 'lucida_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'lucida_doctype', 'lucida_doctype', 10 );


if ( ! function_exists( 'lucida_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
endif;
add_action( 'lucida_before_wp_head', 'lucida_head', 10 );


if ( ! function_exists( 'lucida_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}
endif;
add_action( 'lucida_header', 'lucida_page_start', 10 );


if ( ! function_exists( 'lucida_header_top' ) ) :
	/**
	 * Header Top Area
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_header_top() {
		$options      = lucida_get_theme_options();
		$social_icons = lucida_get_social_icons();

		if ( $options['disable_date'] && ( $options['disable_social_icons'] || '' == $social_icons )  && !has_nav_menu( 'header-top' ) ) {
			//Bail if all date, social links and header-top menu is disabled
			return;
		}

		?>
		<div id="header-top" class="header-top-bar">
		    <div class="wrapper">
		        <?php
			        if ( '' == $options['disable_date'] ) {
			        	lucida_date();
			        }

			        lucida_header_top_menu();
		        ?>
		    </div><!-- .wrapper -->
		</div><!-- #header-top -->
	    <?php
	}
endif;
add_action( 'lucida_header', 'lucida_header_top', 20 );


if ( ! function_exists( 'lucida_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'lucida_footer', 'lucida_page_end', 80 );


if ( ! function_exists( 'lucida_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_header_start() {
		?>
		<header id="masthead" role="banner">
    		<div class="wrapper">
		<?php
	}
endif;
add_action( 'lucida_header', 'lucida_header_start', 40 );


if ( ! function_exists( 'lucida_after_primary' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_after_primary() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'lucida_header', 'lucida_after_primary', 100 );


if ( ! function_exists( 'lucida_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
	<?php
	}
endif;
add_action('lucida_content', 'lucida_content_start', 30 );


if ( ! function_exists( 'lucida_primary_start' ) ) :
	/**
	 * Start div id #primary
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_primary_start() {
		?>
		<div id="primary" class="content-area">
		<?php
	}
endif;
add_action( 'lucida_content', 'lucida_primary_start', 40 );


if ( ! function_exists( 'lucida_main_start' ) ) :
	/**
	 * Start main #main
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_main_start() {
		?>
		<main id="main" class="site-main" role="main">
		<?php
	}
endif;
add_action( 'lucida_content', 'lucida_main_start', 50 );


if ( ! function_exists( 'lucida_main_end' ) ) :
	/**
	 * End main #main
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_main_end() {
		?>
		</main><!-- #main -->
		<?php
	}
endif;
add_action( 'lucida_before_secondary', 'lucida_main_end', 20 );


if ( ! function_exists( 'lucida_sidebar_secondary' ) ) :
	/**
	 * Secondary Sidebar
	 *
	 * @since Catch Magazine 1.0
	 */
	function lucida_sidebar_secondary() {
		get_sidebar( 'secondary' );
	}
endif;
add_action( 'lucida_before_secondary', 'lucida_sidebar_secondary', 25 );


if ( ! function_exists( 'lucida_primary_end' ) ) :
	/**
	 * End div id #primary
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_primary_end() {
		?>
		</div><!-- #primary -->
		<?php
	}
endif;
add_action( 'lucida_before_secondary', 'lucida_primary_end', 30 );


if ( ! function_exists( 'lucida_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since Lucida 0.1
	 */
	function lucida_content_end() {
		?>
			</div><!-- .wrapper -->
	    </div><!-- #content -->
		<?php
	}

endif;
add_action( 'lucida_after_content', 'lucida_content_end', 10 );


if ( ! function_exists( 'lucida_footer_content_start' ) ) :
/**
 * Start footer id #colophon
 *
 * @since Lucida 0.1
 */
function lucida_footer_content_start() {
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php
}
endif;
add_action('lucida_footer', 'lucida_footer_content_start', 10 );


if ( ! function_exists( 'lucida_footer_sidebar' ) ) :
/**
 * Footer Sidebar
 *
 * @since Lucida 0.1
 */
function lucida_footer_sidebar() {
	get_sidebar( 'footer' );
}
endif;
add_action( 'lucida_footer', 'lucida_footer_sidebar', 20 );


if ( ! function_exists( 'lucida_footer_content_end' ) ) :
/**
 * End footer id #colophon
 *
 * @since Lucida 0.1
 */
function lucida_footer_content_end() {
	?>
	</footer><!-- #colophon -->
	<?php
}
endif;
add_action( 'lucida_footer', 'lucida_footer_content_end', 70 );