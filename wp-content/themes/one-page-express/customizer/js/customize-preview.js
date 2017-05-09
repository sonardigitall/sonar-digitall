


( function( $ ) {


    wp.customize( 'one_page_express_header_column_width', function( value ) {
        value.bind( function( newval ) {
            var leftc = $( '.header-description-left' );
            var rightc = $( '.header-description-right' );
            if (leftc.length) {
                leftc[0].style.setProperty('width', newval + "%", 'important');
            }
            if (rightc.length) {
                rightc[0].style.setProperty('width', (100-newval) + "%", 'important');
            }
        } );
    });

    wp.customize( 'one_page_express_full_height', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.header-homepage' ).css( 'min-height', "100vh" );
            } else {
                $( '.header-homepage' ).css( 'min-height', "" );
            }
        } );
    });

    wp.customize( 'one_page_express_header_show_overlay', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.header-homepage' ).addClass('color-overlay');
            } else {
                $( '.header-homepage' ).removeClass('color-overlay');
            }
        } );
    });
    wp.customize( 'one_page_express_header_sticked_background', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.homepage.header-top.fixto-fixed' ).css('background-color', newval);
            }
            var transparent = JSON.parse( wp.customize('one_page_express_header_nav_transparent').get());
            if (!transparent) {
                $( '.homepage.header-top' ).css('background-color', newval);
            }
        } );
    });
    wp.customize( 'one_page_express_header_nav_transparent', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.homepage.header-top' ).css('background-color', '');
                $( '.homepage.header-top' ).removeClass('coloured-nav');
            } else {
                $( '.homepage.header-top' ).css('background-color', "#ffffff");
                $( '.homepage.header-top' ).addClass('coloured-nav');
            }
        } );
    });
    wp.customize( 'one_page_express_inner_header_sticked_background', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.header-top.fixto-fixed' ).css('background-color',newval);
            }

              var transparent = JSON.parse( wp.customize('one_page_express_inner_header_nav_transparent').get());
            if (!transparent) {
                $( '.header-top' ).css('background-color', newval);
            }
        } );
    });
     wp.customize( 'one_page_express_inner_header_nav_transparent', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.header-top' ).css('background-color', '');
                $( '.header-top' ).removeClass('coloured-nav');
            } else {
                //$( '.header-top' ).css('background-color', wp.customize('one_page_express_inner_header_sticked_background').get());
                $( '.header-top' ).addClass('coloured-nav');
                $( '.header-top' ).css('background-color', "#ffffff");
            }
        } );
    });
    wp.customize( 'one_page_express_inner_header_show_overlay', function( value ) {
        value.bind( function( newval ) {
            if (newval) {
                $( '.header' ).addClass('color-overlay');
            } else {
                $( '.header' ).removeClass('color-overlay');
            }
        } );
    });

     wp.customize( 'one_page_express_header_gradient', function( value ) {
        value.bind( function( newval, oldval ) {
            $( '.header-homepage' ).removeClass(oldval);
            $( '.header-homepage' ).addClass(newval);
        } );
    });

      wp.customize( 'one_page_express_inner_header_gradient', function( value ) {
        value.bind( function( newval, oldval ) {
            $( '.header' ).removeClass(oldval);
            $( '.header' ).addClass(newval);
        } );
    });
    
} )( jQuery );