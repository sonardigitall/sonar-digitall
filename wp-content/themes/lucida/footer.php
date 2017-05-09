<?php
/**
 * The template for displaying the footer
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


/**
 * lucida_after_content hook
 *
 * @hooked lucida_content_end - 10
 * @hooked lucida_after_content_sidebar - 20
 * @hooked lucida_featured_content_display (move featured content below homepage posts) - 30
 *
 */
do_action( 'lucida_after_content' );


/**
 * lucida_footer hook
 *
 * @hooked lucida_footer_content_start - 10
 * @hooked lucida_footer_sidebar - 20
 * @hooked lucida_site_generator_start - 30
 * @hooked lucida_footer_content - 50
 * @hooked lucida_site_generator_end - 60
 * @hooked lucida_footer_content_end - 70
 * @hooked lucida_page_end - 80
 *
 */
do_action( 'lucida_footer' );


/**
 * lucida_after hook
 *
 * @hooked lucida_scrollup - 10
 * @hooked lucida_mobile_menus- 20
 *
 */
do_action( 'lucida_after' );

wp_footer(); ?>
</body>
</html>