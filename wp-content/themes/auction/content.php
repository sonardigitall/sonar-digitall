<div class=" post_warp matchhe large-4 medium-6 columns  wow fadeInLeft page-delay">
                        <div class="blog-one">
                            <div class="blog-one-header">

                                <?php  if ( get_the_post_thumbnail() != '' ) {
						        				echo '<a href="';esc_url( the_permalink()); echo '" >';
							         			the_post_thumbnail();
									  			echo '</a>';
                               					 } else {
    							 				echo '<a href="';esc_url( the_permalink()); echo '" >';
                         						echo '<img  src="';
     											echo  esc_url (advance_catch_that_image());
     											echo '" alt="" />';
								 				echo '</a>';
     									};?>
                            </div>
                            <div class="blog-one-attrib">

                                <span class="blog-author-name">
                                <?php if( has_category() ) { ?><?php $categories = get_the_category();
                                                         $separator = ', ';
 														 $output = '';
											if ( ! empty( $categories ) ) {
    												foreach( $categories as $category ) {
        												$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr(sprintf( __( 'View all posts in %s','auction' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;			}
   														 echo trim( $output, $separator );
														} ?><?php } ?>

                                </span>
                                <span class="blog-date"><?php the_time( get_option('date_format') ); ?></span>
                            </div>
                            <div class="blog-one-body">
                                <h4 class="blog-title"><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></h4>

                                <?php the_excerpt(); ?>

                            </div>
                            <div class="blog-one-footer">
                                <a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr__('Read more','auction');?></a>

                                <i class="fa fa-comments"></i><a href="<?php echo esc_url(get_permalink());?>"><?php comments_popup_link( __('0 Comment', 'auction'), __('1 Comment', 'auction'), __('% Comments', 'auction'), '', __('Off' , 'auction')); ?></a>
                            </div>
                        </div>
                    </div>
