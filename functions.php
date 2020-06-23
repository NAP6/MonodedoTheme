<?php

/**
 * MonodedoTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MonodedoTheme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('monodedotheme_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function monodedotheme_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MonodedoTheme, use a find and replace
		 * to change 'monodedotheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('monodedotheme', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

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
		register_nav_menus(
			array(
				'Primary' => esc_html__('Primary', 'monodedotheme'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'monodedotheme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 183,
				'flex-height' => false,
				'flex-width'  => true,
				'header-text' => array('site-title', 'site-description'),
			)
		);
	}
endif;
add_action('after_setup_theme', 'monodedotheme_setup');

/*
function monodedotheme_add_editor_style()
{
	add_editor_style('dist/css/editor-style.css');
}
add_action('admin-init', monodedotheme_add_editor_style);
*/

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monodedotheme_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('monodedotheme_content_width', 1140);
}
add_action('after_setup_theme', 'monodedotheme_content_width', 0);



/**
 * Enqueue scripts and styles.
 */
function monodedotheme_scripts()
{
	//wp_enqueue_style('monodedotheme-bootstrap-css', get_template_directory_uri() . '/dist/css/bootstrap.css');
	wp_enqueue_style('iconos', get_template_directory_uri() . '/dist/css/all.min.css');
	wp_enqueue_style('monodedotheme-style', get_stylesheet_uri('iconos'), array(), _S_VERSION);
	wp_style_add_data('monodedotheme-style', 'rtl', 'replace');


	//wp_enqueue_script('monodedotheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('icons-js', get_template_directory_uri() . '/src/js/all.min.js', array(), null, true);
	wp_enqueue_script('monodedotheme-popper', get_template_directory_uri() . '/src/js/popper.min.js', array('jquery'), null, true);
	wp_enqueue_script('monodedotheme-bootstrap-js', get_template_directory_uri() . '/src/js/bootstrap.min.js', array('monodedotheme-popper'), null, true);
	//wp_enqueue_script('monodedotheme-bootstrap-hover-js', get_template_directory_uri() . '/src/js/bootstrap.min.js', array('jquery'), _S_VERSION, true);
	//wp_enqueue_script('monodedotheme-nav-scroll-js', get_template_directory_uri() . '/src/js/nav-scroll.js', array('jquery'), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'monodedotheme_scripts');



///Agregar log-in y log-out
add_filter('wp_nav_menu_items', 'dcms_items_login_logout', 10, 2);

function dcms_items_login_logout($items, $args)
{

	if ($args->theme_location == 'Primary') {
		if (is_user_logged_in()) {
			$items .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-239 nav-item">
						<a class="nav-link" href="' . wp_logout_url(get_permalink()) . '">' . __("Log Out") . '</a>
						</li>';
		} else {
			$items .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-239 nav-item">
						<a class="nav-link" href="' . wp_login_url(get_permalink()) . '">' . __("Log In") . '</a>
						</li>';
		}
	}

	return $items;
}



/**
 * Custom thumbnail size.
 */
add_image_size('monodedotheme-full-whith', 1980, 9999, array('left', 'top'));

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

/**
 * Widgets Fille.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Bootstrap Navwalker File.
 */
require get_template_directory() . '/inc/navbar.php';

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
