<?php
/**
 * Social Icons Widget
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


/**
 * Adds Lucida Social Icons widget.
 *
 * @since Lucida 0.1
 */
class lucida_social_icons_widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title'			=> '',
			'content'		=> '',
			'contentformat'	=> 1
		);

		$widget_ops = array(
			'classname'   => 'ct-social-widget widget_lucida_social_icons',
			'description' => __( 'Use this widget to add short Information and Social Icons', 'lucida' ),
		);

		$control_ops = array(
			'id_base' => 'ct-social',
		);

		parent::__construct(
			'ct-social', // Base ID
			__( 'CT: Social Icons', 'lucida' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, code, alt
	 * $instance Current settings
	 */
	function form($instance) {
		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'lucida' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
        <?php
	}

	/**
	 * update the particular instant
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']        	= sanitize_text_field( $new_instance['title'] );
		$instance['content']        = wp_kses_post( $new_instance['content'] );
		$instance['contentformat']	= lucida_sanitize_checkbox( $new_instance['contentformat'] );

		return $instance;
	}

	/**
	 * Displays the Widget in the front-end.
	 *
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
			}

			echo '
			<div class="social-content-wrap">
				<div class="social-icons">' . lucida_get_social_icons() . '</div><!-- .social-icons -->
			</div><!-- .social-content-wrap -->';

		echo $args['after_widget'];
	}

}

/**
 * Register Social Icons Widget
 */
function lucida_register_social_icons_widget() {
    register_widget( 'lucida_social_icons_widget' );
}
add_action( 'widgets_init', 'lucida_register_social_icons_widget' );