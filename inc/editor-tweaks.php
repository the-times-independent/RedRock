<?php

function redrock_remove_erroneous_whitespace($text) {
    $text = str_replace('&nbsp;', ' ', $text);
    $text = preg_replace('/^<p>\s+/m', '<p>', $text);
    $text = preg_replace('/\s+<\/p>$/m', '</p>', $text);
    $text = preg_replace('/\h\h+/', ' ', $text);
    return $text;
}

function redrock_filter_content($content) {
    return redrock_remove_erroneous_whitespace($content);
}
add_filter('content_save_pre','redrock_filter_content');