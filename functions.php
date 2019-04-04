<?php

function redrock_setup() {
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('custom-logo', array(
		'height'      => 150,
		'width'       => 1500,
		'flex-width'  => true,
		'header-text' => array(
			'site-title',
			'site-description'
		),
	));
	
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(720, 1200);
	add_image_size('redrock-archive', 560, 9999);
	
	register_nav_menus(array(
		'header' => "Header Menu",
		'social'  => "Social Menu",
		'colophon' => "Colophon Menu"
    ));
	
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
	
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
    ));
}
add_action('after_setup_theme', 'redrock_setup');

function redrock_content_width() {
	$GLOBALS['content_width'] = apply_filters('redrock_content_width', 1140);
}
add_action('after_setup_theme', 'redrock_content_width', 0);

function redrock_fonts_url() {
	$font_families[] = 'Libre Baskerville:700,900,400italic';
	$font_families[] = 'Rubik:400,500,700,900,400italic,700italic';

    $query_args = array(
        'family' => urlencode(implode('|', $font_families)),
        'subset' => urlencode('latin,latin-ext'),
   );

    $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

	return esc_url_raw($fonts_url);
}

function redrock_scripts() {
	wp_enqueue_style('redrock-fonts', redrock_fonts_url(), array(), null);
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/font-awesome.css', array(), '20151022');
	
	if (defined('WP_DEBUG') && true === WP_DEBUG) {
	    wp_enqueue_style('redrock-style', get_stylesheet_uri(), array(), time());
	}
	else {
	    wp_enqueue_style('redrock-style', get_stylesheet_uri());
	}
	
	wp_enqueue_script('redrock-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151112', true);
	wp_enqueue_script('redrock-theme-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'masonry'), '20151130', true);
	wp_enqueue_script('redrock-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151112', true);
    
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_localize_script('redrock-navigation', 'redrockScreenReaderText', array(
		'expand'   => esc_html__('expand child menu', 'redrock'),
		'collapse' => esc_html__('collapse child menu', 'redrock'),
    ));
}
add_action('wp_enqueue_scripts', 'redrock_scripts');

function redrock_html_js_class () {
	echo "<script>document.documentElement.className = document.documentElement.className.replace('no-js','js');</script>" . "\n";
}
add_action('wp_head', 'redrock_html_js_class', 1);

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/plugin-enhancements.php';