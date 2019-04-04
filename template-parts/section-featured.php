<?php
/**
 * The template part for displaying Featured Content via Jetpack featured-content settings
 *
 * Learn more: http://jetpack.me/support/featured-content/
 *
 * @package RedRock
 */

$featured = redrock_get_featured_posts();

if (empty($featured)) {
    return;
}

foreach ($featured as $post) {
    setup_postdata($post);
    $hasThumbnail = redrock_has_post_thumbnail();
?>
    <section id="feature" class="site-feature clear-fix">

        <?php $thumbclass = ($hasThumbnail ? '' : 'no-thumbnail'); ?>
        <article id="post-<?php the_ID(); ?>" class="hentry featured-post <?php echo $thumbclass; ?>">
<?php
            if ($hasThumbnail) {
?>
                <a class="post-thumbnail" href="<?php the_permalink() ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>
<?php
            }
?>
            <header class="entry-header">
                <?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
                <div class="entry-meta">
                    <?php redrock_entry_footer(); ?>
                </div>
            </header>

        </article>
    </section>

<?php
}

wp_reset_postdata();