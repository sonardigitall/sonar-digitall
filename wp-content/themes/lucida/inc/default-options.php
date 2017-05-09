<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


/**
 * Returns the default options for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_get_default_theme_options() {
	$theme_data = wp_get_theme();

	$options = array(
		//Site Title an Tagline
		'move_title_tagline'                       => 0,

		//Layout
		'theme_layout'                             => 'three-columns',
		'content_layout'                           => 'excerpt-image-left',
		'single_post_image_layout'                 => 'disabled',

		//Header Image
		'enable_featured_header_image'             => 'disabled',
		'featured_image_size'                      => 'full',
		'featured_header_image_url'                => '',
		'featured_header_image_alt'                => '',
		'featured_header_image_base'               => 0,

		//Breadcrumb Options
		'breadcumb_option'                         => 0,
		'breadcumb_on_homepage'                    => 0,
		'breadcumb_seperator'                      => '&raquo;',

		//Custom CSS
		'custom_css'                               => '',

		//Scrollup Options
		'disable_scrollup'                         => 0,

		//Excerpt Options
		'excerpt_length'                           => '45',
		'excerpt_more_text'                        => esc_html__( 'Read More ...', 'lucida' ),

		//Homepage / Frontpage Settings
		'front_page_category'                      => '0',

		//Pagination Options
		'pagination_type'                          => 'default',

		//Promotion Headline Options
		'promotion_headline_option'                => 'disabled',
		'promotion_headline_left_width'            => '80',
		'promotion_headline'                       => esc_html__( 'Lucida is a Responsive WordPress Theme', 'lucida' ),
		'promotion_subheadline'                    => esc_html__( 'This is promotion headline.', 'lucida' ),
		'promotion_headline_button'                => esc_html__( 'Buy Now', 'lucida' ),
		'promotion_headline_url'                   => esc_url( 'https://catchthemes.com/' ),
		'promotion_headline_target'                => 1,

		//Search Options
		'search_text'                              => esc_html__( 'Search...', 'lucida' ),

		//Fixed Header Top
		'disable_date'                             => 0,
		'disable_social_icons'                     => 0,

		//Basic Color Options
		'color_scheme'                             => 'light',
		'background_color'                         => '#f9f9f9',
		'header_textcolor'                         => '#111111',

		//Header Highlight Content Options
		'header_highlight_content_option'          => 'disabled',
		'header_highlight_content_type'            => 'demo',
		'header_highlight_content_headline'        => '',
		'header_highlight_content_subheadline'     => '',
		'header_highlight_content_number'          => '5',
		'header_highlight_content_show'            => 'hide-content',

		//Featured Content Options
		'featured_content_option'                  => 'disabled',
		'featured_content_layout'                  => 'layout-four',
		'featured_content_position'                => 1,
		'featured_content_headline'                => '',
		'featured_content_subheadline'             => '',
		'featured_content_type'                    => 'demo',
		'featured_content_number'                  => '3',
		'featured_content_show'                    => 'excerpt',

		//News Ticker Options
		'news_ticker_option'                       => 'disabled',
		'news_ticker_position'                     => 'above-content',
		'news_ticker_type'                         => 'demo',
		'news_ticker_label'                        => '',
		'news_ticker_transition_effect'            => 'flipVert',
		'news_ticker_number'                       => '4',

		//Featured Slider Options
		'featured_slider_option'                   => 'disabled',
		'featured_slider_image_loader'             => 'true',
		'featured_slider_transition_effect'        => 'fadeout',
		'featured_slider_transition_delay'         => '4',
		'featured_slider_transition_length'        => '1',
		'featured_slider_type'                     => 'demo',
		'featured_slider_number'                   => '4',
		'featured_slider_content_show'             => 'hide-content',

		//Reset all settings
		'reset_all_settings'                       => 0,
	);

	return apply_filters( 'lucida_default_theme_options', $options );
}

/**
 * Returns an array of layout options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_layouts() {
	$layout_options = array(
		'three-columns'               => esc_html__( 'Three Columns ( Secondary Sidebar, Content, Primary Sidebar )', 'lucida' ),
		'right-sidebar'               => esc_html__( 'Content, Primary Sidebar', 'lucida' ),
		'no-sidebar'                  => esc_html__( 'No Sidebar ( Content Width )', 'lucida' ),
	);
	return apply_filters( 'lucida_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-left'  => esc_html__( 'Excerpt Image Left', 'lucida' ),
		'full-content'        => esc_html__( 'Show Full Content (No Featured Image)', 'lucida' ),
	);

	return apply_filters( 'lucida_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since Lucida 0.1
 */
