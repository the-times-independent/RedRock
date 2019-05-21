<?php

add_filter( 'jetpack_enable_open_graph', '__return_false' );

function redrockGetHomepageProperties(&$metaPropertyDict) {
    $metaPropertyDict['og:type'] = 'website';
    $metaPropertyDict['og:title'] = get_bloginfo('name');
    $metaPropertyDict['og:description'] = get_bloginfo('description');
    
    $front_page_id = get_option('page_for_posts');
    
    if ('page' == get_option('show_on_front') && $front_page_id && is_home()) {
        $metaPropertyDict['og:url'] = get_permalink($front_page_id);
    }
    else {
        $metaPropertyDict['og:url'] = home_url('/');
    }
}

function redrockGetAuthorMeta(&$metaPropertyDict) {
    $metaPropertyDict['og:type'] = 'profile';
    $author = get_queried_object();
    $metaPropertyDict['og:title'] = $author->display_name;
    
    if (!empty($author->user_url)) {
        $metaPropertyDict['og:url'] = $author->user_url;
    }
    else {
        $metaPropertyDict['og:url'] = get_author_posts_url($author->ID);
    }
    
    $metaPropertyDict['og:description'] = $author->description;
    $metaPropertyDict['profile:first_name'] = get_the_author_meta('first_name', $author->ID);
    $metaPropertyDict['profile:last_name'] = get_the_author_meta('last_name', $author->ID);
}

function redrockGetPostMeta(&$metaPropertyDict) {
    $metaPropertyDict['og:type'] = 'article';
    
    global $post;
    $data = $post;
    
    $metaPropertyDict['og:title'] = wp_kses(apply_filters('the_title', $data->post_title, $data->ID), array());
    $metaPropertyDict['og:url'] = get_permalink($data->ID);
    
    if (!post_password_required()) {
        $metaPropertyDict['og:description'] = get_the_excerpt($data->ID);
    }
    
    $metaPropertyDict['og:description'] = wp_kses(trim(convert_chars(wptexturize(
        $metaPropertyDict['og:description']
    ))), array());

    $metaPropertyDict['article:published_time'] = date('c', strtotime($data->post_date_gmt));
    $metaPropertyDict['article:modified_time'] = date('c', strtotime($data->post_modified_gmt));
    
    if (post_type_supports(get_post_type($data), 'author') && isset($data->post_author)) {
        $publicize_facebook_user = get_post_meta($data->ID, '_publicize_facebook_user', true);
        if (!empty($publicize_facebook_user)) {
            $metaPropertyDict['article:author'] = esc_url($publicize_facebook_user);
        }
    }
}

function redrockAddVideoPostMeta(&$metaPropertyDict) {
    $videoID = get_attached_media("video")[0]->ID;
    $videoURL = wp_get_attachment_url($videoID);
    
    $metaPropertyDict['og:video'] = $videoURL;
    $metaPropertyDict['og:video:secure_url'] = $videoURL;
}

function redrockAddAudioPostMeta(&$metaPropertyDict) {
    $audioID = get_attached_media("audio")[0]->ID;
    $audioURL = wp_get_attachment_url($audioID);
    
    $metaPropertyDict['og:audio'] = $audioURL;
    $metaPropertyDict['og:audio:secure_url'] = $audioURL;
}

function redrock_open_graph() {
    $metaPropertyDict = array();
    
    $metaPropertyDict["og:image"] = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$metaPropertyDict["og:image"]) {
        $metaPropertyDict["og:image"] = wp_get_attachment_image_url(get_theme_mod("open_graph_image_default"), "full");
    }
    
	if (is_home() || is_front_page()) {
		redrockGetHomepageProperties($metaPropertyDict);
	}
	else if (is_author()) {
		redrockGetAuthorMeta($metaPropertyDict);
	}
	else if (is_single()) {
	    redrockGetPostMeta($metaPropertyDict);
	    
	    if (get_post_type() == "video") {
	        redrockAddVideoPostMeta($metaPropertyDict);
	    }
	    else if (get_post_type() == "audio") {
	        redrockAddAudioPostMeta($metaPropertyDict);
	    }
	}
	
	foreach ($metaPropertyDict as $tag_property => $tag_content) {
        if (empty($tag_content)) {
            continue;
        }
        echo sprintf('<meta property="%s" content="%s" />', esc_attr($tag_property), esc_attr($tag_content));
        echo "\n";
    }
    
?>
	<meta property="og:locale" content="<?php echo get_locale(); ?>" />

	<meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:site" content="@MoabTimes" />
    <meta property="twitter:title" content="<?php echo $metaPropertyDict['og:title']; ?>" />
    <meta property="twitter:description" content="<?php echo $metaPropertyDict['og:description']; ?>" />
    <meta property="twitter:image" content="<?php echo $metaPropertyDict['og:image']; ?>" />
    
<?php
}
add_action('wp_head', 'redrock_open_graph');

function redrock_get_default_social_image() {
    return "";
}