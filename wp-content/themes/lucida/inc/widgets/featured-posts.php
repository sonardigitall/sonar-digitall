<?php
/**
 * Featured Post Widget
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


/**
 * Featured Post widget class
 *
 * @since Lucida 0.1
 */
class lucida_featured_post_widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title'           => '',
			'post_type'       => 'all-category',
			'post_id'         => '',
			'category'        => array(),
			'post_number'     => 1,
			'order'     	  => 'DESC',
			'orderby'     	  => 'date',
			'layout'     	  => 'one-column',
			'disable_image'   => 0,
			'image_alignment' => 'left',
			'image_size'      => '',
			'disable_title'   => 0,
			'hide_category'   => 0,
			'hide_tags'       => 1,
			'hide_posted_on'  => 1,
			'hide_author'     => 1,
			'content_type'    => '',
			'content_limit'   => 200,
			'more_text'       => __( 'Read More ...', 'lucida' ),
		);

		$widget_ops = array(
			'classname'   => 'ct-featured-post ctfeaturedpostpageimage',
			'description' => __( 'Displays featured posts with thumbnails', 'lucida' ),
		);

		$control_ops = array(
			'id_base' => 'ct-featured-post',
		);

		parent::__construct(
			'ct-featured-post', // Base ID
			__( 'CT: Featured Posts', 'lucida' ), // Name
			$widget_ops,
			$control_ops
		);
	}

	function form( $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$style = 'style="display: none;"';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'lucida' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Select Posts From', 'lucida' ); ?>:</label>
			<select class="ct_feat_post_post_type widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<?php
					$post_type_choices = array(
						'all-categories'  => esc_html__( 'All Categories', 'lucida' ),
						'select-category' => esc_html__( 'Select Category', 'lucida' ),
						'id'              => esc_html__( 'ID', 'lucida' ),
					);

				foreach ( $post_type_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['post_type'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p <?php echo ( 'id' == $instance['post_type'] )? '' : $style;  ?>>
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Post ID', 'lucida' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo sanitize_text_field( $instance['post_id'] ); ?>" class="widefat"/>
			<span class="description"><?php _e( 'Separate Multiple Post IDs by ,(comma)', 'lucida' ); ?></span>
		</p>

        <p <?php echo ( 'select-category' == $instance['post_type'] )? '': $style; ?>>
        	<?php
        		lucida_dropdown_categories(
        			$this->get_field_name( 'category[]' ),
        			$this->get_field_id( 'category' ),
        			(array) $instance['category']
        		);
        	?>
        </p>

        <p <?php echo ( 'id' == $instance['post_type'] )? $style : '';  ?>>
			<label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'No. of Posts', 'lucida' ); ?>:</label>
			<input type="number" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" value="<?php echo absint( $instance['post_number'] ); ?>" class="small-text" min="1" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By', 'lucida' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
				<?php
					$choices = array(
						'date'   => __( 'Date', 'lucida' ),
						'ID'   => __( 'ID', 'lucida' ),
						'author'   => __( 'Author', 'lucida' ),
						'title'   => __( 'title', 'lucida' ),
						'name'   => __( 'Name', 'lucida' ),
						'comment_count'   => __( 'Comment Count', 'lucida' ),
						'rand'   => __( 'Random', 'lucida' ),
					);

				foreach ( $choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['orderby'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order', 'lucida' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat">
				<?php
					$choices = array(
						'DESC'   => __( 'Descending (3, 2, 1)', 'lucida' ),
						'ASC'   => __( 'Ascending (1, 2, 3)', 'lucida' ),
					);

				foreach ( $choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['order'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e( 'Layout', 'lucida' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" class="widefat">
				<?php
					$post_type_choices = array(
						'one-column'   => __( '1 Column', 'lucida' ),
						'two-column'   => __( '2 Column', 'lucida' ),
						'three-column' => __( '3 Column', 'lucida' ),
						'four-column'  => __( '4 Column', 'lucida' ),
					);

				foreach ( $post_type_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['layout'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p>
        	<input class="checkbox ct_feat_post_disable_image" type="checkbox" <?php checked($instance['disable_image'], true) ?> id="<?php echo $this->get_field_id( 'disable_image' ); ?>" name="<?php echo $this->get_field_name( 'disable_image' ); ?>" />
        	<label for="<?php echo $this->get_field_id('disable_image'); ?>"><?php _e( 'Check to Disable Image', 'lucida' ); ?></label><br />
        </p>

        <p <?php echo ( $instance['disable_image'] )? $style : '';  ?>>
			<label for="<?php echo $this->get_field_id( 'image_alignment' ); ?>"><?php _e( 'Image Alignment', 'lucida' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'image_alignment' ); ?>" name="<?php echo $this->get_field_name( 'image_alignment' ); ?>" class="widefat">
				<?php
					$image_alignment_choices = array(
						'top'    => __( 'Top', 'lucida' ),
						'left'   => __( 'Left', 'lucida' ),
						'right'  => __( 'Right', 'lucida' ),
						'center' => __( 'Center', 'lucida' ),
					);

				foreach ( $image_alignment_choices as $key => $value ) {
					echo '<option value="' . $key . '" '. selected( $key, $instance['image_alignment'], false ) .'>' . $value .'</option>';
				}
				?>
			</select>
		</p>

		<p <?php echo ( $instance['disable_image'] )? $style : '';  ?>>
			<label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image Size', 'lucida' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'image_size' ); ?>" class="lucida-image-size-selector" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
				<?php
				$sizes = lucida_get_additional_image_sizes();
				foreach( (array) $sizes as $name => $size )
					echo '<option value="'.esc_attr( $name ).'" '.selected( $name, $instance['image_size'], FALSE ).'>'.esc_html( $name ).' ( '.$size['width'].'x'.$size['height'].' )</option>';
				?>
			</select>
		</p>

        <p>
        	<input class="checkbox" type="checkbox" <?php checked($instance['disable_title'], true) ?> id="<?php echo $this->get_field_id( 'disable_title' ); ?>" name="<?php echo $this->get_field_name( 'disable_title' ); ?>" />
        	<label for="<?php echo $this->get_field_id('disable_title'); ?>"><?php _e( 'Check to Disable Title', 'lucida' ); ?></label><br />
        </p>

        <p>
			<span class="description"><?php _e( 'Post Meta Info', 'lucida' ); ?></span><br/>
			<input class="checkbox" type="checkbox" <?php checked($instance['hide_category'], true) ?> id="<?php echo $this->get_field_id( 'hide_category' ); ?>" name="<?php echo $this->get_field_name( 'hide_category' ); ?>" />
        	<label for="<?php echo $this->get_field_id('hide_category'); ?>"><?php _e( 'Check to Hide Category', 'lucida' ); ?></label><br />
        	<input class="checkbox" type="checkbox" <?php checked($instance['hide_tags'], true) ?> id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" />
        	<label for="<?php echo $this->get_field_id('hide_tags'); ?>"><?php _e( 'Check to Hide Tags', 'lucida' ); ?></label><br />
        	<input class="checkbox" type="checkbox" <?php checked($instance['hide_posted_on'], true) ?> id="<?php echo $this->get_field_id( 'hide_posted_on' ); ?>" name="<?php echo $this->get_field_name( 'hide_posted_on' ); ?>" />
        	<label for="<?php echo $this->get_field_id('hide_posted_on'); ?>"><?php _e( 'Check to Hide Posted On Date', 'lucida' ); ?></label><br />
        	<input class="checkbox" type="checkbox" <?php checked($instance['hide_author'], true) ?> id="<?php echo $this->get_field_id( 'hide_author' ); ?>" name="<?php echo $this->get_field_name( 'hide_author' ); ?>" />
        	<label for="<?php echo $this->get_field_id('hide_author'); ?>"><?php _e( 'Check Hide to Author', 'lucida' ); ?></label><br />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'content_type' ); ?>"><?php _e( 'Content Type', 'lucida' ); ?>:</label>
			<select class="ct_feat_post_content_type" id="<?php echo $this->get_field_id( 'content_type' ); ?>" name="<?php echo $this->get_field_name( 'content_type' ); ?>">
				<option value="content" <?php selected( 'content', $instance['content_type'] ); ?>><?php _e( 'Show Content', 'lucida' ); ?></option>
				<option value="excerpt" <?php selected( 'excerpt', $instance['content_type'] ); ?>><?php _e( 'Show Excerpt', 'lucida' ); ?></option>
				<option value="content-limit" <?php selected( 'content-limit', $instance['content_type'] ); ?>><?php _e( 'Show Content Limit', 'lucida' ); ?></option>
				<option value="" <?php selected( '', $instance['content_type'] ); ?>><?php _e( 'No Content', 'lucida' ); ?></option>
			</select>
			<br />
			<label <?php echo ( 'content-limit' != $instance['content_type'] )? $style : '';  ?>for="<?php echo $this->get_field_id( 'content_limit' ); ?>"><?php _e( 'Limit content to', 'lucida' ); ?>
				<input type="text" id="<?php echo $this->get_field_id( 'content_limit' ); ?>" name="<?php echo $this->get_field_name( 'content_limit' ); ?>" value="<?php echo esc_attr( intval( $instance['content_limit'] ) ); ?>" size="3" />
				<?php _e( 'characters', 'lucida' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text (if applicable)', 'lucida' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo esc_html( $instance['more_text'] ); ?>" />
		</p>

		<script>
		jQuery(document).ready(function($){
			post_type = $( '.ct_feat_post_post_type' );

			post_type.change(function(){
				post_type_val = $(this).val();
				post_id      = $(this).parent().next();
				multi_cat_id = $(this).parent().next().next();
				post_no_id   = $(this).parent().next().next().next();

				if ( 'all-categories' == post_type_val ) {
					post_id.hide();
					multi_cat_id.hide();
					post_no_id.show();
				}
				else if ( 'id' == post_type_val ) {
					post_id.show();
					multi_cat_id.hide();
					post_no_id.hide();
				}
				else if ( 'select-category' == post_type_val ) {
					post_id.hide();
					multi_cat_id.show();
					post_no_id.show();
				}
				return false;
			});

			disable_image = $( '.ct_feat_post_disable_image' );
			disable_image.change(function(){
				image_alignment = $(this).parent().next();
				image_size = $(this).parent().next().next();

				if ( $(this).is(':checked') ) {
					image_alignment.hide();
					image_size.hide();
				}
				else {
					image_alignment.show();
					image_size.show();
				}
				return false;
			});

			content_type = $( '.ct_feat_post_content_type' );
			content_type.change(function(){
				content_type_val = $(this).val();
				content_limit = $(this).next().next();

				if ( 'content-limit' == content_type_val ) {
					content_limit.show();
				}
				else {
					content_limit.hide();
				}
				return false;
			});
		});
		</script>
       	<?php
	}

	function update( $new_instance, $old_instance ) {

		$instance                    = $old_instance;
		$instance['title']           = sanitize_text_field( $new_instance['title'] );
		$instance['post_type']       = sanitize_key( $new_instance['post_type'] );
		$instance['post_id']         = sanitize_text_field( $new_instance['post_id'] );
		$instance['category']        = ( array ) $new_instance['category'];
		$instance['post_number']     = absint( $new_instance['post_number'] );
		$instance['order']           = sanitize_key( $new_instance['order'] );
		$instance['orderby']         = sanitize_key( $new_instance['orderby'] );
		$instance['layout']          = sanitize_key( $new_instance['layout'] );
		$instance['disable_image']   = lucida_sanitize_checkbox( $new_instance['disable_image'] );
		$instance['image_alignment'] = sanitize_key( $new_instance['image_alignment'] );
		$instance['image_size']      = sanitize_key( $new_instance['image_size'] );
		$instance['disable_title']   = lucida_sanitize_checkbox( $new_instance['disable_title'] );
		$instance['hide_category']   = lucida_sanitize_checkbox( $new_instance['hide_category'] );
		$instance['hide_tags']       = lucida_sanitize_checkbox( $new_instance['hide_tags'] );
		$instance['hide_posted_on']  = lucida_sanitize_checkbox( $new_instance['hide_posted_on'] );
		$instance['hide_author']     = lucida_sanitize_checkbox( $new_instance['hide_author'] );
		$instance['content_type']    = sanitize_key( $new_instance['content_type'] );
		$instance['content_limit']   = absint( $new_instance['content_limit'] );
		$instance['more_text']       = sanitize_text_field( $new_instance['more_text'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		global $post;

		$output ='';

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$output .= $args['before_widget'];

		// Set up the author bio
		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
		}

		$query_args = array(
			'post_type'           => 'post',
			'order'               => $instance['order'],
			'orderby'             => $instance['orderby'],
			'ignore_sticky_posts' => '1',
		);

		if ( 'id' == $instance['post_type'] ) {
			$post_id_array = explode( ',', $instance['post_id'] );
			$query_args['post__in'] = $post_id_array;
		}
		elseif ( 'select-category' == $instance['post_type'] ) {
			$query_args['category__in']    = ( array ) $instance['category'];
			$query_args['posts_per_page'] = absint( $instance['post_number'] );
		}
		else {
			$query_args['posts_per_page'] = absint( $instance['post_number'] );
		}

		$loop = new WP_Query( $query_args );

		if ( $loop->have_posts() ) :
			$output .= '<div class="article-wrap ' . esc_attr( $instance['layout'] ) . ' '. esc_attr( $instance['image_alignment'] ) . ' ' . esc_attr( $instance['image_size'] ) .'">';
				while ( $loop->have_posts() ) {
					$loop->the_post();

					$class = 'post-'. $post->ID . ' post type-post hentry';

					if ( $instance['disable_image'] || !has_post_thumbnail() ) {
						$class .= " no-featured-image";
					}

					$output .= '
					<article class="' . esc_attr( $class ) . '">';

						$title_attribute = the_title_attribute( 'echo=0' );

						if ( !$instance['disable_image'] && has_post_thumbnail() ) {
							$output.= '
							<figure class="featured-image">
								<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">' .
									get_the_post_thumbnail(
										$post->ID,
										$instance['image_size']
										) .'
								</a>
							</figure>';
						}

						$output .= '<div class="entry-container">';

						$output .= '<header class="entry-header">';

						if ( !$instance['disable_title'] ) {
							$output .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="'. $title_attribute .'">'. get_the_title() .'</a></h2>';
						}

						if (
							$instance['hide_category'] &&
							$instance['hide_tags'] &&
							$instance['hide_posted_on'] &&
							$instance['hide_author'] ) {
						}

						$output .= lucida_get_highlight_meta(
									$instance['hide_category'],
									$instance['hide_tags'],
									$instance['hide_posted_on'],
									$instance['hide_author']
								);

						$output .= '</header><!-- .entry-header -->';

						if ( 'excerpt' == $instance['content_type'] ) {
							$output .= '<div class="entry-summary">';
							$output .= '<p>' . get_the_excerpt() . '</p>';
							$output .= '</div><!-- .entry-summary -->';
						}
						elseif ( 'content-limit' == $instance['content_type'] ) {
							$output .= '<div class="entry-summary">';
							$output .= lucida_get_the_content_limit( (int) $instance['content_limit'], esc_html( $instance['more_text'] ) );
							$output .= '</div><!-- .entry-summary -->';
						}

						elseif ( 'content' == $instance['content_type'] ) {
							$output .= '<div class="entry-content">';
							$output .= get_the_content( esc_html( $instance['more_text'] ) );
							$output .= '</div><!-- .entry-content -->';

						}

						$output .= '</div><!-- .entry-container -->';
					$output .= '</article><!-- .type-post -->';
				} //endwhile
			$output .= '</div><!-- .article-wrap -->';
		endif;

		//* Restore original query
		wp_reset_postdata();

		$output .= $args['after_widget'];

		echo $output;
	}
}

/**
 * Register Featured Post Widget
 */
function lucida_register_featured_post_widget() {
    register_widget( 'lucida_featured_post_widget' );
}
add_action( 'widgets_init', 'lucida_register_featured_post_widget' );