function lucida_enable_featured_header_image_options() {
	$options = array(
		'homepage'               => esc_html__( 'Homepage / Frontpage', 'lucida' ),
		'exclude-home'           => esc_html__( 'Excluding Homepage', 'lucida' ),
		'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'lucida' ),
		'entire-site'            => esc_html__( 'Entire Site', 'lucida' ),
		'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'lucida' ),
		'pages-posts'            => esc_html__( 'Pages and Posts', 'lucida' ),
		'disabled'               => esc_html__( 'Disabled', 'lucida' ),
	);

	return apply_filters( 'lucida_enable_featured_header_image_options', $options );
}


/**
 * Returns an array of header highlight content types registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_header_highlight_content_types() {
	$options = array(
		'demo'     => esc_html__( 'Demo Content', 'lucida' ),
		'page'     => esc_html__( 'Page Content', 'lucida' ),
	);

	return apply_filters( 'lucida_header_highlight_content_types', $options );
}


/**
 * Returns an array of content and slider layout options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_featured_section_options() {
	$options = array(
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'lucida' ),
		'entire-site' => esc_html__( 'Entire Site', 'lucida' ),
		'disabled'    => esc_html__( 'Disabled', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_section_options', $options );
}


/**
 * Returns an array of news ticker types registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_news_ticker_types() {
	$options = array(
		'demo'     => esc_html__( 'Demo Content', 'lucida' ),
		'page'     => esc_html__( 'Page News Ticker', 'lucida' ),
	);

	return apply_filters( 'lucida_news_ticker_types', $options );
}


/**
 * Returns an array of news ticker positions registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_news_ticker_positions() {
	$options = array(
		'below-menu'    => esc_html__( 'Below Menu', 'lucida' ),
		'above-content' => esc_html__( 'Above Content', 'lucida' ),
	);

	return apply_filters( 'lucida_news_ticker_positions', $options );
}


/**
 * Returns an array of feature content types registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_featured_content_types() {
	$options = array(
		'demo'     => esc_html__( 'Demo Featured Content', 'lucida' ),
		'page'     => esc_html__( 'Featured Page Content', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_content_types', $options );
}


/**
 * Returns an array of featured content options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_featured_content_layout_options() {
	$options = array(
		'layout-two'   => esc_html__( '2 columns', 'lucida' ),
		'layout-three' => esc_html__( '3 columns', 'lucida' ),
		'layout-four'  => esc_html__( '4 columns', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_content_layout_options', $options );
}


/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_featured_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'lucida' ),
		'full-content' => esc_html__( 'Show Full Content', 'lucida' ),
		'hide-content' => esc_html__( 'Hide Content', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_content_show', $options );
}


/**
 * Returns an array of feature slider types registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_featured_slider_types() {
	$options = array(
		'demo'     => esc_html__( 'Demo Featured Slider', 'lucida' ),
		'page'     => esc_html__( 'Featured Page Slider', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_slider_types', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Lucida 0.1
 */
function lucida_featured_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'lucida' ),
		'fadeout'    => esc_html__( 'Fade Out', 'lucida' ),
		'none'       => esc_html__( 'None', 'lucida' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'lucida' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'lucida' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'lucida' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'lucida' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'lucida' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'lucida' ),
		'shuffle'    => esc_html__( 'Shuffle', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_slider_transition_effects', $options );
}

/**
 * Returns an array of featured slider image loader options
 *
 * @since Lucida 0.1
 */
function lucida_featured_slider_image_loader() {
	$options = array(
		'true'  => esc_html__( 'True', 'lucida' ),
		'wait'  => esc_html__( 'Wait', 'lucida' ),
		'false' => esc_html__( 'False', 'lucida' ),
	);

	return apply_filters( 'lucida_featured_slider_image_loader', $options );
}


/**
 * Returns an array of pagination types registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_get_pagination_types() {
	$options = array(
		'default'                => esc_html__( 'Default(Older Posts/Newer Posts)', 'lucida' ),
		'numeric'                => esc_html__( 'Numeric', 'lucida' ),
		'infinite-scroll-click'  => esc_html__( 'Infinite Scroll (Click)', 'lucida' ),
		'infinite-scroll-scroll' => esc_html__( 'Infinite Scroll (Scroll)', 'lucida' ),
	);

	return apply_filters( 'lucida_get_pagination_types', $options );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Lucida 0.1
 */
function lucida_image_sizes_options() {
	$all_sizes = lucida_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')';
	}

	$options['disabled'] = esc_html__( 'Disabled', 'lucida' );
	$options['full']     = esc_html__( 'Full size', 'lucida' );

	return apply_filters( 'lucida_image_sizes_options', $options );
}

