<?php

function redrock_remove_erroneous_content_whitespace($content) {
    $content = str_replace('&nbsp;', ' ', $content);
    $content = preg_replace('/^<p>\h+/m', '<p>', $content);
    $content = preg_replace('/\h+<\/p>$/m', '</p>', $content);
    $content = preg_replace('/\h\h+/', ' ', $content);
    return $content;
}

function redrock_filter_content($content) {
    return redrock_remove_erroneous_content_whitespace($content);
}
add_filter('content_save_pre','redrock_filter_content');


function redrock_remove_erroneous_title_whitespace($text) {
    $text = preg_replace('/ *&nbsp; */', '&nbsp;', $text);
    $text = preg_replace('/^\s+/m', '', $text);
    $text = preg_replace('/\s+$/m', '', $text);
    $text = preg_replace('/\s\s+/', ' ', $text);
    return $text;
}

function redrock_filter_title($title) {
    return redrock_remove_erroneous_title_whitespace($title);
}
add_filter('title_save_pre','redrock_filter_title');