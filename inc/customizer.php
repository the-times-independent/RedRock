<?php
/**
 * RedRock Theme Customizer.
 *
 * @package RedRock
 */

/**
 * Implement Customizer additions and adjustments.
 *
 * @since RedRock 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function redrock_customize_register( $wp_customize ) {
	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'redrock_customize_register' );

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since RedRock 1.0
 */
function redrock_customize_preview_js() {
	wp_enqueue_script( 'redrock_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'redrock_customize_preview_js' );
