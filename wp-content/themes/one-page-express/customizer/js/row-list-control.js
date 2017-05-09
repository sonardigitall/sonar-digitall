(function () {
    var $preview;

    function showPreview($item) {
        $preview = jQuery('#ope_section_preview');
        if (!$preview.length) {
            jQuery('body').append('<div id="ope_section_preview"></div>');
            $preview = jQuery('#ope_section_preview');
        }
        var bounds = $item[0].getBoundingClientRect();
        var scrollTop = 0;
        var scrollLeft = 0;
        $preview.css({
            left: (parseInt(bounds.right) + 10 + scrollLeft) + "px",
            top: (parseInt(bounds.top) + scrollTop) + "px",
            'background-image': 'url("' + $item.data('preview') + '?cloudpress-companion=v1")'
        });
        $preview.show();
    }

    function hidePreview() {
        $preview = jQuery('#ope_section_preview');
        $preview.hide();
    }

    jQuery(document).ready(function ($) {
        $(document).on('mouseover.presets_changer', '[data-apply="presets_changer"] .item-preview', function (event) {
            event.preventDefault();
            showPreview($(this));
        });

        $(document).on('mouseout.presets_changer', '[data-apply="presets_changer"] .item-preview', function (event) {
            event.preventDefault();
            hidePreview($(this));
        });

        $(document).on('click.presets_changer', '[data-apply="presets_changer"] .available-item-hover-button', function (event) {
            event.preventDefault();
            event.stopPropagation();
            var setting = $(this).data('setting-link'),
                itemId = $(this).data('id'),
                $list = $(this).closest('[data-type="row-list-control"]'),
                selectionType = $list.attr('data-selection') || "radio";
                
            var varName = $(this).closest('li').data('varname');
            var presetsValues = window[varName][itemId];
            _.each(presetsValues, function (value, name) {
                var control = wp.customize.settings.controls[name];
                if (control) {
                    var type = control.type;

                    if (type == "radio-html") {
                        jQuery( wp.customize.control( name ).container.find( 'input[value="' + value + '"]' ) ).prop( 'checked', true );
                         wp.customize.instance( name ).set( value );
                    } else  {
                        if (type == "kirki-spacing") {
                            for(var prop in value) {
                                if (value.hasOwnProperty(prop)) {
                                   jQuery( wp.customize.control( name ).container.find( '.' + prop +' input' ) ).prop( 'value', value[prop] );
                                }
                            }
                            wp.customize.instance( name ).set( value ); 
                        } else {
                            if (type.match('kirki')) {
                                kirkiSetSettingValue( name, value );
                            } else {
                                wp.customize.instance( name ).set( value );
                            }
                        }
                    }
                }
            });
        });
    });
    
})();