<?php
/**
 * thomas-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Thomas_Theme
 */

if ( ! defined( 'thomas_theme_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'thomas_theme_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function thomas_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on thomas_theme, use a find and replace
		* to change 'thomas-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'thomas-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'thomas-theme' ),
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

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'thomas_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thomas_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thomas_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'thomas_theme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function thomas_theme_scripts() {
	wp_enqueue_style( 'thomas_theme-style', get_stylesheet_uri(), array(), thomas_theme_VERSION );
}
add_action( 'wp_enqueue_scripts', 'thomas_theme_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// =====================================================
// My custom ACF thomas_themes
// =====================================================
// registering my own Blocks
add_action('acf/init', 'register_my_acf_block_types');
function register_my_acf_block_types() {
	if( function_exists('acf_register_block_type') ) {
		acf_register_block_type(array(
			'name'              => 'example',
			'title'             => __('example'),
			'description'       => __('A custom example block.'),
			'render_template'   => 'template-parts/blocks/example/example.php',
			'category'          => 'formatting',
			'icon'              => 'admin-comments',
			'keywords'          => array( 'example', 'quote' ),
			'example'  					=> array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview_image_help' => get_template_directory_uri().'/template-parts/blocks/example/example.png',
					)
				)
			)
		));
	}
}
// removing core patterns
add_action('init', function() {
    remove_theme_support('core-block-patterns');
}, 9);
// =======================================================
// Gutenberg scripts and styles
// https://www.billerickson.net/block-styles-in-gutenberg
// https://www.billerickson.net/how-to-remove-core-wordpress-blocks/
// =======================================================
function my_gutenberg_scripts() {
	wp_enqueue_script( 'theme-editor-js', get_template_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_template_directory() . '/assets/js/editor.js' ), true );
	wp_enqueue_style( 'theme-editor-css', get_template_directory_uri() . '/assets/css/editor.css', filemtime( get_template_directory() . '/assets/css/editor.css' ), true );
}
add_action( 'enqueue_block_editor_assets', 'my_gutenberg_scripts' );

add_filter( 'allowed_block_types', 'thomas_theme_allowed_block_types' );
function thomas_theme_allowed_block_types( $allowed_blocks ) {
	return array(
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'acf/example',
	);
}