<?php

if (!defined("RR_SUBHEAD_QUERY_STRING")) {
    define("RR_SUBHEAD_QUERY_STRING", "/html/body/*[position()=1 and self::h2]");
}

if (!defined("RR_TOP_BLOCK_IMAGE_QUERY_STRING")) {
    define("RR_TOP_BLOCK_IMAGE_QUERY_STRING", "/html/body/*[(position()=1) or (position()=2 and preceding-sibling::h2)][@class='wp-block-image'][not(figure[contains(concat(' ', normalize-space(@class), ' '), ' alignleft ')])][not(figure[contains(concat(' ', normalize-space(@class), ' '), ' alignright ')])]");
}

function redrock_remove_top_elements(&$thePost) {
    if (empty($thePost)) {
        return "";
    }
    
    $topElementsDoc = new DOMDocument();
    $restOfPostDoc = new DOMDocument();
    
    libxml_use_internal_errors(true);
    $restOfPostDoc->loadHTML('<?xml encoding="UTF-8">' . $thePost);
    libxml_use_internal_errors(false);
    
    $xpath = new DOMXPath($restOfPostDoc);
    
    $subhead = $xpath->query(RR_SUBHEAD_QUERY_STRING);
    
    $topBlockImage = $xpath->query(RR_TOP_BLOCK_IMAGE_QUERY_STRING);
    
    if ($subhead->length != 0) {
        $subhead = $subhead->item(0);
        $subhead = $subhead->parentNode->removeChild($subhead);
        $topElementsDoc->appendChild($topElementsDoc->importNode($subhead, true));
    }
    
    if ($topBlockImage->length != 0) {
        $topBlockImage = $topBlockImage->item(0);
        $topBlockImage = $topBlockImage->parentNode->removeChild($topBlockImage);
        $topElementsDoc->appendChild($topElementsDoc->importNode($topBlockImage, true));
    }
    
    $thePost = $restOfPostDoc->saveHTML();
    
    return $topElementsDoc->saveHTML();
}
