<?php
/**
 * Tweaks of various admin panels that make them nicer to use.
 *
 * @package RedRock
 */
 
add_action(
    'admin_head-post-new.php',
    function() {
        global $publicize_ui;
        remove_action('post_submitbox_misc_actions', array($publicize_ui, 'post_page_metabox'));
    }
);