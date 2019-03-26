<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RedRock
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function redrock_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'redrock_body_classes' );

function redrock_excerpt($excerpt, $raw_excerpt) {
    if( ! $raw_excerpt ) {
        $html_content = apply_filters( 'the_content', get_the_content() );
        if (empty($html_content)) {
            return "";
        }
        
        $domd = new DOMDocument();
        
        libxml_use_internal_errors(true);
        $domd->loadHTML('<?xml encoding="UTF-8">' . $html_content);
        libxml_use_internal_errors(false);
        
        $domx = new DOMXPath($domd);
        $items = $domx->query("/html/body/p[1]");
        if (empty($items)) {
            return "";
        }
        
        $excerpt = $items->item(0)->textContent;
    }
    return $excerpt;
}
add_filter( 'wp_trim_excerpt', 'redrock_excerpt', 10, 2 );

/**
 * Add conditional classes to posts
 */
function redrock_slug_post_classes( $classes ) {

	/**
	 * Adds clear fix to single posts
	 */
	if ( is_single() ) {
		$classes[] = 'clear-fix';
	}

	/**
	 * Use card display on archive and search pages
	 */
	if ( is_archive() || is_search() ) {
		$classes[] = 'card';
	}

	/*
	 * '.card' class not needed when using default page templates on front page
	 * - default page template conditional src: https://goo.gl/QOMYWP
	 */
	if ( ( is_page() && ! is_page_template() ) && is_front_page() ) {
		$classes[] = '';
	} elseif ( ( is_home() && ! is_page_template() ) || ( is_front_page() && ! is_page_template() ) ) {
		$classes[] = 'card';
	} else {
		$classes[] = '';
	}

	return $classes;
}
add_filter( 'post_class', 'redrock_slug_post_classes', 10, 3 );


add_filter( 'comment_form_default_fields', 'redrock_comment_placeholders' );
/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param	array $fields
 * @return array
 */
function redrock_comment_placeholders( $fields ) {
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="'
		/* Replace 'redrock' with your theme's text domain.
		 * I use _x() here to make your translators life easier. :)
		 * See http://codex.wordpress.org/Function_Reference/_x
		 */
		. esc_attr_x(
			'ex: jane doe',
			'comment form placeholder',
			'redrock'
			)
		. '"',
		$fields['author']
	);
	$fields['email'] = str_replace(
		'<input',
		/* We use a proper type attribute to make use of the browser's
		 * validation, and to get the matching keyboard on smartphones.
		 */
		'<input type="email" placeholder="'. esc_attr_x( 'ex: janedoe@gmail.com', 'Email input placeholder text', 'redrock' ) .'"',
		$fields['email']
	);
	$fields['url'] = str_replace(
		'<input',
		// Again: a better 'type' attribute value.
		'<input placeholder="' . esc_attr_x( 'ex: http://janedoe.wordpress.com', 'URL input placeholder text', 'redrock' ) . '"',
		$fields['url']
	);

	return $fields;
}