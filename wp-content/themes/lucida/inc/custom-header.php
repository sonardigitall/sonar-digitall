<?php
/**
 * Implement Custom Header functionality
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( ! function_exists( 'lucida_custom_header' ) ) :
/**
 * Implementation of the Custom Header feature
 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function lucida_custom_header() {
		/**
		 * Get Theme Options Values
		 */
		$options 	= lucida_get_theme_options();

		if ( 'light' == $options['color_scheme'] ) {
			$default_header_color = lucida_get_default_theme_options();
			$default_header_color = $default_header_color['header_textcolor'];
		}
		elseif ( 'dark' == $options['color_scheme'] ) {
			$default_header_color = lucida_default_dark_color_options();
			$default_header_color = $default_header_color['header_textcolor'];
		}

		$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => $default_header_color,

			// Header image default
			'default-image'			=> get_template_directory_uri() . '/images/gallery/header-1920x800.jpg',

			// Set height and width, with a maximum value for the width.
			'height'                 => 800,
			'width'                  => 1920,

			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => true,

			// Random image rotation off by default.
			'random-default'         => false,
		);

		$args = apply_filters( 'custom-header', $args );

		// Add support for custom header
		add_theme_support( 'custom-header', $args );
	}
endif; // lucida_custom_header
add_action( 'after_setup_theme', 'lucida_custom_header' );


if ( ! function_exists( 'lucida_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses get_transient, lucida_get_theme_options, get_header_textcolor, get_bloginfo, set_transient, display_header_text
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @action
	 *
	 * @since Lucida 0.1
	 */
	function lucida_site_branding() {
		$options 			= lucida_get_theme_options();

		$lucida_site_logo = '';

		//Checking Logo
		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				$lucida_site_logo = '
				<div id="site-logo">'. get_custom_logo() . '</div><!-- #site-logo -->';
			}
		}

		$lucida_header_text = '
		<div id="site-header">
			<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h1>
			<h2 class="site-description">' . get_bloginfo( 'description' ) . '</h2>
		</div><!-- #site-header -->';


		$text_color = get_header_textcolor();
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			if ( ! $options['move_title_tagline'] && 'blank' != $text_color ) {
				$lucida_site_branding  = '<div id="site-branding" class="logo-left">';
				$lucida_site_branding .= $lucida_site_logo;
				$lucida_site_branding .= $lucida_header_text;
			}
			else {
				$lucida_site_branding  = '<div id="site-branding" class="logo-right">';
				$lucida_site_branding .= $lucida_header_text;
				$lucida_site_branding .= $lucida_site_logo;
			}

		}
		else {
			$lucida_site_branding	= '<div id="site-branding">';
			$lucida_site_branding	.= $lucida_header_text;
		}

		$lucida_site_branding 	.= '</div><!-- #site-branding-->';

		echo $lucida_site_branding ;
	}
endif; // lucida_site_branding
add_action( 'lucida_header', 'lucida_site_branding', 60 );


