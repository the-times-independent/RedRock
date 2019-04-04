<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RedRock
 */

function redrock_site_logo() {
    if (function_exists('the_custom_logo') && current_theme_supports('custom-logo')) {
        the_custom_logo();
    } elseif (function_exists('jetpack_the_site_logo')) {
        jetpack_the_site_logo();
    } else {
        return;
    }
}

function redrock_entry_meta() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }
    
    $time_string = sprintf($time_string,
        esc_attr(get_the_date('c')),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date('c')),
        esc_html(get_the_modified_date())
    );
  
    $entry_meta_output = '';
    
    $author = '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>';
    
    $post_date = '<span class="entry-tags-date"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a></span>';
    
    $categories_list = get_the_term_list(get_the_ID(), 'category', '<span class="entry-categories">', esc_html_x(', ', 'Categories separator', 'redrock'), '</span>');

    $entry_meta_output .= $author;
    $entry_meta_output .= $post_date;
    $entry_meta_output .= $categories_list;
    echo $entry_meta_output;
    
    edit_post_link(
        sprintf(
            'Edit %s',
            the_title('<span class="screen-reader-text">"', '"</span>', false)
      ),
        '<span class="edit-link">',
        '</span>'
  );
}


function redrock_entry_footer() {
    edit_post_link(
        sprintf(
            esc_html__('Edit %s', 'redrock'),
            the_title('<span class="screen-reader-text">"', '"</span>', false)
        ),
        '<span class="edit-link">',
        '</span>'
  );
}

function redrock_author_meta() {
    if (get_the_author_meta('description')) {
        ?>
            <div class="author-meta clear-fix">
                <div class="author-box">
                    <div class="author-information">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('redrock_author_bio_avatar_size', 111)); ?>
                        </div>
                        <h3><?php printf(esc_attr__('About %s', 'redrock'), get_the_author()); ?></h3>
                        <div class="author-description">
                            <?php the_author_meta('description'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}

function redrock_the_attached_image() {
    $post = get_post();
    
    $attachment_size = 'full';
    $next_attachment_url = wp_get_attachment_url();

    if ($post->post_parent) {
        $attachment_ids = get_posts(array(
            'post_parent'    => $post->post_parent,
            'fields'         => 'ids',
            'numberposts'    => 999,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'ASC',
            'orderby'        => 'menu_order ID',
        ));
      
        if (count($attachment_ids) > 1) {
            foreach ($attachment_ids as $idx => $attachment_id) {
                if ($attachment_id == $post->ID) {
                    $next_id = $attachment_ids[ ($idx + 1) % count($attachment_ids) ];
                    break;
                }
            }
            
            if ($next_id) {
                $next_attachment_url = get_attachment_link($next_id);
            }
            else {
                $next_attachment_url = get_attachment_link(reset($attachment_ids));
            }
        }
    }

    printf('<a href="%1$s" rel="attachment">%2$s</a>',
        esc_url($next_attachment_url),
        wp_get_attachment_image($post->ID, $attachment_size)
  );
}
    
function redrock_categorized_blog() {
	if (false === ($all_the_cool_cats = get_transient('redrock_categories'))) {
		$all_the_cool_cats = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		));
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('redrock_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		return true;
	}
	else {
		return false;
	}
}

function redrock_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	
	delete_transient('redrock_categories');
}
add_action('edit_category', 'redrock_category_transient_flusher');
add_action('save_post',     'redrock_category_transient_flusher');