<?php
/**
 * Template part for displaying posts in a grid display for masonry
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */
?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class(); ?>
>
    <a
        class="card-link"
        href="<?php the_permalink() ?>"
        rel="bookmark"
    >
<?php
        if ( redrock_has_post_thumbnail() ) {
?>
            <div class="entry-image-section">
                <figure class="entry-image">
                    <?php the_post_thumbnail( 'redrock-archive' ); ?>
                </figure>
            </div>
<?php
        }
?>

        <header class="entry-header">
<?php
            the_title("<h1 class='entry-title'>", "</h1>");
            redrock_the_subtitle("<h2 class='entry-subtitle'>", "</h2>");
            ?><div class="entry-meta"><?php
                redrock_entry_meta(['withLinks' => false]);
            ?></div><?php
?>
        </header>

        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
    </a>

    <footer class="entry-meta">
        <?php redrock_entry_footer(); ?>
    </footer>
</article>