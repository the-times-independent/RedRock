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

function redrock_theme_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    }
    elseif (is_tag()) {
        $title = single_tag_title('', false);
    }
    elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    elseif (is_tax()) {
        $title = single_term_title('', false);
    }
  
    return $title;
}
add_filter('get_the_archive_title', 'redrock_theme_archive_title');