if ( ! function_exists( 'lucida_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own lucida_featured_image(), and that function will be used instead.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_featured_image() {
		$options      = lucida_get_theme_options();
		$header_image = get_header_image();

		//Support Random Header Image
		if ( is_random_header_image() ) {
			delete_transient( 'lucida_featured_image' );
		}

		if ( !$output = get_transient( 'lucida_featured_image' ) ) {

			echo '<!-- refreshing cache -->';

			if ( '' != $header_image  ) {
				$link   = '';
				$target = '';

				// Header Image Link and Target
				if ( !empty( $options['featured_header_image_url'] ) ) {
					$link = $options['featured_header_image_url'];

					//Checking Link Target
					if ( !empty( $options['featured_header_image_base'] ) )  {
						$target = '_blank';
					}
					else {
						$target = '_self';
					}
				}

				// Header Image Title/Alt
				if ( !empty( $options['featured_header_image_alt'] ) ) {
					$title = esc_attr( $options['featured_header_image_alt'] );
				}
				else {
					$title = '';
				}

				// Header Image
				$feat_image = '<img class="wp-post-image" alt="' . esc_attr( $title ) . '" src="'.esc_url(  $header_image ).'" />';

				$output = '<div id="header-featured-image">
					<div class="wrapper">';
					// Header Image Link
					if ( !empty( $options['featured_header_image_url'] ) ) :
						$output .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="' . $target . '">' . $feat_image . '</a>';
					else:
						// if empty featured_header_image on theme options, display default
						$output .= $feat_image;
					endif;
				$output .= '</div><!-- .wrapper -->
				</div><!-- #header-featured-image -->';
			}

			set_transient( 'lucida_featured_image', $output, 86940 );
		}

		echo $output;

	} // lucida_featured_image
endif;


if ( ! function_exists( 'lucida_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own lucida_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_featured_page_post_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		$page_for_posts = get_option('page_for_posts');

		if ( is_home() && $page_for_posts == $page_id ) {
			$header_page_id = $page_id;
		}
		else {
			$header_page_id = $post->ID;
		}

		if ( has_post_thumbnail( $header_page_id ) ) {
			$options    = lucida_get_theme_options();
			$image_url  = $options['featured_header_image_url'];
			$image_base = $options['featured_header_image_base'];

			$link   = $image_url;
			$target = '_self';

			if ( $image_base ) {
				$target = '_blank';
			}

			$image_alt	= $options['featured_header_image_alt'];
			// Header Image Title/Alt
			if ( '' != $image_alt ) {
				$title = esc_attr( $image_alt );
			}
			else {
				$title = '';
			}

			$image_size	= $options['featured_image_size'];

			$feat_image = get_the_post_thumbnail( $post->ID, $image_size, array('id' => 'main-feat-img'));

			$output = '<div id="header-featured-image" class =' . $image_size . '>';
				// Header Image Link
				if ( '' != $image_url ) :
					$output .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="' . $target . '">' . $feat_image . '</a>';
				else:
					// if empty featured_header_image on theme options, display default
					$output .= $feat_image;
				endif;
			$output .= '</div><!-- #header-featured-image -->';

			echo $output;
		}
		else {
			lucida_featured_image();
		}
	} // lucida_featured_page_post_image
endif;


if ( ! function_exists( 'lucida_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own lucida_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Lucida 0.1
	 */
	function lucida_featured_overall_image() {
		global $post, $wp_query;
		$options				= lucida_get_theme_options();
		$enableheaderimage 		= $options['enable_featured_header_image'];

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		$page_for_posts = get_option('page_for_posts');

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_page() || is_single() ) {
			//Individual Page/Post Image Setting
			$meta_feat_image = get_post_meta( $post->ID, 'lucida-header-image', true );

			if ( 'disable' == $meta_feat_image  || ( 'default' == $meta_feat_image  && 'disable' == $enableheaderimage  ) ) {
				echo '<!-- Page/Post Disable Header Image -->';
				return;
			}
			elseif ( 'enable' == $meta_feat_image  && 'disabled' == $enableheaderimage  ) {
				lucida_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' == $enableheaderimage ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				lucida_featured_image();
			}
		}
		// Check Excluding Homepage
		if ( 'exclude-home' == $enableheaderimage  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			else {
				lucida_featured_image();
			}
		}
		elseif ( 'exclude-home-page-post' == $enableheaderimage  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			elseif ( is_page() || is_single() ) {
				lucida_featured_page_post_image();
			}
			else {
				lucida_featured_image();
			}
		}
		// Check Entire Site
		elseif ( 'entire-site' == $enableheaderimage ) {
			lucida_featured_image();
		}
		// Check Entire Site (Post/Page)
		elseif ( 'entire-site-page-post' == $enableheaderimage  ) {
			if ( is_page() || is_single() ) {
				lucida_featured_page_post_image();
			}
			else {
				lucida_featured_image();
			}
		}
		// Check Page/Post
		elseif ( 'pages-posts' == $enableheaderimage  ) {
			if ( is_page() || is_single() ) {
				lucida_featured_page_post_image();
			}
		}
		else {
			echo '<!-- Disable Header Image -->';
		}
	} // lucida_featured_overall_image
endif;
add_action( 'lucida_after_header', 'lucida_featured_overall_image', 10 );