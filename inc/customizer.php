<?php
/**
 * RedRock Theme Customizer.
 *
 * @package RedRock
 */

function redrock_customize_register($wp_customize) {
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}
add_action('customize_register', 'redrock_customize_register');

function redrock_customize_preview_js() {
	wp_enqueue_script('redrock_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20131205', true);
}
add_action('customize_preview_init', 'redrock_customize_preview_js');

function remove_styles_sections($wp_customize) {
    $wp_customize->remove_control('site_icon');
}
add_action('customize_register', 'remove_styles_sections');