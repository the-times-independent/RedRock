<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RedRock
 */

function redrock_body_classes($classes) {
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter('body_class', 'redrock_body_classes');

function redrock_excerpt($excerpt, $raw_excerpt) {
    if(! $raw_excerpt) {
        $html_content = apply_filters('the_content', get_the_content());
        if (empty($html_content)) {
            return "";
        }
        
        $domd = new DOMDocument();
        
        libxml_use_internal_errors(true);
        $domd->loadHTML('<?xml encoding="UTF-8">' . $html_content);
        libxml_use_internal_errors(false);
        
        $domx = new DOMXPath($domd);
        
        if (in_category("letter-to-the-editor")) {
            $items = $domx->query("/html/body/p[2]");
        }
        else {
            $items = $domx->query("/html/body/p[1]");
        }
        
        if (empty($items)) {
            return "";
        }
        
        $excerpt = $items->item(0)->textContent;
    }
    return $excerpt;
}
add_filter('wp_trim_excerpt', 'redrock_excerpt', 10, 2);

function redrock_slug_post_classes($classes) {
	if (is_single()) {
		$classes[] = 'clear-fix';
	}
	
	if (is_archive() || is_search()) {
		$classes[] = 'card';
	}
	
	if ((is_page() && ! is_page_template()) && is_front_page()) {
		$classes[] = '';
	}
	elseif ((is_home() && ! is_page_template()) || (is_front_page() && ! is_page_template())) {
		$classes[] = 'card';
	}
	else {
		$classes[] = '';
	}

	return $classes;
}
add_filter('post_class', 'redrock_slug_post_classes', 10, 3);

function redrock_comment_placeholders($fields) {
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="' . esc_attr('ex: jane doe') . '"',
		$fields['author']
	);
	$fields['email'] = str_replace(
		'<input',
		'<input type="email" placeholder="'. esc_attr('ex: janedoe@gmail.com') .'"',
		$fields['email']
	);
	$fields['url'] = str_replace(
		'<input',
		'<input placeholder="' . esc_attr('ex: http://janedoe.wordpress.com') . '"',
		$fields['url']
	);

	return $fields;
}
add_filter('comment_form_default_fields', 'redrock_comment_placeholders');