<?php
/**
 * The template for displaying Social Icons
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( ! function_exists( 'lucida_get_social_icons' ) ) :
/**
 * Generate social icons.
 *
 * @since Lucida 0.1
 */
function lucida_get_social_icons(){
	if ( ( !$output = get_transient( 'lucida_social_icons' ) ) ) {
		$output  = '';
		$options = lucida_get_theme_options(); // Get options

		//Pre defined Social Icons Link Start
		$pre_def_icons = lucida_get_social_icons_list();
		foreach ( $pre_def_icons as $key => $item ) {
			if ( isset( $options[ $key ] ) && '' != $options[ $key ] ) {
				$value = $options[ $key ];
				if ( 'email_link' == $key  ) {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr__( 'Email', 'lucida') . '" href="mailto:'. esc_attr( antispambot( sanitize_email( $value ) ) ) .'"><span class="screen-reader-text">'. esc_html__( 'Email', 'lucida') . '</span> </a>';
				}
				elseif ( 'skype_link' == $key  ) {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="'. esc_attr( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ). '</span> </a>';
				}
				elseif ( 'phone_link' == $key || 'handset_link' == $key ) {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="tel:' . preg_replace( '/\s+/', '', esc_attr( $value ) ) . '"><span class="screen-reader-text">'. esc_attr( $item['label'] ) . '</span> </a>';
				}
				else {
					$output .= '<a class="genericon_parent genericon genericon-'. sanitize_key( $item['genericon_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) .'" href="'. esc_url( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ) .'</span> </a>';
				}
			}
		}
		//Pre defined Social Icons Link End
		set_transient( 'lucida_social_icons', $output, 86940 );
	}
	return $output;
} // lucida_get_social_icons
endif;