<?php
namespace OnePageExpress;

class BaseControl extends \WP_Customize_Control
{
    protected $data = null;

    public function init()
    {
        return true;
    }

    public function __construct($manager, $id, $data = array())
    {
        $this->data = $data;
        parent::__construct($manager, $id, $data);
        $this->init();
    }
}
class Activate_Companion_Control extends BaseControl {
    public function get_link($slug = false) {
        $tgmpa = \TGM_Plugin_Activation::get_instance();
        $path = $tgmpa->plugins[ $slug ]['file_path'];
        return add_query_arg( array(
          'action'        => 'activate',
          'plugin'        => rawurlencode( $path ),
          'plugin_status' => 'all',
          'paged'         => '1',
          '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $path ),
        ), network_admin_url( 'plugins.php' ));
  }
  public function render_content() {
        $data = $this->data;
        $label = $data['label'];
        $msg = $data['msg'];
        $slug = $data['slug'];
      ?>
      <div class="one-page-express-enable-companion">
        <?php
          printf('<p>%1$s</p>', $msg);
          printf('<a class="%1$s button" href="%2$s">%3$s</a>', "activate", esc_url($this->get_link($slug)), $label);
        ?>
      </div>
      <?php
  }
}
class Install_Companion_Control extends BaseControl {
    public function get_link($slug = false) {
        return add_query_arg(
          array(
            'action' => 'install-plugin',
            'plugin' =>  $slug,
            '_wpnonce'      => wp_create_nonce( 'install-plugin_' .  $slug )
          ),
          network_admin_url( 'update.php' )
        );
  }
  public function render_content() {
        $data = $this->data;
        $label = $data['label'];
        $msg = $data['msg'];
        $slug = $data['slug'];
      ?>
      <div class="one-page-express-enable-companion">
        <?php
          printf('<p>%1$s</p>', $msg);
          printf('<a class="%1$s button" href="%2$s">%3$s</a>', "install-now", esc_url($this->get_link($slug)), $label);
        ?>
      </div>
      <?php
    }
}

class BackgroundTypesControl extends BaseControl
{

    public function init()
    {
        $this->type = 'select';
        foreach ($this->data['choices'] as $key => $value) {
            $this->choices[$key] = $value['label'];
        }
    }


    public function render_content()
    {
        parent::render_content(); ?>
        <script> 
            jQuery(document).ready(function($){
                $('[<?php $this->link(); ?>]').data('controlBinds', <?php echo json_encode($this->data['choices']) ?>);
                function updateControlBinds(){
                    var controlBinds =$('[<?php $this->link(); ?>]').data('controlBinds');
                    var currentType = $('[<?php $this->link(); ?>]').val();

                    for(var type in controlBinds){
                        var controls = controlBinds[type].control;
                       console.log('aici');
                        if(!_.isArray(controls)){
                            controls = [controls];
                        }
                        
                        for(var i=0;i<controls.length;i++){
                            var control = wp.customize.control(controls[i]);

                            if(control){
                                var container = control.container.eq(0);
                                if(type === currentType){
                                    container.show();
                                } else {
                                    container.hide();
                                }
                            }

                        }
                }
                }
                wp.customize('<?php echo $this->settings['default']->id ?>').bind(updateControlBinds);
                $('[<?php $this->link(); ?>]').change(updateControlBinds);
                updateControlBinds();
            });
        </script>
    <?php
    }
}

class RowsListControl extends BaseControl
{

    public function enqueue()
    {
        //$jsUrl = $this->companion()->assetsRootURL() . "/js/customizer";
        //wp_enqueue_script('row-list-control', $jsUrl . "/row-list-control.js");
    }

    public function getSettingAttr($setting_key = 'default')
    {
        if (!isset($this->settings[$setting_key])) {
            return '';
        }

        echo 'data-setting-link="' . esc_attr($this->settings[$setting_key]->id) . '"';
    }

    public function dataAttrs()
    {
        $data = 'data-name="' .  $this->id . '"';

        echo $data;
    }

