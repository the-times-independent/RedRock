<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */
 
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area clear-fix">
<?php
	    if (have_comments()) {
?>
            <h2 class="comments-title">
<?php
                    printf(
                        esc_html(
                            _nx(
                                '1 Comment', '%1$s Comments',
                                get_comments_number(),
                                'comments title',
                                'redrock'
                            )
                        ),
                        number_format_i18n(get_comments_number())
                    );
?>
            </h2>
<?php
            if (get_comment_pages_count() > 1 && get_option('page_comments')) {
?>
                <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                    <h2 class="screen-reader-text">Comment navigation</h2>
                    <div class="nav-links">
<?php
                            if (get_previous_comments_link()) {
?>
                                <div class="nav-previous"><?php previous_comments_link("Older Comments"); ?></div>
<?php
                            }
                            
                            if (get_next_comments_link()) {
?>
                                <div class="nav-next"><?php next_comments_link("Newer Comments"); ?></div>
<?php
                            }
?>
                    </div>
                </nav>
<?php
            }
?>

            <ol class="comment-list">
<?php
                    wp_list_comments(array(
                        'style'       => 'ol',
                        'avatar_size' => 111,
                        'short_ping'  => true,
                   ));
?>
            </ol>
<?php
            if (get_comment_pages_count() > 1 && get_option('page_comments')) {
?>
                <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                    <h2 class="screen-reader-text">Comment navigation</h2>
                    <div class="nav-links">
<?php
                            if (get_previous_comments_link()) {
?>
                                <div class="nav-previous"><?php previous_comments_link("Older Comments"); ?></div>
<?php
                            }
                            
                            if (get_next_comments_link()) {
?>
                                <div class="nav-next"><?php next_comments_link("Newer Comments"); ?></div>
<?php
                            }
?>
                    </div>
                </nav>
<?php
            }
        }
        
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) {
?>
            <p class="no-comments">Comments are closed.</p>
<?php
        }
        comment_form(array("label_submit" => "Submit"));
?>

</div>
