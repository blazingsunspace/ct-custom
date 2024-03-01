<?php

/**
 * CT Custom Theme Customizer
 *
 * @package CT_Custom
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ct_custom_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ct_custom_customize_partial_blogname',
		));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ct_custom_customize_partial_blogdescription',
		));
	}
}
add_action('customize_register', 'ct_custom_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ct_custom_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ct_custom_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ct_custom_customize_preview_js()
{
	wp_enqueue_script('ct-custom-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'ct_custom_customize_preview_js');



class CT_Customizer
{
	public function __construct()
	{
		add_action('customize_register', [$this, 'register_customizer_section']);
	}

	public function register_customizer_section($wp_customize)
	{
		//initialise section 
		$this->author_callout_section($wp_customize);
	}

	//author sections, settings and controls
	private function author_callout_section($wp_customize)
	{
		// new panel
		$wp_customize->add_section('base-author-callout-section', [
			'title' => 'Author',
			'priority' => 2,
			'description' => __('Autor section is only displayed on Blog page', 'ct-custom'),

		]);

		$wp_customize->add_setting('base-author-callout-display', [
			'default' => 'No',
			'sanitize_callback'	=> [
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

		]));
	}

	public function sanitize_custom_option($input)
	{
		return ($input === "No" ? "No" : "Yes");
	}
	public function sanitize_custom_text($input)
	{
		return htmlspecialchars($input);
	}
	public function sanitize_custom_image_url($input)
	{
		return filter_var($input, FILTER_SANITIZE_URL);
	}
}
new CT_Customizer();