    public function dateSelection()
    {
        $data = 'data-selection="radio"';

        if (isset($this->data['selection'])) {
            $data = 'data-selection="'.$this->data['selection'].'"';
        }

        echo $data;
    }

    public function getSourceData()
    {
        return $this->data['dataSource'];
    }


    public function render_content()
    {
        ?>
        <div <?php $this->dateSelection(); ?> data-type="row-list-control" data-apply="<?php echo $this->data['type'] ?>"  class="list-holder">
            <?php ($this->data['type'] === "mod_changer") ? $this->renderModChanger() : $this->renderPresetsChanger() ?>
        </div>
        <?php 
    }

    public function filterDefault($data)
    {
        if (is_array($data)) {
            $data = $this->filterArrayDefaults($data);
        } else {
            $data  = str_replace('[tag_companion_uri]', get_template_directory_uri(), $data);
            $data   = str_replace('[tag_theme_uri]', get_template_directory_uri(), $data);
        }

        return $data;
    }

    public function filterArrayDefaults($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->filterDefault($value);
        }

        return $data;
    }

    public function renderPresetsChanger()
    {
        $items = $this->getSourceData();
        $optionsVar = uniqid('cp_' . $this->id . '_'); ?>
            <script>
                var <?php echo $optionsVar ?> = {};
            </script>
            <ul <?php $this->dataAttrs(); ?> class="list rows-list">
                <?php foreach ($items as $item):
                ?>
                    <script>
                        <?php $settingsData = $this->filterArrayDefaults($item['settings']); ?>
                         <?php echo $optionsVar ?>["<?php echo $item['id']; ?>"] = <?php echo json_encode($settingsData) ?>;
                    </script>

                    <li class="item available-item" data-varname="<?php echo $optionsVar ?>" data-id="<?php echo $item['id']; ?>">
                        <div class="image-holder"
                            style="background-position:center center;background-image:url()">
                                <img src="<?php echo $item['thumb']; ?>?cloudpress-companion?v=1" />
                            </div>

                            <span data-id="<?php echo $item['id']; ?>" class="available-item-hover-button" <?php $this->getSettingAttr(); ?> ><?php echo $this->data['insertText']; ?></span>
                            <div title="Section is already in page" class="checked-icon"></div>
                        <span class="item-preview" data-preview="<?php echo $item['preview']; ?>">
                            <i class="icon"></i>
                        </span>
                        <?php if (isset($item['description'])): ?>
                            <span class="description"> <?php echo $item['description']; ?> </span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            
            <?php ;
    }
}


class ColorBoxesControl extends BaseControl
{
    public function init()
    {
        $this->type = 'radio';
    }


    public function render()
    {
        $id    = 'customize-control-' . str_replace(array( '[', ']' ), array( '-', '' ), $this->id);
        $class = 'customize-control customize-control-' . $this->type; ?>

        <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?> cp-color-boxes">
            <?php $this->render_content(); ?>
        </li>
        <?php

    }

    public function render_content()
    {
        if (empty($this->choices)) {
            return;
        }

        $name = '_customize-radio-' . $this->id;

        if (! empty($this->label)) : ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <?php endif;
        if (! empty($this->description)) : ?>
            <span class="description customize-control-description"><?php echo $this->description ; ?></span>
        <?php endif;

        foreach ($this->choices as $value) : ?>
            <label>
               <div class="color-container" style="background:<?php echo $value; ?>;">
                    <input  type="radio" value="<?php echo esc_attr($value); ?>" 
                        name="<?php echo esc_attr($name); ?>" <?php $this->link();
        checked($this->value(), $value); ?> />
                    <span class="check-icon"></span>
	        </div>
            </label>
            <?php
        endforeach;
    }
}

class CssClassBoxesControl extends ColorBoxesControl
{
    public function init()
    {
        $this->type = 'radio';
        $this->data['bigPreview'] = isset($this->data['bigPreview']) && $this->data['bigPreview'];
    }


