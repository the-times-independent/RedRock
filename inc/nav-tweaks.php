<?php

if (class_exists('RR_PostsLinkAttributesTweaker')) {
    new RR_PostsLinkAttributesTweaker;
    return;
}

class RR_PostsLinkAttributesTweaker {
    function __construct() {
        add_filter('previous_posts_link_attributes', array($this, "redrock_posts_link_attributes"));
        add_filter('next_posts_link_attributes', array($this, "redrock_posts_link_attributes"));
    }
    
    function redrock_posts_link_attributes() {
        return "class='button'";
    }
}

new RR_PostsLinkAttributesTweaker;
