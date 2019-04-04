<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
<?php
        if (have_posts()) {
?>
            <header class="page-header">
<?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="taxonomy-description">', '</div>');
?>
            </header>
            <div id="post-list">
<?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/content', 'card');
                    }
                    the_posts_navigation();
?>
            </div>
<?php
        }
        else {
            get_template_part('template-parts/content', 'none');
        }
?>
    </main>
</div>

<?php get_footer(); ?>