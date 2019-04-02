<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package RedRock
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
        if ( have_posts() ):
            get_search_form();
    ?>
            <div id="post-list">
                <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'card' );
                    endwhile;
                    the_posts_navigation();
                ?>
            </div>
    <?php
        else:
            get_template_part( 'template-parts/content', 'none' );
        endif;
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
