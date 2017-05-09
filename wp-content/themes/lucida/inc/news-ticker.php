<?php
/**
 * The template for displaying the News Ticker
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( !function_exists( 'lucida_news_ticker_display' ) ) :
/**
* Add News Ticker
*
* @uses action hook lucida_before_content.
*
* @since Lucida 0.1
*/
function lucida_news_ticker_display() {
	//lucida_flush_transients();
	global $wp_query;

	// get data value from options
	$options        = lucida_get_theme_options();
	$enable_content = $options['news_ticker_option'];
	$content_select = $options['news_ticker_type'];

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
		if ( ( ! $output = get_transient( 'lucida_news_ticker' ) ) ) {

			$headline = $options['news_ticker_label'];

			echo '<!-- refreshing cache -->';


			if ( 'demo' == $content_select ) {
				$headline 		= esc_html__( 'The Latest News', 'lucida' );
			}

			$output ='
				<div id="news-ticker" class="' . esc_attr( $content_select ) . '">
					<div class="wrapper">';
						if ( !empty( $headline ) ) {
							$output .='<h3 class="news-ticker-label">'. $headline .'</h3>';
						}
						$output .='

						<div class="new-ticket-content">
							<div class="news-ticker-slider cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-auto-height=container
								data-cycle-slides="> h3"
								data-cycle-fx="'. esc_attr( $options['news_ticker_transition_effect'] ) .'"
								>';

								// Select content
								if ( 'demo' == $content_select ) {
									$output .= lucida_demo_ticker();
								}
								elseif ( 'page' == $content_select ) {
									$output .= lucida_post_page_category_ticker( $options );
								}

				$output .='
							</div><!-- .news-ticker-slider -->
						</div><!-- .new-ticket-content -->
					</div><!-- .wrapper -->
				</div><!-- #news-ticker -->';
			set_transient( 'lucida_news_ticker', $output, 86940 );

		}

		echo $output;
	}
}
endif;


if ( ! function_exists( 'lucida_news_ticker_display_position' ) ) :
	/**
	 * Homepage Featured Content Position
	 *
	 * @action lucida_content, lucida_after_secondary
	 *
	 * @since Lucida 0.1
	 */
	function lucida_news_ticker_display_position() {
		// Getting data from Theme Options
		$options 		= lucida_get_theme_options();

		$news_ticker_position = $options['news_ticker_position'];

		if ( 'below-menu' == $news_ticker_position ) {
			add_action( 'lucida_after_header', 'lucida_news_ticker_display', 40 );
		} else {
			add_action( 'lucida_content', 'lucida_news_ticker_display', 10 );
		}

	}
endif; // lucida_news_ticker_display_position
add_action( 'lucida_before', 'lucida_news_ticker_display_position' );


if ( ! function_exists( 'lucida_demo_ticker' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @get the data value from customizer options
	 *
	 * @since Lucida 0.1
	 *
	 */
	function lucida_demo_ticker() {
		return '<h3 class="news-ticker-title displayblock">
					<a href="#">
						Solar plane lands in Arizona on latest leg of around the world flight.
					</a>
				</h3>
				<h3 class="news-ticker-title displaynone">
					<a href="#">
						Murray Beats Nadal To Move Into Madrid Final
					</a>
				</h3>
				<h3 class="news-ticker-title displaynone">
					<a href="#">
						Baby Rescued From Rubble Nearly Four Days After Kenya Building Collapse
					</a>
				</h3>
				<h3 class="news-ticker-title displaynone">
					<a href="#">
						Six of the Greatest Legends in Rock History to Gather for 3-Day Concert in October
					</a>
				</h3>';
	}
endif; // lucida_demo_content


if ( ! function_exists( 'lucida_post_page_category_ticker' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: lucida_theme_options from customizer
	 *
	 * @since Lucida 0.1
	 */
	function lucida_post_page_category_ticker( $options ) {
		global $post;

		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$quantity   = $options['news_ticker_number'];
		$type       = $options['news_ticker_type'];
		$output     = '';

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
					$post_id = isset( $options['news_ticker_page_' . $i] ) ? $options['news_ticker_page_' . $i] : false;
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

		while ( $loop->have_posts() ) {
			$loop->the_post();

			if ( $i == 1 ) {
				$classes = 'new-ticker-text text-'. $i .' news-ticker-title displayblock';
			} else {
				$classes = 'new-ticker-text text-'.  $i .' news-ticker-title displaynone';
			}

			$output .= '
			<h3 class="' . $classes . '">
				<a href="'. esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
			</h3>';

			$i++;
		} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // lucida_post_page_category_ticker