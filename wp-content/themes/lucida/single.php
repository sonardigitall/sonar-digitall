<?php
/**
 * The Template for displaying all single posts
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */

get_header();

?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php
			/**
			 * lucida_after_post hook
			 *
			 * @hooked lucida_post_navigation - 10
			 */
			do_action( 'lucida_after_post' );

			/**
			 * lucida_comment_section hook
			 *
			 * @hooked lucida_get_comment_section - 10
			 */
			do_action( 'lucida_comment_section' );
		?>
	<?php endwhile; // end of the loop. ?>

<?php

get_sidebar();
get_footer(); ?>