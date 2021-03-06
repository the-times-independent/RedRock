<?php
/**
 * Template part for displaying results in search pages.
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
<?php
    if (redrock_has_post_thumbnail()) {
?>
        <div class="entry-image-section">
            <a href="<?php the_permalink() ?>" class="entry-image-link">
                <figure class="entry-image">
                    <?php the_post_thumbnail('redrock-archive'); ?>
                </figure>
            </a>
        </div>
<?php
    }
?>
	<header class="entry-header">
		<?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>
		<div class="entry-meta">
			<?php redrock_entry_meta(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

</article>