/**
 * Returns list of social icons currently supported
 *
 * @since Lucida 0.1
*/
function lucida_get_social_icons_list() {
	$options = array(
		'facebook_link'		=> array(
			'genericon_class' 	=> 'facebook-alt',
			'label' 			=> esc_html__( 'Facebook', 'lucida' )
			),
		'twitter_link'		=> array(
			'genericon_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'lucida' )
			),
		'googleplus_link'	=> array(
			'genericon_class' 	=> 'googleplus-alt',
			'label' 			=> esc_html__( 'Googleplus', 'lucida' )
			),
		'email_link'		=> array(
			'genericon_class' 	=> 'mail',
			'label' 			=> esc_html__( 'Email', 'lucida' )
			),
		'feed_link'			=> array(
			'genericon_class' 	=> 'feed',
			'label' 			=> esc_html__( 'Feed', 'lucida' )
			),
		'wordpress_link'	=> array(
			'genericon_class' 	=> 'wordpress',
			'label' 			=> esc_html__( 'WordPress', 'lucida' )
			),
		'github_link'		=> array(
			'genericon_class' 	=> 'github',
			'label' 			=> esc_html__( 'GitHub', 'lucida' )
			),
		'linkedin_link'		=> array(
			'genericon_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'lucida' )
			),
		'pinterest_link'	=> array(
			'genericon_class' 	=> 'pinterest',
			'label' 			=> esc_html__( 'Pinterest', 'lucida' )
			),
		'flickr_link'		=> array(
			'genericon_class' 	=> 'flickr',
			'label' 			=> esc_html__( 'Flickr', 'lucida' )
			),
		'vimeo_link'		=> array(
			'genericon_class' 	=> 'vimeo',
			'label' 			=> esc_html__( 'Vimeo', 'lucida' )
			),
		'youtube_link'		=> array(
			'genericon_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'lucida' )
			),
		'tumblr_link'		=> array(
			'genericon_class' 	=> 'tumblr',
			'label' 			=> esc_html__( 'Tumblr', 'lucida' )
			),
		'instagram_link'	=> array(
			'genericon_class' 	=> 'instagram',
			'label' 			=> esc_html__( 'Instagram', 'lucida' )
			),
		'polldaddy_link'	=> array(
			'genericon_class' 	=> 'polldaddy',
			'label' 			=> esc_html__( 'PollDaddy', 'lucida' )
			),
		'codepen_link'		=> array(
			'genericon_class' 	=> 'codepen',
			'label' 			=> esc_html__( 'CodePen', 'lucida' )
			),
		'path_link'			=> array(
			'genericon_class' 	=> 'path',
			'label' 			=> esc_html__( 'Path', 'lucida' )
			),
		'dribbble_link'		=> array(
			'genericon_class' 	=> 'dribbble',
			'label' 			=> esc_html__( 'Dribbble', 'lucida' )
			),
		'skype_link'		=> array(
			'genericon_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'lucida' )
			),
		'digg_link'			=> array(
			'genericon_class' 	=> 'digg',
			'label' 			=> esc_html__( 'Digg', 'lucida' )
			),
		'reddit_link'		=> array(
			'genericon_class' 	=> 'reddit',
			'label' 			=> esc_html__( 'Reddit', 'lucida' )
			),
		'stumbleupon_link'	=> array(
			'genericon_class' 	=> 'stumbleupon',
			'label' 			=> esc_html__( 'Stumbleupon', 'lucida' )
			),
		'pocket_link'		=> array(
			'genericon_class' 	=> 'pocket',
			'label' 			=> esc_html__( 'Pocket', 'lucida' ),
			),
		'dropbox_link'		=> array(
			'genericon_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'lucida' ),
			),
		'spotify_link'		=> array(
			'genericon_class' 	=> 'spotify',
			'label' 			=> esc_html__( 'Spotify', 'lucida' ),
			),
		'foursquare_link'	=> array(
			'genericon_class' 	=> 'foursquare',
			'label' 			=> esc_html__( 'Foursquare', 'lucida' ),
			),
		'twitch_link'		=> array(
			'genericon_class' 	=> 'twitch',
			'label' 			=> esc_html__( 'Twitch', 'lucida' ),
			),
		'website_link'		=> array(
			'genericon_class' 	=> 'website',
			'label' 			=> esc_html__( 'Website', 'lucida' ),
			),
		'phone_link'		=> array(
			'genericon_class' 	=> 'phone',
			'label' 			=> esc_html__( 'Phone', 'lucida' ),
			),
		'handset_link'		=> array(
			'genericon_class' 	=> 'handset',
			'label' 			=> esc_html__( 'Handset', 'lucida' ),
			),
		'cart_link'			=> array(
			'genericon_class' 	=> 'cart',
			'label' 			=> esc_html__( 'Cart', 'lucida' ),
			),
		'cloud_link'		=> array(
			'genericon_class' 	=> 'cloud',
			'label' 			=> esc_html__( 'Cloud', 'lucida' ),
			),
		'link_link'		=> array(
			'genericon_class' 	=> 'link',
			'label' 			=> esc_html__( 'Link', 'lucida' ),
			),
	);

	return apply_filters( 'lucida_social_icons_list', $options );
}


