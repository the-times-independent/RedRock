<?php
class RROpenGraphImageDefault {
    public function __construct() {
        add_action('customize_register', array($this, 'register_setting_panel'));
    }
    
    public function register_setting_panel($wp_customize)
    {
        $wp_customize->add_setting('open_graph_image_default');
        $wp_customize->add_control(
            new WP_Customize_Media_Control($wp_customize, 'open_graph_image_default',
                array(
                    'label' => 'Default Open Graph image',
                    'section' => 'title_tagline',
                    'settings' => 'open_graph_image_default'
                )
            )
        );
    }
}

new RROpenGraphImageDefault();