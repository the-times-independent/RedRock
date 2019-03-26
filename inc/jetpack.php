<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package RedRock
 */

/**
 * Jetpack Setup
 */
function redrock_jetpack_setup() {

	// Custom logo fallback
	// - Use Jetpack logo if theme does not support custom logo
	if ( ! current_theme_supports( 'custom-logo' ) ) {
		// Add support for Jetpack site logo
		add_image_size( 'redrock_site_logo', 0, 80 );
		$args = array(
			'header-text' => array(
				'site-title',
				'site-description',
			),
			'size' => 'redrock_site_logo',
		);
		add_theme_support( 'site-logo', $args );
	}

	// Featured content
	add_theme_support( 'featured-content', array(
		'filter'     => 'redrock_get_featured_posts'
	) );

	// Add theme support for Responsive Videos.
	// See: https://jetpack.com/support/responsive-videos/
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	// See: https://jetpack.com/support/content-options/
	add_theme_support( 'jetpack-content-options', array(
		'blog-display'    => 'excerpt',
		'masonry'         => '#post-list',
		'author-bio'      => true,
		'post-details'    => array(
			'stylesheet' => 'redrock-style',
			'date'       => '.entry-tags-date',
			'categories' => '.entry-categories',
			'tags'       => '.entry-tags',
			'author'     => '.entry-meta .author',
		),
		'featured-images' => array(
			'archive'    => true,
			'post'       => true,
			'fallback'   => true,
		),
	) );
} // end function redrock_jetpack_setup
add_action( 'after_setup_theme', 'redrock_jetpack_setup' );

/**
 * Getter function for Featured Content
 *
 * @return (string) The value of the filter defined in add_theme_support( 'featured-content' )
 */
function redrock_get_featured_posts() {
	return apply_filters( 'redrock_get_featured_posts', array() );
}

/**
 * Helper function to check for Featured Content
 *
 * @param (integer)
 * @return (boolean) true/false
 */
function redrock_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() ) {
		return false;
	}

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'redrock_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) ) {
		return false;
	}

	if ( $minimum > count( $featured_posts ) ) {
		return false;
	}

	return true;
}

function redrock_get_featured_ids() {
	// Get array of cached results if they exist.
	$featured_ids = get_transient( 'featured_content_ids' );

	if ( false === $featured_ids ) {
		$settings = get_theme_mods();
		$term = get_term_by( 'name', $settings['tag-name'], 'post_tag' );

		if ( $term ) {
			// Query for featured posts.
			$featured_ids = get_posts( array(
				'fields'           => 'ids',
				'numberposts'      => $max_posts,
				'post_type'        => 'post',
				'suppress_filters' => false,
				'tax_query'        => array(
					array(
					'field'    => 'term_id',
					'taxonomy' => 'post_tag',
					'terms'    => $term->term_id,
					),
				),
				)
			);
		}

		set_transient( 'featured_content_ids', $featured_ids );
	}

	// Ensure correct format before return.
	return array_map( 'absint', $featured_ids );
}

/**
 * Return Author Bio
 * If Jetpack is not available, fall back to redrock_author_meta()
 */
function redrock_author_bio() {
	if ( ! function_exists( 'jetpack_author_bio' ) ) {
		redrock_author_meta();
	} else {
		jetpack_author_bio();
	}
}

/**
 * Author Author Bio Avatar Size
 */
function redrock_author_bio_avatar_size() {
	return 111;
}
add_filter( 'jetpack_author_bio_avatar_size', 'redrock_author_bio_avatar_size' );

/**
 * Custom function to check for a post thumbnail
 * If Jetpack is not available, fall back to has_post_thumbnail()
 */
function redrock_has_post_thumbnail( $post = null ) {
	if ( function_exists( 'jetpack_has_featured_image' ) ) {
		return jetpack_has_featured_image( $post );
	} else {
		return has_post_thumbnail( $post );
	}
}

/**
 * Disable Lazy Loading on non-singular views
 *
 * @filter lazyload_is_enabled
 * @return bool
 */
add_action( 'wp', 'redrock_remove_lazy_load_hooks' );
function redrock_remove_lazy_load_hooks() {
    if ( is_singular() || ! class_exists( 'Jetpack_Lazy_Images' ) ) {
        return;
    }

    $instance = Jetpack_Lazy_Images::instance();
    add_action( 'wp_head', array( $instance, 'remove_filters' ), 10000 );
    remove_action( 'wp_enqueue_scripts', array( $instance, 'enqueue_assets' ) );
}
