<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RedRock
 */

if ( ! function_exists( 'redrock_site_logo' ) ) :
/**
 * Fall back to Jetpack site logo if core logo doesn't exist
 * @todo remove for WP 4.7
 */
function redrock_site_logo() {
	if ( function_exists( 'the_custom_logo' ) && current_theme_supports( 'custom-logo' ) ) {
		the_custom_logo();
	} elseif ( function_exists( 'jetpack_the_site_logo' ) ) {
		jetpack_the_site_logo();
	} else {
		return;
	}
}
endif;


if ( ! function_exists( 'redrock_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, categories, tags and author.
 */
function redrock_entry_meta() {

	// Get time string
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	// Format time string
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Output variable
	$entry_meta_output = '';
	// Author
	$author = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	// Post date
	$post_date = '<span class="entry-tags-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
	// Categories
	$categories_list = get_the_term_list( get_the_ID(), 'category', '<span class="entry-categories">', esc_html_x( ', ', 'Categories separator', 'redrock' ), '</span>' );

    $entry_meta_output .= $author;
    $entry_meta_output .= $post_date;
    $entry_meta_output .= $categories_list;
    echo $entry_meta_output; // WPCS: XSS OK.

	// Edit link
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'redrock' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'redrock_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the tags, project-tags and edit links.
 */
function redrock_entry_footer() {

	// Posts
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'redrock' ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			echo '<span class="entry-tags">' . $tags_list . '</span>';
		}
	}

	// Edit link
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'redrock' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'redrock_author_meta' ) ) :
/**
 * Prints HTML with meta information for the tags, project-tags and edit links.
 */
function redrock_author_meta() {
// If a user has filled out their description, show a bio on their entries
if ( get_the_author_meta( 'description' ) ) { ?>
	<div class="author-meta clear-fix">
		<div class="author-box">
			<div class="author-information">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'redrock_author_bio_avatar_size', 111 ) ); ?>
				</div><!-- #author-avatar -->
				<h3><?php printf( esc_attr__( 'About %s', 'redrock' ), get_the_author() ); ?></h3>
				<div class="author-description">
					<?php the_author_meta( 'description' ); ?>
				</div>
			</div><!-- #author-description -->
		</div>
	</div><!-- #author-meta-->
<?php }
}
endif;

if ( ! function_exists('redrock_the_attached_image')) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function redrock_the_attached_image() {
	$post = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @param array $dimensions {
	 * An array of height and width dimensions.
	 *
	 * @type int $height Height of the image in pixels. Default 810.
	 * @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size = 'full';
	$next_attachment_url = wp_get_attachment_url();

	if ( $post->post_parent ) {
		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
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

		// If there is more than 1 attachment in a gallery...
		if (count($attachment_ids) > 1) {
			foreach ($attachment_ids as $idx => $attachment_id) {
				if ($attachment_id == $post->ID) {
					$next_id = $attachment_ids[ ( $idx + 1 ) % count( $attachment_ids ) ];
					break;
				}
			}

			// get the URL of the next image attachment...
			if ($next_id) {
				$next_attachment_url = get_attachment_link($next_id);
			}

			// or get the URL of the first image attachment.
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
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function redrock_categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'redrock_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'redrock_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so redrock_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so redrock_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in redrock_categorized_blog.
 */
function redrock_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'redrock_categories' );
}
add_action( 'edit_category', 'redrock_category_transient_flusher' );
add_action( 'save_post',     'redrock_category_transient_flusher' );
