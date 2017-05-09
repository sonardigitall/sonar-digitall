<?php
/**
 * The template for displaying the Slider
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */

if ( !function_exists( 'lucida_featured_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook lucida_before_content.
 *
 * @since Lucida 0.1
 */
function lucida_featured_slider() {
	global $wp_query;
	//lucida_flush_transients();
	// get data value from options
	$options 		= lucida_get_theme_options();
	$enable_slider 	= $options['featured_slider_option'];
	$slider_select 	= $options['featured_slider_type'];
	$image_loader	= $options['featured_slider_image_loader'];

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	if ( 'entire-site' == $enable_slider || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_slider ) ) {
		if ( ( !$output = get_transient( 'lucida_featured_slider' ) ) ) {
			echo '<!-- refreshing cache -->';

			$output = '
				<section id="feature-slider">
					<div class="wrapper">
						<div class="cycle-slideshow"
						    data-cycle-log="false"
						    data-cycle-pause-on-hover="true"
						    data-cycle-swipe="true"
						    data-cycle-auto-height=container
						    data-cycle-fx="'. esc_attr( $options['featured_slider_transition_effect'] ) .'"
							data-cycle-speed="'. esc_attr( $options['featured_slider_transition_length'] ) * 1000 .'"
							data-cycle-timeout="'. esc_attr( $options['featured_slider_transition_delay'] ) * 1000 .'"
							data-cycle-loader="'. esc_attr( $image_loader ) .'"
							data-cycle-slides="> article"
							>

						    <!-- prev/next links -->
						    <div class="cycle-prev"></div>
						    <div class="cycle-next"></div>

						    <!-- empty element for pager links -->
	    					<div class="cycle-pager"></div>';
							// Select Slider
							if ( 'demo' == $slider_select ) {
								$output .= lucida_demo_slider( $options );
							}
							elseif ( 'page' == $slider_select ) {
								$output .= lucida_post_page_category_slider( $options );
							}

			$output .= '
						</div><!-- .cycle-slideshow -->
					</div><!-- .wrapper -->
				</section><!-- #feature-slider -->';

			set_transient( 'lucida_featured_slider', $output, 86940 );
		}
		echo $output;
	}
}
endif;
add_action( 'lucida_before_content', 'lucida_featured_slider', 10 );


if ( ! function_exists( 'lucida_demo_slider' ) ) :
	/**
	 * This function to display featured posts slider
	 *
	 * @get the data value from customizer options
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_demo_slider() {
		return '
		<article class="post demo-image-1 hentry slides displayblock">
			<figure class="slider-image">
				<a title="Slider Image 1" href="'. esc_url( home_url( '/' ) ) .'">
					<img src="'.get_template_directory_uri().'/images/gallery/slider1-1920x800.jpg" class="wp-post-image" alt="Mountain" title="Mountain">
				</a>
			</figure>
			<div class="slider-content-wrapper">
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="Slider Image 1" href="#"><span>Mountain</span></a>
						</h2>
						<p class="entry-meta">
							<span class="cat-links">
								<span class="screen-reader-text">Categories</span>
								<a rel="category tag" href="#">Travel</a>
							</span>
							<span class="posted-on">
								<span class="screen-reader-text">Posted on</span>

								<a rel="bookmark" href="#">
									<time datetime="2016-05-15T04:29:55+00:00" class="entry-date published">May 7, 2016</time>

									<time datetime="2016-05-08T08:47:27+00:00" class="updated">May 7, 2016</time>
								</a>
							</span>
						</p><!-- .entry-meta -->
					</header>
				</div><!-- .entry-container -->
			</div><!-- .slider-content-wrapper -->
		</article><!-- .slides -->

		<article class="post demo-image-2 hentry slides displaynone">
			<figure class="slider-image">
				<a title="Ocean" href="'. esc_url( home_url( '/' ) ) .'">
					<img src="'. get_template_directory_uri() . '/images/gallery/slider2-1920x800.jpg" class="wp-post-image" alt="SOcean" title="Ocean">
				</a>
			</figure>

			<div class="slider-content-wrapper">
				<div class="entry-container">
					<header class="entry-header">
						<h2 class="entry-title">
							<a title="Ocean" href="#"><span>Ocean</span></a>
						</h2>
						<p class="entry-meta">
							<span class="cat-links">
								<span class="screen-reader-text">Categories</span>
								<a rel="category tag" href="#">Travel</a>
							</span>
							<span class="posted-on">
								<span class="screen-reader-text">Posted on</span>

								<a rel="bookmark" href="#">
									<time datetime="2016-05-15T04:29:55+00:00" class="entry-date published">May 7, 2016</time>

									<time datetime="2016-05-08T08:47:27+00:00" class="updated">May 7, 2016</time>
								</a>
							</span>
						</p><!-- .entry-meta -->
					</header>
				</div><!-- .entry-container -->
			</div><!-- .slider-content-wrapper -->
		</article><!-- .slides -->';
	}
endif; // lucida_demo_slider


if ( ! function_exists( 'lucida_post_page_category_slider' ) ) :
	/**
	 * This function to display featured posts/page/category slider
	 *
	 * @param $options: lucida_theme_options from customizer
	 *
	 * @since Lucida 0.1
	 */
	function lucida_post_page_category_slider( $options ) {
		global $post;

		$quantity     = $options['featured_slider_number'];
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$type         = $options['featured_slider_type'];
		$show_content = $options['featured_slider_content_show'];
		$output       = '';

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		if ( 'page' == $type  ) {
			for( $i = 1; $i <= $quantity; $i++ ){
				$post_id = '';

				if ( 'page' == $type ) {
					$post_id = isset( $options['featured_slider_page_' . $i] ) ? $options['featured_slider_page_' . $i] : false;
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
			if ( $i == 1 ) { $classes = 'post post-'.$post->ID.' hentry slides displayblock'; } else { $classes = 'post post-'.$post->ID.' hentry slides displaynone'; }

			$output .= '
			<article class="'.$classes.'">
				<figure class="slider-image">';
				if ( has_post_thumbnail() ) {
					$output .= '<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">
						'. get_the_post_thumbnail( $post->ID, 'lucida-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class'	=> 'attached-post-image' ) ).'
					</a>';
				}
				else {
					//Default value if there is no first image
					$lucida_image = '<img class="wp-post-image" src="'.get_template_directory_uri().'/images/gallery/no-featured-image-1920x800.jpg" >';

					//Get the first image in page, returns false if there is no image
					$lucida_first_image = lucida_get_first_image( $post->ID, 'lucida-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class' => 'attached-post-image' ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $lucida_first_image ) {
						$lucida_image =	$lucida_first_image;
					}

					$output .= '<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">
						'. $lucida_image .'
					</a>';
				}

				$output .= '
				</figure><!-- .slider-image -->
				<div class="slider-content-wrapper">
					<div class="entry-container">
						<header class="entry-header">
							<h2 class="entry-title">
								<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'.the_title( '<span>','</span>', false ).'</a>
							</h2>
							<p class="entry-meta">' . lucida_page_post_meta() . '</p><!-- .entry-meta -->
						</header>
							';
						if ( 'excerpt' == $show_content ) {
							$excerpt = get_the_excerpt();

							$output .= '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
						} elseif ( 'full-content' == $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
						$output .= '
					</div><!-- .entry-container -->
				</div><!-- .slider-content-wrapper -->
			</article><!-- .slides -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // lucida_post_page_category_slider