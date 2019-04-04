<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package RedRock
 */

function redrock_jetpack_setup() {
	if (!current_theme_supports('custom-logo')) {
		add_image_size('redrock_site_logo', 0, 80);
		$args = array(
			'header-text' => array(
				'site-title',
				'site-description',
			),
			'size' => 'redrock_site_logo',
		);
		add_theme_support('site-logo', $args);
	}
	
	add_theme_support('featured-content', array(
		'filter' => 'redrock_get_featured_posts'
	));
	
	add_theme_support('jetpack-responsive-videos');
	
	add_theme_support('jetpack-content-options', array(
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
	));
}
add_action('after_setup_theme', 'redrock_jetpack_setup');

function redrock_get_featured_posts() {
	return apply_filters('redrock_get_featured_posts', array());
}

function redrock_has_featured_posts($minimum = 1) {
	if (is_paged()) {
		return false;
	}

	$minimum = absint($minimum);
	$featured_posts = apply_filters('redrock_get_featured_posts', array());

	if (! is_array($featured_posts)) {
		return false;
	}

	if ($minimum > count($featured_posts)) {
		return false;
	}

	return true;
}

function redrock_get_featured_ids() {
	$featured_ids = get_transient('featured_content_ids');

	if (false === $featured_ids) {
		$settings = get_theme_mods();
		$term = get_term_by('name', $settings['tag-name'], 'post_tag');

		if ($term) {
			$featured_ids = get_posts(array(
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

		set_transient('featured_content_ids', $featured_ids);
	}
	
	return array_map('absint', $featured_ids);
}

function redrock_author_bio() {
	if (! function_exists('jetpack_author_bio')) {
		redrock_author_meta();
	} else {
		jetpack_author_bio();
	}
}

function redrock_author_bio_avatar_size() {
	return 111;
}
add_filter('jetpack_author_bio_avatar_size', 'redrock_author_bio_avatar_size');

function redrock_has_post_thumbnail($post = null) {
	if (function_exists('jetpack_has_featured_image')) {
		return jetpack_has_featured_image($post);
	} else {
		return has_post_thumbnail($post);
	}
}

add_action('wp', 'redrock_remove_lazy_load_hooks');
function redrock_remove_lazy_load_hooks() {
    if (is_singular() || ! class_exists('Jetpack_Lazy_Images')) {
        return;
    }

    $instance = Jetpack_Lazy_Images::instance();
    add_action('wp_head', array($instance, 'remove_filters'), 10000);
    remove_action('wp_enqueue_scripts', array($instance, 'enqueue_assets'));
}