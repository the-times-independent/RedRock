<?php

function redrock_get_fallback_featured_image_id($post_id) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    if (is_page($post_id)) {
        return false;
    }
    
    $html_content = apply_filters('the_content', get_post_field('post_content', $post_id));
    
    if (empty($html_content)) {
        return false;
    }
    
    $domd = new DOMDocument();
    
    libxml_use_internal_errors(true);
    $domd->loadHTML('<?xml encoding="UTF-8">' . $html_content);
    libxml_use_internal_errors(false);
    
    $domx = new DOMXPath($domd);
    
    $imageID = false;
    
    if (has_post_format("video")) {
        $imageID = redrock_get_video_poster_id($domx);
    }
    else {
        $imageID = redrock_get_top_image_id($domx);
    }
    
    if (!$imageID) {
        $imageID = redrock_get_largest_image_id($domx);
    }
    
    return $imageID;
}

function redrock_featured_image_id($value, $post_id = '', $meta_key = '') {
    if ($meta_key != "_thumbnail_id" || is_admin()) {
        return $value;
    }
    
    $meta_cache = wp_cache_get($post_id, "post_meta");
 
    if (!$meta_cache) {
        $meta_cache = update_meta_cache("post", array($post_id));
        $meta_cache = $meta_cache[$post_id];
    }
 
    if (isset($meta_cache[$meta_key])) {
        return maybe_unserialize($meta_cache[$meta_key][0]);
    }
    else {
        return redrock_get_fallback_featured_image_id($post_id);
    }
}
add_filter('get_post_metadata', 'redrock_featured_image_id', 100, 4);

function redrock_text_excerpt_video_or_photo($domx) {
    $paraItem = $domx->query("/html/body/p[1]");
    
    if ($paraItem->length == 0) {
        $captionItem = $domx->query("/html/body/figure[1]/figcaption[1]");
        
        if (!($captionItem->length == 0)) {
            return $captionItem->item(0)->textContent;
        }
    }
    else {
        return $paraItem->item(0)->textContent;
    }
    
    return "";
}

function redrock_excerpt($excerpt) {
    if (!has_excerpt()) {
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
        else if (has_post_format(array("video", "image"))) {
            return redrock_text_excerpt_video_or_photo($domx);
        }
        else {
            $items = $domx->query("/html/body/p[1]");
        }
        
        if ($items->length == 0) {
            return "";
        }
        
        $excerpt = $items->item(0)->textContent;
    }
    return $excerpt;
}
add_filter('get_the_excerpt', 'redrock_excerpt');

function redrock_get_video_poster_id($domx) {
    $items = $domx->query("/html/body//video/@poster");

    if (!($items->length == 0)) {
        return redrock_id_from_url($items->item(0)->nodeValue);
    }
    return false;
}

function redrock_get_top_image_id($domx) {
    global $redrockTopBlockImageQueryString;
    $items = $domx->query($redrockTopBlockImageQueryString);

    if ($items->length > 0) {
        return $items->item(0)
            ->getElementsByTagName("img")->item(0)
            ->getAttribute("data-attachment-id");
    }
    return false;
}

function redrock_get_largest_image_id($domx) {
    $image_tags = $domx->query("/html/body//img");
    
    $largestImage = array(
        'pixels' => 0,
        'id' => false
    );
    
    foreach ($image_tags as $image_tag) {
        $img_src = $image_tag->getAttribute('src');

        if (empty($img_src)) {
            continue;
        }
        
        $imageSizeText = $image_tag->getAttribute('data-orig-size');
        
        if (!$image_tag->hasAttribute('data-orig-size')) {
            continue;
        }
        
        preg_match("/^(\d+),(\d+)$/", $imageSizeText, $output);
        
        if (!array_key_exists(2, $output)) {
            continue;
        }
        
        $pixels = ((int) $output[1]) * ((int) $output[2]);
        
        if ($pixels > $largestImage['pixels']) {
            $largestImage = array(
                'pixels' => $pixels,
                'id' => $image_tag->getAttribute('data-attachment-id'),
            );
        }
    }
    
    return $largestImage['id'];
}

function redrock_id_from_url($url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url )); 
    return $attachment[0]; 
}