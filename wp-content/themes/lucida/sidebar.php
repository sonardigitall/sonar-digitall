<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */
?>

<?php
/**
 * lucida_before_secondary hook
 *
 * @hooked lucida_after_posts_pages_sidebar - 10
 * @hooked lucida_main_end - 20
 * @hooked lucida_primary_end - 30
 *
 */
do_action( 'lucida_before_secondary' );

$lucida_layout = lucida_get_theme_layout();

//Bail early if no sidebar layout is selected
if ( 'no-sidebar' == $lucida_layout ) {
	return;
}

$sidebaroptions = '';

global $post, $wp_query;

// Front page displays in Reading Settings
$page_on_front = get_option('page_on_front') ;
$page_for_posts = get_option('page_for_posts');

// Get Page ID outside Loop
$page_id = $wp_query->get_queried_object_id();

// Blog Page or Front Page setting in Reading Settings
if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
    $sidebaroptions = get_post_meta( $page_id, 'lucida-sidebar-options', true );
}
elseif ( is_singular() ) {
	if ( is_attachment() ) {
		$parent 		= $post->post_parent;
		$sidebaroptions = get_post_meta( $parent, 'lucida-sidebar-options', true );

	}
	else {
		$sidebaroptions = get_post_meta( $post->ID, 'lucida-sidebar-options', true );
	}
}

/**
 * lucida_before_primary_sidebar hook
 */
do_action( 'lucida_before_primary_sidebar' );
?>
	<aside class="sidebar sidebar-primary widget-area" role="complementary">
		<?php
		if ( is_active_sidebar( 'primary-sidebar' ) ) {
        	dynamic_sidebar( 'primary-sidebar' );
   		}
		else {
			//Helper Text
			if ( current_user_can( 'edit_theme_options' ) ) { ?>
				<section id="widget-default-text" class="widget widget_text">
					<div class="widget-wrap">
	                	<h4 class="widget-title"><?php esc_html_e( 'Primary Sidebar Widget Area', 'lucida' ); ?></h4>

	                 	<div class="textwidget">
	                   		<p><?php esc_html_e( 'This is the Primary Sidebar Widget Area if you are using a two or three column site layout option.', 'lucida' ); ?></p>
	                   		<p><?php printf( wp_kses( __( 'By default it will load Search and Archives widgets as shown below. You can add widget to this area by visiting your <a href="%1$s">Widgets Panel</a> which will replace default widgets.', 'lucida' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'widgets.php' ) ) ); ?></p>
                 		</div><!-- .textwidget -->
	           		</div><!-- .widget-wrap -->
	       		</section><!-- #widget-default-text -->
			<?php
			} ?>
			<section class="widget widget_widget_lucida_adspace_widget" id="header-right-ads">
				<div class="widget-wrap">
					<a class="ads-image" href="#">
						<img src="<?php echo get_template_directory_uri() . '/images/gallery/ads-300x250.jpg'; ?>">
					</a>
				</div><!-- .widget-wrap -->
			</section><!-- .widget-wrap -->
			<section class="widget widget_search" id="default-search">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Search', 'lucida' ); ?></h4>
					<?php get_search_form(); ?>
				</div><!-- .widget-wrap -->
			</section><!-- #default-search -->
			<section class="widget widget_archive" id="default-archives">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Archives', 'lucida' ); ?></h4>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</div><!-- .widget-wrap -->
			</section><!-- #default-archives -->
			<?php
		} ?>
	</aside><!-- .sidebar sidebar-primary widget-area -->
<?php
/**
 * lucida_after_primary_sidebar hook
 */
do_action( 'lucida_after_primary_sidebar' );


/**
 * lucida_after_secondary hook
 *
 */
do_action( 'lucida_after_secondary' );