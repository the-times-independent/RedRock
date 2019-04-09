<?php

function redrock_remove_erroneous_content_whitespace($text) {
    $text = str_replace('&nbsp;', ' ', $text);
    $text = preg_replace('/^<p>\h+/m', '<p>', $text);
    $text = preg_replace('/\h+<\/p>$/m', '</p>', $text);
    $text = preg_replace('/\h\h+/', ' ', $text);
    return $text;
}
add_filter('content_save_pre','redrock_remove_erroneous_content_whitespace');


function redrock_remove_erroneous_title_whitespace($text) {
    $text = preg_replace('/ *&nbsp; */', '&nbsp;', $text);
    $text = preg_replace('/^\s+/m', '', $text);
    $text = preg_replace('/\s+$/m', '', $text);
    $text = preg_replace('/\s\s+/', ' ', $text);
    return $text;
}
add_filter('title_save_pre','redrock_remove_erroneous_title_whitespace');