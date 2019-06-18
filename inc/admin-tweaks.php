<?php
/**
 * Protects admin panels from public access
 *
 * @package RedRock
 */

add_filter(
    'show_admin_bar',
    function($show) {
        if ($show && current_user_can('edit_posts')) {
            return true;
        }
        else {
            return false;
        }
    }
);