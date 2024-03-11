<?php
/**
 * Bro_Barbershop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bro_Barbershop
 */

if ( ! defined( 'BRO_BARBERSHOP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'BRO_BARBERSHOP_VERSION', bro_barbershop_get_version() );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bro_barbershop_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Barbershop, use a find and replace
		* to change 'bro-barbershop' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'bro-barbershop', get_template_directory() . '/languages' );

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

	set_post_thumbnail_size( 920 );
	add_image_size( 'bro-barbershop-x-large', 1920 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'bro-barbershop' ),
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
			'bro_barbershop_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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

	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'editor-style.css', bro_barbershop_fonts_url() ) );
	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Color 1', 'bro-barbershop' ),
			'slug'  => 'color-1',
			'color' => '#252525',
		),
		array(
			'name'  => esc_html__( 'Color 2', 'bro-barbershop' ),
			'slug'  => 'color-2',
			'color' => '#E64A26',
		),
		array(
			'name'  => esc_html__( 'Color 3', 'bro-barbershop' ),
			'slug'  => 'color-3',
			'color' => '#434343',
		),
		array(
			'name'  => esc_html__( 'Color 4', 'bro-barbershop' ),
			'slug'  => 'color-4',
			'color' => '#8F908A',
		),
		array(
			'name'  => esc_html__( 'Color 5', 'bro-barbershop' ),
			'slug'  => 'color-5',
			'color' => '#BEC0B9',
		),
		array(
			'name'  => esc_html__( 'Color 6', 'bro-barbershop' ),
			'slug'  => 'color-6',
			'color' => '#F0F0F0',
		),
	) );
}

add_action( 'after_setup_theme', 'bro_barbershop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bro_barbershop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bro_barbershop_content_width', 920 );
}

add_action( 'after_setup_theme', 'bro_barbershop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bro_barbershop_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bro-barbershop' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bro-barbershop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'bro-barbershop' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'bro-barbershop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'bro-barbershop' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'bro-barbershop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'bro-barbershop' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'bro-barbershop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'bro_barbershop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bro_barbershop_scripts() {
	wp_enqueue_style( 'bro-barbershop-fonts', bro_barbershop_fonts_url(), array(), BRO_BARBERSHOP_VERSION );
	wp_enqueue_style( 'bro-barbershop-style', get_stylesheet_uri(), array(), BRO_BARBERSHOP_VERSION );

	wp_enqueue_script( 'bro-barbershop-priority-menu', get_template_directory_uri() . '/js/priority-menu.js', array( 'jquery' ), BRO_BARBERSHOP_VERSION, true );
	wp_enqueue_script( 'bro-barbershop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), BRO_BARBERSHOP_VERSION, true );
	wp_enqueue_script( 'bro-barbershop-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), BRO_BARBERSHOP_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'bro_barbershop_scripts' );

/**
 * TGMPA init.
 */
require get_template_directory() . '/inc/tgmpa-init.php';

/**
 * Include demo-import file.
 */
require get_template_directory() . '/inc/demo-import.php';

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
 * Include MotoPress Appointment functions.
 */
if ( defined( 'MotoPress\Appointment\VERSION' ) ) {
	require get_template_directory() . '/inc/appointment.php';
}


function bro_barbershop_get_version() {
	$theme_info = wp_get_theme( get_template() );

	return $theme_info->get( 'Version' );
}

function bro_barbershop_fonts_url() {
	$url   = 'https://fonts.googleapis.com/css2?';
	$fonts = [];

	$font1 = esc_html_x( 'on', 'Space Grotesk font: on or off', 'bro-barbershop' );
	if ( 'off' !== $font1 ) {
		$fonts[] = 'family=Space+Grotesk:wght@300;400;500;700';
	}

	if ( ! $fonts ) {
		return null;
	}

	$url .= implode( '&amp;', $fonts );
	$url .= '&amp;display=swap';

	return esc_url_raw( $url );
}

function bro_barbershop_register_block_styles() {
	register_block_style( 'core/button', [
		'name'  => 'creative',
		'label' => __( 'Creative', 'bro-barbershop' ),
	] );

	register_block_style( 'core/columns', [
		'name'  => 'no-space',
		'label' => __( 'No Space', 'bro-barbershop' ),
	] );

	register_block_style( 'core/group', [
		'name'  => 'border-bottom',
		'label' => __( 'Border Bottom', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/section', [
		'name'  => 'border-left',
		'label' => __( 'Border Left', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/section', [
		'name'  => 'border-top-bottom',
		'label' => __( 'Border Top Bottom', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/section', [
		'name'  => 'large-content-width',
		'label' => __( 'Large Content Width', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/section', [
		'name'  => 'full-height',
		'label' => __( 'Full Height', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/contact-form', [
		'name'  => 'dark-mode',
		'label' => __( 'Dark Mode', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/advanced-heading', [
		'name'  => 'vertical',
		'label' => __( 'Vertical', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/counter', [
		'name'  => 'crossed-left',
		'label' => __( 'Crossed Left', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/counter', [
		'name'  => 'crossed-right',
		'label' => __( 'Crossed Right', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/post-carousel', [
		'name'  => 'dark-mode',
		'label' => __( 'Dark Mode', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/table', [
		'name'  => 'hoverable',
		'label' => __( 'Hoverable', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/video-popup', [
		'name'  => 'straight',
		'label' => __( 'Straight', 'bro-barbershop' ),
	] );

	register_block_style( 'getwid/video-popup', [
		'name'  => 'square',
		'label' => __( 'Square', 'bro-barbershop' ),
	] );
}

add_action( 'init', 'bro_barbershop_register_block_styles' );