    public function render()
    {
        $id    = 'customize-control-' . str_replace(array( '[', ']' ), array( '-', '' ), $this->id);
        $class = 'customize-control customize-control-' . $this->type; ?>

        <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?> cp-color-boxes">
            <?php $this->render_content(); ?>
        </li>
        <?php

    }


    public function render_content()
    {
        if (empty($this->choices)) {
            return;
        }

        $name = '_customize-radio-' . $this->id;

        if (! empty($this->label)) : ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <?php endif;
        if (! empty($this->description)) : ?>
            <span class="description customize-control-description"><?php echo $this->description ; ?></span>
        <?php endif;

        foreach ($this->choices as $value) : ?>
            <label title="<?php echo esc_attr($value); ?>">
                <div class="css-class-container <?php echo $value; ?>">
                <input type="radio" class="<?php echo($this->data['bigPreview']?"big":"") ?>" value="<?php echo esc_attr($value); ?>" 
                    name="<?php echo esc_attr($name); ?>" <?php $this->link();
        checked($this->value(), $value); ?> />
                </div>
            </label>
            <?php
        endforeach;
    }
}

class Kirki_Controls_Radio_HTML_Control extends \Kirki_Controls_Radio_Image_Control
{
    public $type = 'radio-html';
    protected function content_template()
    {
        ?>
        <# if ( data.tooltip ) { #>
            <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
        <# } #>
        <label class="customizer-text">
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{{ data.label }}}</span>
            <# } #>
            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
        </label>
        <div id="input_{{ data.id }}" class="image">
            <# for ( key in data.choices ) { #>
                <input {{{ data.inputAttrs }}} class="image-select" type="radio" value="{{ key }}" name="_customize-radio-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked="checked"<# } #>>
                    <label for="{{ data.id }}{{ key }}">
                        <div class="{{ data.choices[ key ] }} image-clickable"></div>
                    </label>
                </input>
            <# } #>
        </div>
        <?php
    }
}
class Kirki_Controls_Separator_Control extends \WP_Customize_Control
{
    public $type = 'sectionseparator';
    public function content_template()
    {
        ?>
        <# if ( data.tooltip ) { #>
            <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
        <# } #>
        <div class="one-page-express-separator">
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{{ data.label }}}</span>
            <# } #>
        </div>
        <?php
    }
}
class FontAwesomeIconControl extends \Kirki_Customize_Control
{
    public $type = 'font-awesome-icon-control';
    public $button_label = '';


    public function __construct($manager, $id, $args = array())
    {
        $this->button_label = __('Change Icon', 'one-page-express');

        parent::__construct($manager, $id, $args);
    }


    public function enqueue()
    {
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/font-awesome.min.css');
        wp_enqueue_style('font-awesome-media-tab',  get_template_directory_uri() . "/customizer/css/fa-tab.css", array('media-views'));
        wp_enqueue_script('font-awesome-media-tab',  get_template_directory_uri() . "/customizer/js/fa-tab.js", array('media-views'));
        wp_enqueue_script('font-awesome-icon-control',  get_template_directory_uri() . "/customizer/js/font-awesome-icon-control.js");
        wp_localize_script('font-awesome-icon-control', 'ficTexts', array(
            'media_title'=> __('Select FontAwesome Icon', 'one-page-express'),
            'media_button_label'=> __('Choose Icon', 'one-page-express'),
        ));
    }


    public function to_json()
    {
        parent::to_json();
        $this->json['button_label'] = $this->button_label;
    }


    protected function content_template()
    {
        ?>
			<label for="{{ data.settings['default'] }}-button">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</label>

        <div class="fic-icon-container">
            <div class="fic-icon-preview">
                <i class="fa {{data.value}}"></i>
                <input type="hidden" value="{{ data.value }}" name="_customize-input-{{ data.id }}" {{{ data.link }}} />
            </div>
            <div class="fic-controls">
                 <button type="button" class="button upload-button control-focus" id="_customize-button-{{ data.id }}">{{{ data.button_label }}}</button>
            </div>
        </div>
		<?php

    }
}
