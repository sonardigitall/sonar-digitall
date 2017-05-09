<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */

get_header();
?>
	<article id="page-404" class="error-404 not-found type-page hentry">
		<div class="entry-container">
			<header class="entry-header">
				<h2 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'lucida' ); ?></h2>
			</header><!-- .page-header -->

			<div class="entry-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'lucida' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</div><!-- .entry-container -->
	</article><!-- .error-404 -->
<?php
get_sidebar();
get_footer(); ?>