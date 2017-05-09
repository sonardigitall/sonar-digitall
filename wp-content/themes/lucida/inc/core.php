<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, lucida_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * Lucida functions and definitions
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( ! function_exists( 'lucida_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function lucida_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'lucida_content_width', 620 );
	}
endif;
add_action( 'after_setup_theme', 'lucida_content_width', 0 );


if ( ! function_exists( 'lucida_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function lucida_template_redirect() {
	    $layout = lucida_get_theme_layout();

		// Two Colums: Left and Right Sidebar & One Column: No Sidbear, No Sidebar One Column
		if ( 'right-sidebar' == $layout || 'no-sidebar' == $layout ) {
			$GLOBALS['content_width'] = 880;
		}
	}
endif;
add_action( 'template_redirect', 'lucida_template_redirect' );


if ( ! function_exists( 'lucida_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function lucida_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options = lucida_get_theme_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Lucida, use a find and replace
		 * to change 'lucida' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'lucida', trailingslashit( get_template_directory() ) . 'languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add excerpt box in pages
		 */
		add_post_type_support( 'page', 'excerpt' );

		// Thumbnail Image, used in Three Columns (Featured archive pages). Ratio 16:9
		set_post_thumbnail_size( 620, 413, true );

		// Featured Image, used in Slider
		add_image_size( 'lucida-slider', 1920, 800, true ); // Used for Featured slider

		// Thumbnail Image, used in Two Columns/One Column (Featured archive pages)
		add_image_size( 'lucida-featured', 880, 660, true);

		add_image_size( 'lucida-landscape', 480, 320, true ); // used in Archive Left/Right

		add_image_size( 'lucida-small', 90, 68, true ); // used in Widgets

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' 		=> esc_html__( 'Primary Menu', 'lucida' ),
			'header-top' 	=> esc_html__( 'Header Top Menu', 'lucida' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		$default_options = lucida_get_default_theme_options(); //Get Default Theme Options Values.
		$bg_color = $default_options['background_color'];

		if ( 'dark' == $options['color_scheme'] ) {
			$dark_def_colors = lucida_default_dark_color_options();
			$bg_color        = $dark_def_colors['background_color'];
		}

		add_theme_support( 'custom-background', apply_filters( 'lucida_custom_background_args', array(
			'default-color' => $bg_color,
		) ) );


		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Setup Custom Logo Support for theme
		 * Supported from WordPress version 4.5 onwards
		 * More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		 */
		add_theme_support( 'custom-logo' );

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type	= $options['pagination_type'];

		if ( 'infinite-scroll-click' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'click',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
		elseif ( 'infinite-scroll-scroll' == $pagination_type ) {
			//Override infinite scroll disable scroll option
        	update_option('infinite_scroll', true);

			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'scroll',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
	}
endif; // lucida_setup
add_action( 'after_setup_theme', 'lucida_setup' );


/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since Lucida 0.1
 */
function lucida_scripts() {
	$options = lucida_get_theme_options();

	wp_register_style( 'lucida-web-font', lucida_fonts_url(), false, null );

	$deps = array( 'lucida-web-font' );

	wp_enqueue_style( 'lucida-style', get_stylesheet_uri(), $deps, LUCIDA_THEME_VERSION );

	wp_enqueue_script( 'lucida-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), LUCIDA_THEME_VERSION, true );

	wp_enqueue_script( 'lucida-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), LUCIDA_THEME_VERSION, true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//For genericons
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons/genericons.css', false, '3.4.1' );

	/**
	 * Enqueue the styles for the current color scheme for parallaxframe.
	 */
	if ( 'dark' == $options['color_scheme'] ) {
		wp_enqueue_style( 'lucida-dark', get_template_directory_uri() . '/css/colors/dark.css', array(), LUCIDA_THEME_VERSION );
	}

	/**
	 * Loads up fit vids
	 */
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.1', true );

	/**
	 * Loads up Cycle JS
	 */
	if ( $options['featured_slider_option'] != 'disabled' || $options['news_ticker_option'] != 'disabled' ) {
		wp_register_script( 'jquery-cycle2', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			$options['featured_slider_transition_effect'],
			$options['news_ticker_transition_effect']
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition
		if ( in_array( 'scrollVert', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-scrollVert', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), '20140128', true );
		}

		// Flip transition plugin addition
		if ( in_array( 'flipHorz', $transition_effects ) || in_array( 'flipVert', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-flip', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), '20140128', true );
		}

		// Shuffle transition plugin addition
		if ( in_array( 'tileSlide', $transition_effects ) || in_array( 'tileBlind', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-tile', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), '20140128', true );
		}

		// Shuffle transition plugin addition
		if ( in_array( 'shuffle', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-shuffle', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), '20140128 ', true );
		}

		//Load jquery cycle alone if no plugin is required
		if ( !( in_array( 'scrollVert', $transition_effects ) || in_array( 'flipHorz', $transition_effects ) || in_array( 'flipVert', $transition_effects ) || in_array( 'tileSlide', $transition_effects ) || in_array( 'tileBlind', $transition_effects ) || in_array( 'shuffle', $transition_effects ) ) ){
			wp_enqueue_script( 'jquery-cycle2' );
		}
	}

	/**
	 * Loads up Scroll Up script
	 */
	if ( ! $options['disable_scrollup'] ) {
		wp_enqueue_script( 'lucida-scrollup', get_template_directory_uri() . '/js/scrollup.min.js', array( 'jquery' ), '20072014', true  );
	}

	/**
	 * Enqueue custom script for Lucida.
	 */
	wp_enqueue_script( 'lucida-custom-scripts', get_template_directory_uri() . '/js/custom-scripts.min.js', array( 'jquery' ), null );

	wp_localize_script( 'lucida-custom-scripts', 'lucidaScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'lucida' ),
		'collapse' => esc_html__( 'collapse child menu', 'lucida' ),
	) );

	// Load the html5 shiv.
	wp_enqueue_script( 'lucida-html5', get_template_directory_uri() . '/js/html5.min.js', array(), '3.7.0' );
	wp_script_add_data( 'lucida-html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'lucida_scripts' );


/**
 * Register Google fonts.
 */
function lucida_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$open_sans = _x( 'on', 'Open Sans: on or off', 'lucida' );

	/* Translators: If there are characters in your language that are not
	* supported by Playfair Display, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'lucida' );

	if ( 'off' !== $open_sans || 'off' !== $playfair_display ) {
		$font_families = array();

		if ( 'off' !== $open_sans ) {
		$font_families[] = 'Open Sans';
		}

		if ( 'off' !== $playfair_display ) {
		$font_families[] = 'Playfair Display';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @action admin_print_scripts-post-new, admin_print_scripts-post, admin_print_scripts-page-new, admin_print_scripts-page
 *
 * @since Lucida 0.1
 */
function lucida_enqueue_metabox_scripts( $hook ) {
	$allowed_pages = array( 'post-new.php', 'post.php' );

	// Bail if not on required page
	if ( ! in_array( $hook, $allowed_pages ) ) {
		return;
	}

    //Scripts
	wp_enqueue_script( 'lucida-metabox', get_template_directory_uri() . '/js/metabox.min.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );

	//CSS Styles
	wp_enqueue_style( 'lucida-metabox-tabs', get_template_directory_uri() . '/css/metabox-tabs.css' );
}
add_action( 'admin_enqueue_scripts', 'lucida_enqueue_metabox_scripts' );


/**
 * Default Options.
 */
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

/**
 * Custom Header.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';


/**
 * Structure for Lucida
 */
require trailingslashit( get_template_directory() ) . 'inc/structure.php';


/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer.php';


/**
 * Custom Menus
 */
require trailingslashit( get_template_directory() ) . 'inc/menus.php';


/**
 * Load Header Highlight Content file.
 */
require trailingslashit( get_template_directory() ) . 'inc/header-highlight-content.php';


/**
 * Load Slider file.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-slider.php';


/**
 * Load Featured Content.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-content.php';


/**
 * Load News Ticker
 */
require trailingslashit( get_template_directory() ) . 'inc/news-ticker.php';


/**
 * Load Breadcrumb file.
 */
require trailingslashit( get_template_directory() ) . 'inc/breadcrumb.php';


/**
 * Load Widgets and Sidebars
 */
require trailingslashit( get_template_directory() ) . 'inc/widgets/widgets.php';


/**
 * Load Social Icons
 */
require trailingslashit( get_template_directory() ) . 'inc/social-icons.php';


/**
 * Load Metaboxes
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';


/**
 * Returns the options array for Lucida.
 * @uses  get_theme_mod
 *
 * @since Lucida 0.1
 */
function lucida_get_theme_options() {
	$default_options = lucida_get_default_theme_options();

	return array_merge( $default_options , get_theme_mod( 'lucida_theme_options', $default_options ) ) ;
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, lucida_customize_preview (see lucida_customizer function: lucida_customize_preview)
 *
 * @since Lucida 0.1
 */
function lucida_flush_transients(){
	delete_transient( 'lucida_header_highlight_content' );

	delete_transient( 'lucida_featured_content' );

	delete_transient( 'lucida_news_ticker' );

	delete_transient( 'lucida_featured_slider' );

	delete_transient( 'lucida_custom_css' );

	delete_transient( 'lucida_featured_image' );

	delete_transient( 'lucida_social_icons' );

	delete_transient( 'lucida_scrollup' );

	delete_transient( 'all_the_cool_cats' );

	//Add Lucida default themes if there is no values
	if ( !get_theme_mod('lucida_theme_options') ) {
		set_theme_mod( 'lucida_theme_options', lucida_get_default_theme_options() );
	}
}
add_action( 'customize_save', 'lucida_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since Lucida 0.1
 */
function lucida_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'lucida_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since Lucida 0.1
 */
function lucida_flush_post_transients(){
	delete_transient( 'lucida_featured_content' );

	delete_transient( 'lucida_news_ticker' );

	delete_transient( 'lucida_featured_slider' );

	delete_transient( 'lucida_featured_image' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'lucida_flush_post_transients' );


if ( ! function_exists( 'lucida_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since Lucida 0.1
	 */
	function lucida_custom_css() {
		//lucida_flush_transients();
		$options 	= lucida_get_theme_options();
		$defaults 	= lucida_get_default_theme_options();

		if ( ! $output = get_transient( 'lucida_custom_css' ) ) {
			$output ='';

			$text_color = get_header_textcolor();

			if ( 'blank' == $text_color ){
				$output	.=  ".site-title a, .site-description { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px); }". "\n";
			}
			elseif (  $defaults['header_textcolor'] != $text_color ) {
				$output	.=  ".site-title a, .site-description { color: #".  $text_color ."; }". "\n";
			}

			/*
			 * Promotion Headline Widget left and right width
			 */
			if ( $defaults['promotion_headline_left_width'] != $options['promotion_headline_left_width'] ) {
				$output	.= "@media screen and (min-width: 481px) {". "\n";
				if ( 100 == $options['promotion_headline_left_width'] ) {
					$output	.=  "#promotion-message .left, #promotion-message .right { max-width: 100%; width: 100%; }". "\n";
					$output	.=  "#promotion-message .right .promotion-button { margin-top: 0; }". "\n";
				}
				else {
					$output	.=  "#promotion-message .left { max-width: ". $options['promotion_headline_left_width'] ."%; }". "\n";
					$output	.=  "#promotion-message .right { max-width: ". absint( 100 - $options['promotion_headline_left_width'] ) ."%; }". "\n";
				}
				$output	.= "}". "\n";
			}

			//Custom CSS Option
			if ( !empty( $options['custom_css'] ) ) {
				$output	.=  $options[ 'custom_css'] . "\n";
			}

			if ( '' != $output ){
				echo '<!-- refreshing cache -->' . "\n";

				$output = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen" rel="ct-custom-css">' . "\n" . $output;

				$output .= '</style>' . "\n";

			}

			set_transient( 'lucida_custom_css', htmlspecialchars_decode( $output ), 86940 );
		}

		echo $output;
	}
endif; //lucida_custom_css
add_action( 'wp_head', 'lucida_custom_css', 101 );

/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since Lucida 0.1
 */
function lucida_alter_home( $query ){
	if ( $query->is_main_query() && $query->is_home() ) {
		$options = lucida_get_theme_options();
		$cats    = $options['front_page_category'];

	    if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','lucida_alter_home' );


if ( ! function_exists( 'lucida_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Lucida 0.1
	 */
	function lucida_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options         = lucida_get_theme_options();
		$pagination_type = $options['pagination_type'];

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>

		<div class="main-pagination clear">
			<?php
			/**
			 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
			 */
			if ( 'numeric' == $pagination_type && function_exists( 'wp_pagenavi' ) ) {
				echo '<nav class="navigation pagination-pagenavi" role="navigation">';
					wp_pagenavi();
				echo '</nav><!-- .pagination-pagenavi -->';
            }
            elseif ( 'numeric' == $pagination_type && function_exists( 'the_posts_pagination' ) ) {
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous', 'lucida' ),
					'next_text'          => esc_html__( 'Next', 'lucida' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lucida' ) . ' </span>',
				) );
			}
			else {
				the_posts_navigation();
            } ?>
		</div><!-- .main-pagination -->

		<?php
	}
endif; // lucida_content_nav


if ( ! function_exists( 'lucida_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'lucida' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'lucida' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'lucida' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'lucida' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( esc_html__( 'Edit', 'lucida' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'lucida' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( wp_parse_args( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // lucida_comment()


if ( ! function_exists( 'lucida_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'lucida_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( 'echo=0' ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //lucida_the_attached_image


if ( ! function_exists( 'lucida_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_entry_meta() {
		echo '<p class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'lucida' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'lucida' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'lucida' ), esc_html__( '1 Comment', 'lucida' ), esc_html__( '% Comments', 'lucida' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'lucida' ), '<span class="edit-link">', '</span>' );

		echo '</p><!-- .entry-meta -->';
	}
endif; //lucida_entry_meta


if ( ! function_exists( 'lucida_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'lucida' ) );
			if ( $categories_list && lucida_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'lucida' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'lucida' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'lucida' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //lucida_tag_category


if ( ! function_exists( 'lucida_get_highlight_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Lucida 0.1
	 */
	function lucida_get_highlight_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'lucida' ) );
			if ( $categories_list && lucida_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'lucida' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'lucida' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'lucida' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'lucida' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'lucida' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //lucida_get_highlight_meta


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Lucida 0.1
 */
function lucida_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so lucida_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so lucida_categorized_blog should return false
		return false;
	}
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Lucida 0.1
 */
function lucida_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'lucida_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Lucida 0.1
 */
function lucida_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'lucida_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Lucida 0.1
 */
function lucida_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'footer-widget-area one';
			break;
		case '2':
			$class = 'footer-widget-area two';
			break;
		case '3':
			$class = 'footer-widget-area three';
			break;
		case '4':
			$class = 'footer-widget-area four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'lucida_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Lucida 0.1
	 */
	function lucida_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$options = lucida_get_theme_options();

		return absint( $options['excerpt_length'] );
	}
endif; //lucida_excerpt_length
add_filter( 'excerpt_length', 'lucida_excerpt_length' );


if ( ! function_exists( 'lucida_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Lucida 0.1
	 */
	function lucida_continue_reading() {
		// Getting data from Customizer Options
		$options        = lucida_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return ' <a class="more-link" href="' . esc_url( get_permalink() ) . '">' . wp_kses_data( $more_tag_text ) . '</a>';
	}
endif; //lucida_continue_reading


if ( ! function_exists( 'lucida_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with lucida_continue_reading().
	 *
	 * @since Lucida 0.1
	 */
	function lucida_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return lucida_continue_reading();
	}
endif; //lucida_excerpt_more
add_filter( 'excerpt_more', 'lucida_excerpt_more' );


if ( ! function_exists( 'lucida_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= lucida_continue_reading();
		}
		return $output;
	}
endif; //lucida_custom_excerpt
add_filter( 'get_the_excerpt', 'lucida_custom_excerpt' );


if ( ! function_exists( 'lucida_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_more_link( $more_link, $more_link_text ) {
	 	$options		= lucida_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //lucida_more_link
add_filter( 'the_content_more_link', 'lucida_more_link', 10, 2 );


if ( ! function_exists( 'lucida_body_classes' ) ) :
	/**
	 * Adds Lucida layout classes to the array of body classes.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_body_classes( $classes ) {
		$options 		= lucida_get_theme_options();

		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		$layout = lucida_get_theme_layout();

		switch ( $layout ) {
			case 'three-columns':
				$classes[] = 'layout-three-columns';
			break;

			case 'right-sidebar':
				$classes[] = 'layout-two-columns content-left';
			break;

			case 'no-sidebar':
				$classes[] = 'layout-one-column no-sidebar content-width';
			break;
		}

		$content_layout = $options['content_layout'];
		if ( "" != $content_layout ) {
			$classes[] = $content_layout;
		}

		if ( 'above-content' == $options['news_ticker_position'] ) {
			$classes[] = 'news-ticker-above-content';
		}

		$classes[] = 'header-center';

		$classes 	= apply_filters( 'lucida_body_classes', $classes );

		return $classes;
	}
endif; //lucida_body_classes
add_filter( 'body_class', 'lucida_body_classes' );


if ( ! function_exists( 'lucida_post_classes' ) ) :
	/**
	 * Adds Lucida post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Lucida 0.1
	 */
	function lucida_post_classes( $classes ) {
		//Getting Ready to load data from Theme Options Panel
		$options 		= lucida_get_theme_options();

		$contentlayout = $options['content_layout'];

		if ( is_archive() || is_home() ) {
			$classes[] = esc_attr( $contentlayout );
		}

		return $classes;
	}
endif; //lucida_post_classes
add_filter( 'post_class', 'lucida_post_classes' );

if ( ! function_exists( 'lucida_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Lucida 0.1
	 */
	function lucida_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

	    // Front page displays in Reading Settings
		$page_on_front  = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $id = $page_id;
	    }
	    elseif ( is_singular() ) {
	 		if ( is_attachment() ) {
				$id = $post->post_parent;
			}
			else {
				$id = $post->ID;
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'lucida-layout-option', true );
		}
		else {
			$layout = 'default';
		}

		//Load options data
		$options = lucida_get_theme_options();

		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			$layout = $options['theme_layout'];
		}

		return $layout;
	}
endif; //lucida_get_theme_layout


if ( ! function_exists( 'lucida_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own lucida_archive_content_image(), and that function will be used instead.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_archive_content_image() {
		$options        = lucida_get_theme_options();
		$featured_image = $options['content_layout'];
		$layout         = $options['theme_layout'];

		if ( has_post_thumbnail() && 'full-content' != $featured_image ) { ?>
			<figure class="featured-image">
	            <a rel="bookmark" href="<?php the_permalink(); ?>">

	            <?php
					if ( post_password_required() || is_sticky() ) {
						if ( 'right-sidebar' == $layout || 'no-sidebar' == $layout ) {
							the_post_thumbnail( 'lucida-featured' );
						} else {
							the_post_thumbnail();
						}
					} elseif ( 'excerpt-image-left' == $featured_image ) {
					     the_post_thumbnail( 'lucida-landscape' );
					}
				?>
				</a>
	        </figure>
	   	<?php
		}
	}
endif; //lucida_archive_content_image
add_action( 'lucida_before_entry_container', 'lucida_archive_content_image', 10 );


if ( ! function_exists( 'lucida_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own lucida_single_content_image(), and that function will be used instead.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_single_content_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( $post) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$individual_ft_image = get_post_meta( $parent,'lucida-featured-image', true );
			} else {
				$individual_ft_image = get_post_meta( $page_id,'lucida-featured-image', true );
			}
		}

		if ( empty( $individual_ft_image ) || ( !is_page() && !is_single() ) ) {
			$individual_ft_image = 'default';
		}

		// Getting data from Theme Options
	   	$options = lucida_get_theme_options();

		$featured_image = $options['single_post_image_layout'];

		if ( ( 'disable' == $individual_ft_image  || '' == get_the_post_thumbnail() || ( $individual_ft_image=='default' && 'disabled' == $featured_image ) ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $individual_ft_image ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $individual_ft_image;
			}

			?>
			<figure class="featured-image <?php echo $class; ?>">
                <?php the_post_thumbnail( $featured_image ); ?>
	        </figure>
	   	<?php
		}
	}
endif; //lucida_single_content_image
add_action( 'lucida_before_post_container', 'lucida_single_content_image', 10 );
add_action( 'lucida_before_page_container', 'lucida_single_content_image', 10 );


if ( ! function_exists( 'lucida_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action lucida_comment_section
	 *
	 * @since Lucida 0.1
	 */
	function lucida_get_comment_section() {
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
}
endif;
add_action( 'lucida_comment_section', 'lucida_get_comment_section', 10 );


if ( ! function_exists( 'lucida_promotion_headline' ) ) :
	/**
	 * Template for Promotion Headline
	 *
	 * To override this in a child theme
	 * simply create your own lucida_promotion_headline(), and that function will be used instead.
	 *
	 * @uses lucida_before_main action to add it in the header
	 * @since Lucida 0.1
	 */
	function lucida_promotion_headline() {
		global $wp_query;
		$options          = lucida_get_theme_options();
		$enable_promotion = $options['promotion_headline_option'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		 if ( 'entire-site' == $enable_promotion || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' ==  $enable_promotion  ) ) {
			echo '
			<aside id="promotion-message" role="complementary">
				<div class="wrapper">';

		    	$headline     = $options['promotion_headline'];
				$sub_headline = $options['promotion_subheadline'];

				echo '
				<section class="promotion-headline-section left widget widget_customizer_text">';

				if ( "" != $headline ) {
					echo '<h2>' . wp_kses_post( $headline ) . '</h2>';
				}

				if ( "" != $sub_headline ) {
					echo '<p>' . wp_kses_post( $sub_headline ) . '</p>';
				}

				echo '
				</section><!-- .section.left -->';


				$button = $options['promotion_headline_button'];
				$target = $options['promotion_headline_target'];
				$url    = $options['promotion_headline_url'];

				if ( "" != $url ) {
					if ( $target ) {
						$headline_target = '_blank';
					}
					else {
						$headline_target = '_self';
					}

					echo '
					<section class="promotion-headline-section right widget widget_customizer_text">
						<a class="promotion-button" href="' . esc_url( $url ) . '" target="' . $headline_target . '">' . esc_attr( $button ) . '
						</a>
					</section><!-- .section.right -->';
				}

			echo '
				</div><!-- .wrapper -->
			</aside><!-- #promotion-message -->';
		}
	}
endif; // lucida_promotion_featured_content
add_action( 'lucida_header', 'lucida_promotion_headline', 25 );


if ( ! function_exists( 'lucida_site_generator_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_site_generator_start() {
		?>
		<div id="site-generator">
    		<div class="wrapper">
		<?php
	}
endif;
add_action( 'lucida_footer', 'lucida_site_generator_start', 30 );


/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action lucida_footer
 *
 * @since Lucida 0.1
 */
function lucida_footer_content() {
	//lucida_flush_transients();
	if ( ( !$output = get_transient( 'lucida_footer_content' ) ) ) {
		$output =  '<div id="footer-content" class="copyright">' . lucida_get_content() . '</div>';

	    set_transient( 'lucida_footer_content', $output, 86940 );
    }

    echo $output;
}
add_action( 'lucida_footer', 'lucida_footer_content', 50 );


if ( ! function_exists( 'lucida_site_generator_end' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_site_generator_end() {
		?>
			</div><!-- .wrapper -->
		</div><!-- #site-generator -->
		<?php
	}
endif;
add_action( 'lucida_footer', 'lucida_site_generator_end', 60 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Lucida 0.1
 */

function lucida_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="pngfix wp-post-image" src="'. $first_img .'">';
	}

	return false;
}


if ( ! function_exists( 'lucida_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action lucida_footer action
	 * @uses set_transient and delete_transient
	 */
	function lucida_scrollup() {
		//lucida_flush_transients();
		if ( !$lucida_scrollup = get_transient( 'lucida_scrollup' ) ) {

			// get the data value from theme options
			$options = lucida_get_theme_options();
			echo '<!-- refreshing cache -->';

			//site stats, analytics header code
			if ( ! $options['disable_scrollup'] ) {
				$lucida_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'lucida' ) . '</span></a>' ;
			}

			set_transient( 'lucida_scrollup', $lucida_scrollup, 86940 );
		}
		echo $lucida_scrollup;
	}
}
add_action( 'lucida_after', 'lucida_scrollup', 10 );


if ( ! function_exists( 'lucida_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function lucida_page_post_meta() {
		$meta = '';

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'lucida' ) );

		if ( $categories_list && lucida_categorized_blog() ) {
			$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
				sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'lucida' ) ),
				$categories_list
			);
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$meta .= sprintf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( __( '<span class="screen-reader-text">Posted on</span>', 'lucida' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		return $meta;
	}
endif; //lucida_page_post_meta


if ( ! function_exists( 'lucida_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since Lucida 0.1
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function lucida_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //lucida_truncate_phrase


if ( ! function_exists( 'lucida_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since Lucida 0.1
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function lucida_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = lucida_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'lucida_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //lucida_get_the_content_limit


if ( ! function_exists( 'lucida_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action lucida_after_post
	 *
	 * @since Lucida 0.1
	 */
	function lucida_post_navigation() {
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' .__( 'Next &rarr;', 'lucida' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'lucida' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&larr; Previous', 'lucida' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'lucida' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	}
endif; //lucida_post_navigation
add_action( 'lucida_after_post', 'lucida_post_navigation', 10 );



if ( ! function_exists( 'lucida_date' ) ) :
	/**
	 * Displays Date
	 *
	 * @uses  date_i18n
	 *
	 * default load in lucida_header_top function
	 *
	 * @since Lucida 0.1
	 */
	function lucida_date() {
		$options	= lucida_get_theme_options();
		if ( $options['disable_date'] ) {
			//Bail if date is disabled
			return;
		}

		echo '<div class="date ctdate">' . date_i18n('l, F j, Y') . '</div>';
   }
endif;  //lucida_date


/**
 * Display Multiple Select type for and array of categories
 *
 * @param  [string] $name  [field name]
 * @param  [string] $id    [field_id]
 * @param  [array] $selected    [selected values]
 * @param  string $label [label of the field]
 */
function lucida_dropdown_categories( $name, $id, $selected, $label = '' ) {
	$dropdown = wp_dropdown_categories(
		array(
			'name'             => $name,
			'echo'             => 0,
			'hide_empty'       => false,
			'show_option_none' => false,
			'hierarchical'       => 1,
		)
	);

	if ( '' != $label ) {
		echo '<label for="' . $id . '">
			'. $label .'
			</label>';
	}

	$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:120px; width: 100%" ', $dropdown );

	foreach( $selected as $selected ) {
		$dropdown = str_replace( 'value="'. $selected .'"', 'value="'. $selected .'" selected="selected"', $dropdown );
	}

	echo $dropdown;

	echo '<span class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'lucida' ) . '</span>';
}


/**
 * Return registered image sizes.
 *
 * Return a two-dimensional array of just the additionally registered image sizes, with width, height and crop sub-keys.
 *
 * @since 0.1.7
 *
 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
 *
 * @return array Two-dimensional, with width, height and crop sub-keys.
 */
function lucida_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( $_wp_additional_image_sizes )
		return $_wp_additional_image_sizes;

	return array();
}


/**
 * Migrate Custom CSS to WordPress core Custom CSS
 *
 * Runs if version number saved in theme_mod "custom_css_version" doesn't match current theme version.
 */
function lucida_custom_css_migrate(){
	$ver = get_theme_mod( 'custom_css_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}

	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.

	    /**
		 * Get Theme Options Values
		 */
	    $options = lucida_get_theme_options();

	    if ( '' != $options['custom_css'] ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $options['custom_css'] );
	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	            unset( $options['custom_css'] );
	            set_theme_mod( 'lucida_theme_options', $options );

	            // Update to match custom_css_version so that script is not executed continously
				set_theme_mod( 'custom_css_version', '4.7' );
	        }
	    }
	}
}
add_action( 'after_setup_theme', 'lucida_custom_css_migrate' );