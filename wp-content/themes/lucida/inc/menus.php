<?php
/**
 * The template for displaying custom menus
 *
 * @package Catch Themes
 * @subpackage Lucida
 * @since Lucida 0.1
 */


if ( ! function_exists( 'lucida_primary_menu' ) ) :
/**
 * Shows the Primary Menu
 *
 * default load in sidebar-header-right.php
 */
function lucida_primary_menu() {
    ?>
    <div id="primary-menu">
        <div class="wrapper">
            <button id="menu-toggle-primary" class="menu-toggle"><?php esc_html_e( 'Menu', 'lucida' ); ?></button>

            <div id="site-header-menu" class="menu-primary">
                <nav id="site-navigation" class="main-navigation nav-primary search-enabled" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'lucida' ); ?>">
                    <h3 class="screen-reader-text"><?php _e( 'Primary menu', 'lucida' ); ?></h3>
                    <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            $args = array(
                                'theme_location'    => 'primary',
                                'menu_class'        => 'menu lucida-nav-menu',
                                'container'         => false
                            );
                            wp_nav_menu( $args );
                        }
                        else {
                            wp_page_menu( array( 'menu_class'  => 'default-page-menu' ) );
                        }
                        ?>
                    <div id="search-toggle" class="genericon">
                        <a class="screen-reader-text" href="#search-container"><?php esc_html_e( 'Search', 'lucida' ); ?></a>
                    </div>

                    <div id="search-container" class="displaynone">
                        <?php get_Search_form(); ?>
                    </div>
                </nav><!-- .nav-primary -->
            </div><!-- #site-header-menu -->
        </div><!-- .wrapper -->
    </div><!-- #primary-menu-wrapper -->
    <?php
}
endif; //lucida_primary_menu
add_action( 'lucida_after_header', 'lucida_primary_menu', 20 );


if ( ! function_exists( 'lucida_add_page_menu_class' ) ) :
/**
 * Filters wp_page_menu to add menu class  for default page menu
 *
 */
function lucida_add_page_menu_class( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul class="menu lucida-nav-menu">', $ulclass, 1 );
}
endif; //lucida_add_page_menu_class
add_filter( 'wp_page_menu', 'lucida_add_page_menu_class', 90 );


if ( ! function_exists( 'lucida_header_top_menu' ) ) :
/**
 * Shows the Header Top Menu
 *
 * default load in sidebar-header-top.php
 */
function lucida_header_top_menu() {
    $options      = lucida_get_theme_options();
    $social_icons = lucida_get_social_icons();

    if ( has_nav_menu( 'header-top' ) || ( !$options['disable_social_icons'] && '' != $social_icons ) ) {
    ?>
    <div id="header-top-menu">
        <?php if ( has_nav_menu( 'header-top' ) ) { ?>
            <button id="menu-toggle-header-top" class="menu-toggle main-navigation"><?php esc_html_e( 'Menu', 'lucida' ); ?></button>
            <div id="site-header-top-menu">
                <nav id="nav-header-top" class="nav-header-top" role="navigation" aria-label="<?php esc_attr_e( 'Header Menu', 'lucida' ); ?>">
                    <h3 class="assistive-text"><?php _e( 'Header menu', 'lucida' ); ?></h3>
                    <div class="wrapper">
                        <?php
                            $args = array(
                                'theme_location' => 'header-top',
                                'menu_class'     => 'menu lucida-nav-menu'
                            );
                            wp_nav_menu( $args );
                        ?>
                    </div><!-- .wrapper -->
                </nav><!-- .nav-header-top -->
                <?php
                if ( ! $options['disable_social_icons'] && '' != $social_icons ) { ?>
                    <div class="header-right-social-icons widget_lucida_social_icons">
                       <?php echo $social_icons; ?>
                    </div><!-- #header-right-social-icons -->
                <?php
                } ?>
            </div><!-- .site-header-top-menu -->
        <?php
        }
        else { ?>
            <div class="header-right-social-icons widget_lucida_social_icons">
                <?php echo $social_icons; ?>
            </div><!-- #header-right-social-icons -->
        <?php
        } ?>

    </div><!-- #header-top-menu -->
    <?php
    }
}
endif; //lucida_header_top_menu