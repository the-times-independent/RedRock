<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RedRock
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
<?php
		the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); 
		if ('post' === get_post_type()) {
?>
            <div class="entry-meta">
                <?php redrock_entry_meta(); ?>
            </div>
<?php
		}
?>
	</header>

	<div class="entry-content">
		<?php
			the_content(sprintf(
				wp_kses(
				    'Continue reading %s <span class="meta-nav">&rarr;</span>',
				    array(
				        'span' => array(
				            'class' => array()
				        )
				    )
				),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			));
		?>

		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'redrock'),
				'after'  => '</div>',
			));
		?>
	</div>

	<footer class="entry-meta">
		<?php redrock_entry_footer(); ?>
	</footer>
</article>
