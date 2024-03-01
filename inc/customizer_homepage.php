<?php


if (class_exists('WP_Customize_Control')) {
    class ET_Divi_Range_Option extends WP_Customize_Control
    {
        public $type = 'range';

        public function render_content()
        {
?>
            <label>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif;
                if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
                <input type="<?php echo esc_attr($this->type); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> data-reset_value="<?php echo esc_attr($this->setting->default); ?>" />
                <input type="number" <?php $this->input_attrs(); ?> class="et-pb-range-input" value="<?php echo esc_attr($this->value()); ?>" />
                <span class="et_divi_reset_slider"></span>
            </label>
<?php
        }
    }
}
class CT_Customizer_Homepage
{
    public function __construct()
    {

        add_action('customize_register', [$this, 'register_customizer_section']);
    }

    public function register_customizer_section($wp_customize)
    {
        //initialise section 
        $this->homepage_panel($wp_customize);
    }

    //author sections, settings and controls
    private function homepage_panel($wp_customize)
    {
        // new panel

        $wp_customize->add_panel(
            'ct_custom_homepage_panel',
            array(
                'title'    => esc_html__('Homepage Settingss', 'ct-custom'),
                'priority' => 1,
            )
        );

        $wp_customize->add_section(
            'address_section',
            array(
                'title' => esc_html__('Address Section', 'ct-custom'),
                'panel' => 'ct_custom_homepage_panel',
            )
        );
        $wp_customize->add_setting('address_section_setting', [
            'default' => 'No',
            'sanitize_callback'    => [
                $this,
                'sanitize_custom_option2'
            ],
        ]);

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'basaic-autor-callout-display-controll', [
            'label' => 'Display this section?',
            'section' => 'address_section',
            'settings' => 'address_section_setting',
            'type' => 'select',
            'choices' => [
                'Yes' => 'Yes',
                'No' => 'No',
            ],

        ]));

         $wp_customize->add_section(
            'phone_section',
            array(
                'title' => esc_html__('Phone Section', 'ct-custom'),
                'panel' => 'ct_custom_homepage_panel',
            )
        );
        $wp_customize->add_setting(
            'et_divi[post_meta_height]',
            array(
                'default'           => '1',
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'et_sanitize_float_number',
            )
        );
        $wp_customize->add_control(
            new ET_Divi_Range_Option(
                $wp_customize,
                'et_divi[post_meta_height]',
                array(
                    'label'       => esc_html__('Meta Line Height', 'Divi'),
                    'section'     => 'phone_section',
                    'type'        => 'range',
                    'input_attrs' => array(
                        'min'  => .8,
                        'max'  => 3,
                        'step' => .1,
                    ),
                )
            )
        );
        /* $wp_customize->add_section('base-author-callout-section', [
            'title' => 'Author',
            'priority' => 2,
            'description' => __('Autor section is only displayed on Blog page', 'ct-custom'),

        ]);

        $wp_customize->add_setting('base-author-callout-display', [
            'default' => 'No',
            'sanitize_callback'    => [
                $this,
                'sanitize_custom_option'
            ],
        ]);

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'basaic-autor-callout-display-controll', [
            'label' => 'Display this section?',
            'section' => 'base-author-callout-section',
            'settings' => 'base-author-callout-display',
            'type' => 'select',
            'choices' => [
                'Yes' => 'Yes',
                'No' => 'No',
            ],

        ]));

        //display autor text

        $wp_customize->add_setting('basic-author-callout-text', [
            'default' => '',
            'placeholder' =>  __('Input Autor Name', 'ct-custom'),
            'sanitize_callback' => [$this, 'sanitize_custom_text']
        ]);

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'basic-author-callout-control', [
            'label' => 'About Autor',
            'section' => 'base-author-callout-section',
            'settings' => 'basic-author-callout-text',
            'type' => 'text',

        ]));
        //add author image
        $wp_customize->add_setting('basic-author-callout-image', [
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitize_custom_image_url']

        ]);

        $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'basic-author-callout-image-control', [
            'label' => 'Image',
            'section' => 'base-author-callout-section',
            'settings' => 'basic-author-callout-image',
            'width' => 442,
            'height' => 310,

        ])); */
    }

    public function sanitize_custom_option2($input)
    {
        return ($input === "No" ? "No" : "Yes");
    }
}
new CT_Customizer_Homepage();