/**
 * Returns an array of color schemes registered for parallaxframe.
 *
 * @since Lucida 0.1
 */
function lucida_color_schemes() {
	$options = array(
		'light' => esc_html__( 'Light', 'lucida' ),
		'dark'  => esc_html__( 'Dark', 'lucida' ),
	);

	return apply_filters( 'lucida_color_schemes', $options );
}


/**
 * Returns an array of metabox layout options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'lucida-layout-option',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'lucida' ),
		),
		'three-columns'	=> array(
			'id' 	=> 'lucida-layout-option',
			'value' => 'three-columns',
			'label' => esc_html__( 'Three Columns ( Secondary Sidebar, Content, Primary Sidebar )', 'lucida' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'lucida-layout-option',
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'lucida' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'lucida-layout-option',
			'value' => 'no-sidebar',
			'label' => esc_html__( 'No Sidebar ( Content Width )', 'lucida' ),
		),
	);
	return apply_filters( 'lucida_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_metabox_header_featured_image_options() {
	$options = array(
		'default' => array(
			'id'		=> 'lucida-header-image',
			'value' 	=> 'default',
			'label' 	=> esc_html__( 'Default', 'lucida' ),
		),
		'enable' => array(
			'id'		=> 'lucida-header-image',
			'value' 	=> 'enable',
			'label' 	=> esc_html__( 'Enable', 'lucida' ),
		),
		'disable' => array(
			'id'		=> 'lucida-header-image',
			'value' 	=> 'disable',
			'label' 	=> esc_html__( 'Disable', 'lucida' )
		)
	);
	return apply_filters( 'header_featured_image_options', $options );
}


/**
 * Returns an array of metabox sidebar options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_metabox_sidebar_options() {
	$options = array(
		'main-sidebar' => array(
			'id'		=> 'lucida-sidebar-options',
			'value' 	=> 'default-sidebar',
			'label' 	=> esc_html__( 'Default Sidebar', 'lucida' )
		),
		'optional-sidebar-one' => array(
			'id' 	=> 'lucida-sidebar-options',
			'value' => 'optional-sidebar-one',
			'label' => esc_html__( 'Optional Sidebar One', 'lucida' )
		),
		'optional-sidebar-two' => array(
			'id' 	=> 'lucida-sidebar-options',
			'value' => 'optional-sidebar-two',
			'label' => esc_html__( 'Optional Sidebar Two', 'lucida' )
		),
		'optional-sidebar-three' => array(
			'id' 	=> 'lucida-sidebar-options',
			'value' => 'optional-sidebar-three',
			'label' => esc_html__( 'Optional Sidebar three', 'lucida' )
		)
	);
	return apply_filters( 'sidebar_options', $options );
}


/**
 * Returns an array of metabox featured image options registered for Lucida.
 *
 * @since Lucida 0.1
 */
function lucida_metabox_featured_image_options() {
	$options['default'] = array(
		'id'	=> 'lucida-featured-image',
		'value' => 'default',
		'label' => esc_html__( 'Default', 'lucida' ),
	);

	$all_sizes = lucida_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = array(
			'id'	=> 'lucida-featured-image',
			'value' => $key,
			'label' => esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')'
		);

	}

	$options['full'] = array(
		'id'	=> 'lucida-featured-image',
		'value'	=> 'full',
		'label' => esc_html__( 'Full Image', 'lucida' ),
	);

	$options['disabled'] = array(
		'id' 	=> 'lucida-featured-image',
		'value' => 'disabled',
		'label' => esc_html__( 'Disable Image', 'lucida' )
	);

	return apply_filters( 'lucida_metabox_featured_image_options', $options );
}


/**
 * Returns the default options for Lucida dark theme.
 *
 * @since Lucida 0.1
 */
function lucida_default_dark_color_options() {
	$options = array(
		//Basic Color Options
		'background_color' => '#333333',
		'header_textcolor' => '#111111',

	);

	return apply_filters( 'lucida_default_dark_color_options', $options );
}

/**
 * Returns footer content
 *
 * @since Lucida
 */
function lucida_get_content() {
	$theme_data = wp_get_theme();

	return sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'lucida' ), date_i18n( __( 'Y', 'lucida' ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' ) . ' &#124; ' . $theme_data->get( 'Name') . '&nbsp;' . esc_html__( 'by', 'lucida' ). '&nbsp;<a target="_blank" href="'. $theme_data->get( 'AuthorURI' ) .'">'. $theme_data->get( 'Author' ) .'</a>';
}

