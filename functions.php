<?php
/**
 * RedRock functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RedRock
 */

if ( ! function_exists( 'redrock_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function redrock_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on redrock, use a find and replace
	 * to change 'redrock' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'redrock', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Add support for core custom logo (replaces JetPack functionality)
	 * - also see fallback in inc/jetpack.php
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 1500,
		'flex-width'  => true,
		'header-text' => array(
			'site-title',
			'site-description'
		),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 1200 );
	add_image_size( 'redrock-archive', 560, 9999 );

	/*
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'header' => esc_html__( 'Header Menu', 'redrock' ),
		'social'  => esc_html__( 'Social Menu', 'redrock' ),
		'colophon' => esc_html__( 'Colophon Menu', 'redrock' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
	) );
}
endif; // redrock_setup
add_action( 'after_setup_theme', 'redrock_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function redrock_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'redrock_content_width', 1140 );
}
add_action( 'after_setup_theme', 'redrock_content_width', 0 );

/**
 * Add Google webfonts
 *
 * - See: http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function redrock_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$rubik = esc_html_x( 'on', 'Rubik font: on or off', 'redrock' );

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$libre_baskerville = esc_html_x( 'on', 'Libre Baskerville font: on or off', 'redrock' );

	if ( 'off' !== $rubik || 'off' !== $libre_baskerville ) {
		$font_families = array();

		if ( 'off' !== $rubik ) {
			$font_families[] = 'Rubik:400,500,700,900,400italic,700italic';
		}

		if ( 'off' !== $libre_baskerville ) {
			$font_families[] = 'Libre Baskerville:700,900,400italic';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function redrock_scripts() {

	/**
	 * Styles
	 */
	wp_enqueue_style( 'redrock-fonts', redrock_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/font-awesome.css', array(), '20151022' );
	
	
	if (defined('WP_DEBUG') && true === WP_DEBUG) {
	    wp_enqueue_style( 'redrock-style', get_stylesheet_uri(), array(), time() );
	}
	else {
	    wp_enqueue_style( 'redrock-style', get_stylesheet_uri() );
	}

	/**
	 * Scripts
	 */

	wp_enqueue_script( 'redrock-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151112', true );

	wp_enqueue_script( 'redrock-theme-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'masonry' ), '20151130', true );
	wp_localize_script( 'redrock-theme-scripts', 'RedRock', array(
		'is_rtl' => ( 'rtl' == get_option( 'text_direction' ) ) ? 1 : 0,
	) );

	wp_enqueue_script( 'redrock-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151112', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'redrock-navigation', 'redrockScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'redrock' ),
		'collapse' => esc_html__( 'collapse child menu', 'redrock' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'redrock_scripts' );

/**
 * Check whether the browser supports JavaScript
 */
function redrock_html_js_class () {
	echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
}
add_action( 'wp_head', 'redrock_html_js_class', 1 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';