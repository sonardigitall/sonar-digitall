<?php
/**
 * The template for displaying the Featured Content
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( !function_exists( 'lucida_featured_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook lucida_before_content.
*
* @since Lucida 0.1
*/
function lucida_featured_content_display() {
	//lucida_flush_transients();
	global $wp_query;

	// get data value from options
	$options        = lucida_get_theme_options();
	$enable_content = $options['featured_content_option'];
	$content_select = $options['featured_content_type'];

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
		if ( ( !$output = get_transient( 'lucida_featured_content' ) ) ) {
			$layouts 	 = $options['featured_content_layout'];
			$headline 	 = $options['featured_content_headline'];
			$subheadline = $options['featured_content_subheadline'];

			echo '<!-- refreshing cache -->';

			$classes[] = $layouts;
			$classes[] = $content_select;

			$position = $options['featured_content_position'];

			if ( $position ) {
				$classes[] = ' border-top' ;
			}

			$output ='
				<aside id="featured-content" class="' . esc_attr( implode( ' ', $classes ) ) . '" role="complementary">
					<div class="wrapper">';
						if ( !empty( $headline ) || !empty( $subheadline ) ) {
							$output .='<div class="featured-heading-wrap">';
								if ( !empty( $headline ) ) {
									$output .='<h2 id="featured-heading" class="entry-title">'. $headline .'</h2>';
								}
								if ( !empty( $subheadline ) ) {
									$output .='<p>'. $subheadline .'</p>';
								}
							$output .='</div><!-- .featured-heading-wrap -->';
						}

						$output .='
						<div class="featured-content-wrap">
							<section class="widget widget_' . esc_attr( implode( ' ', $classes ) ) . '">';
							// Select content
							if ( 'demo' == $content_select ) {
								$output .= lucida_demo_content( $options );
							}
							elseif ( 'page' == $content_select ) {
								$output .= lucida_page_post_category_content( $options );
							}

			$output .='
							</section>
						</div><!-- .featured-content-wrap -->
					</div><!-- .wrapper -->
				</aside><!-- #featured-content -->';
			set_transient( 'lucida_featured_content', $output, 86940 );

		}
		echo $output;
	}
}
endif;


if ( ! function_exists( 'lucida_featured_content_display_position' ) ) :
/**
 * Homepage Featured Content Position
 *
 * @action lucida_content, lucida_after_secondary
 *
 * @since Lucida 0.1
 */
function lucida_featured_content_display_position() {
	// Getting data from Theme Options
	$options  = lucida_get_theme_options();
	$position = $options['featured_content_position'];

	if ( $position ) {
		add_action( 'lucida_after_content', 'lucida_featured_content_display', 30 );
	} else {
		add_action( 'lucida_before_content', 'lucida_featured_content_display', 40 );
	}
}
endif; // lucida_featured_content_display_position
add_action( 'lucida_before', 'lucida_featured_content_display_position' );


if ( ! function_exists( 'lucida_demo_content' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_demo_content( $options ) {
		$lucida_demo_content = '
			<article id="featured-post-1" class="post hentry post-demo">
				<figure class="featured-content-image">
					<img alt="Travel Map" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured1-350x263.jpg" />
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="Travel Map" href="#">Travel Map</a>
						</h2>
					</header>
					<div class="entry-summary">
						<p>A map is a picture or representation of the Earth\'s surface, showing how things are related to each other by distance, direction, and size. Create a travel map to record your experiences.
							<a href="#" class="more-link">Read More ...</a></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-2" class="post hentry post-demo">
				<figure class="featured-content-image">
					<img alt="Volkswagen Camper" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured2-350x263.jpg" />
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="Volkswagen Camper" href="#">Volkswagen Camper</a>
						</h2>
					</header>
					<div class="entry-summary">
						<p>The Volkswagen Camper gives you freedom. Whether you are into extreme sports, family fun or simply escaping for the weekend, discover new journeys with the Volkswagen.
							<a href="#" class="more-link">Read More ...</a></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>

			<article id="featured-post-3" class="post hentry post-demo">
				<figure class="featured-content-image">
					<img alt="Best Beaches" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured3-350x263.jpg" />
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="Best Beaches" href="#">Best Beaches</a>
						</h2>
					</header>
					<div class="entry-summary">
						<p>We can all agree that after months of polar vortexes and a winter that refused to quit, the idea of hitting the beach sounds pretty terrific, right? Calm, warm waters, gently sloping sand.
							<a href="#" class="more-link">Read More ...</a></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>';

		if ( 'layout-four' == $options['featured_content_layout'] || 'layout-two' == $options['featured_content_layout'] ) {
			$lucida_demo_content .= '
			<article id="featured-post-4" class="post hentry post-demo">
				<figure class="featured-content-image">
					<img alt="Santorini Island" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured4-350x263.jpg" />
				</figure>
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="Santorini Island" href="#">Santorini Island</a>
						</h2>
					</header>
					<div class="entry-summary">
						<p>Santorini is an island in the southern Aegean Sea, about 200 km (120 mi) southeast of Greece\'s mainland. The two main sources of wealth in Santorini are agriculture and tourism. <a href="#" class="more-link">Read More ...</a></p>
					</div><!-- .entry-summary -->
				</div><!-- .entry-container -->
			</article>';
		}

		return $lucida_demo_content;
	}
endif; // lucida_demo_content


if ( ! function_exists( 'lucida_page_post_category_content' ) ) :
	/**
	 * This function to display featured posts/post/category content
	 *
	 * @param $options: lucida_theme_options from customizer
	 *
	 * @since Lucida 0.1
	 */
	function lucida_page_post_category_content( $options ) {
		global $post;

		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$layouts      = 3;
		$quantity     = $options['featured_content_number'];
		$type         = $options['featured_content_type'];
		$show_content = $options['featured_content_show'];

		$output     = '<div class="featured_content_slider_wrap">';

		if ( 'layout-four' == $options['featured_content_layout'] ) {
			$layouts = 4;
		} elseif ( 'layout-two' == $options['featured_content_layout'] ) {
			$layouts = 2;
		}

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		if ( 'page' == $type ) {
			for( $i = 1; $i <= $quantity; $i++ ){
				$post_id = '';

				if ( 'page' == $type ) {
					$post_id = isset( $options['featured_content_page_' . $i] ) ? $options['featured_content_page_' . $i] : false;
				}

				if ( $post_id && '' != $post_id ) {
					$post_list = array_merge( $post_list, array( $post_id ) );

					$no_of_post++;
				}
			}

			$args['post__in'] = $post_list;
		}

		if ( 0 == $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		$i=0;
		while ( $loop->have_posts()) : $loop->the_post(); $i++;
			$title_attribute = the_title_attribute( array( 'before' => esc_html__( 'Permalink to: ', 'lucida' ), 'echo' => false ) );
			$excerpt = get_the_excerpt();
			$output .= '
				<article id="featured-post-' . $i . '" class="post hentry post">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/gallery/no-featured-image-1920x800.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'lucida-landscape', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = lucida_get_first_image( $post->ID, 'lucida-landscape', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-homepage-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image .'
						</a>
					</figure>';

				$output .= '
					<div class="entry-container">
						<header class="entry-header">
							<h2 class="entry-title">
								<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h2>
						</header>';
						if ( 'excerpt' == $show_content ) {
							$output .= '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
						}
						elseif ( 'full-content' == $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
					$output .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-'. $i .' -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // lucida_post_content