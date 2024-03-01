<?php
require 'vendor/autoload.php';
require 'core/admin_ajax_trait.php';

use Smarty\Smarty;


/**
 * BS Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('BS_Custom')) {

	class BS_Custom
	{
		use AdminAjaxTrait;
		private $theme_directory;
		public $smarty;

		public function __construct()
		{


			$this->theme_directory = get_template_directory_uri();
			$this->define_constants();
			$this->init_smarty();
			if (!function_exists('ct_custom_setup')) {
				add_action('after_setup_theme', [$this, 'ct_custom_setup'], 0);
			}
			add_action('after_setup_theme',  [$this, 'ct_custom_content_width'], 1);
			add_action('widgets_init', [$this, 'ct_custom_widgets_init'], 0);
			add_action('wp_enqueue_scripts', [$this, 'ct_custom_scripts'], 0);

			add_action('admin_enqueue_scripts', [$this, 'admin_scripts_and_styles'], 100, 0);

			add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_toastify_scripts'], 100, 0);
			if (wp_doing_ajax()) {
				add_action('wp_ajax_admin_add_phone', [$this, 'admin_add_phone'], 100, 0);
				add_action('wp_ajax_admin_add_fax', [$this, 'admin_add_fax'], 100, 0);
				add_action('wp_ajax_admin_upload_logo_image', [$this, 'admin_upload_logo_image'], 100, 0);

				add_action('wp_ajax_admin_add_address', [$this, 'admin_add_address'], 100, 0);
				add_action('wp_ajax_admin_add_social_nerworks', [$this, 'admin_add_social_nerworks'], 100, 0);
			}

			add_action('admin_menu', [$this, 'myprefix_register_options_page'], 100, 0);

			add_action('admin_enqueue_scripts', [$this, 'dashicons_picker_scripts'], 100, 0);

			/**
			 * Implement the Custom Header feature.
			 */
			require get_template_directory() . '/inc/custom-header.php';

			/**
			 * Custom template tags for this theme.
			 */
			require get_template_directory() . '/inc/template-tags.php';

			/**
			 * Functions which enhance the theme by hooking into WordPress.
			 */
			require get_template_directory() . '/inc/template-functions.php';

			/**
			 * Customizer additions.
			 */
			require get_template_directory() . '/inc/customizer.php';
			require get_template_directory() . '/inc/customizer_homepage.php';
			/**
			 * Load Jetpack compatibility file.
			 */
			if (defined('JETPACK__VERSION')) {
				require get_template_directory() . '/inc/jetpack.php';
			}

			/**
			 * Load WooCommerce compatibility file.
			 */
			if (class_exists('WooCommerce')) {
				require get_template_directory() . '/inc/woocommerce.php';
			}
			add_filter('script_loader_tag', function ($tag, $handle, $src) {

				switch ($handle) {

					case 'admin-' . CT_CUSTOM_NAME . '-script':
						return '<script type="module" src="' . esc_url($src) . '"></script>';
						break;
					default:
						return $tag;
						break;
				}
			}, 10, 3);
		}

		public function dashicons_picker_scripts()
		{



			wp_enqueue_style('dashicons-picker',  $this->theme_directory . '/assets/css/dashicons-picker.css', array('dashicons'), '1.0', false);
			wp_enqueue_script('dashicons-picker', $this->theme_directory . '/assets/js/dashicons-picker.js',   array('jquery'), '1.1', true);
		}



		/**
		 * Add a new options page named "My Options".
		 */
		public function myprefix_register_options_page()
		{
			add_menu_page(
				'BS Theme Theme',
				'BS Theme Theme',
				'manage_options',
				'ct_custom_theme',
				[$this, 'ct_custom_theme_init_admin_page'],
				'dashicons-image-flip-horizontal',
				100
			);
		}


		/**
		 * The "My Options" page html.
		 */
		public function ct_custom_theme_init_admin_page()
		{



			if (!current_user_can('manage_options')) {
				return;
			}

			$this->smarty->display('index.tpl');

			include_once get_template_directory() . '/template-admin/template-admin-main.php';
		}



		private function init_smarty()
		{


			$this->smarty = new Smarty();
			$this->smarty->setTemplateDir(get_template_directory() . '/template-admin');
			$this->smarty->setConfigDir(get_template_directory() . '/config');
			$this->smarty->setCompileDir(get_template_directory() . '/compile');
			$this->smarty->setCacheDir(get_template_directory() . '/cache');

			/* $this->smarty->testInstall(); */
			$this->smarty->assign('name', 'Ned');
			/* $this->smarty->compileAllTemplates('.tpl',true); */
			$this->smarty->setCaching(Smarty::CACHING_LIFETIME_SAVED);
			/* $this->smarty->setCompileCheck(Smarty::COMPILECHECK_OFF); */
			$this->smarty->setCacheLifetime(5000);

			$this->smarty->configLoad('main_config.ini', 'Customer');
		}
		/**
		 * define_constants is used for difining needed contstants for plugin
		 */
		private function define_constants()
		{
			define('CT_CUSTOM_PATH', plugin_dir_path(__FILE__));
			define('CT_CUSTOM_URL', plugin_dir_url(__FILE__));
			define('CT_CUSTOM_VERSION', '201512154');
			define('CT_CUSTOM_TABLE_VERSION', 1);
			define('CT_CUSTOM_NAME', 'BS_Custom');
			define('CT_CUSTOM_NAME_PRETTY', __('A/B Split Traffic Testing', 'split_traffic_a_b_testing'));
			define('CT_CUSTOM_NAME_PRETTY_2', __('A/B Split Testing', 'split_traffic_a_b_testing'));
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function ct_custom_setup(): void
		{
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on BS Theme, use a find and replace
			 * to change 'ct-custom' to the name of your theme in all the template files.
			 */
			load_theme_textdomain('ct-custom', get_template_directory() . '/languages');


			// Add default posts and comments RSS feed links to head.
			/* add_theme_support('automatic-feed-links'); */

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support('title-tag');

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support('post-thumbnails');

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus(array(
				'menu-1' => esc_html__('Primary', 'ct-custom'),
			));

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support('html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			));

			// Set up the WordPress core custom background feature.
			add_theme_support('custom-background', apply_filters('ct_custom_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)));

			// Add theme support for selective refresh for widgets.
			add_theme_support('customize-selective-refresh-widgets');

			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
			add_theme_support('custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			));
		}
		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		public function ct_custom_content_width(): void
		{
			// This variable is intended to be overruled from themes.
			// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
			// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
			$GLOBALS['content_width'] = apply_filters('ct_custom_content_width', 640);
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function ct_custom_widgets_init(): void
		{
			register_sidebar(array(
				'name'          => esc_html__('Sidebar', 'ct-custom'),
				'id'            => 'sidebar-1',
				'description'   => esc_html__('Add widgets here.', 'ct-custom'),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			));
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function ct_custom_scripts()
		{
			wp_enqueue_style('ct-custom-style', get_stylesheet_uri());

			wp_enqueue_script('ct-custom-navigation', $this->theme_directory . '/js/navigation.js', array(), $this->smarty->getConfigVars('CT_CUSTOM_VERSION',), true);

			wp_enqueue_script('ct-custom-skip-link-focus-fix', $this->theme_directory . '/js/skip-link-focus-fix.js', array(), $this->smarty->getConfigVars('CT_CUSTOM_VERSION',), true);

			if (is_singular() && comments_open() && get_option('thread_comments')) {
				wp_enqueue_script('comment-reply');
			}
		}

		public function admin_enqueue_toastify_scripts()
		{
			$currentScreen = get_current_screen();

			/* 	wp_enqueue_script('myprefix_script', $js_path, array('jquery'), '0.1'); */
			if (is_object($currentScreen) && $currentScreen->id === 'toplevel_page_ct_custom_theme') {
				wp_enqueue_media();

				wp_register_script('admin-' . CT_CUSTOM_NAME . '-script', $this->theme_directory . '/assets/js/Admin_App.js', [], $this->smarty->getConfigVars('CT_CUSTOM_VERSION',));
				wp_enqueue_script('admin-' . CT_CUSTOM_NAME . '-script');


				wp_register_style('admin-' . CT_CUSTOM_NAME . '-styles', $this->theme_directory . '/assets/css/admin-styles.css', [], $this->smarty->getConfigVars('CT_CUSTOM_VERSION',), 'all');
				wp_enqueue_style('admin-' . CT_CUSTOM_NAME . '-styles');

				wp_register_script('tailwindcss', 'https://cdn.tailwindcss.com', [], $this->smarty->getConfigVars('CT_CUSTOM_VERSION',));
				wp_enqueue_script('tailwindcss');
			}
		}
		public function admin_scripts_and_styles()
		{


			$currentScreen = get_current_screen();

			/* 	wp_enqueue_script('myprefix_script', $js_path, array('jquery'), '0.1'); */
			if (is_object($currentScreen) && $currentScreen->id === 'toplevel_page_ct_custom_theme') {


				wp_register_script('admin-toastify-script', $this->theme_directory . '/assets/js/toastify-js.js', [], $this->smarty->getConfigVars('CT_CUSTOM_VERSION',));
				wp_enqueue_script('admin-toastify-script');


				wp_register_style('admin-toastify-styles', $this->theme_directory . '/assets/css/toastify.min.css', [], $this->smarty->getConfigVars('CT_CUSTOM_VERSION',), 'all');
				wp_enqueue_style('admin-toastify-styles');
			}
		}
	}
}


add_action('deleted_theme', function ($stylesheet, $deleted): void {

	// do something
});

add_action('after_switch_theme', 'mytheme_setup_options');

function mytheme_setup_options(): void
{
	$active_theme = wp_get_theme();

	if ($active_theme == 'BS Theme') {

		add_option('aaa', '255', '', 'yes');
	}
}

if (class_exists('BS_Custom')) {



	// Instantiate the 'BS_Custom' class to initialize the theme functions

	new BS_Custom();
}

define('ALLOW_UNFILTERED_UPLOADS', true);
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
/* function custom_theme_customizer($wp_customize)
{
	// Add a section for logo settings
	$wp_customize->add_section('custom_logo_section', array(
		'title'    => __('Logo', 'your-theme'),
		'priority' => 30,
	));

	// Add a setting for the logo
	$wp_customize->add_setting('custom_logo', array(
		'capability' => 'edit_theme_options',
	));

	// Add a control for uploading the logo
	$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'custom_logo', array(
		'label'    => __('Upload Logo', 'your-theme'),
		'section'  => 'custom_logo_section',
		'settings' => 'custom_logo',
		'width'    => 300,
		'height'   => 100,
	)));
}

add_action('customize_register', 'custom_theme_customizer'); */



function sitepoint_customize_register($wp_customize)
{

	$wp_customize->add_section("ads", array(
		"title" => __("Advertising", "customizer_ads_sections"),
		"priority" => 30,
	));

	$wp_customize->add_setting("ads_code", array(
		"default" => "",
		"transport" => "postMessage",
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"ads_code",
		array(
			"label" => __("Enter Ads Code", "customizer_ads_code_label"),
			"section" => "ads",
			"settings" => "ads_code",
			"type" => "textarea",
		)
	));
}

add_action("customize_register", "sitepoint_customize_register");

function custom_theme_customizer($wp_customize)
{
	$wp_customize->add_section('custom_logo_section', array(
		'title' => __('Custom Logo', 'your_theme_domain'),
		'priority' => 30,
	));
}
add_action('customize_register', 'custom_theme_customizer');

// Step 2: Add the custom setting
function custom_logo_setting($wp_customize)
{
	$wp_customize->add_setting('custom_logo', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
		'label' => __('Upload a Custom Logo', 'your_theme_domain'),
		'section' => 'custom_logo_section',
		'settings' => 'custom_logo',
	)));
}
add_action('customize_register', 'custom_logo_setting');

$custom_variable3 = 'This is a custom variable';
