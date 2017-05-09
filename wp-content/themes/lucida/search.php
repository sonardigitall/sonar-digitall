<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */

get_header();
?>

	<?php if ( have_posts() ) : ?>

		<header class="entry-header">
			<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'lucida' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php lucida_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

<?php
get_sidebar();
get_footer(); ?>