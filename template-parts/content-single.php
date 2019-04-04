<?php
/**
 * Template part for displaying single posts.
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
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<div class="entry-meta">
			<?php redrock_entry_meta(); ?>
		</div>
	</header>

<?php
	if (redrock_has_post_thumbnail()) {
?>
        <div class="post-hero-image clear-fix">
            <figure class="entry-image">
                <?php the_post_thumbnail('full'); ?>
            </figure>
        </div>
<?php
	}
?>

	<div class="entry-content">
<?php
		the_content();
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'redrock'),
            'after'  => '</div>',
        ));
?>
	</div>

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php redrock_entry_footer(); ?>
		</div>
	</footer>
</article>