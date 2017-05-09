<?php
/**
 * The template for displaying search form
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */
?>

<?php $options 	= lucida_get_theme_options(); // Get options ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_attr( _ex( 'Search for:', 'label', 'lucida' ) ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options['search_text'] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr( _x( 'Search for:', 'label', 'lucida' ) ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'lucida' ); ?>">
</form>